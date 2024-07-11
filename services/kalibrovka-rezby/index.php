<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Калибровка резьбы метчиком, плашками, на токарных и фрезерных станках на собственном производстве компании «Трайв» в Санкт-Петербурге (СПБ) и Москве (МСК)! Звоните 8 (800) 707-25-98!");
$APPLICATION->SetPageProperty("title", "Услуги калибровки резьбы на специализированном оборудовании");
$APPLICATION->SetTitle("Калибровка резьбы");
?><section id="content">
<div class="container">
	 <?$APPLICATION->IncludeComponent(
	"dktk:landing-block", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"URL" => "/services/kalibrovka-rezby/",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?><br>
</div>
 </section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>