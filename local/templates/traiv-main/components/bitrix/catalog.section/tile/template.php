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

 ?><pre><?//print_r ($arResult)?></pre><?

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

            $rsElement = CIBlockElement::GetList(array(), array('ID' => $item['ID']), false, false, array('ID', 'IBLOCK_SECTION_ID'));
            if($arElement = $rsElement->Fetch())


            $rsElement = CIBlockSection::GetList(array(), array('ID' => $arElement['IBLOCK_SECTION_ID']), false, array('ID', 'IBLOCK_SECTION_ID', 'PICTURE'));
            if($arElement = $rsElement->Fetch())

            $picturl = CFile::GetPath($arElement['PICTURE']);


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


            ?><li class="col x1d5 x1d4--md x1d2--s x2--xs" id='<?= $strMainID ?>'>
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
                <?
                $picdetail=CFile::GetPath($item['DETAIL_PAGE']['SRC']);

                ?>
                <div class="catalog-item__image">
                    <a href="<?= $item['DETAIL_PAGE_URL'] ?>" id="img_<?=$item["ID"]?>">
                        <img
                                src="<?= $picturl?>" alt="<?=$arResult['NAME']?>" title="<?=$arResult['NAME']?>" class="adaptive zoom-image"
                                alt="<?= $item['NAME'] ?>"
                                id="<?=$item["ID"]?>">
                    </a>
                </div>
                <h4 class="catalog-item__title" >
                    <a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= $formatedname ?></a>
                </h4>
                <div class="footer-row">
                    <div class="catalog-item__footer">
                        <div class="item-bottom-line">
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
                            <!--     <div class="catalog-item__hidden">   -->
                            <?php if($item['CAN_BUY']): ?>
                                <a href="<?= $item['~ADD_URL'] ?>" class="btn-item-list" data-ajax-order><?= $item['RES_MOD']['buttonLabel'] ?></a>
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
            </div>
            </li>
        <? endforeach; ?>
        <!--RestartBuffer-->
    </ul>
   
    <? if (($arParams["DISPLAY_BOTTOM_PAGER"]) and count($arResult['ITEMS'])): ?>
  
            <? echo $arResult["NAV_STRING"]; ?>
    <? endif ?>
    <?
}


