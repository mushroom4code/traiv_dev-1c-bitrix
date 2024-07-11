<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="subsection">
    <div class="island">
        <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.smart.filter", 
	"common-filter", 
	array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "N",
		"DISPLAY_ELEMENT_COUNT" => "N",
		"FILTER_NAME" => "arrFilter",
		"FILTER_VIEW_MODE" => "horizontal",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "18",
		"IBLOCK_TYPE" => "catalog",
		"PAGER_PARAMS_NAME" => "arrPager",
		"POPUP_POSITION" => "left",
		"PRICE_CODE" => array(
		),
		"SAVE_IN_SESSION" => "N",
		"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
		"SECTION_CODE_PATH" => $_REQUEST["SECTION_CODE_PATH"],
		"SECTION_DESCRIPTION" => "-",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_TITLE" => "-",
		"SEF_MODE" => "Y",
		"SEF_RULE" => "/catalog/filter/#SMART_FILTER_PATH#/apply/",
		"SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
		"TEMPLATE_THEME" => "blue",
		"XML_EXPORT" => "N",
		"COMPONENT_TEMPLATE" => "common-filter",
		"SEARCH_PROPERTIES" => array(
			0 => "48",
			1 => "49",
		)
	),
	false
);?>
    </div>
</div>
