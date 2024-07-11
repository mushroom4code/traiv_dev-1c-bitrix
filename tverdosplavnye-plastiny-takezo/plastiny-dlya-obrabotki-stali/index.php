<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пластины Takezo для обработки стали");
?><?$APPLICATION->IncludeComponent(
	"dktkland:land-info", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"URL" => "/takezo/plastiny-dlya-obrabotki-stali/",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>