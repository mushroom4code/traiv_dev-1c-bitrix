<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
        
$this->setFrameMode(true);

$BASE_PRICE = $arResult['PRICES']['BASE'];

$productId = $arResult["ID"];

$originalPrice = intval($BASE_PRICE['VALUE']);
$discontPrice = intval($BASE_PRICE['DISCOUNT_VALUE']);

$printPrice = $originalPrice <= $discontPrice ?
    $BASE_PRICE['PRINT_VALUE']
    : $BASE_PRICE['PRINT_DISCOUNT_VALUE'];

$arResult['~ADD_URL'] .= '&QUANTITY=';


$label = '';
$buttonLabel = '';
if($printPrice == '0 руб.'){
    $label = 'Цена и наличие по запросу';
    $buttonLabel = 'В корзину';}
elseif($arResult['CAN_BUY'] and $arResult['PRODUCT']['QUANTITY']) {
    $label = 'В наличии';
    $buttonLabel = 'В корзину';
}elseif($arResult['CAN_BUY'] and ($arResult['PRODUCT']['QUANTITY'] == 0)){
    $label = 'Под заказ';
    $buttonLabel = 'В корзину';
}elseif (!$arResult['CAN_BUY'] and ($arResult['PRODUCT']['QUANTITY'] == 0)){
    $label = 'Уведомить о появлении';
    $buttonLabel = 'Уведомить о появлении';
}else{
    $label = 'Цена и наличие по запросу';
    $buttonLabel = 'Запросить';
}

$ymarket = $arResult["PROPERTIES"]["YMARKET"]["VALUE"];

!$ymarket ? $pack = $arResult["PROPERTIES"]["KRATNOST_UPAKOVKI"]["VALUE"] : $pack = 1;
!$pack && $pack = 1;

if ($pack == 1):

$db_measure = CCatalogMeasureRatio::getList(array(), $arFilter = array('PRODUCT_ID' => $arResult["ID"]), false, false);  // получим единицу измерения только что созданного товара

$ar_measure = $db_measure->fetch();

$ar_measure = CCatalogMeasureRatio::update($ar_measure['ID'], array("PRODUCT_ID" => $arResult["ID"], "RATIO" => $pack));

endif;


$origname = $arResult['NAME'];
$formated1name = preg_replace("/\([^)]+(шт.\)|шт\))/","",$origname);
$formated2name = preg_replace("/КИТАЙ/","",$formated1name);
$formated3name = preg_replace("/КАНТ/","",$formated2name);
$formated4name = preg_replace("/Китай/","",$formated3name);
$formated5name = preg_replace("/Россия/","",$formated4name);
$formated6name = preg_replace("/Европа/","",$formated5name);
$formatedname = preg_replace("/PU=S|PU=K|RU=S|RU=K|PU=К/","",$formated6name);

if (!empty($arResult["PROPERTIES"]["CHECKBOX"]["VALUE"]) & ($arResult["PROPERTIES"]["CHECKBOX"]["VALUE"] != 'Нет')):
    ?><pre><?print_r($arResult["PROPERTIES"]["CHECKBOX"])?></pre><?
endif;
?>

<div class="island">

    <h1 class="product__title"><?=$formatedname?></h1>
    <!--<h4 id="itemid">ID: <?/*=$arResult['ID']*/?></h4>-->
    
    <div class="row">
        <div class="col x3d4 x1d1--t">
        <?php
         if (!empty($arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"])) {
                ?>
         <div class="prod-actions">
         
         <?php 
         if ( $USER->IsAuthorized() )
         {
             if ($USER->GetID() == '3092') {

              $fav_list_array = json_decode($_COOKIE['fav_list']);
              
             foreach ($fav_list_array as $value) {
                 $array[] = $value->element_id;
             }
                 ?>
                 <!-- <a href="#" class="prod-compare"><i class="icofont icofont-chart-bar-graph"></i> Сравнить</a>-->
					<a href="#" class="prod-favorites <?php if(in_array($arResult['ID'],$array)){echo "prod-favorites-active";}?>" data-fid="<?php echo $arResult['ID'];?>"><i class="fa fa-heart"></i> В избранное</a>
                 <?php 
             }
         }
         ?>
         
					<!-- <a href="#" class="prod-compare"><i class="icofont icofont-chart-bar-graph"></i> Сравнить</a>
					<a href="#" class="prod-favorites"><i class="fa fa-heart"></i> В избранное</a>-->
					
					<?php 

/*					if ( $USER->IsAuthorized() )
					{
					    if ($USER->GetID() == '3092' || $USER->GetID() == '2743' || $USER->GetID() == '1788') {
					        ?>
					        <!-- <div id="<?echo $this->GetEditAreaId($arResult["ID"])?>">
					        
					        <div id="modalitemrs" class="modalitemrs">
					        
					        <div class="modalitemrs-content">
					        <span class="modalitemrs-close">&times;</span>
					        <div class="item-rs-result"></div>
					        </div>
					        
					        </div>
					        
					        <a class="item-rs-link" style="cursor:pointer;">Показать размерную сетку</a>
					        <div class="item-rs">

					        </div>
					        </div>-->
					        <?php 
					        
					    }
					}*/
					
/*if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '1788' || $USER->GetID() == '2743') {*/
					?>
 <div class="prod-len-block">
 <div class="row" rel="1">
 <?php 
        if (!empty($arResult['DISPLAY_PROPERTIES']['DLINA_1']["VALUE"])) {

        $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PROPERTY_612", "PROPERTY_604", "PROPERTY_644", "CATALOG_QUANTITY","CATALOG_PRICE_2", "PROPERTY_417", "DATE_CREATE");
        $arSort = array('PROPERTY_612_VALUE'=>'DESC');
        
        /*start small lenght*/
        $arFilter = array('IBLOCK_ID'=>"18",'!=ID'=>$arResult['ID'], 'SECTION_ID'=>$arResult['IBLOCK_SECTION_ID'], 'ACTIVE'=>'Y',
        array("LOGIC"=> "AND",
        '<PROPERTY_612_VALUE'=>$arResult['DISPLAY_PROPERTIES']['DLINA_1']["VALUE"],
        'PROPERTY_613_VALUE'=>$arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"],
        'PROPERTY_610_VALUE'=>$arResult['DISPLAY_PROPERTIES']['MATERIAL_1']["VALUE"],
        'PROPERTY_606_VALUE'=>$arResult['DISPLAY_PROPERTIES']['STANDART']["VALUE"]/*,
        ">CATALOG_QUANTITY" => "0"*/));
        $db_list_in = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
        
        //echo "<br>";
        $res_rows = intval($db_list_in->SelectedRowsCount());
        //echo "<br>";
        
        $arr_rows = array();
        
        if ($res_rows > 0) {
            ?>
         <div class="col x1d4 x1d1--t">
        <?php
            while($ar_result_in = $db_list_in->GetNext())
            {
                
                $arr_rows[] = array (
                    'RID' => $ar_result_in['ID'],
                    'NAME' => $ar_result_in['NAME'],
                    'URL' => $ar_result_in['DETAIL_PAGE_URL'],
                    'len' => $ar_result_in['PROPERTY_612_VALUE'],
                    'kolvo' => $ar_result_in['CATALOG_QUANTITY'],
                    'price' => $ar_result_in['CATALOG_PRICE_2']);
            }
            
            $min = null;
            $min_key = null;
            $arr_rows_len = array();
            
            foreach($arr_rows as $k => $v)
            {
                if($v['len'] >= $min || $min === null)
                {
                    $min = $v['len'];
                    $min_key = $k;
                    $arr_rows_len[] = $v;
                }
            }
            
            if (count($arr_rows_len) !== 0) {
                
                if (count($arr_rows_len) == '1') {
                    ?>
                    <a href="<? echo $arr_rows_len['0']['URL'];?>" class="prod-len-block-link"><i class="fa fa-ttl-fa-arrow-left fa-ttl-icon-left"></i>Уменьшить длину ( М <?echo $arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"]." x ".$arr_rows_len['0']['len'];?> )</a>
                    <?php 
                }
                elseif (count($arr_rows_len) >= '1') {
                    $max = null;
                    $max_key = null;
                    
                    foreach($arr_rows_len as $i => $j)
                    {
                        if($j['kolvo'] > $max)
                         {
                             $max = $j['kolvo'];
                             $max_key = $i;
                         }    
                    }
                    
                    ?>
                    <a href="<? echo $arr_rows_len[$max_key]['URL'];?>" class="prod-len-block-link"><i class="fa fa-ttl-search fa-ttl-icon-left"></i>Уменьшить длину ( М <?echo $arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"]." x ".$arr_rows_len[$max_key]['len'];?> )</a>
                    <?php       
                }
            }
            ?>
        </div>
         
        <?php 
        }
        /*end small lenght*/
        
        /*start more lenght*/
        
        $arSelect1 = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PROPERTY_612", "PROPERTY_604", "PROPERTY_644", "CATALOG_QUANTITY","CATALOG_PRICE_2", "PROPERTY_417", "DATE_CREATE");
        $arSort1 = array('PROPERTY_612_VALUE'=>'ASC');
        
        $arFilter = array('IBLOCK_ID'=>"18",'!=ID'=>$arResult['ID'], 'SECTION_ID'=>$arResult['IBLOCK_SECTION_ID'], 'ACTIVE'=>'Y',
        array("LOGIC"=> "AND",
        '>PROPERTY_612_VALUE'=>$arResult['DISPLAY_PROPERTIES']['DLINA_1']["VALUE"],
        'PROPERTY_613_VALUE'=>$arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"],
        'PROPERTY_610_VALUE'=>$arResult['DISPLAY_PROPERTIES']['MATERIAL_1']["VALUE"],
        'PROPERTY_606_VALUE'=>$arResult['DISPLAY_PROPERTIES']['STANDART']["VALUE"]/*,
        ">CATALOG_QUANTITY" => "0"*/));
        $db_list_in = CIBlockElement::GetList($arSort1, $arFilter, false, false, $arSelect1);
        
        $res_rows = intval($db_list_in->SelectedRowsCount());
        
        $arr_rows = array();
        
        if ($res_rows > 0) {
         ?>
         <div class="col x1d4 x1d1--t">
         <?php    
            while($ar_result_in = $db_list_in->GetNext())
            {
                
                $arr_rows[] = array (
                    'RID' => $ar_result_in['ID'], 
                    'NAME' => $ar_result_in['NAME'], 
                    'URL' => $ar_result_in['DETAIL_PAGE_URL'],
                    'len' => $ar_result_in['PROPERTY_612_VALUE'],
                    'kolvo' => $ar_result_in['CATALOG_QUANTITY'],
                    'price' => $ar_result_in['CATALOG_PRICE_2']);
            }
            
            $min = null;
            $min_key = null;
            $arr_rows_len = array();
            
            foreach($arr_rows as $k => $v)
            {
                if($v['len'] <= $min || $min === null)
                {
                    $min = $v['len'];
                    $min_key = $k;
                    $arr_rows_len[] = $v;   
                }
            }
            
            if (count($arr_rows_len) !== 0) {
                
                if (count($arr_rows_len) == '1') {
                    ?>
                    
                    <a href="<? echo $arr_rows_len['0']['URL'];?>" class="prod-len-block-link"><i class="fa fa-ttl-search fa-ttl-icon-right"></i>Увеличить длину ( М <?echo $arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"]." x ".$arr_rows_len['0']['len'];?> )</a>
                    <?php 
                }
                elseif (count($arr_rows_len) >= '1') {
                    $max = null;
                    $max_key = null;
                    
                    foreach($arr_rows_len as $i => $j)
                    {
                        if($j['kolvo'] > $max)
                         {
                             $max = $j['kolvo'];
                             $max_key = $i;
                         }    
                    }
                    
                    ?>
                    
                    <a href="<? echo $arr_rows_len[$max_key]['URL'];?>" class="prod-len-block-link"><i class="fa fa-ttl-search fa-ttl-icon-right"></i>Увеличить длину ( М <?echo $arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"]." x ".$arr_rows_len[$max_key]['len'];?> )</a>
                    <?php       
                }
            }
            ?>
            </div>
            <?php 
        }
        if (!empty($arResult['DISPLAY_PROPERTIES']['DLINA_1']["VALUE"]) && !empty($arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"])) {
        ?>
        
         <div class="col x1d5 x1d1--t">
         <a data-prodtab-num="6" href="#" data-prodtab="#prod-tab-6" rel="nofollow" class="prod-len-block-link" onclick="ym(18248638,'reachGoal','run_RS'); return true;" id="size_table_link" style="text-align:center;"><i class="fa fa-ttl-search fa-ttl-icon-table"></i>Все размеры</a>
         </div>
        <?php 
        }
        /*end more lenght*/
        }
        else {
            ?>
            <div class="col x1d3 x1d1--t"></div>
            <?php 
        }
        
        ?>
        </div>
        </div>
 <?php 
  /*  }
}*/
?>
					
					<div class="prod-code"><span class="prod-code-title">Артикул:</span><span class="prod-code-value"><?php echo $arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"];?></span></div>
				</div>
         <?php 
         }
        ?>
        
            
				
				
				<div class="prod-tabs-wrap">
				<ul class="prod-tabs">
					<li><a data-prodtab-num="1" href="#" data-prodtab="#prod-tab-1" class="active" rel="nofollow">Характеристики</a></li>
					<!-- <li><a data-prodtab-num="2" id="prod-props" href="#" data-prodtab="#prod-tab-2" rel="nofollow">Описание</a></li> -->
					<li><a data-prodtab-num="3" href="#" data-prodtab="#prod-tab-3" rel="nofollow">Сертификаты</a></li>
					<li><a data-prodtab-num="4" href="#" data-prodtab="#prod-tab-4" rel="nofollow">Доставка</a></li>
					<li><a data-prodtab-num="5" href="#" data-prodtab="#prod-tab-5" rel="nofollow">Оплата</a></li>
					<?php 
					   if (!empty($arResult['DISPLAY_PROPERTIES']['DLINA_1']["VALUE"]) && !empty($arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"])) {
					   ?>
					   <li><a data-prodtab-num="6" onclick="ym(18248638,'reachGoal','run_RS'); return true;" href="#" data-prodtab="#prod-tab-6" rel="nofollow">Все размеры</a></li>
					   <?php      
					        }
					?>
					
				</ul>
				<div class="prod-tab-cont">

					<p data-prodtab-num="1" class="prod-tab-mob active" data-prodtab="#prod-tab-1">Характеристики</p>
					<div class="prod-tab stylization" id="prod-tab-1" style="height: auto; display: block;">
					
					<!-- Описание -->
					
					<div class="row">
						<div class="col x1d4 x1d1--t prod-slider-wrap">
                                
                                				<div class="prod-slider">
					<ul class="prod-slider-car">
					
								<?If (!empty($arResult['DETAIL_PICTURE']['SRC'])) :?>
                                    <?
                                    $img = $arResult['DETAIL_PICTURE'];
                                    $imgurl=$arResult['DETAIL_PICTURE']['SRC'];
                                    $imgurl_schema=$arResult['DETAIL_PICTURE']['SRC'];
                                    $picturl = CFile::ResizeImageGet($img,array('width'=>200, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
                                    ?>
						<li>
							<a data-fancybox="gallery" class="fancy-img" href="<?=$imgurl;?>">
								<img src="<?=$picturl['src'] //? $arResult['DETAIL_PICTURE']['SRC'] : '/images/no_image.png')?>"
                                         alt="<?=$arResult['NAME']?>">
							</a>
						</li>
                                
                                    
                                
                            <? else : ?>

                                <?//*Вывод изображения из каталога**///
                                $rsElement = CIBlockElement::GetList(array(), array('ID' => $arResult['ID']), false, false, array('ID', 'IBLOCK_SECTION_ID', 'DETAIL_PICTURE'));
                                if($arElement = $rsElement->Fetch())


                                    $rsElement = CIBlockSection::GetList(array(), array('ID' => $arElement['IBLOCK_SECTION_ID']), false, array('ID', 'IBLOCK_SECTION_ID', 'PICTURE'));
                                if($arElement = $rsElement->Fetch())

                                    $img = $arElement['DETAIL_PICTURE'] ? $arElement['DETAIL_PICTURE'] : $arElement['PICTURE'];

                                    $picturl = CFile::ResizeImageGet($img,array('width'=>200, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
                                    $imgurl_schema = $picturl['src'];
                                ?>
                                
                                <li>
							<a data-fancybox="gallery" class="fancy-img" href="<?= $picturl['src'];?>">
								<img
                                        src="<?= $picturl['src'] //? $item['DETAIL_PICTURE']['SRC'] : '/images/no_image.png') ?>"
                                        alt="<?=  $arResult['NAME'] ?>">
							</a>
						</li>


                            <?endif?>
                            
                            <li>
							<a data-fancybox="gallery" class="fancy-img" href="/local/templates/traiv-main/img/pack-preview3.jpg">
								<img src="/local/templates/traiv-main/img/pack-preview3.jpg"/>
							</a>
						</li>
                            
                                                        <? if(!empty($arResult['MORE_PHOTO'])):?>


                                    <? foreach($arResult['MORE_PHOTO'] as $imgGal):?>

                                        <? $thumb  = CFile::ResizeImageGet($imgGal,array('width'=>200, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);?>

<li>
							<a data-fancybox="gallery" class="fancy-img" href="<? echo $imgGal['SRC']?>">
								<img class="lazy" src="<? echo $thumb['src']?>">
							</a>
						</li>

                                    <? endforeach?>

                            <? endif ?>
						

					</ul>
					
		
                                            <div style="display:none;">
                                    <?
                                    $APPLICATION->IncludeComponent( "coffeediz:schema.org.ImageObject",
                                        "",
                                        Array(
                                            "COMPONENT_TEMPLATE" => ".default",
                                            "SHOW" => "Y",
                                            "CONTENTURL" => $imgurl_schema,
                                            "NAME" => $arResult["NAME"],
                                            "CAPTION" => $arResult["NAME"],
                                            "REPRESENTATIVEOFPAGE" => "True",
                                            "PARAM_RATING_SHOW" => "N"
                                        ),
                                        false,
                                        array('HIDE_ICONS' => 'Y')
                                        );
                                    
                                    ?>        
                                    </div>
				</div>
				<?
				//if(count($arResult['MORE_PHOTO']) > 0):?>
								<div class="prod-thumbs">
					<ul class="prod-thumbs-car">
					
					                            <?If (!empty($arResult['DETAIL_PICTURE']['SRC'])) :?>

                                
                                    <?
                                    $img = $arResult['DETAIL_PICTURE'];
                                    $imgurl=$arResult['DETAIL_PICTURE']['SRC'];

                                    ?>   
                                         <li>
							<a data-slide-index="0" href="#">
								<img src="<?=$imgurl //? $arResult['DETAIL_PICTURE']['SRC'] : '/images/no_image.png')?>"
                                         alt="<?=$arResult['NAME']?>" class="adaptive zoom-image lazy" id="<?=$arResult["ID"]?>"><??>
							</a>
						</li>
                                         
                                
                            <? else : ?>

                                <?//*Вывод изображения из каталога**///
                                ?><?
                                $rsElement = CIBlockElement::GetList(array(), array('ID' => $arResult['ID']), false, false, array('ID', 'IBLOCK_SECTION_ID', 'DETAIL_PICTURE'));
                                if($arElement = $rsElement->Fetch())


                                    $rsElement = CIBlockSection::GetList(array(), array('ID' => $arElement['IBLOCK_SECTION_ID']), false, array('ID', 'IBLOCK_SECTION_ID', 'PICTURE'));
                                if($arElement = $rsElement->Fetch())

                                    $img = $arElement['DETAIL_PICTURE'] ? $arElement['DETAIL_PICTURE'] : $arElement['PICTURE'];

                                $picturl = CFile::ResizeImageGet($img,array('width'=>200, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                                ?>
                                
                                <li>
							<a data-slide-index="0" href="#">
								<img src="<?= $picturl['src'] ?>"
                                         alt="<?=$arResult['NAME']?>">
							</a>
						</li>
                             
                            <?endif?>
					
					<li>
							<a data-slide-index="1" href="#">
								<img src="/local/templates/traiv-main/img/pack-preview3.jpg">
							</a>
						</li>
					
					<? if(!empty($arResult['MORE_PHOTO'])):?>


                                    <?
                                    $check_index = 2;
                                    foreach($arResult['MORE_PHOTO'] as $imgGal):?>

<? $thumb  = CFile::ResizeImageGet($imgGal, Array("width" => 80, "height" => 80) );?>

						<li>
							<a data-slide-index="<?php echo $check_index;?>" href="#" id='test'>
								<img src="<? echo $thumb['src']?>">
							</a>
						</li>

<?php $check_index++;?>
                                    <? endforeach?>

                            <? endif ?>


					</ul>
				</div>
				<?//endif?>
				

						</div>
					</div>
					
					
    					<div class="col x3d4 x1d1--t">
    						<!-- prod-content -->
    						
    						<div class="prod-content">
    						
    						
    						
    						<!-- Крепеж из других материалов -->
    						<div class="prod-select">
    						
    							<? if ($arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"] && $arResult['DISPLAY_PROPERTIES']['STANDART']["VALUE"]):?>

                                    <?

                                    $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PROPERTY_610", "PROPERTY_604", "DATE_CREATE");
                                    $arSort = array('NAME'=>'ASC'); //"PROPERTY_604" => 'desc'
                                    $arResult['DISPLAY_PROPERTIES']['DLINA_1']["VALUE"]
                                        ?
                                        $arFilter = array('IBLOCK_ID'=>"18",
                                            'PROPERTY_613_VALUE'=>$arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"],
                                            'PROPERTY_612_VALUE'=>$arResult['DISPLAY_PROPERTIES']['DLINA_1']["VALUE"],
                                            'PROPERTY_606_VALUE'=>$arResult['DISPLAY_PROPERTIES']['STANDART']["VALUE"]

                                        )
                                        :
                                        $arFilter = array('IBLOCK_ID'=>"18",
                                            'PROPERTY_613_VALUE'=>$arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"],
                                            'PROPERTY_606_VALUE'=>$arResult['DISPLAY_PROPERTIES']['STANDART']["VALUE"]
                                        )

                                    ;
                                    $res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                                    while($arrob = $res->GetNext()) {
                                        $sortArray[] = $arrob;
                                    }

                                    foreach ($sortArray as $key => $row)
                                    {
                                        $array_name[$key] = $row['DATE_CREATE'];
                                    }

                                    array_multisort($array_name, SORT_ASC, $sortArray);

                                    function uniqueArray($input, $key) {
                                        $exists = [];
                                        $result = array_filter($input, function($item) use (&$exists, $key) {
                                            $sortkey = $item[$key];
                                            if (array_key_exists($sortkey, $exists)) {
                                                return false;
                                            }
                                            $exists[$sortkey] = true;
                                            return true;
                                        });
                                        return $result;
                                    }

                                    $arrSortResult = uniqueArray($sortArray, 'PROPERTY_610_VALUE');

                                    if (count($arrSortResult) > 1) {
                                        ?>
                                        <div class="prod-select-item-first">Этот крепеж из других материалов:</div>
                                        <?php 
                                        
                                    }
                                    else {
                                        $check_select_top = "style='padding-top:0px;'";
                                        $check_select = "rel = '1'";
                                    }
                                    
                                    foreach ($arrSortResult as $ob){

                                    if ($ob["ID"] !== $arResult["ID"] && $ob["PROPERTY_610_VALUE"] !== $arResult['DISPLAY_PROPERTIES']['MATERIAL_1']["VALUE"]) {

                                        if ($ob["DETAIL_PICTURE"]) {
                                            $picID = $ob["DETAIL_PICTURE"];

                                        } else {
                                            $rsElement = CIBlockElement::GetList(array(), array('ID' => $ob['ID']), false, false, array('ID', 'IBLOCK_SECTION_ID', 'DETAIL_PICTURE'));
                                            if ($arElement = $rsElement->Fetch())

                                                $rsElement = CIBlockSection::GetList(array(), array('ID' => $arElement['IBLOCK_SECTION_ID']), false, array('ID', 'IBLOCK_SECTION_ID', 'PICTURE'));
                                            if ($arElement = $rsElement->Fetch())

                                                $picID = $arElement['DETAIL_PICTURE'] ? $arElement['DETAIL_PICTURE'] : $arElement['PICTURE'];

                                        }

                                        $ob["PROPERTY_610_VALUE"] == 'полиамид' && $ob["PROPERTY_610_VALUE"] = 'P6';

                                        $materialname = preg_replace("/1.7218/", "", $ob["PROPERTY_610_VALUE"]);
                                        $materialname = preg_replace("/\//", "", $materialname);
                                        //  $materialname = preg_replace("полиамид","P6",$materialname);

                                        $analogpict = CFile::ResizeImageGet($picID, array('width' => 30, 'height' => 30), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>

                                        <a class="prod-select-item-link enumid-<?= $ob["PROPERTY_610_ENUM_ID"] ?>"
                                           href="<?= $ob["DETAIL_PAGE_URL"] ?>"><span class="prod-select-item-img-area"><img src="<?= $analogpict["src"] ?>" class="prod-select-item-img"></span>
                                            <span class="prod-select-item-title"><?= $materialname ?></span>
                                        </a>

                                        <?
                                    }
                                    }
                                    ?>
                        <?endif;?>
    							
    						</div>
    						<!-- //Крепеж из других материалов -->

<!-- Характеристики -->

    						<div class="prod-character" <?php echo $check_select_top;?> <?php echo $check_select;?>>
    						
    						                                <?php if(count($arResult['DISPLAY_PROPERTIES'])){ ?>
                                    <h4 class="md-title">Характеристики:</h4>
									<ul class="prod-character-list">
                                    <?foreach ($arResult['DISPLAY_PROPERTIES'] as $property):?>
                                        <li	class="prod-character-list-item">
                                            <?$filterURL = '/catalog/?';
                                            $formatedValue = strtolower(str_replace(array(" ",",","-"), "_",$property["VALUE"]));
                                            if(is_array($property["VALUE"])){
                                                $property["VALUE"]=trim(implode(", ",$property["VALUE"]));
                                            }?>

                                            <div class="title"><?=$property["NAME"]?>:</div><div class="value"><!-- <a href="<?=$filterURL.strtolower($property['CODE']).'='.$formatedValue?>" rel="nofollow">--><?=$property["VALUE"]?><!-- </a> --></div>
                                            </li>
                                    <?endforeach?>
                                    <? if(!empty($arResult['PROPERTIES']['CML2_TRAITS']['VALUE']['4'])) {?>
                                        <li	class="prod-character-list-item">
                                        
                                        <?php 
                                            $weight = ($arResult['PROPERTIES']['CML2_TRAITS']['VALUE']['4']);
                                        ?>
                                            <div class="title" <?php echo $weight;?>>Вес шт., кг.:</div><div class="value"><?=$weight?></div>
                                        </li>
                                    <?

                                    if (!empty($arResult['PROPERTIES']['KRATNOST_UPAKOVKI']['VALUE']))
                                    {
                                        echo '<li class="prod-character-list-item">';
                                        echo '<div class="title">Вес уп., кг.:</div><div class="value">'.$arResult['CATALOG_WEIGHT'].'</div>';
                                        echo '</li>';
                                    }
                                    
                                            }?>
                                            </ul>


                                <?php } ?>
    						
    						</div>



<!-- // Характеристики -->
    						
    						</div>
    						

    						
    						<!-- //prod-content -->
    					</div>
					<!-- //Описание -->
					
					</div>
					
					<p data-prodtab-num="2" class="prod-tab-mob" data-prodtab="#prod-tab-2">Описание</p>
					<div class="prod-tab prod-props" id="prod-tab-2" style="height: 0px; display: block;">
					
<!-- Характеристики -->
<div class="row">
						<div class="col x1d1 x1d1--t">
						
						<!--div class="prod-note">
    						    <?
    						                /*if (!empty($arResult['DETAIL_TEXT'])){
    						                    echo $arResult['DETAIL_TEXT'];
    						                }
    						                else {

    						                    
    						                    $legtest = @file_get_contents('http://new.m-analytics.ru/getstmtext/4377287_15?url='.urlencode("https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']),false,stream_context_create(array(
    						                        'http' => array(
    						                            'timeout' => 2
    						                        ),
    						                        'ssl' => array(
    						                            "verify_peer"=>false,
    						                            "verify_peer_name"=>false,
    						                            'timeout' => 2
    						                        )
    						                    )));
    						                    if($legtest != "" && $legtest != "n"){
    						                        echo $legtest;
    						                        
    						                        $el = new CIBlockElement;
    						                        $arLoadProductArray = Array(
    						                            "DETAIL_TEXT_TYPE" => "html",
    						                            "DETAIL_TEXT" => $legtest,
    						                        );
    						                        $res = $el->Update($arResult['ID'], $arLoadProductArray);
    						                        
    						                    }
    						                }*/
    ?>
    						
    						</div-->
						
    						<div class="prod-character p0" style="display: none;">
    						
    						                                <?php if(count($arResult['DISPLAY_PROPERTIES'])){ ?>
                                    <h4 class="md-title">Характеристики:</h4>
									<ul class="prod-character-list">
                                    <?foreach ($arResult['DISPLAY_PROPERTIES'] as $property):?>
                                        <li	class="prod-character-list-item">
                                            <?$filterURL = '/catalog/?';
                                            $formatedValue = strtolower(str_replace(array(" ",",","-"), "_",$property["VALUE"]));
                                            if(is_array($property["VALUE"])){
                                                $property["VALUE"]=trim(implode(", ",$property["VALUE"]));
                                            }?>

                                            <div class="title"><?=$property["NAME"]?>:</div><div class="value"><a href="<?=$filterURL.strtolower($property['CODE']).'='.$formatedValue?>" rel="nofollow"><?=$property["VALUE"]?></a></div>
                                            </li>
                                    <?endforeach?>
                                    <? if(!empty($arResult['CATALOG_WEIGHT'])) {?>
                                        <li	class="prod-character-list-item">
                                        
                                        <?php 
                                            $weight = $arResult['CATALOG_WEIGHT'] / 1000;
                                        ?>
                                            <div class="title" <?php echo $weight;?>>Вес шт., кг.:</div><div class="value"><?=$weight?></div>
                                        </li>
                                    <?

                                    if (!empty($arResult['PROPERTIES']['KRATNOST_UPAKOVKI']['VALUE']))
                                    {
                                        echo '<li class="prod-character-list-item">';
                                        echo '<div class="title">Вес уп., кг.:</div><div class="value">'.$arResult['CATALOG_WEIGHT'].'</div>';
                                        echo '</li>';
                                    }
                                    
                                            }?>
                                            </ul>


                                <?php } ?>
    						
    						</div>

<!-- // Характеристики -->
</div>
</div>

					</div>
					
					<p data-prodtab-num="3" class="prod-tab-mob" data-prodtab="#prod-tab-3">Сертификаты</p>
					<div class="prod-tab" id="prod-tab-3" style="height: 0px; display: block;">
						
						<div class="row">
    						<div class="col x1d1 x1d1--t">
    							<div class="prod-sert">
    							
    							<h4 class="md-title">Сертификаты:</h4>
    							
    					<div class="row">		
    							<?//*Вывод пользовательского свойства категории типа файл
                        $SectId = $arResult['SECTION']['ID'];

                        CModule::IncludeModule("iblock");
                        $db_list = CIBlockSection::GetList(array(), array('IBLOCK_ID'=> 18, 'ID' => $SectId), false, ["UF_SERTIFICAT"]);
                        while($res = $db_list->GetNext())
                        {
                            ?><?
                            foreach ($res["UF_SERTIFICAT"] as $keyone):

                                $SERTFILE = CFile::GetFileArray($keyone);
                                $fileNameOrig = $SERTFILE['ORIGINAL_NAME'];?>

                                <a href="<?echo ($SERTFILE["SRC"]);?>" title="<?$strKb = $SERTFILE['FILE_SIZE']/1024; echo round($strKb).' Кб';?>" target="_blank">
                                <div class="col x1d4 x1d1--t"><div class="sert_item"  id="title_<?=$arResult["ID"]?>">
                                    <?$f=$SERTFILE['SRC'];$p=pathinfo($f);$pdf=array($p['extension']);if(in_array('pdf',$pdf)):?><tr><td><div><img src="/images/gost/pdf.png" width="24px" ></div>Скачать стандарт <?echo $SERTFILE['ORIGINAL_NAME'];?></td></tr><?else:?><?endif;?>
                                    <?$f=$SERTFILE['SRC'];$p=pathinfo($f);$doc=array($p['extension']);if(in_array('doc',$doc)):?><tr><td><div><img src="/images/gost/doc.png" width="24px" ></div>Скачать стандарт <?echo $SERTFILE['ORIGINAL_NAME'];?></td></tr><?else:?><?endif;?> 
                                    </div></div>
                                    </a>
                                <!-- <br> -->


                            <?
                            endforeach;
                        }
                        ?>
    							</div>
    							</div>
    						</div>
						</div>
					</div>
					
					<p data-prodtab-num="4" class="prod-tab-mob" data-prodtab="#prod-tab-4">Доставка</p>
					<div class="prod-tab prod-tab-articles" id="prod-tab-4" style="height: 0px;">
						
						<div class="col x1d2 x1d1--md x1d1--s block_del">
        <i class="fa fa-street-view" aria-hidden="true"></i><strong>Доставка по Москве </strong>
        <ul>

            <li>Самовывоз (бесплатно при любом минимальном заказе).<br/>Адрес: г.Москва, ул. 1-я Фрезерная д.2/1 стр 1</li>
            <li>Стоимость доставки рассчитывается индивидуально</li>
        </ul>
    </div>
    <div class="col x1d2 x1d1--md x1d1--s block_del">
        <i class="fa fa-street-view" aria-hidden="true"></i><strong>Доставка по Санкт-Петербургу</strong><br>
        <ul>

            <li>Самовывоз (бесплатно при любом минимальном заказе).<br/>Адрес: г.Санкт-Петербург, Кудрово, Ул. Центральная, дом 41</li>
            <li>Стоимость доставки рассчитывается индивидуально</li>
        </ul>
    </div>
    <div class="col x1d2 x1d1--md x1d1--s block_del">
        <i class="fa fa-street-view" aria-hidden="true"></i><strong>Доставка в Екатеринбург </strong><br>
        <ul>

            <li>Самовывоз (бесплатно при любом заказе).<br/>Адреса выдачи заказов согласовываются со специалистом отдела продаж</li>
            <li>Стоимость доставки рассчитывается индивидуально</li>
        </ul>
    </div>
    <div class="col x1d2 x1d1--md x1d1--s block_del">
        <i class="fa fa-street-view" aria-hidden="true"></i><strong>Доставка по всей России </strong><br>
        <ul>
            <li>Самовывоз (бесплатно при любом заказе).<br/>Адреса выдачи заказов согласовываются со специалистом отдела продаж</li>
            <li>Стоимость доставки рассчитывается индивидуально</li>
        </ul>

    </div>

    <div class="col x1d2 x1d1--md x1d1--s">
        <div class="wrapper">
            <div class="half">
                <p><strong>Виды доставки</strong></p>
                <div class="delivery-tab">
                    <input id="tab-one" type="checkbox" name="tabs">
                    <label for="tab-one">В течение дня</label>
                    <div class="tab-content">
                        <p>Осуществляем доставку с 9:00 до 18:00. Вы можете оформить доставку на текущий день, а после 15:00 - на следующий.</p><br>
                    </div>
                </div>
                <div class="delivery-tab">
                    <input id="tab-four" type="checkbox" name="tabs">
                    <label for="tab-four">Точно ко времени</label>
                    <div class="tab-content">
                        <p>Осуществляется круглосуточно к точно указанному времени, но не раньше, чем через 3 часа с момента заказа.</p><br>
                    </div>
                </div>
                <div class="delivery-tab">
                    <input id="tab-five" type="checkbox" name="tabs">
                    <label for="tab-five">Курьерская доставка</label>
                    <div class="tab-content">
                        <p>Осуществляем доставку по Санкт-Петербургу и Ленинградской области в течении рабочего дня. Заберем Ваш груз и отвезеем (например, сопроводительные документы). Сдадим Ваш груз в транспортную компанию.</p><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
						
					</div>
					
					<p data-prodtab-num="5" class="prod-tab-mob" data-prodtab="#prod-tab-5">Оплата</p>
					<div class="prod-tab" id="prod-tab-5" style="height: 0px;">


 Компания Трайв-Комплект рада предложить своим клиентам любые удобные для вас виды оплаты.&nbsp;<br><br><!--p style="text-align:center">
 <img class="ami-lazy" src="//opt-1289540.ssl.1c-bitrix-cdn.ru/bitrix/js/adwex.minified/1px.png?159551409226" data-src="/upload/adwex.minified/webp/1d4/100/1d42200b86e7e8d61a5dd3cc69b15ff4.webp" style="max-width:100%;">
</p--><div class="block_min_s"><div style="text-align:center;"><strong>Минимальная сумма заказа составляет 500 рублей.</strong></div></div><br><br><div class="col x1d2 x1d1--md x1d1--s block_pay"><i class="fa fa-credit-card" aria-hidden="true"></i><strong>Безналичный расчет</strong><br>
	 (Только для юр. лиц)<br><ul><li>Вы отправляете свой заказ, реквизиты и адрес доставки (если не самовывоз) на почту&nbsp;<a onclick="goPage(&quot;mailto:info@traiv-komplekt.ru&quot;); return false;" style="cursor: pointer" rel="nofollow">info@traiv-komplekt.ru</a></li><li>Мы выставляем Вам счет на оплату</li><li>Вы оплачиваете счет</li><li>Мы собираем Ваш заказ</li><li>Мы отгружаем Ваш заказ (доставка или самовывоз)</li></ul></div><div class="col x1d2 x1d1--md x1d1--s block_pay"><i class="fa fa-credit-card" aria-hidden="true"></i><strong>Наличный расчет</strong><br>
	 (Для физ. лиц)
	<ul><li>Вы приезжаете к нам в офис (п.Кудрово, ул. Центральная, 41), делаете заказ и производите оплату</li><li>если товар в наличии – сразу забираете со склада нашего парнера, либо заказываете у нас доставку</li><li>если необходимого товара на складе нет, забираете товар после прихода на склад нашего партнера ИП Григорьев, либо мы доставим его Вам сами</li></ul><br></div><!--div class="col x1d1 x1d1--md x1d1--s block_pay">
 <i class="fa fa-credit-card" aria-hidden="true"></i><strong>Яндекс-деньги<br>
 </strong>
	<ul>
		<li>Вы отправляете свой заказ, реквизиты и адрес доставки (если не самовывоз) на почту&nbsp;<a href="mailto:info@traiv-komplekt.ru">info@traiv-komplekt.ru</a> </li>
		<li>Мы выставляем Вам счет на оплату</li>
		<li>Вы переводите указанную в счете сумму на наш номер нашего Яндекс кошелька: 4100184353390</li>
		<li>Вы сообщаете нам о произведенной оплате</li>
		<li>Мы собираем Ваш заказ</li>
		<li>Мы отгружаем Ваш заказ (организуем доставку или самовывоз)</li>
	</ul>
</div--><div class="col x1d1 x1d1--md x1d1--s block_pay"><i class="fa fa-credit-card" aria-hidden="true"></i><strong>Наличный расчет перечислением денег через банк </strong><ul><li>Вы отправляете свой заказ, паспортные данные и адрес доставки (если не самовывоз) на почту&nbsp;<a onclick="goPage(&quot;mailto:info@traiv-komplekt.ru&quot;); return false;" style="cursor: pointer" rel="nofollow">info@traiv-komplekt.ru</a></li><li>Мы отправляем Вам счет на оплату и реквизиты для перечисления денег</li><li>Вы оплачиваете счет по приложенным реквизитам. Для оплаты можете прийти в кассу Сбербанк, воспользоваться терминалом Сбербанка или онлайн-банком Сбербанка или аналогичными услугами других сторонних банков.</li><li>Мы собираем Ваш заказ</li><li>Мы отгружаем Ваш заказ (организуем доставку или самовывоз)</li></ul></div>

					</div>
				
				<!-- размерная сетка -->
				<?php 
				if (!empty($arResult['DISPLAY_PROPERTIES']['DLINA_1']["VALUE"]) && !empty($arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"])) {
				?>
				<p data-prodtab-num="6" class="prod-tab-mob" data-prodtab="#prod-tab-6">Размерная сетка</p>
					<div class="prod-tab" id="prod-tab-6" style="height: 0px;">        
					        <div id="<?echo $this->GetEditAreaId($arResult["ID"])?>" data-simplebar data-simplebar-auto-hide="false">
					
					<div class="preloader-rs">
					</div>
					        
					       <!-- <a class="item-rs-link" style="cursor:pointer;">Показать размерную сетку</a>-->
					        <div class="item-rs">

					        </div>
					        </div>
					
					</div>
					<?php 
				}
				?>
				<!-- // размерная сетка -->
				
				</div>
			</div>
				
        
            <div class="product-specs" style="display: none;">
                <div class="row">
                    <div class="col x1d4 x1d1--m">

                        <?
                        $db_list = CIBlockElement::GetProperty(37, 239211, array("sort" => "asc"), Array("CODE"=>"COUNT"));

                        while ($res = $db_list->fetch()) {

                            $stroyNumber = $res["VALUE"];
                        }
                        ?>
                        <?
                        $db_list = CIBlockElement::GetProperty(37, 239212, array("sort" => "asc"), Array("CODE"=>"COUNT"));

                        while ($res = $db_list->fetch()) {

                            $mechNumber = $res["VALUE"];
                        }
                        ?>

                    </div>

                    <?php if(count($arResult['PROPERTIES']['standarts']['VALUE'])){ ?>
                        <div class="u-none--m">
                            Стандарты:
                            <ul class="similar">
                                <?foreach ($arResult['PROPERTIES']['standarts']['VALUE'] as $standart):?>
                                    <li class="similar__item"><?=$standart?></li>
                                <?endforeach?>
                            </ul>
                        </div>
                    <?php } ?>
                    <!-- <div class="col x3d4 x1d1--s">
                        
                        <div class="col x2d3 x2d3--m x1--s">
                            <div class="u-push-left">




                            </div>
                        </div>
                        
                        <div class="col x1d3 x1d3--m x1--s">


                    </div>

                </div>-->

            </div>

        </div>



            <!-- <div><?/*=$arResult["DETAIL_TEXT"]*/?></div>-->

            <div class="file_upl sale-element-block">

                <? If ($arResult['PROPERTIES']['SALE_BANNER']['VALUE']){?>

                    <?
                    $rsElement = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 44, 'ID' => $arResult['PROPERTIES']['SALE_BANNER']['VALUE']), false, false, array('ID', 'NAME', 'PROPERTY_653', 'PROPERTY_654'));
                    if ($arElement = $rsElement->Fetch()){
                        $bannerCode = $arElement['PROPERTY_653_VALUE'];
                        $bannerSrc = CFile::GetPath($bannerCode);

                        $bannerHref = $arElement['PROPERTY_654_VALUE'];
                        $bannerName = $arElement['NAME'];
                    } ?>

                    <a href="<?=$bannerHref?>" download=""><img src="<?=$bannerSrc?>" alt="<?=$bannerName?>" class="detail-sale-banner"></a>

                <? } ?>
            </div>

<?php 
/*смежные карточки*/
/*if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '2743' || $USER->GetID() == '1788') {*/
        
        if (!empty($arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"]) && /*!empty($arResult['DISPLAY_PROPERTIES']['DLINA_1']["VALUE"]) &&*/ !empty($arResult['DISPLAY_PROPERTIES']['STANDART']["VALUE"]) && !empty($arResult['DISPLAY_PROPERTIES']['MATERIAL_1']["VALUE"]) && !empty($arResult['DISPLAY_PROPERTIES']['POKRYTIE_1']["VALUE"])) {
        
        $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PROPERTY_610", "PROPERTY_604", "PROPERTY_644", "CATALOG_QUANTITY","CATALOG_PRICE_2", "PROPERTY_417", "DATE_CREATE");
        $arSort = array('NAME'=>'ASC'); //"PROPERTY_604" => 'desc'
        
        $arFilter = array('IBLOCK_ID'=>"18",'!=ID'=>$arResult['ID'],
        'PROPERTY_613_VALUE'=>$arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"],
        'PROPERTY_612_VALUE'=>$arResult['DISPLAY_PROPERTIES']['DLINA_1']["VALUE"],
        'PROPERTY_606_VALUE'=>$arResult['DISPLAY_PROPERTIES']['STANDART']["VALUE"],
        'PROPERTY_610_VALUE'=>$arResult['DISPLAY_PROPERTIES']['MATERIAL_1']["VALUE"],
        'PROPERTY_611_VALUE'=>$arResult['DISPLAY_PROPERTIES']['POKRYTIE_1']["VALUE"]);
        $res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
        
        if ( $res->SelectedRowsCount() > 0 ){
            echo "<div class='cross_item_area'>";
            echo "<h4 class='md-title'>Другие предложения на складе:</h4>";
            echo "<div class='row'>";
        while($arrob = $res->GetNext()) {
            
            $origname = $arrob['NAME'];
            $formated1name = preg_replace("/\([^)]+(шт.\)|шт\))/","",$origname);
            $formated2name = preg_replace("/КИТАЙ/","",$formated1name);
            $formated3name = preg_replace("/КАНТ/","",$formated2name);
            $formated4name = preg_replace("/Китай/","",$formated3name);
            $formated5name = preg_replace("/Россия/","",$formated4name);
            $formated6name = preg_replace("/Европа/","",$formated5name);
            $formatedname = preg_replace("/PU=S|PU=K|RU=S|RU=K|PU=К/","",$formated6name);
            
            if (!empty($arrob['IBLOCK_SECTION_ID']) && ($arrob['PROPERTY_644_VALUE'] > 0 || $arrob['CATALOG_QUANTITY'] > 0) && $arrob['CATALOG_PRICE_2'] > 0){
                echo "<div class='cross_item_tr'>";
                echo "<div class='col x1d12 x1d8--m cross_item'>";
                ?>
                <?If (!empty($arrob['DETAIL_PICTURE'])) :?>
                <?php
                $picturl = CFile::ResizeImageGet($arrob['DETAIL_PICTURE'],array('width'=>200, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                ?>
                
                   <? else : ?>

                                <?//*Вывод изображения из каталога**///
                $rsElement = CIBlockElement::GetList(array(), array('ID' => $arrob['ID']), false, false, array('ID', 'IBLOCK_SECTION_ID', 'DETAIL_PICTURE'));
                                if($arElement = $rsElement->Fetch())


                                    $rsElement = CIBlockSection::GetList(array(), array('ID' => $arrob['IBLOCK_SECTION_ID']), false, array('ID', 'IBLOCK_SECTION_ID', 'PICTURE'));
                                if($arElement = $rsElement->Fetch())

                                    $img = $arElement['DETAIL_PICTURE'] ? $arElement['DETAIL_PICTURE'] : $arElement['PICTURE'];

                                    $picturl = CFile::ResizeImageGet($img,array('width'=>200, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
                                   // $imgurl_schema = $picturl['src'];
                                ?>

                            <?endif?>
                
                
					<a href="<?= $arrob['DETAIL_PAGE_URL'] ?>">
                       <img src="<?=$picturl['src']?>" alt="<?=$formatedname?>" class="cross_item_img">
                    </a>

                </div>
                
                <div class="col x5d12 x1d2--s cross_item">
                <?php 
                    echo "<a href='".$arrob['DETAIL_PAGE_URL']."' class='cross_item_link'>".$formatedname;
                    if (!empty($arrob['PROPERTY_604_VALUE'])){
                        echo " (".$arrob['PROPERTY_604_VALUE']." шт.)";
                    }
                    else {
                        echo " (1 шт.)";
                    }
                    echo "</a>";
                ?>
                </div>
                
                <!-- <div class="col x2d12 x1d2--s cross_item">
                <?php
                if (!empty($arrob['PROPERTY_604_VALUE'])){
                    echo "Кратность - ".$arrob['PROPERTY_604_VALUE'];
                }?>
                </div>-->
                
                <div class="col x4d12 x1d2--s cross_item" style="padding-left: 30px;">
                <?php
                if ($arrob['PROPERTY_644_VALUE'] > 0) {
                    echo "<div class='cross_item_count'>Склад Европа - <b>".$arrob['PROPERTY_644_VALUE']."</b> шт. (cрок доставки: 10 дней)</div>";
                }?>
                <?php
                if ($arrob['CATALOG_QUANTITY'] > 0) {
                    echo "<div class='cross_item_count'>Склад (СПб) - <b>".$arrob['CATALOG_QUANTITY']."</b> шт.</div>";
                }?>
                
                </div>
                
                <div class="col x2d12 x1d2--s cross_item cross_item_price">
                <?php 
                if ($arrob['CATALOG_PRICE_2'] == "0.00") {
                    echo "По запросу";
                } else {
                    echo $arrob['CATALOG_PRICE_2'];
                    ?>
                    <span>руб.</span>
                    <?php 
                }
                ?>
                
                </div>
<?php                 
                
                
                
echo "</div>";
            }
        }
        echo "</div>";
        echo "</div>";
        }
        }
        
  /*  }
}*/
/*смежные карточки*/
?>

        </div>

        <div class="col x1d4 x1d1--t">





<div class="prod-price-info">
<div class="prod-info">
			<p class="prod-price-name">
			Розничная цена
			</p>
			<p class="prod-price">
				<b class="item_current_price">
				<?= $printPrice !== '0 руб.' ? str_replace(' ','',str_replace('руб.','',$printPrice)).'<i class="icofont icofont-rouble"></i>' : 'По запросу'?>
				</b>
			</p>

			<!-- for mobil -->
			<div class='prod-qnt-area'>
	        <div class='prod-qnt'>
	        
	        <a href="#" class="prod-qnt-button prod-minus"><i class="icofont icofont-minus-square"></i></a>
	        <input type='text' name='QUANTITY' value='<?=$pack?>' min="<?=$pack?>" step="<?=$pack?>" class="quantity prod-qnt-input" id="<?= $arResult["ID"]?>-item-quantity">
	        <a href="#" class="prod-qnt-button prod-plus"><i class="icofont icofont-plus-square"></i></a>
	        
	        </div>
	        </div>
	        <!-- // for mobil -->
	        
			
			<p class="prod-qnt-new">
				<input type='text' name='QUANTITY' value='<?=$pack?>' min="<?=$pack?>" step="<?=$pack?>" class="quantity prod-qnt-input" id="<?= $arResult["ID"]?>-item-quantity">
				<a href="#" class="prod-plus-new"><i class="fa fa-angle-up"></i></a>
				<a href="#" class="prod-minus-new"><i class="fa fa-angle-down"></i></a>
			</p>
			<p class="prod-addwrap">
				<a data-href="<?= $arResult['~ADD_URL'] ?>" class="prod-add" rel="nofollow" id="buy" style="cursor:pointer;" data-ajax-order-detail><i class="icofont icofont-shopping-cart"></i> В корзину</a>
			</p>
			
			<?php
	                if ( $printPrice !== '0 руб.' ) {
	                    $price_summ_item = str_replace(' ','',$printPrice) * $pack;
	                    echo "<div class='price_summ_item' data-summ-price='".str_replace(' ','',str_replace(' руб.','',$printPrice))."'>Общая стоимость: <b>".$price_summ_item."</b> руб.</div>";
	                }
	        ?>
			
			<p class="prod-price-name">
			Оптовая цена
			</p>
			
			<p class="prod-price-note">
			Для получения оптовой цены свяжитесь с нашим менеджером
			</p>
			
			<p class="prod-addwrap-opt">
				<a href="#w-form-one-click" class="prod-add-opt" rel="nofollow"><i class="icofont icofont-mail"></i> Оптовая цена</a>
			</p>
			
		</div>
		</div>
		
		        <? if (!$ymarket):?>
        <div class="check_type_pack"><i class="icofont icofont-warning-alt"></i>Внимание: продажа осуществляется кратно упаковкам.</div>
        
        <?endif; ?>
		

            <div class="shadow-price">
                <div class="price-block-two">


                    <?php /*if($printPrice !== '0 руб.'){*/?>
                        <a href="#x" class="w-form__overlay-one-click" id="w-form-one-click"></a>
                        <div class="w-form__popup-one-click">
                            <?$APPLICATION->IncludeComponent(
                                "slam:easyform",
                                "traiv",
                                array(
                                    "COMPONENT_TEMPLATE" => "traiv",
                                    "FORM_ID" => "FORM4",
                                    "FORM_NAME" => "Оптовая цена",
                                    "WIDTH_FORM" => "500px",
                                    "DISPLAY_FIELDS" => array(
                                        0 => "TITLE",
                                        1 => "EMAIL",
                                        2 => "PHONE",
                                        3 => "MESSAGE",
                                        4 => "HIDDEN",
                                        5 => "",
                                    ),
                                    "REQUIRED_FIELDS" => array(
                                        0 => "TITLE",
                                        1 => "EMAIL",
                                        2 => "PHONE",
                                        3 => "MESSAGE",
                                    ),
                                    "FIELDS_ORDER" => "TITLE,EMAIL,PHONE,MESSAGE,HIDDEN",
                                    "FORM_AUTOCOMPLETE" => "Y",
                                    "HIDE_FIELD_NAME" => "N",
                                    "HIDE_ASTERISK" => "N",
                                    "FORM_SUBMIT_VALUE" => "Отправить",
                                    "SEND_AJAX" => "Y",
                                    "SHOW_MODAL" => "Y",
                                    "_CALLBACKS" => "",
                                    "TITLE_SHOW_MODAL" => "Спасибо!",
                                    "OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение ближайшего рабочего часа",
                                    "ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
                                    "ENABLE_SEND_MAIL" => "Y",
                                    "CREATE_SEND_MAIL" => "",
                                    "EVENT_MESSAGE_ID" => array(
                                    ),
                                    "EMAIL_TO" => "info@traiv-komplekt.ru",
                                    "EMAIL_BCC" => "makarov@traiv.ru",
                                    "MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи ОПТОВАЯ ЦЕНА",
                                    "EMAIL_FILE" => "Y",
                                    "EMAIL_SEND_FROM" => "N",
                                    "CREATE_SEND_MAIL_SENDER" => "",
                                    "EVENT_MESSAGE_ID_SENDER" => array(
                                        0 => "121",
                                    ),
                                    "EMAIL_BCC_SENDER" => "makarov@traiv.ru",
                                    "MAIL_SUBJECT_SENDER" => "#SITE_NAME#: Сообщение из формы обратной связи",
                                    "USE_IBLOCK_WRITE" => "Y",
                                    "CATEGORY_TITLE_TITLE" => "Ваше имя",
                                    "CATEGORY_TITLE_TYPE" => "text",
                                    "CATEGORY_TITLE_PLACEHOLDER" => "",
                                    "CATEGORY_TITLE_VALUE" => "",
                                    "CATEGORY_TITLE_VALIDATION_MESSAGE" => "Обязательное поле",
                                    "CATEGORY_TITLE_VALIDATION_ADDITIONALLY_MESSAGE" => "maxlength=\"400\"",
                                    "CATEGORY_EMAIL_TITLE" => "Ваш E-mail",
                                    "CATEGORY_EMAIL_TYPE" => "email",
                                    "CATEGORY_EMAIL_PLACEHOLDER" => "example@example.com",
                                    "CATEGORY_EMAIL_VALUE" => "",
                                    "CATEGORY_EMAIL_VALIDATION_MESSAGE" => "Обязательное поле",
                                    "CATEGORY_EMAIL_VALIDATION_ADDITIONALLY_MESSAGE" => "data-bv-emailaddress-message=\"E-mail введен некорректно\"",
                                    "CATEGORY_PHONE_TITLE" => "Мобильный телефон",
                                    "CATEGORY_PHONE_TYPE" => "tel",
                                    "CATEGORY_PHONE_PLACEHOLDER" => "+7(999)999-99-99",
                                    "CATEGORY_PHONE_VALUE" => "",
                                    "CATEGORY_PHONE_VALIDATION_MESSAGE" => "Обязательное поле",
                                    "CATEGORY_PHONE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
                                    "CATEGORY_PHONE_INPUTMASK" => "Y",
                                    "CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
                                    "CATEGORY_MESSAGE_TITLE" => "Сообщение",
                                    "CATEGORY_MESSAGE_TYPE" => "textarea",
                                    "CATEGORY_MESSAGE_PLACEHOLDER" => "",
                                    "CATEGORY_MESSAGE_VALUE" => "",
                                    "CATEGORY_MESSAGE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
                                    "USE_CAPTCHA" => "Y",
                                    "USE_MODULE_VARNING" => "N",
                                    "USE_FORMVALIDATION_JS" => "Y",
                                    "HIDE_FORMVALIDATION_TEXT" => "N",
                                    "INCLUDE_BOOTSRAP_JS" => "Y",
                                    "USE_JQUERY" => "N",
                                    "USE_BOOTSRAP_CSS" => "Y",
                                    "USE_BOOTSRAP_JS" => "N",
                                    "CUSTOM_FORM" => "",
                                    "CAPTCHA_TITLE" => "",
                                    "CATEGORY_DOCS_TITLE" => "Вложение",
                                    "CATEGORY_DOCS_TYPE" => "file",
                                    "CATEGORY_DOCS_FILE_EXTENSION" => "doc, docx, xls, xlsx, txt, rtf, pdf, png, jpeg, jpg, gif",
                                    "CATEGORY_DOCS_FILE_MAX_SIZE" => "20971520",
                                    "CATEGORY_DOCS_DROPZONE_INCLUDE" => "N",
                                    "USE_INPUTMASK_JS" => "Y",
                                    "CATEGORY_______________________________________________TITLE" => "ИНН (для юридических лиц)",
                                    "CATEGORY_______________________________________________TYPE" => "text",
                                    "CATEGORY_______________________________________________PLACEHOLDER" => "",
                                    "CATEGORY_______________________________________________VALUE" => "",
                                    "CATEGORY_______________________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "^[a-zA-Z0-9_]+\$",
                                    "CREATE_IBLOCK" => "",
                                    "IBLOCK_TYPE" => "-",
                                    "IBLOCK_ID" => "37",
                                    "ACTIVE_ELEMENT" => "N",
                                    "CATEGORY_TITLE_IBLOCK_FIELD" => "NAME",
                                    "CATEGORY_EMAIL_IBLOCK_FIELD" => "FORM_EMAIL",
                                    "CATEGORY_PHONE_IBLOCK_FIELD" => "FORM_PHONE",
                                    "CATEGORY_MESSAGE_IBLOCK_FIELD" => "PREVIEW_TEXT",
                                    "CATEGORY_DOCS_IBLOCK_FIELD" => "FORM_DOCS",
                                    "CATEGORY_______________________________________________IBLOCK_FIELD" => "FORM_ИНН (для юридических лиц)",
                                    "FORM_SUBMIT_VARNING" => "Нажимая на кнопку \"#BUTTON#\", вы даете согласие на обработку <a target=\"_blanc\" href=\"/politika-konfidentsialnosti/\">персональных данных</a>",
                                    "COMPOSITE_FRAME_MODE" => "A",
                                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                                    "ELEMENT_ID" => $arResult["ID"],
                                    "FORMATED_NAME" => $formatedname,
                                    "CATEGORY_MESSAGE_VALIDATION_MESSAGE" => "Обязательное поле",
                                    "CATEGORY_HIDDEN_TITLE" => "Скрытое поле",
                                    "CATEGORY_HIDDEN_TYPE" => "hidden",
                                    "CATEGORY_HIDDEN_VALUE" => "",
                                    "CATEGORY_HIDDEN_IBLOCK_FIELD" => "FORM_HIDDEN"
                                ),
                                false
                            );?>
                            <a class="w-form__close" title="Закрыть" href="#w-form__close"></a>
                        </div>

                    <?php /*}*/ ?>
                </div>
            </div>




		<div class="prod-nal">
		<span href="#" class="prod-nal-title"><i class="icofont icofont-checked"></i> Наличие</span>
		<ul class="prod-nal-list">
        <?
        $arMeasure = \Bitrix\Catalog\ProductTable::getCurrentRatioWithMeasure($productId);
        $unit =  $arMeasure[$productId]['MEASURE']['SYMBOL_RUS'];


        /*$storeRes = \Bitrix\Catalog\StoreProductTable::getList(array(
            'filter' => array('=PRODUCT_ID'=>$productId,'STORE.ACTIVE'=>'Y'),
            'select' => array('AMOUNT','STORE_ID','STORE_TITLE' => 'STORE.TITLE'),
        ));

        while($arStoreParam = $storeRes->Fetch()){

            if ($arStoreParam["AMOUNT"] > 0):
                ?><li class="prod-nal-list-item"><?
                echo $arStoreParam["STORE_TITLE"].'<div class="title">Склад (СПб)</div><div class="value">'.$arStoreParam["AMOUNT"].' '.$unit.'</div>';
                ?></li><?
            endif;
        }*/
        ?>
       
        
        <?If ($arResult['PRODUCT']['QUANTITY'] > 0) : ?>
            <li class="prod-nal-list-item"><?
            echo '<div class="title">Склад (СПб)</div><div class="value">'.$arResult['PRODUCT']['QUANTITY'].' шт</div>';
                ?>
            </li>
        <?endif;?>
        
        
        
        <?If ($arResult["PROPERTIES"]["EUROPE_STORAGE"]["VALUE"] > 0) : ?>
            <li class="prod-nal-list-item" id="prod-nal-list-item-last-child"><?
                echo '<div class="title">'.$arResult["PROPERTIES"]["EUROPE_STORAGE"]["NAME"].'</div><div class="value">'.$arResult["PROPERTIES"]["EUROPE_STORAGE"]["VALUE"].' шт</div>';
                ?>
            </li>
            <div class="eur_delivery">(cрок доставки: 10 дней)</div>
        <?endif;?>
        
		</ul>
        </div>


        </div>
    </div>
    <div id="result-tuning">
        <h3 class="md-title">То, что вы искали:</h3>
        <ul class="row"></ul>

    </div>
    <!-- <br> -->



<div style="display: none;">
<?$APPLICATION->IncludeComponent(
    "coffeediz:schema.org.Product",
    ".default",
    array(
        "AGGREGATEOFFER" => "N",
        "DESCRIPTION" => $arResult['DETAIL_TEXT'] ? $arResult['DETAIL_TEXT'] : $legtest,
        "ITEMAVAILABILITY" => "InStock",
        "ITEMCONDITION" => "NewCondition",
        "NAME" => $formatedname,
        "PARAM_RATING_SHOW" => "N",
        "PAYMENTMETHOD" => array(
        ),
        "PRICE" => $BASE_PRICE['VALUE'],
        "PRICECURRENCY" => "RUB",
        "SHOW" => "N",
        "COMPONENT_TEMPLATE" => ".default"
    ),
    false
);?>
</div>

      <script type="text/javascript">
	BX.ready(function() {
		var label = new JCItemRS('<?=CUtil::JSEscape($this->GetEditAreaId($arResult["ID"]));?>', {
			itemID:<?=$arResult["ID"];?>,
			sectionID:<?=$arResult["IBLOCK_SECTION_ID"];?>,
			materialID:<?=$arResult['DISPLAY_PROPERTIES']['MATERIAL_1']["VALUE_ENUM_ID"];?>,
			itemRScont:'item-rs',
			itemRSlink:'item-rs-link',
			itemRSmodal:'modalitemrs',
			actionRequestUrl:<?='"'.$this->GetFolder(). '/ajaxRS.php"';?>
		});
	});
</script>


    <!--</div> closing in component epilog -->




