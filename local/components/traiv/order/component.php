<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
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

        $measureData = array_shift(\Bitrix\Catalog\MeasureRatioTable::getCurrentRatio($arItems["PRODUCT_ID"]));

        if ($measureData == 1):
            $res = CIBlockElement::GetProperty(18, $arItems["PRODUCT_ID"], array(), Array("CODE"=>"KRATNOST_UPAKOVKI"));
            if ($ob = $res->GetNext()){$krat = $ob['VALUE'];}
            $krat > 1 && $measureData = $krat;
        endif;

        $arBasketItems[] = array(
            "ID" => $arItems["ID"],
            "NAME" => $arItems["NAME"],
            "PRICE" => $price,
            "TOTAL" => $totalItem,
            "PRODUCT_ID" => $arItems["PRODUCT_ID"],
            "QUANTITY" => $arItems["QUANTITY"],
            "MEASURE" => $measureData,
        );
        $total += $arItems["PRICE"] * $arItems["QUANTITY"];
    }
    $total = number_format($total, 2, '.', ' ');
    $total = str_replace(".00", "", $total). " р.";

    $arProducts = array();
    if (count($arPriductIds) > 0) {
        $arFilter = Array("ID" => $arPriductIds);
        $arSelect = Array("ID", "PREVIEW_PICTURE", "DETAIL_PICTURE", "CATALOG_WEIGHT", "PROPERTY_CML2_ARTICLE", "DETAIL_PAGE_URL");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNext())
        {           
            $arProducts[$ob["ID"]]["URL"] = $ob["DETAIL_PAGE_URL"];
            $arProducts[$ob["ID"]]["ARTICLE"] = $ob["PROPERTY_CML2_ARTICLE_VALUE"];
            $arProducts[$ob["ID"]]["WEIGHT"] = $ob["CATALOG_WEIGHT"];
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
        $totalWeight += $arProducts[$arItem["PRODUCT_ID"]]["WEIGHT"] * $arItem["QUANTITY"];
    }

    $arResult["ITEMS"] = $arBasketItems;
    $arResult["COUNT"] = count($arResult["ITEMS"]);
    $arResult["MESSAGE"] = $arResult["COUNT"] . " " . pluralForm($arResult["COUNT"], "товар", "товара", "товаров");
    $arResult["TOTAL"] = $total;
    $arResult["WEIGHT"] = $totalWeight / 1000;
    $arResult["WEIGHT"] = round($arResult["WEIGHT"], 3);
$this->IncludeComponentTemplate();



// Получим данные по пользователю
global $USER;
$arResult["USER"] = array();
if ($USER->IsAuthorized())
{
    $filter = Array("ID" => $USER->GetID());
    $rsUsers = CUser::GetList(($by = "NAME"), ($order = "desc"), $filter, array("SELECT" => array("UF_ORGANIZATION", "UF_INN")));
    if ($arUser = $rsUsers->Fetch()) {
        $arResult["USER"] = $arUser;
    }
}