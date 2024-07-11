<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(empty($arResult)) return;
?>
<div class="footer-catalog-menu-title">Навигация</div>
<ul class="bottom-menu">
<?
foreach($arResult as $arItem):?>
<?if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;?>
	<li class="bottom-menu-item <?=$arItem['SELECTED']? 'is-active' : ''?>">
		<a href="<?=$arItem["LINK"]?>" class="bottom-menu-link" rel="nofollow"><?=$arItem["TEXT"]?></a>
	</li>	
<?endforeach?>
</ul>