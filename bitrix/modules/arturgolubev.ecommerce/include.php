<?
use \Arturgolubev\Ecommerce\Tools as Tools;
use \Arturgolubev\Ecommerce\Unitools as UTools;

Class CArturgolubevEcommerce 
{
	const MODULE_ID = 'arturgolubev.ecommerce';
	var $MODULE_ID = 'arturgolubev.ecommerce'; 
	
	const SESS = 'AG_ECOMMERCE';
	
	static function toDbLog($id, $description){
		\CEventLog::Add(array(
			"SEVERITY" => "DEBUG",
			"AUDIT_TYPE_ID" => "AGEC_INFORMATION",
			"MODULE_ID" => self::MODULE_ID,
			"ITEM_ID" => $id,
			"DESCRIPTION" => $description,
		));
	}
	
	// f
	static function convertCurrencyBasket($proudctsArray){
		if(is_array($proudctsArray))
		{
			$convCurrency = UTools::getSiteSetting("convert_currency");
			if($convCurrency && CModule::IncludeModule('currency'))
			{
				foreach($proudctsArray as $k=>$basket){
					if($basket["CURRENCY"] == $convCurrency) continue;
					
					$proudctsArray[$k]["PRICE"] = round(CCurrencyRates::ConvertCurrency($basket["PRICE"], $basket["CURRENCY"], $convCurrency), 2);
					$proudctsArray[$k]["CURRENCY"] = $convCurrency;
				}
			}
		}
		
		return $proudctsArray;
	}
	
	static function _makeJsBasketString($arBasket){
		$s = '';
		
		if(is_array($arBasket) && !empty($arBasket))
		{
			foreach($arBasket as $arItem){
				if($s) $s .= ', ';
				$s .= '{';
					$s .= '"id": "'.$arItem["ID"].'",';
					$s .= '"name": "'.$arItem["NAME"].'",';
					$s .= '"price": '.($arItem["PRICE"]*1).',';
					$s .= '"category": "'.$arItem["SECTION_NAME"].'",';
					if($arItem["QUANTITY"])
						$s .= '"quantity": "'.($arItem["QUANTITY"]*1).'",';
					$s .= '"brand": "'.$arItem["BRAND"].'",';
					if(!empty($arItem["PROPS_VALUE"]))
						$s .= '"variant": "'.implode('/', $arItem["PROPS_VALUE"]).'",';
				$s .= '}';
			}
		}
		
		return $s;
	}
	
	// p
	static function ProtectEpilogStart(){
		if (UTools::checkStatus() && !Tools::checkDisable()){
			CJSCore::Init(array('ajax'));
			
			$mode = UTools::getSetting('request_mode');
			
			if(!defined("LOCK_ECOMMERCE_REQUESTS")){
				if($mode == 'events'){
					UTools::addJs("/bitrix/js/arturgolubev.ecommerce/script_event_mode.js");
				}elseif($mode == 'noajax'){
					UTools::addJs("/bitrix/js/arturgolubev.ecommerce/script_noajax_mode.js");
				}else{
					if(!Tools::isOrderPage()){
						UTools::addJs("/bitrix/js/arturgolubev.ecommerce/script_v2.js");
					}
				}
			}
			
			if($mode != 'events' || defined("LOCK_ECOMMERCE_REQUESTS")){
				self::getScriptBeginingCheckout();
			
				ob_start();
				Tools::incFooterComponent();
				$tmp = ob_get_contents();
				
				UTools::setStorage('scripts', 'epilog_check', $tmp);
				ob_end_clean();
			}
		}
	}
	
	static function onBufferContent(&$bufferContent){
		if (UTools::checkStatus() && !Tools::checkDisable()){
			$epilog_check = UTools::getStorage("scripts", "epilog_check");
			if($epilog_check)
			{
				$bufferContent = UTools::addBodyScript($epilog_check, $bufferContent);
			}
		}
	}
	
	// s
	static function onOrderAdd($orderId, $arFields){
		if(!Tools::checkDisable()){
			$_SESSION["AG_ECOMMERCE"]["ORDERS_TO_SEND"][$orderId] = $orderId;
		}
	}
	static function onBasketAdd($basketID, $arFields){
		if(!Tools::checkDisable() && !$arFields["ORDER_ID"]){
			$productInfo = self::getBasketProductInfo($basketID, $arFields); 
			$_SESSION["AG_ECOMMERCE"]["ADD_TO_BASKET"][$basketID] = $productInfo;
		}
	}
	static function onBasketDelete($ID){
		if(!Tools::checkDisable()){
			$productInfo = self::getBasketProductInfo($ID); 
			$_SESSION["AG_ECOMMERCE"]["DELETE_FROM_BASKET"][$ID] = $productInfo;
		}
	}
	
	// d
	static function getProductInfo($productId){
		if(Tools::checkDisable()) return false;
		if(!CModule::IncludeModule("iblock") || !$productId) return false;
		
		$item = array(
			"ID" => $productId
		);
		
		$res = CIBlockElement::GetList(Array(), Array("ID"=>$productId), false, Array("nPageSize"=>1), Array("ID", "NAME", "IBLOCK_ID", "SECTION_ID", "IBLOCK_SECTION_ID"));
		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$arFields["PROPERTIES"] = $ob->GetProperties();
			
			if($arFields["IBLOCK_SECTION_ID"])
				$intSectionID = $arFields["IBLOCK_SECTION_ID"];
			
			$item["NAME"] = $arFields["NAME"];
			$item["IBLOCK_SECTION_ID"] =  $arFields["IBLOCK_SECTION_ID"];
			
			$val = UTools::getSetting('BRAND_PROPERTY_'.$arFields["IBLOCK_ID"]);
			if($val)
			{
				foreach($arFields["PROPERTIES"] as $arProp)
				{
					if($val == $arProp["ID"])
					{
						$tmp = \CIBlockFormatProperties::GetDisplayValue($arFields, $arProp, 'evt1');
						if($tmp["DISPLAY_VALUE"])
						{
							if(is_array($tmp["DISPLAY_VALUE"]))
								$item["BRAND"] = strip_tags(implode('/',$tmp["DISPLAY_VALUE"]));
							else
								$item["BRAND"] = strip_tags($tmp["DISPLAY_VALUE"]);
						}
					}
				}
			}
			
			if($intSectionID)
			{
				$nav = CIBlockSection::GetNavChain(false, $intSectionID);
				while($pathFields = $nav->Fetch()){
					$item["SECTION_NAME"] .= ($item["SECTION_NAME"] != '') ? ' / ' : '';
					$item["SECTION_NAME"] .= $pathFields["NAME"];
				}
			}
		}
		
		foreach($item as $k=>$v){
			$item[$k] = UTools::textSafeMode($v, 1);
		}
		
		return $item;
	}
	
	static function getBasketProductInfo($basketId, $arFields = array()){
		if(!CModule::IncludeModule("iblock") || !CModule::IncludeModule("catalog") || !CModule::IncludeModule("sale")) return false;
		if(!$basketId) return false;
		
		if(empty($arFields)){
			$arFields = CSaleBasket::GetByID($basketId);
		}
		
		$mxResult = CCatalogSku::GetProductInfo($arFields["PRODUCT_ID"]);
		if($mxResult)
		{
			$productInfo = self::getProductInfo($mxResult['ID']);
			
			$skuInfo = self::getProductInfo($arFields["PRODUCT_ID"]);
			$productInfo["ID"] = $skuInfo["ID"];
			$productInfo["NAME"] = $skuInfo["NAME"];
		}
		else
		{
			$productInfo = self::getProductInfo($arFields["PRODUCT_ID"]);
		}
		
		if(!$productInfo["NAME"])
			$productInfo["NAME"] = $arFields["NAME"];
		
		if(!$arFields["ORDER_ID"]){
			$arOptimalPrice = CCatalogProduct::GetOptimalPrice($arFields["PRODUCT_ID"]);
			$arFields["CURRENCY"] = ($arOptimalPrice["RESULT_PRICE"]["CURRENCY"]) ? $arOptimalPrice["RESULT_PRICE"]["CURRENCY"] : $arOptimalPrice["PRICE"]["CURRENCY"];
			$arFields["PRICE"] = ($arOptimalPrice["RESULT_PRICE"]["DISCOUNT_PRICE"]) ? $arOptimalPrice["RESULT_PRICE"]["DISCOUNT_PRICE"] : $arOptimalPrice["PRICE"]["PRICE"];
		}
		
		$productInfo["PRICE"] = $arFields["PRICE"];
		$productInfo["CURRENCY"] = $arFields["CURRENCY"];
		$productInfo["QUANTITY"] = ($arFields["QUANTITY"]) ? $arFields["QUANTITY"] : '1';
		
		if(empty($arFields["PROPS"]))
		{
			$dbProps = CSaleBasket::GetPropsList(array(), array("BASKET_ID" => $basketId));
			while ($arPropsFields = $dbProps->Fetch())
			{
				$arFields["PROPS"][] = $arPropsFields;
			}
		}
		
		if(!empty($arFields["PROPS"]))
		{
			foreach($arFields["PROPS"] as $arPropsFields)
			{
				if($arPropsFields["CODE"] != 'CATALOG.XML_ID' && $arPropsFields["CODE"] != 'PRODUCT.XML_ID'){
					$productInfo["PROPS_VALUE"][] = UTools::textSafeMode($arPropsFields["VALUE"], 1);
				}
			}
		}
		
		return $productInfo;
	}
	
	// c
	static function checkReadyEvents(){
		if(Tools::checkDisable()) return false;
			
		$structure = array(
			array("SESSION_PARAM" => "ADD_TO_BASKET", "COOKIE_PARAM" => "EC_ADD_FOR_"),
			array("SESSION_PARAM" => "DELETE_FROM_BASKET", "COOKIE_PARAM" => "EC_RM_FOR_"),
			array("SESSION_PARAM" => "ORDERS_TO_SEND", "COOKIE_PARAM" => "EC_SHOW_FOR_"),
		);
		
		foreach($structure as $arParams)
		{
			if(!empty($_SESSION["AG_ECOMMERCE"][$arParams["SESSION_PARAM"]]))
			{
				foreach($_SESSION["AG_ECOMMERCE"][$arParams["SESSION_PARAM"]] as $key=>$val)
				{
					$cookieName = $arParams["COOKIE_PARAM"].$key;
					if($_COOKIE[$cookieName] == 'Y')
					{
						setcookie($cookieName, "", time()-1000, "/");
						unset($_SESSION["AG_ECOMMERCE"][$arParams["SESSION_PARAM"]][$key]);
					}
				}
			}
		}
		
		$cacheScripts = UTools::getStorage("scripts", "move_footer");
		
		$actionScript = '';
		if(!$actionScript) $actionScript .= self::getScriptForNewOrder($_SESSION["AG_ECOMMERCE"]["ORDERS_TO_SEND"]);
		if(!$actionScript) $actionScript .= self::getScriptForAddProducts($_SESSION["AG_ECOMMERCE"]["ADD_TO_BASKET"], 'add');
		if(!$actionScript) $actionScript .= self::getScriptForAddProducts($_SESSION["AG_ECOMMERCE"]["DELETE_FROM_BASKET"], 'remove');
		
		return $cacheScripts.$actionScript;
	}
	
	// g
	static function getScriptForNewOrder($arOrders){
		if(empty($arOrders)) return false;
		if(!CModule::IncludeModule("iblock") || !CModule::IncludeModule("catalog") || !CModule::IncludeModule("sale")) return false;
		
		foreach($arOrders as $id){
			$orderId = $id;
			break;
		}
		
		$cookieName = "EC_SHOW_FOR_".$orderId;
		$containerName = UTools::getSiteSetting('container', 'dataLayer');
		$get_order_id_from = UTools::getSetting('get_order_id_from', 'ID');
		
		$cookie = ''; $yandex = ''; $google = ''; $fb = '';
		
		$order = array(
			"ID" => $orderId,
		);
		
		$rsSales = CSaleOrder::GetList(array(), array("ID" => $order["ID"]), false, false, array("BASKET_DISCOUNT_COUPON", "*"));
		if($arSales = $rsSales->Fetch()){
			$order["FIELDS"] = $arSales;
		}
		
		if($order["FIELDS"]){
			$orderNum = UTools::textSafeMode($order["FIELDS"][$get_order_id_from], 1);
			
			$dbBasketItems = CSaleBasket::GetList(array("ID" => "ASC"), array("ORDER_ID" => $order["FIELDS"]["ID"]), false, false, array("*"));
			while ($arItems = $dbBasketItems->Fetch()){
				$productInfo = self::getBasketProductInfo($arItems["ID"], $arItems); 
				$order["ORDER_BASKET"][] = $productInfo;
			}
			
			$order["ORDER_BASKET"] = self::convertCurrencyBasket($order["ORDER_BASKET"]);
			foreach($order["ORDER_BASKET"] as $basket){
				$currency = $basket["CURRENCY"]; break;
			}
			
			if($order["FIELDS"]["CURRENCY"] != $currency)
			{
				$order["FIELDS"]["PRICE"] = round(CCurrencyRates::ConvertCurrency($order["FIELDS"]["PRICE"], $order["FIELDS"]["CURRENCY"], $currency), 2);
				$order["FIELDS"]["TAX_VALUE"] = round(CCurrencyRates::ConvertCurrency($order["FIELDS"]["TAX_VALUE"], $order["FIELDS"]["CURRENCY"], $currency), 2);
				$order["FIELDS"]["PRICE_DELIVERY"] = round(CCurrencyRates::ConvertCurrency($order["FIELDS"]["PRICE_DELIVERY"], $order["FIELDS"]["CURRENCY"], $currency), 2);
				
				$order["FIELDS"]["CURRENCY"] = $currency;
			}
			
			$productsJsString = self::_makeJsBasketString($order["ORDER_BASKET"]);
			
			$cookie .= 'var expires = new Date((new Date).getTime() + (1000*60*60*24)); ';
			$cookie .= 'var cookie_string = "'.$cookieName.'" + "=" + escape("Y"); ';
			$cookie .= 'cookie_string += "; expires=" + expires.toUTCString(); ';
			$cookie .= 'cookie_string += "; path=" + escape ("/"); ';
			$cookie .= 'document.cookie = cookie_string; ';
			
			if(UTools::getSetting('debug') == 'Y')
				$cookie .= 'console.log("setCookie: " + cookie_string); ';
				
			$baseLayer = 'var agec_order_base = {';
				$baseLayer .= '"ecommerce": {';
					$baseLayer .= '"currencyCode": "'.$order["FIELDS"]["CURRENCY"].'",';
					$baseLayer .= '"purchase": {';
						$baseLayer .= '"actionField": {';
							$baseLayer .= '"id" : "'.$orderNum.'",';
							$baseLayer .= '"revenue" : "'.($order["FIELDS"]["PRICE"]*1).'",';
							$baseLayer .= '"coupon" : "'.($order["FIELDS"]["BASKET_DISCOUNT_COUPON"]).'",'; 
							
							if(IntVal(UTools::getSiteSetting('yandex_target_order')) > 0)
								$baseLayer .= '"goal_id" : "'.IntVal(UTools::getSiteSetting('yandex_target_order')).'",'; 
						
						$baseLayer .= '},';
						$baseLayer .= '"products": ['.$productsJsString.']';
					$baseLayer .= '}';
				$baseLayer .= '}';
			$baseLayer .= '};';
			
			if(UTools::getSiteSetting("ya_off") != 'Y'){
				$yandex .= 'window.'.$containerName.' = window.'.$containerName.' || [];';
				$yandex .= 'window.'.$containerName.'.push(agec_order_base);';
				
				if(UTools::getSetting('debug') == 'Y'){
					$yandex .= 'console.log("EC order: yandex - purchase", agec_order_base.ecommerce);';
				}
			}
			
			if(UTools::getSiteSetting("ga_off") != 'Y'){
				if($containerName != 'dataLayer' || UTools::getSiteSetting("ya_off") == 'Y'){
					$google .= 'window.dataLayer = window.dataLayer || []; ';
					$google .= 'window.dataLayer.push(agec_order_base);';
				}
				
				$google .= 'if (typeof gtag != "function") {function gtag(){dataLayer.push(arguments);}};';
				$google .= 'try {';
					$google .= 'var agec_order_gtag = {';
						$google .= "'id' : '".$orderNum."',";
						$google .= "'transaction_id' : '".$orderNum."',";
						$google .= "'affiliation' : '".SITE_SERVER_NAME."',";
						$google .= "'value' : '".($order["FIELDS"]["PRICE"]*1)."',";
						$google .= "'tax' : '".($order["FIELDS"]["TAX_VALUE"]*1)."',";
						$google .= "'shipping' : '".($order["FIELDS"]["PRICE_DELIVERY"]*1)."',";
						$google .= "'coupon' : '".($order["FIELDS"]["BASKET_DISCOUNT_COUPON"])."',"; 
						$google .= "'currency' : '".$order["FIELDS"]["CURRENCY"]."',"; 
						$google .= '"items": ['.$productsJsString.']';
					$google .= '};';
					
					if(UTools::getSetting('debug') == 'Y')
					{
						$google .= 'console.log("EC order: google - purchase", agec_order_gtag);';
					}
				
					$google .= 'gtag("event", "purchase", agec_order_gtag);';
				$google .= '}catch(err){console.log("EC Warning: gtag() not function");}';
			}
			
			if(UTools::getSiteSetting("fb_off") != 'Y'){
				$ids = array();
				$value = 0;
				$productsFb = '';
				
				foreach($order["ORDER_BASKET"] as $item){
					$ids[] = $item["ID"];
					$currency = $item["CURRENCY"];
					$value += $item["PRICE"]*$item["QUANTITY"];
					
					if($productsFb) $productsFb .= ', ';
					$productsFb .= '{';
						$productsFb .= '"id": "'.$item["ID"].'",';
						$productsFb .= '"quantity": "'.$item["QUANTITY"].'",';
					$productsFb .= '}';
				}
				
				$fb .= 'var agec_order_fb = {';
					$fb .= '"content_ids": '.'['.'"'.implode('","', $ids).'"'.']'.',';
					$fb .= '"content_type": "product",';
					$fb .= '"currency": "'.$currency.'",';
					$fb .= '"value": "'.$value.'",';
					$fb .= '"contents": ['.$productsFb.'],';
					$fb .= '"num_items": "'.count($ids).'",';
				$fb .= '};';
				
				if(UTools::getSetting('debug') == 'Y')
				{
					$fb .= 'console.log("EC order: facebook - Purchase", agec_order_fb);';
				}
				
				$fb .= 'window.fbqCheckerCount = window.fbqCheckerCount || 0; ';
				$fb .= 'if(typeof fbqChecker != "function"){function fbqChecker(a, b){window.fbqCheckerCount = window.fbqCheckerCount + 1; try {fbq("track", a, b);}catch(err){if(window.fbqCheckerCount < 10){setTimeout(function(){fbqChecker(a, b);}, 1000);}}}};';
				$fb .= 'fbqChecker("Purchase", agec_order_fb);';
			}
			
			$fullScript = $cookie.$baseLayer.$yandex.$google.$fb;
			$fullScript = str_replace(array("\r\n", "\r", "\n"), '',  $fullScript);
			
			return $fullScript;
		}
	}
	
	static function getDetailCode($productId, $offersProps = array()){
		if(Tools::checkDisable() || !$productId) return false;
		if(!CModule::IncludeModule("iblock") || !CModule::IncludeModule("catalog")) return false;
		
		$yandex = ''; $google = ''; $fb = '';
		
		$arData = array();
		$containerName = UTools::getSiteSetting('container', 'dataLayer');
		
		$arData["PRODUCT"] = self::getProductInfo($productId);
		
		$res = CCatalogSKU::getOffersList($productId);
		$arOfferIDs = $res[$productId];
		if(!empty($arOfferIDs))
		{
			$firstElement = current($arOfferIDs);
			
			$arSelect = Array("ID", "NAME");
			
			foreach($offersProps as $prop)
				$arSelect[] = "PROPERTY_".$prop;;
			
			$arFilter = Array("ID"=>array_keys($arOfferIDs), "IBLOCK_ID"=>$firstElement["IBLOCK_ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();
				
				$arFields["PROPS_VALUE"] = array();
				foreach($offersProps as $prop)
					if($arFields["PROPERTY_".$prop."_VALUE"])
						$arFields["PROPS_VALUE"][] = UTools::textSafeMode($arFields["PROPERTY_".$prop."_VALUE"], 1);
				
				$arOptimalPrice = CCatalogProduct::GetOptimalPrice($arFields["ID"]);
				if(!empty($arOptimalPrice))
				{
					$tp = ($arOptimalPrice["RESULT_PRICE"]["DISCOUNT_PRICE"]) ? $arOptimalPrice["RESULT_PRICE"]["DISCOUNT_PRICE"] : $arOptimalPrice["PRICE"]["PRICE"];
					$tc = ($arOptimalPrice["RESULT_PRICE"]["CURRENCY"]) ? $arOptimalPrice["RESULT_PRICE"]["CURRENCY"] : $arOptimalPrice["PRICE"]["CURRENCY"];
					
					$arData["ITEMS"][$arFields["ID"]] = array(
						"ID" => $arFields["ID"],
						"NAME" => UTools::textSafeMode($arFields["NAME"], 1),
						"SECTION_NAME" => $arData["PRODUCT"]["SECTION_NAME"],
						"BRAND" => $arData["PRODUCT"]["BRAND"],
						"CURRENCY" => $tc,
						"PRICE" => $tp,
						"PROPS_VALUE" => $arFields["PROPS_VALUE"],
					);
				}
			}
		}
		else
		{
			$arOptimalPrice = CCatalogProduct::GetOptimalPrice($productId);
			if(!empty($arOptimalPrice))
			{
				$tp = ($arOptimalPrice["RESULT_PRICE"]["DISCOUNT_PRICE"]) ? $arOptimalPrice["RESULT_PRICE"]["DISCOUNT_PRICE"] : $arOptimalPrice["PRICE"]["PRICE"];
				$tc = ($arOptimalPrice["RESULT_PRICE"]["CURRENCY"]) ? $arOptimalPrice["RESULT_PRICE"]["CURRENCY"] : $arOptimalPrice["PRICE"]["CURRENCY"];
				
				$arData["ITEMS"][$productId] = array(
					"ID" => $productId,
					"NAME" => $arData["PRODUCT"]["NAME"],
					"SECTION_NAME" => $arData["PRODUCT"]["SECTION_NAME"],
					"BRAND" => $arData["PRODUCT"]["BRAND"],
					"CURRENCY" => $tc,
					"PRICE" => $tp,
				);
			}
		}
		
		if(!empty($arData["ITEMS"]))
		{
			$arData["ITEMS"] = self::convertCurrencyBasket($arData["ITEMS"]);
			
			foreach($arData["ITEMS"] as $basket){
				$currency = $basket["CURRENCY"]; break;
			}
			
			$productsJsString = self::_makeJsBasketString($arData["ITEMS"]);
			
			$baseLayer = 'var agec_detail_base = {';
				$baseLayer .= '"ecommerce": {';
					$baseLayer .= '"currencyCode": "'.$currency.'",';
					$baseLayer .= '"detail": {"products": ['.$productsJsString.']}';
				$baseLayer .= '}';
			$baseLayer .= '};';
			
			if(UTools::getSiteSetting("ya_off") != 'Y'){
				$yandex .= 'window.'.$containerName.' = window.'.$containerName.' || [];';
				$yandex .= 'window.'.$containerName.'.push(agec_detail_base);';
				
				if(UTools::getSetting('debug') == 'Y'){
					$yandex .= 'console.log("EC detail: yandex - detail", agec_detail_base.ecommerce); ';
				}
			}
			
			if(UTools::getSiteSetting("ga_off") != 'Y'){
				if($containerName != 'dataLayer' || UTools::getSiteSetting("ya_off") == 'Y'){
					$google .= 'window.dataLayer = window.dataLayer || []; ';
					$google .= 'window.dataLayer.push(agec_detail_base);';
				}
				$google .= 'if (typeof gtag != "function") {function gtag(){dataLayer.push(arguments);}};';
				$google .= 'try {';
					$google .= "var agec_detail_gtag = {'items': [".$productsJsString."]};";
					$google .= "gtag('event', 'view_item', agec_detail_gtag);";
					
					if(UTools::getSetting('debug') == 'Y'){
						$google .= 'console.log("EC detail: google - view_item", agec_detail_gtag);';
					}
				$google .= '}catch(err){console.log("EC Warning: gtag() not function");}';
			}
			
			if(UTools::getSiteSetting("fb_off") != 'Y'){
				$cItem = current($arData["ITEMS"]);
				
				$fb .= 'var agec_detail_fb = {';
					$fb .= '"content_ids": ["'.implode('","', array_keys($arData["ITEMS"])).'"],';
					$fb .= '"content_category": "'.$cItem["SECTION_NAME"].'",';
					$fb .= '"content_name": "'.$cItem["NAME"].'",';
					$fb .= '"content_type": "product",';
					$fb .= '"currency": "'.$cItem["CURRENCY"].'",';
					$fb .= '"value": "'.$cItem["PRICE"].'",';
				$fb .= '};';
				
				if(UTools::getSetting('debug') == 'Y')
				{
					$fb .= 'console.log("EC detail: facebook - ViewContent", agec_detail_fb);';
				}
				
				$fb .= 'window.fbqCheckerCount = window.fbqCheckerCount || 0; ';
				$fb .= 'if(typeof fbqChecker != "function"){function fbqChecker(a, b){window.fbqCheckerCount = window.fbqCheckerCount + 1; try {fbq("track", a, b);}catch(err){if(window.fbqCheckerCount < 10){setTimeout(function(){fbqChecker(a, b);}, 1000);}}}};';
				$fb .= 'fbqChecker("ViewContent", agec_detail_fb);';
			}
			
			$result = $baseLayer.$yandex.$google.$fb;
		}
		
		return $result;
	}
	
	static function getScriptForAddProducts($proudctsArray, $type){
		if(empty($proudctsArray)) return false;
		
		$cookie = ''; $yandex = ''; $google = ''; $fb = '';
		$containerName = UTools::getSiteSetting('container', 'dataLayer');
		
		foreach($proudctsArray as $key=>$val)
		{
			$cookieName = ($type == 'add') ? "EC_ADD_FOR_".$key : "EC_RM_FOR_".$key;
			
			$cookie .= 'var expires = new Date((new Date).getTime() + (1000*60*60*24)); ';
			$cookie .= 'var cookie_string = "'.$cookieName.'" + "=" + escape("Y"); ';
			$cookie .= 'cookie_string += "; expires=" + expires.toUTCString(); ';
			$cookie .= 'cookie_string += "; path=" + escape ("/"); ';
			$cookie .= 'document.cookie = cookie_string; ';
			
			if(UTools::getSetting('debug') == 'Y')
				$cookie .= 'console.log("setCookie: " + cookie_string); ';
		}
		
		$proudctsArray = self::convertCurrencyBasket($proudctsArray);
		
		foreach($proudctsArray as $basket){
			$currency = $basket["CURRENCY"]; break;
		}
		
		$productsJsString = self::_makeJsBasketString($proudctsArray);
		
		$baseLayer = 'var agec_add_base = {';
			$baseLayer .= '"ecommerce": {';
				$baseLayer .= '"currencyCode": "'.$currency.'",';
				$baseLayer .= '"'.$type.'": {"products": ['.$productsJsString.']}';
			$baseLayer .= '}';
		$baseLayer .= '}; ';
		
		if(UTools::getSiteSetting("ya_off") != 'Y'){
			$yandex .= 'window.'.$containerName.' = window.'.$containerName.' || []; ';
			$yandex .= 'window.'.$containerName.'.push(agec_add_base);';
			
			if(UTools::getSetting('debug') == 'Y'){
				$yandex .= 'console.log("EC basket: yandex - '.$type.'", agec_add_base.ecommerce); ';
			}
		}
		
		if(UTools::getSiteSetting("ga_off") != 'Y'){
			if($containerName != 'dataLayer' || UTools::getSiteSetting("ya_off") == 'Y'){
				$google .= 'window.dataLayer = window.dataLayer || []; ';
				$google .= 'window.dataLayer.push(agec_add_base);';
			}
			
			$google .= 'if (typeof gtag != "function") {function gtag(){dataLayer.push(arguments);}};';
			$google .= 'try {';
				$tmp = ($type == 'add') ? 'add_to_cart' : 'remove_from_cart';
				
				$google .= "var agec_add_gtag = {'items': [".$productsJsString."]};";
				$google .= "gtag('event', '".$tmp."', agec_add_gtag);";
				
				if(UTools::getSetting('debug') == 'Y')
				{
					$google .= 'console.log("EC basket: google - '.$tmp.'", agec_add_gtag); ';
				}
			$google .= '}catch(err){console.log("EC Warning: gtag() not function");}';
		}
		
		if(UTools::getSiteSetting("fb_off") != 'Y' && $type == 'add'){
			foreach($proudctsArray as $arItem){
				$fb .= 'var agec_add_fb = {';
					$fb .= '"content_name": "'.$arItem["NAME"].'",';
					$fb .= '"content_ids": ["'.$arItem["ID"].'"],';
					$fb .= '"content_type": "product",';
					$fb .= '"currency": "'.$arItem["CURRENCY"].'",';
					$fb .= '"value": "'.$arItem["PRICE"].'",'; 
					$fb .= '"contents": [{"id": "'.$arItem["ID"].'", "quantity": "'.$arItem["QUANTITY"].'"}],';
				$fb .= '};';
				
				if(UTools::getSetting('debug') == 'Y'){
					$fb .= 'console.log("EC basket: facebook - AddToCart", agec_add_fb);';
				}
				
				$fb .= 'window.fbqCheckerCount = window.fbqCheckerCount || 0; ';
				$fb .= 'if(typeof fbqChecker != "function"){function fbqChecker(a, b){window.fbqCheckerCount = window.fbqCheckerCount + 1; try {fbq("track", a, b);}catch(err){if(window.fbqCheckerCount < 10){setTimeout(function(){fbqChecker(a, b);}, 1000);}}}};';
				$fb .= 'fbqChecker("AddToCart", agec_add_fb);';
			}
		}
		
		$fullScript = $cookie.$baseLayer.$yandex.$google.$fb;
		$fullScript = str_replace(array("\r\n", "\r", "\n"), '',  $fullScript);
		
		return $fullScript;
	}
	
	static function getScriptBeginingCheckout($page = ''){
		if(!Tools::isOrderPage($page)) return false;
		if(!CModule::IncludeModule("iblock") || !CModule::IncludeModule("catalog") || !CModule::IncludeModule("sale")) return false;
		
		$dbBasketItems = CSaleBasket::GetList(array("ID" => "ASC"), array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "CAN_BUY" => "Y", "DELAY" => "N", "ORDER_ID" => "NULL"), false, false, array("*"));
		while ($arItems = $dbBasketItems->Fetch())
		{
			$productInfo = self::getBasketProductInfo($arItems["ID"], $arItems); 
			$arData["ORDER_BASKET"][] = $productInfo;
		}
		
		if(!empty($arData["ORDER_BASKET"]))
		{
			$arData["ORDER_BASKET"] = self::convertCurrencyBasket($arData["ORDER_BASKET"]);
			
			$currency = $arData["ORDER_BASKET"][0]["CURRENCY"];
			
			$google = ''; $fb = '';
			
			if(UTools::getSiteSetting("ga_off") != 'Y'){
				$productsJsString = self::_makeJsBasketString($arData["ORDER_BASKET"]);
				
				$google .= 'window.dataLayer = window.dataLayer || []; ';
				$google .= 'var agec_checkout_gtm = {';
					$google .= '"ecommerce": {';
						$google .= '"event": "begin_checkout",';
						$google .= '"currencyCode": "'.$currency.'",';
						$google .= '"checkout": {"products": ['.$productsJsString.']}';
					$google .= '}';
				$google .= '}; ';
				$google .= 'window.dataLayer.push(agec_checkout_gtm); ';
				
				$google .= 'var agec_checkout_gtag = {"items": ['.$productsJsString.']}; ';
				
				if(UTools::getSetting('debug') == 'Y'){
					$google .= 'console.log("EC cart: google - begin_checkout", agec_checkout_gtag); ';
				}
				
				$google .= 'if (typeof gtag != "function") {function gtag(){dataLayer.push(arguments);}}; ';
				$google .= 'try { gtag("event", "begin_checkout", agec_checkout_gtag); } catch(err) { console.log("EC Warning: gtag() not function"); }; ';
			}
			
			if(UTools::getSiteSetting("fb_off") != 'Y'){
				$fb_ids = array();
				$fb_value = 0;
				$fb_contents = '';
				
				foreach($arData["ORDER_BASKET"] as $item){
					$fb_ids[] = $item["ID"];
					$fb_value += $item["PRICE"]*$item["QUANTITY"];
					
					if($fb_contents) $fb_contents .= ',';
					$fb_contents .= '{"id": "'.$item["ID"].'", "quantity": "'.$item["QUANTITY"].'"}';
				}
				
				$fb .= 'var agec_checkout_fb = {';
					$fb .= '"content_ids": ["'.implode('","', $fb_ids).'"],';
					$fb .= '"currency": "'.$currency.'",';
					$fb .= '"content_type": "product",';
					$fb .= '"value": "'.$fb_value.'",';
					$fb .= '"num_items": "'.count($fb_ids).'",';
					$fb .= '"contents": ['.$fb_contents.'],';
				$fb .= '};';
				
				if(UTools::getSetting('debug') == 'Y'){
					$fb .= 'console.log("EC cart: facebook - InitiateCheckout", agec_checkout_fb);';
				}
				
				$fb .= 'window.fbqCheckerCount = window.fbqCheckerCount || 0; ';
				$fb .= 'if(typeof fbqChecker != "function"){function fbqChecker(a, b){window.fbqCheckerCount = window.fbqCheckerCount + 1; try {fbq("track", a, b);}catch(err){if(window.fbqCheckerCount < 10){setTimeout(function(){fbqChecker(a, b);}, 1000);}}}};';
				$fb .= 'fbqChecker("InitiateCheckout", agec_checkout_fb);';
			}
			
			Tools::addScriptToHead($google.$fb);
		}
	}
}
?>