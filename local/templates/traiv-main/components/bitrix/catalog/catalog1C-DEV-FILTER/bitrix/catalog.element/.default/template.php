 <?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

$BASE_PRICE = $arResult['PRICES']['BASE'];

$originalPrice = intval($BASE_PRICE['VALUE']);
$discontPrice = intval($BASE_PRICE['DISCOUNT_VALUE']);

$printPrice = $originalPrice <= $discontPrice ? 
	$BASE_PRICE['PRINT_VALUE'] 
	: $BASE_PRICE['PRINT_DISCOUNT_VALUE'];

 $arResult['~ADD_URL'] .= '&QUANTITY=';
 //echo $arResult['~ADD_URL'];


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

?>

 <?

 $origname = $arResult['NAME'];
 $formated1name = preg_replace("/\([^)]+(шт.\)|шт\))/","",$origname);
 $formated2name = preg_replace("/КИТАЙ/","",$formated1name);
 $formated3name = preg_replace("/КАНТ/","",$formated2name);
 $formated4name = preg_replace("/Китай/","",$formated3name);
 $formated5name = preg_replace("/Россия/","",$formated4name);
 $formated6name = preg_replace("/Европа/","",$formated5name);
 $formatedname = preg_replace("/PU=S|PU=K|RU=S|RU=K|PU=К/","",$formated6name);

 $pack = $arResult["PROPERTIES"]["KRATNOST_UPAKOVKI_DLYA_SAYTA"]["VALUE"];

if (!empty($arResult["PROPERTIES"]["CHECKBOX"]["VALUE"]) & ($arResult["PROPERTIES"]["CHECKBOX"]["VALUE"] != 'Нет')):
?><pre><?print_r($arResult["PROPERTIES"]["CHECKBOX"])?></pre><?
endif;


IF (!empty($pack)) {


            $db_measure = CCatalogMeasureRatio::getList(array(), $arFilter = array('PRODUCT_ID' => $arResult["ID"]), false, false);  // получим единицу измерения только что созданного товара

            $ar_measure = $db_measure->fetch();

        $ar_measure = CCatalogMeasureRatio::update($ar_measure['ID'], array("PRODUCT_ID" => $arResult["ID"], "RATIO" => $pack));

}else {$pack = 1;}

?>

<div class="island">
	<p class="product__title"><?=$formatedname?></p>
    <h4 id="itemid">ID: <?=$arResult['ID']?></h4>
	<div class="row">
		<div class="col x3d4 x1d1--t">
			<div class="product-specs">
				<div class="row">
					<div class="col x1d4 x1d1--m">
 <?


?>

						<div class="product__image" >
                            <div id="main-image" class="product-image">
						<?//*Вывод изображения стандарт**///?>		
			<?If (!empty($arResult['DETAIL_PICTURE']['SRC'])) :

                $img = $arResult['DETAIL_PICTURE'];
                $imgurl=$arResult['DETAIL_PICTURE']['SRC'];

                ?>
                              <img src="<?=$imgurl //? $arResult['DETAIL_PICTURE']['SRC'] : '/images/no_image.png')?>"
                                alt="<?=$arResult['NAME']?>" class="adaptive zoom-image" id="<?=$arResult["ID"]?>"><??>
				
		    <? else : ?>
<?//*Вывод изображения из каталога**///?>

               <?
                $img = $arResult['SECTION']['PICTURE'];
                $imgurl=CFile::GetPath($arResult['SECTION']['PICTURE']);
               ?>

								<img src="<?=$imgurl?>" alt="<?=$arResult['NAME']?>" title="<?=$arResult['NAME']?>" class="adaptive zoom-image" id="<?=$arResult["ID"]?>">

            <? endif ; ?>

                            </div>

                        <? //Дополнительные фото товара (галерея)?>

                        <? if(!empty($arResult['MORE_PHOTO'])):?>
                        <div class="product-gallery">

                            <? $thumborig  = CFile::ResizeImageGet($img, Array("width" => 80, "height" => 80) );

                            ;?>

                            <a class="gallery-image first" href="<?=$imgurl?>">
                                <img src="<?=$thumborig['src']?>">
                            </a>

                            <? foreach($arResult['MORE_PHOTO'] as $imgGal):?>

                            <? $thumb  = CFile::ResizeImageGet($imgGal, Array("width" => 80, "height" => 80) );?>

                            <a class="gallery-image" href="<? echo $imgGal['SRC']?>"><img src="<? echo $thumb['src']?>"></a>

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
                                 <?$f=$SERTFILE['SRC'];$p=pathinfo($f);$pdf=array($p['extension']);if(in_array('pdf',$pdf)):?><tr><td><img src="/images/gost/pdf.png" width="24px" >Скачать сертификат <?echo $SERTFILE['ORIGINAL_NAME'];?></td></tr><?else:?><?endif;?>
                                 <?$f=$SERTFILE['SRC'];$p=pathinfo($f);$doc=array($p['extension']);if(in_array('doc',$doc)):?><tr><td><img src="/images/gost/doc.png" width="24px" >Скачать сертификат <?echo $SERTFILE['ORIGINAL_NAME'];?></td></tr><?else:?><?endif;?> </a>
<br>


                          <?

                            endforeach;
                             ?></div><?
                        }
?>

 <br>

<pre><?//print_r($arResult["PROPERTIES"]["UPAKOVKA_VINTI"]["VALUE"])?></pre>


<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,gplus,twitter,viber,whatsapp,skype,telegram" data-size="s"></div>

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
					</div>
					<div class="col x1d2 x2d3--m x1--s">
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
                                    <dt>Вес:</dt><dd><?=$arResult['CATALOG_WEIGHT']?></dd>
                            </dl>
                                <?}?>


							<?php } ?>
						</div>
					</div>
					<div class="col x1d4 x1d3--m x1--s">
						<h4 class="md-title" id="test8">Цена за шт:</h4>
                        <?php if($printPrice !== '0 руб.'){?>
                            <div class="price">
                                <span class="price__units"><?=$printPrice?></span>
                            </div>
                        <?php }elseif ($printPrice == '0 руб.'){?>
                            <div class="u-offset-bottom-15"><h2>по запросу</h2>

                            </div>
                        <?}?>

<p>Введите колличество:</p>
                      <!--  <form method="get" action="<?//= $arResult['DETAIL_PAGE_URL'] ?>" > -->
                      <!--  <input type="text" value="ADD2BASKET" name="action" hidden/> -->
                      <!--  <input type="text" value="<?//=$arResult["ID"]?>" name="id" hidden> -->
                            <input type='number' name='QUANTITY'  size="10" value='<?=$pack?>' step="<?=$pack?>" id="QUANTITY">

                        <p class="pack_notice" ><span align="center" style="font-size: 1.8em; color: red;">!</span> Внимание: продажа осуществляется кратно упаковкам.</p>

                        <p><a href="<?= $arResult['~ADD_URL'] ?>" style="cursor:pointer;display: inline;" rel="nofollow" class="btn" id="buy" data-ajax-order-detail><?= $buttonLabel ?></a></p>
                    <!--    </form>  -->

                        <pre><?//print_r ($arResult);?></pre>


                    <!--    <div class="u-offset-bottom-15 u-align-center">
                            <p><a href="<?//= $arResult['~ADD_URL'] ?>" style="cursor:pointer;display: inline;" rel="nofollow" class="btn" id="buy" data-ajax-order><?//= $buttonLabel ?></a></p>
                        </div> -->
                        <?php if($printPrice !== '0 руб.'){?>
                            <div class="u-align-left u-offset-bottom-15">
                                <a href="#callback-form" rel="nofollow" class="btn-mfp-dialog">Купить дешевле</a>
                                                        <div id='callback-form' class="popup-dialog mfp-hide">
							<?$APPLICATION->IncludeComponent(
							  "bitrix:form.result.new", "one_click_buy", Array(
							  "COMPONENT_TEMPLATE" => ".default",
							  "ELEMENT_ID" => $arResult['ID'],
							    "WEB_FORM_ID" => "2", // ID веб-формы
							    "IGNORE_CUSTOM_TEMPLATE" => "N",  // Игнорировать свой шаблон
							    "USE_EXTENDED_ERRORS" => "Y", // Использовать расширенный вывод сообщений об ошибках
							    "SEF_MODE" => "N",  // Включить поддержку ЧПУ
							    "CACHE_TYPE" => "A",  // Тип кеширования
							    "CACHE_TIME" => "3600", // Время кеширования (сек.)
							    "LIST_URL" => "/ajax/forms/one_click_saved.php",  // Страница со списком результатов
							    "EDIT_URL" => "/ajax/forms/one_click_saved.php",  // Страница редактирования результата
							    "SUCCESS_URL" => "/ajax/forms/one_click_saved.php",  // Страница с сообщением об успешной отправке
							    "CHAIN_ITEM_TEXT" => "",  // Название дополнительного пункта в навигационной цепочке
							    "CHAIN_ITEM_LINK" => "",  // Ссылка на дополнительном пункте в навигационной цепочке
							    "VARIABLE_ALIASES" => array(
							      "WEB_FORM_ID" => "WEB_FORM_ID",
							      "RESULT_ID" => "RESULT_ID",
							    )
							  ),
							  false
							);?>
                                                        </div>
							<script defer src='<?=SITE_TEMPLATE_PATH."/js/one_click_form.js"?>'></script>
                                <?
/*
                                $APPLICATION->IncludeComponent("DM:present-banner", ".default", array(
                                    "IBLOCK_ID" => 18
                                ),
                                    false);
*/
                                ?>
						</div>

                        <?php } ?>
                            <!--div class="u-align-center u-offset-bottom-15">
                                <?= $arResult['PRODUCT']['QUANTITY'] > 0 ?
                                    'В наличии' :
                                    'Нет в наличии' ?>
                            </div-->
					</div>

				</div>

			</div>


            <?php // if($arResult['RES_MOD']['FILTER_AVAILABLE']) {?>
                <div class="catalog-filter-tuning">
                    <?/*
                    $APPLICATION->IncludeComponent(
	"bitrix:catalog.smart.filter", 
	"filter_tuning2", 
	array(
		"COMPONENT_TEMPLATE" => "filter_tuning2",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "18",
		"SECTION_ID" => "",
		"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"TEMPLATE_THEME" => "blue",
		"DISPLAY_ELEMENT_COUNT" => "Y",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SAVE_IN_SESSION" => "N",
		"PAGER_PARAMS_NAME" => "arrPager",
		"PRICE_CODE" => array(
		),
		"CONVERT_CURRENCY" => "N",
		"XML_EXPORT" => "N",
		"SECTION_TITLE" => "-",
		"SECTION_DESCRIPTION" => "-",
		"SEARCH_PROPERTIES" => $arResult["RES_MOD"]["SEARCH_PROPERTIES"],
		"PREFILTER_NAME" => "smartPreFilter"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
); */?>
                </div>
            <?php// } ?>

		<div><?=$arResult["DETAIL_TEXT"]?></div>
		</div>
		<div class="col x1d4 x0d1--t">
			<ul class="advantages">
				<li class="advantages__item">
					<div class="sprite-icon sprite-icon--thumbup"></div>
					Высокий профессионализм<br>сотрудников компании
				</li>
				<li class="advantages__item">
					<div class="sprite-icon sprite-icon--car"></div>
					Бесплатная доставка<br>по Санкт-Петербургу <br>при заказе от 10000 рублей!
				</li>
				<li class="advantages__item">
					<div class="sprite-icon sprite-icon--traiv"></div>
					Постоянный контроль<br>качества поступающих на склад<br>крепежных изделий
				</li>
			</ul>

		</div>
	</div>
                <div id="result-tuning">
            <h3 class="md-title">То, что вы искали:</h3>
            <ul class="row"></ul>
                
        </div>
<h2>Сопутствующие товары</h2>
    <?php
    $APPLICATION->IncludeComponent(
        "DM:recomended-items",
        ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "IBLOCK_ID" => "18",
            "PRESENT_ID" => $arResult["ID"],
            "ENGINE" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600"
        ),
        false,
        array(
            "ENGINE" => "Y"
        )
    );


    ?>

</div>



 <?//show counter with session refresh
 session_start();
 if (!isset($_SESSION['counter'])) $_SESSION['counter'] = 0;

 $res = CIBlockElement::GetByID($arResult["ID"]);
 if($ar_res = $res->GetNext())
     $ar_res_hundred = $ar_res['SHOW_COUNTER'] + 100 + $_SESSION['counter']++;
     echo 'Просмотров: '.$ar_res_hundred;


 CModule::IncludeModule("iblock");
     if(CModule::IncludeModule("iblock")) {
     CIBlockElement::CounterInc($arResult["ID"]);
 }

 echo '<br>Дата первого показа: '.$ar_res['SHOW_COUNTER_START'];
 ?>



<!--
<div class="island">
	<div class="tabs">
		<ul class="tabs-nav">
			<li class="tabs-nav__item is-active"><a href="#tab-1" class="tabs-nav__link"><?=$arResult["PROPERTIES"]["TECH_DESCR"]["NAME"]?></a></li>
			<li class="tabs-nav__item"><a href="#tab-2" class="tabs-nav__link">Способ использования</a></li>
			<li class="tabs-nav__item"><a href="#tab-3" class="tabs-nav__link"><?=$arResult["PROPERTIES"]["PRICE_DESCR"]["NAME"]?></a></li>
			<li class="tabs-nav__item"><a href="#tab-4" class="tabs-nav__link">Доставка</a></li>
			<li class="tabs-nav__item"><a href="#tab-5" class="tabs-nav__link">Отзывы</a></li>
		</ul>
		<div class="panes">
			<div id="tab-1" class="pane is-visible">
				<a href="#" class="pane-toggle"><?=$arResult["PROPERTIES"]["TECH_DESCR"]["NAME"]?></a>

				<div class="pane__inner">
					<div class="row">

						<?/*
						<div class="col x1d5 x1d4--t x1d3--m u-none--s">
							<div class="u-bordered">
								<img src="http://anker.svmspb.ru/media/stroy_catalog/product/images/336.d2d4645dbcdc.jpg" alt="" class="responsive">
							</div>
						</div>
						<div class="col x4d5 x3d4--t x2d3--m x1d1--s">
						</div>
						*/?>
						<div class="col x1">
							<?=htmlspecialchars_decode($arResult["PROPERTIES"]["TECH_DESCR"]["VALUE"]["TEXT"])?>
						</div>
					</div>
				</div>
			</div>
			<div id="tab-2" class="pane">
				<a href="#" class="pane-toggle">Способ использования</a>
				<div class="pane__inner">
					<div class="row">
						<?/*
						<div class="col x1d5 x1d4--t x1d3--m u-none--s">
							<div class="u-bordered">
								<img src="http://anker.svmspb.ru/media/stroy_catalog/product/images/336.d2d4645dbcdc.jpg" alt="" class="responsive">
							</div>
						</div>
						<div class="col x4d5 x3d4--t x2d3--m x1d1--s">
							<h3 class="md-title">Технические характеристики DIN 933</h3>
							<p>Данный болт это отличный металлический крепеж, можно сказать, универсальный. Изготавливают из особо прочных металлов. Обычно применяют такие классы прочности, как 1.7709, 12,9, 10,9, 8.8, 5.6. Для производства болтов согласно ГОСТ используют стали марок А2, А5. Это нержавеющие стали, которые придают болту особую прочность и отличную антикоррозийную сопротивляемость.</p>
							<p>Если данный болт предназначен для крепежа узлов и деталей, которые будут работать в агрессивных средах, что осуществляется дополнительная обработка. Крепежное изделие покрывают защитными материалами при помощи нанесения на поверхность тонкого слоя цинка гальваническим или горячим способом. Возможна никелировка болта в гальванических ваннах. Применяется оцинковка термодиффузионная, а также по заказам производится хроматирование гальваническим методом.</p>
						</div>
						*/?>
					</div>
				</div>
			</div>
			<div id="tab-3" class="pane">
				<a href="#" class="pane-toggle"><?=$arResult["PROPERTIES"]["PRICE_DESCR"]["NAME"]?></a>
				<div class="pane__inner">
					<div class="row">
						<div class="col x1">
							<?=htmlspecialchars_decode($arResult["PROPERTIES"]["PRICE_DESCR"]["VALUE"]["TEXT"]) ?>
						</div>
					</div>
				</div>
			</div>
			<div id="tab-4" class="pane">
				<a href="#" class="pane-toggle">Доставка</a>
				<div class="pane__inner">
					<div class="row">
						<div class="col x1">
                            <p style="text-align: justify;">Компания "Трайв-Комплект" организует доставку DIN 933 болтов с шестигранной головкой (с полной резьбой) в Санкт-Петербурге, а так же по всем регионам России (Москва, Новосибирск, Екатеринбург, Нижний Новгород, Казань, Самара, Челябинск, Омск, Ростов-на-Дону, Уфа, Красноярск, Пермь, Волгоград, Воронеж и многие другие).</p>
                            <div style="width: 405px; float: left;">
                                <h3 style="text-align: center; color: #5B7696">Доставка по России</h3>
                                <img src="/local/include_pictures/rus.jpg" alt="Доставка метизов по всей России" style="margin: 5px 0 15px 0; box-shadow: 0 0 10px 5px rgba(221, 221, 221, 1); width:390px; margin-left:10px;"><p style="text-align: justify;"><b>Внимание! До транспортной компании, по Санкт-Петербургу, доставка бесплатная!</b></p>
                                <p style="text-align: justify;">С 1 июня 2014 стартует уникальная акция "Доверь доставку нам!"</p>
                                <p style="text-align: justify;">Мы будем рады организовать бесплатную межтерминальную доставку (от СПб до города получателя) товара при единовременной сумме покупки продукции от 50 000 руб.</p>
                                <p style="text-align: justify;">Доставка будет осуществляться транспортной компанией "Деловые линии". Будем стараться и дальше радовать Вас все более выгодными условиями работы. С уважением, коллектив "Трайв-Комплект".</p>
                                <p style="text-align: justify;">При сумме счета меньше 50 000 рублей стоимость доставки рассчитывается по тарифам транспортных компаний.</p>
                            </div>
                            <div style="width: 405px; float: right;">
                                <h3 style="text-align: center; color: #5B7696">Доставка по Санкт-Петербургу</h3>
                                <img src="/local/include_pictures/spb.jpg" alt="Доставка метизов по всей России" style="margin: 5px 0 15px 0; box-shadow: 0 0 10px 5px rgba(221, 221, 221, 1); width:390px; margin-left:5px;"><p style="text-align: justify;"><b>При единовременном заказе от 5000 рублей доставка – БЕСПЛАТНО!</b> Услуга "бесплатная доставка" распространяется на г. Санкт-Петербург в черте КАД.</p>
                                <p style="text-align: justify;">Доставка товара осуществляется в течении дня с 9:00 до 18:30. Заявки на доставку принимаются до 16-30 дню предшествующему доставке.</p>
                                <p style="text-align: justify;">Дни доставки продукции – уточняйте у наших менеджеров. Бланк на оформление доставки можно скачать <a href="http://traiv-komplekt.ru/price/blank_dostavki_spb.doc" title="Бланк на оформление доставки">здесь</a>.</p>
                                <p style="text-align: justify;">Платная доставка в пределах Санкт-Петербурга - 700 рублей. Стоимость доставки до ближайших пригородов:</p>
                                <ul>
                                    <li>г. Пушкин – 1200 руб.</li>
                                    <li>г. Павловск – 1200 руб.</li>
                                    <li>г. Гатчина – 2500 руб.</li>
                                    <li>г. Колпино – 1000 руб.</li>
                                    <li>г. Всеволожск – 1200 руб.</li>
                                </ul>
                            </div>
						</div>
					</div>
				</div>
			</div>

            <div id="tab-5" class="pane">
                <a href="#" class="pane-toggle">Отзывы</a>
                <div class="pane__inner">
                    <div class="row">
                        <div class="col x1">
-->

