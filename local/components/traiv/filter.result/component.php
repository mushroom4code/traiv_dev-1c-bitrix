<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Diag;
Diag\Debug::writeToFile("Результат фильтра");
CModule::IncludeModule("iblock");

$arFilter = array("IBLOCK_ID" => 18);
$vid = intval($_REQUEST["vid"]);
$gost = intval($_REQUEST["gost"]);
$meterial = intval($_REQUEST["meterial"]);
$pokrytie = intval($_REQUEST["pokrytie"]);
$dlina = intval($_REQUEST["dlina"]);
$diametr = intval($_REQUEST["diametr"]);
$q = trim($_REQUEST["q"]);

if (strlen($q) > 0) {
    $arFilter["%NAME"] = $q;
}

// Фильтр по виду
if ($vid > 0) {
    $arFilter["SECTION_ID"] = $vid;
    $arFilter["INCLUDE_SUBSECTIONS"] = "Y";
}

// Фильтр по госту
if ($gost > 0) {
    $propEnums = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID" => 18, "ID" => $gost));
    if ($enField = $propEnums->GetNext()) {
        $value = $enField["VALUE"];
        $propVal = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID" => 18, "PROPERTY_CODE" => array("STANDART_BOLTY", "STANDART_VINTI"), "VALUE" => $value));
        $arExtFilter = array("LOGIC" => "OR");
        while ($enGost = $propVal->GetNext()) {
            $arExtFilter[]["PROPERTY_".$enGost["PROPERTY_CODE"]] = $enGost["ID"];
        }
        $arFilter[] = $arExtFilter;
    }
}

// Фильтр по материалу
if ($meterial > 0) {
    $propEnums = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID" => 18, "ID" => $meterial));
    if ($enField = $propEnums->GetNext()) {
        $value = $enField["VALUE"];
        $propVal = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID" => 18, "PROPERTY_CODE" => array("MATERIAL", "MATERIAL_VINTI", "MATERIAL_BOLTY"), "VALUE" => $value));
        $arExtFilter = array("LOGIC" => "OR");
        while ($enMat = $propVal->GetNext()) {
            $arExtFilter[]["PROPERTY_".$enMat["PROPERTY_CODE"]] = $enMat["ID"];
        }
            $arFilter[] = $arExtFilter;
    }
}

// Фильтр по покрытию
if ($pokrytie > 0) {
    $propEnums = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID" => 18, "ID" => $pokrytie));
    if ($enField = $propEnums->GetNext()) {
        $value = $enField["VALUE"];
        $propVal = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID" => 18, "PROPERTY_CODE" => array("POKRYTIE", "POKRYTIE_BOLTY", "POKRITIE_VINTI"), "VALUE" => $value));
        $arExtFilter = array("LOGIC" => "OR");
        while ($enPok = $propVal->GetNext()) {
            $arExtFilter[]["PROPERTY_".$enPok["PROPERTY_CODE"]] = $enPok["ID"];
        }
        $arFilter[] = $arExtFilter;
    }
}

// Фильтр по длине
if ($dlina > 0) {
    $propVal = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID" => 18, "PROPERTY_CODE" => array("DLINA", "DLINA_MM_VINTI", "DLINA_MM_BOLTY", "DLINA_INCH_BOLTY"), "VALUE" => $dlina));
    $arExtFilter = array("LOGIC" => "OR");
    while ($enPok = $propVal->GetNext()) {
        $arExtFilter[]["PROPERTY_".$enPok["PROPERTY_CODE"]] = $enPok["ID"];
    }
    $arFilter[] = $arExtFilter;
}

// Фильтр по диаметру
if ($diametr > 0) {
    $propVal = CIBlockPropertyEnum::GetList(Array(), Array("IBLOCK_ID" => 18, "PROPERTY_CODE" => array("DIAMETR", "DIAMETR_MM_VINTI", "DIAMETR_MM_BOLTY"), "VALUE" => $diametr));
    $arExtFilter = array("LOGIC" => "OR");
    while ($enPok = $propVal->GetNext()) {
        $arExtFilter[]["PROPERTY_".$enPok["PROPERTY_CODE"]] = $enPok["ID"];
    }
    $arFilter[] = $arExtFilter;
}

$arSelect = Array("ID", "NAME", "IBLOCK_ID");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 1000), $arSelect);
while($ob = $res->GetNext())
{
    $arResult["CUSTOM_FILTER"][] = $ob["ID"];
}

$this->IncludeComponentTemplate();