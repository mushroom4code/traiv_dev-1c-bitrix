<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подписки");
?>
<section id="content">
<?$APPLICATION->IncludeComponent(
	"traiv:personal",
	"",
Array("TEMPLATE" => "subscribe")
);?>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>