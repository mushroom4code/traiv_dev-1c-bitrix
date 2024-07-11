<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<div class="traiv-menu-catalog-sections">
    <div class="header-menu-catalog">Каталог товаров</div>

    <div class="icon-item">
        <div class="itemico sprite s-4720 sale"></div><a href="/catalog/rasprodazha_so_sklada/" class="categories__link_main sale">Распродажа со склада</a></li>
    </div>

    <div class="menu-block-1">

    <p class="header-menu-top krep">Крепёж</p>
    <div class="catalog-items">
<?

foreach($arResult as $arItem):?>


        <?
            $block1 = array("1","2","3","4","6","7","10","13","15","18","19","20","21","22","23","24");
            $p = $arItem["ITEM_INDEX"];
            foreach ($block1 as $key1){
            if ($p == $key1) {
            ?>
    <div class="icon-item">
        <div class="itemico sprite s-<?=$arItem["ITEM_INDEX"]?>"></div><a href="<?=$arItem["LINK"]?>" class="categories__link_main"><?=$arItem["TEXT"]?><?//=$arItem["ITEM_INDEX"]?></a></li>
    </div>
            <?}?>
            <?}?>


	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

    </div>

     <div class="menu-showmore">Показать еще...</div>

        <div class="menu-block-2" hidden>

    <p class="header-menu" >Промышленные изделия</p>
    <?   foreach($arResult as $arItem):

        $block2 = array("5","8","9","11","12","14","16","17");
        $v = $arItem["ITEM_INDEX"];
        foreach ($block2 as $key2){
            if ($v == $key2) {

                ?>

    <div class="icon-item" >
        <div class="itemico sprite s-<?=$arItem["ITEM_INDEX"]?>"></div><a href="<?=$arItem["LINK"]?>" class="categories__link_main"><?=$arItem["TEXT"]?><?//=$arItem["ITEM_INDEX"]?></a>
    </div>

            <? } ?>
        <? } ?>
    <? endforeach ?>
</div>

        <div class="menu-block-3" hidden>

            <p class="header-menu" >Дополнительно</p>
         <?   foreach($arResult as $arItem):


        $block3 = array("0","25","34","44","49","58");
        $g = $arItem["ITEM_INDEX"];

        foreach ($block3 as $key3) {
            if ($g == $key3) {

                     if ($arItem["DEPTH_LEVEL"] == 1) {


                ?>
        <div class="icon-item" >
            <div class="itemico sprite s-<?=$arItem["ITEM_INDEX"]?>"></div><a href="<?= $arItem["LINK"]?>" class="categories__link_bottom"><?= $arItem["TEXT"] ?></a>
        </div>
                <?
                     }
            }
        }
    endforeach;?>
        </div>
        <div class="menu-showless" hidden>Свернуть</div>



</div>
</div>

<?endif?>