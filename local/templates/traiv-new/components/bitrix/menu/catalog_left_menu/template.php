<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(empty($arResult)) return;
?>

<ul class="gdo-area">
<?
foreach($arResult as $arItem):?>
<?if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;?>
	<li class="gdo__item">
		<a href="<?=$arItem["LINK"]?>" class="gdo__link <?=$arItem['SELECTED']? 'is-active' : ''?>"><?=$arItem["TEXT"]?></a>
	</li>	
<?endforeach?>
</ul>