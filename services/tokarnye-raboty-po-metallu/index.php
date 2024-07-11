<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Токарные работы по металлу");
?>
<?$APPLICATION->IncludeComponent(
	"dktk:landing-block", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"URL" => "/services/tokarnye-raboty-po-metallu/",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>