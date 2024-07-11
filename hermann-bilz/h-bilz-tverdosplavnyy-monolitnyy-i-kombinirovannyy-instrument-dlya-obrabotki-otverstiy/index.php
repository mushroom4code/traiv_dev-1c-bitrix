<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("H.Bilz Твердосплавный монолитный и комбинированный инструмент для обработки отверстий");
?><?$APPLICATION->IncludeComponent(
	"dktkland:land-info",
	"",
	Array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"URL" => "/hermann-bilz/h-bilz-tverdosplavnyy-monolitnyy-i-kombinirovannyy-instrument-dlya-obrabotki-otverstiy/"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>