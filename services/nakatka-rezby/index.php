<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Накатка дюймовой и метрической резьбы по ГОСТ на собственном производстве компании «Трайв» в Санкт-Петербурге (СПБ) и Москве (МСК)! Звоните 8 (800) 707-25-98!");
$APPLICATION->SetPageProperty("title", "Услуги накатки дюймовой и метрической резьбы по ГОСТ, DIN, ISO, EN");
$APPLICATION->SetTitle("Накатка резьбы");
?><?$APPLICATION->IncludeComponent(
	"dktk:landing-block",
	"",
	Array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"URL" => "/services/nakatka-rezby/"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>