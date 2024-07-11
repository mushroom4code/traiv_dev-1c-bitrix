<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Элемент ГОСТа детально");
?><section id="content">
	<div class="container">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"traiv-pdf", 
	array(
		"COMPONENT_TEMPLATE" => "traiv-pdf",
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?> <div class="row"> 

<div class="col-12">

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.element", 
	"board_pdf_gost", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_DETAIL_TO_SLIDER" => "N",
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_TO_BASKET_ACTION" => array(
			0 => "BUY",
		),
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BRAND_USE" => "N",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_SECTION_ID_VARIABLE" => "N",
		"COMPONENT_TEMPLATE" => "board_pdf_gost",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_PICTURE_MODE" => "IMG",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
		"ELEMENT_ID" => "",
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "22",
		"IBLOCK_TYPE" => "content",
		"LABEL_PROP" => "-",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"LINK_IBLOCK_ID" => "",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_PROPERTY_SID" => "",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_COMPARE" => "Сравнить",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "0",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_CODE",
		"SECTION_URL" => "",
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SET_VIEWED_IN_COMPONENT" => "N",
		"SHOW_404" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DEACTIVATED" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_COMMENTS" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_GIFTS_DETAIL" => "Y",
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"USE_VOTE_RATING" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"SHOW_SKU_DESCRIPTION" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"COMPATIBLE_MODE" => "Y"
	),
	false
);?> </div>
	</div>
</div>
  <script>
        $(document).ready(function() {
            $(".categories").removeClass('u-none');
        });
    </script>
</section><?

/*if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '1788') {*/
    $arSelectRs = Array("ID", "NAME", "CODE", "SECTION_ANME");
    $arSortRs = array();
   /* echo $_REQUEST["SECTION_CODE"];
    echo "<br>";
    echo $_REQUEST["ELEMENT_CODE"];*/
    
    $seoPdfTitle = "";
    $seoPdfDescription = "";
    
    $arFilterRs = array('IBLOCK_ID'=>'22', '=CODE'=>$_REQUEST["ELEMENT_CODE"], 'ACTIVE'=>'Y');
    $db_list_inRs = CIBlockElement::GetList($arSortRs, $arFilterRs, false, false, $arSelectRs);
    
    $res_rows = intval($db_list_inRs->SelectedRowsCount());
    
    if ($res_rows > 0) {
        while($ar_result_inRs = $db_list_inRs->GetNext()){
            
            $seoNameForDescription = $ar_result_inRs['NAME'];
            $seoPdfTitle = $ar_result_inRs['NAME']." - документ стандарта, просмотр и скачивание.";
        }
    }
    
    $db_list = CIBlockSection::GetList(array(), ['IBLOCK_ID'=>'22', 'CODE' =>  $_REQUEST["SECTION_CODE"], 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y'], false,array());
    echo $res_rows1 = intval($db_list->SelectedRowsCount());
        if ($res_rows1 > 0) {
            while($ar_result = $db_list->GetNext()){
                /*echo "<pre>";
                print_r($ar_result);
                echo "</pre>";*/
                
                $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues('22',$ar_result['ID']);
                $IPROPERTY  = $ipropValues->getValues();
                $seoPdfDescription = $seoNameForDescription." - смотреть онлайн или скачать требования по стандарту ".$IPROPERTY['SECTION_PAGE_TITLE'];
                /*echo "<pre>";
                    print_r($IPROPERTY['SECTION_PAGE_TITLE']);
                echo "</pre>";*/
                
                /*$seoPdfTitle = $ar_result_inRs['NAME']." - документ стандарта, просмотр и скачивание.";
                $seoPdfDescription = $ar_result_inRs['NAME']." - смотреть онлайн или скачать требования по стандарту";*/
            }
        }
 /*   }
}*/


$APPLICATION->SetPageProperty('title', $seoPdfTitle);
$APPLICATION->SetPageProperty('description', $seoPdfDescription);
$APPLICATION->AddChainItem('Просмотр файла',$_REQUEST["SECTION_CODE"]."/".$_REQUEST["ELEMENT_CODE"]."/");
?>
<?php 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>