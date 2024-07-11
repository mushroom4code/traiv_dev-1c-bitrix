<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Производство конвейерных роликов");
?><?$APPLICATION->IncludeComponent(
	"dktk:landing-block",
	"",
	Array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ELEMENT_CODE" => "",
		"TYPE_LABEL" => "usl",
		"URL" => "/services/proizvodstvo-konveyernykh-rolikov/"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>