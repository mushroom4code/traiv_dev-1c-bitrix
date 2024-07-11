<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пластины для резьбы Sandvik");
?><?$APPLICATION->IncludeComponent(
	"dktkland:land-info",
	"",
	Array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"URL" => "/sandvik/plastiny-sandvik/plastiny-dlya-rezby-sandvik/"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>