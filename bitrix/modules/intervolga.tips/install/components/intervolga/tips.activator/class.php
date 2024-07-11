<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Localization\Loc;
use Intervolga\Tips\Orm\TipsTable;

Loc::loadMessages(__FILE__);

/**
 * Placing this component on the page activates intervolga.tips module.
 * This means actual tips will be shown.
 */
class CIntervolgaTipsActivatorComponent extends CBitrixComponent
{
	/**
	 * @var array current page tips to be passed to end page event handler
	 */
	private static $arTips = array();

	/**
	 * Returns current page tips to be passed to end page event handler.
	 *
	 * @see \Intervolga\Tips\EventHandlers\Main::onEndBufferContent();
	 * @return array
	 */
	public static function getPageTipsForEvent()
	{
		$arTips = static::$arTips;

		if ($arTips)
		{
			foreach ($arTips as $i => $arTip)
			{
				unset($arTips[$i]["TOOLTIP"]);
			}
		}

		return $arTips;
	}

	public function executeComponent()
	{
		global $USER;
		if (!\Bitrix\Main\Loader::includeModule("intervolga.tips"))
		{
			if ($USER->IsAdmin())
			{
				$this->arResult["ERRORS"]["MODULE_NOT_INSTALLED"] = Loc::getMessage("intervolga.tips.MODULE_NOT_INSTALLED");
			}
		}
		else
		{
			$arCacheId = array(SITE_ID, $this->getCurrentPage());
			if ($this->startResultCache(FALSE, $arCacheId))
			{
				if (defined('BX_COMP_MANAGED_CACHE') && is_object($GLOBALS['CACHE_MANAGER']))
				{
					$GLOBALS['CACHE_MANAGER']->RegisterTag('intervolga_tips');
				}

				$this->arResult["TIPS"] = \Intervolga\Tips\Orm\TipsTable::getPageList($this->getCurrentPage(), SITE_ID);
				$this->endResultCache();
			}

			$this->addPanelButtons();
		}
		if ($this->arResult["TIPS"])
		{
			static::$arTips = $this->arResult["TIPS"];
			$this->addJson($this->getCurrentPage(), SITE_ID);
		}
		$this->includeComponentTemplate();
	}

	/**
	 * Adds head script with tips in json.
	 *
	 * @param string $sPage current page url
	 * @param string $sSite current site id
	 */
	protected function addJson($sPage, $sSite)
	{
		global $APPLICATION;
		ob_start();
		?>
		<script type="text/javascript" src="/bitrix/tools/intervolga.tips/json.php?page=<?=urlencode($sPage)?>&site=<?=$sSite?>&time=<?=time()?>"></script>
		<?
		$APPLICATION->AddHeadString(ob_get_clean());
	}

	/**
	 * Adds tips panel buttons.
	 */
	protected function addPanelButtons()
	{
		global $APPLICATION;
		if (\Intervolga\Tips\Rights::canRead())
		{
			$arButton = array(
				"ID" => "intervolga_tips",
				"ICON" => "bx-panel-small-stickers-icon",
				"MAIN_SORT" => "5000",
				"SORT" => 50,
				"MENU" => array(),
			);
			if (\Intervolga\Tips\Rights::canWrite())
			{
				// Add new tip panel button
				$arButton = array_merge($arButton, array(
					"HREF" => 'javascript:' . $APPLICATION->GetPopupLink(
							array(
								"URL" => "/bitrix/admin/intervolga.tips_edit.php?lang=" . LANGUAGE_ID . "&bxpublic=Y&ACTIVE=Y&SITE=" . SITE_ID . "&URL=" . urlencode(static::getCurrentPage()),
								"PARAMS" => Array("width" => 920, "height" => 500, 'resize' => FALSE)
							)),
					"TEXT" => Loc::getMessage("intervolga.tips.PANEL_BUTTON_ADD"),
					"HINT" => array(
						"TITLE" => Loc::getMessage("intervolga.tips.PANEL_BUTTON_ADD"),
						"TEXT" => Loc::getMessage("intervolga.tips.PANEL_BUTTON_ADD_DESC"),
					),
				));
			}
			else
			{
				// Add new tip inactive panel button
				$arButton = array_merge($arButton, array(
					"HREF" => "",
					"TEXT" => Loc::getMessage("intervolga.tips.PANEL_BUTTON_MENU"),
					"HINT" => array(
						"TITLE" => Loc::getMessage("intervolga.tips.PANEL_BUTTON_MENU"),
						"TEXT" => Loc::getMessage("intervolga.tips.PANEL_BUTTON_MENU_DESC"),
					),
				));
			}

			if ($this->arResult["TIPS"])
			{
				// Add page tips panel button
				$sQuery = http_build_query(array(
					"lang" => LANGUAGE_ID,
					"bxpublic" => "Y",
					"del_filter" => "Y",
					"IDs" => array_keys($this->arResult["TIPS"])
				));
				$arButton["MENU"][] = array(
					"ACTION" => $APPLICATION->GetPopupLink(
						array(
							"URL" => "/bitrix/admin/intervolga.tips_public_list.php?" . $sQuery,
							"PARAMS" => Array("width" => 920, "height" => 500, 'resize' => false)
						)),
					"TEXT" => Loc::getMessage("intervolga.tips.PANEL_BUTTON_PAGE_TIPS"),
				);
				$arButton["MENU"][] = array("SEPARATOR" => "Y");
			}
			// Add all tips panel button
			$arButton["MENU"][] = array(
				"ACTION" => 'location = "/bitrix/admin/intervolga.tips_list.php?lang=' . LANGUAGE_ID . '&del_filter=Y"' ,
				"TEXT" => Loc::getMessage("intervolga.tips.PANEL_BUTTON_ALL_TIPS"),
			);

			$APPLICATION->addPanelButton($arButton);
		}
	}

	/**
	 * Returns current page uri (without bitrix service params.
	 *
	 * @return string
	 */
	protected function getCurrentPage()
	{
		global $APPLICATION;
		return $APPLICATION->GetCurPageParam("", array(
			"back_url_admin",
			"clear_cache",
			"bitrix_include_areas",
		));
	}
}
?>