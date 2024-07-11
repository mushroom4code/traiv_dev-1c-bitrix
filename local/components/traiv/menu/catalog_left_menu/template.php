<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(empty($arResult)) return;
?>

<ul class="filter">
<?
foreach($arResult as $arItem):?>
<?if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;?>
	<li class="filter__item <?=$arItem['SELECTED']? 'is-active' : ''?>">
		<a href="<?=$arItem["LINK"]?>" class="filter__link"><?=$arItem["TEXT"]?></a>
	</li>	
<?endforeach?>
</ul>