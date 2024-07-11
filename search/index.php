<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Поиск по сайту");
?><section id="content">
	<div class="container">
	
	            <? $APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"traiv-new", 
	array(
		"COMPONENT_TEMPLATE" => "traiv",
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>
	
		<!-- <h1><?$APPLICATION->ShowTitle(false);?></h1> -->
<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span><?$APPLICATION->ShowTitle(false);?></span></h1>
    </div>
</div>

<?$APPLICATION->IncludeComponent(
	"arturgolubev:search.page", 
	"traiv-2020", 
	array(
		"COMPONENT_TEMPLATE" => "traiv-2020",
		"CHECK_DATES" => "Y",
		"USE_TITLE_RANK" => "Y",
		"DEFAULT_SORT" => "rank",
		"FILTER_NAME" => "",
		"arrFILTER" => array(
			0 => "main",
			1 => "iblock_catalog",
			2 => "iblock_content",
		),
		"SHOW_WHERE" => "N",
		"arrWHERE" => array(
			0 => "iblock_catalog",
			1 => "iblock_content",
		),
		"SHOW_WHEN" => "N",
		"PAGE_RESULT_COUNT" => "50",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"USE_LANGUAGE_GUESS" => "Y",
		"USE_SUGGEST" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Результаты поиска",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "visual-2020",
		"SHOW_RATING" => "",
		"RATING_TYPE" => "",
		"PATH_TO_USER_PROFILE" => "",
		"arrFILTER_iblock_catalog" => array(
			0 => "18",
			1 => "32",
		),
		"arrFILTER_iblock_content" => array(
			0 => "6",
			1 => "7",
			2 => "22",
			3 => "23",
			4 => "28",
			5 => "29",
			6 => "31",
			7 => "42",
		),
		"arrFILTER_main" => array(
		)
	),
	false
);?>
	</div>
</section>
 <br><? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>