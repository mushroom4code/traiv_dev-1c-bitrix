<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arType = array("page" => GetMessage("WD_MARQUE_INCLUDE_PAGE"), "sect" => GetMessage("WD_MARQUE_INCLUDE_SECT"));
if ($GLOBALS['USER']->CanDoOperation('edit_php')) {
	$arType["file"] = GetMessage("WD_MARQUE_INCLUDE_FILE");
}

$site_template = false;
$site = ($_REQUEST["site"]!='' ? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));
if($site !== false) {
	$rsSiteTemplates = CSite::GetTemplateList($site);
	while($arSiteTemplate = $rsSiteTemplates->Fetch()) {
		if(strlen($arSiteTemplate["CONDITION"])<=0) {
			$site_template = $arSiteTemplate["TEMPLATE"];
			break;
		}
	}
}
if (CModule::IncludeModule('fileman')) {
	$arTemplates = CFileman::GetFileTemplates(LANGUAGE_ID, array($site_template));
	$arTemplatesList = array();
	foreach ($arTemplates as $key => $arTemplate) {
		$arTemplateList[$arTemplate["file"]] = "[".$arTemplate["file"]."] ".$arTemplate["name"];
	}
} else {
	$arTemplatesList = array("page_inc.php" => "[page_inc.php]", "sect_inc.php" => "[sect_inc.php]");
}

$arComponentParameters = array(
	"GROUPS" => array(
		"PARAMS" => array(
			"NAME" => GetMessage("WD_MARQUE_INCLUDE_PARAMS"),
			"SORT" => "10",
		),
		"MARQUE" => array(
			"NAME" => GetMessage("WD_MARQUE_INCLUDE_MARQUE"),
			"SORT" => "20",
		),
	),
	"PARAMETERS" => array(
		"AREA_FILE_SHOW" => array(
			"NAME" => GetMessage("WD_MARQUE_INCLUDE_AREA_FILE_SHOW"), 
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"VALUES" => $arType,
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT" => "page",
			"PARENT" => "PARAMS",
			"REFRESH" => "Y",
		),
	),
);

if ($GLOBALS['USER']->CanDoOperation('edit_php') && $arCurrentValues["AREA_FILE_SHOW"] == "file") {
	$arComponentParameters["PARAMETERS"]["PATH"] = array(
		"NAME" => GetMessage("WD_MARQUE_INCLUDE_PATH"), 
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"PARENT" => "PARAMS",
	);
} else {
	$arComponentParameters["PARAMETERS"]["AREA_FILE_SUFFIX"] = array(
		"NAME" => GetMessage("WD_MARQUE_INCLUDE_AREA_FILE_SUFFIX"), 
		"TYPE" => "STRING",
		"DEFAULT" => "marque",
		"PARENT" => "PARAMS",
	);
	if ($arCurrentValues["AREA_FILE_SHOW"] == "sect") {
		$arComponentParameters["PARAMETERS"]["AREA_FILE_RECURSIVE"] = array(
			"NAME" => GetMessage("WD_MARQUE_INCLUDE_AREA_FILE_RECURSIVE"), 
			"TYPE" => "CHECKBOX",
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT" => "Y",
			"PARENT" => "PARAMS",
		);
	}
}

$arComponentParameters["PARAMETERS"]["EDIT_TEMPLATE"] = array(
	"NAME" => GetMessage("WD_MARQUE_INCLUDE_EDIT_TEMPLATE"), 
	"TYPE" => "LIST",
	"VALUES" => $arTemplateList,
	"DEFAULT" => "",
	"ADDITIONAL_VALUES" => "Y",
	"PARENT" => "PARAMS",
);



$arComponentParameters["PARAMETERS"]["MARQUE_ID"] = array(
	"NAME" => GetMessage("WD_MARQUE_ID"),
	"TYPE" => "TEXT",
	"DEFAULT" => "",
	"PARENT" => "MARQUE",
);
$arComponentParameters["PARAMETERS"]["DIRECTION"] = array(
	"NAME" => GetMessage("WD_MARQUE_DIRECTION"),
	"TYPE" => "LIST",
	"DEFAULT" => "left",
	"PARENT" => "MARQUE",
	"VALUES" => array(
		'up' => GetMessage("WD_MARQUE_DIRECTION_U"),
		'right' => GetMessage("WD_MARQUE_DIRECTION_R"),
		'down' => GetMessage("WD_MARQUE_DIRECTION_D"),
		'left' => GetMessage("WD_MARQUE_DIRECTION_L"),
	),
);
$arComponentParameters["PARAMETERS"]["LOOP"] = array(
	"NAME" => GetMessage("WD_MARQUE_LOOP"),
	"TYPE" => "TEXT",
	"DEFAULT" => "",
	"PARENT" => "MARQUE",
);
$arComponentParameters["PARAMETERS"]["SCROLLDELAY"] = array(
	"NAME" => GetMessage("WD_MARQUE_SCROLLDELAY"),
	"TYPE" => "TEXT",
	"DEFAULT" => "500",
	"PARENT" => "MARQUE",
);
$arComponentParameters["PARAMETERS"]["SCROLLAMOUNT"] = array(
	"NAME" => GetMessage("WD_MARQUE_SCROLLAMOUNT"),
	"TYPE" => "TEXT",
	"DEFAULT" => "100",
	"PARENT" => "MARQUE",
);
$arComponentParameters["PARAMETERS"]["CIRCULAR"] = array(
	"NAME" => GetMessage("WD_MARQUE_CIRCULAR"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
	"PARENT" => "MARQUE",
);
$arComponentParameters["PARAMETERS"]["DRAG"] = array(
	"NAME" => GetMessage("WD_MARQUE_DRAG"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
	"PARENT" => "MARQUE",
);
$arComponentParameters["PARAMETERS"]["RUNSHORT"] = array(
	"NAME" => GetMessage("WD_MARQUE_RUNSHORT"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
	"PARENT" => "MARQUE",
);
$arComponentParameters["PARAMETERS"]["HOVERSTOP"] = array(
	"NAME" => GetMessage("WD_MARQUE_HOVERSTOP"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
	"PARENT" => "MARQUE",
);
$arComponentParameters["PARAMETERS"]["INVERTHOVER"] = array(
	"NAME" => GetMessage("WD_MARQUE_INVERTHOVER"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
	"PARENT" => "MARQUE",
);
$arComponentParameters["PARAMETERS"]["HIDDEN"] = array(
	"NAME" => GetMessage("WD_MARQUE_HIDDEN"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
	"PARENT" => "MARQUE",
);
$arComponentParameters["PARAMETERS"]["STYLES"] = array(
	"NAME" => GetMessage("WD_MARQUE_STYLES"),
	"TYPE" => "TEXT",
	"DEFAULT" => "",
	"PARENT" => "MARQUE",
);

?>