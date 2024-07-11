<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");

$dataStr = "";
$arOrder = array(
    "NAME" => "ASC",
    "ID" => "ASC"
);
$arFilter = array(
    "FUSER_ID" => CSaleBasket::GetBasketUserID(),
    "LID" => SITE_ID,
    "ORDER_ID" => "NULL"
);
$bres = CSaleBasket::GetList($arOrder, $arFilter, false, false, array('*'));
while ($arItem = $bres->Fetch()) {
    $dataStr .= $arItem["PRODUCT_ID"] . ";";
}


$res = CIBlock::GetList(
    Array(),
    Array(
        'TYPE' => 'newit_abandonedcarts',
        "CODE" => "newit_abandonedcarts",
        'SITE_ID' => SITE_ID,
    ), false
);
while ($ar_res = $res->Fetch()) {
    $IBLOCK_ID = $ar_res["ID"];
}

$exists = false;
$el = new CIBlockElement;
$PROP = array();
$PROP["DATA"] = $dataStr;
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
$arFilter = Array("IBLOCK_ID" => $IBLOCK_ID, "NAME" => $_POST["email"]);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while ($ob = $res->GetNext()) {
    $exists = true;
}

if (stripos($_POST["email"], ".co") > -1 && !stripos($_POST["email"], ".com")) {
    $_POST["email"] = str_replace(".co", ".com", $_POST["email"]);
}

if ($exists == false) {
    $arLoadProductArray = Array(
        "IBLOCK_ID" => $IBLOCK_ID,
        "NAME" => $_POST["email"],
        "PROPERTY_VALUES" => $PROP,
    );

    $PRODUCT_ID = $el->Add($arLoadProductArray);
}