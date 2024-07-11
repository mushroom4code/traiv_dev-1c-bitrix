<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $USER;

$userID = $USER->GetID();
$ORDER_ID = $_REQUEST['ORDER_ID'];

if (CModule::IncludeModule("sale")) {
    if ($arOrder = CSaleOrder::GetByID($ORDER_ID)) {
        if($arOrder["USER_ID"] == $userID){
            require_once ($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/sale/admin/print.php');
        }else{
            echo 'Нет прав на просмотр этого заказа';
        }
    }
}