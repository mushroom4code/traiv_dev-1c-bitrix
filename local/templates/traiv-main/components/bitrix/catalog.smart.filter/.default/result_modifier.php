<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (isset($arParams["TEMPLATE_THEME"]) && !empty($arParams["TEMPLATE_THEME"]))
{
	$arAvailableThemes = array();
	$dir = trim(preg_replace("'[\\\\/]+'", "/", dirname(__FILE__)."/themes/"));
	if (is_dir($dir) && $directory = opendir($dir))
	{
		while (($file = readdir($directory)) !== false)
		{
			if ($file != "." && $file != ".." && is_dir($dir.$file))
				$arAvailableThemes[] = $file;
		}
		closedir($directory);
	}

	if ($arParams["TEMPLATE_THEME"] == "site")
	{
		$solution = COption::GetOptionString("main", "wizard_solution", "", SITE_ID);
		if ($solution == "eshop")
		{
			$templateId = COption::GetOptionString("main", "wizard_template_id", "eshop_bootstrap", SITE_ID);
			$templateId = (preg_match("/^eshop_adapt/", $templateId)) ? "eshop_adapt" : $templateId;
			$theme = COption::GetOptionString("main", "wizard_".$templateId."_theme_id", "blue", SITE_ID);
			$arParams["TEMPLATE_THEME"] = (in_array($theme, $arAvailableThemes)) ? $theme : "blue";
		}
	}
	else
	{
		$arParams["TEMPLATE_THEME"] = (in_array($arParams["TEMPLATE_THEME"], $arAvailableThemes)) ? $arParams["TEMPLATE_THEME"] : "blue";
	}
}
else
{
	$arParams["TEMPLATE_THEME"] = "blue";
}

$arParams["FILTER_VIEW_MODE"] = (isset($arParams["FILTER_VIEW_MODE"]) && toUpper($arParams["FILTER_VIEW_MODE"]) == "HORIZONTAL") ? "HORIZONTAL" : "VERTICAL";
$arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"], array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";

function sortEnumFilter($a, $b) {
	if ($a['VALUE'] == $b['VALUE']) {
		return 0;
	}
	return ($a['VALUE'] < $b['VALUE']) ? -1 : 1;
}

foreach($arResult["ITEMS"] as $key => $arItem) {
	$arTemp = $arItem["VALUES"];
	uasort($arTemp, 'sortEnumFilter');
	$arResult["ITEMS"][$key]["VALUES"] = $arTemp;
}
$arResult["HIDE_FILTER"] = array(
    "bolt" => array("STANDART_BOLTY", "DIAMETR_MM_BOLTY", "DLINA_MM_BOLTY", "MATERIAL_BOLTY", "KLASS_PROCHNOSTI_BOLTY"),
    "vinty" => array("STANDART_VINTI", "DIAMETR_MM_VINTI", "MATERIAL_VINTI", "KLASS_PROCHNOSTI_VINTI", "TIP_GOLOVKI_VINTI"),
    "gaiki" => array("STANDART_BOLTY", "STANDART_VINTI", "DIAMETR", "MATERIAL", "KLASS_PROCHNOSTI_BOLTY", "TIP_GOLOVKI_VINTI"),
    "shaiby" => array("STANDART_BOLTY", "STANDART_VINTI", "DIAMETR", "MATERIAL", "KLASS_PROCHNOSTI_BOLTY", "TIP_GOLOVKI_VINTI"),
);
