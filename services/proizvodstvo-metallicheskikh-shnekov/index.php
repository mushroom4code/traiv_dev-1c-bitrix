<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Производство металлических шнеков");
?><?$APPLICATION->IncludeComponent(
	"dktk:landing-block",
	"",
	Array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ELEMENT_CODE" => "",
		"TYPE_LABEL" => "usl",
		"URL" => "/services/proizvodstvo-metallicheskikh-shnekov/"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>