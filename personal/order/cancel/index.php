<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказ");
?>
<div class="content">
	<div class="container">
		<div class="catalog-item ">
			<h1>
				<?$APPLICATION->ShowTitle(false);?>
			</h1>
			<?
			$APPLICATION->IncludeComponent(
				"bitrix:sale.personal.order.cancel",
				".default",
				array(
					"PATH_TO_LIST" => "/personal/orders/",
					"PATH_TO_DETAIL" => $arResult["PATH_TO_DETAIL"],
					"SET_TITLE" => "Y",
					"ID" => $_REQUEST["ID"],
					"COMPONENT_TEMPLATE" => ".default"
				),
				false
			);
			?>
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>