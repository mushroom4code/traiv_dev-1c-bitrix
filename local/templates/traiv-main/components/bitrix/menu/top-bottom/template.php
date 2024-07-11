<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="traiv-menu-top-bottom">
    <div class="container">
    <? if (!empty($arResult)): ?>
        <div class="menu-table">
            <div class="menu-tr">
                <? foreach ($arResult as $arItem):
                    if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) {
                        continue;
                    }
                    ?>
                    <a class="nav__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?><span><?=$arItem["PARAMS"]["DESC"]?></span></a>
                <? endforeach ?>
            </div>
        </div>
    <? endif ?>
    </div>
</div>
