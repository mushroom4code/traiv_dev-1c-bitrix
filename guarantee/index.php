<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Проверка товара, условия возврата и гарантия предоставляемая компанией Трайв.");
$APPLICATION->SetPageProperty("title", "Гарантия компании Трайв");
$APPLICATION->SetTitle("Гарантия");


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
    	<h1><span>Гарантия</span></h1>
    </div>
</div>

<div class="row">
<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-4">
      <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/guarantee.php"
                                )
                            );
                            ?>
</div>
    
</div>

	</div>
</section>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>