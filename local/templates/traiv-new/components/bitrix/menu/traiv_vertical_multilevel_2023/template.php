<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        /*echo "<div>";
        echo "<pre>";
        print_r($arResult);
        echo "</pre>";
        echo "</div>";*/
    }
}
//die;
?>

<div class="hn-list-item-parent">
<ul class="list-item">
<?php 
$previousLevel = 0;    
foreach($arResult as $arItem){
    $arItem["TEXT"] = ($arItem["PARAMS"]["UF_SHORT_NAME"] ?  $arItem["PARAMS"]["UF_SHORT_NAME"] : $arItem["TEXT"]);
    $block1 = array("50","52","53","54","1161","58","68","65","1334", "67", "74", "75", "5573", "76", "77", "994", "78", "79");
    if  (in_array($arItem["PARAMS"]["SECTION_ID"], $block1)) {
        if ($arItem["DEPTH_LEVEL"] == 2){
        ?>
        <li>
        <a href="<?=$arItem["LINK"]?>" class="item <?= $start_active;?> <?= $arItem['SELECTED'] ? ' vertical-multilevel-selected' : '' ?>" rel="<?=$arItem["PARAMS"]["SECTION_ID"]?>"><i <?php if ($arItem["PARAMS"]["SECTION_ID"] == '5573'){ echo "style='background-position-y: -1151px;'";}?> class="spriten sn-<?=$arItem["PARAMS"]["SECTION_ID"]?> <?= $start_active_icon;?>"></i><?=$arItem["TEXT"]?></a>
        </li>
        <?php
        }
    }
}
?>
</ul>
</div>


<div class="hn-list-item-parent">
<ul class="list-item">
<div class="list-item-title">Промышленные изделия</div>
<?php 
foreach($arResult as $arItem){
$arItem["TEXT"] = ($arItem["PARAMS"]["UF_SHORT_NAME"] ?  $arItem["PARAMS"]["UF_SHORT_NAME"] : $arItem["TEXT"]);
$block2 = array("55","1171","1175", "1178", "3753", "1334", "69", "73");
If  (in_array($arItem["PARAMS"]["SECTION_ID"], $block2)) {   
        if ($arItem["DEPTH_LEVEL"] == 2){
        ?>
        <li>
        <a href="<?=$arItem["LINK"]?>" class="item <?= $start_active;?> <?= $arItem['SELECTED'] ? ' vertical-multilevel-selected' : '' ?>" rel="<?=$arItem["PARAMS"]["SECTION_ID"]?>"><i <?php if ($arItem["PARAMS"]["SECTION_ID"] == '5573'){ echo "style='background-position-y: -1151px;'";}?> class="spriten sn-<?=$arItem["PARAMS"]["SECTION_ID"]?> <?= $start_active_icon;?>"></i><?=$arItem["TEXT"]?></a>
        </li>
        <?php
        }
    }
}
?>
</ul>

<ul class="list-item">
<div class="list-item-title second">Дополнительно</div>
<?php 
foreach($arResult as $arItem){
$arItem["TEXT"] = ($arItem["PARAMS"]["UF_SHORT_NAME"] ?  $arItem["PARAMS"]["UF_SHORT_NAME"] : $arItem["TEXT"]);
$block3 = array("106", "107", "108", "110", "1029", "1097");
If  (in_array($arItem["PARAMS"]["SECTION_ID"], $block3)) {   
    if ($arItem["DEPTH_LEVEL"] == 1){
        ?>
        <li>
        <a href="<?=$arItem["LINK"]?>" class="item <?= $start_active;?> <?= $arItem['SELECTED'] ? ' vertical-multilevel-selected' : '' ?>" rel="<?=$arItem["PARAMS"]["SECTION_ID"]?>"><i <?php if ($arItem["PARAMS"]["SECTION_ID"] == '5573'){ echo "style='background-position-y: -1151px;'";}?> class="spriten sn-<?=$arItem["PARAMS"]["SECTION_ID"]?> <?= $start_active_icon;?>"></i><?=$arItem["TEXT"]?></a>
        </li>
        <?php
        }
    }
}
?>
</ul>  
</div>
    <?php $cur_page = $APPLICATION->GetCurPage(false); ?>
<div class="hn-list-item-parent">
                        <ul class="hn-right-menu">
                        <li class="col"><a href="/takezo/" class="root-item fix <?= ('/takezo/' == $cur_page || strpos($cur_page,'/takezo/')!==false) ? 'vertical-multilevel-selected' : ''?>"><span class="takezo-menu"></span><span style="display:inline-block;width:140px;">Режущий инструмент Takezo</span></a></li>
                           <li class="col"><a href="/catalog/categories/shaiby/din-25201-shaiba-nord-lock/" class="root-item fix <?= ('/catalog/categories/shaiby/din-25201-shaiba-nord-lock/' == $cur_page || strpos($cur_page,'/catalog/categories/shaiby/din-25201-shaiba-nord-lock/')!==false) ? 'vertical-multilevel-selected' : ''?>"><span class="fix-menu"></span>Шайбы 2fix</a></li>
                           <li class="col"><a href="/sandvik/" class="root-item fix <?= ('/sandvik/' == $cur_page || strpos($cur_page,'/sandvik/')!==false) ? 'vertical-multilevel-selected' : ''?>"><span class="sandvik-menu"></span><span style="display:inline-block;width:140px;">Режущий инструмент Sandvik</span></a></li>
                           <!-- <li class="col"><a href="/cutting/" class="root-item fix"><span class="walter-menu"></span><span style="display:inline-block;width:140px;">Режущий инструмент Walter</span></a></li>-->
                           <li class="col"><a href="/hermann-bilz/" class="root-item fix <?= ('/hermann-bilz/' == $cur_page || strpos($cur_page,'/hermann-bilz/')!==false) ? 'vertical-multilevel-selected' : ''?>"><span class="bilz-menu"></span><span style="display:inline-block;width:140px;">Режущий инструмент H.Bilz</span></a></li>
                           <li class="col"><a href="/korloy/" class="root-item fix <?= ('/korloy/' == $cur_page || strpos($cur_page,'/korloy/')!==false) ? 'vertical-multilevel-selected' : ''?>"><span class="korloy-menu"></span><span style="display:inline-block;width:140px;">Режущий инструмент Korloy</span></a></li>
                           <li class="col"><a href="/catalog/po-svoistvam/vysokoprochnyi-krepezh/" class="root-item <?= ('/catalog/po-svoistvam/vysokoprochnyi-krepezh/' == $cur_page || strpos($cur_page,'/catalog/po-svoistvam/vysokoprochnyi-krepezh/')!==false) ? 'vertical-multilevel-selected' : ''?>"><i class="spriten-hn-right-menu rm-2"></i>Высокопрочный крепеж</a></li>
                           <li class="col"><a href="/catalog/po-svoistvam/nerzhavejushchii-krepezh/" class="root-item <?= ('/catalog/po-svoistvam/nerzhavejushchii-krepezh/' == $cur_page || strpos($cur_page,'/catalog/po-svoistvam/nerzhavejushchii-krepezh/')!==false) ? 'vertical-multilevel-selected' : ''?>"><i class="spriten-hn-right-menu rm-3"></i>Нержавеющий крепеж</a></li>
                           <li class="col"><a href="/catalog/po-vidy-materialov/poliamidnyi-krepezh/" class="root-item <?= ('/catalog/po-vidy-materialov/poliamidnyi-krepezh/' == $cur_page || strpos($cur_page,'/catalog/po-vidy-materialov/poliamidnyi-krepezh/')!==false) ? 'vertical-multilevel-selected' : ''?>"><i class="spriten-hn-right-menu rm-4"></i>Полиамидный крепеж</a></li>
                           <li class="col"><a href="/catalog/po-vidy-materialov/latynnyi-krepezh/" class="root-item <?= ('/catalog/po-vidy-materialov/latynnyi-krepezh/' == $cur_page || strpos($cur_page,'/catalog/po-vidy-materialov/latynnyi-krepezh/')!==false) ? 'vertical-multilevel-selected' : ''?>"><i class="spriten-hn-right-menu rm-5"></i>Латунный крепеж</a></li>
                           <li class="col"><a href="/catalog/po-svoistvam/djuimovyi-krepezh/" class="root-item <?= ('/catalog/po-svoistvam/djuimovyi-krepezh/' == $cur_page || strpos($cur_page,'/catalog/po-svoistvam/djuimovyi-krepezh/')!==false) ? 'vertical-multilevel-selected' : ''?>"><i class="spriten-hn-right-menu rm-6"></i>Дюймовый крепеж</a></li>
                           <li class="col"><a href="/actions/" class="root-item <?= ('/actions/' == $cur_page || strpos($cur_page,'/actions/')!==false) ? 'vertical-multilevel-selected' : ''?>"><i class="spriten-hn-right-menu rm-1"></i>Наши акции</a></li>
                       </ul>
</div>

<div class="header-new-catarea-bottom">
	<a href="/catalog/" class="header-new-catarea-btlink-left">Перейти в полный каталог</a>
	<a href="/katalog-standartnogo-krepezha/" class="header-new-catarea-btlink-right">Каталог стандартного крепежа</a>
</div>
                          
<?
if(CSite::InDir('/catalog/')){
    //echo "<div class='stf_filter' rel='1'><i class='icofont icofont-filter'></i><span class='stf_filter_title'>Показать фильтр</span></div>";
}
?>
<?endif?>
