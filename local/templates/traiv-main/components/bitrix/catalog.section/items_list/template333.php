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
                       <img src="<?=$arResult['LIST_PICT']['SRC']?>" alt="<?=$item['NAME']?>" title="<?=$item['NAME']?>">
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
}


