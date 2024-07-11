<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(empty($arResult)) return;
?>
<div class="gdo-new-area-parent">

<div class="gdo-new-title">Каталог</div>

<ul class="gdo-new-area">
<?
foreach($arResult as $arItem):?>
<?if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;?>
	<li class="gdo__new_item">
		<a href="<?=$arItem["LINK"]?>" class="gdo__new_link <?=$arItem['SELECTED']? 'is-active' : ''?>"><?=$arItem["TEXT"]?></a>
	</li>	
<?endforeach?>
</ul>
</div>