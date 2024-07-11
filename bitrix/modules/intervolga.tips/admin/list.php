<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $APPLICATION, $DB;

/**
 * Name for request filter variable
 */
define("BX_FILTER_REQUEST_NAME", "filter");

if (\Bitrix\Main\Loader::includeModule("intervolga.tips") && \Intervolga\Tips\Rights::canRead())
{
	$APPLICATION->setTitle(Loc::getMessage("intervolga.tips.LIST_TITLE"));

	$sRight = $APPLICATION->GetGroupRight("intervolga.tips");

	$arMap = \Intervolga\Tips\Orm\TipsTable::getMap();

	// Get sites
	$dbSites = CSite::GetList($b = "NAME", $o = "asc");
	$arSites = array();
	while ($arSite = $dbSites->Fetch())
	{
		$arSites[$arSite["ID"]] = "[" . $arSite["ID"] . "] " . $arSite["NAME"];
	}

	// Prepare admin table
	$sTableID = \Intervolga\Tips\Orm\TipsTable::getTableName();
	$oSort = new CAdminSorting($sTableID, "ID", "desc");
	$obAdmin = new CAdminList($sTableID, $oSort);

	// Prepare GetList filter
	$arFilter = array();
	$arFilterColumns = array();
	foreach ($arMap as $key => $arValue)
	{
		if (!$arValue["hidden"])
		{
			$arFilterColumns[] = "FILTER_" . $key;
		}
	}
	$obAdmin->InitFilter($arFilterColumns);

	// Build filter
	if ($_REQUEST[BX_FILTER_REQUEST_NAME] && $_REQUEST["del_filter"] != "Y")
	{
		foreach ($arMap as $key => $arValue)
		{
			if ($_REQUEST[BX_FILTER_REQUEST_NAME][$key])
			{
				$arFilter[$key] = $_REQUEST[BX_FILTER_REQUEST_NAME][$key];

				if (in_array($key, array("MODIFIED_DATE", "CREATE_DATE")))
				{
					if (strlen($arFilter[$key][1]) == 0)
					{
						unset($arFilter[$key]);
					}
					else
					{
						$arFilter[">=" . $key] = \Bitrix\Main\Type\DateTime::createFromTimestamp(strtotime($arFilter[$key][0]));
						$arFilter["<=" . $key] = \Bitrix\Main\Type\DateTime::createFromTimestamp(strtotime($arFilter[$key][1] . "23:59:59"));

						unset($arFilter[$key]);
					}
				}
			}
		}
	}

	// Prepare GetList Order option
	$by = $_REQUEST["by"] ? $_REQUEST["by"] : "ID";
	$order = $_REQUEST["order"] ? $_REQUEST["order"] : "ASC";

	if (\Intervolga\Tips\Rights::canWrite())
	{
		// Process edit action
		if($obAdmin->EditAction())
		{
			foreach($FIELDS as $ID => $arFields)
			{
				if(!$obAdmin->IsUpdated($ID))
					continue;
				$DB->StartTransaction();

				$obRes = \Intervolga\Tips\Orm\TipsTable::update($ID, $arFields);
				if (!$obRes->isSuccess())
				{
					$DB->Rollback();
					$obAdmin->AddGroupError(implode("<br>", $obRes->getErrorMessages()), $ID);
				}

				$DB->Commit();
			}
		}

		// Process group actions
		if(($arID = $obAdmin->GroupAction()))
		{
			if($_REQUEST['action_target']=='selected')
			{
				$arID = array();
				$rsData = \Intervolga\Tips\Orm\TipsTable::getList(array(
					"order" => array($by => $order),
					"filter" => $arFilter,
				));
				while($arRes = $rsData->Fetch())
				{
					if ($arRes["ID"])
					{
						$arID[] = $arRes["ID"];
					}
				}
			}

			if ($arID)
			{
				$dbTips = \Intervolga\Tips\Orm\TipsTable::getList(
					array(
						"select" => array("ID", "ACTIVE", "TEXT"),
						"order" => array("ID" => "ASC"),
						"filter" => array("ID" => $arID),
					)
				);
				while ($arTip = $dbTips->fetch())
				{
					$iId = $arTip["ID"];
					unset($arTip["ID"]);
					switch ($_REQUEST["action"])
					{
						case "delete":
							@set_time_limit(0);
							$DB->StartTransaction();
							$obRes = \Intervolga\Tips\Orm\TipsTable::delete($iId);
							if (!$obRes->isSuccess())
							{
								$DB->Rollback();
								$obAdmin->AddGroupError(implode("<br>", $obRes->getErrorMessages()), $iId);
							}
							$DB->Commit();
							break;
						case "activate":
						case "deactivate":
							$arTip["ACTIVE"] = ($_REQUEST["action"] == "activate" ? "Y" : "N");
							$obRes = \Intervolga\Tips\Orm\TipsTable::update($iId, $arTip);
							if (!$obRes->isSuccess())
							{
								$obAdmin->AddGroupError(implode("<br>", $obRes->getErrorMessages()), $iId);
							}
							break;
					}
				}
			}
		}
	}
	// Execute GetList
	$rsData = \Intervolga\Tips\Orm\TipsTable::getList(array(
		"order" => array($by => $order),
		"filter" => $arFilter,
	));
	$rsData = new CAdminResult($rsData, $sTableID);
	$rsData->NavStart();

	// Enable pagination
	$obAdmin->NavText($rsData->GetNavPrint(Loc::getMessage("intervolga.tips.LIST_TITLE")));

	// Prepare CAdminList columns
	$arHeaders = array();
	foreach ($arMap as $key => $arValue)
	{
		if (!$arValue["hidden"])
		{
			$arHeader = array(
				"id" => $key,
				"content" => $arValue["title"],
				"sort" => $key,
				"default" => True,
			);
			$arHeaders[] = $arHeader;
		}
	}
	$obAdmin->AddHeaders($arHeaders);

	$arUsers = array();

	// Prepare CAdminList rows
	while($arRes = $rsData->NavNext(False))
	{
		$obRow =& $obAdmin->AddRow($arRes["ID"], $arRes);

		if (\Intervolga\Tips\Rights::canWrite())
		{
			$obRow->AddEditField("SITE", CLang::SelectBox("FIELDS[".$arRes["ID"]."][SITE]", $arRes["SITE"]));
			$obRow->AddCheckField("ACTIVE");
			$obRow->AddInputField("URL");
			$obRow->AddCheckField("URL_EQUAL");
			$obRow->AddInputField("TEXT");
			$obRow->AddInputField("TOOLTIP");
		}

		$obRow->AddViewField("SITE", $arSites[$arRes["SITE"]]);
		if ($arRes["URL_EQUAL"] == "Y")
		{
			$obRow->AddViewField("URL_EQUAL", Loc::getMessage("MAIN_YES"));
		}
		else
		{
			$obRow->AddViewField("URL_EQUAL", Loc::getMessage("MAIN_NO"));
		}

		foreach (array("CREATED_BY" => $arRes["CREATED_BY"], "MODIFIED_BY" => $arRes["MODIFIED_BY"]) as $sTipField => $iUserId)
		{
			if ($iUserId && !$arUsers[$iUserId])
			{
				$sBy = "ID";
				$sOrder = "ASC";
				$arFilter = array("ID" => $arRes["CREATED_BY"]);
				$arParam = array("FIELDS" => array("LOGIN", "ID"));
				$rsUsers = \CUser::GetList($sBy, $sOrder, $arFilter, $arParam);
				while ($arUser = $rsUsers->GetNext())
				{
					$arUsers[$arUser["ID"]] = $arUser;
				}
			}
			if ($arUsers[$iUserId])
			{
				$obRow->AddViewField($sTipField, "[<a href=\"/bitrix/admin/user_edit.php?lang=ru&ID=$iUserId\">$iUserId</a>] " . $arUsers[$iUserId]["LOGIN"]);
			}
		}

		$arActions = Array();

		if (\Intervolga\Tips\Rights::canWrite())
		{
			$arActions[] = array(
				"ICON" => "edit",
				"DEFAULT" => true,
				"TEXT" => Loc::getMessage("intervolga.tips.EDIT"),
				"ACTION" => $obAdmin->ActionRedirect("intervolga.tips_edit.php?ID=" . $arRes["ID"])
			);

			if ($arRes["ACTIVE"] == "Y")
			{
				$arActions[] = array(
					"TEXT" => Loc::getMessage("intervolga.tips.DEACTIVATE"),
					"ACTION" => $obAdmin->ActionDoGroup($arRes["ID"], "deactivate")
				);
			}
			else
			{
				$arActions[] = array(
					"TEXT" => Loc::getMessage("intervolga.tips.ACTIVATE"),
					"ACTION" => $obAdmin->ActionDoGroup($arRes["ID"], "activate")
				);
			}

			$arActions[] = array(
				"ICON" => "delete",
				"TEXT" => Loc::getMessage("intervolga.tips.DEL"),
				"ACTION" => "if(confirm('" . Loc::getMessage('intervolga.tips.DEL_CONFIRM') . "')) " . $obAdmin->ActionDoGroup($arRes["ID"], "delete"),
			);
		}
		else
		{
			$arActions[] = array(
				"ICON" => "view",
				"DEFAULT" => true,
				"TEXT" => Loc::getMessage("intervolga.tips.VIEW"),
				"ACTION" => $obAdmin->ActionRedirect("intervolga.tips_edit.php?ID=" . $arRes["ID"])
			);
		}
		if (is_set($arActions[count($arActions) - 1], "SEPARATOR"))
		{
			unset($arActions[count($arActions) - 1]);
		}
		$obRow->AddActions($arActions);
	}

	// Prepare CAdminList footer
	$obAdmin->AddFooter(
		array(
			array("title" => Loc::getMessage("MAIN_ADMIN_LIST_SELECTED"), "value" => $rsData->SelectedRowsCount()),
			array("counter" => true, "title" => Loc::getMessage("MAIN_ADMIN_LIST_CHECKED"), "value" => "0"),
		)
	);

	// Prepare CAdminList Contexts and Buttons
	if (\Intervolga\Tips\Rights::canWrite())
	{
		$obAdmin->AddGroupActionTable(Array(
			"delete"=>Loc::getMessage("MAIN_ADMIN_LIST_DELETE"),
			"activate"=>Loc::getMessage("MAIN_ADMIN_LIST_ACTIVATE"),
			"deactivate"=>Loc::getMessage("MAIN_ADMIN_LIST_DEACTIVATE"),
		));

		$aContext = array(
			array(
				"TEXT"=>Loc::getMessage("intervolga.tips.ADD"),
				"LINK"=> "intervolga.tips_edit.php?lang=".LANG,
				"TITLE"=>Loc::getMessage("POST_ADD_TITLE"),
				"ICON"=>"btn_new",
			),
		);
		$obAdmin->AddAdminContextMenu($aContext);
	}
	else
	{
		$obAdmin->AddAdminContextMenu();
	}
	$obAdmin->CheckListMode();

	// Prepare CAdminFilter
	$arFilterNames = array();
	foreach ($arMap as $key => $arValue)
	{
		if (!$arValue["hidden"])
		{
			$arFilterNames[] = $arValue["title"];
		}
	}
	$obFilter = new CAdminFilter($sTableID."_filter", $arFilterNames);
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
?>
<? if (\Bitrix\Main\Loader::includeModule("intervolga.tips")): ?>
	<? if (\Intervolga\Tips\Rights::canRead()): ?>
		<form name="tips_find_form" method="get" action="<?echo $APPLICATION->GetCurPage()?>">
			<?$obFilter->Begin()?>
			<tr>
				<td><?=$arMap["ID"]["title"]?></td>
				<td>
					<input type="text" name="<?=BX_FILTER_REQUEST_NAME?>[ID]" value="<?echo htmlspecialcharsbx($arFilter["ID"])?>">
				</td>
			</tr>
			<tr>
				<td><?=$arMap["ACTIVE"]["title"]?></td>
				<td>
					<?
					$arSelectBoxBinaryValues = array(
						"REFERENCE" => array(
							Loc::getMessage("MAIN_YES"),
							Loc::getMessage("MAIN_NO"),
						),
						"REFERENCE_ID" => array(
							"Y",
							"N",
						)
					);
					?>
					<?=SelectBoxFromArray(BX_FILTER_REQUEST_NAME . '[ACTIVE]', $arSelectBoxBinaryValues, $arFilter["ACTIVE"], Loc::getMessage("MAIN_ALL"))?>
				</td>
			</tr>
			<tr>
				<td><?=$arMap["SITE"]["title"]?></td>
				<td>
					<?
					$arSelectBoxSiteValues = array(
						"REFERENCE" => array(),
						"REFERENCE_ID" => array(),
					);
					foreach ($arSites as $sSiteId => $sSiteName)
					{
						$arSelectBoxSiteValues["REFERENCE"][] = $sSiteName;
						$arSelectBoxSiteValues["REFERENCE_ID"][] = $sSiteId;
					}

					?>
					<?=SelectBoxFromArray(BX_FILTER_REQUEST_NAME . '[SITE]', $arSelectBoxSiteValues, $arFilter["SITE"], Loc::getMessage("MAIN_ALL"))?>
				</td>
			</tr>
			<tr>
				<td><?=$arMap["URL"]["title"]?></td>
				<td>
					<input type="text" name="<?=BX_FILTER_REQUEST_NAME?>[URL]" value="<?echo htmlspecialcharsbx($arFilter["URL"])?>">
				</td>
			</tr>
			<tr>
				<td><?=$arMap["URL_EQUAL"]["title"]?></td>
				<td>
					<?
					$arSelectBoxBinaryValues = array(
						"REFERENCE" => array(
							Loc::getMessage("MAIN_YES"),
							Loc::getMessage("MAIN_NO"),
						),
						"REFERENCE_ID" => array(
							"Y",
							"N",
						)
					);
					?>
					<?=SelectBoxFromArray(BX_FILTER_REQUEST_NAME . '[URL_EQUAL]', $arSelectBoxBinaryValues, $arFilter["URL_EQUAL"], Loc::getMessage("MAIN_ALL"))?>
				</td>
			</tr>
			<tr>
				<td><?=$arMap["TEXT"]["title"]?></td>
				<td>
					<input type="text" name="<?=BX_FILTER_REQUEST_NAME?>[TEXT]" value="<?echo htmlspecialcharsbx($arFilter["TEXT"])?>">
				</td>
			</tr>
			<tr>
				<td><?=$arMap["TOOLTIP"]["title"]?></td>
				<td>
					<input type="text" name="<?=BX_FILTER_REQUEST_NAME?>[TOOLTIP]" value="<?echo htmlspecialcharsbx($arFilter["TOOLTIP"])?>">
				</td>
			</tr>
			<tr>
				<td><?=$arMap["CREATED_BY"]["title"]?></td>
				<td>
					<?=FindUserID(
						BX_FILTER_REQUEST_NAME . "[CREATED_BY]",
						htmlspecialcharsbx($arFilter["CREATED_BY"]),
						"",
						"tips_find_form"
					)?>
				</td>
			</tr>
			<tr>
				<td><?=$arMap["CREATE_DATE"]["title"]?></td>
				<td>
					<?=CalendarPeriod(
						BX_FILTER_REQUEST_NAME . "[CREATE_DATE][0]",
						htmlspecialcharsbx($arFilter["CREATE_DATE"][0]),
						BX_FILTER_REQUEST_NAME . "[CREATE_DATE][1]",
						htmlspecialcharsbx($arFilter["CREATE_DATE"][1]),
						"tips_find_form",
						"Y"
					)?>
				</td>
			</tr>
			<tr>
				<td><?=$arMap["MODIFIED_BY"]["title"]?></td>
				<td>
					<?=FindUserID(
						BX_FILTER_REQUEST_NAME . "[MODIFIED_BY]",
						htmlspecialcharsbx($arFilter["MODIFIED_BY"]),
						"",
						"tips_find_form"
					)?>
				</td>
			</tr>
			<tr>
				<td><?=$arMap["MODIFIED_DATE"]["title"]?></td>
				<td>
					<?=CalendarPeriod(
						BX_FILTER_REQUEST_NAME . "[MODIFIED_DATE][0]",
						htmlspecialcharsbx($arFilter["MODIFIED_DATE"][0]),
						BX_FILTER_REQUEST_NAME . "[MODIFIED_DATE][1]",
						htmlspecialcharsbx($arFilter["MODIFIED_DATE"][1]),
						"tips_find_form",
						"Y"
					)?>
				</td>
			</tr>
			<?$obFilter->Buttons(array("table_id" => $sTableID, "url" => $APPLICATION->GetCurPage(), "form" => "tips_find_form"))?>
			<?$obFilter->End()?>
		</form>
		<?$obAdmin->DisplayList();?>
	<? else: ?>
		<?=CAdminMessage::ShowMessage(Loc::getMessage("intervolga.tips.MODULE_READ_PERMITTED"))?>
	<? endif ?>
<? else: ?>
	<?=CAdminMessage::ShowMessage(Loc::getMessage("intervolga.tips.MODULE_NOT_INSTALLED"))?>
<? endif ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");