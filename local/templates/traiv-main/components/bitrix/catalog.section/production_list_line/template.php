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
if(count($arResult['ITEMS'])){
?>

<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
	<? echo $arResult["NAV_STRING"]; ?>
<? endif ?>

<?

?>
<?
	$widthsizen="200";
	$heightsizen="200";

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

<ul class="row traiv-catalog-line-default">
	<? foreach ($arResult['ITEMS'] as $item): ?>
		<?
		$this->AddEditAction($item['ID'], $item['EDIT_LINK'], $strElementEdit);
		$this->AddDeleteAction(
			$item['ID'],
			$item['DELETE_LINK'],
			$strElementDelete,
			$arElementDeleteParams);
		$strMainID = $this->GetEditAreaId($item['ID']);

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
			<div class="catalog-item">
				<div class="col x2d12">
					<div class="catalog-item__image overflow-h">
					                  <a href="<?= $item['DETAIL_PAGE_URL'] ?>">
                       <img src="<?=$arResult['LIST_PICT']['SRC']?>" alt="<?=$item['NAME']?>" title="<?=$item['NAME']?>">
                    </a>
					</div>
				</div>
				<div class="catalog-item__header col x6d12">
					<h4 class="catalog-item__title">
						<a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= $item['NAME'] ?></a>
					</h4>
					<? if ($item['CAN_BUY'] and $item['PRODUCT']['QUANTITY'] > 0): ?>
						<div class="catalog-item__state">В наличии</div>
					<? endif ?>
				</div>
                <div class="col x4d12">
					<div class="catalog-item__footer col x3d5">
						<div class="u-pull-left">
							<span>Цена: </span>
							<span class="catalog-item__price">
							  <? if ($discontPrice < $originalPrice): ?>
								  <span class="dashed"><?= $originalPrice ?></span>
							  <? endif ?>
								<span><?= $printPriceValue ?></span>
							</span>
                            <!--<span>Рублей за упаковку</span>-->
						</div>
						<?/* if ($item['PROPERTIES']['standarts']['VALUE']): ?>
							<div class="u-pull-right">
								Аналог:
								<ul class="similar">
									<? foreach ($item['PROPERTIES']['standarts']['VALUE'] as $standart): ?>
										<li class="similar__item"><?= $standart ?></li>
									<? endforeach; ?>
								</ul>
							</div>
						<? endif */?>
					</div>

					<div class="c-col x2d5 u-align-right">
						<br>
                        <?php if($item['CAN_BUY']): ?>
                            <a href="<?= $item['~ADD_URL'] ?>" class="btn" data-ajax-order><?= $buttonLabel ?></a>
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
                            );*/
                            ?>
                        <? endif ?>

					</div>
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
