<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

require_once $_SERVER["DOCUMENT_ROOT"] .'/local/php_interface/include/Mobile_Detect.php';
$detect = new Mobile_Detect;
$detect->isMobile() || $detect->isTablet() ? $filterTemplate = 'i_horizontal_mobile' /*&& $mobile = 'Y'*/ : $filterTemplate = 'i_horizontal_root';

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$countSubsections = 0;

function GetKomParams($string,$namef) {
    
    $fpos = strpos( $string,$namef);
    if ($fpos !== false){
        $fcutstring = substr($string, $fpos + strlen($namef));
        $spos = strpos( $fcutstring,'/');
        $scutstring = substr($fcutstring, 0, $spos);
        $arrParams = explode("-or-", $scutstring);
        
        if (count($arrParams) == 1){
            return $arrParams[0];
        }
        else {
            return $arrParams;
        }
    }
    else
    {
        return false;
    }
}

$kombox_string = CKomboxFilter::GetCurPageParam();

$_GET['tip_tovara'] = GetKomParams($kombox_string,'tip_tovara-');
$_GET['standart'] = GetKomParams($kombox_string,'standart-');
$_GET['diametr_1'] = GetKomParams($kombox_string,'diametr_1-');
$_GET['dlina_1'] = GetKomParams($kombox_string,'dlina_1-');
$_GET['material_1'] = GetKomParams($kombox_string,'material_1-');
$_GET['measurment'] = GetKomParams($kombox_string,'measurment-');


if (!empty($_GET['tip_tovara'] || $_GET['standart'] || $_GET['diametr_1'] || $_GET['dlina_1'] || $_GET['material_1'] || $_GET['measurment'] )) {$arParams["INCLUDE_SUBSECTIONS"] = "Y"; $isGetFilter = 'Y';} else { $arParams["INCLUDE_SUBSECTIONS"] = "N";}

$pageN = $_GET["PAGEN_1"];

//(CSite::InDir('/catalog/categories/bolt/')) ? $include = "A" : $include = $arParams["INCLUDE_SUBSECTIONS"];
$include = "A";


$_section = (new CIBlockSection)->GetList(
    Array("SORT"=>"ASC"),
    [
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        'CODE' => $arResult['VARIABLES']['SECTION_CODE']
    ]
);

if($_section = $_section->Fetch()){
    //есть ли подразделы?
    $countSubsections = (new CIBlockSection)->GetCount(
        [
            'SECTION_ID' => $_section['ID']
        ]
    );
}

$countElementsInSection = (new CIBlockSection)->GetSectionElementsCount(
    $_section['ID'],
    [
        'CNT_ACTIVE' => 'Y'
    ]
); ?>

<?php


$select = ["UF_TAG_SECTION"];

$sort = ["SORT" => "ASC"];

$filter = [
    'IBLOCK_ID' => 18,
    'UF_TAG_SECTION' => 1,
    'ID' => $_section['ID'],
];

$rsResult = CIBlockSection::GetList($sort,$filter,false,$select);
while($UFResult = $rsResult->GetNext())
{
    if ($UFResult['UF_TAG_SECTION'] == 1){
        $isTagget = 'Y';
    }
}
?>

<div class="content">
    <div class="container">
        <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv-new", array(
            "COMPONENT_TEMPLATE" => "traiv",
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => "s1"
        ),
            false,
            array(
                "ACTIVE_COMPONENT" => "Y"
            )
        ); ?>
        <?// if ($isFilter and !$countSubsections): ?>
        
        <?
if ( $USER->IsAuthorized() )
	{
	    if ($USER->GetID() == '3092') {
	        $rel = "style='position:relative;'";
	    }
	}
	$rel = "style='display:none;'";
	?>
        
        <aside class="aside" <?php echo $rel;?>>
        
        
        <?
if ( $USER->IsAuthorized() )
	{
	    if (/*$USER->GetID() == '3092' || $USER->GetID() == '2743'*/ 1==2 ) {
	        ?>
	        
	        <!-- Filter - start -->
	        <div class="section-sb">
            <div class="section-filter">
                <button id="section-filter-toggle" class="section-filter-toggle" data-close="Hide Filter" data-open="Show Filter">
                    <span>Show Filter</span> <i class="fa fa-angle-down"></i>
                </button>
                <div class="section-filter-cont">
                    <div class="section-filter-price">
                        <div class="range-slider section-filter-price" data-min="0" data-max="1000" data-from="200" data-to="800" data-prefix="" data-grid="false"></div>
                    </div>
                    <div class="section-filter-item opened">
                        <p class="section-filter-ttl">Тип товара <i class="fa fa-angle-down" style="display: block !important;"></i></p>
                        <div class="section-filter-fields">
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox2-1" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox2-1">Болт</label>
                            </p>
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox2-2" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox2-2">Винт</label>
                            </p>
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox2-3" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox2-3">Гайка</label>
                            </p>
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox2-4" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox2-4">Заклепка</label>
                            </p>
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox2-5" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox2-5">Кольцо стопорное</label>
                            </p>
                        </div>
                        <p class="section-filter-ttl-view-all"><a href="#">Показать все...</a></p>
                    </div>
                    <div class="section-filter-item opened">
                        <p class="section-filter-ttl">Стандарт <i class="fa fa-angle-down" style="display: block !important;"></i></p>
                        <div class="section-filter-fields">
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox3-1" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox3-1">DIN 933</label>
                            </p>
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox3-2" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox3-2">DIN 931</label>
                            </p>
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox3-3" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox3-3">DIN 912</label>
                            </p>
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox3-4" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox3-4">DIN 561</label>
                            </p>
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox3-5" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox3-5">DIN 6921</label>
                            </p>
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox3-6" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox3-6">DIN 529</label>
                            </p>
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox3-7" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox3-7">DIN 186</label>
                            </p>
                        </div>
                    </div>

                    <div class="section-filter-item opened">
                        <p class="section-filter-ttl">Диаметр <i class="fa fa-angle-down" style="display: block !important;"></i></p>
                        <div class="section-filter-fields">
                            <div class="section-filter-select">
                                <select data-placeholder="Диаметр" class="chosen-select" multiple>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>10</option>
<option>12</option>
<option>14</option>
<option>16</option>
<option>18</option>
<option>20</option>
<option>22</option>
<option>24</option>
<option>25</option>
<option>27</option>
<option>30</option>
<option>31</option>
<option>33</option>
<option>34</option>
<option>36</option>
<option>39</option>
<option>42</option>
<option>45</option>
<option>48</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-filter-item opened">
                        <p class="section-filter-ttl">Длина <i class="fa fa-angle-down" style="display: block !important;"></i></p>
                        <div class="section-filter-fields">
                            <div class="section-filter-select">
                                <select data-placeholder="Длина" class="chosen-select" multiple>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>10</option>
<option>12</option>
<option>14</option>
<option>16</option>
<option>18</option>
<option>20</option>
<option>22</option>
<option>24</option>
<option>25</option>
<option>27</option>
<option>30</option>
<option>31</option>
<option>33</option>
<option>34</option>
<option>36</option>
<option>39</option>
<option>42</option>
<option>45</option>
<option>48</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="section-filter-item opened">
                        <p class="section-filter-ttl">Материал <i class="fa fa-angle-down" style="display: block !important;"></i></p>
                        <div class="section-filter-fields">
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox4-1" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox4-1">5.6</label>
                            </p>
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox4-2" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox4-2">8.8</label>
                            </p>
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox4-3" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox4-3">10.9</label>
                            </p>
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox4-4" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox4-4">12.9</label>
                            </p>
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox4-5" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox4-5">полиамид</label>
                            </p>
                        </div>
                    </div>
                    <div class="section-filter-item opened">
                        <p class="section-filter-ttl">Система измерения крепежа <i class="fa fa-angle-down" style="display: block !important;"></i></p>
                        <div class="section-filter-fields">
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox5-1" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox5-1">Дюймовая</label>
                            </p>
                            <p class="section-filter-field">
                                <input id="section-filter-checkbox5-2" value="on" type="checkbox">
                                <label class="section-filter-checkbox" for="section-filter-checkbox5-2">Метрическая</label>
                            </p>
                        </div>
                    </div>

                    <div class="section-filter-buttons">
                        <input class="btn btn-themes" id="set_filter" name="set_filter" value="Применить" type="button">
                    </div>
                </div>
            </div>
            </div>
            <!-- Filter - end -->
	        
	        <?php 
	    }
	}
	?>   




            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "catalog_left_menu",
                array(
                    "COMPONENT_TEMPLATE" => "catalog_left_menu",
                    "ROOT_MENU_TYPE" => "catalog_left_menu",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "MENU_CACHE_GET_VARS" => "",
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N",
                    "CACHE_SELECTED_ITEMS" => "N",
                    "MENU_CACHE_USE_USERS" => "N",
                ),
                false
            ); ?>

            <!--<div class="u-none--m">-->
                <? if (SHOW_VK_WIDGET): // task: replace vk widget with side menu ?>
                <!--	<script type="text/javascript" src="//vk.com/js/api/openapi.js?127"></script>
                    <div id="vk_groups"></div>
                    <script type="text/javascript">
                        VK.Widgets.Group(
                            "vk_groups",
                            {
                                redesign: 1,
                                mode: 4,
                                width: "auto",
                                height: "400",
                                color1: 'FFFFFF',
                                color2: '000000',
                                color3: '5E81A8'
                            },
                            47382243);
                    </script> -->
                    
                    
                    <?
if ( $USER->IsAuthorized() )
	{
	    if ($USER->GetID() == '3092') {
	        //$left_menu_tpl = /*"traiv_vertical_multilevel_2021"*/"this";
	        $left_menu_tpl = "traiv_vertical_multilevel_2020-hiden";
	    }
	    else {
	        $left_menu_tpl = "traiv_vertical_multilevel_2020-hiden";
	    }
	}
	else 
	{
	    $left_menu_tpl = "traiv_vertical_multilevel_2020-hiden";
	}
	?>
                    
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    $left_menu_tpl,
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "COMPONENT_TEMPLATE" => $left_menu_tpl,
                        "DELAY" => "N",
                        "MAX_LEVEL" => "2",
                        "MENU_CACHE_GET_VARS" => "",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_USE_GROUPS" => "N",
                        "ROOT_MENU_TYPE" => "left",
                        "USE_EXT" => "Y",
                        "CACHE_SELECTED_ITEMS" => "N",
                        "MENU_CACHE_USE_USERS" => "N",
                    ),
                    false
                );?>



                <? //endif ?>

            <!--</div>-->
        </aside>
    <? endif; //isFilter?>
    <!-- class="spaced-left" -->
        <main>
            <section class="section">
            
            <?
	        if(CSite::InDir('/catalog/')){
	            echo "<div class='stf_filter' rel='1'><i class='icofont icofont-filter'></i><span class='stf_filter_title'></span></div>";
	        }
	?>

                <?//form for empty items categories

                If ($countElementsInSection == 0 and $countSubsections == 0 and $isTagget != 'Y'){
                    ?>
                    <div class="Order_one_click" >
                        <a href="#w-form" rel="nofollow" class="w-form__orange-btn">Оформить запрос<?//echo $ButtonName?></a>
                        <div id='callback-form' class="popup-dialog mfp-hide">
                            <?$APPLICATION->IncludeComponent(  // That's fix header cart somehow...
                                "bitrix:form.result.new",
                                "one_click_catalog_default",
                                array(
                                    "NAME" => "Заказать в 1 клик ",
                                    "COMPONENT_TEMPLATE" => "one_click_catalog_default",
                                    "ELEMENT_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                                    "WEB_FORM_ID" => "10",
                                    "IGNORE_CUSTOM_TEMPLATE" => "Y",
                                    "USE_EXTENDED_ERRORS" => "Y",
                                    "SEF_MODE" => "N",
                                    "CACHE_TYPE" => "A",
                                    "CACHE_TIME" => "3600",
                                    "LIST_URL" => "",
                                    "EDIT_URL" => "",
                                    "SUCCESS_URL" => "/success.php",
                                    "CHAIN_ITEM_TEXT" => "",
                                    "CHAIN_ITEM_LINK" => "",
                                    "COMPOSITE_FRAME_MODE" => "A",
                                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                                    "VARIABLE_ALIASES" => array(
                                        "WEB_FORM_ID" => "WEB_FORM_ID",
                                        "RESULT_ID" => "RESULT_ID",
                                    )
                                ),
                                false
                            );?>

                        </div>
                    </div>
                    <?
                }
                ?>

                <div class='subsection'>
                    <?
                    $pageurl = ($countSubsections > 0) ? '/catalog/' : '';
                    $APPLICATION->IncludeComponent(
                        "kombox:filter",
                        $filterTemplate,
                        array(
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "FILTER_NAME" => $arParams["FILTER_NAME"],
                            "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                            "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                            "HIDE_NOT_AVAILABLE" => "N",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            "CACHE_GROUPS" => "N",
                            "SAVE_IN_SESSION" => "N",
                            "INCLUDE_JQUERY" => "Y",
                            "MESSAGE_ALIGN" => "LEFT",
                            "MESSAGE_TIME" => "0",
                            "IS_SEF" => "N",
                            "CLOSED_PROPERTY_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "CLOSED_OFFERS_PROPERTY_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "SORT" => "N",
                            "FIELDS" => array(
                            ),
                            "PRICE_CODE" => array(
                            ),
                            "CONVERT_CURRENCY" => "N",
                            "CURRENCY_ID" => $arParams["CURRENCY_ID"],
                            "XML_EXPORT" => "Y",
                            "SECTION_TITLE" => "NAME",
                            "SECTION_DESCRIPTION" => "DESCRIPTION",
                            "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                            "COMPONENT_TEMPLATE" => "i_horizontal_root",
                            "PAGE_URL" =>  "",
                            "COLUMNS" => "1",
                            "STORES_ID" => array(
                            )
                        ),
                        false
                    );

                    //sotbit seometa component start
                    //if ($USER->GetID() == '3092' || $USER->GetID() == '2743') {
                    $APPLICATION->IncludeComponent(
                    "sotbit:seo.meta",
                    ".default",
                    Array(
                    "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    )
                    );
                    //}
                    //sotbit seometa component end
                    
                    ?>
                    <?
                    //if ($USER->GetID() == '3092' || $USER->GetID() == '2743') {
                    global $sotbitSeoMetaTitle;
                    global $sotbitSeoMetaKeywords;
                    global $sotbitSeoMetaDescription;
                    global $sotbitSeoMetaBreadcrumbTitle;
                    global $sotbitSeoMetaH1;
                    global $sotbitSeoMetaTopDesc;
                    global $sotbitSeoMetaFile;
                    //}

                    $arFilter = Array("IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"], "IBLOCK_ID" => $arParams["IBLOCK_ID"], "CODE" => $arResult["VARIABLES"]["SECTION_CODE"], "ID" => $arResult["VARIABLES"]["SECTION_ID"]);
                    $arSelect = Array('UF_PREVIEW_TEXT', 'NAME', 'DESCRIPTION', 'UF_TERM', 'UF_LONGTEXT', 'UF_COUNTER', 'PICTURE');
                    $db_list = CIBlockSection::GetList(Array(), $arFilter, true, $arSelect);
                    if ($section = $db_list->GetNext()) {


                        $SectPict=CFile::GetFileArray($section["PICTURE"]);

                        $widthsizen="140";
                        $heightsizen="140";

                        $SectPictResize = CFile::ResizeImageGet(
                            $SectPict,
                            array("width" => $widthsizen, "height" => $heightsizen),
                            BX_RESIZE_IMAGE_PROPORTIONAL,
                            true, $arFilter
                        );

                        $SectPict = array(
                            'SRC' => $SectPictResize["src"],
                            'WIDTH' => $SectPictResize["width"],
                            'HEIGHT' => $SectPictResize["height"],
                        );

                        $SECTION_ID = $_section["ID"];

                        $IBLOCK_ID = 18;

                        $ipropSectionValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($IBLOCK_ID, $SECTION_ID);
                        $arSEO = $ipropSectionValues->getValues();


                        
                        if (!empty($section["~UF_PREVIEW_TEXT"]) && !$isGetFilter && !$pageN && empty($sotbitSeoMetaH1)){

                            (CSite::InDir('/catalog/rasprodazha_so_sklada/')) ? $flag = 'sale': $flag = '';
                            ?><div class="section_description <?=$flag?>">

                            <h1 class="section_title"><?=$arSEO["SECTION_PAGE_TITLE"]?></h1>
                            <? if ($SectPict['SRC']):?>
                                <img class="TitleImg <?=$flag?>" src="<?= $SectPict['SRC'] ?>" alt="<?= $section['NAME'] ?>" title="<?='Фото '.$section['NAME'] ?>">
                            <? endif; ?>
                            <?echo $section["~UF_PREVIEW_TEXT"] ?>

                            </div>
                            <?
                        } else if ($isGetFilter && !empty($sotbitSeoMetaH1)) {
                            ?>
                            <div class="section_description">
                            	<h1 class="section_title" rel="3"><? $APPLICATION->ShowTitle(false) ?></h1>
                            	
                            	<? /*if ($sotbitSeoMetaFile):*/?>
                            	<div class="TitleImgSeo">
                            	<? /*echo $sotbitSeoMetaFile;*/ ?>
                            	<?php echo $sotbitSeoMetaTopDesc;?>
                            	</div>
                            	
                            	
                            	
                            <? //endif; ?>
                            	
                            </div>
                            <?php 
                        } else { ?>
                            <h1 class="section_title"><?=$pageN ? $arSEO["SECTION_PAGE_TITLE"].' - Страница '.$pageN : $arSEO["SECTION_PAGE_TITLE"]?></h1>
                            <?
                            
                            
                        }

                        // $s = CIBlockElement::GetByID($section['UF_TERM']);
                        // if($s = $s->GetNext()){
                        ?>
                        <!--  <script>
                                       // $('.crumbs__item.is-active').append('&nbsp;<a target="_blank" href="<?//=$s['DETAIL_PAGE_URL']?>"><i class="fa fa-question-circle" aria-hidden="true"></i></a>');
                                    </script> -->
                        <?

                        //   }

                    }


                    ?>


                    <?
                    if($_REQUEST["catalog_items_in_list"]=="y"){
                        $_SESSION["catalog_items_in_list"]="y";
                    }elseif($_REQUEST["catalog_items_in_list"]=="n"){
                        $_SESSION["catalog_items_in_list"]="n";
                    }else{
                        if(empty($_SESSION["catalog_items_in_list"])){
                            $_SESSION["catalog_items_in_list"]="y";
                        }
                    }


                    if($_REQUEST["measurment"]=="metricheskaya"){
                        $_SESSION["measurment"]="metricheskaya";
                    }elseif($_REQUEST["measurment"]=="dyuymovaya"){
                        $_SESSION["measurment"]="dyuymovaya";
                    }
                    $_SESSION["measurment"]="";






                    if(!empty($_REQUEST["PAGE_COUNT"]) && $_REQUEST["PAGE_COUNT"]<100){
                        $arParams["PAGE_ELEMENT_COUNT"]=$_SESSION["PAGE_COUNT"]=$_REQUEST["PAGE_COUNT"];
                    }
                    if(!empty($_SESSION["PAGE_COUNT"])) {
                        $arParams["PAGE_ELEMENT_COUNT"] = $_SESSION["PAGE_COUNT"];
                    }




                    /*$_SESSION["catalog_items_in_list"]="y";*/

                    if($_SESSION["catalog_items_in_list"]=="n"){
                        $template = "items_list_2020";
                    }else if ($_SESSION["catalog_items_in_list"]=="y"){
                        $template = "items_list_line_2020";
                    } else {
                        $template = "items_list_line_2020";
                    }



                    if(!$isGetFilter && $countSubsections > 0 || $isTagget == 'Y') {
                        //показ подкатегорий
                        if(!($_REQUEST['PAGEN_1'] > 1)){
                            $APPLICATION->IncludeComponent(
                                "bitrix:catalog.section.list",
                                "catalog_page-2020",
                                array(
                                    "SHOW_ALL_WO_SECTION" => $include,
                                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                    "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
                                    "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
                                    "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                                    "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                                    "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                                    "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                                    "ADD_SECTIONS_CHAIN" => 'N',//(isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
                                    "SECTION_ID" => CIBlockFindTools::GetSectionID(
                                        $arResult["VARIABLES"]["SECTION_ID"],
                                        $arResult["VARIABLES"]["SECTION_CODE"],
                                        array("IBLOCK_ID" => $arParams["IBLOCK_ID"])
                                    ),
                                    "SECTION_USER_FIELDS" => array(
                                        0 => "UF_TAG_SECTION",
                                        1 => "UF_TAG_LINK",
                                    ),
                                ),
                                $component
                            );
                        }
                    }

                    if (/*$countSubsections == 0 and */$countElementsInSection > 0  and $isTagget != 'Y'):



                        if(explode('/', $APPLICATION->GetCurDir())[1] == 'catalog' or explode('/', $APPLICATION->GetCurDir())[1] == 'services'){ ?> <!-- ??? -->
                            <div class="session-buttons">
                                <div class="measurment_view col x3d4">

                                    <div class="measurment__item <?if($_SESSION["measurment"]=="metricheskaya") echo "is-active";?>" style="display: none">
                                        <a title="Метрический" class='pagination__link' href='<?=$APPLICATION->GetCurPageParam("measurment=metricheskaya",array('measurment' ), false); ?>'><span class="measurment-title">Метрический</span> </a>
                                    </div>
                                    <div class="measurment__item <?if($_SESSION["measurment"]=="dyuymovaya") echo "is-active";?>" style="display: none">
                                        <a title="Дюймовый" class='pagination__link' href='<?=$APPLICATION->GetCurPageParam("measurment=dyuymovaya",array('measurment'), false); ?>'><span class="measurment-title">Дюймовый</span></a>
                                    </div>

                                </div>

                                <div class="pagination_view col x1d5">
                                    <div class="pagination__item col x1d2 <?if($_SESSION["catalog_items_in_list"]=="y") echo "is-active";?>">
                                        <a title="Список" class='pagination__link' href='<?=$APPLICATION->GetCurPageParam("catalog_items_in_list=y",array("catalog_items_in_list")); ?>'><img src="/img/ico/tile-4.png" ></a>
                                    </div>
                                    <div class="pagination__item col x1d2 <?if($_SESSION["catalog_items_in_list"]=="n") echo "is-active";?>">
                                        <a title="Плитка" class='pagination__link' href='<?=$APPLICATION->GetCurPageParam("catalog_items_in_list=n",array("catalog_items_in_list")); ?>'><img src="/img/ico/list-4.png" ></a>
                                    </div>
                                </div>
                            </div>


                        <? }

                    endif;

                    if ($_POST['AJAX_MODE']=='Y') $APPLICATION->RestartBuffer();

                    /*If ($countSubsections > 0){
                        $template = "items_list_2020";
                    }*/

                    If ($isGetFilter == 'Y' && $_SESSION["catalog_items_in_list"]=="y"){
                        $template = "items_list_line_2020";
                    } elseif ($isGetFilter == 'Y' && $_SESSION["catalog_items_in_list"]=="n"){
                        $template = "items_list_2020";
                    }


                    if ($countSubsections){
                        $sortFieldOne = 'propertysort_TIP_TOVARA';
                        $sortOrderOne = 'ASC';
                        $sortFieldTwo = 'shows';
                        $sortOrderTwo = 'ASC';
                    } else {
                        $sortFieldOne = 'PROPERTY_636';
                        $sortOrderOne = 'DESC';
                        $sortFieldTwo = array('PROPERTY_612', 'PROPERTY_613');
                        $sortOrderTwo = 'ASC';
                    }
                    
                    if ( $USER->IsAuthorized() )
                    {
                        if ($USER->GetID() == '3092') {
                            $sortFieldOne = 'CATALOG_QUANTITY';
                            $sortOrderOne = 'DESC';
                            $sortFieldTwo = array('property_EUROPE_STORAGE');
                            $sortOrderTwo = 'DESC, nulls';
                        }
                        else {
                            $sortFieldOne = 'CATALOG_QUANTITY';
                            $sortOrderOne = 'DESC';
                            $sortFieldTwo = array('PROPERTY_644');
                            $sortOrderTwo = 'DESC';
                        }
                    }
                    else {
                        $sortFieldOne = 'CATALOG_QUANTITY';
                        $sortOrderOne = 'DESC';
                        $sortFieldTwo = array('PROPERTY_644');
                        $sortOrderTwo = 'DESC';
                    }
                    
                            

                    

                    $intSectionID = $APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        $template,
                        array(
                            "SHOW_ALL_WO_SECTION" => $include,
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "ELEMENT_SORT_FIELD" => $sortFieldOne,
                            "ELEMENT_SORT_ORDER" => $sortOrderOne,
                            "ELEMENT_SORT_FIELD2" => $sortFieldTwo,
                            "ELEMENT_SORT_ORDER2" => $sortOrderTwo,
                            "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                            "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                            "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                            "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                            "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                            "INCLUDE_SUBSECTIONS" => $include,
                            "BASKET_URL" => $arParams["BASKET_URL"],
                            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                            "FILTER_NAME" => $arParams["FILTER_NAME"],
                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                            "SET_TITLE" => $arParams["SET_TITLE"],
                            "MESSAGE_404" => $arParams["MESSAGE_404"],
                            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                            "SHOW_404" => $arParams["SHOW_404"],
                            "FILE_404" => $arParams["FILE_404"],
                            "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                            "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                            "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                            "PRICE_CODE" => $arParams["PRICE_CODE"],
                            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                            "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                            "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                            "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

                            "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                            "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                            "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                            "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                            "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                            "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                            "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                            "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

                            "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                            "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                            "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                            "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                            "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                            "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                            "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                            "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

                            "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                            "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                            "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                            "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
                            "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                            'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                            'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                            'SECTION_USER_FIELDS' => array(0 => 'UF_CANONICAL', 1 => '',),
                            'LABEL_PROP' => $arParams['LABEL_PROP'],
                            'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                            'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

                            'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                            'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                            'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                            'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
                            'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
                            'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
                            'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
                            'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

                            'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                            "ADD_SECTIONS_CHAIN" => $arParams['ADD_SECTIONS_CHAIN'],
                            'ADD_TO_BASKET_ACTION' => $basketAction,
                            'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                            'COMPARE_PATH' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
                            'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
                            'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
                            "CUSTOM_COUNT_SUBSECTIONS" => $countSubsections
                        ),
                        $component
                    );


                    if ($_POST['AJAX_MODE']=='Y') die();

                    ?>

            <? /*$APPLICATION->IncludeComponent("bitrix:news.list", "catalog_partners", Array(
				"COMPONENT_TEMPLATE" => ".default",
				"IBLOCK_TYPE" => "content", // Тип информационного блока (используется только для проверки)
				"IBLOCK_ID" => "8", // Код информационного блока
				"NEWS_COUNT" => "20", // Количество новостей на странице
				"SORT_BY1" => "SORT", // Поле для первой сортировки новостей
				"SORT_ORDER1" => "ASC", // Направление для первой сортировки новостей
				"SORT_BY2" => "ACTIVE_FROM",  // Поле для второй сортировки новостей
				"SORT_ORDER2" => "DESC",  // Направление для второй сортировки новостей
				"FILTER_NAME" => "",  // Фильтр
				"FIELD_CODE" => array(  // Поля
					0 => "",
					1 => "",
				),
				"PROPERTY_CODE" => array( // Свойства
					0 => "",
					1 => "",
				),
				"CHECK_DATES" => "Y", // Показывать только активные на данный момент элементы
				"DETAIL_URL" => "", // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
				"AJAX_MODE" => "N", // Включить режим AJAX
				"AJAX_OPTION_JUMP" => "N",  // Включить прокрутку к началу компонента
				"AJAX_OPTION_STYLE" => "N", // Включить подгрузку стилей
				"AJAX_OPTION_HISTORY" => "N", // Включить эмуляцию навигации браузера
				"AJAX_OPTION_ADDITIONAL" => "", // Дополнительный идентификатор
				"CACHE_TYPE" => "A",  // Тип кеширования
				"CACHE_TIME" => "36000000", // Время кеширования (сек.)
				"CACHE_FILTER" => "N",  // Кешировать при установленном фильтре
				"CACHE_GROUPS" => "Y",  // Учитывать права доступа
				"PREVIEW_TRUNCATE_LEN" => "", // Максимальная длина анонса для вывода (только для типа текст)
				"ACTIVE_DATE_FORMAT" => "d.m.Y",  // Формат показа даты
				"SET_TITLE" => "N", // Устанавливать заголовок страницы
				"SET_BROWSER_TITLE" => "N", // Устанавливать заголовок окна браузера
				"SET_META_KEYWORDS" => "N", // Устанавливать ключевые слова страницы
				"SET_META_DESCRIPTION" => "N",  // Устанавливать описание страницы
				"SET_LAST_MODIFIED" => "N", // Устанавливать в заголовках ответа время модификации страницы
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N", // Включать инфоблок в цепочку навигации
				"ADD_SECTIONS_CHAIN" => "N",  // Включать раздел в цепочку навигации
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",  // Скрывать ссылку, если нет детального описания
				"PARENT_SECTION" => "", // ID раздела
				"PARENT_SECTION_CODE" => "",  // Код раздела
				"INCLUDE_SUBSECTIONS" => "Y", // Показывать элементы подразделов раздела
				"DISPLAY_DATE" => "N",  // Выводить дату элемента
				"DISPLAY_NAME" => "Y",  // Выводить название элемента
				"DISPLAY_PICTURE" => "Y", // Выводить изображение для анонса
				"DISPLAY_PREVIEW_TEXT" => "N",  // Выводить текст анонса
				"PAGER_TEMPLATE" => ".default", // Шаблон постраничной навигации
				"DISPLAY_TOP_PAGER" => "N", // Выводить над списком
				"DISPLAY_BOTTOM_PAGER" => "N",  // Выводить под списком
				"PAGER_TITLE" => "Новости", // Название категорий
				"PAGER_SHOW_ALWAYS" => "N", // Выводить всегда
				"PAGER_DESC_NUMBERING" => "N",  // Использовать обратную навигацию
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000", // Время кеширования страниц для обратной навигации
				"PAGER_SHOW_ALL" => "N",  // Показывать ссылку "Все"
				"PAGER_BASE_LINK_ENABLE" => "N",  // Включить обработку ссылок
				"SET_STATUS_404" => "N",  // Устанавливать статус 404
				"SHOW_404" => "N",  // Показ специальной страницы
				"MESSAGE_404" => "",  // Сообщение для показа (по умолчанию из компонента)
			),
				false
			); */?>

            <?if($section["DESCRIPTION"] && !$isGetFilter  && !$pageN){?>
            <article class="article">
                <?=$section["DESCRIPTION"];?>

                <?
                If ($section["UF_LONGTEXT"] && !$isGetFilter  && !$pageN){
                    echo $section["~UF_LONGTEXT"]; ?>
                <?}?>
                <br><span class="social_share_2020">
            <div data-mobile-view="true" data-share-size="30" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1889365" data-mode="share" data-background-color="#ffffff" data-hover-effect="scale" data-share-shape="round-rectangle" data-share-counter-size="12" data-icon-color="#ffffff" data-mobile-sn-ids="vk.mr.fb.ok.tw.wh.tm.vb." data-text-color="#000000" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-type="disable" data-orientation="horizontal" data-following-enable="false" data-sn-ids="vk.mr.ok.fb.tw.wh.tm.vb." data-preview-mobile="false" data-selection-enable="true" data-exclude-show-more="true" data-share-style="2" data-counter-background-alpha="1.0" data-top-button="true" class="uptolike-buttons" ></div>
            </span>
                <p class="CopyWarning">
<!-- 
                    Материалы подготовлены специалистами компании «Трайв-Комплект».<br>
                    При копировании текстов и других материалов сайта - указание ссылки на сайт www.traiv-komplekt.ru обязательно!
-->
                </p>
                <?}?>
                <div class="counter_one">
                    <?//show counter from counter.php

                    echo 'Просмотров: '.$section['UF_COUNTER'];

                    ?>

                </div>
            </article>


                </div>
            </section>
        </main>
    </div>
</div>


<?php


If ($isGetFilter):
    if (!$_GET['measurment']):

    function Lat2ru($string)
    {
        $rus = ['ё','ж','ц','ч','ш','щ','ю','я','Ё','Ж','Ц','Ч','Ш','Щ','Ю','Я'];

        $lat = ['yo','zh','tc','ch','sh','sh','yu','ya','YO','ZH','TC','CH','SH','SH','YU','YA'];
        $string = str_replace($lat,$rus,$string);

        $rus = [
            'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
            'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
            'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
            'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я', ' '
        ];
        $lat = [
            'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya',
            'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P',
            'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya', '_'
        ];
        $string = str_replace($lat, $rus, $string);
        return($string);
    }

    if (is_array($_GET['diametr_1'])){
        $resultstr = array();
        foreach ($_GET['diametr_1'] as $item) {$resultstr[] = 'M'.$item;}
        $diametr = implode(", ",$resultstr);
    }elseif (isset($_GET['diametr_1'])){$diametr = htmlspecialchars('M'.$_GET['diametr_1']);}

    if (is_array($_GET['dlina_1'])){
        $resultstr = array();
        foreach ($_GET['dlina_1'] as $item) {$resultstr[] = $item;}
        $dlina = implode(", ",$resultstr);
    }else{$dlina = htmlspecialchars($_GET['dlina_1']);}

    if (is_array($_GET['tip_tovara'])){
        $resultstr = array();
        foreach ($_GET['tip_tovara'] as $item) {$resultstr[] = Lat2ru(htmlspecialchars($item));}
        $tip_tovara = implode(", ",$resultstr);
    }else{$tip_tovara = Lat2ru(htmlspecialchars($_GET['tip_tovara']));}

    if (is_array($_GET['standart'])){
        $resultstr = array();
        foreach ($_GET['standart'] as $item) {$resultstr[] = str_replace('_',' ',htmlspecialchars(strtoupper($item)));}
        $standart = implode(", ",$resultstr);
    }else{$standart = str_replace('_',' ',htmlspecialchars(strtoupper($_GET['standart'])));}

    if (is_array($_GET['material_1'])){
        $resultstr = array();
        foreach ($_GET['material_1'] as $item) {
            $item = Lat2ru(htmlspecialchars($item));
            in_array($item, ['стал', 'латун', 'мед']) && $item = $item.'ь';
            $resultstr[] = $item;}
        $material = implode(", ",$resultstr);
    }else{$material = Lat2ru(htmlspecialchars($_GET['material_1']));
        in_array($material, ['стал', 'латун', 'мед']) && $material = $material.'ь';}

    if (!empty($diametr) & !empty ($dlina)) {$razmer = $diametr.' x '. $dlina ;}
    else
    {
        if (!empty($diametr)) $razmer = $diametr;
        if (!empty($dlina)) $razmer = $dlina;
    };

    ($diametr && !$dlina && !$tip_tovara && !$standart && !$material) && $razmer = 'Крепёж с диаметром '.$razmer;
    (!$diametr && $dlina && !$tip_tovara && !$standart && !$material) && $razmer = 'Крепёж с длиной '.$razmer;
    (!$diametr && !$dlina && !$tip_tovara && !$standart && $material) && $material = 'Крепёж из материала '.$material;

    $seoArr = array($tip_tovara, $standart, $razmer, $material);


    $seotitle = implode(" ",array_filter($seoArr)).', продажа в Санкт-Петербурге (СПБ) и в Москве (МСК)';

    $seotitle = mb_strtoupper(mb_substr($seotitle, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($seotitle, 1, mb_strlen($seotitle), 'UTF-8');

    $APPLICATION->SetPageProperty('title', $seotitle);
//$APPLICATION->SetPageProperty('keywords', $seotitle);
    $APPLICATION->SetPageProperty('description', $seotitle.', оптом и в розницу, в наличии и на заказ по низкой цене! Звоните!');

    endif;
    endif;

If ($pageN):
    $oldtitle = $APPLICATION->GetPageProperty("title");
    $APPLICATION->SetPageProperty('title', $oldtitle.' - Страница '.$pageN);

    $olddescription = $APPLICATION->GetPageProperty("description");
    $APPLICATION->SetPageProperty('description', $olddescription.' - Страница '.$pageN);
endif;
?>

<?//sotbit seometa meta start
//if ($USER->GetID() == '3092' || $USER->GetID() == '2743') {
if(!empty($sotbitSeoMetaH1))
{
$APPLICATION->SetTitle($sotbitSeoMetaH1);
}
if(!empty($sotbitSeoMetaTitle))
{
    $APPLICATION->SetPageProperty("title", $sotbitSeoMetaTitle);
}

if(!empty($sotbitSeoMetaDescription))
{
$APPLICATION->SetPageProperty("description", $sotbitSeoMetaDescription);
}
if(!empty($sotbitSeoMetaBreadcrumbTitle) ) {
$APPLICATION->AddChainItem($sotbitSeoMetaBreadcrumbTitle  );
}
//}
//sotbit seometa meta end ?>