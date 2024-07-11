<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$PREVIEW_WIDTH = intval($arParams["PREVIEW_WIDTH"]);
if ($PREVIEW_WIDTH <= 0)
	$PREVIEW_WIDTH = 120;

$PREVIEW_HEIGHT = intval($arParams["PREVIEW_HEIGHT"]);
if ($PREVIEW_HEIGHT <= 0)
	$PREVIEW_HEIGHT = 100;

foreach($arResult["SEARCH"] as $arItem){
	if($arItem["MODULE_ID"] == "iblock" && substr($arItem["ITEM_ID"], 0, 1) !== "S")
	{
		$arResult["ELEMENTS"][$arItem["ITEM_ID"]] = $arItem["ITEM_ID"];
	}
	elseif($arItem["MODULE_ID"] == "iblock" && substr($arItem["ITEM_ID"], 0, 1) == "S")
	{
		$arResult["SECTIONS"][$arItem["ITEM_ID"]] = str_replace('S', '', $arItem["ITEM_ID"]);
	}
}

if (!empty($arResult["ELEMENTS"]) && CModule::IncludeModule("iblock"))
{
	$arSelect = array(
		"ID",
		"IBLOCK_ID",
		"PREVIEW_TEXT",
		"PREVIEW_PICTURE",
		"DETAIL_PICTURE",
	);
	$arFilter = array(
		"IBLOCK_LID" => SITE_ID,
		"IBLOCK_ACTIVE" => "Y",
		"ACTIVE_DATE" => "Y",
		"ACTIVE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
		"MIN_PERMISSION" => "R",
	);
	$arFilter["=ID"] = $arResult["ELEMENTS"];
	$arResult["ELEMENTS"] = array();
	$rsElements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	while($arElement = $rsElements->Fetch())
	{
		$arResult["ELEMENTS"][$arElement["ID"]] = $arElement;
	}
}


if (!empty($arResult["SECTIONS"]) && CModule::IncludeModule("iblock"))
{
	$arFilter = array(
		"IBLOCK_LID" => SITE_ID,
		"IBLOCK_ACTIVE" => "Y",
		"ACTIVE_DATE" => "Y",
		"ACTIVE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
		"MIN_PERMISSION" => "R",
	);
	$arFilter["=ID"] = $arResult["SECTIONS"];

	$arSelect = array(
		"ID",
		"IBLOCK_ID",
		"PICTURE",
		"DESCRIPTION",
	);

	$db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, false, $arSelect);
	while($ar_result = $db_list->GetNext())
	{
		$arResult["SECTIONS"]["S".$ar_result["ID"]] = $ar_result;
	}
}

foreach($arResult["SEARCH"] as $i=>&$arItem)
{
	if($arItem["MODULE_ID"] == "iblock" && !empty($arResult["ELEMENTS"][$arItem["ITEM_ID"]]))
	{
		$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];
		
		if ($arElement["PREVIEW_PICTURE"] > 0)
			$arItem["PICTURE"] = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], array("width"=>$PREVIEW_WIDTH, "height"=>$PREVIEW_HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		elseif ($arElement["DETAIL_PICTURE"] > 0)
			$arItem["PICTURE"] = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], array("width"=>$PREVIEW_WIDTH, "height"=>$PREVIEW_HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			
	}
	elseif($arItem["MODULE_ID"] == "iblock" && !empty($arResult["SECTIONS"][$arItem["ITEM_ID"]]))
	{
		$arElement = $arResult["SECTIONS"][$arItem["ITEM_ID"]];
		
		if ($arElement["PICTURE"] > 0)
			$arItem["PICTURE"] = CFile::ResizeImageGet($arElement["PICTURE"], array("width"=>$PREVIEW_WIDTH, "height"=>$PREVIEW_HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			
	}
}
unset($arItem);
