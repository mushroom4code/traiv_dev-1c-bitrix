<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Инструмент сверления Sandvik");
?><?$APPLICATION->IncludeComponent(
	"dktkland:land-info",
	"",
	Array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"URL" => "/sandvik/instrument-sverleniya-sandvik/"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>