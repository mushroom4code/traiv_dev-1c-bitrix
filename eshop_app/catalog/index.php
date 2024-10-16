<?
require($_SERVER["DOCUMENT_ROOT"]."/eshop_app/headers.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?$APPLICATION->IncludeComponent("bitrix:catalog", "mobile", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "18",
	"BASKET_URL" => SITE_DIR."eshop_app/personal/cart/",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => SITE_DIR."eshop_app/catalog/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "Y",
	"USE_ELEMENT_COUNTER" => "Y",
	"USE_FILTER" => "Y",
	"FILTER_NAME" => "",
	"FILTER_FIELD_CODE" => array(
		0 => "NAME",
		1 => "",
	),
	"FILTER_PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"FILTER_PRICE_CODE" => array(
		0 => "BASE",
	),
	"USE_REVIEW" => "Y",
	"MESSAGES_PER_PAGE" => "10",
	"USE_CAPTCHA" => "Y",
	"REVIEW_AJAX_POST" => "Y",
	"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
	"FORUM_ID" => "1",
	"URL_TEMPLATES_READ" => "",
	"SHOW_LINK_TO_FORUM" => "Y",
	"POST_FIRST_MESSAGE" => "N",
	"USE_COMPARE" => "N",
	"PRICE_CODE" => array(
		0 => "BASE",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"USE_PRODUCT_QUANTITY" => "Y",
	"CONVERT_CURRENCY" => "N",
	"SHOW_TOP_ELEMENTS" => "N",
	"SECTION_COUNT_ELEMENTS" => "N",
	"SECTION_TOP_DEPTH" => "1",
	"PAGE_ELEMENT_COUNT" => "25",
	"LINE_ELEMENT_COUNT" => "1",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"LIST_PROPERTY_CODE" => array(
		0 => "MANUFACTURER",
		1 => "MATERIAL",
		2 => "COLOR",
		3 => "WIDTH",
		4 => "LENGHT",
		5 => "SIZE",
		6 => "STORAGE_COMPARTMENT",
		7 => "HEIGHT",
		8 => "DEPTH",
		9 => "LIGHTS",
		10 => "SHELVES",
		11 => "CORNER",
		12 => "SEATS",
		13 => "WEIGHT",
		14 => "CRUST",
	),
	"INCLUDE_SUBSECTIONS" => "Y",
	"LIST_META_KEYWORDS" => "-",
	"LIST_META_DESCRIPTION" => "-",
	"LIST_BROWSER_TITLE" => "-",
	"DETAIL_PROPERTY_CODE" => array(
		0 => "MANUFACTURER",
		1 => "MATERIAL",
		2 => "COLOR",
		3 => "WIDTH",
		4 => "LENGHT",
		5 => "SIZE",
		6 => "STORAGE_COMPARTMENT",
		7 => "HEIGHT",
		8 => "DEPTH",
		9 => "SHELVES",
		10 => "CORNER",
		11 => "SEATS",
		12 => "MORE_PHOTO",
	),
	"DETAIL_META_KEYWORDS" => "-",
	"DETAIL_META_DESCRIPTION" => "-",
	"DETAIL_BROWSER_TITLE" => "-",
	"LINK_IBLOCK_TYPE" => "",
	"LINK_IBLOCK_ID" => "",
	"LINK_PROPERTY_SID" => "",
	"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
	"USE_ALSO_BUY" => "Y",
	"ALSO_BUY_ELEMENT_COUNT" => "3",
	"ALSO_BUY_MIN_BUYES" => "2",
	"USE_STORE" => "Y",
	"USE_STORE_PHONE" => "N",
	"USE_STORE_SCHEDULE" => "N",
	"USE_MIN_AMOUNT" => "Y",
	"MIN_AMOUNT" => "10",
	"STORE_PATH" => "/store/#store_id#",
	"MAIN_TITLE" => "Наличие на складах",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "arrows",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => "",
	"VARIABLE_ALIASES" => array(
		"SECTION_ID" => "SECTION_ID",
		"ELEMENT_ID" => "ELEMENT_ID",
	)
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>