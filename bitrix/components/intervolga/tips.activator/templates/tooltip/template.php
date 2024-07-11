<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!--noindex-->
<? if ($arResult["ERRORS"]): ?>
	<?=ShowError(implode("<br/>", $arResult["ERRORS"]))?>
<? endif ?>
<? if ($arResult["TIPS"]): ?>
	<div id="intervolgaTipsTemplateTooltip" style="display: none;" class="iv-tooltip iv-tooltip-in">
		<div class="iv-tooltip-arrow"></div>
		<div class="iv-tooltip-inner">#TOOLTIP#</div>
	</div>
<? endif ?>
<!--/noindex-->