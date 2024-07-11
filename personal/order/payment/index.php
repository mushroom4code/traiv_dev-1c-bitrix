<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Оплата заказа");
?>

<div class="content">
	<div class="container">
		<h1>
			<?$APPLICATION->ShowTitle(false);?>
		</h1>
		<?$APPLICATION->IncludeComponent(
			"bitrix:sale.order.payment",
			"",
			Array(
			)
		);?>

	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>