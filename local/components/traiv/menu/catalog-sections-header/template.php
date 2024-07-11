<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="traiv-catalog-section-headers">
    <div class="close"></div>
    <? foreach ($arResult as $arItem):
        if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) {
            continue;
        }
        ?>
        <a class="nav__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?><span><?=$arItem["PARAMS"]["DESC"]?></span></a>
    <? endforeach ?>
</div>