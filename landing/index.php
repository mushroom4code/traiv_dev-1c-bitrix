<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Лендинг");
$APPLICATION->SetPageProperty("title", "Лендинг");
$APPLICATION->SetTitle("Лендинг");
?>

<?$APPLICATION->IncludeComponent(
	"dktk:landing-block", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"URL" => "/landing/",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>

<?php 
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>