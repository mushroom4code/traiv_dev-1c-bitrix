<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Приглашаем вас принять участие в деловом завтраке \"Трайв\", организованном нашей компанией. Это идеальная площадка для того, чтобы узнать, как наша продукция и услуги могут стать ключом к успеху вашего бизнеса.");
$APPLICATION->SetTitle("Деловой завтрак в Туле 2024");
?><?$APPLICATION->IncludeComponent(
	"dktkland:land-info", 
	".default", 
	array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"URL" => "/delovoy-zavtrak-v-tule-2024/",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>