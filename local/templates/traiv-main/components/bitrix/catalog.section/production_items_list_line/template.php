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
?><pre><?//print_r($arResult) ?></pre><?php
if(count($arResult['ITEMS'])){
?>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
	<? echo $arResult["NAV_STRING"]; ?>
<? endif ?>

<ul class="row traiv-catalog-line-default">
	<? foreach ($arResult['ITEMS'] as $item): ?>
        <?
        $itemPicture = $item['DETAIL_PICTURE'] ? $item['DETAIL_PICTURE'] : $item['PREVIEW_PICTURE'] ? $item['PREVIEW_PICTURE'] : $arResult['LIST_PICT'];

        $widthsizen="200";
        $heightsizen="200";

        $arFileTmpn = CFile::ResizeImageGet(
            $itemPicture,
            array("width" => $widthsizen, "height" => $heightsizen),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true, $arFilter
        );



        $itemPicture = array(
            'SRC' => $arFileTmpn["src"],
            'WIDTH' => $arFileTmpn["width"],
            'HEIGHT' => $arFileTmpn["height"],
        );
        ?>
		<?
		$this->AddEditAction($item['ID'], $item['EDIT_LINK'], $strElementEdit);
		$this->AddDeleteAction(
			$item['ID'],
			$item['DELETE_LINK'],
			$strElementDelete,
			$arElementDeleteParams);
		$strMainID = $this->GetEditAreaId($item['ID']);

        $origname = $item["NAME"];
        $formated1name = preg_replace("/\([^)]+(шт.\)|шт\))/","",$origname);
        $formated2name = preg_replace("/КИТАЙ/","",$formated1name);
        $formated3name = preg_replace("/КАНТ/","",$formated2name);
        $formated4name = preg_replace("/Китай/","",$formated3name);
        $formated5name = preg_replace("/Россия/","",$formated4name);
        $formated6name = preg_replace("/Европа/","",$formated5name);
        $formatedname = preg_replace("/PU=S|PU=K|RU=S|RU=K|PU=К/","",$formated6name);

		$BASE_PRICE = $item['PRICES']['BASE'];
		$originalPrice = intval($BASE_PRICE['VALUE']);
		$discontPrice = intval($BASE_PRICE['DISCOUNT_VALUE']);
		$printPriceValue = $originalPrice <= $discontPrice ?
			$BASE_PRICE['PRINT_VALUE']
			: $BASE_PRICE['PRINT_DISCOUNT_VALUE'];

        $printPriceValue = !empty($printPriceValue) ? $printPriceValue : 'по запросу';

        $label = '';
        $buttonLabel = 'В корзину';
        /*   if($item['CAN_BUY'] and $item['PRODUCT']['QUANTITY'] > 0) {
               $label = 'В наличии';
               $buttonLabel = 'Добавить';
           }elseif($item['CAN_BUY'] and ($item['PRODUCT']['QUANTITY'] == 0)){
               $label = 'Под заказ';
               $buttonLabel = 'Заказать';
           }elseif (!$item['CAN_BUY'] and ($item['PRODUCT']['QUANTITY'] == 0)){
               $label = 'Уведомить о появлении';
               $buttonLabel = 'Уведомить о появлении';
           }else{
               $label = 'Цена и наличие по запросу';
               $buttonLabel = 'Запросить';
           } */

		?>
		<li class="col x1 x1--t x1--s" id='<?= $strMainID ?>'>
			<div class="new-item-line">
				<div class="col x2d12 x1d2--s">
					<div class="new-item__image overflow-h">
					                  <a href="<?= $item['DETAIL_PAGE_URL'] ?>">
                       <img src="<?=$itemPicture['SRC']?>" alt="<?=$formatedname?>" title="<?=$formatedname?>">
                    </a>
					</div>
				</div>
				<div class="new-item-line__block col x3d12 x1d2--s">
					<h4 class="new-item-line__title">Изделие:</h4>
						<span><a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= $formatedname ?></a></span>

<!--					<?/* if ($item['CAN_BUY'] and $item['PRODUCT']['QUANTITY'] > 0): */?>
						<div class="catalog-item__state">В наличии</div>
					--><?/* endif */?>
				</div>
                <div class="new-item-line__block col x2d12 x1d2--s">
                    <?if ($item['DISPLAY_PROPERTIES']['DIAMETRES']['VALUE']):?>
                    <h4 class="new-item-line__title"><?=$item['DISPLAY_PROPERTIES']['DIAMETRES']['NAME']?>:</h4>
                    <span><?=$item['DISPLAY_PROPERTIES']['DIAMETRES']['VALUE']?></span>
                    <?endif;?>
                </div>
                <div class="new-item-line__block col x2d12 x1d2--s">
                    <?if ($item['DISPLAY_PROPERTIES']['MATERIALS']['VALUE']):?>
                    <h4 class="new-item-line__title"><?=$item['DISPLAY_PROPERTIES']['MATERIALS']['NAME']?>:</h4>
                    <span><?=$item['DISPLAY_PROPERTIES']['MATERIALS']['VALUE']?></span>
                    <?endif;?>
                </div>
                <div class="new-item-line__block col x3d12 x1d1--s">
                    <!--<h4 class="new-item-line__title"></h4>-->
					<!--<div class="catalog-item__footer col x3d5">-->
                    <!--<span> class="catalog-item__price"-->
							  <?/* if ($discontPrice < $originalPrice): */?><!--
								  <span class="dashed"><?/*= $originalPrice */?></span>
							  <?/* endif */?>
								<span><?/*= $printPriceValue */?></span>-->
                    <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="btn">Подробнее</a>
                    <!--</span>
                    <span>Рублей за упаковку</span>-->

					<!--</div>-->

					<!--<div class="c-col x2d5 u-align-right">
						<br>
                        <?php /*if($item['CAN_BUY']): */?>
                            <a href="<?/*= $item['~ADD_URL'] */?>" class="btn" data-ajax-order><?/*= $buttonLabel */?></a>
                        <?/* elseif(($arParams['PRODUCT_SUBSCRIPTION'] === 'Y') || ($item['CATALOG_SUBSCRIBE'] === 'Y')): */?>
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
                            );*/
                            ?>
                        <?/* endif */?>

					</div>-->
				</div>
				<div class="clear"></div>
			</div>
		</li>
	<? endforeach; ?>
</ul>

    <? if (($arParams["DISPLAY_BOTTOM_PAGER"]) and count($arResult['ITEMS'])): ?>
        <? if ($arResult["NAV_RESULT"]->nEndPage > 1):?>
            <div id="traiv-catalog-section-link-more">Показать ещё +</div>
        <? endif ?>
        <div class="bottom-nav">
            <? echo $arResult["NAV_STRING"]; ?>
        </div>
    <? endif ?>
        
    
<?}?>
<? } ?>
