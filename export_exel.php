<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
CModule::IncludeModule("iblock");

$arResult = array();
$arResult[] = array("№", "ID элемента", "Название", "Тип", "Стандарт", "Диаметр", "Длинна", "Материал", "Вес");

$i = 1;
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "IBLOCK_SECTION_ID", "PROPERTY_589", "PROPERTY_590", "PROPERTY_591", "PROPERTY_592", "PROPERTY_593");
$arFilter = Array("IBLOCK_ID" => 30, "ACTIVE"=>"Y", "DETAIL_PICTURE" => false);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNext()) { 
	$arNav = array();
	$nav = CIBlockSection::GetNavChain(30, $ob["IBLOCK_SECTION_ID"], array("NAME"));
	while($obNav = $nav->GetNext()) { 
		$arNav[] = $obNav["NAME"];
	}
	$arResult[] = array(
	$i, 
	$ob["ID"],
	$ob["NAME"],
	implode(" / ", $arNav),
	str_replace(".", ",", $ob["PROPERTY_589_VALUE"]),
	str_replace(".", ",", $ob["PROPERTY_590_VALUE"]),
	str_replace(".", ",", $ob["PROPERTY_591_VALUE"]),
	str_replace(".", ",", $ob["PROPERTY_592_VALUE"]),
	str_replace(".", ",", $ob["PROPERTY_593_VALUE"])
	);
	
	$i++;
}

$fp = fopen('file.csv', 'w');
foreach ($arResult as $fields) {
	fputcsv($fp, $fields, ';', '"');
}
fclose($fp);
