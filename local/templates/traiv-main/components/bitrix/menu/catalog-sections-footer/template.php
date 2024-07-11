<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
$i = 0;    
?>

<div class="traiv-menu-catalog-section-footer">
    <div class="wrap-table">
        <div class="column-menu">
            <? foreach ($arResult as $arItem) {
                if ($arItem["DEPTH_LEVEL"] == 2 && preg_match("/categories/", $arItem["LINK"])) {
                    $i++;
                    $arPath = explode("/", $arItem["LINK"]);
                    $code = $arPath[3];
                    ?>
            <div><a href="<?=$arItem["LINK"]?>" class="traiv-sprite white <?=$code?>"><?=$arItem["TEXT"]?></a></div>
                    <?
                    if ($i == 7) {
                        $i = 0;
                        ?></div><div class="column-menu"><?
                    }
                    ?>
                <?}
            }
            ?>
        </div>
    </div>
</div>