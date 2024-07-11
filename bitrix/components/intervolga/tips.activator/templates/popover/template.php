<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!--noindex-->
<? if ($arResult["ERRORS"]): ?>
	<?=ShowError(implode("<br/>", $arResult["ERRORS"]))?>
<? endif ?>
<? if ($arResult["TIPS"]): ?>
	<div id="intervolgaTipsTemplatePopover" style="display: none;" class="iv-popover iv-popover-in">
		<div class="iv-arrow"></div>
		<div class="iv-popover-content">#TOOLTIP#</div>
	</div>
<? endif ?>
<!--/noindex-->
