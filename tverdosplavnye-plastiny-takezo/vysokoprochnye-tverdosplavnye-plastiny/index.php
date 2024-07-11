<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Высокопрочные твердосплавные пластины Takezo");
?><?$APPLICATION->IncludeComponent(
	"dktkland:land-info", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"URL" => "/takezo/vysokoprochnye-tverdosplavnye-plastiny/",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>