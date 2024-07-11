<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arDirections = array(
	"TOP_LEFT" => Loc::getMessage("intervolga.tips.POSITION_TOP_LEFT"),
	"TOP" => Loc::getMessage("intervolga.tips.POSITION_TOP"),
	"TOP_RIGHT" => Loc::getMessage("intervolga.tips.POSITION_TOP_RIGHT"),
	"RIGHT_TOP" => Loc::getMessage("intervolga.tips.POSITION_RIGHT_TOP"),
	"RIGHT" => Loc::getMessage("intervolga.tips.POSITION_RIGHT"),
	"RIGHT_BOTTOM" => Loc::getMessage("intervolga.tips.POSITION_RIGHT_BOTTOM"),
	"BOTTOM_RIGHT" => Loc::getMessage("intervolga.tips.POSITION_BOTTOM_RIGHT"),
	"BOTTOM" => Loc::getMessage("intervolga.tips.POSITION_BOTTOM"),
	"BOTTOM_LEFT" => Loc::getMessage("intervolga.tips.POSITION_BOTTOM_LEFT"),
	"LEFT_BOTTOM" => Loc::getMessage("intervolga.tips.POSITION_LEFT_BOTTOM"),
	"LEFT" => Loc::getMessage("intervolga.tips.POSITION_LEFT"),
	"LEFT_TOP" => Loc::getMessage("intervolga.tips.POSITION_LEFT_TOP"),
);

$arTemplateParameters = array(
	"POSITION" => array(
		"NAME" => Loc::getMessage("intervolga.tips.POSITION"),
		"TYPE" => "LIST",
		"VALUES" => $arDirections,
	),
	"HINT_STYLE" => array(
		"NAME" => Loc::getMessage("intervolga.tips.HINT_STYLE"),
		"TYPE" => "LIST",
		"VALUES" => array(
			"ICON" => Loc::getMessage("intervolga.tips.HINT_STYLE_ICON"),
			"DASHED" => Loc::getMessage("intervolga.tips.HINT_STYLE_DASHED"),
		)
	),
);