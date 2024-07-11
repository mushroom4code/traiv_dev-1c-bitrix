<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказ детально");
?>
<section id="content">
<?
$APPLICATION->IncludeComponent(
	"traiv:personal",
	"",
Array("TEMPLATE" => "orderview")
);
?>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>