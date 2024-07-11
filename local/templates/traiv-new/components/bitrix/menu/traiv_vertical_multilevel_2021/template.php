<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):

/*if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        echo "<div style='border:1px green solid;height:700px;overflow:auto;'>";
        echo "<pre>";
        print_r($arResult);
        echo "</pre>";
        echo "</div>";
    }
}*/

?>
<div class="left_catalog_area">


<div class="left_catalog_menu_content">

 <div class="left_catalog_menu_content_viewport" data-simplebar class="demo">
    <div class="canvas">

<div class="left_catalog_menu">
	
	<div class="left_catalog_main_menu">
	<ul class="list_item">
	    <?
	$arr_sub_item = array();
	$arr_sub_item_help = array();
    $previousLevel = 0;    
    foreach($arResult as $arItem):?>
    <?$arItem["TEXT"] = ($arItem["PARAMS"]["UF_SHORT_NAME"] ?  $arItem["PARAMS"]["UF_SHORT_NAME"] : $arItem["TEXT"]);?>
    <?    $block1 = array("50","52","53","54","1161","58","68","65","1334", "67", "74", "75", "5573", "76", "77", "994", "78", "79");?>
    <?  If  (in_array($arItem["PARAMS"]["SECTION_ID"], $block1)) {
    ?>
    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
    <?/*=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));*/?>
    <?endif?>
    <?/*if ($arItem["IS_PARENT"]):*/?>
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
    <a href="<?=$arItem["LINK"]?>" class="item <?= $start_active;?>" rel="<?=$arItem["PARAMS"]["SECTION_ID"]?>"><i <?php if ($arItem["PARAMS"]["SECTION_ID"] == '5573'){ echo "style='background-position-y: -1151px;'";}?> class="spriten sn-<?=$arItem["PARAMS"]["SECTION_ID"]?> <?= $start_active_icon;?>"></i><?=$arItem["TEXT"]?></a>
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
                    <?/*endif*/?>
                    <?}else{?>
                      <?if ($arItem["PERMISSION"] > "D" && in_array($arItem["PARAMS"]["IBLOCK_SECTION_ID"], $block1)):?>
                       <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                        <?else:?>
                           <?php 
                            
                            if ($arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 50 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 52 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 53 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 54 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 68 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 74 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 67 || $arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 78) {
                                
                                $help_item = explode(" ", $arItem["TEXT"]);
                                
                                //анкеры
                                if ($arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 50) {
                                    if ($help_item['0'] === 'Анкер' && ($help_item['1'] !== 'металлический' && $help_item['1'] !== 'PKN' && $help_item['1'] !== 'для'))
                                    {
                                        $help_item_one = $help_item['1'];
                                    }
                                    else if ($help_item['0'] === 'Анкер' && $help_item['1'] === 'металлический')
                                    {
                                        $help_item_one = "MULTI-MONTI";
                                    }
                                    else if ($help_item['0'] === 'Анкерный')
                                    {
                                        $help_item_one = "Анкерный болт";
                                    }
                                    else if ($help_item['0'] === 'Гильза' || $help_item['0'] === 'Гвоздь' || $help_item['0'] === 'Анкер-клин' || $help_item['0'] === 'Анкер-шуруп' || $help_item['0'] === 'БСР' || $help_item['0'] === 'Шпилька' || $help_item['0'] === 'Анкеры' || $help_item['0'] === 'Шуруп')
                                    {
                                        $help_item_one = "Прочие";
                                    }
                                    else if ($help_item['0'] === 'Анкер' && $help_item['1'] === 'PKN')
                                    {
                                        $help_item_one = "Прочие";
                                    }
                                    else if ($help_item['0'] === 'Анкер' && $help_item['1'] === 'для')
                                    {
                                        $help_item_one = "Прочие";
                                    }
                                    else if ($help_item['0'] === 'Распорный')
                                    {
                                        $help_item_one = "распорный";
                                    }
                                    else if ($help_item['0'] === 'Забивной')
                                    {
                                        $help_item_one = "забивной";
                                    }
                                    else if ($help_item['0'] === 'Латунный')
                                    {
                                        $help_item_one = "латунный";
                                    }
                                    else {
                                        $help_item_one = $help_item['0'];
                                    }
                                }
                                //винты
                                else if ($arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 53) {
                                    if ($help_item['0'] === 'Винт'  && ($help_item['1'] !== 'шуруп' && $help_item['1'] !== 'с'))
                                    {
                                        $help_item_one = $help_item['1'];
                                    }
                                    else if ($help_item['0'] === 'Винты' && ($help_item['1'] !== 'установочные'))
                                    {
                                        $help_item_one = "Прочие";
                                    }
                                    else if ($help_item['1'] === 'шуруп')
                                    {
                                        $help_item_one = "Винт-шуруп";
                                    }
                                    else if ($help_item['1'] === 'установочные')
                                    {
                                        $help_item_one = "Установочные";
                                    }
                                    else if ($help_item['1'] === 'с')
                                    {
                                        $help_item_one = "Прочие";
                                    }
                                    else if ($help_item['0'] === 'Винт-стяжка')
                                    {
                                        $help_item_one = "мебельный";
                                    }
                                    else {
                                        $help_item_one = $help_item['0'];
                                    }
                                }
                                //гайки
                                elseif ($arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 54) {
                                    if ($help_item['0'] === 'DIN' || $help_item['0'] === 'ISO' || $help_item['0'] === 'EN')
                                    {
                                        $help_item_one = $help_item['0'];
                                    }
                                    /*else if ($help_item['0'] === 'Гайки' && $help_item['1'] !== 'с'){
                                        $help_item_one = $help_item['1'];
                                    }
                                    else if ($help_item['0'] === 'Гайки' && $help_item['1'] === 'с')
                                    {
                                        $help_item_one = "с фланцем";
                                    }*/
                                    else {
                                        $help_item_one = "Прочие";
                                    }
                                }
                                //шайбы
                                else if ($arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 74) {
                                    if ($help_item['0'] === 'Шайбы'/*  && ($help_item['1'] !== 'шуруп' && $help_item['1'] !== 'с')*/)
                                    {
                                        $help_item_one = $help_item['1'];
                                    }
                                    else if ($help_item['0'] === 'Шайба')
                                    {
                                        $help_item_one = "Прочие";
                                    }
                                    else {
                                        $help_item_one = $help_item['0'];
                                    }
                                }
                                //саморезы
                                else if ($arItem["PARAMS"]["IBLOCK_SECTION_ID"] == 67) {
                                    if ($help_item['0'] === 'Саморез'  && ($help_item['1'] !== 'флюгель' && $help_item['1'] !== 'для'))
                                    {
                                        $help_item_one = $help_item['1'];
                                    }
                                    else if ($help_item['1'] === 'флюгель')
                                    {
                                        $help_item_one = "Прочие";
                                    }
                                    else if ($help_item['1'] === 'для')
                                    {
                                        $help_item_one = "Прочие";
                                    }
                                    else if ($help_item['0'] === 'Стержень')
                                    {
                                        $help_item_one = "Прочие";
                                    }
                                    else if ($help_item['0'] === 'Саморезы')
                                    {
                                        $help_item_one = "Прочие";
                                    }
                                    else if ($help_item['0'] === 'Винт-шуруп')
                                    {
                                        $help_item_one = "Прочие";
                                    }
                                    else {
                                        $help_item_one = $help_item['0'];
                                    }
                                }
                                
                                else {
                                    $help_item_one = $help_item['0'];
                                }
                                
                                    
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
	
	<div class="left_catalog_main_menu">
	
	<div class="list_item_title">Промышленные изделия</div>
	
		<ul class="list_item">
	    <?
	$arr_sub_item2 = array();
    $previousLevel = 0;
    foreach($arResult as $arItem):
    $arItem["TEXT"] = ($arItem["PARAMS"]["UF_SHORT_NAME"] ?  $arItem["PARAMS"]["UF_SHORT_NAME"] : $arItem["TEXT"]);
    $block2 = array("55","1171","1175", "1178", "3753", "1334", "69", "73");
    If  (in_array($arItem["PARAMS"]["SECTION_ID"], $block2 ?? [])) {     

    //if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel)

        //str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));

    if ($arItem["IS_PARENT"]) {
    if ($arItem["DEPTH_LEVEL"] == 2):?>
<li><a href="<?=$arItem["LINK"]?>" class="item" rel="<?=$arItem["PARAMS"]["SECTION_ID"]?>"><i class="spriten sn-<?=$arItem["PARAMS"]["SECTION_ID"]?>"></i><?=$arItem["TEXT"]?></a>
    
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
	
		<div class="left_catalog_main_menu">
	
	<div class="list_item_title">Дополнительно</div>
	
		<ul class="list_item">
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
    
    <a href="<?=$arItem["LINK"]?>" class="item" rel="<?=$arItem["PARAMS"]["SECTION_ID"]?>"><i class="spriten sn-<?=$arItem["PARAMS"]["SECTION_ID"]?>"></i><?=$arItem["TEXT"]?></a>
    
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
	
</div>

      <div class="centered">
      
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
        
    
        ?>
    <div class="sub_item_content_help" id='sich-<?php echo $key;?>' rel="<?php echo $key;?>" <?= $start;?>>
    <?php
    sort($arr_sub_item_help[$key]["FSEARCH"]);
    foreach ($arr_sub_item_help[$key]["FSEARCH"] as $key_help=>$val_help) {
        $data_help_name = mb_strtolower($val_help);
        ?><span><a href="#" class="sub_item_content_help_link" data-help-name="<?php echo $data_help_name;?>"><div><!-- <i class="icofont icofont-spinner-alt-4"></i>--><?php echo $val_help;?></div></a></span>
    <?php 
    }
    if (is_countable($arr_sub_item_help[$key]["SSEARCH"]) && count($arr_sub_item_help[$key]["SSEARCH"]) > 0){
    //if (count($arr_sub_item_help[$key]["SSEARCH"]) > 0) {
    ?>
    <br>
    <div class="sub_item_content_help_link_second_note">Выберите первую цифру DIN, EN, ISO, ГОСТ</div>
    <?php
    }
    //sort($arr_sub_item_help[$key]["SSEARCH"]);
    foreach ($arr_sub_item_help[$key]["SSEARCH"] as $key_help=>$val_help) {
        $data_help_name = mb_strtolower($val_help);
        ?><span><a href="#" class="sub_item_content_help_link_second" data-help-name="<?php echo $data_help_name;?>"><div><i class="icofont fa fa-circle-thin"></i><?php echo $val_help;?></div></a></span>
    <?php 
    }
    ?>
    
    </div>
    <?php 
}
if (count ($val['ITEMS']) < 4) {
    $column = 'style="column-count:unset;-moz-column-count:unset;-webkit-column-count:unset;"';
} else {
    $column = 'style="column-count:4;-moz-column-count:4;-webkit-column-count:4;"';
}
?>
    <ul class="sub_item_content" id='sic-<?php echo $key;?>' <?= $start;?> <?= $column;?>>
<?php   
    foreach ($val['ITEMS']  as $key1=>$val1) {
        $data_helps_name = mb_strtolower($val1['2']);
        ?>
        <li data-helps-name="<?php echo $data_helps_name;?>" data-helps-name-second="<?php echo $val1['3'];?>" class="catalog_item_help">
            <a href="<?php echo $val1['1'];?>" class="catalog_item">
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
