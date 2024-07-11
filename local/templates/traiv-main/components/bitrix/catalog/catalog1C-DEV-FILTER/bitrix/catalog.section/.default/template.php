<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */


?><pre><?//print_r($arResult['ID'])?></pre><?


//Вывод сертификата


$rsResult = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 18, "ID" =>$arResult["ID"]), false, Array("UF_SERTIFICAT")); $temp_array = $rsResult->GetNext();


 ?><div class="sertimg"><?
foreach($temp_array["UF_SERTIFICAT"] as $what):?>
                            <?$SERT=CFile::GetFileArray($what); ?>


     <a href="<?echo ($SERT["SRC"]);?>" title="<?$strKb = $SERT['FILE_SIZE']/1024; echo round($strKb).' Кб';?>">
    <?$f=$SERT['SRC'];$p=pathinfo($f);$pdf=array($p['extension']);if(in_array('pdf',$pdf)):?><tr><td><img class="lazy" src="/images/gost/pdf.png" width="24px" ><?echo $SERT['ORIGINAL_NAME'];?></td></tr><?else:?><?endif;?>
    <?$f=$SERT['SRC'];$p=pathinfo($f);$doc=array($p['extension']);if(in_array('doc',$doc)):?><tr><td><img class="lazy" src="/images/gost/doc.png" width="24px" ><?echo $SERT['ORIGINAL_NAME'];?></td></tr><?else:?><?endif;?></a>
    <br>
                            <?endforeach?>

</div>
<?

$page_title = $APPLICATION->GetDirProperty("TITLE");
//echo 'Тайтл: '.$page_title;

//echo $arResult["ID"];
?>
<script>
$(window).on('load', function() {
    var counter;
var counter = <?=$arResult["ID"] ?>;

$.ajax({
    type: 'POST',
    url: "/local/templates/traiv-main/components/bitrix/catalog.section/items_list/counter.php",
    data: {
        counter:counter
    },
    success: function(){

    }

});

})

</script>
<?
//Вывод рекомендованных категорий

$db_list = CIBlockSection::GetList(Array(), $arFilter = Array("IBLOCK_ID"=>18, "ID"=>$arResult["ID"]), true, Array("UF_RECOMEND", "UF_CANONICAL", "UF_LONGTEXT")); $props_array = $db_list->GetNext();


if (!empty($props_array["UF_CANONICAL"])) {
    $arResult['UF_CANONICAL'] = $props_array["UF_CANONICAL"];

    echo $arResult['UF_CANONICAL'];

}


if($arParams['CUSTOM_COUNT_SUBSECTIONS'] == 0){

    $this->setFrameMode(true);
    if (($arParams["DISPLAY_BOTTOM_PAGER"]) and count($arResult['ITEMS'])): ?>
        <? echo $arResult["NAV_STRING"]; ?>
    <? endif ?>


<?
	$widthsizen="150";
	$heightsizen="150";

	$arFileTmpn = CFile::ResizeImageGet(
		$arResult['PICTURE'],
		array("width" => $widthsizen, "height" => $heightsizen),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true, $arFilter
	);

	$arResult['LIST_PICT'] = array(
		'SRC' => $arFileTmpn["src"],
		'WIDTH' => $arFileTmpn["width"],
		'HEIGHT' => $arFileTmpn["height"],
	);
?>

    <ul class="row">
        <? foreach ($arResult['ITEMS'] as $item):


         


            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], $strElementEdit);
            $this->AddDeleteAction(
                $item['ID'],
                $item['DELETE_LINK'],
                $strElementDelete,
                $arElementDeleteParams);


            $origname = $item["NAME"];
            $formated1name = preg_replace("/\([^)]+(шт.\)|шт\))/","",$origname);
            $formated2name = preg_replace("/КИТАЙ/","",$formated1name);
            $formated3name = preg_replace("/Конт/","",$formated2name);
            $formated4name = preg_replace("/Китай/","",$formated3name);
            $formated5name = preg_replace("/Россия/","",$formated4name);
            $formated6name = preg_replace("/Европа/","",$formated5name);
            $formatedname = preg_replace("/PU=S|PU=K|RU=S|RU=K|PU=К/","",$formated6name);


            $pack = $item['PROPERTIES']['UPAKOVKA_VINTI']['VALUE'];

            IF (!empty($pack)) {

            $db_measure = CCatalogMeasureRatio::getList(array(), $arFilter = array('PRODUCT_ID' => $item["ID"]), false, false);  // получим единицу измерения только что созданного товара

            $ar_measure = $db_measure->fetch();

            $ar_measure = CCatalogMeasureRatio::update($ar_measure['ID'], array("PRODUCT_ID" => $item["ID"], "RATIO" => $pack));

        }

            $standart = $item['PROPERTIES']['STANDART']['VALUE'];
            $diametr = $item['PROPERTIES']['DIAMETR_1']['VALUE'];
            $dlina = $item['PROPERTIES']['DLINA_1']['VALUE'];
            $material = $item['PROPERTIES']['MATERIAL_1']['VALUE'];
            $pokrytie = $item['PROPERTIES']['POKRYTIE_1']['VALUE'];


            ?><div class="col x1d4 x1d4--md x1d2--s x1--xs" id='<?= $strMainID ?>'>
            <div class="catalog-item">
                <div class="catalog-item__header">

                    <div class="item-header-properties">
                    <?

                   if (!empty($standart)) echo 'Стандарт: '.$standart.'<br>';
                    if (!empty($diametr) & !empty ($dlina)) {echo 'Размер: &#8960; '.$diametr.' x '. $dlina.'<br>' ;}
                    else
                    {
                        if (!empty($diametr)) echo 'Диаметр: '.$diametr.'<br>';
                        if (!empty($dlina)) echo 'Длина: '.$dlina.'<br>';
                        };
                    if (!empty($material)) echo 'Материал: '.$material.'<br>';
                    if (!empty($pokrytie)) echo 'Покрытие: '.$pokrytie.'<br>';


                    ?>
                </div>

                    <!--div class="catalog-item__state"><?=$item['RES_MOD']['label']?></div-->
                </div>
                <div class="catalog-item__image">
                    <a href="<?= $item['DETAIL_PAGE_URL'] ?>" id="img_<?=$item["ID"]?>">
							<?//*Вывод изображения стандарт**///?>		
					<?if (!empty($item['DETAIL_PICTURE']['SRC'])):?>
					 <img class="lazy"
                        src="<?= ($item['DETAIL_PICTURE']['SRC']) //? $item['DETAIL_PICTURE']['SRC'] : '/images/no_image.png') ?>"
                     alt="<?= $item['NAME'] ?>" id="<?=$item["ID"]?>">
                    <?else :?>
		
					<?//*Вывод изображения из каталога**///
                        $foo = CIBlockSection::GetList(array('NAME' => 'ASC'), array('IBLOCK_ID' => "18", 'ID' => $item["IBLOCK_SECTION_ID"]), false, false, Array("ID", "NAME", "DETAIL_PICTURE", "PICTURE"));
                        $bar = $foo -> GetNext();

                        $ImgUrl =$bar['DETAIL_PICTURE'];

                        $ResizedImg = CFile::ResizeImageGet($ImgUrl,array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);



                        ?>
                       <img class="lazy" src="<?=$ResizedImg['src']?>" alt="<?=$item['NAME']?>" title="<?=$item['NAME']?>" id="<?=$item["ID"]?>">
                    <?
                    endif ?>
                    </a>
                </div>
                <h4 class="catalog-item__title" >
                    <a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= $formatedname ?></a>
                </h4>
                <div class="footer-row">
           <!--     <div class="catalog-item__footer">  -->
                    <div class="u-pull-left">
                        <span>цена: </span>
                        <span class="catalog-item__price_">
                            <? If ($item['RES_MOD']['printPriceValue'] !== "0 руб."){
                           if ($item['RES_MOD']['discontPrice'] < $item['RES_MOD']['originalPrice']): ?>
                              <span class="dashed"><?= $item['RES_MOD']['BASE_PRICE']['PRINT_VALUE'] ?></span>

                          <? endif ?>

                            <span><?= $item['RES_MOD']['printPriceValue'] ?></span>

                            <?} else {echo "по запросу";};?>
                        </span>
                    </div>
                    <? if ($item['PROPERTIES']['standarts']['VALUE']): ?>
                        <div class="u-pull-right">
                            Аналог:
                            <ul class="similar">
                                <? foreach ($item['PROPERTIES']['standarts']['VALUE'] as $standart): ?>
                                    <li class="similar__item"><?= $standart ?></li>
                                <? endforeach; ?>
                            </ul>
                        </div>
                    <? endif ?>
              <!--  </div>  -->
                <div class="catalog-item__hidden">
                    <?php if($item['CAN_BUY']): ?>
                        <a href="<?= $item['~ADD_URL'] ?>" class="btn" data-ajax-order><?= $item['RES_MOD']['buttonLabel'] ?></a>
                    <? elseif(($arParams['PRODUCT_SUBSCRIPTION'] === 'Y') || ($item['CATALOG_SUBSCRIBE'] === 'Y')): ?>
          <?/*php
                        $APPLICATION->IncludeComponent(
                            'bitrix:catalog.product.subscribe',
                            '',
                            array(
                                'PRODUCT_ID' => $item['ID'],
                                'BUTTON_ID' => $item['SUBSCRIBE_URL'],
                                'BUTTON_CLASS' => 'btn',
                                'DEFAULT_DISPLAY' => !$item['CAN_BUY'],
                            ),
                            $component,
                            array('HIDE_ICONS' => 'Y')
                        );
                       */ ?>
                    <? endif ?>
                </div>
                </div>
            </div>
            </div><?
        endforeach; ?>
    </ul>



    <? if (($arParams["DISPLAY_BOTTOM_PAGER"]) and count($arResult['ITEMS'])): ?>
        <? if ($arResult["NAV_RESULT"]->nEndPage > 1):?>
            <div id="traiv-catalog-section-link-more">Показать ещё +</div>
        <? endif ?>
        <div class="bottom-nav">
            <? echo $arResult["NAV_STRING"]; ?>
        </div>
    <? endif ?>

    <?
}?>
<?
    if (!empty($props_array["UF_RECOMEND"])) {
    $rsSections = CIBlockSection::GetList(
    array("SORT" => "ASC"),
    array("IBLOCK_ID" => $IBLOCK_ID, "ACTIVE" => "Y", "ID" => $props_array["UF_RECOMEND"]),
    false,
    array("NAME", "DETAIL_PICTURE", "PICTURE", "SECTION_PAGE_URL"),
    false
    );

    ?>


    <h2 class="recomend-title">Аналоги:</h2>
    <ul class="recomended">
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



            <li class="col x1d4 x1d4--md x1d2--s x1--xs">
                <div class="catalog-item-rec">
                    <div class="catalog-item__image">
                        <img src="<?= $arFileRecTmpn['src']?>" class="recomend-img-art lazy" alt="<?= $arSections['NAME'] ?>" title="<?= $arSections['NAME'] ?>">
                    </div>
                    <div class="catalog-item__title" >
                        <h4><a href="<?= $arSections['SECTION_PAGE_URL'] ?>"><?= $arSections['NAME'] ?>  </a></h4>
                    </div>
                </div>
            </li>

            <?
        }
        ?>
    </ul>
    <p class="CopyWarning">Обозначение "Аналог товара" - не является на 100% гарантией, что аналог будет точной копией исходного изделия (по техническим параметрам, по цветовой палитре и т.д.).
        Для избежания ошибок, рекомендуем Вам проконсультироваться с <a data-fancybox="" data-src="#dialog-request" href="javascript:;" >нашими специалистами.</a></p>
    <br>
    Информация, представленная на сайте носит справочных характер, и не является публичной офертой.</p>
<?
}
?>

