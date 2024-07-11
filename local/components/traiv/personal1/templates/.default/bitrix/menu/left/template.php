<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="traiv-personal-menu-left">
    <?if (!empty($arResult)):?>
        <? foreach($arResult as $arItem):
            if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)  continue;
            
            $addParams = "";
            if (!empty($arItem["PARAMS"])) {
                foreach ($arItem["PARAMS"] as $key => $val) {
                    $addParams .= " $key='" .  $val ."'";
                }
            }
            ?>
            <a <?=$addParams?> href="<?=$arItem["LINK"]?>" <?if($arItem["SELECTED"]):?>class="selected"<? endif;?>><?=$arItem["TEXT"]?></a>
        <?endforeach?>
    <?endif?>
    <a href="/personal/" class="back">< Назад</a>
</div>