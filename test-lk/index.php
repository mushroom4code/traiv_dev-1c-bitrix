<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовый личный кабинет");
?><div class="content">
	<div class="container">
		 <?
/*$APPLICATION->IncludeComponent(
	"bitrix:desktop", 
	"sotbit_cabinet", 
	array(
		"CAN_EDIT" => "Y",
		"COLUMNS" => "3",
		"COLUMN_WIDTH_0" => "33%",
		"COLUMN_WIDTH_1" => "33%",
		"COLUMN_WIDTH_2" => "33%",
		"GADGETS" => array(
			0 => "ALL",
		),
		"GU_ACCOUNTPAY_TITLE_STD" => "",
		"GU_BASKET_TITLE_STD" => "",
		"GU_BLANK_TITLE_STD" => "",
		"GU_BUYERS_TITLE_STD" => "",
		"GU_BUYORDER_TITLE_STD" => "",
		"GU_DELAYBASKET_TITLE_STD" => "",
		"GU_DISCOUNT_TITLE_STD" => "",
		"GU_FAVORITES_TITLE_STD" => "",
		"GU_HTML_AREA_TITLE_STD" => "",
		"GU_ORDERS_LIMIT" => "2",
		"GU_ORDERS_STATUS" => "ALL",
		"GU_ORDERS_TITLE_STD" => "",
		"GU_PROBKI_CITY" => "c213",
		"GU_PROBKI_TITLE_STD" => "",
		"GU_PROFILE_TITLE_STD" => "",
		"GU_REVIEWS_CNT" => "1",
		"GU_REVIEWS_TITLE_STD" => "",
		"GU_REVIEWS_TYPE" => "ALL",
		"GU_RSSREADER_CNT" => "10",
		"GU_RSSREADER_IS_HTML" => "N",
		"GU_RSSREADER_RSS_URL" => "",
		"GU_RSSREADER_TITLE_STD" => "",
		"GU_SUBSCRIBE_TITLE_STD" => "",
		"GU_WEATHER_CITY" => "c10174",
		"GU_WEATHER_COUNTRY" => "Россия",
		"GU_WEATHER_TITLE_STD" => "",
		"G_ACCOUNTPAY_PATH_TO_BASKET" => "/personal/cart/",
		"G_ACCOUNTPAY_PATH_TO_PAYMENT" => "/personal/order/payment",
		"G_ACCOUNTPAY_PERSON_TYPE_ID" => "2",
		"G_BASKET_PATH_TO_BASKET" => "/personal/cart/",
		"G_BLANK_INIT_JQUERY" => "N",
		"G_BLANK_PATH_TO_BLANK" => "/personal/blank_zakaza/",
		"G_BUYERS_PATH_TO_BUYER_DETAIL" => "/personal/profile/buyer/?id=#ID#",
		"G_BUYORDER_ORG_PROP" => array(
		),
		"G_BUYORDER_PATH_TO_ORDER_DETAIL" => "/personal/order/detail/#ID#/",
		"G_BUYORDER_PATH_TO_PAY" => "/personal/order/payment/",
		"G_DELAYBASKET_PATH_TO_BASKET" => "/personal/cart/?delay=1",
		"G_DISCOUNT_ID_DISCOUNT" => "",
		"G_DISCOUNT_PATH_TO_PAGE" => "",
		"G_ORDERS_PATH_TO_ORDERS" => "/personal/orders/",
		"G_ORDERS_PATH_TO_ORDER_DETAIL" => "/personal/orders/detail/#ID#/",
		"G_PROBKI_CACHE_TIME" => "3600",
		"G_PROBKI_SHOW_URL" => "N",
		"G_PROFILE_PATH_TO_PROFILE" => "/personal/profile/",
		"G_REVIEWS_MAX_RATING" => "5",
		"G_REVIEWS_PATH_TO_REVIEWS" => "/personal/reviews/",
		"G_RSSREADER_CACHE_TIME" => "3600",
		"G_RSSREADER_PREDEFINED_RSS" => "",
		"G_RSSREADER_SHOW_URL" => "N",
		"G_SUBSCRIBE_PATH_TO_SUBSCRIBES" => "/personal/subcribe/",
		"G_WEATHER_CACHE_TIME" => "3600",
		"G_WEATHER_SHOW_URL" => "N",
		"ID" => "holder1",
		"COMPONENT_TEMPLATE" => "sotbit_cabinet",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "DYNAMIC_WITHOUT_STUB",
		"COLUMN_WIDTH_3" => "10%"
	),
	false
);*/?>
	</div>
</div>
<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>