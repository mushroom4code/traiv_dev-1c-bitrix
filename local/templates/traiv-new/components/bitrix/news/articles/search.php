<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);
?>
<?
if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '2743' || $USER->GetID() == '4677' || $USER->GetID() == '552' || $USER->GetID() == '1788') {
        $cs = "art_search_magazine";
    }
    else {
        $cs = "art_search";
    }
}
else
{
    $cs = "art_search";
}

$APPLICATION->IncludeComponent(
	"bitrix:search.page",
	$cs,
	Array(
		"CHECK_DATES" => $arParams["CHECK_DATES"]!=="N"? "Y": "N",
		"arrWHERE" => Array("iblock_".$arParams["IBLOCK_TYPE"]),
		"arrFILTER" => Array("iblock_".$arParams["IBLOCK_TYPE"]),
		"SHOW_WHERE" => "N",
		//"PAGE_RESULT_COUNT" => "",
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"arrFILTER_iblock_".$arParams["IBLOCK_TYPE"] => Array($arParams["IBLOCK_ID"])
	),
	$component
);?>
<p>

<div class="btn-group-blue"><a href="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"]?>" class="btn-404"><span><i class="fa fa-arrow-left"></i> К списку статей</span></a></div>

<!-- 
<a href="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"]?>"><?=GetMessage("T_NEWS_DETAIL_BACK")?></a></p>
 -->
