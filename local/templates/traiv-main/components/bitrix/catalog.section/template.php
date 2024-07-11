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

    $widthsizen="35";
	$heightsizen="35";

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
    <div class="list-line-titles">
        <div class="xol p3"><strong>№</strong></div>
        <div class="col x1d12"><strong> Фото</strong></div>
        <div class="col x5d12"><strong>Наименование</strong></div>
        <div class="col x1d10"><strong>Размер</strong></div>
        <div class="col x1d12"><strong>Материал</strong></div>
        <div class="col x1d10"><strong>Цена за шт.</strong></div>
        <div class="col x1d12"><strong>Кол-во</strong></div>
        <div class="col x1d12"><strong>Купить</strong></div>
    </div>
<ul class="row traiv-catalog-line-default loadmore_wrap">
	<? foreach ($arResult['ITEMS'] as $index => $item): ?>

		<?
        $position = $index + 1;

		$this->AddEditAction($item['ID'], $item['EDIT_LINK'], $strElementEdit);
		$this->AddDeleteAction(
			$item['ID'],
			$item['DELETE_LINK'],
			$strElementDelete,
			$arElementDeleteParams);
		$strMainID = $this->GetEditAreaId($item['ID']);

        $origname = $item["NAME"];
        $formatedPACKname = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/","",$origname);
        $formatedname = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|Евр|Ев|PU=.*|RU=.*/","",$formatedPACKname);

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

        $dlina = $item["PROPERTIES"]["DLINA_1"]["VALUE"];
        $diametr = $item["PROPERTIES"]["DIAMETR_1"]["VALUE"];
        $material = $item["PROPERTIES"]["MATERIAL_1"]["VALUE"];

		?>
    <div class="item-list-container">
    		<li class="col x1 x1--t x1--s" id='<?= $strMainID ?>'><!--
			--><div class="new-item-line loadmore_item"><!--
                --><div class="position-list xol p3"><?=$position.'. '?>
                </div><!--
				--><div class="col x1d12 x1d8--m">
					<div class="new-item-line__image overflow-h">
					                  <a href="<?= $item['DETAIL_PAGE_URL'] ?>">
                       <img src="<?=$arResult['LIST_PICT']['SRC']?>" alt="<?=$formatedname?>" title="<?=$formatedname?>" id="<?= $item["ID"]?>">
                    </a>
					</div>
				</div><!--
				--><div class="new-item-line__header col x5d12 x3d4--m">
					<h4 class="new-item-line__title">
						<a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= $formatedname ?></a>
					</h4>
<!--					<?/* if ($item['CAN_BUY'] and $item['PRODUCT']['QUANTITY'] > 0): */?>
						<div class="new-item-line__state">В наличии</div>
					--><?/* endif */?>
				</div><!--
                --><div class="col x1d10 x1d5--m">
                <span><?=$dlina ? '<div class="otho">⌀</div>' . $diametr.' x '.$dlina : $diametr?></span>
                </div><!--
                --><div class="col x1d12 x1d6--m">
                    <span><?=$material?></span>
                </div><!--
                --><div class="col x1d10 x1d6--m">
					<!--<div class="new-item-line__footer col x3d5">-->
<!--						<div class="u-pull-left">-->

							<span class="new-item-line__price">
<!--							  <?/* if ($discontPrice < $originalPrice): */?>
								  <span class="dashed"><?/*= $originalPrice */?></span>
							  --><?/* endif */?>
								<span><?= $printPriceValue !== '0 руб.' ? $printPriceValue : 'запросить' ?></span>
							</span>
                            <!--<span>Рублей за упаковку</span>-->
<!--						</div>-->
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
					</div><!--

                    --><div class="col x1d12 x1d6--m">
                        <?$pack = $item["PROPERTIES"]["KRATNOST_UPAKOVKI"]["VALUE"] ? $item["PROPERTIES"]["KRATNOST_UPAKOVKI"]["VALUE"] : 1;?>


                        <!--<pre><?/*print_r($item["PROPERTIES"]["KRATNOST_UPAKOVKI"])*/?></pre>-->
                        <input type="number" name='QUANTITY' class="quantity section_list" id="<?= $item["ID"]?>-item-quantity"  size="5" value="<?=$pack?>" step="<?=$pack?>" min="<?=$pack?>">
                    </div><!--

					--><div class="col x1d12 x1d8--m list-cart">
                        <?php if($item['CAN_BUY']):
                            $item['~ADD_URL'] .= '&QUANTITY=';
                            ?>
                            <a href="<?= $item['~ADD_URL'] ?>" class="btn new-item-line-buy" data-ajax-order><?/*= $buttonLabel */?></a>
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

		</li>
	<? endforeach; ?>
</ul>
    </div>



    <?php   $bxajaxid = CAjax::GetComponentID($component->__name, $component->__template->__name, $component->arParams['AJAX_OPTION_ADDITIONAL']);
    ?>
    <?if($arResult["NAV_RESULT"]->nEndPage > 1 && $arResult["NAV_RESULT"]->NavPageNomer<$arResult["NAV_RESULT"]->nEndPage):?>
        <div id="btn_<?=$bxajaxid?>" class="load_more">
            <a data-ajax-id="<?=$bxajaxid?>" href="javascript:void(0)" data-show-more="<?=$arResult["NAV_RESULT"]->NavNum?>" data-next-page="<?=($arResult["NAV_RESULT"]->NavPageNomer + 1)?>" data-max-page="<?=$arResult["NAV_RESULT"]->nEndPage?>"><div class="btn show-more-btn">Показать еще</div></a>
        </div>
    <?endif?>
    <script>
        $(document).on('click', '[data-show-more]', function(){
            var targetContainer = $('.loadmore_wrap:last');
            var btn = $(this);
            var page = btn.attr('data-next-page');
            var id = btn.attr('data-show-more');
            var bx_ajax_id = btn.attr('data-ajax-id');
            var block_id = "#comp_"+bx_ajax_id;

            let startcount = $('.position-list').length;
            console.log(startcount);

            var data = {
                bxajaxid:bx_ajax_id
            };
            data['PAGEN_'+id] = page;
            var url = window.location.href/* + '?PAGEN_'+id+'='+page*/;

            $.ajax({
                type: "GET",
                url:url,
                data: data,
                timeout: 3000,
                success: function(data) {
                    $("#btn_"+bx_ajax_id).remove();
                    var elements = $(data).find('.loadmore_wrap'),  //  Ищем элементы
                        pagination = $(data).find("#btn_"+bx_ajax_id);//  Ищем навигацию
                    targetContainer.append(elements);   //  Добавляем посты в конец контейнера
                    targetContainer.append(pagination); //  добавляем навигацию следом
                    elements.find('.position-list').each(function(index){
                        $(this).text(parseInt(startcount)+parseInt(index)+1+'.');
                    });

                }
            });
        });
    </script>

<!--    <?/* if (($arParams["DISPLAY_BOTTOM_PAGER"]) and count($arResult['ITEMS'])): */?>
        <?/* if ($arResult["NAV_RESULT"]->nEndPage > 1):*/?>
            <div id="traiv-catalog-section-link-more">Показать ещё +</div>
        <?/* endif */?>
        <div class="bottom-nav">
            <?/* echo $arResult["NAV_STRING"]; */?>
        </div>
    --><?/* endif */?>
        
    
<?}?>
<? } ?>
