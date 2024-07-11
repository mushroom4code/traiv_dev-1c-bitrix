<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>
<section id="content">
<?$APPLICATION->IncludeComponent(
	"traiv:personal",
	"",
Array("TEMPLATE" => "cart")
);?>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>