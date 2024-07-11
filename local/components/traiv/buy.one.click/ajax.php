<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
if(!CModule::IncludeModule('sale') || !CModule::IncludeModule('iblock') || !CModule::IncludeModule('catalog') || !CModule::IncludeModule('currency'))
    die();


$arResult["NAME"] = $_REQUEST["NAME"];
$arResult["TEL"] = $_REQUEST["PHONE"];
$arResult["EMAIL"] = $_REQUEST["EMAIL"];
$arResult["BASKET_ITEMS"] = array();
$arResult["ERROR"] = "";

$registeredUserID = $USER->GetID();

$basketUserID = CSaleBasket::GetBasketUserID();


$dbBasketItems = CSaleBasket::GetList(
    array("ID" => "ASC"),
    array(
        "FUSER_ID" => $basketUserID,
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL",
        "DELAY" => "N"
    ),
    false,
    false,
    array()
);

while ($arItem = $dbBasketItems->GetNext()) {

    $arResult["BASKET_ITEMS"][] = $arItem;
}

if (count($arResult["BASKET_ITEMS"]) > 0) {
    $personTypeId = 1;
    $deliveryId = 2;
    $paysystemId = 1;

    // Получение св-в
    $arProps = array();

    $db_props = CSaleOrderProps::GetList(
        array("SORT" => "ASC"),
        array(
            "ACTIVE" => "Y",
            "PERSON_TYPE_ID" => 1,
            "CODE" => array("FIO", "PHONE", "EMAIL")
        ),
        false,
        false,
        array("ID", "CODE")
    );
    while ($props = $db_props->Fetch()) {
        $arProps[$props["CODE"]] = $props["ID"];
    }

    // Свойства сохраняемые в заказе
    $arOrderProps = array(
        $arProps["FIO"] => $arResult["NAME"],
        $arProps["PHONE"] => $arResult["TEL"],
        $arProps["EMAIL"] => $arResult["EMAIL"]
    );

    $arOrderDat = CSaleOrder::DoCalculateOrder(
        SITE_ID,
        $registeredUserID,
        $arResult["BASKET_ITEMS"],
        $personTypeId,
        $arOrderProps,
        $deliveryId,
        $paysystemId,
        array(),
        $arErrors,
        $arWarnings
    );
    $arResult["ORDER_ID"] = (int)CSaleOrder::DoSaveOrder($arOrderDat, array("USER_DESCRIPTION" => "Заказ оформлен через форму купить в 1 клик"), 0, $arResult["ERROR"]);

} else {
    $arResult["ERROR"] = "Ваша корзина пуста";
}

header('Content-Type: application/json');
if (empty($arResult["ERROR"])) {
    echo json_encode(array("STATUS" => "SUCCESS", "ORDER_ID" => $arResult["ORDER_ID"]));
} else {
    echo json_encode(array("STATUS" => "ERROR", "ERROR" => $arResult["ERROR"]));
}
