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

//Вывод сертификата


$rsResult = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 18, "ID" =>$arResult["ID"]), false, Array("UF_SERTIFICAT")); $temp_array = $rsResult->GetNext();


 ?><div class="sertimg"><?
foreach($temp_array["UF_SERTIFICAT"] as $what):?>
                            <?$SERT=CFile::GetFileArray($what); ?>


     <a href="<?echo ($SERT["SRC"]);?>" title="<?$strKb = $SERT['FILE_SIZE']/1024; echo round($strKb).' Кб';?>">
    <?$f=$SERT['SRC'];$p=pathinfo($f);$pdf=array($p['extension']);if(in_array('pdf',$pdf)):?><tr><td><img src="/images/gost/pdf.png" width="24px" ><?echo $SERT['ORIGINAL_NAME'];?></td></tr><?else:?><?endif;?>
    <?$f=$SERT['SRC'];$p=pathinfo($f);$doc=array($p['extension']);if(in_array('doc',$doc)):?><tr><td><img src="/images/gost/doc.png" width="24px" ><?echo $SERT['ORIGINAL_NAME'];?></td></tr><?else:?><?endif;?></a>
    <br>
                            <?endforeach?>

 </div>
<?



//Вывод рекомендованных категорий

$db_list = CIBlockSection::GetList(Array(), $arFilter = Array("IBLOCK_ID"=>18, "ID"=>$arResult["ID"]), true, Array("UF_RECOMEND")); $props_array = $db_list->GetNext();


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
    <ul class="row">
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
                            <div class="catalog-item">
                                <div class="catalog-item__image">
                        <img src="<?= $arFileRecTmpn['src']?>" class="recomend-img-art" alt="<?= $arSections['NAME'] ?>" title="<?= $arSections['NAME'] ?>">
                                    <div class="catalog-item__footer" >
                        <h4><a href="<?= $arSections['SECTION_PAGE_URL'] ?>"><?= $arSections['NAME'] ?>  </a></h4>
                                    </div>
                                </div>
                            </div>
                        </li>

                <?
            }
            ?>
    </ul>
    <p>Обозначение "Аналог товара" - не является на 100% гарантией, что аналог будет точной копией исходного изделия (по техническим параметрам, по цветовой палитре и т.д.).
        Для избежания ошибок, рекомендуем Вам проконсультироваться с <a data-fancybox="" data-src="#dialog-request" href="javascript:;" >нашими специалистами.</a></p>
        <br>
        Информация, представленная на сайте носит справочных характер, и не является публичной офертой.</p>
    <?
}
?>



<?if($arParams['CUSTOM_COUNT_SUBSECTIONS'] == 0){

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


            ?><li class="col x1d4 x1d4--md x1d2--s x1--xs" id='<?= $strMainID ?>'>
            <div class="catalog-item">
                <div class="catalog-item__header">
                    <h4 class="catalog-item__title">
                        <a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= $item['NAME'] ?></a>
                    </h4>
                    <!--div class="catalog-item__state"><?=$item['RES_MOD']['label']?></div-->
                </div>
                <div class="catalog-item__image">
                    <a href="<?= $item['DETAIL_PAGE_URL'] ?>">
							<?//*Вывод изображения стандарт**///?>
					<?/*if ($item['DETAIL_PICTURE']['SRC']):?>
					 <img
                        src="<?= (!empty($item['DETAIL_PICTURE']['SRC']) ? $item['DETAIL_PICTURE']['SRC'] : '/images/no_image.png') ?>"
                     alt="<?= $item['NAME'] ?>">

					<?//*Вывод изображения из каталога**///?>
                       <img src="<?=$item['DETAIL_PICTURE']['SRC']?>" alt="<?=$item['NAME']?>" title="<?=$item['NAME']?>">
                    </a>
                </div>
                <div class="catalog-item__footer">
                    <div class="u-pull-left">
                        <span>Цена: </span>
                        <span class="catalog-item__price_">
                          <? if ($item['RES_MOD']['discontPrice'] < $item['RES_MOD']['originalPrice']): ?>
                              <span class="dashed"><?= $item['RES_MOD']['BASE_PRICE']['PRINT_VALUE'] ?></span>
                          <? endif ?>
                            <span><?= $item['RES_MOD']['printPriceValue'] ?></span>
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
                </div>
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
            </li><?
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



