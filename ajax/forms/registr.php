<?php
/**
 * Created by PhpStorm.
 * User: gasparyan
 * Date: 26.12.2017
 * Time: 14:38
 */

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->IncludeComponent(
    "bitrix:form.result.new", "registr", Array(
    "COMPONENT_TEMPLATE" => ".default",
    "WEB_FORM_ID" => "8", // ID веб-формы
    "IGNORE_CUSTOM_TEMPLATE" => "N",  // Игнорировать свой шаблон
    "USE_EXTENDED_ERRORS" => "Y", // Использовать расширенный вывод сообщений об ошибках
    "SEF_MODE" => "N",  // Включить поддержку ЧПУ
    "CACHE_TYPE" => "N",  // Тип кеширования
    "LIST_URL" => "/ajax/forms/registr_success.php",  // Страница со списком результатов
    "EDIT_URL" => "/ajax/forms/registr_success.php",  // Страница редактирования результата
    "SUCCESS_URL" => "/ajax/forms/registr_success.php",  // Страница с сообщением об успешной отправке
    "CHAIN_ITEM_TEXT" => "",  // Название дополнительного пункта в навигационной цепочке
    "CHAIN_ITEM_LINK" => "",  // Ссылка на дополнительном пункте в навигационной цепочке
    "VARIABLE_ALIASES" => array(
        "WEB_FORM_ID" => "WEB_FORM_ID",
        "RESULT_ID" => "RESULT_ID",
    )
),
    false
);

