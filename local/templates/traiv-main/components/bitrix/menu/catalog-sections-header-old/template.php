<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>

    <?
    $needCloseUL = false;?>
    <li class="categories__item sale col x1d4 x1--t x1--s">
        <div class="itemico sale sprite s-4720 lazy"></div><a href="/catalog/rasprodazha_so_sklada/" class="categories__link sale">Распродажа со склада</a></li>
    </li>

    <p class="lineheaders">Крепёж</p>
    <?
    foreach($arResult as $arItem):
        if($arParams["MAX_LEVEL"] < $arItem["DEPTH_LEVEL"]) continue;

        $block1 = array("1","2","3","4","6","7","10","13","15","18","19","20","21","22","23","24");
        $p = $arItem["ITEM_INDEX"];
        foreach ($block1 as $key1){
            if ($p == $key1) {
                ?>
                <li class="categories__item col x1d4 x1--t x1--s">
                    <div class="itemico sprite s-<?=$arItem["PARAMS"]["SECTION_ID"]?>"></div><a href="<?=$arItem["LINK"]?>" class="categories__link left-menu"><?=$arItem["TEXT"]?><?//=$arItem["ITEM_INDEX"]?></a></li>
                </li>
            <?}?>
        <?}?>



    <?endforeach?>
    <!-- <hr class="firsthr"> -->
    <p class="lineheaders">Промышленные изделия</p>
    <?   foreach($arResult as $arItem):

        $block2 = array("5","8","9","11","12","14","16","17");
        $v = $arItem["ITEM_INDEX"];
        foreach ($block2 as $key2){
            if ($v == $key2) {

                ?>

                <li class="categories__item col x1d4 x1--t x1--s">
                    <div class="itemico sprite s-<?=$arItem["PARAMS"]["SECTION_ID"]?>"></div><a href="<?=$arItem["LINK"]?>" class="categories__link left-menu"><?=$arItem["TEXT"]?><?//=$arItem["ITEM_INDEX"]?></a>
                </li>

            <? } ?>
        <? } ?>
    <? endforeach ?>
    <hr class="secondhr">
    <?   foreach($arResult as $arItem):


        $block3 = array("0","25","34","44","50","59");
        $g = $arItem["ITEM_INDEX"];

        foreach ($block3 as $key3) {
            if ($g == $key3) {

                if ($arItem["DEPTH_LEVEL"] == 1) {

                    $i++;
                    if ($needCloseUL) {
                        echo '</ul></div>';
                    }
                    $needCloseUL = true;
                    ?>
                    <div class="categories__item-last col x1d6 x1--t x1--s"><p>
                    <div class="itemico sprite s-<?=$arItem["PARAMS"]["SECTION_ID"]?>"></div>
                    <a class="a-categories-container-header categories__link left-menu"
                       href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                    <ul class="u-clear-list"></p>
                    <?
                }
            }
        }
    endforeach;

    if($needCloseUL) echo '</ul></div>'; ?>
    </ul>
<?endif?>