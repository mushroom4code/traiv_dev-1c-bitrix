<?php
IncludeModuleLangFile(__FILE__);
class CAbandon {


	public static function defineVariables() {
		$module_id = "newit.abandonedcarts";
		global $APPLICATION;
		$basket_url = COption::GetOptionString($module_id, "basket_address");
		$field_id = COption::GetOptionString($module_id, "email_field_id");
		// echo $basket_url;
		if (($_SESSION['SESS_INCLUDE_AREAS'] != 1) && (strpos($_SERVER['REQUEST_URI'], '/bitrix/admin/') === false)) {
			$APPLICATION->AddHeadString('<script type="application/javascript">window.basketurl="' . $basket_url . '"</script>');
			$APPLICATION->AddHeadString('<script type="application/javascript">window.field_id="' . $field_id . '"</script>');
			$APPLICATION->AddHeadScript("/bitrix/js/" . $module_id . "/newit-service.js");
		}
	}


	public static function deleteOrderedElem($ID, $arFields, $arOrder, $isNew) {
		CModule::IncludeModule("iblock");
		CModule::IncludeModule("sale");
		global $DB;
		$arData = array();

		$_SESSION["test_fields"] = $arOrder;

		if (!empty($arOrder["USER_EMAIL"])) {
			$arSelect = Array(
					"ID",
					"IBLOCK_ID",
					"NAME"
			); // IBLOCK_ID � ID ����������� ������ ���� �������, ��. �������� arSelectFields ����
			$arFilter = Array(
					"IBLOCK_TYPE" => "newit_abandonedcarts",
					"IBLOCK_CODE " => "newit_abandonedcarts",
					"NAME" => $arOrder["USER_EMAIL"]
			);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while ($ob = $res->GetNext()) {
				$DB->StartTransaction();
				if (!CIBlockElement::Delete($ob["ID"])) {
					$DB->Rollback();
				} else {
					$DB->Commit();
				}
			}
		}
	}


	public static function catchLinkFollow() {
		if (!empty($_GET["newit_abandon_follow"])) {
			CModule::IncludeModule("iblock");

			$res = CIBlock::GetList(Array(), Array(
					'TYPE' => 'newit_abandonedcarts',
					'SITE_ID' => SITE_ID
			), false);
			while ($ar_res = $res->Fetch()) {
				$IBLOCK_ID = $ar_res["ID"];
			}

			$el = new CIBlockElement();
			$PROP["LINK_FOLLOW"] = $_GET["QUERY"];
			$arLoadProductArray = Array(
					"IBLOCK_ID" => $IBLOCK_ID,
					"NAME" => $_GET["email"],
					"PROPERTY_VALUES" => $PROP
			);
			$PRODUCT_ID = $el->Add($arLoadProductArray);
		}
	}


	public static function SendMailIteration($compare_date, $mail_counter) {

        require_once("UnisenderApi.php");
        $apikey = "611jc8dyyia1eyuncxdgww6mtsoiswg878hhpgxa";
        $uni = new Unisender\ApiWrapper\UnisenderApi($apikey);


		$testing = COption::GetOptionString("newit.abandonedcarts", "testing_mode");
		CAbandon::Log("$mail_counter iteration");
		$temps = array();
		$arFilterMail = Array(
				"TYPE_ID" => "NEWIT_ABANDONBASKET_ALERT"
		);
		$rsMess = CEventMessage::GetList($by = "id", $order = "asc", $arFilterMail);
		while ($temp = $rsMess->GetNext()) {
			$temps[] = $temp;
		}
		if (count($temps) < $mail_counter) {
			CAbandon::Log("No template for $mail_counter iteration");
			return;
		}
		$start_date = new DateTime();
		$start_date = $start_date->modify("-1 month");
		//var_dump($compare_date->format("d.m.Y H:i:s"));
/*        CAbandon::Log(print_r($compare_date, true));
        CAbandon::Log(print_r($start_date, true));*/
		$arFilter = Array(
				"IBLOCK_TYPE" => "newit_abandonedcarts",
				"<=DATE_CREATE" => $compare_date->format("d.m.Y H:i:s"),
				">=DATE_CREATE" => $start_date->format("d.m.Y H:i:s"),
				"IBLOCK_CODE" => "newit_abandonedcarts"
		);
		// date format like 04.02.2017 03:40:16
		CModule::IncludeModule("iblock");
		$arSelect = Array(
				"ID",
				"IBLOCK_ID",
				"NAME",
				"DATE_CREATE",
				"PROPERTY_DATA",
				"PROPERTY_MAIL_COUNT"
		);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while ($ob = $res->GetNext()) {
			//var_dump($mail_counter);
			//var_dump($ob); continue;
			if (strlen($ob["PROPERTY_DATA_VALUE"]) > 1) {
				$arItems = explode(";", $ob["PROPERTY_DATA_VALUE"]);

                $arItems = array_diff($arItems, array(''));

                /*CAbandon::Log(print_r($arItems, true));*/

                $arItemsExploded = [];

                foreach ($arItems as $xyndex => $item){

                        $arItemsExploded[$xyndex] = explode("|", $item);
                }

                /*CAbandon::Log(print_r($arItemsExploded, true));*/

				$names = "";
				$position = 0;
                foreach ($arItemsExploded as $index => $arItem) {
                    /*CAbandon::Log(print_r($arItem, true));*/
                    //$position = $index+1;
                    if (strlen($arItem[0]) > 1) {
                        $resItem = CIBlockElement::GetByID($arItem[0]);
                        if ($ar_res = $resItem->GetNext()) {
                            $data = $ar_res;
                            /* CAbandon::Log(print_r($ar_res, true));*/
                        }
                        
                        $arFile = CFile::GetFileArray($data['DETAIL_PICTURE']);
                        if (!empty($arFile['SRC'])){
                            $img = "https://traiv-komplekt.ru/".$arFile['SRC'];
                        } else {
                            $img = "https://traiv-komplekt.ru/upload/nfuni.jpg";
                        }
                             
                        
                        
                        $origname = $data["NAME"];
                        $formatedPACKname = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/","",$origname);
                        $formatedname = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|Ев|PU=S|PU=K|RU=S|RU=K|PU=К/","",$formatedPACKname);

                        $arItem[2] = substr($arItem[2],0,-2);

                        $quantity = $arItem[1];
                        $price = $arItem[2] == '0' ? 'Запросить цену' : $arItem[2].' р.';
                        $summ = $arItem[2] == '0' ? 'Запросить цену' : ($arItem[1] * $arItem[2]).' р.';

                        if ($position%3 == 0){
                            $names .= htmlspecialchars_decode('<tr>');
                        }
                        
                        /*$names .= htmlspecialchars_decode('<td>' . $position . '.</td><td><a href="' . 'https://traiv-komplekt.ru'.$data["DETAIL_PAGE_URL"] . '">' . $formatedname . '</a></td><td>'.$quantity .' шт. </td><td> '  .$summ . '</td> ');*/
                        
                        $names .= htmlspecialchars_decode('<td width="32%" style=""><div class="es-item"><a href="'. 'https://traiv-komplekt.ru'.$data["DETAIL_PAGE_URL"].'"><img src="'.$img.'" class="es-img"></a><div class="es-name"><a href="'. 'https://traiv-komplekt.ru'.$data["DETAIL_PAGE_URL"].'">'.$formatedname.'</a></div><div class="es-count">'.$quantity .' шт. </div><div class="es-summ"> '.$summ.' </div><div style="text-align:left;padding-top:20px;"><a class="es-button" href="https://traiv-komplekt.ru/personal/order/make/" target="_blank">Купить</a></div></div></td>');
                        
                        $position++;
                        
                        if ($position%3 == 0){
                            $names .= htmlspecialchars_decode('</tr>');
                            $position = 0;
                        }
                    }
                }

                /*CAbandon::Log(print_r($names, true));*/

                $table = '<table style="border:0px solid #000000;font-size:14px;margin:0px" width="97%">'
                    . '<tbody>'
                    . $names
                    . '</tbody>'
                    . '</table>';


                $email = $ob["NAME"];


                $result = $uni->createList(Array("title" => "Забытая корзина - " . $email));

                $answer = json_decode($result);

                $list_id = $answer->result->id;

// Новые подписчики
                $new_emails = array($email);

//Шаблон
                $template_id = '4089585';

// Создаём POST-запрос
                $request = array(
                    'api_key' => $apikey,
                    'field_names[0]' => 'email',
                    'field_names[1]' => 'items_data',
                    'field_names[2]' => 'email_list_ids'
                );
                for ($i = 0; $i < 1; $i++) {
                    $request['data[' . $i . '][0]'] = $new_emails[$i];
                    $request['data[' . $i . '][1]'] = $table;
                    $request['data[' . $i . '][2]'] = $list_id;
                }

                $answer5 = $uni->importContacts($request);

                $EmailMessage = [
                    'sender_name' => 'Трайв-Комплект',
                    'sender_email' => 'info@traiv-komplekt.ru',
                    'list_id' => $list_id,
                    'template_id' => $template_id
                ];

                $createEmail = $uni->createEmailMessage($EmailMessage);

                $answer6 = json_decode($createEmail);

                $message_id = $answer6->result->message_id;

                $SendMessage = [
                    'message_id' => $message_id
                ];

                $createCampaign = $uni->createCampaign($SendMessage);

                CAbandon::Log('UNI SENDED');


                    }

            CAbandon::Log('NEXT ELEMENT');


                }




				if (empty($ob["PROPERTY_MAIL_COUNT_VALUE"])) {
					$val = 1;
				} else {
					$val = $ob["PROPERTY_MAIL_COUNT_VALUE"] + 1;
				}

				if (($mail_counter + 1) == $val) {
					if (preg_match_all('/<a\s+href=["\']([^"\']+)["\']/i', htmlspecialchars_decode($names), $links, PREG_PATTERN_ORDER)) {
						$all_hrefs = $links[1];
					}
					foreach ($all_hrefs as $href) {

						$names = str_replace($href, $href . "?newit_abandon_follow=Y&email=" . $ob["NAME"] . "&QUERY=" . $val, $names);
					}

					// print_r($temps[intval($ob["PROPERTY_MAIL_COUNT_VALUE"])]["ID"]);
					$arMails = array();
					$id = false;
					if ($testing == "Y") {
						$mails = explode(",", COption::GetOptionString("newit.abandonedcarts", "test_mails"));
						foreach ($mails as $mail) {
							$arEventFields = array(
									"OFFERS" => $names,
									"EMAIL" => trim($mail),
									"QUERY" => $val
							);
							$id = CEvent::Send("NEWIT_ABANDONBASKET_ALERT", "s1", $arEventFields, "N", $temps[$mail_counter]["ID"]);

                            CAbandon::Log("message to user " . trim($mail) . " was sent, $mail_counter iteration");

                        }
					} else {
						$arEventFields = array(
								"OFFERS" => $names,
								"EMAIL" => $ob["NAME"],
								"QUERY" => $val
						);

						$id = CEvent::Send("NEWIT_ABANDONBASKET_ALERT", "s1", $arEventFields, "N", $temps[$mail_counter]["ID"]);
						CAbandon::Log("message to user " . $ob["NAME"] . " was sent, $mail_counter iteration");
					}
					if ($id !== false) {
						$el = new CIBlockElement();
						$PROP = array();
						$PROP["MAIL_COUNT"] = $val;
						$PROP["DATA"] = $ob["PROPERTY_DATA_VALUE"];
						$arLoadProductArray = Array(
							"PROPERTY_VALUES" => $PROP
						);
						$update = $el->Update($ob["ID"], $arLoadProductArray);
					}
					//echo "mail send, iteration is " . $mail_counter . "\n";
				}
	}


	public static function SendMail() {
		$MODULE_ID = "newit.abandonedcarts";
		$testing = COption::GetOptionString($MODULE_ID, "testing_mode");
		// $mail_count = COption::GetOptionString("newit.abandonedcarts", "mail_count");
		// $times = COption::GetOptionString("newit.abandonedcarts", "times");
		$days = array();
		$hours = array();
		$minutes = array();
		for($i = 1; $i <= 10; $i++) {
			$days[$i] = COption::GetOptionInt($MODULE_ID, "mail_interval_{$i}_days");
			$hours[$i] = COption::GetOptionInt($MODULE_ID, "mail_interval_{$i}_hours");
			$minutes[$i] = COption::GetOptionInt($MODULE_ID, "mail_interval_{$i}_minutes");
		}
		$j = 0;
		$send_dates = array();
		for($i = 1; $i <= 10; $i++) {
			if ((int)$days[$i] > 0 || (int)$hours[$i] > 0 || (int)$minutes[$i] > 0) {
				$datetime = new DateTime();
				if ($days[$i] > 0)
					$datetime = $datetime->modify("-{$days[$i]} days");
				if ($hours[$i] > 0)
					$datetime = $datetime->modify("-{$hours[$i]} hours");
				if ($minutes[$i] > 0)
					$datetime = $datetime->modify("-{$minutes[$i]} minutes");
				$send_dates[$j] = $datetime;
				$j++;
			}
		}
		//var_dump($send_dates);
		//die();
		//var_dump($days); var_dump($hours); var_dump($minutes); die();
		//$hours = round(($times / $mail_count) * 24);
		//$date = strtotime(date("d.m.Y H:i:s")) - $hours * 3600;
		//$compare_date = date("d.m.Y H:i:s", $date);
		CAbandon::Log("Starting mail send");
		for($i = 0; $i < count($send_dates); $i++) {
			CAbandon::SendMailIteration($send_dates[$i], $i);
		}
		CAbandon::Log("Ending mail send");
		CAbandon::Log(" ");
		return "CAbandon::SendMail();";
	}


	public static function GetStatistics() {
		if (!empty($_REQUEST["date_from"]) && !empty($_REQUEST["date_to"])) {
			$date = DateTime::createFromFormat("d.m.Y", $_REQUEST["date_to"]);
			$date->modify('+1 day');
			$date_end = $date->format("d.m.Y H:i:s");
			$date_end_sql = $date->format('Y-m-d');
			$date_end_str = $date->format("d.m.Y");

			$date = DateTime::createFromFormat("d.m.Y", $_REQUEST["date_from"]);
			$date_begin = $date->format("d.m.Y H:i:s");
			$date_begin_sql = $date->format('Y-m-d');
			$date_begin_str = $date->format("d.m.Y");
		} else {
			$date = new DateTime();
			$date->modify('+1 day');
			$date_end = $date->format("d.m.Y H:i:s");
			$date_end_sql = $date->format('Y-m-d');
			$date_end_str = $date->format("d.m.Y");

			$date = new DateTime();
			$date->modify('-14 day');
			$date_begin = $date->format("d.m.Y H:i:s");
			$date_begin_sql = $date->format('Y-m-d');
			$date_begin_str = $date->format("d.m.Y");
		}
		global $DB;
		$res = $DB->Query("select * from b_event where event_name = 'NEWIT_ABANDONBASKET_ALERT' AND DATE_INSERT BETWEEN '$date_begin_sql' AND '$date_end_sql' order by date_insert");

		while ($exception = $res->Fetch()) {
			//var_dump(unserialize($exception["C_FIELDS"]));
			if (unserialize($exception["C_FIELDS"]) !== false) {
				$exception["C_FIELDS"] = unserialize($exception["C_FIELDS"]);
				unset($exception["C_FIELDS"]["OFFERS"]);
			} else {
				$exception["C_FIELDS"] = explode("&", $exception["C_FIELDS"]);
				foreach ($exception["C_FIELDS"] as $k => $field) {
					$data = explode("=", $field);
					$exception["C_FIELDS"][$data[0]] = $data[1];
					unset($exception["C_FIELDS"][$k]);
				}
			}
			$mails[$exception["C_FIELDS"]["QUERY"]][] = $exception;
		}
		CAbandon::Log(print_r($mails, true));
		if (!empty($mails)) {
			ksort($mails);
			CModule::IncludeModule("iblock");
			$arSelect = Array(
				"ID"
			);
			$arFilter = Array(
				"IBLOCK_TYPE" => "newit_abandonedcarts",
				"IBLOCK_CODE" => "newit_abandonedcarts",
				">=DATE_CREATE" => $date_begin,
				"<=DATE_CREATE" => $date_end,
			);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while ($ob = $res->GetNext()) {
				$USERS[] = $ob;
			}
			$users_count = count($USERS);

			$arSelect = Array(
				"ID",
				"IBLOCK_ID",
				"PROPERTY_LINK_FOLLOW"
			);
			$arFilter = Array(
				"IBLOCK_TYPE" => "newit_abandonedcarts",
				"IBLOCK_CODE" => "newit_abandonedcarts_statistics",
				">=DATE_CREATE" => $date_begin,
				"<=DATE_CREATE" => $date_end
			);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while ($ob = $res->GetNext()) {
				$thisUsers[$ob["PROPERTY_LINK_FOLLOW_VALUE"]][] = $ob;
			}

			$html = "<h3>" . GetMessage("abandon_1") . $date_begin_str . GetMessage("abandon_2") . $date_end_str . "</h3>";
			$html .= "<p>" . GetMessage("abandon_3") . $users_count . "</p>";
			foreach ($mails as $q => $mail) {
				$html .= "<p>" . GetMessage("abandon_4") . $q . ": <b>" . count($mails[$q]) . '</b>' .GetMessage("abandon_5") . ": <b>".  count($thisUsers[$q]) . "</b> - " . round((count($thisUsers[$q]) / count($mails[$q]) * 100), 2) . "%)</p>";
			}
		} else {
			$html = "<p>" . GetMessage("abandon_6") . "</p>";
		}
		echo $html;
	}

	public static function Log($string) {
		file_put_contents(
			$_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "emails.txt",
			date("Y-m-d H:i:s", time()) . "  " . $string . "\r\n",
			FILE_APPEND
		);
	}


}