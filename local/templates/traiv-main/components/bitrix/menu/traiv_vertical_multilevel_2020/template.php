<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul id="vertical-multilevel-menu">
<a href="/catalog/"><div class="header-menu-catalog">Каталог товаров</div></a>

<div class="icon-item sale">
    <div class="itemico sprite s-4720 sale"></div><a href="/catalog/rasprodazha_so_sklada/" class="categories__link_main sale">Распродажа со склада</a></li>
</div>

    <div class="icon-item">
        <div class="itemico vysokoprochnyi"></div><a href="/catalog/po-svoistvam/vysokoprochnyi-krepezh/" class="categories__link_main top">Высокопрочный крепёж</a></li>
    </div>
    <div class="icon-item">
        <div class="itemico nerzhavejushchii"></div><a href="/catalog/po-svoistvam/nerzhavejushchii-krepezh/" class="categories__link_main top">Нержавеющий крепёж</a></li>
    </div>
    <div class="icon-item">
        <div class="itemico poliamidnyi"></div><a href="/catalog/po-vidy-materialov/poliamidnyi-krepezh/" class="categories__link_main top">Полиамидный крепёж</a></li>
    </div>
    <div class="icon-item">
        <div class="itemico latynnyi"></div><a href="/catalog/po-vidy-materialov/latynnyi-krepezh/" class="categories__link_main top">Латунный крепёж</a></li>
    </div>
    <div class="icon-item">
        <div class="itemico djuimovyi"></div><a href="/catalog/po-svoistvam/djuimovyi-krepezh/" class="categories__link_main top">Дюймовый крепёж</a></li>
    </div>
    <div class="icon-item">
        <div class="itemico ocinkovannyi"></div><a href="/catalog/po-svoistvam/ocinkovannyi-krepezh/" class="categories__link_main top">Оцинкованный крепёж</a></li>
    </div>


<p class="header-menu krep">Крепёж</p>


    <!--<pre><?/*print_r($arResult)*/?></pre>-->

    <?
    $previousLevel = 0;
    foreach($arResult as $arItem):?>

    <?$arItem["TEXT"] = ($arItem["PARAMS"]["UF_SHORT_NAME"] ?  $arItem["PARAMS"]["UF_SHORT_NAME"] : $arItem["TEXT"]);?>

    <?/*
    $text = $arItem["TEXT"];
    $slova = array('DIN', 'ISO', 'ГОСТ');
    foreach($slova as $item)
    {
        if ($item == 'DIN'){
            if (preg_match("/$item/", $text)) {
                $arItem["TEXT"] = 'DIN ' . preg_replace("/[^0-9]/", "", $arItem["TEXT"]);
            };
        }
        if ($item == 'ISO') {
            if (preg_match("/$item/", $text)) {
                $arItem["TEXT"] = 'ISO ' . preg_replace("/[^0-9]/", "", $arItem["TEXT"]);
            };
        }
        if ($item == 'ГОСТ') {
            if (preg_match("/$item/", $text)) {
                $arItem["TEXT"] = 'ГОСТ ' . preg_replace("/[^0-9]/", "", $arItem["TEXT"]);
            };
        }

    }
    */?>

    <?    $block1 = array("50","52","53","54","1161","58","68","65","1334", "67", "74", "75", "76", "77", "994", "78", "79");  ?>
    <?  If  (in_array($arItem["PARAMS"]["SECTION_ID"], $block1)) {?>

    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>

        <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
    <?endif?>



    <?// echo $arItem["DEPTH_LEVEL"]; ?>
    <?// echo $arItem["IS_PARENT"]; ?>
    <?
    /*$block1 = array("1","2","3","4","6","7","10","13","15","18","19","20","21","22","23","24");*/

    //   echo $arItem["ITEM_INDEX"];
    /*$p = $arItem["ITEM_INDEX"];
    foreach ($block1 as $key1){
    if ($p == $key1) {*/

    if ($arItem["IS_PARENT"]):?>
    <?/*if (in_array($arItem["ITEM_INDEX"], $block1)):*/?>

    <?if ($arItem["DEPTH_LEVEL"] == 2):?>

    <?//echo 'ДВА' ?>

    <li><div class="icon-item">
            <div class="itemico sprite s-<?=$arItem["PARAMS"]["SECTION_ID"]?>"></div><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?> categories__link_main"><?=$arItem["TEXT"]?></a>
        </div>
        <ul class="root-item">

            <?else:?>
            <li><a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>"><?=$arItem["TEXT"]?></a>
                <ul>
                    <?endif?>
                    <?endif?>

                    <?}else{?>

                        <?if ($arItem["PERMISSION"] > "D" && in_array($arItem["PARAMS"]["IBLOCK_SECTION_ID"], $block1)):?>

                            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                                <li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
                            <?else:?>
                                <li><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="item-selected"<?else:?>class="categories__link_main descendant"<?endif?>><?=$arItem["TEXT"]?></a></li>
                            <?endif?>

                            <?/*else:*/?><!--

            <?/*if ($arItem["DEPTH_LEVEL"] == 1):*/?>
                <li><a href="" class="<?/*if ($arItem["SELECTED"]):*/?>root-item-selected<?/*else:*/?>root-item<?/*endif*/?>" title="<?/*=GetMessage("MENU_ITEM_ACCESS_DENIED")*/?>"><?/*=$arItem["TEXT"]*/?></a></li>
            <?/*else:*/?>
                <li><a href="" class="denied" title="<?/*=GetMessage("MENU_ITEM_ACCESS_DENIED")*/?>"><?/*=$arItem["TEXT"]*/?></a></li>
            --><?/*endif*/?>

                        <?endif?>

                    <?}?>



                    <?$previousLevel = $arItem["DEPTH_LEVEL"];?>



                    <?endforeach?>
                </ul></li>

            <p class="header-menu">Промышленные изделия</p>

            <ul id="vertical-multilevel-menu">

                <?
                $previousLevel = 0;
                foreach($arResult as $arItem):?>

                <?$arItem["TEXT"] = ($arItem["PARAMS"]["UF_SHORT_NAME"] ?  $arItem["PARAMS"]["UF_SHORT_NAME"] : $arItem["TEXT"]);?>

                <?    $block2 = array("55","1171","1175", "1178", "3753", "1334", "69", "73");  ?>  <!--1334-->
                <?  If  (in_array($arItem["PARAMS"]["SECTION_ID"], $block2)) {?>



                <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>

                    <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
                <?endif?>

                <?/*if ($arItem["IS_PARENT"]):*/?>

                <?if ($arItem["DEPTH_LEVEL"] == 2):?>


                <li><div class="icon-item">
                        <div class="itemico sprite s-<?=$arItem["PARAMS"]["SECTION_ID"]?>"></div><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?> categories__link_main"><?=$arItem["TEXT"]?> <?//echo $previousLevel ?> <?//echo $arItem["DEPTH_LEVEL"] ?></a>
                    </div>
                    <ul class="root-item">

                        <?else:?>
                        <li><a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>"><?=$arItem["TEXT"]?></a>
                            <ul>
                                <?endif?>
                                <?/*endif*/?>

                                <?}else{?>

                                    <?if ($arItem["PERMISSION"] > "D" && in_array($arItem["PARAMS"]["IBLOCK_SECTION_ID"], $block2)):?>

                                        <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                                            <li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
                                        <?else:?>
                                            <li><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="item-selected"<?else:?>class="categories__link_main descendant"<?endif?>><?=$arItem["TEXT"]?></a></li>

                                        <?endif?>


                                    <?endif?>

                                <?}?>


                                <?$previousLevel = $arItem["DEPTH_LEVEL"];?>

                                <?endforeach?>



                            </ul></li>

                        <p class="header-menu">Дополнительно</p>

                        <ul id="vertical-multilevel-menu">

                            <?
                            $previousLevel = 0;
                            foreach($arResult as $arItem):?>

                            <?$arItem["TEXT"] = ($arItem["PARAMS"]["UF_SHORT_NAME"] ?  $arItem["PARAMS"]["UF_SHORT_NAME"] : $arItem["TEXT"]);?>


                            <?    $block3 = array("106", "107", "108", "110", "1029", "1097");  ?>
                            <?  If  (in_array($arItem["PARAMS"]["SECTION_ID"], $block3)) {?>


                            <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>

                                <?=str_repeat("</ul></li>", 1);?>
                            <?endif?>

                            <?if ($arItem["IS_PARENT"]):?>

                            <?if ($arItem["DEPTH_LEVEL"] == 1):?>


                            <li><div class="icon-item">
                                    <div class="itemico sprite s-<?=$arItem["PARAMS"]["SECTION_ID"]?>"></div><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?> categories__link_main"><?=$arItem["TEXT"]?></a>
                                </div>
                                <ul class="root-item">

                                    <?else:?>
                                    <li><a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>"><?=$arItem["TEXT"]?></a>
                                        <ul>

                                            <?endif?>
                                            <?endif?>

                                            <?}else{?>

                                                <?if ($arItem["PERMISSION"] > "D" && in_array($arItem["PARAMS"]["IBLOCK_SECTION_ID"], $block3)):?>

                                                    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                                                        <li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?>
                                                                </a></li>
                                                    <?else:?>
                                                        <li><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="item-selected" <?else:?>class="categories__link_main descendant"<?endif?>><?=$arItem["TEXT"]?>
                                                               </a></li>
                                                        <?If ($arItem["TEXT"] == "EN"){echo '</ul></li>';};?>
                                                    <?endif?>

                                                <?endif?>


                                            <?}?>


                                            <?$previousLevel = $arItem["DEPTH_LEVEL"];?>


                                            <?endforeach?>

                                        </ul></li>
                                    <?endif?>



