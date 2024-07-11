<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="traiv-catalog-section-headers">
    <div class="close"></div>

    <a class="mobile-header-menu-item x1d2 white-shadow" href="/catalog/"><div class="header-menu-item-fist-txt">Каталог</div><span class="header-menu-item-second-txt">С удобным инструментом подбора</span></a>
    <? foreach ($arResult as $arItem):
        if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) {
            continue;
        }
        ?>
        
        <a class="mobile-header-menu-item x1d2 white-shadow" href="<?=$arItem["LINK"]?>"><div class="header-menu-item-fist-txt"><?=$arItem["TEXT"]?></div><span class="header-menu-item-second-txt"><?=$arItem["PARAMS"]["DESC"]?></span></a>
    <? endforeach ?>
</div>