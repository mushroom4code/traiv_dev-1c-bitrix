<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule('iblock');

        
        $hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(10)->fetch();
        $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        
        $data_all = $entity_data_class::getList(array(
            "select" => array("*"),
            "filter" => array(
                'LOGIC' => 'AND',
                array('=UF_PUBLISH' => '1','UF_BIG_TYPE' => '0','UF_INST' => '0')
            )
        ));
        
        if (intval($data_all->getSelectedRowsCount()) > 0){
            $i = 0;
            while($arDataAll = $data_all->Fetch()){
                $arResult['utp_menu'][$i]['LINK'] = "https://traiv-komplekt.ru".$arDataAll['UF_LINK'];
                $arResult['utp_menu'][$i]['NAME'] = $arDataAll['UF_UTP_TITLE'];
                $i++;
            }
        }
        
        /*coating*/
        $arSelectRs = Array('DETAIL_PAGE_URL','NAME');
        $arSortRs = array();
        
        $arFilterRs = array('IBLOCK_ID'=>'49', 'ACTIVE'=>'Y');
        $db_list_inRs = CIBlockElement::GetList($arSortRs, $arFilterRs, false, Array(), $arSelectRs);
        
        $res_rows = intval($db_list_inRs->SelectedRowsCount());
        
        if ($res_rows > 0){
            $i = 0;
            while($ar_result_inRs = $db_list_inRs->GetNext()){
                $arResult['coating_menu'][$i]['LINK'] = "https://traiv-komplekt.ru".$ar_result_inRs['DETAIL_PAGE_URL'];
                $arResult['coating_menu'][$i]['NAME'] = $ar_result_inRs['NAME'];
                $i++;
            }
        }
        /*end coating*/
        
        /*proizvodstvo*/

        $proCatlist = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 32, 'ACTIVE'=>'Y'], false,array());
        $res_rows = intval($proCatlist->SelectedRowsCount());
        $i=0;
        while($ar_result_pro = $proCatlist->GetNext())
        {
            
            $arResult['pro_menu'][$i]['LINK'] = "https://traiv-komplekt.ru".$ar_result_pro['SECTION_PAGE_URL'];
            $arResult['pro_menu'][$i]['NAME'] = $ar_result_pro['NAME'];
            
            $proCatlistEl = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 32, 'SECTION_ID' => $ar_result_pro['ID'], 'ACTIVE'=>'Y'], false);
            $res_rows_item = intval($proCatlistEl->SelectedRowsCount());
            if (intval($res_rows_item) > 0){
                $j=0;
                while($ar_result_inItem = $proCatlistEl->GetNext()){
                    
                    $arResult['pro_menu'][$i]['SUBMENU'][$j]['LINK'] = "https://traiv-komplekt.ru".$ar_result_inItem['DETAIL_PAGE_URL'];
                    $arResult['pro_menu'][$i]['SUBMENU'][$j]['NAME'] = $ar_result_inItem['NAME'];
                    $j++;
                }
            }
            $i++;
        }
        
        /*$arSelectPro = Array('DETAIL_PAGE_URL','NAME');
        $arSortPro = array();
        
        $arFilterPro = array('IBLOCK_ID'=>'49', 'ACTIVE'=>'Y');
        $db_list_inPro = CIBlockElement::GetList($arSortPro, $arFilterPro, false, Array(), $arSelectPro);
        
        $res_rows = intval($db_list_inRs->SelectedRowsCount());
        
        if ($res_rows > 0){
            $i = 0;
            while($ar_result_inRs = $db_list_inRs->GetNext()){
                $arResult['coating_menu'][$i]['LINK'] = "https://traiv-komplekt.ru".$ar_result_inRs['DETAIL_PAGE_URL'];
                $arResult['coating_menu'][$i]['NAME'] = $ar_result_inRs['NAME'];
                $i++;
            }
        }*/
        
        /*end proizvodstvo*/
        
        $hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(10)->fetch();
        $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        
        $data_all = $entity_data_class::getList(array(
            "select" => array("*"),
            "filter" => array(
                'LOGIC' => 'AND',
                array('=UF_PUBLISH' => '1','UF_BIG_TYPE' => '1' ,'UF_INST' => '0')
            )
        ));
        
        if (intval($data_all->getSelectedRowsCount()) > 0){
            $i = 0;
            while($arDataAll = $data_all->Fetch()){
                $arResult['utp_menu_big'][$i]['LINK'] = "https://traiv-komplekt.ru".$arDataAll['UF_LINK'];
                $arResult['utp_menu_big'][$i]['NAME'] = $arDataAll['UF_UTP_TITLE'];
                $i++;
            }
        }
        
        $hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(10)->fetch();
        $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        
        $data_all = $entity_data_class::getList(array(
            "select" => array("*"),
            "filter" => array(
                'LOGIC' => 'AND',
                array('=UF_PUBLISH' => '1','UF_INST' => '1','UF_BIG_TYPE' => '0')
            )
        ));
        
        if (intval($data_all->getSelectedRowsCount()) > 0){
            $i = 0;
            while($arDataAll = $data_all->Fetch()){
                $arResult['utp_menu_inst'][$i]['LINK'] = "https://traiv-komplekt.ru".$arDataAll['UF_LINK'];
                $arResult['utp_menu_inst'][$i]['NAME'] = $arDataAll['UF_UTP_TITLE'];
                $i++;
            }
        }


if (!empty($arParams['URL'])){
    
    $link_bp = $APPLICATION->GetCurPage(false);
    
    $hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(10)->fetch();
    
    $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    
    $data = $entity_data_class::getList(array(
        "select" => array("*"),
        "filter" => array(
            'LOGIC' => 'AND',
            array('%=UF_LINK' => '%'.$link_bp.'%')
        )
    ));
    
    if (intval($data->getSelectedRowsCount()) > 0){
        while($arData = $data->Fetch()){
            $arResult['landing_main_img'] = CFile::GetPath($arData['UF_MAINIMG']);
            $arResult['landing_second_img'] = CFile::GetPath($arData['UF_SECONDIMG']);
            $arResult['case_item'] = $arData['UF_CASE_ITEM'];
            $arResult['main_text'] = $arData['UF_MAIN_TEXT'];
            $arResult['utp_text'] = $arData['UF_UTP'];
            $arResult['utp_note'] = $arData['UF_UTP_NOTE'];
            $arResult['utp_title'] = $arData['UF_UTP_TITLE'];
            $arResult['utp_p'] = $arData['UF_UTP_P'];
            $arResult['PUBLISH'] = $arData['UF_PUBLISH'];
            $arResult['TEXTFLOAT'] = $arData['UF_TEXTFLOAT'];
            $arResult['GALLERY'] = $arData['UF_GALLERY'];
        }
    }

} else if(empty($arParams['URL']) && $arParams['TYPE_LABEL'] == 'provo') {
    
    $APPLICATION->IncludeComponent(
        "bitrix:catalog",
        "catalog_proizvodstvo_land",
        array(
            "ACTION_VARIABLE" => "action",
            "ADD_ELEMENT_CHAIN" => "Y",
            "ADD_PICT_PROP" => "-",
            "ADD_PROPERTIES_TO_BASKET" => "Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "BASKET_URL" => "/personal/basket.php",
            "BIG_DATA_RCM_TYPE" => "personal",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "N",
            "COMMON_ADD_TO_BASKET_ACTION" => "ADD",
            "COMMON_SHOW_CLOSE_POPUP" => "N",
            "COMPATIBLE_MODE" => "Y",
            "COMPONENT_TEMPLATE" => "catalog_proizvodstvo_land",
            "COMPOSITE_FRAME_MODE" => "A",
            "COMPOSITE_FRAME_TYPE" => "AUTO",
            "CONVERT_CURRENCY" => "N",
            "DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
            "DETAIL_ADD_TO_BASKET_ACTION" => array(
                0 => "BUY",
            ),
            "DETAIL_ADD_TO_BASKET_ACTION_PRIMARY" => array(
                0 => "BUY",
            ),
            "DETAIL_BACKGROUND_IMAGE" => "-",
            "DETAIL_BRAND_USE" => "N",
            "DETAIL_BROWSER_TITLE" => "-",
            "DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
            "DETAIL_DETAIL_PICTURE_MODE" => "MAGNIFIER",
            "DETAIL_DISPLAY_NAME" => "Y",
            "DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
            "DETAIL_IMAGE_RESOLUTION" => "16by9",
            "DETAIL_MAIN_BLOCK_PROPERTY_CODE" => "",
            "DETAIL_META_DESCRIPTION" => "-",
            "DETAIL_META_KEYWORDS" => "-",
            "DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
            "DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
            "DETAIL_PROPERTY_CODE" => array(
                0 => "",
                1 => "PHOTOS",
                2 => "",
            ),
            "DETAIL_SET_CANONICAL_URL" => "N",
            "DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
            "DETAIL_SHOW_MAX_QUANTITY" => "N",
            "DETAIL_SHOW_POPULAR" => "Y",
            "DETAIL_SHOW_SLIDER" => "N",
            "DETAIL_SHOW_VIEWED" => "Y",
            "DETAIL_STRICT_SECTION_CHECK" => "N",
            "DETAIL_USE_COMMENTS" => "N",
            "DETAIL_USE_VOTE_RATING" => "N",
            "DISABLE_INIT_JS_IN_COMPONENT" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "ELEMENT_SORT_FIELD" => "sort",
            "ELEMENT_SORT_FIELD2" => "id",
            "ELEMENT_SORT_ORDER" => "asc",
            "ELEMENT_SORT_ORDER2" => "desc",
            "FILE_404" => "",
            "FILTER_HIDE_ON_MOBILE" => "N",
            "FILTER_VIEW_MODE" => "VERTICAL",
            "GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
            "GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
            "GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
            "GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
            "GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
            "GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
            "GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
            "GIFTS_MESS_BTN_BUY" => "Выбрать",
            "GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
            "GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
            "GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "4",
            "GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
            "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
            "GIFTS_SHOW_IMAGE" => "Y",
            "GIFTS_SHOW_NAME" => "Y",
            "GIFTS_SHOW_OLD_PRICE" => "Y",
            "HIDE_NOT_AVAILABLE" => "N",
            "HIDE_NOT_AVAILABLE_OFFERS" => "N",
            "IBLOCK_ID" => "32",
            "IBLOCK_TYPE" => "catalog",
            "INCLUDE_SUBSECTIONS" => "Y",
            "INSTANT_RELOAD" => "N",
            "LABEL_PROP" => "-",
            "LAZY_LOAD" => "N",
            "LINE_ELEMENT_COUNT" => "3",
            "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
            "LINK_IBLOCK_ID" => "",
            "LINK_IBLOCK_TYPE" => "",
            "LINK_PROPERTY_SID" => "",
            "LIST_BROWSER_TITLE" => "-",
            "LIST_ENLARGE_PRODUCT" => "STRICT",
            "LIST_META_DESCRIPTION" => "-",
            "LIST_META_KEYWORDS" => "-",
            "LIST_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
            "LIST_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
            "LIST_PROPERTY_CODE" => array(
                0 => "DIAMETRES",
                1 => "MATERIALS",
                2 => "",
            ),
            "LIST_PROPERTY_CODE_MOBILE" => "",
            "LIST_SHOW_SLIDER" => "Y",
            "LIST_SLIDER_INTERVAL" => "3000",
            "LIST_SLIDER_PROGRESS" => "N",
            "LOAD_ON_SCROLL" => "N",
            "MESSAGE_404" => "",
            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
            "MESS_BTN_BUY" => "Купить",
            "MESS_BTN_COMPARE" => "Сравнение",
            "MESS_BTN_DETAIL" => "Подробнее",
            "MESS_BTN_SUBSCRIBE" => "Подписаться",
            "MESS_COMMENTS_TAB" => "Комментарии",
            "MESS_DESCRIPTION_TAB" => "Описание",
            "MESS_NOT_AVAILABLE" => "Нет в наличии",
            "MESS_PRICE_RANGES_TITLE" => "Цены",
            "MESS_PROPERTIES_TAB" => "Характеристики",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "visual",
            "PAGER_TITLE" => "Товары",
            "PAGE_ELEMENT_COUNT" => "30",
            "PARTIAL_PRODUCT_PROPERTIES" => "N",
            "PRICE_CODE" => array(
            ),
            "PRICE_VAT_INCLUDE" => "Y",
            "PRICE_VAT_SHOW_VALUE" => "N",
            "PRODUCT_ID_VARIABLE" => "id",
            "PRODUCT_PROPERTIES" => array(
            ),
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PRODUCT_QUANTITY_VARIABLE" => "quantity",
            "PRODUCT_SUBSCRIPTION" => "Y",
            "SEARCH_CHECK_DATES" => "Y",
            "SEARCH_NO_WORD_LOGIC" => "Y",
            "SEARCH_PAGE_RESULT_COUNT" => "50",
            "SEARCH_RESTART" => "N",
            "SEARCH_USE_LANGUAGE_GUESS" => "Y",
            "SECTIONS_SHOW_PARENT_NAME" => "Y",
            "SECTIONS_VIEW_MODE" => "LIST",
            "SECTION_ADD_TO_BASKET_ACTION" => "ADD",
            "SECTION_BACKGROUND_IMAGE" => "-",
            "SECTION_COUNT_ELEMENTS" => "Y",
            "SECTION_ID_VARIABLE" => "SECTION_ID",
            "SECTION_TOP_DEPTH" => "2",
            "SEF_FOLDER" => "/services/proizvodstvo-metizov/",
            "SEF_MODE" => "Y",
            "SET_LAST_MODIFIED" => "N",
            "SET_STATUS_404" => "Y",
            "SET_TITLE" => "Y",
            "SHOW_404" => "Y",
            "SHOW_DEACTIVATED" => "N",
            "SHOW_DISCOUNT_PERCENT" => "N",
            "SHOW_MAX_QUANTITY" => "N",
            "SHOW_OLD_PRICE" => "N",
            "SHOW_PRICE_COUNT" => "1",
            "SHOW_TOP_ELEMENTS" => "Y",
            "SIDEBAR_DETAIL_SHOW" => "N",
            "SIDEBAR_PATH" => "",
            "SIDEBAR_SECTION_SHOW" => "Y",
            "TEMPLATE_THEME" => "blue",
            "TOP_ADD_TO_BASKET_ACTION" => "ADD",
            "TOP_ELEMENT_COUNT" => "9",
            "TOP_ELEMENT_SORT_FIELD" => "sort",
            "TOP_ELEMENT_SORT_FIELD2" => "id",
            "TOP_ELEMENT_SORT_ORDER" => "asc",
            "TOP_ELEMENT_SORT_ORDER2" => "desc",
            "TOP_ENLARGE_PRODUCT" => "STRICT",
            "TOP_LINE_ELEMENT_COUNT" => "3",
            "TOP_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
            "TOP_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
            "TOP_PROPERTY_CODE" => array(
                0 => "",
                1 => "",
            ),
            "TOP_PROPERTY_CODE_MOBILE" => "",
            "TOP_SHOW_SLIDER" => "Y",
            "TOP_SLIDER_INTERVAL" => "3000",
            "TOP_SLIDER_PROGRESS" => "N",
            "TOP_VIEW_MODE" => "SECTION",
            "USER_CONSENT" => "N",
            "USER_CONSENT_ID" => "0",
            "USER_CONSENT_IS_CHECKED" => "Y",
            "USER_CONSENT_IS_LOADED" => "N",
            "USE_ALSO_BUY" => "N",
            "USE_BIG_DATA" => "Y",
            "USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
            "USE_COMPARE" => "N",
            "USE_ELEMENT_COUNTER" => "Y",
            "USE_ENHANCED_ECOMMERCE" => "N",
            "USE_FILTER" => "N",
            "USE_GIFTS_DETAIL" => "Y",
            "USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
            "USE_GIFTS_SECTION" => "Y",
            "USE_MAIN_ELEMENT_SECTION" => "N",
            "USE_PRICE_COUNT" => "N",
            "USE_PRODUCT_QUANTITY" => "N",
            "USE_REVIEW" => "N",
            "USE_SALE_BESTSELLERS" => "Y",
            "USE_STORE" => "N",
            "SEF_URL_TEMPLATES" => array(
                "sections" => "",
                "section" => "#SECTION_CODE#/",
                "element" => "#SECTION_CODE#/#ELEMENT_CODE#/",
                "compare" => "compare.php?action=#ACTION_CODE#",
                "smart_filter" => "#SECTION_ID#/filter/#SMART_FILTER_PATH#/apply/",
            ),
            "VARIABLE_ALIASES" => array(
                "compare" => array(
                    "ACTION_CODE" => "action",
                ),
            )
        ),
        false
        );
    
} else if(empty($arParams['URL']) && $arParams['TYPE_LABEL'] == 'coating') {

    
    $arSelectRs = Array('*','PROPERTY_UTP_NAME','PROPERTY_UTP_NOTE','PROPERTY_UTP_TITLE','PROPERTY_UTP_P');
    $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 49, 'ACTIVE'=>'Y', 'CODE' => $arParams['ELEMENT_CODE']], false, Array(), $arSelectRs);
    
    if (intval($db_list_in->SelectedRowsCount()) > 0){
    while($ar_result_in = $db_list_in->GetNext())
    {
        
        $res = CIBlockElement::GetProperty(49, $ar_result_in['ID'], array("sort" => "asc"), Array("CODE"=>"CASE_ITEM"));
        $j=0;
        while ($ob = $res->GetNext()) {
            $arResult['case_item'][$j] = $ob['VALUE'];
            $j++;
        }
        
        
        /*echo "<pre>";
            print_r( $arResult['case_item']);
        echo "</pre>";*/
        
        
        
        $arResult['landing_main_img'] = CFile::GetPath($ar_result_in['PREVIEW_PICTURE']);
        $arResult['landing_second_img'] = CFile::GetPath($ar_result_in['PREVIEW_PICTURE']);
        $arResult['main_text'] = $ar_result_in['PREVIEW_TEXT'];
        $arResult['utp_text'] = $ar_result_in['PROPERTY_UTP_NAME_VALUE'];
        $arResult['utp_note'] = $ar_result_in['PROPERTY_UTP_NOTE_VALUE'];
        $arResult['utp_title'] = $ar_result_in['PROPERTY_UTP_TITLE_VALUE'];
        $arResult['utp_p'] = $ar_result_in['PROPERTY_UTP_P_VALUE'];
            
                /*$arResult['landing_main_img'] = CFile::GetPath($arData['UF_MAINIMG']);
                $arResult['landing_second_img'] = CFile::GetPath($arData['UF_SECONDIMG']);
                $arResult['case_item'] = $arData['UF_CASE_ITEM'];
                $arResult['main_text'] = $arData['UF_MAIN_TEXT'];
                $arResult['utp_text'] = $arData['UF_UTP'];
                $arResult['utp_note'] = $arData['UF_UTP_NOTE'];
                $arResult['utp_title'] = $arData['UF_UTP_TITLE'];
                $arResult['utp_p'] = $arData['UF_UTP_P'];
                $arResult['PUBLISH'] = $arData['UF_PUBLISH'];*/
            
        }
        
    }
    
}



//$arResult['ARRITEMS'] = $arParams['ARRITEMS'];
$this->IncludeComponentTemplate();

?>