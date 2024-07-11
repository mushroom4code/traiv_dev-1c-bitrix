<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Текущие заказы");
?>
<section id="content">
<?
$APPLICATION->IncludeComponent(
    "traiv:personal",
    "",
    Array("TEMPLATE" => "order")
    );

?>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>