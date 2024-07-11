<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Ожидаемые товары");
?><div class="content">
	<div class="container">
		<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
                	"COMPONENT_TEMPLATE" => ".default",
                	"START_FROM" => "0",
                	"PATH" => "",
                	"SITE_ID" => "zf",
            		),
                	false
            	);


    if(CModule::IncludeModule("iblock")) {

        $idPost = intval($_REQUEST['id']);
        if($idPost > 0){

            $products = (new CIBlockElement())->GetProperty(27, $idPost, 'sort', 'asc', ['ID' => '578']);

            while($product = $products->GetNext()){
                if(!empty($product['VALUE'])){
                    $pr[] = $product['VALUE'];
                }
            }

            if(count($pr)){
                $arrFilter = array("ID" => $pr);
            }else{
                $arrFilter = array("ID" => 0);
            }

            unset($pr);



            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "items_list",
                array(
                    "COMPONENT_TEMPLATE" => "items_list",
                    "IBLOCK_TYPE" => "catalog",
                    "IBLOCK_ID" => "18",
                    "SECTION_ID" => $_REQUEST["SECTION_ID"],
                    "SECTION_CODE" => "",
                    "SECTION_USER_FIELDS" => array(
                        0 => "",
                        1 => "",
                    ),
                    "FILTER_NAME" => "arrFilter",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "SHOW_ALL_WO_SECTION" => "Y",
                    "CUSTOM_FILTER" => "",
                    "HIDE_NOT_AVAILABLE" => "N",
                    "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                    "ELEMENT_SORT_FIELD" => "sort",
                    "ELEMENT_SORT_ORDER" => "asc",
                    "ELEMENT_SORT_FIELD2" => "id",
                    "ELEMENT_SORT_ORDER2" => "desc",
                    "OFFERS_SORT_FIELD" => "sort",
                    "OFFERS_SORT_ORDER" => "asc",
                    "OFFERS_SORT_FIELD2" => "id",
                    "OFFERS_SORT_ORDER2" => "desc",
                    "PAGE_ELEMENT_COUNT" => "18",
                    "LINE_ELEMENT_COUNT" => "3",
                    "PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "OFFERS_FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "OFFERS_PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "OFFERS_LIMIT" => "5",
                    "BACKGROUND_IMAGE" => "-",
                    "SECTION_URL" => "",
                    "DETAIL_URL" => "",
                    "SECTION_ID_VARIABLE" => "SECTION_ID",
                    "SEF_MODE" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_GROUPS" => "Y",
                    "SET_TITLE" => "Y",
                    "SET_BROWSER_TITLE" => "Y",
                    "BROWSER_TITLE" => "-",
                    "SET_META_KEYWORDS" => "Y",
                    "META_KEYWORDS" => "-",
                    "SET_META_DESCRIPTION" => "Y",
                    "META_DESCRIPTION" => "-",
                    "SET_LAST_MODIFIED" => "N",
                    "USE_MAIN_ELEMENT_SECTION" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "CACHE_FILTER" => "N",
                    "ACTION_VARIABLE" => "action",
                    "PRODUCT_ID_VARIABLE" => "id",
                    "PRICE_CODE" => array(
                        0 => "BASE",
                    ),
                    "USE_PRICE_COUNT" => "N",
                    "SHOW_PRICE_COUNT" => "1",
                    "PRICE_VAT_INCLUDE" => "Y",
                    "CONVERT_CURRENCY" => "N",
                    "BASKET_URL" => "/personal/basket.php",
                    "USE_PRODUCT_QUANTITY" => "N",
                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                    "ADD_PROPERTIES_TO_BASKET" => "Y",
                    "PRODUCT_PROPS_VARIABLE" => "prop",
                    "PARTIAL_PRODUCT_PROPERTIES" => "N",
                    "PRODUCT_PROPERTIES" => array(
                    ),
                    "OFFERS_CART_PROPERTIES" => array(
                    ),
                    "DISPLAY_COMPARE" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Товары",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "SET_STATUS_404" => "N",
                    "SHOW_404" => "N",
                    "MESSAGE_404" => "",
                    "COMPATIBLE_MODE" => "Y",
                    "DISABLE_INIT_JS_IN_COMPONENT" => "N"
                ),
                false
            );

        }
    }



		?>
		</div>
	</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>