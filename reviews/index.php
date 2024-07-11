<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Отзывы");
$APPLICATION->SetPageProperty("title", "Отзывы");
$APPLICATION->SetTitle("Отзывы");

?>    
<section id="content">
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

<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span>Отзывы</span></h1>
    </div>
</div>

<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<?
						    						        //echo $arResult['ID'];
						    						        $APPLICATION->IncludeComponent(
	"khayr:main.comment", 
	"comment", 
	array(
		"OBJECT_ID" => "0",
		"COUNT" => "10",
		"MAX_DEPTH" => "2",
		"JQUERY" => "N",
		"MODERATE" => "N",
		"LEGAL" => "N",
		"LEGAL_TEXT" => "Я согласен с правилами размещения сообщений на сайте.",
		"CAN_MODIFY" => "N",
		"NON_AUTHORIZED_USER_CAN_COMMENT" => "Y",
		"REQUIRE_EMAIL" => "N",
		"USE_CAPTCHA" => "Y",
		"AUTH_PATH" => "/auth/",
		"ACTIVE_DATE_FORMAT" => "j F Y, G:i",
		"LOAD_AVATAR" => "N",
		"LOAD_MARK" => "Y",
		"LOAD_DIGNITY" => "Y",
		"LOAD_FAULT" => "Y",
		"ADDITIONAL" => array(
		),
		"ALLOW_RATING" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"COMPONENT_TEMPLATE" => "comment",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
    </div>
</div>

	</div>
</section>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>