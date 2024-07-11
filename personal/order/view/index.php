<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (!$USER->IsAuthorized()) {
    if ($_REQUEST["AJAX_MODE"] != "Y") {
        LocalRedirect("/auth/?backurl=".$APPLICATION->GetCurPage());
    }
}

$APPLICATION->SetTitle("Заказ");
?>
<section id="content">
	<div class="container">
		<div class="catalog-item ">
			<h1>
				<?$APPLICATION->ShowTitle(false);?>
			</h1>

<?$APPLICATION->IncludeComponent("bitrix:sale.personal.order.detail", "orderview", Array(
	"PATH_TO_LIST" => "order_list.php",	// Страница со списком заказов
		"PATH_TO_CANCEL" => "order_cancel.php",	// Страница отмены заказа
		"PATH_TO_PAYMENT" => "payment.php",	// Страница подключения платежной системы
		"PATH_TO_COPY" => "",	// Страница повторения заказа
		"ID" => $_REQUEST["SECTION_CODE"],	// Идентификатор заказа
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"PICTURE_WIDTH" => "110",	// Ограничение по ширине для анонсного изображения, px
		"PICTURE_HEIGHT" => "110",	// Ограничение по высоте для анонсного изображения, px
		"PICTURE_RESAMPLE_TYPE" => "1",	// Тип масштабирования
		"CUSTOM_SELECT_PROPS" => "",	// Дополнительные свойства инфоблока
		"PROP_1" => "",	// Не показывать свойства для типа плательщика "Физическое лицо" (s1)
		"PROP_2" => "",	// Не показывать свойства для типа плательщика "Юридическое лицо" (s1)
	),
	false
);?>

			<?
			//echo $_REQUEST["ID"];
			//echo $_REQUEST["SECTION_CODE"];
			/*$APPLICATION->IncludeComponent(
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
			);*/
			?>
		</div>
	</div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>