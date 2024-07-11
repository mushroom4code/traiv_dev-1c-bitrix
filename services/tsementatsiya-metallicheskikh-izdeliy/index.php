<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Цементация металлических изделий");
?><?$APPLICATION->IncludeComponent(
	"dktk:landing-block",
	"",
	Array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ELEMENT_CODE" => "",
		"TYPE_LABEL" => "usl",
		"URL" => "/services/tsementatsiya-metallicheskikh-izdeliy/"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>