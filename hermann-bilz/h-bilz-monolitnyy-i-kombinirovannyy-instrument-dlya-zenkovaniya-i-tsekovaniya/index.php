<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("H.Bilz Монолитный и комбинированный инструмент для зенкования и цекования");
?><?$APPLICATION->IncludeComponent(
	"dktkland:land-info",
	"",
	Array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"URL" => "/hermann-bilz/h-bilz-monolitnyy-i-kombinirovannyy-instrument-dlya-zenkovaniya-i-tsekovaniya/"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>