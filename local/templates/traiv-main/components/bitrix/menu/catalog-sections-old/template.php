<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<div class="traiv-menu-catalog-sections">
    <div class="header-menu">Каталог товаров</div>
    <div class="catalog-items">
<?
$previousLevel = 0;
$first = true;
$i = 1;
foreach($arResult as $arItem):?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</div></div>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<div class="root-item"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                            <div class="children">
		<?else:?>
			<div><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
                            <div class="children">
		<?endif?>

	<?else:?>
            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                    <div class="root-item"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></div>
            <?else:?>
                <? if (preg_match('/categories/', $arItem["LINK"])) :
                    $arPath = explode("/", $arItem["LINK"]);
                    $code = $arPath[3];
                    ?>
                    <div><a href="<?=$arItem["LINK"]?>" class="traiv-sprite <?=$code?>"><?=$arItem["TEXT"]?></a></div>
                <?
                $i++;
                endif?>
            <?endif?>


	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</div></div>", ($previousLevel-1) );?>
<?endif?>

</div>
</div>

<?endif?>