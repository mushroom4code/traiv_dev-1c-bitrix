<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$aMenu = array();
if (\Bitrix\Main\Loader::includeModule("intervolga.tips"))
{
	if (\Intervolga\Tips\Rights::canRead())
	{
		/**
		 * @var array $aMenu
		 */
		$sModuleName = basename(dirname(dirname(__FILE__)));

		$aMenu = array(
			"parent_menu" => "global_menu_settings",
			"section" => $sModuleName,
			"sort" => 50,
			"text" => Loc::getMessage("intervolga.tips.TIPS_MENU_TITLE"),
			"title" => "",
			"icon" => "fileman_sticker_icon",
			"page_icon" => "",
			"items_id" => $sModuleName . "_items",
			"more_url" => array(
				"/bitrix/admin/" . $sModuleName . "_edit.php"
			),
			"url" => "/bitrix/admin/" . $sModuleName . "_list.php",
		);
	}
}

return $aMenu;