<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>
<?$APPLICATION->IncludeComponent(
	"traiv:personal",
	"",
Array("TEMPLATE" => "delivery")
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>