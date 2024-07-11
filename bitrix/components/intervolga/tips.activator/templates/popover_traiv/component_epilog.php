<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CJSCore::Init(array("ajax"));   // To include BX function
if ($arResult["TIPS"])
{
	global $APPLICATION;
	ob_start();
	?>
	<script type="text/javascript">BX(function() {intervolgaTips.activate("<?=$arParams["POSITION"]?>")});</script>
	<?
	$APPLICATION->AddHeadString(ob_get_clean());
}

/**
 * How to replace default tip text
 */
if ($arParams["HINT_STYLE"] == "DASHED")
{
	\Bitrix\Main\EventManager::getInstance()->addEventHandler("intervolga.tips", "OnTipTextReplace", function($sText, $iTipId) {
		return '<span data-intervolga-tips-id="' . $iTipId . '" class="iv-dashed">' . $sText . '</span>';
	});
}
else
{
	\Bitrix\Main\EventManager::getInstance()->addEventHandler("intervolga.tips", "OnTipTextReplace", function($sText, $iTipId) {
		return $sText . ' <i class="iv-label iv-label-default iv-label-circle" id="LABEL" data-intervolga-tips-id="' . $iTipId . '"></i>';
	});
}