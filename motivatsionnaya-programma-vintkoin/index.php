<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мотивационная программа - винткоин");
?><div class="content">
	<div class="container">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"traiv",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => "",
		"SITE_ID" => "zf",
		"START_FROM" => "0"
	)
);?> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "_vintkoin",
		"COMPONENT_TEMPLATE" => ".default",
		"EDIT_TEMPLATE" => ""
	)
);?>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>