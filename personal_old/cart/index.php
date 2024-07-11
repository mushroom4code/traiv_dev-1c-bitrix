<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>
<div class="content">
	<div class="container">
		<div class="catalog-item ">
			<h1>
				<?$APPLICATION->ShowTitle(false);?>
			</h1>
			<?
			$APPLICATION->IncludeComponent(
				"bitrix:sale.basket.basket",
				"traiv",
				array(
					"COMPONENT_TEMPLATE" => "traiv",
					"COLUMNS_LIST" => array(
						0 => "NAME",
						1 => "DISCOUNT",
						2 => "WEIGHT",
						3 => "PROPS",
						4 => "DELETE",
						5 => "PRICE",
						6 => "QUANTITY",
						7 => "SUM",
						8 => "PROPERTY_TSVET",
						9 => "PROPERTY_FORMA",
						10 => "PROPERTY_CML2_ARTICLE",
						11 => "PROPERTY_CML2_ATTRIBUTES",
						12 => "PROPERTY_CML2_MANUFACTURER",
						13 => "PROPERTY_POKRYTIE",
						14 => "PROPERTY_MATERIAL",
						15 => "PROPERTY_DIAMETR",
						16 => "PROPERTY_DLINA",
						17 => "PROPERTY_SHAG_REZBY",
						18 => "PROPERTY_UPAKOVKA",
					),
					"TEMPLATE_THEME" => "",
					"PATH_TO_ORDER" => "/personal/order.php",
					"HIDE_COUPON" => "Y",
					"PRICE_VAT_SHOW_VALUE" => "N",
					"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
					"USE_PREPAYMENT" => "N",
					"QUANTITY_FLOAT" => "N",
					"AUTO_CALCULATION" => "Y",
					"SET_TITLE" => "Y",
					"ACTION_VARIABLE" => "basketAction",
					"OFFERS_PROPS" => array(
						0 => "STANDART",
						1 => "POTENTSIALNYE_POSTAVSHCHIKI",
						2 => "TSVET",
						3 => "FORMA",
						4 => "CML2_ARTICLE",
						5 => "CML2_BASE_UNIT",
						6 => "KOD",
						7 => "CML2_MANUFACTURER",
						8 => "CML2_TRAITS",
						9 => "CML2_TAXES",
						10 => "CML2_ATTRIBUTES",
						11 => "CML2_BAR_CODE",
						12 => "POKRYTIE",
						13 => "MATERIAL",
						14 => "DIAMETR",
						15 => "DLINA",
						16 => "SHAG_REZBY",
						17 => "UPAKOVKA",
						18 => "NAIMENOVANIE_DLYA_SAYTA",
					),
					"USE_GIFTS" => "N",
				),
				false
			);
			?>
		</div>
		<br/>
	</div>
</div>

<?//LocalRedirect("/personal/order/make");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
