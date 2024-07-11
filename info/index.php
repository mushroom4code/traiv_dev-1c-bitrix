<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Полезные инструменты, новости, акции, статьи");
$APPLICATION->SetPageProperty("title", "Информация");
$APPLICATION->SetTitle("Информация");
?>	<section id="content">
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
<h1 class="title-mb-0"><span>Информация</span></h1>
</div>
</div>

			<?
			// Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
			$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "_info",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);

			?>


		</section>
		<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>