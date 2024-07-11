<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Поиск по сайту");
?><div class="content">
	<div class="container">
        <?$APPLICATION->AddChainItem('Услуги компании', "/services/");?>
        <?$APPLICATION->AddChainItem('Производство и изготовление', "/services/proizvodstvo-metizov/");?>
        <?$APPLICATION->AddChainItem('Поиск по разделу Производство', "/");?>

        <?$APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "traiv.production",
            Array(
                "COMPONENT_TEMPLATE" => "traiv.new",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "PATH" => "/",
                "SITE_ID" => "s1",
                "START_FROM" => "0"
            )
        );?>
        <a class="back-to-production" href="/services/proizvodstvo-metizov/">Вернуться в раздел "Производство"</a><!--
		<h1><?/*$APPLICATION->ShowTitle(false);*/?></h1>-->
        <br><br>
		 <? /* $APPLICATION->IncludeComponent(
	"traiv:filter.form",
	"",
Array()
);*/?> <?$APPLICATION->IncludeComponent(
	"arturgolubev:search.page", 
	"traiv-production",
	array(
		"COMPONENT_TEMPLATE" => "traiv-2020",
		"CHECK_DATES" => "Y",
		"USE_TITLE_RANK" => "Y",
		"DEFAULT_SORT" => "rank",
		"FILTER_NAME" => "",
		"arrFILTER" => array(
			0 => "iblock_catalog",
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
		"PAGER_TEMPLATE" => "modern",
		"arrFILTER_iblock_catalog" => array(
			0 => "32",
		)
	),
	false
);?>
	</div>
</div>


 <? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>