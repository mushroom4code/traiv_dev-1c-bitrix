<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Изготовление токарных резцов на заказ");
?><?$APPLICATION->IncludeComponent(
	"dktk:landing-block",
	"",
	Array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ELEMENT_CODE" => "",
		"TYPE_LABEL" => "usl",
		"URL" => "/services/izgotovlenie-tokarnykh-reztsov-na-zakaz/"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>