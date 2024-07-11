<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Внутренний счет");
?>
<section id="content">
<?$APPLICATION->IncludeComponent(
	"traiv:personal",
	"",
Array("TEMPLATE" => "lk")
);?>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>