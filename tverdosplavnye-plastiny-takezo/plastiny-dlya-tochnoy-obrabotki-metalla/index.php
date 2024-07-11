<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пластины для точной обработки металла");
?><?$APPLICATION->IncludeComponent(
	"dktkland:land-info", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"URL" => "/takezo/plastiny-dlya-tochnoy-obrabotki-metalla/",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>