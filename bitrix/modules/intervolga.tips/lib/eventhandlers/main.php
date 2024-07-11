<?namespace Intervolga\Tips\EventHandlers;

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/**
 * Handles main module events.
 *
 * @package Intervolga\Tips\EventHandlers
 */
class Main
{
	/**
	 * Wraps each tooltip raw text on page with special tag with an attribute.
	 *
	 * @param string $sContent
	 */
	public static function onEndBufferContent(&$sContent)
	{
		$arPage = explode("</head>", $sContent);
		if (count($arPage) == 2)
		{
			if ((!defined("ADMIN_SECTION") || !ADMIN_SECTION) && class_exists("\\CIntervolgaTipsActivatorComponent"))
			{
				if ($arTips = \CIntervolgaTipsActivatorComponent::getPageTipsForEvent())
				{
					$arEventHandlers = GetModuleEvents("intervolga.tips", "OnTipTextReplace", TRUE);
					if ($arEventHandlers)
					{
						$arEventHandler = array_shift($arEventHandlers);        // Execute only once!
						foreach ($arTips as $arTip)
						{
							$sReplace = ExecuteModuleEvent($arEventHandler, $arTip["TEXT"], $arTip["ID"]);
							$arPage[1] = str_replace($arTip["TEXT"], $sReplace, $arPage[1]);
						}
					}
				}
			}

			$sContent = $arPage[0] . "</head>" . $arPage[1];
		}
	}
}