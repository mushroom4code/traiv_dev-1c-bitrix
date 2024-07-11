<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Правила бонусной программы");
$APPLICATION->SetPageProperty("title", "Правила бонусной программы");
$APPLICATION->SetTitle("Правила бонусной программы");


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
    	<h1><span>Правила бонусной программы</span></h1>
    </div>
</div>

<div class="">

<div class="bonus-item">
	<div class="btn-group-blue"><a href="/bonus/" class="btn-404"><span><i class="fa fa-info-circle "></i> Как накопить?</span></a></div>
</div>

<div class="bonus-item">
	<div class="btn-group-blue"><a href="/bonus/pravila-bonusnoy-programmy/" class="btn-404"><span><i class="fa fa-file-text-o"></i> Правила программы</span></a></div>
</div>

<div class="bonus-item">
	<div class="btn-group-blue"><a href="/bonus/katalog-prizov/" class="btn-404"><span><i class="fa fa-gift"></i> Каталог призов</span></a></div>
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
                                    "PATH" => "index_rules.php"
                                )
                            );
                            ?>
</div>
    
</div>

	</div>
</section>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>