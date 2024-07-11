<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сверла Takezo для станков с ЧПУ");
?><?$APPLICATION->IncludeComponent(
	"dktkland:land-info", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"URL" => "/takezo/sverla-dlya-stankov-s-chpu/",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>