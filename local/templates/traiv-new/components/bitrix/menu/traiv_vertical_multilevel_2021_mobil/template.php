<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<div class="left_catalog_area_mobil">


<div class="left_catalog_menu_content_mobil">

 <div class="left_catalog_menu_content_viewport_mobil" data-simplebar class="demo">
    <div class="canvas">

<div class="left_catalog_menu_mobil">
	
	<div class="left_catalog_main_menu_mobil">
	<ul class="list_item_mobil">
	    <?
	$arr_sub_item = array();
	$arr_sub_item_help = array();
    $previousLevel = 0;
    foreach($arResult as $arItem):?>
    <?$arItem["TEXT"] = ($arItem["PARAMS"]["UF_SHORT_NAME"] ?  $arItem["PARAMS"]["UF_SHORT_NAME"] : $arItem["TEXT"]);?>
    <?    $block1 = array("50","52","53","54","1161","58","68","65","1334", "67", "74", "75", "76", "77", "994", "78", "79");  ?>
    <?  If  (in_array($arItem["PARAMS"]["SECTION_ID"], $block1)) {
    ?>
    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
    <?/*=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));*/?>
    <?endif?>
    <?if ($arItem["IS_PARENT"]):?>
    <?if ($arItem["DEPTH_LEVEL"] == 2):?>
    <li>
    <?php 
    if ($arItem["PARAMS"]["SECTION_ID"] == '50'){
        $start_active="active";
        $start_active_icon="active_icon";
    } else {
        $start_active="";
        $start_active_icon="";
    }
    
    ?>
    <a href="<?=$arItem["LINK"]?>" class="item_mobil <?= $start_active;?>" rel="<?=$arItem["PARAMS"]["SECTION_ID"]?>"><i class="spriten sn-<?=$arItem["PARAMS"]["SECTION_ID"]?> <?= $start_active_icon;?>"></i><?=$arItem["TEXT"]?></a>
    <div class="item_mobil_nav" rel="<?=$arItem["PARAMS"]["SECTION_ID"]?>"><i class="fa fa-arrow-right"></i></div>
        <?php  
        
        
        $prev_item_help = "";
        $prev_item_help2 = "";
        $arr_sub_item[$arItem["PARAMS"]["SECTION_ID"]] = array('NAME'=>$arItem["TEXT"],'ITEMS'=>array());?>
        <?php 
        
        if ($arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 50 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 52 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 53 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 54 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 68 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 74 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 78) {
            $arr_sub_item_help[$arItem["PARAMS"]["SECTION_ID"]] = array('FSEARCH'=>array(),'SSEARCH'=>array());
        }?>
        <?else:?>
         <a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>"><?=$arItem["TEXT"]?></a>
                    <?endif?>
                    <?endif?>
                    <?}else{?>
                      <?if ($arItem["PERMISSION"] > "D" && in_array($arItem["PARAMS"]["IBLOCK_SECTION_ID"], $block1)):?>
                       <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                        <?else:?>
                           <?php 
                            
                            if ($arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 50 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 52 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 53 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 54 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 68 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 74 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 67 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 78) {
                                
                                $help_item = explode(" ", $arItem["TEXT"]);
                                  
                                if (in_array($help_item_one, $arr_sub_item_help[$arItem["PARAMS"]["IBLOCK_SECTION_ID"]]["FSEARCH"] ?? [])) {
                                
                                }
                                else {
                                    $arr_sub_item_help[$arItem["PARAMS"]["IBLOCK_SECTION_ID"]]["FSEARCH"][] = $help_item_one;
                                }
                             
                            
                            
                                if (is_numeric($help_item['1'])){
                                    
                                    $help_item_val = str_split($help_item['1']);
                                    if (in_array($help_item_val['0'], $arr_sub_item_help[$arItem["PARAMS"]["IBLOCK_SECTION_ID"]]["SSEARCH"] ?? [])) {
                                        
                                    }
                                    else 
                                    {
                                        $arr_sub_item_help[$arItem["PARAMS"]["IBLOCK_SECTION_ID"]]["SSEARCH"][] = iconv('windows-1251','utf-8',$help_item_val['0']);
                                    }
                                }
       }

                                $arr_sub_item[$arItem["PARAMS"]["IBLOCK_SECTION_ID"]]['ITEMS'][] = array($arItem["TEXT"],$arItem["LINK"],$help_item_one,iconv('windows-1251','utf-8',$help_item_val['0']));
                            
                            ?>
                                <?If ($arItem["TEXT"] == "ISO"){echo '</ul></li>';};?>
                            <?endif?>
                        <?endif?>
                    <?}?>
                    <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
                    <?endforeach?>
</div>
	
	<div class="left_catalog_main_menu_mobil">
	
	<div class="list_item_title_mobil">Промышленные изделия</div>
	
		<ul class="list_item_mobil">
	    <?
	$arr_sub_item2 = array();
    $previousLevel = 0;
    foreach($arResult as $arItem):
    $arItem["TEXT"] = ($arItem["PARAMS"]["UF_SHORT_NAME"] ?  $arItem["PARAMS"]["UF_SHORT_NAME"] : $arItem["TEXT"]);
    $block2 = array("55","1171","1175", "1178", "3753", "1334", "69", "73");
    If  (in_array($arItem["PARAMS"]["SECTION_ID"], $block2)) {     

    //if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel)

        //str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));

    if ($arItem["IS_PARENT"]) {
    if ($arItem["DEPTH_LEVEL"] == 2):?>
<li><a href="<?=$arItem["LINK"]?>" class="item_mobil" rel="<?=$arItem["PARAMS"]["SECTION_ID"]?>"><i class="spriten sn-<?=$arItem["PARAMS"]["SECTION_ID"]?>"></i><?=$arItem["TEXT"]?></a>
<div class="item_mobil_nav" rel="<?=$arItem["PARAMS"]["SECTION_ID"]?>"><i class="fa fa-arrow-right"></i></div>
    
        <?php  $arr_sub_item2[$arItem["PARAMS"]["SECTION_ID"]] = array('NAME'=>$arItem["TEXT"],'ITEMS'=>array());?>
        <!--<ul class="sub-item" rel="<?php echo $arItem["PARAMS"]["SECTION_ID"];?>">-->
            <?else:?>
            <!--  <li> -->
            <a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>"><?=$arItem["TEXT"]?></a>
                    <?endif?>
                    <?}
                      }else{
                         if ($arItem["PERMISSION"] > "D" && in_array($arItem["PARAMS"]["IBLOCK_SECTION_ID"], $block2)):?>
                            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                                <!-- <li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected categories__link_main descendant<?else:?>root-item categories__link_main descendant<?endif?>"><?=$arItem["TEXT"]?>
                                    </a></li>-->
                            <?else:?>
                            <?php $arr_sub_item[$arItem["PARAMS"]["IBLOCK_SECTION_ID"]]['ITEMS'][] = array($arItem["TEXT"],$arItem["LINK"]);?>
                                <?If ($arItem["TEXT"] == "ISO"){echo '</ul></li>';};?>
                            <?endif?>
                        <?endif?>
                    <?} 
                     $previousLevel = $arItem["DEPTH_LEVEL"];?>
                    <?endforeach?>
	
	</div>
	
		<div class="left_catalog_main_menu_mobil">
	
	<div class="list_item_title_mobil">Дополнительно</div>
	
		<ul class="list_item_mobil">
	    <?
	$arr_sub_item3 = array();
    $previousLevel = 0;
    foreach($arResult as $arItem):?>

    <?$arItem["TEXT"] = ($arItem["PARAMS"]["UF_SHORT_NAME"] ?  $arItem["PARAMS"]["UF_SHORT_NAME"] : $arItem["TEXT"]);?>



    <?    $block3 = array("106", "107", "108", "110", "1029", "1097");  ?>
    <?  If  (in_array($arItem["PARAMS"]["SECTION_ID"], $block3)) {
    
       
        ?>

    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>

        <?/*=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));*/?>
    <?endif?>



    <?

    if ($arItem["IS_PARENT"]):?>

    <?if ($arItem["DEPTH_LEVEL"] == 1):?>


    <li>
    
    <a href="<?=$arItem["LINK"]?>" class="item_mobil" rel="<?=$arItem["PARAMS"]["SECTION_ID"]?>"><i class="spriten sn-<?=$arItem["PARAMS"]["SECTION_ID"]?>"></i><?=$arItem["TEXT"]?></a>
    <div class="item_mobil_nav" rel="<?=$arItem["PARAMS"]["SECTION_ID"]?>"><i class="fa fa-arrow-right"></i></div>
    
        <?php  $arr_sub_item3[$arItem["PARAMS"]["SECTION_ID"]] = array('NAME'=>$arItem["TEXT"],'ITEMS'=>array());?>
        
        <!--<ul class="sub-item" rel="<?php echo $arItem["PARAMS"]["SECTION_ID"];?>">-->

            <?else:?>
            <!--  <li> -->
            <a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>"><?=$arItem["TEXT"]?></a>
                
                    <?endif?>
                    <?endif?>

                    <?}else{?>

                        <?if ($arItem["PERMISSION"] > "D" && in_array($arItem["PARAMS"]["IBLOCK_SECTION_ID"], $block3)):?>

                            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                                <!-- <li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected categories__link_main descendant<?else:?>root-item categories__link_main descendant<?endif?>"><?=$arItem["TEXT"]?>
                                    </a></li>-->
                            <?else:?>
                            
                            <?php $arr_sub_item[$arItem["PARAMS"]["IBLOCK_SECTION_ID"]]['ITEMS'][] = array($arItem["TEXT"],$arItem["LINK"]);?>
                                <?If ($arItem["TEXT"] == "EN"){/*echo '<b>sdf</b></ul></li>';*/};?>
                            <?endif?>

                        <?endif?>

                    <?}?>



                    <?$previousLevel = $arItem["DEPTH_LEVEL"];?>



                    <?endforeach?>
                </li>
            
                </ul>
	
	</div>
	
	<div class="left_catalog_main_menu_mobil">
	
	<div class="list_item_title_mobil">Режущий инструмент</div>
	
		<ul class="list_item_mobil">
	<li>
    
    <a href="/takezo/" class="item_mobil">Режущий инструмент Takezo</a>
    </li>
    
    <li>
    
    <a href="/catalog/categories/shaiby/din-25201-shaiba-nord-lock/" class="item_mobil">Шайбы 2fix</a>
    </li>
    
        <li>
    
    <a href="/sandvik/" class="item_mobil">Режущий инструмент Sandvik</a>
    </li>
    
            <li>
    
    <a href="/cutting/" class="item_mobil">Режущий инструмент Walter</a>
    </li>
    
                <li>
    
    <a href="/hermann-bilz/" class="item_mobil">Режущий инструмент H.Bilz</a>
    </li>
    
                    <li>
    
    <a href="/korloy/" class="item_mobil">Режущий инструмент Korloy</a>
    </li>
    	
		</ul>
	</div>
	
</div>

      <div class="centered_mobil" data-simplebar>
      <a href="#" class="item_mobil_nav_back"><i class="fa fa-arrow-left"></i>Вернуться назад</a>
      
      <?php
foreach ($arr_sub_item as $key=>$val){
    
    //if (count($arr_sub_item_help[$key]) > 0) {
    if (is_countable($arr_sub_item_help[$key]) && count($arr_sub_item_help[$key]) > 0){
        if ($key == '50') {
            $start = 'style="display: block;"';
        }
        else {
            $start = '';
        }
    
}
if (count ($val['ITEMS']) < 4) {
    $column = 'style="column-count:unset;-moz-column-count:unset;-webkit-column-count:unset;"';
} else {
    $column = 'style="column-count:2;-moz-column-count:2;-webkit-column-count:2;"';
}
?>
    <ul class="sub_item_content_mobil" id='sic-mobil-<?php echo $key;?>' <?= $start;?> <?= $column;?>>
<?php   
    foreach ($val['ITEMS']  as $key1=>$val1) {
        $data_helps_name = mb_strtolower($val1['2']);
        ?>
        <li data-helps-name="<?php echo $data_helps_name;?>" data-helps-name-second="<?php echo $val1['3'];?>" class="catalog_item_help">
            <a href="<?php echo $val1['1'];?>" class="catalog_item_mobil">
            	<div class="fm-item"></div>
                <span>
                <?php
                    echo $val1['0'];
                ?>
            	</span>
        	</a>
        	
    	</li>
    <?php     
    }
        
    unset($column);
    ?>
    
    </ul>
    <?php 
}
?>
      
      
      </div>

    </div>
  </div>



</div>

                                    
<?
if(CSite::InDir('/catalog/')){
    //echo "<div class='stf_filter' rel='1'><i class='icofont icofont-filter'></i><span class='stf_filter_title'>Показать фильтр</span></div>";
}
?>
                                    
</div>

<?endif?>
