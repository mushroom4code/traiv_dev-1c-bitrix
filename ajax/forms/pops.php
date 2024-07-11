<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

session_start();

if (empty($_POST['price_list_popup'])) {
    $_SESSION['price_list_popup'] = 1;
}