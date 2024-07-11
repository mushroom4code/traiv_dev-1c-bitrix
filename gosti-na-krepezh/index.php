<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Смотреть межгосударственные стандарты по категориям крепежа | оптовый поставщик и производитель крепежа и метизов Трайв");
$APPLICATION->SetPageProperty("title", "Госты на крепеж. Перечень стандартов по категориям");
$APPLICATION->SetTitle("ГОСТ на крепеж");
?>  <section id="content">
    <div class="container">

        <? $APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"traiv-new-wl", 
	array(
		"COMPONENT_TEMPLATE" => "traiv-new-wl",
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>


<div class="row">
        	<div class="col-12 col-xl-3 col-lg-3 col-md-3">
		<?
		
		if ( $USER->IsAuthorized() )
		{
		    if ($USER->GetID() == '3092') {
		        $menu = "catalog_left_menu_2024";
		    }
		    else {
		        $menu = "catalog_left_menu_2024";
		    }
		}
		else
		{
		    $menu = "catalog_left_menu_2024";
		}
		
		$APPLICATION->IncludeComponent(
	"bitrix:menu",
		    $menu,
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
	    "COMPONENT_TEMPLATE" => $menu,
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
 
 <div class="col-12 col-xl-9 col-lg-9 col-md-9">
 
 
 <?php if($APPLICATION->GetCurPage() == "/gosti-na-krepezh/") {
?>
<div class="row">
<div class="col-12 col-xl-12 col-lg-12 col-md-12">
<h1><span>ГОСТ на крепеж</span></h1>
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
		"IBLOCK_ID" => "22",
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
		"COMPONENT_TEMPLATE" => "gost_list",
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
		"FILTER_NAME" => "sectionsFilter",
		"CACHE_FILTER" => "N"
	),
	false
);?>
	</div>
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