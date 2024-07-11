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
		"DEPTH_LEVEL" => "3",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"SEF_BASE_URL" => "",
		"SECTION_PAGE_URL" => "#SECTION_ID#/",
		"DETAIL_PAGE_URL" => "#SECTION_ID#/#ELEMENT_ID#",
        "SECTION_ID" => CIBlockFindTools::GetSectionID(
            "#SECTION_ID#",
            "#SECTION_URL#",
            array("IBLOCK_ID" => $arParams["IBLOCK_ID"])
        ),
	),
	false
);
    $aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>