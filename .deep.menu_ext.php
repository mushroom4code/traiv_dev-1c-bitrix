<?/*
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
$aMenuLinksExt=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
    "ID" => $_REQUEST["ID"],
    "IBLOCK_TYPE" => "catalog",
    "IBLOCK_ID" => "18",
    "SECTION_URL" => "/catalog/#SECTION_CODE_PATH#/",
    "DEPTH_LEVEL" => "4",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
    "IS_SEF" => "N",
    "SEF_BASE_URL" => "/catalog/",
    "SECTION_PAGE_URL" => "#SECTION_ID#/",
    "DETAIL_PAGE_URL" => "#SECTION_ID#/#ELEMENT_ID#"
),
    false,
    array(
        "ACTIVE_COMPONENT" => "Y"
    )
);
//unset($aMenuLinksExt[0]);
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
*/?>