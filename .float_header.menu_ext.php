<?php
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    global $APPLICATION;

    $aMenuLinksExt = $APPLICATION->IncludeComponent(
	"traiv:menu.sections",
	"", 
	array(
		"IS_SEF" => "N",
		"ID" => "",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "18",
		"SECTION_URL" => "",
		"DEPTH_LEVEL" => "2",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"SEF_BASE_URL" => "",
		"SECTION_PAGE_URL" => "#SECTION_ID#/",
		"DETAIL_PAGE_URL" => "#SECTION_ID#/#ELEMENT_ID#",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);
    $aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
?>