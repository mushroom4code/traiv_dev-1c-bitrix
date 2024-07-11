<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вертлюги Inoxmare нержавеющие");
?><?$APPLICATION->IncludeComponent(
	"dktkland:land-info",
	"",
	Array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"URL" => "/inoxmare/vertlyugi-inoxmare-nerzhaveyushchie/"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>