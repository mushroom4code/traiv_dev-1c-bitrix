<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Пакетное пиление шпилек на собственном производстве компании «Трайв» в Санкт-Петербурге (СПБ) и Москве (МСК)! Звоните 8 (800) 707-25-98!");
$APPLICATION->SetPageProperty("title", "Услуги пакетного пиления шпилек на специализированном оборудовании");
$APPLICATION->SetTitle("Пакетное пиление шпилек");
?><section id="content">
<div class="container">
	 <?$APPLICATION->IncludeComponent(
	"dktk:landing-block", 
	".default", 
	array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"URL" => "/services/paketnoe-pilenie-shpilek/",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><br>
	<div class="row">
		<div class="col-12 col-xl-6 col-lg-6 col-md-6">
		</div>
		<div class="col-12 col-xl-5 col-lg-5 col-md-5 offset-md-1 offset-xl-1 offset-lg-1 mt-4 mt-lg-0 mt-xl-0 mt-md-0">
			<div class="alert alert-secondary" role="alert">
			</div>
		</div>
	</div>
</div>
 </section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>