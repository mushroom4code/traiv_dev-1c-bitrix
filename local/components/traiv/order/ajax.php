<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
if(!CModule::IncludeModule('sale') || !CModule::IncludeModule('iblock') || !CModule::IncludeModule('catalog') || !CModule::IncludeModule('currency'))
    die();


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
    $personTypeId =  2;//$_REQUEST["TYPE"];
    $deliveryId = ($_REQUEST["DELIVERY"] == "Y") ? 2 : 3;
    $paysystemId = 1;

    // Получение св-в
    $arProps = array();

    if ($personTypeId == 1) {
        $db_props = CSaleOrderProps::GetList(
            array("SORT" => "ASC"),
            array(
                "ACTIVE" => "Y",
                "PERSON_TYPE_ID" => 1,
                "CODE" => array("FIO", "EMAIL", "PHONE", "CITY", "ADDRESS")
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
            $arProps["FIO"] => $_REQUEST["F_FIO"],
            $arProps["EMAIL"] => $_REQUEST["F_EMAIL"],
            $arProps["PHONE"] => $_REQUEST["F_PHONE"],
            $arProps["CITY"] => $_REQUEST["F_CITY"],
            $arProps["ADDRESS"] => $_REQUEST["F_ADDRESS"],
        );
    } else {
        $db_props = CSaleOrderProps::GetList(
            array("SORT" => "ASC"),
            array(
                "ACTIVE" => "Y",
                "PERSON_TYPE_ID" => 2,
                "CODE" => array("COMPANY", "CONTACT_PERSON", "INN", "KPP", "EMAIL", "PHONE", "CITY", "ADDRESS", "MANAGER")
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
            $arProps["COMPANY"] => $_REQUEST["U_NAME"],
            $arProps["CONTACT_PERSON"] => $_REQUEST["U_FIO"],
            $arProps["MANAGER"] => $_REQUEST["U_MANAGER"],
            $arProps["INN"] => $_REQUEST["U_INN"],
            $arProps["KPP"] => $_REQUEST["U_KPP"],
            $arProps["EMAIL"] => $_REQUEST["U_EMAIL"],
            $arProps["PHONE"] => $_REQUEST["U_PHONE"],
            $arProps["CITY"] => $_REQUEST["U_CITY"],
            $arProps["ADDRESS"] => $_REQUEST["U_ADDRESS"],
        );
    }

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
    
    $arFields = array();
    if (!empty($_REQUEST["USER_DESCRIPTION"])) {
        $arFields["USER_DESCRIPTION"] = $_REQUEST["USER_DESCRIPTION"];
    }

    $arResult["ORDER_ID"] = (int)CSaleOrder::DoSaveOrder($arOrderDat, $arFields, 0, $arResult["ERROR"]);
    
} else {
    $arResult["ERROR"] = "Ваша карзина пуста";
}

header('Content-Type: application/json');
if (empty($arResult["ERROR"])) {
    echo json_encode(array("STATUS" => "SUCCESS", "ORDER_ID" => $arResult["ORDER_ID"]));
} else {
    echo json_encode(array("STATUS" => "ERROR", "ERROR" => $arResult["ERROR"]));
}
