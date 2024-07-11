<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Отраслевые решения");
$APPLICATION->SetPageProperty("title", "Отраслевые решения");
$APPLICATION->SetTitle("Отраслевые решения");
?>	

<?php 

/*if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '2938') {*/
        
        $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 49, 'ACTIVE'=>'Y', 'CODE' => $_REQUEST["ELEMENT_CODE"]], false, false);
        //echo $_REQUEST["ELEMENT_CODE"];
        
        while($ar_result_in = $db_list_in->GetNext())
        {
            $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(49, $ar_result_in["ID"]);
            $arResult["IPROPERTY_VALUES"] = $ipropValues->getValues();
            
            if (!empty($arResult["IPROPERTY_VALUES"]['ELEMENT_META_TITLE'])){
                $APPLICATION->SetPageProperty("title", $arResult["IPROPERTY_VALUES"]['ELEMENT_META_TITLE']);
            }
            
            if (!empty($arResult["IPROPERTY_VALUES"]['ELEMENT_META_DESCRIPTION'])){
                $APPLICATION->SetPageProperty("description", $arResult["IPROPERTY_VALUES"]['ELEMENT_META_DESCRIPTION']);
            }
        }
        $APPLICATION->IncludeComponent(
	"dktk:landing-block", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"URL" => "",
		"TYPE_LABEL" => "coating",
	    "ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"]
	),
	false
);
        //$APPLICATION->SetPageProperty("title", "ТЕСТ");
        
    /*}
    else {
        ?>
        <section id="content">
		<div class="container">
<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "zf",
            ),
                false
            ); ?>
            
<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span><?$APPLICATION->ShowTitle(false)?></span></h1>
    </div>
</div>	

<div class="row">

<?php 

$APPLICATION->IncludeComponent("bitrix:news.detail","coatings",Array(
    "DISPLAY_DATE" => "Y",
    "DISPLAY_NAME" => "N",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "Y",
    "USE_SHARE" => "N",
    "SHARE_HIDE" => "N",
    "SHARE_TEMPLATE" => "",
    "SHARE_HANDLERS" => array("delicious"),
    "SHARE_SHORTEN_URL_LOGIN" => "",
    "SHARE_SHORTEN_URL_KEY" => "",
    "AJAX_MODE" => "Y",
    "IBLOCK_TYPE" => "transit",
    "IBLOCK_ID" => "49",
    "ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
    "ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
    "CHECK_DATES" => "Y",
    "FIELD_CODE" => Array("ID"),
    "PROPERTY_CODE" => Array("PDF_FILE"),
    "IBLOCK_URL" => "",
    "DETAIL_URL" => "",
    "SET_TITLE" => "Y",
    "SET_CANONICAL_URL" => "Y",
    "SET_BROWSER_TITLE" => "Y",
    "BROWSER_TITLE" => "-",
    "SET_META_KEYWORDS" => "Y",
    "META_KEYWORDS" => "-",
    "SET_META_DESCRIPTION" => "Y",
    "META_DESCRIPTION" => "-",
    "SET_STATUS_404" => "Y",
    "SET_LAST_MODIFIED" => "Y",
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    "ADD_SECTIONS_CHAIN" => "N",
    "ADD_ELEMENT_CHAIN" => "Y",
    "ACTIVE_DATE_FORMAT" => "d.m.Y",
    "USE_PERMISSIONS" => "N",
    "GROUP_PERMISSIONS" => Array("1"),
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
    "CACHE_GROUPS" => "N",
    "DISPLAY_TOP_PAGER" => "Y",
    "DISPLAY_BOTTOM_PAGER" => "Y",
    "PAGER_TITLE" => "Страница",
    "PAGER_TEMPLATE" => "",
    "PAGER_SHOW_ALL" => "Y",
    "PAGER_BASE_LINK_ENABLE" => "N",
    "SHOW_404" => "Y",
    "MESSAGE_404" => "",
    "STRICT_SECTION_CHECK" => "Y",
    "PAGER_BASE_LINK" => "",
    "PAGER_PARAMS_NAME" => "arrPager",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "AJAX_OPTION_HISTORY" => "N"
)
    );?>

    </div>


		</div>
	</section>
        <?php 
    }
}
else
{
?>
<section id="content">
		<div class="container">
<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "zf",
            ),
                false
            ); ?>
            
<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span><?$APPLICATION->ShowTitle(false)?></span></h1>
    </div>
</div>	

<div class="row">

<?php 

$APPLICATION->IncludeComponent("bitrix:news.detail","coatings",Array(
    "DISPLAY_DATE" => "Y",
    "DISPLAY_NAME" => "N",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "Y",
    "USE_SHARE" => "N",
    "SHARE_HIDE" => "N",
    "SHARE_TEMPLATE" => "",
    "SHARE_HANDLERS" => array("delicious"),
    "SHARE_SHORTEN_URL_LOGIN" => "",
    "SHARE_SHORTEN_URL_KEY" => "",
    "AJAX_MODE" => "Y",
    "IBLOCK_TYPE" => "transit",
    "IBLOCK_ID" => "49",
    "ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
    "ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
    "CHECK_DATES" => "Y",
    "FIELD_CODE" => Array("ID"),
    "PROPERTY_CODE" => Array("PDF_FILE"),
    "IBLOCK_URL" => "",
    "DETAIL_URL" => "",
    "SET_TITLE" => "Y",
    "SET_CANONICAL_URL" => "Y",
    "SET_BROWSER_TITLE" => "Y",
    "BROWSER_TITLE" => "-",
    "SET_META_KEYWORDS" => "Y",
    "META_KEYWORDS" => "-",
    "SET_META_DESCRIPTION" => "Y",
    "META_DESCRIPTION" => "-",
    "SET_STATUS_404" => "Y",
    "SET_LAST_MODIFIED" => "Y",
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    "ADD_SECTIONS_CHAIN" => "N",
    "ADD_ELEMENT_CHAIN" => "Y",
    "ACTIVE_DATE_FORMAT" => "d.m.Y",
    "USE_PERMISSIONS" => "N",
    "GROUP_PERMISSIONS" => Array("1"),
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
    "CACHE_GROUPS" => "N",
    "DISPLAY_TOP_PAGER" => "Y",
    "DISPLAY_BOTTOM_PAGER" => "Y",
    "PAGER_TITLE" => "Страница",
    "PAGER_TEMPLATE" => "",
    "PAGER_SHOW_ALL" => "Y",
    "PAGER_BASE_LINK_ENABLE" => "N",
    "SHOW_404" => "Y",
    "MESSAGE_404" => "",
    "STRICT_SECTION_CHECK" => "Y",
    "PAGER_BASE_LINK" => "",
    "PAGER_PARAMS_NAME" => "arrPager",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "AJAX_OPTION_HISTORY" => "N"
)
    );?>

    </div>


		</div>
	</section>
<?php     
}*/

?>


	
	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>