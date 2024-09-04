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
$_REQUEST['measurment'] = $_GET['measurment'];
$_GET['measurment'] = GetKomParams($kombox_string,'measurment-');


if (!empty($_GET['tip_tovara'] || $_GET['standart'] || $_GET['diametr_1'] || $_GET['dlina_1'] || $_GET['material_1'] || $_GET['measurment'] )) {$arParams["INCLUDE_SUBSECTIONS"] = "Y"; $isGetFilter = 'Y';} else { $arParams["INCLUDE_SUBSECTIONS"] = "N";}

$pageN = $_GET["PAGEN_1"];

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

<section id="content">

    <div class="container">
        <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv-new-wl", array(
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
        
        <div class="row">
        	<div class="col-12 col-xl-3 col-lg-3 col-md-3">
        	
        	
        	<!-- Catalog Left Menu -->
        	<div class="catalog_left_block d-none d-lg-block">
        	<div class="catalog_left_block_title">Категории</div>
        	
        	      <?
        	      $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section.list",
                    "catalog_parents_left_menu",
                    Array(
                        "ADD_SECTIONS_CHAIN" => "N",
                        "CACHE_GROUPS" => "N",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "COMPONENT_TEMPLATE" => "main_page_catalog",
                        "COUNT_ELEMENTS" => "Y",
                        "IBLOCK_ID" => "18",
                        "IBLOCK_TYPE" => "catalog",
                        "SECTION_CODE" => "",
                        "SECTION_FIELDS" => array(0=>"",1=>"",),
                        "SECTION_ID" => "106",
                        "SECTION_URL" => "",
                        "SECTION_USER_FIELDS" => array(0=>"",1=>"",),
                        "SHOW_PARENT_NAME" => "Y",
                        "TOP_DEPTH" => "1",
                        "VIEW_MODE" => "LINE"
                    )
                );?>
        	</div>
        	<!-- end Catalog Left Menu -->
                <?php if(!$detect->isMobile() && !$detect->isTablet()): ?>
        	<!-- Start Filter -->
        	        <?  
	        $APPLICATION->IncludeComponent(
	"kombox:filter", 
	"vertical_left", 
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
		"COMPONENT_TEMPLATE" => "vertical_left",
		"PAGE_URL" => "",
		"COLUMNS" => "1",
		"STORES_ID" => array(
		),
		"THEME" => "red",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);
	        //if ($USER->GetID() == '3092' || $USER->GetID() == '2743') {
	        //sotbit seometa component start
	        /*$APPLICATION->IncludeComponent(
	        "sotbit:seo.meta",
	        ".default",
	        Array(
	        "FILTER_NAME" => $arParams["FILTER_NAME"],
	        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
	        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
	        "CACHE_TIME" => $arParams["CACHE_TIME"],
	        )
	        );*/
	        //}
	        //sotbit seometa component end
	        
?>
        	<!-- end Filter -->
        	<?php endif; ?>

        	</div>
        	<div class="col-12 col-xl-9 col-lg-9 col-md-9">
        	<!-- <div class="row"> -->
    
    <!-- Content -->        
            <?
	        if(CSite::InDir('/catalog/')){
	            //echo "<div class='stf_filter'><i class='icofont icofont-filter'></i><span class='stf_filter_title'></span></div>";
	        }
	?>

                <?//form for empty items categories

              /*  If ($countElementsInSection == 0 and $countSubsections == 0 and $isTagget != 'Y'){
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
                }*/
                ?>
                <div class='row'>
                
                    <?
                    global $sotbitSeoMetaTitle;
                    global $sotbitSeoMetaKeywords;
                    global $sotbitSeoMetaDescription;
                    global $sotbitSeoMetaBreadcrumbTitle;
                    global $sotbitSeoMetaH1;
                    global $sotbitSeoMetaTopDesc;
                    global $sotbitSeoMetaFile;
                    
                    $arFilter = Array("IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"], "IBLOCK_ID" => $arParams["IBLOCK_ID"], "CODE" => $arResult["VARIABLES"]["SECTION_CODE"], "ID" => $arResult["VARIABLES"]["SECTION_ID"]);
                    $arSelect = Array('UF_PREVIEW_TEXT', 'UF_BANNER_CATEGORY', 'NAME', 'DESCRIPTION', 'UF_TERM', 'UF_LONGTEXT', 'UF_COUNTER','UF_GIPOT','PICTURE');
                    $db_list = CIBlockSection::GetList(Array(), $arFilter, true, $arSelect);
                    
                    
                    if ($section = $db_list->GetNext()) {
                        
                        $SectPict=CFile::GetFileArray($section["PICTURE"]);
                        $checkGipot = $section["UF_GIPOT"];
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
                            
                            //(CSite::InDir('/catalog/rasprodazha_so_sklada/')) ? $flag = 'sale': $flag = '';
                            ?>

<div class="col-12 col-xl-10 col-lg-10 col-md-10">
<h1><span><?=$arSEO["SECTION_PAGE_TITLE"]?></span></h1>
</div>
                            <? 
                        } else { ?>
                            <!-- <h1 class="section_title_n"><?/*=$pageN ? $arSEO["SECTION_PAGE_TITLE"].' - Страница '.$pageN : $arSEO["SECTION_PAGE_TITLE"]*/?></h1>-->
                            
<div class="col-12 col-xl-10 col-lg-10 col-md-10">
<h1><span><?=$pageN ? $arSEO["SECTION_PAGE_TITLE"].' - Страница '.$pageN : $arSEO["SECTION_PAGE_TITLE"]?></span></h1>
</div>
                            
                            <?
                            
                            
                        }
                    }
                    ?>
                     <div class="col-12 pb-3" id="slider_catalog_page">
                     <?php 
                     
                     $hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(9)->fetch();
                     
                     $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
                     $entity_data_class = $entity->getDataClass();
                     
                    $data = $entity_data_class::getList(array(
                         "select" => array("*"),
                         "filter" => array('UF_BANNER_CATALOG' => $arResult["VARIABLES"]["SECTION_ID"])
                     ));
                     
                     //echo intval($data->getSelectedRowsCount());

                     if (intval($data->getSelectedRowsCount()) > 0){
                         while($arData = $data->Fetch()){
                             
                             if (!empty($arData['UF_BANNER_LINK'])){
                                 $toLink = $arData['UF_BANNER_LINK'];
                             } else {
                                 $toLink = '#';
                             }
                             $num_slider_cat = count($arData['UF_BANNERIMAGE']);
                             
                             if ($num_slider_cat == 1) {
                             
                                 foreach ($arData['UF_BANNERIMAGE'] as $item) {
                                         $b_item_img = CFile::GetPath($item);
                                         ?>
                                 <a href="<?php echo $toLink;?>"><img src="<?php echo $b_item_img;?>" class="img-responsive" style="width:100%;"></a>
                                 <?php
                                 }
                                 
                             } else {
                                 ?>
                                 <div class="bxslider_catalog">
                                 <?php
                                 $uri = $APPLICATION->GetCurPage();
                                 
                                 if (empty($_COOKIE['catban']) && empty($_SESSION['catban'])){
                                     setcookie("catban", 1, time()+60*60*24*30, "$uri", "traiv-komplekt.ru", 1);
                                     $_SESSION['catban'] = 1;
                                 }
                                 
                                 if (!empty($_COOKIE['catban']) && empty($_SESSION['catban'])){
                                     
                                     if (count($arData['UF_BANNERIMAGE']) == $_COOKIE['catban']){
                                         setcookie("catban", 1, time()-10, "$uri", "traiv-komplekt.ru", 1);
                                         $_SESSION['catban'] = 1;
                                     } else {
                                         $newBan = $_COOKIE['catban'] + 1;
                                         setcookie("catban", $newBan, time()+60*60*24*30, "$uri", "traiv-komplekt.ru", 1);
                                         $_SESSION['catban'] = $newBan;
                                     }
                                 }
                                 
                                 $i=1;
                                 foreach ($arData['UF_BANNERIMAGE'] as $item) {
                                     $b_item_img = CFile::GetPath($item);
                                     if ($i == $_SESSION['catban']){
                                     ?>
                                         <div>
                                         	<a href="<?php echo $toLink;?>"><img src="<?php echo $b_item_img;?>"  style="width:100%;"/></a>
                                         </div>
                                         <?php 
                                     }
                                 $i++;
                                 }
                                 ?>
                                 </div>
                                 <?php 
                             }
                             
                         }        
        }
                     ?>
                     </div>

                     
                    
                    <!-- <div class='test'><a href="#" id='tlink'>dsfaf</a></div> -->
                    <?php
                    $pageurl = ($countSubsections > 0) ? '/catalog/' : '';

                            echo "<div class='subsection'>";
                            echo $section["~UF_BANNER_CATEGORY"];
                            echo "</div>";                    
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
                    } else {
                        $_SESSION["measurment"]="";
                    }

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
                    if (/*$countElementsInSection > 0*/1==1){
                    ?>
                    <div class="col-12" id="sort_md_pag">
                    <div class="row g-0">
                    <div class="col-12 col-xl-6 col-lg-6 col-md-6">
                    <?php
                    /*sort element*/
                    if (/*$countSubsections == 0 && $countElementsInSection > 0*/1==1) {     
                        if (empty($_SESSION['sort']) && empty($_GET['sort'])){
                            $_SESSION['sort'] = "PROPERTY_1208";
                        }
                        else if (empty($_SESSION['sort']) && !empty($_GET['sort'])){
                            $_SESSION['sort'] = "PROPERTY_1208";
                        }
                        else if (!empty($_SESSION['sort']) && !empty($_GET['sort'])) {
                            $_SESSION['sort'] = $_GET['sort'];
                        }
                        
                        if (empty($_SESSION['method']) && empty($_GET['method'])){
                            $_SESSION['method'] = "desc";
                        }
                        else if (empty($_SESSION['method']) && !empty($_GET['method'])){
                            $_SESSION['method'] = $_GET['method'];
                        }
                        else if (!empty($_SESSION['sort']) && !empty($_GET['sort'])) {
                            $_SESSION['method'] = $_GET['method'];
                        }
                        ?>
                        <?php if(!$detect->isMobile() && !$detect->isTablet()): ?>
                    <p class="prodlist-i-info">
                    <span class="sort_title">Сортировать:</span>
                        <span class="sort_link_area">
                         <a href="<?=$arResult["SECTION_PAGE_URL"]?>?sort=PROPERTY_1208&method=<?php if($_SESSION['sort'] == 'PROPERTY_1208'){
                             if($_SESSION['method'] == 'desc'){
                                 echo "asc";
                             }
                             else {
                                 echo "desc";
                             }
                         }else {echo "asc";}?>" class="prodlist-i-favorites <?if($_SESSION['sort'] == 'PROPERTY_1208'){echo 'active';} ?>"><i class="fa fa-sort-amount-<?php if($_SESSION['sort'] == 'PROPERTY_1208'){
                             if($_SESSION['method'] == 'desc'){
                                 echo "desc";
                             }
                             else {
                                 echo "asc";
                             }
                         }else {echo "desc";}?>"></i> по наличию</a>
                        <a href="<?=$arResult["SECTION_PAGE_URL"]?>?sort=PROPERTY_613&method=<?php if($_SESSION['sort'] == 'PROPERTY_613'){
                             if($_SESSION['method'] == 'desc'){
                                 echo "asc";
                             }
                             else {
                                 echo "desc";
                             }
                         }else {echo "asc";}?>" class="prodlist-i-favorites <?if($_SESSION['sort'] == 'PROPERTY_613'){echo 'active';} ?>"><i class="fa fa-sort-amount-<?php if($_SESSION['sort'] == 'PROPERTY_613'){
                             if($_SESSION['method'] == 'desc'){
                                 echo "asc";
                             }
                             else {
                                 echo "desc";
                             }
                         }else {echo "asc";}?>"></i> по размеру</a>
                         <!-- <a href="<?=$arResult["SECTION_PAGE_URL"]?>?sort=catalog_PRICE_2&method=<?php if($_SESSION['sort'] == 'catalog_PRICE_2'){
                             if($_SESSION['method'] == 'desc'){
                                 echo "asc";
                             }
                             else {
                                 echo "desc";
                             }
                         }else {echo "asc";}?>" class="prodlist-i-favorites <?if($_SESSION['sort'] == 'catalog_PRICE_2'){echo 'active';} ?>" class="prodlist-i-favorites <?if($_SESSION['sort'] == 'catalog_PRICE_2'){echo 'active';} ?>"><i class="fa fa-sort-amount-<?php if($_SESSION['sort'] == 'catalog_PRICE_2'){
                             if($_SESSION['method'] == 'desc'){
                                 echo "asc";
                             }
                             else {
                                 echo "desc";
                             }
                         }else {echo "asc";}?>"></i> по цене</a>-->
                        </span>
                    </p>
                        <?php else: ?>
                        <div class="top-menu-catalog-mobile">
                            <div class="top-menu-catalog-mobile-container">
                            <div class="sort-container-mobile prodlist-i-info">
                                <span class="sort_title">Сортировать <i class="fa fa-angle-down"></i></span>
                                <span class="sort_link_area">
                         <a href="<?=$arResult["SECTION_PAGE_URL"]?>?sort=PROPERTY_1208&method=<?php if($_SESSION['sort'] == 'PROPERTY_1208'){
                             if($_SESSION['method'] == 'desc'){
                                 echo "asc";
                             }
                             else {
                                 echo "desc";
                             }
                         }else {echo "asc";}?>" class="prodlist-i-favorites <?if($_SESSION['sort'] == 'PROPERTY_1208'){echo 'active';} ?>"><i class="fa fa-sort-amount-<?php if($_SESSION['sort'] == 'PROPERTY_1208'){
                                 if($_SESSION['method'] == 'desc'){
                                     echo "desc";
                                 }
                                 else {
                                     echo "asc";
                                 }
                             }else {echo "desc";}?>"></i> по наличию</a>
                        <a href="<?=$arResult["SECTION_PAGE_URL"]?>?sort=PROPERTY_613&method=<?php if($_SESSION['sort'] == 'PROPERTY_613'){
                            if($_SESSION['method'] == 'desc'){
                                echo "asc";
                            }
                            else {
                                echo "desc";
                            }
                        }else {echo "asc";}?>" class="prodlist-i-favorites <?if($_SESSION['sort'] == 'PROPERTY_613'){echo 'active';} ?>"><i class="fa fa-sort-amount-<?php if($_SESSION['sort'] == 'PROPERTY_613'){
                                if($_SESSION['method'] == 'desc'){
                                    echo "asc";
                                }
                                else {
                                    echo "desc";
                                }
                            }else {echo "asc";}?>"></i> по размеру</a>
                                    <!-- <a href="<?=$arResult["SECTION_PAGE_URL"]?>?sort=catalog_PRICE_2&method=<?php if($_SESSION['sort'] == 'catalog_PRICE_2'){
                                        if($_SESSION['method'] == 'desc'){
                                            echo "asc";
                                        }
                                        else {
                                            echo "desc";
                                        }
                                    }else {echo "asc";}?>" class="prodlist-i-favorites <?if($_SESSION['sort'] == 'catalog_PRICE_2'){echo 'active';} ?>" class="prodlist-i-favorites <?if($_SESSION['sort'] == 'catalog_PRICE_2'){echo 'active';} ?>"><i class="fa fa-sort-amount-<?php if($_SESSION['sort'] == 'catalog_PRICE_2'){
                                        if($_SESSION['method'] == 'desc'){
                                            echo "asc";
                                        }
                                        else {
                                            echo "desc";
                                        }
                                    }else {echo "asc";}?>"></i> по цене</a>-->
                        </span>
                            </div>
                                <!-- Start Filter -->
                                <?
                                $APPLICATION->IncludeComponent(
                                    "kombox:filter",
                                    "vertical_left",
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
                                        "COMPONENT_TEMPLATE" => "vertical_left",
                                        "PAGE_URL" => "",
                                        "COLUMNS" => "1",
                                        "STORES_ID" => array(
                                        ),
                                        "THEME" => "red",
                                        "COMPOSITE_FRAME_MODE" => "A",
                                        "COMPOSITE_FRAME_TYPE" => "AUTO"
                                    ),
                                    false
                                );
                                //if ($USER->GetID() == '3092' || $USER->GetID() == '2743') {
                                //sotbit seometa component start
                                /*$APPLICATION->IncludeComponent(
                                "sotbit:seo.meta",
                                ".default",
                                Array(
                                "FILTER_NAME" => $arParams["FILTER_NAME"],
                                "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "CACHE_TIME" => $arParams["CACHE_TIME"],
                                )
                                );*/
                                //}
                                //sotbit seometa component end

                                ?>
                                <!-- end Filter -->
                                </div>
                            </div>
                            <script>
                                $(function() {
                                    var topbottom = $('#topbottom');
                                    var top_menu_catalog_mobile = $('.top-menu-catalog-mobile');
                                    topbottom.css('box-shadow', '0 1px 20px rgba(3, 27, 78, 15%)');
                                    top_menu_catalog_mobile.css('top', topbottom.outerHeight() + 'px');
                                    $('.top-menu-catalog-mobile-spacer').css('height', top_menu_catalog_mobile.outerHeight() + 'px');

                                    $('.top-menu-catalog-mobile .sort_title').click(function () {
                                        $('.top-menu-catalog-mobile span.sort_title i').toggleClass('active');
                                        $('.top-menu-catalog-mobile .sort_link_area').toggleClass('flexbox');
                                    })
                                });
                            </script>
                            <?php endif; ?>

                    
                    <?php 
                    }
                    ?>
                    </div>
                    <?php 
                    /*end sort element*/
                    if (/*$countSubsections == 0 and */$countElementsInSection > 0  and $isTagget != 'Y'):
                        if(explode('/', $APPLICATION->GetCurDir())[1] == 'catalog' or explode('/', $APPLICATION->GetCurDir())[1] == 'services'){ ?>
                            
                                <div class="col-12 col-xl-4 col-lg-4 col-md-4">
                                <?php 
                                if (1==2) {
                                ?>
                                <div class="measurment_view">

                                    <div class="measurment__item <?if($_SESSION["measurment"]=="metricheskaya") echo "is-active";?>">
                                        <a title="Метрический" class='measurment__link' href='<?=$APPLICATION->GetCurPageParam("measurment=metricheskaya",array('measurment' ), false); ?>'><i class="<?if($_SESSION["measurment"]=="metricheskaya") { echo "measurment-title-check-active";}  else { echo "measurment-title-check";}?>"></i><span class="measurment-title">Метрический</span> </a>
                                    </div>
                                    <div class="measurment__item <?if($_SESSION["measurment"]=="dyuymovaya") echo "is-active";?>">
                                        <a title="Дюймовый" class='measurment__link' href='<?=$APPLICATION->GetCurPageParam("measurment=dyuymovaya",array('measurment'), false); ?>'><i class="<?php if($_SESSION["measurment"]=="dyuymovaya") { echo "measurment-title-check-active";}  else { echo "measurment-title-check";}?>"></i><span class="measurment-title">Дюймовый</span></a>
                                    </div>

                                </div>
                                <?php 
                                }
                                ?>
                                </div>


<div class="col-12 col-xl-2 col-lg-2 col-md-2 text-right">
                                <div class="pagination_view">
                                    <span class="pagination__item <?if($_SESSION["catalog_items_in_list"]=="y") echo "is-active";?> pr-2">
                                        <a title="Список" class='pagination__link' href='<?=$APPLICATION->GetCurPageParam("catalog_items_in_list=y",array("catalog_items_in_list")); ?>'><i class="fa fa-th-list"></i></a>
                                    </span>
                                    <span class="pagination__item <?if($_SESSION["catalog_items_in_list"]=="n") echo "is-active";?>">
                                        <a title="Плитка" class='pagination__link' href='<?=$APPLICATION->GetCurPageParam("catalog_items_in_list=n",array("catalog_items_in_list")); ?>'><i class="fa fa-th-large"></i></a>
                                    </span>
                                </div>
                   </div>             
                            


                        <? }

                    endif;
?>
</div>
</div>
  <?php
                    } else {
                        /*if ( $USER->IsAuthorized() )
                        {
                            if ($USER->GetID() == '3092') {*/
                                //echo "Пустая категория!";
                                
                                ?>
                                <div class="col-12 col-xl-12 col-lg-12 col-md-12">
                                	<div class="row g-0">
                                		<div class="col-8 col-xl-8 col-lg-8 col-md-8">
                                			<div class="empty-category-title"><!-- В данном разделе пока нет товаров. Воспользуйтесь формой обратной связи для заказа, соответствующих позиций.--></div>
                                		</div>
                                		
                                		<div class="col-4 col-xl-4 col-lg-4 col-md-4 text-right">
                                		<div class="btn-group-blue"><a href="#w-form" class="btn-404"><span><i class="fa fa-envelope"></i> Отправить запрос</span></a></div>
                                		</div>		
                                	</div>
                                </div>
<?php                                 
                       /*     }
                        }*/
                    }

  if ($_POST['AJAX_MODE']=='Y') $APPLICATION->RestartBuffer();
  
  If ($isGetFilter == 'Y' && $_SESSION["catalog_items_in_list"]=="y"){
      $template = "items_list_line_2020";
  } elseif ($isGetFilter == 'Y' && $_SESSION["catalog_items_in_list"]=="n"){
      $template = "items_list_2020";
  }
  
                    if ($countSubsections){
                        $sortFieldOne = 'PROPERTY_1208';
                        $sortOrderOne = 'DESC';
                        $sortFieldTwo = 'shows';
                        $sortOrderTwo = 'ASC';
                    } else {
                        if ($_SESSION['sort'] == 'PROPERTY_1208'){
                            $sortFieldOne = 'PROPERTY_1208';
                        } else{
                            $sortFieldOne = 'PROPERTY_613';
                        }
                        
                        $sortOrderOne = $_SESSION['method'].",nulls";
                        if($_SESSION['method'] == 'desc')
                        {
                            $sortFieldTwo = 'PROPERTY_644';
                            $sortOrderTwo = 'DESC';
                        }
                        else if ($_SESSION['method'] == 'asc'){
                            $sortFieldTwo = 'PROPERTY_644';
                            $sortOrderTwo = "ASC,nulls";
                        }
                    }
                    
                   /* if ( $USER->IsAuthorized() )
                    {
                        if ($USER->GetID() == '3092') {
                            $sortFieldOne = $_SESSION['sort'];
                            $sortOrderOne = $_SESSION['method'].",nulls";
                            if($_SESSION['method'] == 'desc')
                            {
                            $sortFieldTwo = array('PROPERTY_644');
                            $sortOrderTwo = 'DESC';
                            }
                            else if ($_SESSION['method'] == 'asc'){
                                $sortFieldTwo = array('PROPERTY_644');
                                $sortOrderTwo = "ASC,nulls";
                            }
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
                    }*/
                    /*if ( $USER->IsAuthorized() )
                    {
                        if ($USER->GetID() == '3092') {*/
                    
                            if ($arResult["VARIABLES"]["SECTION_ID"] == '955') {
                                $sortFieldOne = 'NAME';
                                $sortOrderOne = 'ASC';
                                $sortFieldTwo = 'CATALOG_QUANTITY';
                                $sortOrderTwo = 'DESC';
                            }
 /*                       }
                    }*/
                    
                    
                           ?>
                           <div class="col-12 mt-3">
                           <?php              
                            $intSectionID = $APPLICATION->IncludeComponent(
                                "bitrix:catalog.section",
                                $template,
                                array(
                                    "PAGE_CURRENT" => $pageN,
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
?>
</div>
<?php 

                    if ($_POST['AJAX_MODE']=='Y') die();

                    ?>
            
            
            <?if(/*$section["DESCRIPTION"] && */!$isGetFilter && !$pageN && !empty($section["DESCRIPTION"]) || !empty($section["~UF_PREVIEW_TEXT"])){?>
           <div class="col-12 mt-3">
            <article class="article">
            <?
            
            if (empty($checkGipot)){
            if ($SectPict['SRC'] && !empty($section["DESCRIPTION"]) || !empty($section["~UF_PREVIEW_TEXT"])){ 
            ?><img class="TitleImg <?=$flag?>" src="<?= $SectPict['SRC'] ?>" alt="<?= $section['NAME'] ?>" title="<?='Фото '.$section['NAME'] ?>"><? 
                }
                
                            echo $section["~UF_PREVIEW_TEXT"];
                            echo $section["DESCRIPTION"];
                
      
                If ($section["UF_LONGTEXT"] && !$isGetFilter  && !$pageN){
                    echo $section["~UF_LONGTEXT"]; ?>
                <?}
                }?>
                
                <div style="text-align:right;padding:10px 0px;">
            <span class="social_share_2020" style="float:none !important;">
            <div data-mobile-view="true" data-share-size="30" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1889365" data-mode="share" data-background-color="#ffffff" data-hover-effect="scale" data-share-shape="round-rectangle" data-share-counter-size="12" data-icon-color="#ffffff" data-mobile-sn-ids="vk.mr.fb.ok.tw.wh.tm.vb." data-text-color="#000000" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-type="common" data-orientation="horizontal" data-following-enable="false" data-sn-ids="vk.mr.ok.fb.tw.wh.tm.vb." data-preview-mobile="false" data-selection-enable="false" data-exclude-show-more="true" data-share-style="9" data-counter-background-alpha="1.0" data-top-button="false" class="uptolike-buttons" ></div>
            </span>
</div>
<div class="counter_one">
                    <?
                    if ( $USER->IsAuthorized() )
                    {
                        if ($USER->GetID() == '3092') {
                    echo 'Просмотров: '.$section['UF_COUNTER'];
                        }
                    }
                    ?>

                </div>
                </article>
                </div>
                <?}?>
                
            

				</div>
                <!-- </div> -->
    
    <!-- end Content -->
        	
        	</div>
    	</div>

        <main <?php echo $sl;?>>
    
        </main>
    </div>
</section>
<script type="text/javascript">/*(function(w,doc) {
if (!w.__utlWdgt ) {
w.__utlWdgt = true;
var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';
var h=d[g]('body')[0];
h.appendChild(s);
}})(window,document);*/
</script>


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