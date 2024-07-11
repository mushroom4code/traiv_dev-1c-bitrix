<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = array(
	"NAME" => Loc::getMessage("intervolga.tips.ACTIVATOR_COMPONENT_NAME"),
	"DESCRIPTION" => Loc::getMessage("intervolga.tips.ACTIVATOR_COMPONENT_DESC"),
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "intervolga",
		"NAME" => "intervolga.ru",
		"CHILD" => array(
			"ID" => Loc::getMessage("intervolga.tips.COMPONENTS_SECTION_CODE"),
			"NAME" => Loc::getMessage("intervolga.tips.COMPONENTS_SECTION_NAME"),
		),
	),
);