<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


        $checkUrl = str_replace('https://traiv-komplekt.ru','',$arResult['CANONICAL_PAGE_URL']);
        if ($arResult['DETAIL_PAGE_URL'] !== $checkUrl) {
            echo '<script type="text/javascript">window.location = "'.$arResult['CANONICAL_PAGE_URL'].'"</script>';
        }
        
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
            <div class="product-specs">
                <div class="row">
                    <div class="col x1d4 x1d1--m">
                        <?

                        if ( $USER->IsAuthorized() )
                        {
                            if ($USER->GetID() == '3092') {
                                ?>
                                
                                				<div class="prod-slider">
					<ul class="prod-slider-car">
					
					                            <?If (!empty($arResult['DETAIL_PICTURE']['SRC'])) :?>

                                
                                    <?
                                    $img = $arResult['DETAIL_PICTURE'];
                                    $imgurl=$arResult['DETAIL_PICTURE']['SRC'];

                                    ?>
                                         
                                         <li>
							<a data-fancybox-group="product" class="fancy-img" href="<?=$imgurl;?>">
								<img src="<?=$imgurl //? $arResult['DETAIL_PICTURE']['SRC'] : '/images/no_image.png')?>"
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

                                $picturl = CFile::ResizeImageGet($img,array('width'=>200, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                                ?>
                                
                                <li>
							<a data-fancybox-group="product" class="fancy-img" href="<?= $picturl['src'];?>">
								<img
                                        src="<?= $picturl['src'] //? $item['DETAIL_PICTURE']['SRC'] : '/images/no_image.png') ?>"
                                        alt="<?=  $arResult['NAME'] ?>">
							</a>
						</li>


                            <?endif?>
                            
                                                        <? if(!empty($arResult['MORE_PHOTO'])):?>


                                    <? foreach($arResult['MORE_PHOTO'] as $imgGal):?>

                                        <? $thumb  = CFile::ResizeImageGet($imgGal, Array("width" => 200, "height" => 120) );?>

<li>
							<a data-fancybox-group="product" class="fancy-img" href="<? echo $imgGal['SRC']?>">
								<img class="lazy" src="<? echo $thumb['src']?>">
							</a>
						</li>

                                    <? endforeach?>

                            <? endif ?>
						

					</ul>
				</div>
				
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
					
					<? if(!empty($arResult['MORE_PHOTO'])):?>


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

                            <? endif ?>


					</ul>
				</div>
				
				
				
                                
                                <?php 
                             
                                $check = "style='display:none;'";
                            }
                        }

                        ?>

                        <div class="product__image x1d3--s" <?php echo $check;?>>
                            <?/*if ($arResult["PROPERTIES"]['ACTION']['VALUE']){?>

                                <div class="bx_stick average left top" title="Распродажа">Распродажа со склада</div>

                            <?} */?>

                            <?//*Вывод изображения стандарт**///?>

                            <?If (!empty($arResult['DETAIL_PICTURE']['SRC'])) :?>

                                <div id="main-image" class="product-image">
                                    <?
                                    $img = $arResult['DETAIL_PICTURE'];
                                    $imgurl=$arResult['DETAIL_PICTURE']['SRC'];

                                    ?>
                                    <img src="<?=$imgurl //? $arResult['DETAIL_PICTURE']['SRC'] : '/images/no_image.png')?>"
                                         alt="<?=$arResult['NAME']?>" class="adaptive zoom-image lazy" id="<?=$arResult["ID"]?>"><??>
                                </div>
                            <? else : ?>

                                <?//*Вывод изображения из каталога**///
                                ?><div id="main-image" class="product-image"><?
                                $rsElement = CIBlockElement::GetList(array(), array('ID' => $arResult['ID']), false, false, array('ID', 'IBLOCK_SECTION_ID', 'DETAIL_PICTURE'));
                                if($arElement = $rsElement->Fetch())


                                    $rsElement = CIBlockSection::GetList(array(), array('ID' => $arElement['IBLOCK_SECTION_ID']), false, array('ID', 'IBLOCK_SECTION_ID', 'PICTURE'));
                                if($arElement = $rsElement->Fetch())

                                    $img = $arElement['DETAIL_PICTURE'] ? $arElement['DETAIL_PICTURE'] : $arElement['PICTURE'];

                                $picturl = CFile::ResizeImageGet($img,array('width'=>200, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                                ?>
                                <img    class="adaptive zoom-image lazy"
                                        src="<?= $picturl['src'] //? $item['DETAIL_PICTURE']['SRC'] : '/images/no_image.png') ?>"
                                        alt="<?=  $arResult['NAME'] ?>" id="<?= $arResult["ID"]?>">


                                </div>

                            <?endif?>


                            <? //Дополнительные фото товара (галерея)?>

                            <? if(!empty($arResult['MORE_PHOTO'])):?>
                                <div class="product-gallery ">

                                    <? $thumborig  = CFile::ResizeImageGet($img, Array("width" => 80, "height" => 80) );

                                    ;?>

                                    <a class="gallery-image first" href="<?=$imgurl?>">
                                        <img class="lazy" src="<?=$thumborig['src']?>">
                                    </a>

                                    <? foreach($arResult['MORE_PHOTO'] as $imgGal):?>

                                        <? $thumb  = CFile::ResizeImageGet($imgGal, Array("width" => 80, "height" => 80) );?>

                                        <a class="gallery-image" href="<? echo $imgGal['SRC']?>"><img class="lazy" src="<? echo $thumb['src']?>"></a>

                                    <? endforeach?>

                                </div>

                            <? endif ?>

                        </div>

                        <?//*Вывод пользовательского свойства категории типа файл
                        $SectId = $arResult['SECTION']['ID'];

                        CModule::IncludeModule("iblock");
                        $db_list = CIBlockSection::GetList(array(), array('IBLOCK_ID'=> 18, 'ID' => $SectId), false, ["UF_SERTIFICAT"]);
                        while($res = $db_list->GetNext())
                        {
                            ?><div class="sertimg"  id="title_<?=$arResult["ID"]?>"><?
                            foreach ($res["UF_SERTIFICAT"] as $keyone):

                                $SERTFILE = CFile::GetFileArray($keyone);
                                $fileNameOrig = $SERTFILE['ORIGINAL_NAME'];?>

                                <a href="<?echo ($SERTFILE["SRC"]);?>" title="<?$strKb = $SERTFILE['FILE_SIZE']/1024; echo round($strKb).' Кб';?>">
                                    <?$f=$SERTFILE['SRC'];$p=pathinfo($f);$pdf=array($p['extension']);if(in_array('pdf',$pdf)):?><tr><td><img src="/images/gost/pdf.png" width="24px" >Скачать стандарт <?echo $SERTFILE['ORIGINAL_NAME'];?></td></tr><?else:?><?endif;?>
                                    <?$f=$SERTFILE['SRC'];$p=pathinfo($f);$doc=array($p['extension']);if(in_array('doc',$doc)):?><tr><td><img src="/images/gost/doc.png" width="24px" >Скачать стандарт <?echo $SERTFILE['ORIGINAL_NAME'];?></td></tr><?else:?><?endif;?> </a>
                                <br>


                            <?

                            endforeach;
                            ?></div><?
                        }
                        ?>

                        <br>


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



                        <!--<div class="file_upl" style="text-align:center">
                            <div class="raprodaja_sklad">Распродажа со склада</div>

                            <div class="download_excel mash" style="margin-right:4px;">
                                <a href="/images/price/Traiv_Komplekt_rasprodazha_so_sklada_mashinostroitelnogo_krepezha.xlsx" class="mashkrep">Скачать<br><img src="/images/Excel2_35735.png" class="lazy" style="width: 50%;"><div class="mash-title">Машиностр. <br>крепежа</div></a>
                            </div>

                            <div class="download_excel stroy">
                                <a href="/images/price/Traiv_Komplekt_rasprodazha_nerjaveushego_krepezha_so_sklada.xlsx" class="stroykrep">Скачать<br><img src="/images/Excel2_35735.png" class="lazy" style="width: 50%;"><div class="stroy-title">Нержавеющего<br> крепежа</div></a>
                            </div>
                            <div class="mash-block">Скачано:<div class="mash-number"><?/*=$mechNumber*/?></div></div>
                            <div class="stroy-block">Скачано:<div class="stroy-number"><?/*=$stroyNumber*/?></div></div>

                        </div>-->

                        <br>



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
                    <div class="col x3d4 x1d1--s">
                        <? if ($arResult['DISPLAY_PROPERTIES']['DIAMETR_1']["VALUE"] && $arResult['DISPLAY_PROPERTIES']['STANDART']["VALUE"]):?>
                            <div class="analog_materials_block" style="display: none;">
                                <div class="analog_materials_title">Этот крепеж из других материалов: </div>
                                <div class="analog_materials">
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

                                        <a class="analog-material enumid-<?= $ob["PROPERTY_610_ENUM_ID"] ?>"
                                           href="<?= $ob["DETAIL_PAGE_URL"] ?>"><img src="<?= $analogpict["src"] ?>"
                                                                                     class="analog-materials-img">
                                            <div class="analog-material-value"><?= $materialname ?></div>
                                        </a>

                                        <?
                                    }
                                    }
                                    ?>
                                </div>
                            </div>
                        <?endif;?>
                        <div class="col x2d3 x2d3--m x1--s">
                            <div class="u-push-left">
                                <?php if(count($arResult['DISPLAY_PROPERTIES'])){ ?>
                                    <h4 class="md-title">Свойства:</h4>

                                    <?foreach ($arResult['DISPLAY_PROPERTIES'] as $property):?>
                                        <dl	class="dl">
                                            <?$filterURL = '/catalog/?';
                                            $formatedValue = strtolower(str_replace(array(" ",",","-"), "_",$property["VALUE"]));
                                            //print_r ($property['CODE']);
                                            if(is_array($property["VALUE"])){
                                                $property["VALUE"]=trim(implode(", ",$property["VALUE"]));
                                            }?>

                                            <dt><?=$property["NAME"]?>:</dt><!--<div class="dots"></div>--><dd><a href="<?=$filterURL.strtolower($property['CODE']).'='.$formatedValue?>"><?=$property["VALUE"]?></a></dd></dl>
                                    <?endforeach?>
                                    <? if(!empty($arResult['CATALOG_WEIGHT'])) {?>
                                        <dl	class="dl">
                                        
                                        <?
/*if ( $USER->IsAuthorized() )
	{
	    if ($USER->GetID() == '3092') {
	        echo "<pre>";
	        print_r($arResult['PROPERTIES']['KRATNOST_UPAKOVKI']);
	        echo "</pre>";
	    }
	}*/
	?>
                                        
                                        <?php 
                                            $weight = $arResult['CATALOG_WEIGHT'] / 1000;
                                        ?>
                                            <dt <?php echo $weight;?>>Вес шт., кг.:</dt><dd><?=$weight/*$arResult['CATALOG_WEIGHT']*/?></dd>
                                        </dl>
                                    <?

                                    if (!empty($arResult['PROPERTIES']['KRATNOST_UPAKOVKI']['VALUE']))
                                    {
                                        echo '<dl class="dl">';
                                        echo '<dt>Вес уп., кг.:</dt><dd>'.$arResult['CATALOG_WEIGHT'].'</dd>';
                                        echo '</dl>';
                                    }
                                    
                                            }?>


                                <?php } ?>



                            </div>
                        </div>
                        <div class="col x1d3 x1d3--m x1--s">


                    </div>

                </div>

            </div>

        </div>



            <div><?=$arResult["DETAIL_TEXT"]?></div>

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

        </div>

        <div class="col x1d4 x1d1--t element-sale-block">

            <div class="shadow-price">
                <div class="price-block-one">
                    <h4 class="md-title" >РОЗНИЧНАЯ цена:</h4>
                    <div class="price">
                        <span class="price__units white-push"><?= $printPrice !== '0 руб.' ? $printPrice : 'По запросу'?></span>
                    </div>
                </div>
                <div class="price-block-two">
                    <h4 class="md-title" >ОПТОВАЯ цена:</h4>
                    <div class="price">
                        <span class="second-price__units white-push">Уточняйте<br>у менеджера</span>
                    </div>

                    <?php /*if($printPrice !== '0 руб.'){*/?>
                        <a href="#w-form-one-click" class="btn opt-detail"><img src="/img/ico/letter-43x25.png"><div class="opt-btn-label">Оптовая цена</div></a>
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
            <br>

        <?
        $arMeasure = \Bitrix\Catalog\ProductTable::getCurrentRatioWithMeasure($productId);
        $unit =  $arMeasure[$productId]['MEASURE']['SYMBOL_RUS'];

        /*$storeRes = CCatalogStoreProduct::GetList(array("SORT" => "ASC"),array("PRODUCT_ID" => $productId),false,false,array("*") );  OLD STYLE */

        $storeRes = \Bitrix\Catalog\StoreProductTable::getList(array(
            'filter' => array('=PRODUCT_ID'=>$productId,'STORE.ACTIVE'=>'Y'),
            'select' => array('AMOUNT','STORE_ID','STORE_TITLE' => 'STORE.TITLE'),
        ));

        while($arStoreParam = $storeRes->Fetch()){

            if ($arStoreParam["AMOUNT"] > 0):
                ?><div class="storages-block"><?
                echo /*$arStoreParam["STORE_TITLE"].*/'Склад Кудрово (СПб): '.$arStoreParam["AMOUNT"].' '.$unit.'<br>';
                ?></div><?
            endif;
        }
        ?>
        <?If ($arResult["PROPERTIES"]["EUROPE_STORAGE"]["VALUE"] > 0) : ?>
            <div class="storages-block"><?
                echo $arResult["PROPERTIES"]["EUROPE_STORAGE"]["NAME"].': '.$arResult["PROPERTIES"]["EUROPE_STORAGE"]["VALUE"].' шт'.'<br>';
                ?><div class="pack_notice">(cрок доставки: 10 дней)</div>
            </div>
        <?endif;?>

	        <p>Введите количество:</p>
	        <div class='prod-qnt-area'>
	        <div class='prod-qnt'>
	        
	        <a href="#" class="prod-qnt-button prod-minus"><i class="icofont icofont-minus-square"></i></a>
	        <input type='text' name='QUANTITY' value='<?=$pack?>' min="<?=$pack?>" step="<?=$pack?>" class="quantity prod-qnt-input" id="<?= $arResult["ID"]?>-item-quantity">
	        <a href="#" class="prod-qnt-button prod-plus"><i class="icofont icofont-plus-square"></i></a>
	        
	        </div>
	        </div>
	        
	        <?php
	                if ( $printPrice !== '0 руб.' ) {
	                    $price_summ_item = str_replace(' ','',$printPrice) * $pack;
	                    echo "<div class='price_summ_item' data-summ-price='".str_replace(' ','',str_replace(' руб.','',$printPrice))."'>Общая стоимость: <b>".$price_summ_item."</b> руб.</div>";
	                }
	        ?>

<!-- 
        <p>Введите количество:</p>

        <input type='number' name='QUANTITY' class="quantity"  size="10" value='<?=$pack?>' min="<?=$pack?>" step="<?=$pack?>" id="<?= $arResult["ID"]?>-item-quantity">
-->
        <? if (!$ymarket):?>
        <p class="pack_notice" ><span align="center" style="font-size: 1.8em; color: red;">!</span> Внимание: продажа осуществляется кратно упаковкам.</p>
        <?endif; ?>
        <p><a data-href="<?= $arResult['~ADD_URL'] ?>" style="cursor:pointer" rel="nofollow" class="btn buy-detail" id="buy" data-ajax-order-detail><?= $buttonLabel ?></a></p>




            <!--<ul class="advantages">
                <li class="advantages__item">
                    <div class="sprite-icon sprite-icon--thumbup"></div>
                    Высокий профессионализм<br>сотрудников компании
                </li>
                <li class="advantages__item">
                    <div class="sprite-icon sprite-icon--car"></div>
                    Доставка по всей России
                </li>
                <li class="advantages__item">
                    <div class="sprite-icon sprite-icon--traiv"></div>
                    Постоянный контроль<br>качества поступающих на склад<br>крепежных изделий
                </li>
            </ul>-->

        </div>
    </div>
    <div id="result-tuning">
        <h3 class="md-title">То, что вы искали:</h3>
        <ul class="row"></ul>

    </div>
    <br>
<div class="tab element">
    <button class="tablinks x1d4 x1d2--s" onclick="openTab(event, 'Information')"><strong>Описание</strong></button>
    <button class="tablinks x1d4 x1d2--s" onclick="openTab(event, 'Delivery')" id="defaultOpen"><strong>Доставка и оплата</strong></button>
    <button class="tablinks x1d4 x1d2--s" onclick="openTab(event, 'Schedule')"><strong>Наши преимущества</strong></button>
    <button class="tablinks x1d4 x1d2--s" onclick="openTab(event, 'Contacts')"><strong>Адрес и контакты</strong></button>
</div>

<div id="Information" class="tabcontent" style="text-align: center">
    <?
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
    }
    ?>

</div>

<div id="Delivery" class="tabcontent" style="display: none;">
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
                        <p>Осуществляем доставкупо Санкт-Петербургу и Ленинградской области в течении рабочего дня. Заберем Ваш груз и отвезеем (например, сопроводительные документы). Сдадим Ваш груз в транспортную компанию.</p><br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col x1d2 x1d1--md x1d1--s map-delivery">
        <?/*$APPLICATION->IncludeComponent(
                "bitrix:map.yandex.view",
                ".default",
                array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "INIT_MAP_TYPE" => "MAP",
                    "MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:57.846053522511795;s:10:\"yandex_lon\";d:33.154823446523984;s:12:\"yandex_scale\";i:5;s:10:\"PLACEMARKS\";a:2:{i:0;a:3:{s:3:\"LON\";d:37.739707365714;s:3:\"LAT\";d:55.74160002659;s:4:\"TEXT\";s:431:\"Офис и склад «Трайв-Комплект» в Москве###RN###Телефон: +7 (495) 374-82-70###RN###Электронная почта: info@traiv-komplekt.ru###RN###Адрес: 109202, Москва, ул. 1-я Фрезерная д.2/1 стр 1 ИТКОЛ-сервеинг###RN###Режим работы: Понедельник-Пятница: 9:00-17:30, Суббота-Воскресенье: Выходной\";}i:1;a:3:{s:3:\"LON\";d:30.50289614238;s:3:\"LAT\";d:59.899308710207;s:4:\"TEXT\";s:531:\"Главный офис и склад «Трайв-Комплект» в Санкт-Петербурге###RN###Телефон: +7 (812) 313-22-80 (Многоканальный), +7 (921) 931-79-32###RN###Электронная почта: info@traiv-komplekt.ru###RN###Адрес (офис и склад): Санкт-Петербург, Кудрово, ул.Центральная, дом 41###RN###Режим работы: Понедельник-Пятница: 8:00-17:30, Суббота-Воскресенье: Выходной\";}}}",
                    "MAP_WIDTH" => "AUTO",
                    "MAP_HEIGHT" => "400",
                    "CONTROLS" => array(
                        0 => "ZOOM",
                        1 => "TYPECONTROL",
                        2 => "SCALELINE",
                    ),
                    "OPTIONS" => array(
                        0 => "ENABLE_SCROLL_ZOOM",
                        1 => "ENABLE_DBLCLICK_ZOOM",
                        2 => "ENABLE_DRAGGING",
                    ),
                    "MAP_ID" => "",
                    "API_KEY" => ""
                ),
                false
            );*/?>
        <!--<p style="text-align: center; margin-top: 0"><strong>Калькулятор стоимости доставки</strong></p>
        <div class="dl-calc">
            <iframe
                    src="https://widgets.dellin.ru/calculator/?derival_to_door=off&arrival_to_door=off&disabled_calculation=on&insurance=0&package=1"
                    width="333"
                    height="390"
                    scrolling="no"
                    frameborder="0">
            </iframe>
        </div>-->
    </div>
</div>
<div id="Schedule" class="tabcontent" style="display: none; text-align: center">
    <img src="/images/advantages-01.png" style="width: 66%">

</div>

<div id="Contacts" class="tabcontent" style="display: none;">
    <div itemscope="" itemtype="http://schema.org/Organization">
 <span itemprop="name">
				<h2><a href="/contacts/sankt-peterburg/"><i class="fa fa-street-view"></i>Главный офис и склад «Трайв-Комплект» в Санкт-Петербурге</a></h2>
 </span>
        <table style="width: 100%">
            <tbody>
            <tr>
                <td style="text-align: center; width:20%; border:none">
                    <a href="/contacts/sankt-peterburg/"><img src="/images/articles/office_traiv_komplekt2.jpg" style="width: 200px;"></a>
                </td>
                <td style="border:none">
                    <ul class="contacts_ul">
                        <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
                            <li>Телефон: <span style="font-weight:bold;color:#d82411"><span itemprop="telephone">+7 (812) 313-22-80</span> (Многоканальный), +7 (921) 931-79-32</span></li>
                            <li>Электронная почта: <span itemprop="email"><a href="mailto:info@traiv-komplekt.ru">info@traiv-komplekt.ru</a></span></li>
                            <li><a href="mailto:director@traiv.ru">Письмо директору</a></li>
                            <li>Почтовый адрес (для отправки писем): <a href="#"><span itemprop="postalCode">193168</span>, <span itemprop="addressLocality">г.Санкт-Петербург</span>, а/я 83</a></li>
                            <li>Адрес (офис и склад): <a href="/contacts/sankt-peterburg/">Санкт-Петербург, <span itemprop="streetAddress">Кудрово, ул.Центральная, дом 41</span></a></li>
                            <li>Режим работы: Понедельник-Пятница: 8:00-17:30, Суббота-Воскресенье: Выходной</li>
                            <li><a href="/contacts/sankt-peterburg/">Подробнее...</a></li>
                        </div>
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
        <hr>
        <span itemprop="name">
				<h2><a href="/contacts/moskva/"><i class="fa fa-street-view"></i>Офис и склад «Трайв-Комплект» в Москве</a></h2>
 </span>
        <table style="width: 100%">
            <tbody>
            <tr>
                <td style="text-align: center; width:20%; border:none">
                    <a href="/contacts/moskva/"><img src="/images/articles/kartmsk.png" style="width: 200px;"></a>
                </td>
                <td style="border:none">
                    <ul class="contacts_ul">
                        <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
                            <li>Телефон: <span style="font-weight:bold;color:#d82411"><span itemprop="telephone">+7 (495) 374-82-70</span></span></li>
                            <li>Электронная почта: <span itemprop="email"><a href="mailto:info@traiv-komplekt.ru">info@traiv-komplekt.ru</a></span></li>
                            <li><a href="mailto:director@traiv.ru">Письмо директору</a></li>
                            <li>Адрес: <a href="/contacts/moskva/"><span itemprop="postalCode">109202</span>, <span itemprop="addressLocality">Москва</span>, <span itemprop="streetAddress">ул. 1-я Фрезерная д.2/1 стр 1 ИТКОЛ-сервеинг</span></a></li>
                            <li>Режим работы: Понедельник-Пятница: 9:00-17:30, Суббота-Воскресенье: Выходной</li>
                            <li><a href="/contacts/moskva/">Подробнее...</a></li>
                        </div>
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
        <hr>
        <span itemprop="name">
				<h2><a href="/contacts/moskva/"></a><a href="/contacts/ekaterinburg/"><i class="fa fa-street-view"></i>Филиал «Трайв-Комплект» в Екатеринбурге</a></h2>
 </span>
        <table style="width: 100%">
            <tbody>
            <tr>
                <td style="text-align: center; width:20%; border:none">
                    <a href="/contacts/ekaterinburg/"><img src="/images/articles/kartekb.png" style="width: 200px;"></a>
                </td>
                <td style="border:none">
                    <ul class="contacts_ul">
                        <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
                            <li>Телефон: <span style="font-weight:bold;color:#d82411"><span itemprop="telephone">+7 (343) 288-79-40</span></span></li>
                            <li>Электронная почта: <span itemprop="email"><a href="mailto:info@traiv-komplekt.ru">info@traiv-komplekt.ru</a></span></li>
                            <li><a href="mailto:director@traiv.ru">Письмо директору</a></li>
                            <li>Адрес: <a href="/contacts/ekaterinburg/"><span itemprop="postalCode">620024</span>, <span itemprop="addressLocality">Екатеринбург</span>, <span itemprop="streetAddress">Елизаветинское шоссе, 39</span></a></li>
                            <li>Режим работы: Понедельник-Пятница: 11:00-19:30, Суббота-Воскресенье: Выходной</li>
                            <li><a href="/contacts/ekaterinburg/">Подробнее...</a></li>
                        </div>
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

</div>
<div style="display: none;">
<?$APPLICATION->IncludeComponent(
    "coffeediz:schema.org.Product",
    ".default",
    array(
        "AGGREGATEOFFER" => "N",
        "DESCRIPTION" => $legtest != 'n' ? $legtest : $formatedname,
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

    <!--</div> closing in component epilog -->




