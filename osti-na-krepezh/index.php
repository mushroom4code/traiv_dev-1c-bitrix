<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Осты на крепеж. Перечень");
$APPLICATION->SetPageProperty("title", "Госты на крепеж");
$APPLICATION->SetTitle("Госты на крепеж");
?>  <section id="content">
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
        	<div class="col-3">
		<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"catalog_left_menu_2024",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"COMPONENT_TEMPLATE" => "catalog_left_menu_2024",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(""),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "left",
		"USE_EXT" => "N"
	)
);?>

 </div>
 
 <div class="col-9">
 
         <?php if($APPLICATION->GetCurPage() == "/osti-na-krepezh/") {
?>
<div class="row">
<div class="col-12 col-xl-12 col-lg-12 col-md-12">
<h1><span>ОСТы на крепеж</span></h1>
</div>

<div class="col-12 col-xl-12 col-lg-12 col-md-12">
<img src="<?=SITE_TEMPLATE_PATH?>/images/orig.png" class="img-responsive" style="padding:10px 0px;"/>
</div>

</div>
<?php 
}
?>
 
 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"gost_list", 
	array(
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "Y",
		"IBLOCK_ID" => "46",
		"IBLOCK_TYPE" => "content",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_URL" => "#SECTION_CODE#/",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "1",
		"VIEW_MODE" => "LINE",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?> </div>
	</div>
</div>
 <script>
        $(document).ready(function() {
            //doesn't wait for images, style sheets etc..
            //is called after the DOM has been initialized
            $(".categories").removeClass('u-none');
        });
    </script> 
</section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>