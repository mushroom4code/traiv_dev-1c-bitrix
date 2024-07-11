<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<div id="horizontal-multilevel-menu-mobil-area">
<ul id="horizontal-multilevel-menu-mobil" class="f-level">

<?

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        /*echo "<textarea cols='60' rows='20'>";
        echo "<pre>";
        print_r($arResult);
        echo "</pre>";
        echo "</textarea>";*/
    }
}

$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li rel="1" class="f-level"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
			<!-- <div class="item_mobil_nav" rel="<?=$arItem["PARAMS"]["SECTION_ID"]?>"><i class="fa fa-arrow-right"></i></div>-->
			<div class='main_menu_arrow' rel="<?php echo "m".$arItem['ITEM_INDEX'];?>"><i class="fa fa-arrow-right"></i></div>
				<div class="root_back" id="sic_m<? echo $arItem['ITEM_INDEX'];?>">
				    <a href="#" class="sic_m_mobil_nav_back"><i class="fa fa-arrow-left"></i>Вернуться назад</a>
				<ul rel="ul1">
		<?else:?>
			<li<?if ($arItem["SELECTED"]):?> class="s-level item-selected"<?endif?> rel="li1"><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
				<ul>
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li rel="2" class="f-level"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a><!-- <div class='main_menu_sep'></div>--></li>
			<?else:?>
				<li<?if ($arItem["SELECTED"]):?> class="s-level item-selected"<?endif?> rel="li1"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

			<?/*if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li rel="3"><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif*/?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1):?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>

</div>
<div class="menu-clear-left"></div>
</div>
<?endif?>