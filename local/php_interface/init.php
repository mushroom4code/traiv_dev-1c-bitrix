<?
if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/handler_to_1c.php"))
    require_once ("conf.php");
    define('LOCATION_ID', "0000103664");
    \Bitrix\Main\EventManager::getInstance()->addEventHandlerCompatible(
        
        'sale',
        
        'OnSaleComponentOrderProperties',
        
        'SaleOrderEvents::fillLocation'
        
        ); 
    
    class SaleOrderEvents
    
    {
        
        static function fillLocation(&$arUserResult, $request, &$arParams, &$arResult)
        
        {
            
            $registry = \Bitrix\Sale\Registry::getInstance(\Bitrix\Sale\Registry::REGISTRY_TYPE_ORDER);
            
            $orderClassName = $registry->getOrderClassName();
            
            $order = $orderClassName::create(\Bitrix\Main\Application::getInstance()->getContext()->getSite());
            
            $propertyCollection = $order->getPropertyCollection();
            
            
            
            foreach ($propertyCollection as $property)
            
            {
                
                if ($property->isUtil())
                    
                    continue;
                    
                    $arProperty = $property->getProperty();
                    
                    if(
                        
                        $arProperty['TYPE'] === 'LOCATION'
                        
                        && array_key_exists($arProperty['ID'],$arUserResult["ORDER_PROP"])
                        
                        && !$request->getPost("ORDER_PROP_".$arProperty['ID'])
                        
                        && (
                            
                            !is_array($arOrder=$request->getPost("order"))
                            
                            || !$arOrder["ORDER_PROP_".$arProperty['ID']]
                            
                            )
                        
                        ) {
                            
                            $arUserResult["ORDER_PROP"][$arProperty['ID']] = LOCATION_ID;
                            
                        }
                        
            }
            
        }
        
    }
    
    /*делаем отгрузку нулевой*/
    $eventManager = \Bitrix\Main\EventManager::getInstance();
    $eventManager->addEventHandler('sale', 'OnSaleOrderBeforeSaved', ['OrderEvents', 'onBeforeOrderSaveHandler']);
    
    class OrderEvents {
        public static function onBeforeOrderSaveHandler(\Bitrix\Main\Event $event) {
            $order = $event->getParameter('ENTITY');
            $shipmentCollection = $order->getShipmentCollection();
            
            foreach($shipmentCollection as $shipment) {
                if(!$shipment->isSystem())
                    $shipment->setBasePriceDelivery(0, false);
            }
        }
    }
    
    AddEventHandler('main', 'OnEpilog', function(){
        $arJsConfig = array(
            'copy_main' => array(
                'js' => '/local/templates/traiv-main/js/copy/script.js',
                'rel' => array(),
            ),
            'copy_admin' => array(
                'js' => '/local/templates/traiv-main/js/copyadmin/script.js',
                'rel' => array(),
            ),
        );
        foreach ($arJsConfig as $ext => $arExt) {
            \CJSCore::RegisterExt($ext, $arExt);
        }

        global $USER;

        if ($USER->IsAuthorized()) {
            CUtil::InitJSCore(array('copy_admin'));
        } else {
            CUtil::InitJSCore(array('copy_main'));
        }
    });

        AddEventHandler("sale", "OnSaleComponentOrderOneStepComplete", "AddingNewAccount");
        
        function AddingNewAccount($orderID, $arFields){
            $arOrder = CSaleOrder::GetByID($orderID);
            //mail("dmitrii.kozlov@traiv.ru","Test","$date\r\nВерсия PHP ".  $arOrder["USER_ID"] . "\r\nТестовое письмо!");
        }
        
        /*AddEventHandler("catalog", "OnProductUpdate", "IBlockElementAfterSaveHandler");
        
        function IBlockElementAfterSaveHandler($ID,$Fields){
            
            $ar_res = CCatalogProduct::GetByIDEx($ID);
            $upd = false;
            
            $upd = CIBlockElement::SetPropertyValuesEx(
                $ID,
                $Fields['IBLOCK_ID'],
                array('STORAGE' => $Fields['QUANTITY'])
                );
        }*/
        
    
    AddEventHandler("sale", "OnOrderNewSendEmail", "ModifyOrderSaleMails");
function ModifyOrderSaleMails($orderID, &$eventName, &$arFields)
{
    
    
    if(CModule::IncludeModule("sale") && CModule::IncludeModule("iblock"))
    {

        $order = Bitrix\Sale\Order::load($orderID);
        
        $propertyCollection = $order->getPropertyCollection();
        $personTypeId = $order->getPersonTypeId();
        
        $ct_site_id = '52033';
        $subject = "Заказ";
        $requestUrl = "https://traiv-komplekt.ru/personal/order/make/";
        $requestNumber = rand(900000,1000000);
        $requestDate = date("d.m.Y H:i:s");
        
        if ($personTypeId == 1) {
            $fio = $propertyCollection->getItemByOrderPropertyId(1)->getValue();
            $phoneNumber = $propertyCollection->getItemByOrderPropertyId(3)->getValue();
            $email = $propertyCollection->getItemByOrderPropertyId(2)->getValue();
            $check_call = $propertyCollection->getItemByOrderPropertyId(33)->getValue();
        }
        
        if ($personTypeId == 2) {
            $fio =  $propertyCollection->getItemByOrderPropertyId(12)->getValue();
            $phoneNumber = $propertyCollection->getItemByOrderPropertyId(14)->getValue();
            $email = $propertyCollection->getItemByOrderPropertyId(13)->getValue();
            $check_call = $propertyCollection->getItemByOrderPropertyId(34)->getValue();
        }
        
        if (!empty($fio) && !empty($phoneNumber) && !empty($check_call) && $check_call == 'Y') {
            $call_value = $_COOKIE['_ct_session_id'];
            $token = '2pz6714yb38eMaP1QWa/mfTydCf6UdkeYv.axkgWbe932';
            
            $ct_data = array(
                'routeKey'  =>  "traiv_komplekt",
                'phone'     =>  $phoneNumber
            );
            if (!empty($call_value)){ $ct_data['sessionId'] = $call_value; }
            $ct_data['fields'] = array();
            if (!empty($fio)){ $field = array( 'name'  =>  "Имя", 'value' =>  $fio ); array_push($ct_data['fields'], $field); }
            
            $ct_build_data = json_encode($ct_data);
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded","Access-Token: " . $token));
            curl_setopt($ch, CURLOPT_URL, 'https://api.calltouch.ru/widget-service/v1/api/widget-request/user-form/create');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $ct_build_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $ct_result = curl_exec ($ch);
            curl_close ($ch);
        }
        
        $arOrder = CSaleOrder::GetByID($orderID);
        $strOrderList = "";
        $dbBasketItems = CSaleBasket::GetList(
            array("NAME" => "ASC"),
            array("ORDER_ID" => $orderID),
            false,
            false,
            array("PRODUCT_ID", "ID", "NAME", "QUANTITY", "PRICE", "CURRENCY", "ORDER_PRICE", "DETAIL_PAGE_URL", "CML2_ARTICLE")
            );
        $i = 1;
        while ($arProps = $dbBasketItems->Fetch())
        {
            $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'ID' => $arProps['PRODUCT_ID'], 'ACTIVE'=>'Y','CATALOG_GROUP_ID' => 2], Array("ID", "NAME", "PROPERTY_417","CATALOG_WEIGHT"));
            
            while($ar_result_in = $db_list_in->GetNext())
            {
                $res = CIBlockElement::GetProperty(18, $ar_result_in['ID'], array("sort" => "asc"), Array("CODE"=>"CML2_TRAITS"));
                while ($ob = $res->GetNext()) {
                    
                    if ($ob['DESCRIPTION'] == "Вес"){
                        $w = $ob['VALUE'];
                    }   
                }
                
                $summ = $arProps['QUANTITY'] * $arProps['PRICE'];
                $arProps['PRICE'] = sprintf("%.02f", $arProps['PRICE']);
                $summ = sprintf("%.02f", $summ);
                
                $weightSumm = $weightSumm + ($w * $arProps['QUANTITY'] * 1000);
                
                $arProps['NAME'] = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/", "", $arProps['NAME']);
                
                $arProps['NAME'] = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|РОМЕК|Ев|PU=S|PU=K|RU=S|RU=K|PU=К/", "", $arProps['NAME']);
                
                $SlicedName .= $arProps['NAME'];
                $SlicedQuantity .= $arProps['QUANTITY'];
                $arProps['DETAIL_PAGE_URL'] = 'https://'. SITE_SERVER_NAME . $arProps['DETAIL_PAGE_URL'];
                $NoPrice = 'запросить цену';
                
                /*start*/
                $strOrderList .= $ar_result_in['PROPERTY_417_VALUE'];
                $strOrderList .= $arProps['NAME'];
                $strOrderList .= $arProps['QUANTITY'].' шт.';
                if ($arProps['PRICE'] == '0.0000') {
                    $strOrderList .= $NoPrice;
                } else {
                    $strOrderList .= $arProps['PRICE'].' руб.';
                }
                
                if ($arProps['PRICE'] == '0.0000') {
                    $strOrderList .= $summ;
                } else {
                    $strOrderList .= $summ.' руб.';
                }
                
                
                
                if ($arProps['PRICE'] == '0.0000') {
                    $summ = 'запросить цену';
                    $OrderSumm = 'будет сформирована менеджером';
                }else{
                    $FormatedOrderSumm = sprintf("%.02f", $arProps['ORDER_PRICE']);
                    $OrderSumm = $FormatedOrderSumm . " руб.";
                }
                
                $strOrderList .= ' Итого заказ на сумму:'.$OrderSumm;
                
                
                /*end*/
                
            }
            $i++;
        }
        
        $comment = $strOrderList;
        
        $call_value = $_COOKIE['_ct_session_id']; /* ID сессии Calltouch, полученный из cookie */
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded;charset=utf-8"));
        curl_setopt($ch, CURLOPT_URL,'https://api.calltouch.ru/calls-service/RestAPI/requests/'.$ct_site_id.'/register/');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "fio=".urlencode($fio)
            ."&phoneNumber=".$phoneNumber
            ."&email=".$email
            ."&subject=".urlencode($subject)
            //."&requestNumber=".$requestNumber
            ."&requestDate=".$requestDate
            ."&requestUrl=".urlencode($requestUrl)
            ."&comment=".urlencode($strOrderList)
            ."".($call_value != 'undefined' ? "&sessionId=".$call_value : ""));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $calltouch = curl_exec ($ch);
        curl_close ($ch);
        
    /*        $arOrder = CSaleOrder::GetByID($orderID);
        $strOrderList = "";
        $dbBasketItems = CSaleBasket::GetList(
            array("NAME" => "ASC"),
            array("ORDER_ID" => $orderID),
            false,
            false,
            array("PRODUCT_ID", "ID", "NAME", "QUANTITY", "PRICE", "CURRENCY", "ORDER_PRICE", "DETAIL_PAGE_URL")
        );
        while ($arProps = $dbBasketItems->Fetch())
        {

            $summ = $arProps['QUANTITY'] * $arProps['PRICE'];
            $arProps['PRICE'] = sprintf("%.02f", $arProps['PRICE']);
            $summ = sprintf("%.02f", $summ);

            $arProps['NAME'] = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/", "", $arProps['NAME']);

            $arProps['NAME'] = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|РОМЕК|Ев|PU=S|PU=K|RU=S|RU=K|PU=К/", "", $arProps['NAME']);

            $SlicedName .= $arProps['NAME'];
            $SlicedQuantity .= $arProps['QUANTITY'];
            $arProps['DETAIL_PAGE_URL'] = 'https://'. SITE_SERVER_NAME . $arProps['DETAIL_PAGE_URL'];
            $NoPrice = 'запросить цену';
            if ($arProps['PRICE'] == '0.0000') {
                $strCustomOrderList .= "<a href =" . $arProps['DETAIL_PAGE_URL'] . "><b>"  . $arProps['NAME'] . "</b></a>" .  " в количестве " . $arProps['QUANTITY'] ." шт. - " . "<b>" . $NoPrice . "</b><br><br>";
            }else{
                $strCustomOrderList .= "<a href =" . $arProps['DETAIL_PAGE_URL'] . "><b>"  . $arProps['NAME'] . "</b></a>" . "- " . $arProps['QUANTITY'] . " шт. x " . "<b>" . $arProps['PRICE'] . "</b>" . " руб. = " . "<b>" . $summ . "</b>" . " руб." . "<br><br>";
            }
            if ($arProps['PRICE'] == '0.0000') {
                $summ = 'запросить цену';
                $OrderSumm = 'будет сформирована менеджером';
            }else{
                $FormatedOrderSumm = sprintf("%.02f", $arProps['ORDER_PRICE']);
                $OrderSumm = $FormatedOrderSumm . " руб.";
            }
        }*/

        $arOrder = CSaleOrder::GetByID($orderID);
        $strOrderList = "";
        $dbBasketItems = CSaleBasket::GetList(
            array("NAME" => "ASC"),
            array("ORDER_ID" => $orderID),
            false,
            false,
            array("PRODUCT_ID", "ID", "NAME", "QUANTITY", "PRICE", "CURRENCY", "ORDER_PRICE", "DETAIL_PAGE_URL", "CML2_ARTICLE")
            );
        $i = 1;
        while ($arProps = $dbBasketItems->Fetch())
        {
            $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'ID' => $arProps['PRODUCT_ID'], 'ACTIVE'=>'Y','CATALOG_GROUP_ID' => 2], Array("ID", "NAME", "PROPERTY_417","CATALOG_WEIGHT"));
            
            while($ar_result_in = $db_list_in->GetNext())
            {
                $res = CIBlockElement::GetProperty(18, $ar_result_in['ID'], array("sort" => "asc"), Array("CODE"=>"CML2_TRAITS"));
                while ($ob = $res->GetNext()) {
                    
                    if ($ob['DESCRIPTION'] == "Вес"){
                        $w = $ob['VALUE'];
                    }
                    
                }
                
                $summ = $arProps['QUANTITY'] * $arProps['PRICE'];
                $arProps['PRICE'] = sprintf("%.02f", $arProps['PRICE']);
                $summ = sprintf("%.02f", $summ);
                
                $weightSumm = $weightSumm + ($w * $arProps['QUANTITY'] * 1000);
                
                $arProps['NAME'] = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/", "", $arProps['NAME']);
                
                $arProps['NAME'] = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|РОМЕК|Ев|PU=S|PU=K|RU=S|RU=K|PU=К/", "", $arProps['NAME']);
                
                $SlicedName .= $arProps['NAME'];
                $SlicedQuantity .= $arProps['QUANTITY'];
                $arProps['DETAIL_PAGE_URL'] = 'https://'. SITE_SERVER_NAME . $arProps['DETAIL_PAGE_URL'];
                $NoPrice = 'запросить цену';
                
                /*start*/
                
                $strOrderList .= '<tr style="Margin: 0; padding: 0; -webkit-box-sizing: border-box; box-sizing: border-box;">';
                $strOrderList .= '<td align="center" class="t122" height="50" style="Margin: 0; padding: 0; -webkit-box-sizing: border-box; box-sizing: border-box; font-family:Roboto, sans-serif; font-weight: 700; color: #343a40; text-align: center; padding: 0px 5px; border-right: 1px solid #e5e5e5; font-size: 11px; line-height: 1.2;" valign="center" width="10">';
                $strOrderList .= $i;
                $strOrderList .= '</td>';
                $strOrderList .= '<td align="left" class="t122" height="50" style="Margin: 0; padding: 0; -webkit-box-sizing: border-box; box-sizing: border-box; font-family: Roboto, sans-serif; font-weight: 700; color: #343a40; text-align: center; padding: 0px 5px; border-right: 1px solid #e5e5e5; font-size: 11px; line-height: 1.2;" valign="center" width="70">';
                $strOrderList .= $ar_result_in['PROPERTY_417_VALUE'];
                $strOrderList .= '</td>';
                $strOrderList .= '<td align="left" class="t122" height="50" style="Margin: 0; padding: 0; -webkit-box-sizing: border-box; box-sizing: border-box; font-family: Roboto, sans-serif; font-weight: 400; color: #343a40; text-align: left; padding-left: 20px; border-right: 1px solid #e5e5e5; font-size: 11px; line-height: 1.2;" valign="center" width="360">';
                $strOrderList .= '<a href ='.$arProps['DETAIL_PAGE_URL'].'><b>';
                $strOrderList .= $arProps['NAME'];
                $strOrderList .= '</b></a>';
                $strOrderList .= '</td>';
                $strOrderList .= '<td align="left" class="t122" height="50" style="Margin: 0; padding: 0; -webkit-box-sizing: border-box; box-sizing: border-box; font-family: Roboto, sans-serif; font-weight: 400; color: #343a40; text-align: left; padding-left: 10px; border-right: 1px solid #e5e5e5; font-size: 11px; line-height: 1.2;" valign="center" width="80">';
                $strOrderList .= $arProps['QUANTITY'].' шт.';
                $strOrderList .= '</td>';
                $strOrderList .= '<td align="left" class="t122" height="50" style="Margin: 0; padding: 0; -webkit-box-sizing: border-box; box-sizing: border-box; font-family: Roboto, sans-serif; font-weight: 400; color: #343a40; text-align: left; padding-left: 10px; border-right: 1px solid #e5e5e5; font-size: 11px; line-height: 1.2;" valign="center" width="80">';
                if ($arProps['PRICE'] == '0.0000') {
                    $strOrderList .= $NoPrice;
                } else {
                    $strOrderList .= $arProps['PRICE'].' руб.';
                }
                $strOrderList .= '</td>';
                
                $strOrderList .= '<td align="left" class="t122" height="50" style="Margin: 0; padding: 0; -webkit-box-sizing: border-box; box-sizing: border-box; font-family: Roboto, sans-serif; font-weight: 400; color: #343a40; text-align: left; padding-left: 10px; border-right: 1px solid #e5e5e5; font-size: 11px; line-height: 1.2;" valign="center" width="80">';
                if ($arProps['PRICE'] == '0.0000') {
                    $strOrderList .= $summ;
                } else {
                    $strOrderList .= $summ.' руб.';
                }
                $strOrderList .= '</td>';
                
                
                if ($arProps['PRICE'] == '0.0000') {
                    $summ = 'запросить цену';
                    $OrderSumm = 'будет сформирована менеджером';
                }else{
                    $FormatedOrderSumm = sprintf("%.02f", $arProps['ORDER_PRICE']);
                    $OrderSumm = $FormatedOrderSumm . " руб.";
                }
                
                
                /*end*/
                
            }
            $i++;
        }
        
        $arFields["ORDER_TABLE_ITEMS"] = $strOrderList;
        $arFields["SLICED_ITEM_NAME"] = $SlicedName;
        $arFields["SLICED_ITEM_QUANTITY"] = $SlicedQuantity;
        $arFields["SLICED_PRICE"] = $arProps['PRICE'];
        $arFields["SLICED_ITEM_SUMM"] = $summ;
        $arFields["ORDER_SUMM"] = $OrderSumm;
        $arFields["ORDER_SUMM_WEIGHT"] = $weightSumm.' гр.';
        $arFields["ITEM_DETAIL_URL"] = $arProps['DETAIL_PAGE_URL'];
        $arFields["ORDER_DESCRIPTION"] = $arOrder["USER_DESCRIPTION"];

    }
}

// Web Form hidden params
function my_onAfterResultAddUpdate($WEB_FORM_ID, $RESULT_ID)
{

    CModule::IncludeModule("iblock") ;

    if ($WEB_FORM_ID == 10) {

        $CurrentUrl = $_SERVER["REQUEST_URI"];

        $fullUrl = 'https://'.SITE_SERVER_NAME.$CurrentUrl;
        $tags = get_meta_tags($fullUrl);
        $SectionDescription = $tags['description'];
        $SectionDescription = preg_replace("/, оптом и в розницу, в наличии и на заказ в Санкт-Петербурге и Москве, по низкой цене! Звоните!/","", $SectionDescription );


        CFormResult::SetField($RESULT_ID, 'FORM_URL', array("37" => $CurrentUrl));
        CFormResult::SetField($RESULT_ID, 'CAT_NAME', array("39" =>  $SectionDescription));
    }
}

AddEventHandler('form', 'onAfterResultAdd', 'my_onAfterResultAddUpdate');

function rewriteUrl($arItems) {
	/*
    foreach ($arItems as $key => $arItem) {
        if ($arItem["IBLOCK_SECTION_ID"]) {
            $arSections = array();
            $rsSection = CIBlockSection::GetNavChain(false, $arItem["IBLOCK_SECTION_ID"], array("DEPTH_LEVEL", "CODE"));
            while ($arRes = $rsSection->Fetch()) {
                $arSections[$arRes["DEPTH_LEVEL"]] = $arRes["CODE"];
            }
            if (!empty($arSections[2])) {
                $arItems[$key]["DETAIL_PAGE_URL"] = '/catalog/' . $arSections[2] . '/' . $arItem["CODE"].'/';
            }
        }
    }
	*/
    return $arItems;
}


function GetValidateRules($type, $req) {
    switch($type) {
        case 'NAME':
            echo "required: ".($req=="Y"?"true":"false")."\r\n";
            break;
        case 'REQUIRED':
            echo "required: ".($req=="Y"?"true":"false")."\r\n";
            break;
        case 'PHONE':
            echo "required: ".($req=="Y"?"true":"false")."\r\n";
            break;
        case 'EMAIL':
            echo "required: ".($req=="Y"?"true":"false").",\r\n";
            echo "email: {
                        required: \"We need your email address to contact you\",
                           email: \"Your email address must be in the format of name@domain.com\"
                             }";
            break;
        case 'MESSAGE':
            echo "required: ".($req=="Y"?"true":"false").",\r\n";
            break;
        default: echo "required: false\r\n";
    }
}


function GetValidateMessages($type) {
    switch($type) {
        case 'NAME':
            echo "required: 'Поле Ф.И.О. обязательно для заполнения',\r\n";
            echo "minlength: 2\r\n";
            break;
        case 'REQUIRED':
            echo "required: 'Поле обязательно для заполнения',\r\n";
            echo "minlength: 1\r\n";
            echo "maxlength: 16\r\n";
            break;
        case 'PHONE':
            echo "required: 'Поле телефон не заполнено, пример +7(999)999-99-99',\r\n";
            echo "minlength: 2\r\n";
            break;
        case 'EMAIL':
            echo "required: 'Поле email не заполнено',\r\n";
            echo "email: \"Поле email заполняется на латинице, пример: name@domain.com\"";
            break;
        case 'MESSAGE':
            echo "required: 'Поле вопросы не заполнено,\r\n";
            echo "minlength: 3\r\n";
            break;
        default: echo "required: 'Обязательное поля для заполнения'\r\n";
    }
}

/*начисляем бонусы за подписку на новости*/

AddEventHandler("subscribe", "OnStartSubscriptionAdd", "SubscribeAccountBonus");

function SubscribeAccountBonus() {
    
    global $USER;
    
    if ( $USER->IsAuthorized() )
    {
        if ($USER->GetID() == '3092') {
            
            $res = CSaleUserTransact::GetList(Array("ID" => "DESC"), array("USER_ID" => $USER->GetID(), "DESCRIPTION" => "Подписка"));
            
            $res_rows = intval($res->SelectedRowsCount());
            if ($res_rows == 0) {
                $info = "Бонус за подписку на новости на сайте traiv.ru";
                CSaleUserAccount::UpdateAccount($USER->GetID(), '20', 'TRC', 'Подписка', 'Подписка', $info);
            }
        }
    }
}

/*end начисляем бонусы за подписку на новости*/

/*начисляем бонусы за регистрацию*/

AddEventHandler("main", "OnAfterUserAdd", "MyRegAccountBonus");

function MyRegAccountBonus(&$arFields) {

    if($arFields["ID"]>0) {
        $info = "Бонус за регистрацию на сайте traiv.ru";
        CSaleUserAccount::UpdateAccount($arFields["ID"], '20', 'TRC', '', '', $info);
    }
    
}

/*end начисляем бонусы за регистрацию*/

/*добавляем бонусы*/

AddEventHandler("sale", "OnSalePayOrder", "MyUpdateAccountBonus");

function MyUpdateAccountBonus($order_id, $status) {
    global $DB;
    $koef = 1; //Какой процент начислять
    $order = CSaleOrder::GetByID($order_id);
    if($status == "Y"){
        $sumBonus = +floor(($order['PRICE'] * $koef)/120);
        $info = "Бонус за оплату заказа №$order_id";
    }
    if ($order_id > 0 && $status == 'Y' && $order['CANCELED'] == "N") { // Заказ считается оплаченным
        CSaleUserAccount::UpdateAccount($order['USER_ID'], $sumBonus, 'TRC', '', $order_id, $info);
    }
}

/*end добавляем бонусы*/

AddEventHandler("iblock", "OnPageStart", "checkGoogleCaptcha");

function checkGoogleCaptcha(&$arFields)
{
    if ( /*$arFields['IBLOCK_ID'] == 18 && */ $_REQUEST['iblock_submit']) {
        global $APPLICATION;
        if ($_REQUEST['g-recaptcha-response']) {
            $httpClient = new \Bitrix\Main\Web\HttpClient;
            $result = $httpClient->post(
                'https://www.google.com/recaptcha/api/siteverify',
                array(
                    'secret' => '6LekrNYUAAAAAKD2g0uYghJvaSTcPY4_i20QRTHz',
                    'response' => $_REQUEST['g-recaptcha-response'],
                    'remoteip' => $_SERVER['HTTP_X_REAL_IP']
                )
            );
            $result = json_decode($result, true);
            if ($result['success'] !== true) {
                $APPLICATION->throwException("Вы не прошли проверку подтверждения личности");
                return false;
            }
        } else {
            $APPLICATION->throwException("Вы не прошли проверку подтверждения личности");
            return false;
        }
    }
}

function otAgent()
{
    //mail("dmitrii.kozlov@traiv.ru","Test","$date\r\nВерсия PHP ".  $arOrder["USER_ID"] . "\r\nТестовое письмо!");
    
    $db_list = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 18, 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y'], false,array('UF_*'));
    while($ar_result = $db_list->GetNext())
    {
        $db_list_in = CIBlockElement::GetList(array("CATALOG_PRICE_2"=>"ASC"), ['IBLOCK_ID' => 18, 'SECTION_ID' => $ar_result['ID'], 'ACTIVE'=>'Y', ">CATALOG_PRICE_2" => 0], false,Array("nTopCount" => 1));
        
        while($ar_result_in = $db_list_in->GetNext())
        {
            
            if (!empty($ar_result_in['CATALOG_PRICE_2']) && empty($ar_result['UF_FROM_PRICE'])){
                $bs = new CIBlockSection;
                $bs->Update($ar_result['ID'], array('UF_FROM_PRICE' => 'от '.$ar_result_in['CATALOG_PRICE_2'].' руб.'));
            }
        }
        
    }
    
    return "otAgent();";
}

function shtAgent()
{
    $db_list = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 18, 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y'], false,array('UF_*'));
    while($ar_result = $db_list->GetNext())
    {
        $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'SECTION_ID' => $ar_result['ID'], 'ACTIVE'=>'Y'], false,Array());
        if ($db_list_in->SelectedRowsCount() > 0 && empty($ar_result['UF_KOLVO_SHT'])){

            $bs = new CIBlockSection;
            $bs->Update($ar_result['ID'], array('UF_KOLVO_SHT' => $db_list_in->SelectedRowsCount().' шт.'));
        }
    }
    
    return "shtAgent();";
}

function pluralForm($n, $form1, $form2, $form5) {
    $n = abs($n) % 100;
    $n1 = $n % 10;
    if ($n > 10 && $n < 20) return $form5;
    if ($n1 > 1 && $n1 < 5) return $form2;
    if ($n1 == 1) return $form1;
    return $form5;
}

function month2char($mname){
    
    if ($mname == '01'){
        $mname_true = "янв";
    }
    else if ($mname == '02'){
        $mname_true = "фев";
    }
    else if ($mname == '03'){
        $mname_true = "мар";
    }
    else if ($mname == '04'){
        $mname_true = "апр";
    }
    else if ($mname == '05'){
        $mname_true = "май";
    }
    else if ($mname == '06'){
        $mname_true = "июн";
    }
    else if ($mname == '07'){
        $mname_true = "июл";
    }
    else if ($mname == '08'){
        $mname_true = "авг";
    }
    else if ($mname == '09'){
        $mname_true = "сен";
    }
    else if ($mname == '10'){
        $mname_true = "окт";
    }
    else if ($mname == '11'){
        $mname_true = "ноя";
    }
    else if ($mname == '12'){
        $mname_true = "дек";
    }
    return $mname_true;
}

?>