<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Объёмная, вакуумная и индукционная (ТВЧ) термическая обработка крепежа на собственном производстве компании «Трайв» в Санкт-Петербурге (СПБ) и Москве (МСК)! Звоните 8 (800) 707-25-98!");
$APPLICATION->SetPageProperty("title", "Услуги закалки крепежа и металла на специализированном оборудовании");
$APPLICATION->SetTitle("Термическая обработка объёмная крепежа и металла");
?>

<?$APPLICATION->IncludeComponent(
	"dktk:landing-block", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"URL" => "/services/termicheskaya-obrabotka-obyemnaya-krepezha-i-metalla/",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>