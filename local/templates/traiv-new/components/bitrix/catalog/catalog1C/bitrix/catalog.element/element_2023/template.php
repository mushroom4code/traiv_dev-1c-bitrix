<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
        
$this->setFrameMode(true);

$BASE_PRICE = $arResult['ITEM_PRICES']['0'];

$productId = $arResult["ID"];
$printPrice = $BASE_PRICE['PRINT_PRICE'];
$arResult['~ADD_URL'] = str_replace("#ID#",$arResult["ID"],$arResult['~ADD_URL_TEMPLATE']);

/* 14062023 edit
$BASE_PRICE = $arResult['PRICES']['BASE'];

$productId = $arResult["ID"];

$originalPrice = intval($BASE_PRICE['VALUE']);
$discontPrice = intval($BASE_PRICE['DISCOUNT_VALUE']);

$printPrice = $originalPrice <= $discontPrice ?
    $BASE_PRICE['PRINT_VALUE']
    : $BASE_PRICE['PRINT_DISCOUNT_VALUE'];
*/
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
$formated7name = preg_replace("/РОМЕК/","",$formated6name);
$formated8name = preg_replace("/Северсталь/","",$formated7name);
$formated9name = preg_replace("/РФ/","",$formated8name);
$formatedname = preg_replace("/PU=S|PU=K|RU=S|RU=K|PU=К/","",$formated9name);

if (!empty($arResult["PROPERTIES"]["CHECKBOX"]["VALUE"]) & ($arResult["PROPERTIES"]["CHECKBOX"]["VALUE"] != 'Нет')):
    ?><pre><?print_r($arResult["PROPERTIES"]["CHECKBOX"])?></pre><?
endif;

?>

<div class="row">

<div class="col-12 col-xl-12 col-lg-12 col-md-12">
	<h1><span><?
	
	if ( $USER->IsAuthorized() )
	{
	    if ($USER->GetID() == '3092' || $USER->GetID() == '1788') {
	        $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'];
	        
	        $formated1name = preg_replace("/\([^)]+(шт.\)|шт\))/","",$arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']);
	        $formated2name = preg_replace("/КИТАЙ/","",$formated1name);
	        $formated3name = preg_replace("/КАНТ/","",$formated2name);
	        $formated4name = preg_replace("/Китай/","",$formated3name);
	        $formated5name = preg_replace("/Россия/","",$formated4name);
	        $formated6name = preg_replace("/Европа/","",$formated5name);
	        $formated7name = preg_replace("/РОМЕК/","",$formated6name);
	        $formated8name = preg_replace("/Северсталь/","",$formated7name);
	        $formated9name = preg_replace("/РФ/","",$formated8name);
	        echo $formatedname = preg_replace("/PU=S|PU=K|RU=S|RU=K|PU=К/","",$formated9name);
	        
	        /*
	        $arValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(18,$arResult['ID']);
	        $arSEO = $arValues->getValues();
	        echo "<pre>"; var_dump($arSEO["ELEMENT_PAGE_TITLE"]); echo "</pre>";
	        echo var_dump($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']);*/
	    }
	    else {
	        echo $formatedname;
	    }
	}
	else
	{
	    echo $formatedname;
	}
	
	?></span></h1>
</div>
    
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    <div class="row">
        <div class="col-12 col-xl-9 col-lg-9 col-md-9">
        <?php
        
         if (!empty($arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"])) {
                ?>
         <div class="prod-actions">
         
         <div class="row">
            <div class="col-6">
         
         <?php
              $fav_list_array = json_decode($_COOKIE['fav_list']);
              
             foreach ($fav_list_array as $value) {
                 $array[] = $value->element_id;
             } 
             
                 ?>
					<a href="#" rel="nofollow" class="prod-favorites <?php if(is_array($array) && count($array)>0){
    					if(in_array($arResult['ID'],$array))
    					{
    					    echo "prod-favorites-active";
    					}
					}?>" data-fid="<?php echo $arResult['ID'];?>"><i class="fa fa-heart"></i> В избранное</a>
            
            </div>
            <div class="col-6">
            <div class="prod-code"><span class="prod-code-title">Артикул:</span><span class="prod-code-value"><?php echo $arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"];?></span></div>
            
            <?php 
            if ( $USER->IsAuthorized() )
            {
                if ($USER->GetID() == '3092' || $USER->GetID() == '1788') {
             ?>
            <div class="prod-code d-none d-lg-block" style="padding:0px 10px;"><span class="prod-code-title">ID:</span><span class="prod-code-value"><?php echo $arResult["ID"];?></span></div> 
             <?php        
                }
            }
            ?>
            
            </div> 	 	
         </div>

				</div>
         <?php 
         }
         
         $SectId = $arResult['SECTION']['ID'];
         CModule::IncludeModule("iblock");
        ?>
        
				<div class="prod-tabs-wrap-new">
				<ul class="prod-tabs-new">
					<li><a data-toggle="elementscroll" href="#info" rel="nofollow">Характеристики</a></li>
					<?php
					if (!empty($SectId) && !empty($arResult["IBLOCK_SECTION_ID"])){
					$db_list_sert = CIBlockSection::GetList(array(), array('IBLOCK_ID'=> 18, 'ID' => $SectId), false, ["UF_SERTIFICAT"]);
					if(intval($db_list_sert->SelectedRowsCount()) > 0){
					    while($res = $db_list_sert->GetNext())
					    {
					        if (is_countable($res['UF_SERTIFICAT']) && count($res['UF_SERTIFICAT']) > 0){
					        //if(count($res['UF_SERTIFICAT']) > 0) {
    					?>
    					<li><a data-toggle="elementscroll" href="#sert" rel="nofollow">Сертификаты</a></li>
    					<?php 
					        }
					    }
					}
					}
					?>
					<li><a data-toggle="elementscroll" href="#delivery" rel="nofollow">Доставка</a></li>
					<li><a data-toggle="elementscroll" href="#payment" rel="nofollow">Оплата</a></li>
					<li><a data-toggle="elementscroll" href="#guarantee" rel="nofollow">Гарантия</a></li>
					<?php 
					if (!empty($arResult['DISPLAY_PROPERTIES']['DLINA_1']["VALUE"]) && !empty($arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"]) && !empty($arResult['IBLOCK_SECTION_ID'])) {
					   ?>
					   <li><a data-toggle="elementscroll" onclick="ym(18248638,'reachGoal','run_RS'); return true;" href="#sizelist" rel="nofollow">Все размеры</a></li>
					   <?php      
					        }
					
					        $db_list_analog = CIBlockSection::GetList(Array(), $arFilter = Array("IBLOCK_ID"=>18, "ID"=>$arResult['IBLOCK_SECTION_ID']), true, Array("UF_RECOMEND", "UF_CANONICAL", "UF_LONGTEXT")); $props_array_analog = $db_list_analog->GetNext();
					        

					        if (!empty($props_array_analog["UF_RECOMEND"])) {
					        ?>
					
					<li><a data-toggle="elementscroll" href="#analoglist" rel="nofollow">Аналоги</a></li>
					<?php 
					        }
					
					        if ( $USER->IsAuthorized() )
					        {
					            if ($USER->GetID() == '3092') {
					         ?>
					         <li><a data-toggle="elementscroll" href="#comments" rel="nofollow">Отзывы</a></li>
					         <?php        
					            }
					        }
					        
					        ?>
				</ul>
				<div class="prod-tab-cont">

					<p data-prodtab-num="1" class="prod-tab-mob active" data-prodtab="#prod-tab-1">Характеристики</p>
					<div class="prod-tab-new stylization" id="info" style="height: auto; display: block; padding-top:0px;">
					
	               <!-- Описание -->
					<?php
					        $db_groups = CIBlockElement::GetElementGroups($arResult['ID'], true);
					        while($ar_group = $db_groups->Fetch()) {
					            
					            $getGroup = CIBlockSection::GetList(array(), array('ID' => $ar_group["ID"],"IBLOCK_ID"=>18, "ACTIVE" => "Y"), false, Array('UF_TAG_SECTION'));
					            if($getGroupItem = $getGroup->GetNext()) {
					                if ($getGroupItem['UF_TAG_SECTION'] !== '1')
					                {
					                   $sect_id = $ar_group["ID"];
					                }
					            }
					        }
					        
					        if ( $USER->IsAuthorized() )
					        {
					            if ($USER->GetID() == '3092') {
					                ?>
					                <div class="prod-code d-none d-lg-block" style="padding:0px 10px;"><span class="prod-code-title">IDCATPHOTO:</span><span class="prod-code-value"><?php echo $sect_id;?></span></div> 
					                <div class="prod-code d-none d-lg-block" style="padding:0px 10px;"><span class="prod-code-title">FORSEOTEXT:</span><span class="prod-code-value"><?php echo $arResult['IBLOCK_SECTION_ID'];?></span></div>
<?php 					                
					            } else if ($USER->GetID() == '1788') {
					                ?>
					                <div class="prod-code d-none d-lg-block" style="padding:0px 10px;"><span class="prod-code-title">IDCATPHOTO:</span><span class="prod-code-value"><?php echo $sect_id;?></span></div>
					                <div class="prod-code d-none d-lg-block" style="padding:0px 10px;"><span class="prod-code-title">FORSEOTEXT:</span><span class="prod-code-value"><?php echo $arResult['IBLOCK_SECTION_ID'];?></span></div> 
<?php 					                
					            }
					            else if ($USER->GetID() == '2938') {
					                ?>
					                <div class="prod-code d-none d-lg-block" style="padding:0px 10px;"><span class="prod-code-title">FORSEOTEXT:</span><span class="prod-code-value"><?php echo $arResult['IBLOCK_SECTION_ID'];?></span></div> 
<?php 					                
					            }
					        }
					        
					?>
					<div class="row g-0">
						<div class="col-12 col-xl-4 col-lg-4 col-md-4 prod-slider-wrap">
						
						<?php 
						
						/*if ( $USER->IsAuthorized() )
						{
						    if ($USER->GetID() == '3092') {
						     
						        $arWaterMark1 = Array(
						            array(
						                "name" => "watermark",
						                "position" => "center", // Положение
						                "type" => "image",
						                "size" => "real",
						                "file" => $_SERVER["DOCUMENT_ROOT"].'/local/templates/traiv-new/images/watermark1.png',
						                "fill" => "exact",
						            )
						        );
						        
						        $picturl1 = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'],array('width'=>$arResult['DETAIL_PICTURE']['WIDTH'] - 1, 'height'=>$arResult['DETAIL_PICTURE']['HEIGHT'] - 1), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, $arWaterMark1);
						        ?>
						        <img src="<?=$picturl1['src'] //? $arResult['DETAIL_PICTURE']['SRC'] : '/images/no_image.png')?>">
						        <?php
						    }
						}*/
						?>
						
                                
                                				<div class="prod-slider">
					<ul class="prod-slider-car">
					
								<?If (!empty($arResult['DETAIL_PICTURE']['SRC'])) :?>
                                    <?
                                    $img = $arResult['DETAIL_PICTURE'];
                                    $imgurl=$arResult['DETAIL_PICTURE']['SRC'];
                                    $imgurl_schema=$arResult['DETAIL_PICTURE']['SRC'];
                                    
                                    $arWaterMark1 = Array(
                                        array(
                                            "name" => "watermark",
                                            "position" => "center", // Положение
                                            "type" => "image",
                                            "size" => "real",
                                            "file" => $_SERVER["DOCUMENT_ROOT"].'/local/templates/traiv-new/images/watermark-medium.png',
                                            "fill" => "exact",
                                        )
                                    );
                                    
                                    $picturl1 = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'],array('width'=>$arResult['DETAIL_PICTURE']['WIDTH'] - 1, 'height'=>$arResult['DETAIL_PICTURE']['HEIGHT'] - 1), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, $arWaterMark1);
                                    
                                    /*$arWaterMark = Array(
                                        array(
                                            "name" => "watermark",
                                            "position" => "center",
                                            "type" => "image",
                                            "size" => "real",
                                            "file" => $_SERVER["DOCUMENT_ROOT"].'/local/templates/traiv-new/images/watermark-small.png',
                                            "fill" => "exact",
                                        )
                                    );*/
                                    
                                    $picturl = CFile::ResizeImageGet($img,array('width'=>200, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true/*, $arWaterMark*/);
                                    ?>
						<li>
							<a data-fancybox="gallery" class="fancy-img" href="<?=$picturl1['src'];?>">
								<img src="<?=$picturl['src'] //? $arResult['DETAIL_PICTURE']['SRC'] : '/images/no_image.png')?>"
                                         alt="<?=$arResult['NAME']?>">
							</a>
						</li>
                                
                                    
                                
                            <? else : ?>

                                <?                                
                                    //*Вывод изображения из каталога**///
                                /*$rsElement = CIBlockElement::GetList(array(), array('ID' => $arResult['ID']), false, false, array('ID', 'IBLOCK_SECTION_ID', 'DETAIL_PICTURE'));
                                if($arElement = $rsElement->Fetch())*/


                                $rsElement = CIBlockSection::GetList(array(), array('ID' => $sect_id), false, array('ID', 'IBLOCK_SECTION_ID', 'PICTURE'));
                                if($arElement = $rsElement->Fetch())

                                    $img = $arElement['DETAIL_PICTURE'] ? $arElement['DETAIL_PICTURE'] : $arElement['PICTURE'];

                                    /*$arWaterMark = Array(
                                        array(
                                            "name" => "watermark",
                                            "position" => "center", // Положение
                                            "type" => "image",
                                            "size" => "real",
                                            "file" => $_SERVER["DOCUMENT_ROOT"].'/local/templates/traiv-new/images/watermark-small.png',
                                            "fill" => "exact",
                                        )
                                    );*/
                                    $toimg = CFile::GetPath($img);
                                    $picturl = CFile::ResizeImageGet($img,array('width'=>200, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true/*, $arWaterMark*/);
                                    $imgurl_schema = $picturl['src'];
                                ?>
                                
                                <li>
							<a data-fancybox="gallery" class="fancy-img" href="<?= $toimg;?>" rel="1">
								<img
                                        src="<?= $picturl['src'] //? $item['DETAIL_PICTURE']['SRC'] : '/images/no_image.png') ?>"
                                        alt="<?=  $arResult['NAME'] ?>">
							</a>
						</li>


                            <?endif?>
                            
                            
                            
                                                        <? if(!empty($arResult['MORE_PHOTO'])):?>


                                    <? foreach($arResult['MORE_PHOTO'] as $imgGal):?>

                                        <? $thumb  = CFile::ResizeImageGet($imgGal,array('width'=>200, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);?>

<li>
							<a data-fancybox="gallery" class="fancy-img" href="<? echo $imgGal['SRC']?>">
								<img class="lazy" src="<? echo $thumb['src']?>" alt="<?=$arResult['NAME']?>">
							</a>
						</li>

                                    <? endforeach?>

                            <? endif ?>
						
						<li>						
<?php       
        $word = "2fix";
        $mystring = $formatedname;
        
        // Test if string contains the word
        if(strpos($mystring, $word) !== false){
            ?>
            <a data-fancybox="gallery" class="fancy-img" href="/local/templates/traiv-main/img/2fix_pack.jpg">
				<img src="/local/templates/traiv-main/img/2fix_pack.jpg"/>
			</a>
            <?php 
        } else{
            ?>
            <a data-fancybox="gallery" class="fancy-img" href="/local/templates/traiv-main/img/pack-preview3.jpg">
				<img src="/local/templates/traiv-main/img/pack-preview3.jpg"/>
			</a>
            <?php 
        }
?>
						</li>
					</ul>
					
		
                                            <div style="display:none;">
                                    <?
                                    /*$APPLICATION->IncludeComponent( "coffeediz:schema.org.ImageObject",
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
                                    */
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
                                /*$rsElement = CIBlockElement::GetList(array(), array('ID' => $arResult['ID']), false, false, array('ID', 'IBLOCK_SECTION_ID', 'DETAIL_PICTURE'));
                                if($arElement = $rsElement->Fetch())*/


                                    $rsElement = CIBlockSection::GetList(array(), array('ID' => $sect_id), false, array('ID', 'IBLOCK_SECTION_ID', 'PICTURE'));
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
					
					<? if(!empty($arResult['MORE_PHOTO'])){?>


                                    <?
                                    $check_index = 1;
                                    foreach($arResult['MORE_PHOTO'] as $imgGal):?>

<? $thumb  = CFile::ResizeImageGet($imgGal, Array("width" => 80, "height" => 80) );?>

						<li>
							<a data-slide-index="<?php echo $check_index;?>" href="#" id='test'>
								<img src="<? echo $thumb['src']?>">
							</a>
						</li>

<?php $check_index++;?>
                                    <? endforeach?>

                            <? } else {
                                $check_index = 1;
                            } ?>

					<li>
							<a data-slide-index="<?php echo $check_index;?>" href="#">
								
								<?php       
        $word = "2fix";
        $mystring = $formatedname;
        
        if(strpos($mystring, $word) !== false){
            ?>
				<img src="/local/templates/traiv-main/img/2fix_pack.jpg"/>
            <?php 
        } else{
            ?>
            <img src="/local/templates/traiv-main/img/pack-preview3.jpg">
            <?php 
        }
?>
								
								
							</a>
						</li>


					</ul>
				</div>
				<?//endif?>


<?php 
        
        if (!empty($arResult['DISPLAY_PROPERTIES']['STANDART']["VALUE_ENUM_ID"]) && !empty($arResult['DISPLAY_PROPERTIES']['MATERIAL_1']["VALUE_ENUM_ID"]) && !empty($arResult['DISPLAY_PROPERTIES']['POKRYTIE_1']["VALUE_ENUM_ID"])) {
        
        $rsStandartnum = CUserFieldEnum::GetList(array(), array("USER_FIELD_NAME"=>"UF_VIDEO_STANDART", "XML_ID" =>$arResult['DISPLAY_PROPERTIES']['STANDART']["VALUE_ENUM_ID"]));
        $arStandartnum = $rsStandartnum->GetNext();
        $UF_VIDEO_STANDART = $arStandartnum['ID'];

        $rsMaterialnum = CUserFieldEnum::GetList(array(), array("USER_FIELD_NAME"=>"UF_VIDEO_MATERIAL", "XML_ID" =>$arResult['DISPLAY_PROPERTIES']['MATERIAL_1']["VALUE_ENUM_ID"]));
        $arMaterialnum = $rsMaterialnum->GetNext();
        $UF_VIDEO_MATERIAL = $arMaterialnum['ID'];

        $rsPokrytienum = CUserFieldEnum::GetList(array(), array("USER_FIELD_NAME"=>"UF_VIDEO_POKRYTIE", "XML_ID" =>$arResult['DISPLAY_PROPERTIES']['POKRYTIE_1']["VALUE_ENUM_ID"]));
        $arPokrytienum = $rsPokrytienum->GetNext();
        $UF_VIDEO_POKRYTIE = $arPokrytienum['ID'];
        
        if (!empty($UF_VIDEO_STANDART) && !empty($UF_VIDEO_MATERIAL) && !empty($UF_VIDEO_POKRYTIE)) {
        
        $hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(2)->fetch();
        
        $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        
        $data = $entity_data_class::getList(array(
            "select" => array("*"),
            "order" => array("ID" => "DESC"),
            "filter" => array(
                'LOGIC' => 'AND',
                array('UF_VIDEO_STANDART' => $UF_VIDEO_STANDART),
                array('UF_VIDEO_MATERIAL' => $UF_VIDEO_MATERIAL),
                array('UF_VIDEO_POKRYTIE' => $UF_VIDEO_POKRYTIE)
                )
        ));
        
        if (intval($data->getSelectedRowsCount()) > 0){
            while($arData = $data->Fetch()){
                $vlink = $arData['UF_VIDEO_LINK'];
            }
         
            ?>
        <div class="prod-video">
        
        <a data-fancybox="iframe" onclick="ym(18248638,'reachGoal','getVideoItem'); return true;" class="prod-video-link" href="<?php echo $vlink;?>"><div class="prod-video-area"></div><iframe width="200" height="auto" src="<?php echo $vlink.'?version=3&autoplay=0&controls=1&loop=1&mute=1';?>"></iframe></a>
        </div>
        
        <?php
            
        }        
        }
        
        
        }
?>				

						</div>
					
					
					
    					<div class="col-12 col-xl-8 col-lg-8 col-md-8">
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
                                            'PROPERTY_606_VALUE'=>$arResult['DISPLAY_PROPERTIES']['STANDART']["VALUE"],
                                            'ACTIVE'=>'Y'

                                        )
                                        :
                                        $arFilter = array('IBLOCK_ID'=>"18",
                                            'PROPERTY_613_VALUE'=>$arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"],
                                            'PROPERTY_606_VALUE'=>$arResult['DISPLAY_PROPERTIES']['STANDART']["VALUE"],
                                            'ACTIVE'=>'Y'
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

                                    if (is_countable($arrSortResult) && count($arrSortResult) > 0){
                                   // if (count($arrSortResult) > 1) {
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
                                           href="<?= $ob["DETAIL_PAGE_URL"] ?>" rel="<?= $ob["ID"] ?>"><span class="prod-select-item-img-area"><img src="<?= $analogpict["src"] ?>" class="prod-select-item-img"></span>
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
    						                                <?php 
    						                                //if(count($arResult['DISPLAY_PROPERTIES'])){
    						                                    if (is_countable($arResult['DISPLAY_PROPERTIES']) && count($arResult['DISPLAY_PROPERTIES']) > 0){
    						                                ?>
                                    <div class="prod-character-item-first"><h2>Характеристики:</h2></div>
									<ul class="prod-character-list">
                                    <?foreach ($arResult['DISPLAY_PROPERTIES'] as $property):?>
                                        <li	class="prod-character-list-item">
                                            <?$filterURL = '/catalog/?';
                                            $formatedValue = strtolower(str_replace(array(" ",",","-"), "_",$property["VALUE"]));
                                            if(is_array($property["VALUE"])){
                                                $property["VALUE"]=trim(implode(", ",$property["VALUE"]));
                                            }
                                            ?>
                                            <div class="title"><?=$property["NAME"]?>:</div>
                                            <?php 
                                            /*if ( $USER->IsAuthorized() )
                                            {
                                                if ($USER->GetID() == '3092') {*/
                                                    
                                                    if ($property["NAME"] == 'Стандарт'){
                                                        //$checkDin = strpos($property['VALUE'],'DIN');
                                                        //echo var_dump(strpos($property['VALUE'],'DIN'));
                                                        //if ($checkDin !== false){
                                                            $arSelectRs = Array("DETAIL_PAGE_URL");
                                                            $arSortRs = array();
                                                            
                                                            
                                                            $arFilterRs = array('IBLOCK_ID'=>'45', '?NAME'=>$property['VALUE'], 'ACTIVE'=>'Y');
                                                            $db_list_inRs = CIBlockElement::GetList($arSortRs, $arFilterRs, false, Array( 'nTopCount' => 1), $arSelectRs);
                                                            
                                                            $res_rows = intval($db_list_inRs->SelectedRowsCount());
                                                            
                                                            if ($res_rows > 0) {
                                                                while($ar_result_inRs = $db_list_inRs->GetNext()){
                                                                    ?>
                                                                    <div class="value"><a href="<?php echo $ar_result_inRs['DETAIL_PAGE_URL']."doc-view/";?>" rel="nofollow" target="_blank" class='item-doc-view-link'><?=$property["VALUE"]?></a></div>
                                                                    <?php 
                                                                }
                                                            } else {
                                                                ?>
                                                                <div class="value"><!-- <a href="<?=$filterURL.strtolower($property['CODE']).'='.$formatedValue?>" rel="nofollow">--><?=$property["VALUE"]?><!-- </a> --></div>
                                                                <?php 
                                                            }
                                                        //} 
                                                    } else {
?>
                                            <div class="value"><!-- <a href="<?=$filterURL.strtolower($property['CODE']).'='.$formatedValue?>" rel="nofollow">--><?=$property["VALUE"]?><!-- </a> --></div>
<?php                                                         
                                                    }
                                                /*}
                                            }*/
                                            
                                            ?>


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
    						
    						<?php
    						/*SEO для карточки hightload блок*/
    						/*if ( $USER->IsAuthorized() )
    						{
    						    if ($USER->GetID() == '3092' || $USER->GetID() == '1788' || $USER->GetID() == '2938') {*/
    						        
    						        function mb_str_replace($search, $replace, $string)
    						        {
    						            $charset = mb_detect_encoding($string);
    						            
    						            $unicodeString = iconv($charset, "UTF-8", $string);
    						            
    						            return str_replace($search, $replace, $unicodeString);
    						        }
    						        
    						        if (!empty($arResult['DISPLAY_PROPERTIES']['STANDART']["VALUE_ENUM_ID"]) && !empty($arResult['DISPLAY_PROPERTIES']['MATERIAL_1']["VALUE_ENUM_ID"]) && !empty($arResult['DISPLAY_PROPERTIES']['POKRYTIE_1']["VALUE_ENUM_ID"])) {

    						            $rsStandartseo = CUserFieldEnum::GetList(array(), array("USER_FIELD_NAME"=>"UF_SEOITEM_STANDART", "XML_ID" =>$arResult['DISPLAY_PROPERTIES']['STANDART']["VALUE_ENUM_ID"]));
    						            $arStandartseo = $rsStandartseo->GetNext();
    						            $UF_SEO_STANDART = $arStandartseo['ID'];
    						            
    						            $rsMaterialseo = CUserFieldEnum::GetList(array(), array("USER_FIELD_NAME"=>"UF_SEOITEM_MATERIAL", "XML_ID" =>$arResult['DISPLAY_PROPERTIES']['MATERIAL_1']["VALUE_ENUM_ID"]));
    						            $arMaterialseo = $rsMaterialseo->GetNext();
    						            $UF_SEO_MATERIAL = $arMaterialseo['ID'];
    						            
    						            $rsPokrytieseo = CUserFieldEnum::GetList(array(), array("USER_FIELD_NAME"=>"UF_SEOITEM_POKRYTIE", "XML_ID" =>$arResult['DISPLAY_PROPERTIES']['POKRYTIE_1']["VALUE_ENUM_ID"]));
    						            $arPokrytieseo = $rsPokrytieseo->GetNext();
    						            $UF_SEO_POKRYTIE = $arPokrytieseo['ID'];
    						            
    						            if (!empty($UF_SEO_STANDART) && !empty($UF_SEO_MATERIAL) && !empty($UF_SEO_POKRYTIE)) {

    						                $hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(3)->fetch();
    						                
    						                $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
    						                $entity_data_class = $entity->getDataClass();
    						                
    						                $data = $entity_data_class::getList(array(
    						                    "select" => array("*"),
    						                    "order" => array("ID" => "DESC"),
    						                    "filter" => array(
    						                        'LOGIC' => 'AND',
    						                        array('UF_SEOITEM_STANDART' => $UF_SEO_STANDART),
    						                        array('UF_SEOITEM_MATERIAL' => $UF_SEO_MATERIAL),
    						                        array('UF_SEOITEM_POKRYTIE' => $UF_SEO_POKRYTIE)
    						                    )
    						                ));
    						                
    						                if (intval($data->getSelectedRowsCount()) > 0){
    						                    while($arData = $data->Fetch()){
    						                        $seoItemText = $arData['UF_SEOITEM_TEXT'];
    						                        $seoItemSecondText = $arData['UF_SEOITEM_SECOND_TEXT'];
    						                    }
    						                    echo "<div class='prod-item-text'>";
    						               
									if (!empty($seoItemText)) {
									    
									    ?>
    						         <div class="prod-character-item" rel="1">Область применения:</div>
									<?php  
									
									if (!empty($arResult['DISPLAY_PROPERTIES']["STANDART"]["VALUE_ENUM"])) {
									    $seoItemText = str_replace("#ITEM_STANDART#",$arResult['DISPLAY_PROPERTIES']["STANDART"]["VALUE_ENUM"],$seoItemText);
									}
									
									if (!empty($arResult['DISPLAY_PROPERTIES']["MATERIAL_1"]["VALUE_ENUM"])) {
									    $seoItemText = str_replace("#ITEM_MATERIAL#",$arResult['DISPLAY_PROPERTIES']["MATERIAL_1"]["VALUE_ENUM"],$seoItemText);
									}
									
									if (!empty($arResult['DISPLAY_PROPERTIES']["DIAMETR_1"]["VALUE_ENUM"])) {
									    $seoItemText = str_replace("#ITEM_DIAMETR#",$arResult['DISPLAY_PROPERTIES']["DIAMETR_1"]["VALUE_ENUM"]." мм",$seoItemText);
									} else {
									    $seoItemText = str_replace("диаметром","",$seoItemText);
									    $seoItemText = str_replace("#ITEM_DIAMETR# и ","",$seoItemText);
									}
									
									if (!empty($arResult['DISPLAY_PROPERTIES']["DLINA_1"]["VALUE_ENUM"])) {
									    $seoItemText = str_replace("#ITEM_DLINA#",$arResult['DISPLAY_PROPERTIES']["DLINA_1"]["VALUE_ENUM"]." мм",$seoItemText);
									} else {
									    $seoItemText = str_replace("длиной ","",$seoItemText);
									    $seoItemText = str_replace(" #ITEM_DLINA#","",$seoItemText);
									    $seoItemText = str_replace(" , ",", ",$seoItemText);
									}
									
									if (!empty($arResult['DISPLAY_PROPERTIES']["POKRYTIE_1"]["VALUE_ENUM"])) {
									    
									    if ($arResult['DISPLAY_PROPERTIES']["POKRYTIE_1"]["VALUE_ENUM"] == 'без покрытия'){
									        $seoItemText = str_replace(" с покрытием #ITEM_POKRYTIE#",'',$seoItemText);
									    } else {
									        $seoItemText = str_replace("#ITEM_POKRYTIE#",$arResult['DISPLAY_PROPERTIES']["POKRYTIE_1"]["VALUE_ENUM"],$seoItemText);
									    }
									} else {
									    $seoItemText = str_replace(" с покрытием #ITEM_POKRYTIE#",'',$seoItemText);
									}
									
									    echo $seoItemText;
									}
									
									
									if (!empty($seoItemSecondText)) {
									    
									    ?>
    						         <div class="prod-character-item">Особенности:</div>
									<?php
									    
									if (!empty($arResult['DISPLAY_PROPERTIES']["STANDART"]["VALUE_ENUM"])) {
									    $seoItemSecondText = str_replace("#ITEM_STANDART#",$arResult['DISPLAY_PROPERTIES']["STANDART"]["VALUE_ENUM"],$seoItemSecondText);
									}
									
									
									echo $seoItemSecondText;
									}
									
									echo "<p>";
									if (!empty($arResult['PROPERTIES']['TIP_TOVARA']['VALUE'])){
									    $start = $arResult['PROPERTIES']['TIP_TOVARA']['VALUE']." п";
									} else {
									    $start = "П";
									}
									
									if (isset($arResult['PROPERTIES']['KRATNOST_UPAKOVKI']['VALUE']) == true && strlen($arResult['PROPERTIES']['KRATNOST_UPAKOVKI']['VALUE']) > 0)  {
									    $strnum = $arResult['PROPERTIES']['KRATNOST_UPAKOVKI']['VALUE'];
									    echo $start."оставляется в упаковке по ".$strnum." шт.";
									} else {
									    $strnum = "1";
									    echo $start."оставляется от ".$strnum." шт.";
									}
									
									
									echo "</p>";
									
         echo "</div>";
        }        
       /* }
        
        
        }*/
    						        
    						    }
    						}
    						/*end SEO для карточки hightload блок*/
    						
    						
    						/*$ar_result = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"18", "ID"=>$arResult['IBLOCK_SECTION_ID']),false, Array("UF_ITEM_TEXT","UF_ITEM_TEXT_NOTE"));
    						 
    						 if($res=$ar_result->GetNext()){
    						     
    						     if (!empty($res["UF_ITEM_TEXT"])) {
    						         echo "<div class='prod-item-text'>";
    						         ?>
    						         <div class="prod-character-item">Область применения:</div>
									<?php     						         
    						         if (!empty($arResult['DISPLAY_PROPERTIES']["STANDART"]["VALUE_ENUM"])) {
    						             $prod_item_text = str_replace("#ITEM_STANDART#",'<nobr>'.$arResult['DISPLAY_PROPERTIES']["STANDART"]["VALUE_ENUM"].'</nobr>',$res["UF_ITEM_TEXT"]);
    						         }
    						         
    						         if (!empty($arResult['DISPLAY_PROPERTIES']["DIAMETR_1"]["VALUE_ENUM"])) {
    						             $prod_item_text = str_replace("#ITEM_DIAMETR#",$arResult['DISPLAY_PROPERTIES']["DIAMETR_1"]["VALUE_ENUM"]."мм",$prod_item_text);
    						         }
    						         
    						         if (!empty($arResult['DISPLAY_PROPERTIES']["DLINA_1"]["VALUE_ENUM"])) {
    						             $prod_item_text = str_replace("#ITEM_DLINA#",$arResult['DISPLAY_PROPERTIES']["DLINA_1"]["VALUE_ENUM"]."мм",$prod_item_text);
    						         }
    						         
    						         if (!empty($arResult['DISPLAY_PROPERTIES']["MATERIAL_1"]["VALUE_ENUM"])) {
    						             $prod_item_text = str_replace("#ITEM_MATERIAL#",$arResult['DISPLAY_PROPERTIES']["MATERIAL_1"]["VALUE_ENUM"],$prod_item_text);
    						         }
    						         
    						         if (!empty($arResult['DISPLAY_PROPERTIES']["POKRYTIE_1"]["VALUE_ENUM"])) {
    						             
    						             if ($arResult['DISPLAY_PROPERTIES']["POKRYTIE_1"]["VALUE_ENUM"] == 'без покрытия'){
    						                 $prod_item_text = str_replace(" с покрытием #ITEM_POKRYTIE#",'',$prod_item_text);   
    						             } else {
    						                 $prod_item_text = str_replace("#ITEM_POKRYTIE#",$arResult['DISPLAY_PROPERTIES']["POKRYTIE_1"]["VALUE_ENUM"],$prod_item_text);
    						             }
    						         } else {
    						             $prod_item_text = str_replace(" с покрытием #ITEM_POKRYTIE#",'',$prod_item_text);
    						         }
    						         
    						         
    						          echo $prod_item_text;
    						          
    						          
    						          
    						          if (!empty($res["UF_ITEM_TEXT_NOTE"])) {
    						              
    						              ?>
    						         <div class="prod-character-item">Особенности:</div>
									<?php
									
									if (!empty($arResult['DISPLAY_PROPERTIES']["STANDART"]["VALUE_ENUM"])) {
									    $prod_item_text_note = str_replace("#ITEM_STANDART#",'<nobr>'.$arResult['DISPLAY_PROPERTIES']["STANDART"]["VALUE_ENUM"].'</nobr>',$res["UF_ITEM_TEXT_NOTE"]);
									}
									
									if (!empty($arResult['DISPLAY_PROPERTIES']["DIAMETR_1"]["VALUE_ENUM"])) {
									    $prod_item_text_note = str_replace("#ITEM_DIAMETR#",$arResult['DISPLAY_PROPERTIES']["DIAMETR_1"]["VALUE_ENUM"],$prod_item_text_note);
									}
									
									if (!empty($arResult['DISPLAY_PROPERTIES']["DLINA_1"]["VALUE_ENUM"])) {
									    $prod_item_text_note = str_replace("#ITEM_DLINA#",$arResult['DISPLAY_PROPERTIES']["DLINA_1"]["VALUE_ENUM"],$prod_item_text_note);
									}
									
									if (!empty($arResult['DISPLAY_PROPERTIES']["MATERIAL_1"]["VALUE_ENUM"])) {
									    $prod_item_text_note = str_replace("#ITEM_MATERIAL#",$arResult['DISPLAY_PROPERTIES']["MATERIAL_1"]["VALUE_ENUM"],$prod_item_text_note);
									}
									
									echo $prod_item_text_note;
    						          }
    						      
    						          echo "<p>";
    						          if (!empty($arResult['PROPERTIES']['TIP_TOVARA']['VALUE'])){
    						              $start = $arResult['PROPERTIES']['TIP_TOVARA']['VALUE']." п";
    						          } else {
    						              $start = "П";
    						          }
    						          
    						          if (isset($arResult['PROPERTIES']['KRATNOST_UPAKOVKI']['VALUE']) == true && strlen($arResult['PROPERTIES']['KRATNOST_UPAKOVKI']['VALUE']) > 0)  {
    						              $strnum = $arResult['PROPERTIES']['KRATNOST_UPAKOVKI']['VALUE'];
    						              echo $start."оставляется в упаковке по ".$strnum." шт.";
    						          } else {
    						              $strnum = "1";
    						              echo $start."оставляется от ".$strnum." шт.";
    						          }
    						          
    						          
    						          echo "</p>";
    						         
    						         echo "</div>";
    						     }
    						 }*/
    						 
    						?>



<!-- // Характеристики -->
    						
    						</div>
    						

    						
    						<!-- //prod-content -->
    					</div>
					<!-- //Описание -->
					<!-- Блок цен для mobile -->
					<div class="col-12 col-xl-12 col-lg-12 col-md-12 d-block d-sm-none" id="prod-price-block-copy">
						
					</div>
					<!-- Блок цен для modile end -->
					
					</div>
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
    						
    						                                <?php
    						                                if (is_countable($arResult['DISPLAY_PROPERTIES']) && count($arResult['DISPLAY_PROPERTIES']) > 0){
    						                                /*if(count($arResult['DISPLAY_PROPERTIES'])){*/ ?>
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
					<?php
					if (!empty($SectId) && !empty($arResult["IBLOCK_SECTION_ID"])){
					$db_list_sert = CIBlockSection::GetList(array(), array('IBLOCK_ID'=> 18, 'ID' => $SectId), false, ["UF_SERTIFICAT"]);
					if(intval($db_list_sert->SelectedRowsCount()) > 0){
					    while($res = $db_list_sert->GetNext())
					    {
					        //if(count($res['UF_SERTIFICAT']) > 0) {
					            if (is_countable($res['UF_SERTIFICAT']) && count($res['UF_SERTIFICAT']) > 0){
					        
					?>
					<p data-prodtab-num="3" class="prod-tab-mob" data-prodtab="#prod-tab-3">Сертификаты</p>
					<div class="prod-tab-new" id="sert" style="height: auto; display: block;">
						
						<div class="row">
    						<div class="col-12">
    							<div class="prod-sert">
    							
    							<div class="h2title-item"><span><h2>Сертификаты</h2></span></div>
    							
    					<div class="row">		
    							<?
                            foreach ($res["UF_SERTIFICAT"] as $keyone):

                                $SERTFILE = CFile::GetFileArray($keyone);
                                $fileNameOrig = $SERTFILE['ORIGINAL_NAME'];?>

                                
                                <div class="col-6 col-xl-3 col-lg-3 col-md-3"><div class="sert_item"  id="title_<?=$arResult["ID"]?>">
                                <a href="<?echo ($SERTFILE["SRC"]);?>" title="<?$strKb = $SERTFILE['FILE_SIZE']/1024; echo round($strKb).' Кб';?>" target="_blank">
                                    <?$f=$SERTFILE['SRC'];$p=pathinfo($f);$pdf=array($p['extension']);if(in_array('pdf',$pdf)):?><tr><td><div><img src="/images/gost/pdf.png" width="24px" ></div>Скачать стандарт <?echo $SERTFILE['ORIGINAL_NAME'];?></td></tr><?else:?><?endif;?>
                                    <?$f=$SERTFILE['SRC'];$p=pathinfo($f);$doc=array($p['extension']);if(in_array('doc',$doc)):?><tr><td><div><img src="/images/gost/doc.png" width="24px" ></div>Скачать стандарт <?echo $SERTFILE['ORIGINAL_NAME'];?></td></tr><?else:?><?endif;?> 
                                    </div></a></div>
                                    
                                <!-- <br> -->


                            <?
                            endforeach;
                        
                        ?>
    							</div>
    							</div>
    						</div>
						</div>
					</div>
					<?php
					        }
					    }
					}
					}
					?>
					
					<p data-prodtab-num="4" class="prod-tab-mob" data-prodtab="#prod-tab-4">Доставка</p>
					<div class="prod-tab-new prod-tab-articles" id="delivery" style="height: auto;">
					<div class="h2title-item"><span><h2>Доставка</h2></span></div>
										     <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/delivery_item.php"
                                )
                            );
                            ?>
 <!-- Варианты доставки -->
						
					</div>
					
					<p data-prodtab-num="5" class="prod-tab-mob" data-prodtab="#prod-tab-5">Оплата</p>
					<div class="prod-tab-new" id="payment" style="height: auto;">
					<div class="h2title-item"><span><h2>Оплата</h2></span></div>
					<?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/payment_item.php"
                                )
                            );
                            ?>
</div>

					<p data-prodtab-num="7" class="prod-tab-mob" data-prodtab="#prod-tab-7">Гарантия</p>
					<div class="prod-tab-new" id="guarantee" style="height: auto;">
					<div class="h2title-item"><span><h2>Гарантия</h2></span></div>
					     <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/guarantee.php"
                                )
                            );
                            ?>
					</div>
				
				<!-- размерная сетка -->
				<?php 
				if (!empty($arResult['DISPLAY_PROPERTIES']['DLINA_1']["VALUE"]) && !empty($arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"]) && !empty($arResult['IBLOCK_SECTION_ID'])) {
				?>
				<p data-prodtab-num="6" class="prod-tab-mob" data-prodtab="#prod-tab-6">Размерная сетка</p>
					<div class="prod-tab-new" id="sizelist" style="height: auto;">      
					<div class="h2title-item"><span><h2>Все размеры</h2></span></div>  
					        <div id="<?echo $this->GetEditAreaId($arResult["ID"])?>" data-simplebar data-simplebar-auto-hide="false" style="padding:10px 0px;">
					
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
				
				    <?
                
                $db_list = CIBlockSection::GetList(Array(), $arFilter = Array("IBLOCK_ID"=>18, "ID"=>$arResult['IBLOCK_SECTION_ID']), true, Array("UF_RECOMEND", "UF_CANONICAL", "UF_LONGTEXT")); $props_array = $db_list->GetNext();
                
                //analog start
                if (!empty($props_array["UF_RECOMEND"])) {
                    $rsSections = CIBlockSection::GetList(
                        array("SORT" => "ASC"),
                        array("IBLOCK_ID" => '18', "ACTIVE" => "Y", "ID" => $props_array["UF_RECOMEND"]),
                        false,
                        array("NAME", "DETAIL_PICTURE", "PICTURE", "SECTION_PAGE_URL"),
                        false
                        );
                    
                    ?>
				<p data-prodtab-num="3" class="prod-tab-mob" data-prodtab="#prod-tab-3">Аналоги</p>
					<div class="prod-tab-new" id="analoglist" style="height: auto; display: block;">
						<div class="h2title-item"><span><h2>Аналоги</h2></span></div>
					</div>
					<?php 
					                    $rsSections = CIBlockSection::GetList(
                        array("SORT" => "ASC"),
                        array("IBLOCK_ID" => '18', "ACTIVE" => "Y", "ID" => $props_array["UF_RECOMEND"]),
                        false,
                        array("NAME", "DETAIL_PICTURE", "PICTURE", "SECTION_PAGE_URL"),
                        false
                        );
                    
                    ?>

    <div class="analogues-item">
        
        <noindex><p data-nosnippet="">Обозначение "Аналог товара" - не является на 100% гарантией, что аналог будет точной копией исходного изделия (по техническим параметрам, по цветовой палитре и т.д.).
            Для избежания ошибок, рекомендуем Вам проконсультироваться с <a href="#w-form-recall" >нашими специалистами.</a></p></noindex>
        
        <div class="col-12" id="analog-area">
        <ul class="row d-flex">
            <?
            while ($arSections = $rsSections->GetNext()) {
                ?>

                <?   $widthsizen="150";
                $heightsizen="150";

                $arFileRecTmpn = CFile::ResizeImageGet(
                    $arSections['PICTURE'],
                    array("width" => $widthsizen, "height" => $heightsizen),
                    BX_RESIZE_IMAGE_PROPORTIONAL,
                    true, $arFilter
                );

                ?>
                <li class="col-6 col-xl-2 col-lg-2 col-md-2">
                <a href="<?= $arSections['SECTION_PAGE_URL'] ?>" class="category-item-link">
                    <div class="category-item">
                    
                        <div class="catalog-item__image catalog-item-analog">
                            <img src="<?= $arFileRecTmpn['src']?>" class="lazy" alt="<?= $arSections['NAME'] ?>" title="<?= $arSections['NAME'] ?>">
                        </div>
                        <div class="catalog-item__title_mp">
                            <span class="v-aligner"><?= $arSections['NAME'] ?></span>
                        </div>
                    
                    </div>
                    </a>
                </li>

                <?
            }
            ?>
        </ul>
        </div>
        
    </div>
					
					<?php 
                }
                //analog end
					?>
				
				<?php 
				if ( $USER->IsAuthorized() )
				{
				    if ($USER->GetID() == '3092' && $arResult['ID'] == '124412') {
				        ?>
				<p data-prodtab-num="9" class="prod-tab-mob" data-prodtab="#prod-tab-9">Отзывы</p>
					<div class="prod-tab-new" id="comments" style="height: auto; display: block;">
					
						
		<div class="h2title-item"><span><h2>Отзывы</h2></span></div>
					
						    						        <?
						    						        //echo $arResult['ID'];
						    						        $APPLICATION->IncludeComponent(
	"khayr:main.comment", 
	"comment", 
	array(
		"OBJECT_ID" => "0",
		"COUNT" => "20",
		"MAX_DEPTH" => "2",
		"JQUERY" => "N",
		"MODERATE" => "N",
		"LEGAL" => "N",
		"LEGAL_TEXT" => "Я согласен с правилами размещения сообщений на сайте.",
		"CAN_MODIFY" => "N",
		"NON_AUTHORIZED_USER_CAN_COMMENT" => "Y",
		"REQUIRE_EMAIL" => "N",
		"USE_CAPTCHA" => "Y",
		"AUTH_PATH" => "/auth/",
		"ACTIVE_DATE_FORMAT" => "j F Y, G:i",
		"LOAD_AVATAR" => "N",
		"LOAD_MARK" => "Y",
		"LOAD_DIGNITY" => "Y",
		"LOAD_FAULT" => "Y",
		"ADDITIONAL" => array(
		),
		"ALLOW_RATING" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"COMPONENT_TEMPLATE" => "comment",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
					</div>        
				        <?php 
				    }
				}
				?>
				
				
				
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

                    <?php
                    if (is_countable($arResult['PROPERTIES']['standarts']['VALUE']) && count($arResult['PROPERTIES']['standarts']['VALUE']) > 0){
                    if(count($arResult['PROPERTIES']['standarts']['VALUE'])){ ?>
                        <div class="u-none--m">
                            Стандарты:
                            <ul class="similar">
                                <?foreach ($arResult['PROPERTIES']['standarts']['VALUE'] as $standart):?>
                                    <li class="similar__item"><?=$standart?></li>
                                <?endforeach?>
                            </ul>
                        </div>
                    <?php }
                    }?>
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
                    $rsElement = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 44, 'ID' => $arResult['PROPERTIES']['SALE_BANNER']['VALUE'], 'ACTIVE'=>'Y'), false, false, array('ID', 'NAME', 'PROPERTY_653', 'PROPERTY_654'));
                    if ($arElement = $rsElement->Fetch()){
                        $bannerCode = $arElement['PROPERTY_653_VALUE'];
                        $bannerSrc = CFile::GetPath($bannerCode);

                        $bannerHref = $arElement['PROPERTY_654_VALUE'];
                        $bannerName = $arElement['NAME'];
                        
                        if ($bannerCode == '737394') {
                            $d = "";
                        } else {
                            $d = "download=''";
                        }
                        
                    } ?>

                    <a href="<?=$bannerHref?>" <?=$d?>><img src="<?=$bannerSrc?>" alt="<?=$bannerName?>" class="detail-sale-banner"></a>

                <? } ?>
            </div>
        </div>

<div class="col-12 col-xl-3 col-lg-3 col-md-3" id="prod-price-block-area">


<a data-fancybox="iframe" onclick="ym(18248638,'reachGoal','getVideoItem'); return true;" class="prod-video-link-serv" href="https://www.youtube.com/embed/qW58I63D1LY">  
        <div class="prod-nal item-player-area">
        <div class="player-articles-title">Производство Трайв</div>
        <div id="item-video-one-bg" class="item-player" 
               data-property="{videoURL:'https://www.youtube.com/embed/qW58I63D1LY',containment:'.item-player-area',autoPlay:true, mute:true, startAt:17, stopAt:300, opacity:1}">
          </div>
        </div>      
        </a>  

 <div class="prod-len-block">
 <div class="row">
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
        
        $res_rows = intval($db_list_in->SelectedRowsCount());
        
        $arr_rows = array();
        ?>
         <div class="col-6">
        <?php
        if ($res_rows > 0) {
            
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
            
            if (is_countable($arr_rows_len) && count($arr_rows_len) > 0){
            //if (count($arr_rows_len) !== 0) {
                
                if (count($arr_rows_len) == '1') {
                    ?>
                    <a href="<? echo $arr_rows_len['0']['URL'];?>" class="prod-len-block-link"><i class="fa fa-arrow-left prod-len-icon-left"></i><!-- Уменьшить длину (--> М <?echo $arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"]." x ".$arr_rows_len['0']['len'];?><!--  ) --></a>
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
                    <a href="<? echo $arr_rows_len[$max_key]['URL'];?>" class="prod-len-block-link"><i class="fa fa-arrow-left prod-len-icon-left"></i><!-- Уменьшить длину (--> М <?echo $arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"]." x ".$arr_rows_len[$max_key]['len'];?> <!--  ) --></a>
                    <?php       
                }
            }
            
        }
        ?>
        </div>
        <?php
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
        ?>
         <div class="col-6">
         <?php    
        if ($res_rows > 0) {
         
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
                    
                    <a href="<? echo $arr_rows_len['0']['URL'];?>" class="prod-len-block-link"><!-- Увеличить длину ( --> М <?echo $arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"]." x ".$arr_rows_len['0']['len'];?> <!-- )  --><i class="fa fa-arrow-right prod-len-icon-right"></i></a>
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
                    
                    <a href="<? echo $arr_rows_len[$max_key]['URL'];?>" class="prod-len-block-link"><!-- Увеличить длину ( --> М <?echo $arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"]." x ".$arr_rows_len[$max_key]['len'];?> <!-- )<i class="fa fa-ttl-search fa-ttl-icon-right"></i> --><i class="fa fa-arrow-right prod-len-icon-right"></i></a>
                    <?php       
                }
            }
        }
        ?>
            </div>
            <?php 
        if (!empty($arResult['DISPLAY_PROPERTIES']['DLINA_1']["VALUE"]) && !empty($arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"])) {
        ?>
        
         <!-- <div class="col x1d5 x1d1--t">
         <a data-prodtab-num="6" href="#" data-prodtab="#prod-tab-6" rel="nofollow" class="prod-len-block-link" onclick="ym(18248638,'reachGoal','run_RS'); return true;" id="size_table_link" style="text-align:center;"><i class="fa fa-ttl-search fa-ttl-icon-table"></i>Все размеры</a>
         </div>-->
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
<!-- this -->


<div class="prod-price-info">
<div class="prod-info">
<div class="prod-info-line g-0">
			<p class="prod-price-name">
			Розничная цена
			</p>
			<?php
			        if ($arResult["PROPERTIES"]['ACTION']['VALUE']){?>

                                <div class="prod-discont-title" title="Распродажа"><div class="prod-discont-title-text">Распродажа</div></div>

                            <?}
			        
			      //  echo var_dump($printPrice);
			        if (is_null($printPrice) || $printPrice === '0 руб.') {
			            ?>
			            <div class="prod-addwrap-opt text-center mb-1">
    			        <div class="btn-group-blue">
                            <a href="#w-form-one-click-zp" class="btn-blue-round" rel="nofollow">
                                <span>Запросить цену</span>
                            </a>
                        </div>
                        </div>
			            <?php 
			        } else {
			            ?>
			            <p class="prod-price">
            				<b class="item_current_price">
            				<? echo str_replace(' ','',str_replace('руб.','',$printPrice)).'<i class="fa fa-rub"></i>';?>
            				</b>
            			</p>
			            <?php 
			        }
			        
			        ?>
			        
			        
			        <a href="#x" class="w-form__overlay-one-click" id="w-form-one-click-zp"></a>
                        <div class="w-form__popup-one-click">
			        <? $APPLICATION->IncludeComponent(
			        "slam:easyform",
			        "traiv",
			        array(
			        "COMPONENT_TEMPLATE" => "traiv",
			        "FORM_ID" => "FORM88",
			        "FORM_NAME" => "Запросить цену",
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
			        "SHOW_MODAL" => "N",
			        "_CALLBACKS" => "",
			        "TITLE_SHOW_MODAL" => "Спасибо!",
			        "OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение ближайшего рабочего часа",
			        "ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
			        "ENABLE_SEND_MAIL" => "Y",
			        "CREATE_SEND_MAIL" => "",
			        "EVENT_MESSAGE_ID" => array(
			        ),
			        "EMAIL_TO" => "info@traiv-komplekt.ru",
			        "EMAIL_BCC" => "dmitrii.kozlov@traiv.ru",
			        "MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи ЗАПРОСИТЬ ЦЕНУ",
			        "EMAIL_FILE" => "Y",
			        "EMAIL_SEND_FROM" => "N",
			        "CREATE_SEND_MAIL_SENDER" => "",
			        "EVENT_MESSAGE_ID_SENDER" => array(
			        0 => "121",
			        ),
			        "EMAIL_BCC_SENDER" => "dmitrii.kozlov@traiv.ru",
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
					                    );
			     ?>
			     <a class="w-form__close" title="Закрыть" href="#w-form__close"><i class="fa fa-close"></i></a>
                        </div>
			 

			<!-- for mobil -->
			<div class='prod-qnt-area'>
	        <div class='prod-qnt'>
	        
	        <a href="#" class="prod-qnt-button prod-minus"><i class="icofont icofont-minus-square"></i></a>
	        <input type='number' name='QUANTITY' value='<?=$pack?>' min="<?=$pack?>" step="<?=$pack?>" class="quantity prod-qnt-input" id="<?= $arResult["ID"]?>-item-quantity">
	        <a href="#" class="prod-qnt-button prod-plus"><i class="icofont icofont-plus-square"></i></a>
	        
	        </div>
	        </div>
	        <!-- // for mobil -->
	        
	        <div class="row justify-content-center align-self-center">
	        <div class="col-5 text-center">
                <div class="catalog-list-quantity-area">
                    <input type="number" name='QUANTITY' value='<?=$pack?>' min="<?=$pack?>" step="<?=$pack?>" class="quantity prod-qnt-input" id="<?= $arResult["ID"]?>-item-quantity">
                    <a href="#" class="prod-plus-new-link prod-plus-new"><span><i class="fa fa-plus"></i></span></a>
                    <a href="#" class="prod-plus-new-link prod-minus-new"><span><i class="fa fa-minus"></i></span></a>
                </div>
            </div>
            
            <div class="col-7 text-center align-self-center">
            	<div class="btn-group-blue">
                        <a data-href="<?= $arResult['~ADD_URL'] ?>" id="buy" class="btn-cart-roundw new-item-line-buy" data-ajax-order-detail onclick="ym(18248638,'reachGoal','addToBasketItem'); return true;" rel="nofollow">
                            <span><i class="fa fa-shopping-cart"></i> В корзину</span>
                        </a>
                    </div>
                        </div>
                        
                        </div>
			
			<!-- <p class="prod-qnt-new">
				<input type='text' name='QUANTITY' value='<?=$pack?>' min="<?=$pack?>" step="<?=$pack?>" class="quantity prod-qnt-input" id="<?= $arResult["ID"]?>-item-quantity">
				<a href="#" class="prod-plus-new"><i class="fa fa-angle-up"></i></a>
				<a href="#" class="prod-minus-new"><i class="fa fa-angle-down"></i></a>
			</p>-->
			<!-- <p class="prod-addwrap">
				<a data-href="<?= $arResult['~ADD_URL'] ?>" class="prod-add" rel="nofollow" id="buy" style="cursor:pointer;" data-ajax-order-detail><i class="icofont icofont-shopping-cart"></i> В корзину</a>
			</p>-->
			
			<?php
			if (!empty($printPrice) && !empty($pack)){
	                if ( $printPrice !== '0 руб.' ) {
	                    $price_summ_item = str_replace(' ','',$printPrice) * $pack;
	                    echo "<div class='price_summ_item' data-summ-price='".str_replace(' ','',str_replace(' руб.','',$printPrice))."'>Общая стоимость: <b>".$price_summ_item." руб.</b></div>";
	                }
			}
	        ?>
			</div>
			<p class="prod-price-name">
			Оптовая цена
			</p>
			
			<p class="prod-price-note">
			Для получения оптовой цены свяжитесь с нашим менеджером
			</p>
			
			
			
			<div class="prod-addwrap-opt text-center">
				<!-- <a href="#w-form-one-click" class="prod-add-opt" rel="nofollow"><i class="icofont icofont-mail"></i> Оптовая цена</a>-->
				
				<div class="btn-group-blue">
                        <a href="#w-form-one-click" class="btn-blue-round" rel="nofollow">
                            <span>Оптовая цена</span>
                        </a>
                    </div>
				
			</div>
			
		</div>
		</div>
		
		        <? if (!$ymarket):?>
		        <?php 
		        if ($pack > 1){
		        ?>
		        <div class="prod-price-info">
        <div class="check_type_pack"><i class="fa fa-exclamation-circle"></i>Внимание: продажа осуществляется кратно упаковкам.</div>
        </div>
        <?php 
		        }
        ?>
        
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
		"EMAIL_BCC" => "dmitrii.kozlov@traiv.ru",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи ОПТОВАЯ ЦЕНА",
		"EMAIL_FILE" => "Y",
		"EMAIL_SEND_FROM" => "N",
		"CREATE_SEND_MAIL_SENDER" => "",
		"EVENT_MESSAGE_ID_SENDER" => array(
			0 => "121",
		),
		"EMAIL_BCC_SENDER" => "dmitrii.kozlov@traiv.ru",
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
		"USE_CAPTCHA" => "N",
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
                            <a class="w-form__close" title="Закрыть" href="#w-form__close"><i class="fa fa-close"></i></a>
                        </div>

                </div>
            </div>

<?
/*If ($arResult['PRODUCT']['QUANTITY'] > 0 || $arResult["PROPERTIES"]["EUROPE_STORAGE"]["VALUE"] > 0){*/?>
		<div class="prod-nal">
		<span href="#" class="prod-nal-title"><i class="fa fa-circle"></i> Наличие</span>
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
       
        
        <?If ($arResult['PRODUCT']['QUANTITY'] > 0){ ?>
            <li class="prod-nal-list-item"><?
            echo '<div class="title">Склад (СПб)</div><div class="value">'.$arResult['PRODUCT']['QUANTITY'].' шт</div>';
                ?>
            </li>
        <?} 
        
        $mystring = $arResult['NAME'];
        $findme   = 'Европа';
        $pos = strpos($mystring, $findme);
        
        if ($arResult['PRODUCT']['QUANTITY'] == 0 && $pos != true && ($arResult["PROPERTIES"]["EUROPE_STORAGE"]["VALUE"] == 0 || empty($arResult["PROPERTIES"]["EUROPE_STORAGE"]["VALUE"])) ){
            ?>
            <li class="prod-nal-list-item"><?
            echo '<div class="value">Данный товар можно приобрести под заказ.</div>';
            ?>
            </li>
            <?php 
        }
        
        
        
        if ($pos != false && ($arResult["PROPERTIES"]["EUROPE_STORAGE"]["VALUE"] == 0 || empty($arResult["PROPERTIES"]["EUROPE_STORAGE"]["VALUE"]))) {
            ?>
            <li class="prod-nal-list-item"><?
            echo '<div class="value">Данный товар можно приобрести под заказ. Срок поставки 5 недель.</div>';
            ?>
            </li>
            <?php 
        }
        ?>
        
        
        
        <?
        
/*        if ( $USER->IsAuthorized() )
        {
            if ($USER->GetID() == '3092') {*/
                
                If ($arResult["PROPERTIES"]["EUROPE_STORAGE"]["VALUE"] > 0) : ?>
                    <li class="prod-nal-list-item" id="prod-nal-list-item-last-child"><?
                        echo '<div class="title">'.$arResult["PROPERTIES"]["EUROPE_STORAGE"]["NAME"].'</div><div class="value">'.$arResult["PROPERTIES"]["EUROPE_STORAGE"]["VALUE"].' шт</div>';
                        ?>
                    </li>
            	<!-- <div class="eur_delivery">(cрок доставки: 10 дней)</div> -->
        		<?endif;
         /*   }
        }*/
        
        
        /*If ($arResult["PROPERTIES"]["EUROPE_STORAGE"]["VALUE"] > 0) : ?>
            <li class="prod-nal-list-item" id="prod-nal-list-item-last-child"><?
                echo '<div class="title">'.$arResult["PROPERTIES"]["EUROPE_STORAGE"]["NAME"].'</div><div class="value">'.$arResult["PROPERTIES"]["EUROPE_STORAGE"]["VALUE"].' шт</div>';
                ?>
            </li>
            <div class="eur_delivery">(cрок доставки: 10 дней)</div>
        <?endif;*/?>
        
		</ul>
        </div>
<?/*}*/?>
<?php 



/*if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '4677') {*/
        if (!empty($arResult["PROPERTIES"]["TRANSIT_NUM"]["VALUE"]) && $arResult['PRODUCT']['QUANTITY'] != $arResult["PROPERTIES"]["TRANSIT_NUM"]["VALUE"]) {
 ?> 
 
 		<div class="prod-nal">
		<span href="#" class="prod-transit-title"><i class="fa fa-truck"></i> Скоро на складе</span>
		<ul class="prod-nal-list">
       
        <?If ($arResult["PROPERTIES"]["TRANSIT_NUM"]["VALUE"] > 0) : ?>
            <li class="prod-nal-list-item"><?
            echo '<div class="title">СПб и МСК</div><div class="value">'.$arResult["PROPERTIES"]["TRANSIT_NUM"]["VALUE"].' шт</div>';
                ?>
            </li>
        <?endif;?>
        
        
		</ul>
        </div>
 
 <?php       
        }
                ?>
        </div>
        </div>
    </div>
    
    <div class="col-12 col-xl-12 col-lg-12 col-md-12 align-self-center">
        <div class="row d-flex align-items-center g-0">
        
        <?php
/*смежные карточки*/
        if (!empty($arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"]) && /*!empty($arResult['DISPLAY_PROPERTIES']['DLINA_1']["VALUE"]) &&*/ !empty($arResult['DISPLAY_PROPERTIES']['STANDART']["VALUE"]) && !empty($arResult['DISPLAY_PROPERTIES']['MATERIAL_1']["VALUE"]) && !empty($arResult['DISPLAY_PROPERTIES']['POKRYTIE_1']["VALUE"])) {
        
        $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PROPERTY_610", "PROPERTY_604", "PROPERTY_644", "CATALOG_QUANTITY","CATALOG_PRICE_2", "PROPERTY_417", "DATE_CREATE");
        $arSort = array('NAME'=>'ASC'); //"PROPERTY_604" => 'desc'
        
        $arFilter = array('IBLOCK_ID'=>"18",'!=ID'=>$arResult['ID'],
        'PROPERTY_613_VALUE'=>$arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"],
        'PROPERTY_612_VALUE'=>$arResult['DISPLAY_PROPERTIES']['DLINA_1']["VALUE"],
        'PROPERTY_606_VALUE'=>$arResult['DISPLAY_PROPERTIES']['STANDART']["VALUE"],
        'PROPERTY_610_VALUE'=>$arResult['DISPLAY_PROPERTIES']['MATERIAL_1']["VALUE"],
        'PROPERTY_611_VALUE'=>$arResult['DISPLAY_PROPERTIES']['POKRYTIE_1']["VALUE"],
        ">CATALOG_QUANTITY" => 0,
        ">CATALOG_PRICE_2" => 0);
        $res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
        /*
        if ( $USER->IsAuthorized() )
        {
            if ($USER->GetID() == '3092') {
                echo $res->SelectedRowsCount();
            }
        }
        */
        if ( $res->SelectedRowsCount() > 0 ){
        
            ?>
        <div class="col-12 col-xl-12 col-lg-12 col-md-12">
        	<div class="h1title-item"><span>Другие предложения на складе:</span></div>
        </div>
        <?php 
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
                ?>
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 cross_item_area">
            <div class="row d-flex align-items-center g-0">
            <?php 
                   // echo "<div class='cross_item_tr'>";
                echo "<div class='col-1 cross_item'>";
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
                
                <div class="col-5 cross_item">
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
                
                <div class="col-2 offset-2 cross_item cross_item_nal">
                <?php
                if ($arrob['PROPERTY_644_VALUE'] > 0) {
                    //echo "<div class='cross_item_count'>Склад Европа - <b>".$arrob['PROPERTY_644_VALUE']."</b> шт. (cрок доставки: 10 дней)</div>";
                }?>
                <?php
                if ($arrob['CATALOG_QUANTITY'] > 0) {
                    echo "<div class='cross_item_count'>Склад (СПб) - <b>".$arrob['CATALOG_QUANTITY']."</b> шт.</div>";
                }?>
                
                </div>
                
                <div class="col-2 cross_item cross_item_price">
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
echo "</div>";
            }

        }
        //echo "</div>";
       // echo "</div>";
        }
        }
        
  /*  }
}*/
/*смежные карточки*/
?>
        
        </div>
    </div>
    
        <!-- <div class="col-12 col-xl-12 col-lg-12 col-md-12 align-self-center">
    <div class="row d-flex align-items-center g-0">
    <?
                
                $db_list = CIBlockSection::GetList(Array(), $arFilter = Array("IBLOCK_ID"=>18, "ID"=>$arResult['IBLOCK_SECTION_ID']), true, Array("UF_RECOMEND", "UF_CANONICAL", "UF_LONGTEXT")); $props_array = $db_list->GetNext();
                
                //analog start
                if (!empty($props_array["UF_RECOMEND"])) {
                    $rsSections = CIBlockSection::GetList(
                        array("SORT" => "ASC"),
                        array("IBLOCK_ID" => '18', "ACTIVE" => "Y", "ID" => $props_array["UF_RECOMEND"]),
                        false,
                        array("NAME", "DETAIL_PICTURE", "PICTURE", "SECTION_PAGE_URL"),
                        false
                        );
                    
                    ?>

        <div class="col-12 col-xl-12 col-lg-12 col-md-12">
        	<div class="h1title-item"><span>Аналоги:</span></div>
        </div>

    <div class="analogues-item">
        
        <noindex><p data-nosnippet="">Обозначение "Аналог товара" - не является на 100% гарантией, что аналог будет точной копией исходного изделия (по техническим параметрам, по цветовой палитре и т.д.).
            Для избежания ошибок, рекомендуем Вам проконсультироваться с <a href="#w-form-recall" >нашими специалистами.</a></p></noindex>
        
        <div class="col-12" id="analog-area">
        <ul class="row d-flex">
            <?
            while ($arSections = $rsSections->GetNext()) {
                ?>

                <?   $widthsizen="150";
                $heightsizen="150";

                $arFileRecTmpn = CFile::ResizeImageGet(
                    $arSections['PICTURE'],
                    array("width" => $widthsizen, "height" => $heightsizen),
                    BX_RESIZE_IMAGE_PROPORTIONAL,
                    true, $arFilter
                );

                ?>
                <li class="col-6 col-xl-2 col-lg-2 col-md-2">
                <a href="<?= $arSections['SECTION_PAGE_URL'] ?>" class="category-item-link">
                    <div class="category-item">
                    
                        <div class="catalog-item__image catalog-item-analog">
                            <img src="<?= $arFileRecTmpn['src']?>" class="lazy" alt="<?= $arSections['NAME'] ?>" title="<?= $arSections['NAME'] ?>">
                        </div>
                        <div class="catalog-item__title_mp">
                            <span class="v-aligner"><?= $arSections['NAME'] ?></span>
                        </div>
                    
                    </div>
                    </a>
                </li>

                <?
            }
            ?>
        </ul>
        </div>
        
    </div>
    <?
}
//analog end
		?>
    </div>
    </div>-->
    
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
        "IMAGE" => $imgurl_schema,
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
<?php 
if (!empty($arResult["IBLOCK_SECTION_ID"])) {
?>
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
<?php 
}
?>


    <!--</div> closing in component epilog -->




