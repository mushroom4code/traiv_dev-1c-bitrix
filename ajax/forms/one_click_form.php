<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$elementID = $_REQUEST['form_text_6'];

?><?$APPLICATION->IncludeComponent(
  "bitrix:form.result.new", "one_click_buy", Array(
  "COMPONENT_TEMPLATE" => ".default",
  'ELEMENT_ID'=> $elementID,
    "WEB_FORM_ID" => "2", // ID веб-формы
    "IGNORE_CUSTOM_TEMPLATE" => "N",  // Игнорировать свой шаблон
    "USE_EXTENDED_ERRORS" => "Y", // Использовать расширенный вывод сообщений об ошибках
    "SEF_MODE" => "N",  // Включить поддержку ЧПУ
    "CACHE_TYPE" => "N",  // Тип кеширования
    "LIST_URL" => "/ajax/forms/one_click_saved.php",  // Страница со списком результатов
    "EDIT_URL" => "/ajax/forms/one_click_saved.php",  // Страница редактирования результата
    "SUCCESS_URL" => "/ajax/forms/one_click_saved.php",  // Страница с сообщением об успешной отправке
    "CHAIN_ITEM_TEXT" => "",  // Название дополнительного пункта в навигационной цепочке
    "CHAIN_ITEM_LINK" => "",  // Ссылка на дополнительном пункте в навигационной цепочке
    "VARIABLE_ALIASES" => array(
      "WEB_FORM_ID" => "WEB_FORM_ID",
      "RESULT_ID" => "RESULT_ID",
    )
  ),
  false
);

