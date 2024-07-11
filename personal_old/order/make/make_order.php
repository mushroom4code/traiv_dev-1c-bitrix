<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (md5($_SESSION["fixed_session_id"]) != $_POST["hash"]) {
    CHTTP::SetStatus("404 Not found");

    return;
}

empty($_POST["deliv"]) ? $deliv = false : $deliv = 3;


CModule::IncludeModule("sale");

if (!$USER->IsAuthorized()) {

    $UserLogin = $_POST["email"];
    $rsUser = CUser::GetByLogin($UserLogin);
    $arUser = $rsUser->Fetch();

    if ($arUser["PASSWORD"] == md5($_POST["password"])) {
        $USER->Authorize($arUser["ID"]);
    } else {
        if (!empty($arUser["PASSWORD"])) {
            echo "ERRORПара логин/пароль неверна";
            exit();
        }
    }

    //для корректной работы надо отключить в настройках главного модуля "подтверждать регистрацию"
    //также надо отключить "использовать CAPTCHA при регистрации"
    $user = new CUser();

    $arResult = $user->Register($_POST["email"], $_POST["FIO"], "", $_POST["password"], $_POST["password"],
        $_POST["email"], "s1", "", 0);

    if ($arResult["TYPE"] == 'ERROR') {
        echo "ERROR".$arResult["MESSAGE"];
        exit();
    }
}

if ($deliv != false) {
    $arFields = array(
        "LID" => "s1",
        "PERSON_TYPE_ID" => $_POST["radio"],
        "PAYED" => "N",
        "CANCELED" => "N",
        "STATUS_ID" => "N",
        "DELIVERY_ID" => $deliv,
        "PRICE" => $_POST["sum"],
        "CURRENCY" => "RUB",
        "USER_ID" => IntVal($USER->GetID()),
        "USER_DESCRIPTION" => $_POST["comments"],
    );
} else {
    $arFields = array(
        "LID" => "s1",
        "PERSON_TYPE_ID" => $_POST["radio"],
        "PAYED" => "N",
        "CANCELED" => "N",
        "STATUS_ID" => "N",
        "PRICE" => $_POST["sum"],
        "CURRENCY" => "RUB",
        "USER_ID" => IntVal($USER->GetID()),
        "USER_DESCRIPTION" => $_POST["comments"],
    );

}

file_put_contents($_SERVER["DOCUMENT_ROOT"]."/local/123.txt",print_r($arFields,true));

$ORDER_ID = CSaleOrder::Add($arFields);
$ORDER_ID = IntVal($ORDER_ID);

if (!$ORDER_ID) {
    exit();
}

CSaleBasket::OrderBasket($ORDER_ID,
    CSaleBasket::GetBasketUserID(),
    "s1", false);

CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID(), false);

//физическое лицо
if ($_POST["radio"] == 1) {

    $arFields = array(
        "ORDER_ID" => $ORDER_ID,
        "ORDER_PROPS_ID" => 1,
        "NAME" => "ФИО",
        "CODE" => "FIO",
        "VALUE" => $_POST["FIO"],
    );
    CSaleOrderPropsValue::Add($arFields);

    $arFields = array(
        "ORDER_ID" => $ORDER_ID,
        "ORDER_PROPS_ID" => 2,
        "NAME" => "E-Mail",
        "CODE" => "EMAIL",
        "VALUE" => $_POST["email"],
    );
    CSaleOrderPropsValue::Add($arFields);


    $arFields = array(
        "ORDER_ID" => $ORDER_ID,
        "ORDER_PROPS_ID" => 20,
        "NAME" => "ИНН",
        "CODE" => "INN",
        "VALUE" => $_POST["INN"],
    );
    CSaleOrderPropsValue::Add($arFields);


    $arFields = array(
        "ORDER_ID" => $ORDER_ID,
        "ORDER_PROPS_ID" => 5,
        "NAME" => "Город",
        "CODE" => "CITY",
        "VALUE" => $_POST["city"],
    );
    CSaleOrderPropsValue::Add($arFields);


    $arFields = array(
        "ORDER_ID" => $ORDER_ID,
        "ORDER_PROPS_ID" => 7,
        "NAME" => "Адрес",
        "CODE" => "ADDRESS",
        "VALUE" => $_POST["address"],
    );
    CSaleOrderPropsValue::Add($arFields);


    $arFields = array(
        "ORDER_ID" => $ORDER_ID,
        "ORDER_PROPS_ID" => 3,
        "NAME" => "Телефон",
        "CODE" => "PHONE",
        "VALUE" => $_POST["telephone"],
    );
    CSaleOrderPropsValue::Add($arFields);
}

//юридическое лицо
if ($_POST["radio"] == 2) {

    $arFields = array(
        "ORDER_ID" => $ORDER_ID,
        "ORDER_PROPS_ID" => 12,
        "NAME" => "Контактное лицо",
        "CODE" => "CONTACT_PERSON",
        "VALUE" => $_POST["FIO"],
    );
    CSaleOrderPropsValue::Add($arFields);

    $arFields = array(
        "ORDER_ID" => $ORDER_ID,
        "ORDER_PROPS_ID" => 13,
        "NAME" => "E-Mail",
        "CODE" => "EMAIL",
        "VALUE" => $_POST["email"],
    );
    CSaleOrderPropsValue::Add($arFields);


    $arFields = array(
        "ORDER_ID" => $ORDER_ID,
        "ORDER_PROPS_ID" => 10,
        "NAME" => "ИНН",
        "CODE" => "INN",
        "VALUE" => $_POST["INN"],
    );
    CSaleOrderPropsValue::Add($arFields);


    $arFields = array(
        "ORDER_ID" => $ORDER_ID,
        "ORDER_PROPS_ID" => 17,
        "NAME" => "Город",
        "CODE" => "CITY",
        "VALUE" => $_POST["city"],
    );
    CSaleOrderPropsValue::Add($arFields);


    $arFields = array(
        "ORDER_ID" => $ORDER_ID,
        "ORDER_PROPS_ID" => 19,
        "NAME" => "Адрес",
        "CODE" => "ADDRESS",
        "VALUE" => $_POST["address"],
    );
    CSaleOrderPropsValue::Add($arFields);


    $arFields = array(
        "ORDER_ID" => $ORDER_ID,
        "ORDER_PROPS_ID" => 14,
        "NAME" => "Телефон",
        "CODE" => "PHONE",
        "VALUE" => $_POST["telephone"],
    );
    CSaleOrderPropsValue::Add($arFields);
}

makeAndSendOrder($ORDER_ID);

echo "<h3 class=\"head-order\">Ваш заказ №$ORDER_ID сохранен</h3>";

