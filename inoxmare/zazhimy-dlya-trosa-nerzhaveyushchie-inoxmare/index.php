<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Зажимы для троса нержавеющие Inoxmare");
?><?$APPLICATION->IncludeComponent(
	"dktkland:land-info",
	"",
	Array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"URL" => "/inoxmare/zazhimy-dlya-trosa-nerzhaveyushchie-inoxmare/"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>