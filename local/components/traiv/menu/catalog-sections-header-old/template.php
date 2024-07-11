<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>

    <?
        $needCloseUL = false;?>
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
                    <img src="/img/ico/<?=$arItem["ITEM_INDEX"]?>.png" class="itemico"><a href="<?=$arItem["LINK"]?>" class="categories__link"><?=$arItem["TEXT"]?><?//=$arItem["ITEM_INDEX"]?></a></li>
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
     if ($v == $key2) { ?>

       <li class="categories__item col x1d4 x1--t x1--s">
           <img src="/img/ico/<?=$arItem["ITEM_INDEX"]?>.png" class="itemico"><a href="<?=$arItem["LINK"]?>" class="categories__link"><?=$arItem["TEXT"]?><?//=$arItem["ITEM_INDEX"]?></a>
                </li>

    <? } ?>
 <? } ?>
       <? endforeach ?>
<hr class="secondhr">
 <?   foreach($arResult as $arItem):
        if($arItem["DEPTH_LEVEL"] == 1){
            $i++;
            if($needCloseUL){
                echo '</ul></div>';
            }
            $needCloseUL = true;
            ?>
            <div class="a-categories-container x1d1 col x1d6 x1--t x1--s"><p>
            <a class="a-categories-container-header categories__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
            <ul class="u-clear-list"></p>
        <?}

    endforeach;

         if($needCloseUL) echo '</ul></div>'; ?>
    </ul>
<?endif?>