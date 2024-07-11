<?php

define("STOP_STATISTICS", true);
define("NOT_CHECK_PERMISSIONS", true);

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


global $APPLICATION;
ob_start();
$APPLICATION->IncludeComponent(
    "bitrix:sale.basket.basket.line",
    "header-ajax",
    array(
        "PATH_TO_BASKET" => SITE_DIR."personal/cart/",
        "SHOW_NUM_PRODUCTS" => "Y",
        "SHOW_TOTAL_PRICE" => "Y",
        "SHOW_EMPTY_VALUES" => "Y",
        "SHOW_PERSONAL_LINK" => "N",
        "PATH_TO_PERSONAL" => SITE_DIR."personal/",
        "SHOW_AUTHOR" => "N",
        "PATH_TO_REGISTER" => SITE_DIR."login/",
        "PATH_TO_PROFILE" => SITE_DIR."personal/",
        "SHOW_PRODUCTS" => "N",
        "POSITION_FIXED" => "N",
        "COMPONENT_TEMPLATE" => "header",
        "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
        "HIDE_ON_BASKET_PAGES" => "Y",
    ),
    false
);
$data = ob_get_contents();
ob_end_clean();
echo $data;
