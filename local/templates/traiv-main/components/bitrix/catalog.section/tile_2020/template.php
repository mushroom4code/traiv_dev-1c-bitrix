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



if($arParams['CUSTOM_COUNT_SUBSECTIONS'] == 0){
    $this->setFrameMode(true);
    ?>
    <ul class="row container-ajax-content">
        <!--RestartBuffer-->
        <? foreach ($arResult['ITEMS'] as $item):
            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], $strElementEdit);
            $this->AddDeleteAction(
                $item['ID'],
                $item['DELETE_LINK'],
                $strElementDelete,
                $arElementDeleteParams);

            $rsElement = CIBlockElement::GetList(array(), array('ID' => $item['ID']), false, false, array('ID', 'IBLOCK_SECTION_ID', 'DETAIL_PICTURE'));
            if($arElement = $rsElement->Fetch())


            $rsElement = CIBlockSection::GetList(array(), array('ID' => $arElement['IBLOCK_SECTION_ID']), false, array('ID', 'IBLOCK_SECTION_ID', 'PICTURE'));
            if($arElement = $rsElement->Fetch())


            $picturl = CFile::GetPath($arElement['DETAIL_PICTURE'] ? $arElement['DETAIL_PICTURE'] : $arElement['PICTURE']);


            $origname = $item['NAME'];
            $formated1name = preg_replace("/\([^)]+(шт.\)|шт\))/","",$origname);
            $formated2name = preg_replace("/КИТАЙ/","",$formated1name);
            $formated3name = preg_replace("/Конт/","",$formated2name);
            $formated4name = preg_replace("/Китай/","",$formated3name);
            $formated5name = preg_replace("/Россия/","",$formated4name);
            $formated6name = preg_replace("/Европа/","",$formated5name);
            $formatedname = preg_replace("/PU=S|PU=K|RU=S|RU=K|PU=К/","",$formated6name);


            $standart = $item['PROPERTIES']['STANDART']['VALUE'];
            $diametr = $item['PROPERTIES']['DIAMETR_1']['VALUE'];
            $dlina = $item['PROPERTIES']['DLINA_1']['VALUE'];
            $material = $item['PROPERTIES']['MATERIAL_1']['VALUE'];
            $pokrytie = $item['PROPERTIES']['POKRYTIE_1']['VALUE'];


            ?><div class="col x1d5 x1d3--md x1d2--s x1--xs" id='<?= $strMainID ?>'>
            <div class="new-item">
                <?if ($item['PROPERTIES']['ACTION']['VALUE']){?>

                    <div class="bx_stick average left top" title="Распродажа"></div>

                <?}?>
                <a href="<?= $item['DETAIL_PAGE_URL'] ?>">

                    <div class="new-item__header-properties">
                        <?

                        if (!empty($standart)) echo 'Стандарт: '.$standart.'<br>';
                        if (!empty($diametr) & !empty ($dlina)) {echo 'Размер: '.'<div class = "otho" style="display: inline-block">'.'&#8960; '. '</div>  '  .$diametr.' x '. $dlina.'<br>' ;}
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

                    <div class="new-item__image" id="img_<?=$item["ID"]?>"> <!--  catalog-item__image class for fix animation  -->

                        <?//*Вывод изображения стандарт**///?>
                        <?if (!empty($picturl)):?>
                            <img
                                src="<?= $picturl //? $item['DETAIL_PICTURE']['SRC'] : '/images/no_image.png') ?>"
                                alt="<?= $item['NAME'] ?>" id="<?=$item["ID"]?>">
                        <?else :?>

                            <?//*Вывод изображения из каталога**///?>
                            <img src="<?=$arResult['LIST_PICT']['SRC']?>" alt="<?=$item['NAME']?>" title="<?=$item['NAME']?>" id="<?=$item["ID"]?>">
                        <? endif ?>

                    </div>
                    <div class="new-item__title" >
                        <?= $formatedname ?>
                    </div>
                </a>
                <div class="new-item__footer">



                    <div class="new-item__price">Цена: <?= $item["PRICES"]["BASE"]["VALUE"] == 0 ? 'запросить' : $item["PRICES"]["BASE"]["VALUE"] . ' ' . 'р.' /* $arPrice["CURRENCY"];*/ ?></div>

                    <? if ($item['PROPERTIES']['standarts']['VALUE']): ?>

                        Аналог:
                        <ul class="similar">
                            <? foreach ($item['PROPERTIES']['standarts']['VALUE'] as $standart): ?>
                                <li class="similar__item"><?= $standart ?></li>
                            <? endforeach; ?>
                        </ul>

                    <? endif ?>
                    <!--     <div class="catalog-item__hidden">   -->
                    <?php if($item['CAN_BUY']): ?>
                        <a href="<?= $item['~ADD_URL'] ?>" class="new-item__buy-btn" data-ajax-order><?= $item['RES_MOD']['buttonLabel'] ?></a>
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
                    <!--       </div>     -->



                </div>
            </div>
            </div>
        <? endforeach; ?>
        <!--RestartBuffer-->
    </ul>
   
    <? if (($arParams["DISPLAY_BOTTOM_PAGER"]) and count($arResult['ITEMS'])): ?>
  
            <? echo $arResult["NAV_STRING"]; ?>
    <? endif ?>
    <?
}


