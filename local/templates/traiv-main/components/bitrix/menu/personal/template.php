<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<?
if (!empty($arResult)){?>
    <ul class="dashboard-nav">
        <?foreach ($arResult as $arItem):
            if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;?>
            <?if($arItem["SELECTED"]){?>
                <li class="dashboard-nav__item is-active">
                    <span class="dashboard-nav__link"><?=$arItem["TEXT"]?></span>
                </li>
            <?}else{?>
                <li class="dashboard-nav__item">
                    <a href="<?=$arItem["LINK"]?>" class="dashboard-nav__link"><?=$arItem["TEXT"]?></a>
                </li>
            <?}?>
        <? endforeach ?>
    </ul>
<?}?>


