<?
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */
define("STOP_STATISTICS", true);
define("BX_SECURITY_SHOW_MESSAGE", true);
define('NO_AGENT_CHECK', true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

header('Content-type: application/javascript');

$arTips = array();
$arRequestFrom = parse_url($_SERVER["HTTP_REFERER"]);

if ($arRequestFrom["host"] == $_SERVER["SERVER_NAME"])
{
	if ($_GET["page"] && $_GET["site"])
	{
		if (\Bitrix\Main\Loader::includeModule("intervolga.tips"))
		{
			// cache tips
			$obCache = new CPHPCache();
			$iCacheTime = 60*60*24*30;
			$sCacheId = "intervolga.tips/json/" . md5($_GET["site"] . ":" . $_GET["page"]);
			$sCachePath = "/" . $sCacheId;
			if ($obCache->InitCache($iCacheTime, $sCacheId, $sCachePath))
			{
				$arVars = $obCache->GetVars();
				$arTips = $arVars['arTips'];
			}
			elseif($obCache->StartDataCache())
			{
				if (defined('BX_COMP_MANAGED_CACHE') && is_object($GLOBALS['CACHE_MANAGER']))
				{
					global $CACHE_MANAGER;
					$CACHE_MANAGER->StartTagCache($sCachePath);
					$CACHE_MANAGER->RegisterTag("intervolga_tips");
					$CACHE_MANAGER->EndTagCache();
				}

				$arTips = \Intervolga\Tips\Orm\TipsTable::getPageList($_GET["page"], $_GET["site"]);
				if ($arTips)
				{
					$obCache->EndDataCache(array('arTips' => $arTips));
				}
				else
				{
					$obCache->AbortDataCache();
				}
			}
		}
	}
	?>window.intervolga_tips = <?=json_encode($arTips)?>;<?
}