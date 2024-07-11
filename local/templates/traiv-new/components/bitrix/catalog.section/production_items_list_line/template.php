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

/*echo $arParams["IBLOCK_ID"];
echo $arResult["VARIABLES"]["SECTION_CODE"];

$arFilter = Array("IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"], "IBLOCK_ID" => $arParams["IBLOCK_ID"], "CODE" => $arResult["VARIABLES"]["SECTION_CODE"]);
$arSelect = Array('UF_PREVIEW_TEXT', 'UF_UT_NAME','UF_UT_NOTE','UF_UT_P','UF_UT_TITLE','DESCRIPTION', 'UF_TERM', 'UF_LONGTEXT', 'UF_COUNTER', 'UF_HEADER_FIRST', 'UF_HEADER_SECOND');
$db_list = CIBlockSection::GetList(Array(), $arFilter, true, $arSelect);

$res_rows = intval($db_list->SelectedRowsCount());
if ($res_rows > 0) {
    if ($section = $db_list->GetNext()) {
      echo "<pre>";
          print_r($section);
      echo "</pre>";
    }
}*/


?>

<pre><?//print_r($arResult) ?></pre><?php
if(count($arResult['ITEMS'])){
?>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
	<? echo $arResult["NAV_STRING"]; ?>
<? endif ?>


<div class="row production-catalog-line">
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
		
		<div class="product-line-item-area" id='<?= $strMainID ?>'>
				<div class="row">
				<div class="col-2 col-xl-2 col-lg-2 col-md-2">
					<div class="product-line-item-image overflow-h">
					                  <a href="<?= $item['DETAIL_PAGE_URL'] ?>">
                       <img src="<?=$itemPicture['SRC']?>" alt="<?=$formatedname?>" title="<?=$formatedname?>">
                    </a>
					</div>
				</div>
				<div class="col-10 col-xl-10 col-lg-10 col-md-10">
				  <div class="row">
    				<div class="product-line-item-name col-12">
    					<!-- <h4 class="new-item-line__title">Изделие:</h4> -->
    					<span><?= $formatedname ?></span>
    				</div>
                    <div class="col-12 mt-2">
                        <?if ($item['DISPLAY_PROPERTIES']['DIAMETRES']['VALUE']):?>
                        <span class="product-line-item-title"><?=$item['DISPLAY_PROPERTIES']['DIAMETRES']['NAME']?>:</span>
                        <span class="product-line-item-val"><?=$item['DISPLAY_PROPERTIES']['DIAMETRES']['VALUE']?></span>
                        <?endif;?>
                    </div>
                    <div class="col-12 mt-2">
                        <?if ($item['DISPLAY_PROPERTIES']['MATERIALS']['VALUE']):?>
                        <span class="product-line-item-title"><?=$item['DISPLAY_PROPERTIES']['MATERIALS']['NAME']?>:</span>
                        <span class="product-line-item-val"><?=$item['DISPLAY_PROPERTIES']['MATERIALS']['VALUE']?></span>
                        <?endif;?>
                    </div>
    				
    				</div>
				</div>
				</div>
				
				<div class="product-line-item-button">
                        <div class="btn-group-blue">
                            <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="btn-blue">
                                <span>Подробнее</span>
                            </a>
                    	</div>
    				</div>
				
				
			</div>
	<? endforeach; ?>
</div>

    <? if (($arParams["DISPLAY_BOTTOM_PAGER"]) and count($arResult['ITEMS'])): ?>
        <? if ($arResult["NAV_RESULT"]->nEndPage > 1):?>
            <div id="traiv-catalog-section-link-more">Показать ещё +</div>
        <? endif ?>
        <div class="bottom-nav">
            <? echo $arResult["NAV_STRING"]; ?>
        </div>
    <? endif ?>
        
    
<?}?>
<? }?>
