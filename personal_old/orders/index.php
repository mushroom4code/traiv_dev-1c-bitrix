<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
define("NEED_AUTH", true);
?>
<div class="content">
	<div class="container">
		<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
			"COMPONENT_TEMPLATE" => ".default",
			"START_FROM" => "0",
			"PATH" => "",
			"SITE_ID" => "zf",
		),
			false
		);?>

		<aside class="aside">
			<?/*$APPLICATION->IncludeComponent(
				"bitrix:menu",
				"catalog-sections",
				array(
					"ALLOW_MULTI_SELECT" => "N",
					"CHILD_MENU_TYPE" => "left",
					"DELAY" => "N",
					"MAX_LEVEL" => "1",
					"MENU_CACHE_GET_VARS" => array(
					),
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"ROOT_MENU_TYPE" => "left",
					"USE_EXT" => "Y",
					"COMPONENT_TEMPLATE" => "catalog-sections"
				),
				false
			);*/?>
			<div class="u-none--m">
				<?if(SHOW_VK_WIDGET):?>
					<script type="text/javascript" src="//vk.com/js/api/openapi.js?127"></script>
					<div id="vk_groups"></div>
					<script type="text/javascript">
						VK.Widgets.Group("vk_groups", {redesign: 1, mode: 4, width: "auto", height: "400", color1: 'FFFFFF', color2: '000000', color3: '5E81A8'}, 47382243);
					</script>
				<?endif?>

			</div>
		</aside>

		<main class="spaced-left">
		<section class="section">
			<div class="dashboard">
				<?include $_SERVER["DOCUMENT_ROOT"]."/include/personal-links.php";?>

				<div class="island">
					<?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order.list", 
	"orders", 
	array(
		"AJAX_MODE" => "N",
		"COMPONENT_TEMPLATE" => "orders",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"PATH_TO_DETAIL" => "/personal/order/#ID#/",
		"PATH_TO_COPY" => "/personal/cart/",
		"PATH_TO_CANCEL" => "/personal/order/cancel/?ID=#ID#",
		"PATH_TO_PAYMENT" => "/personal/order/payment/",
		"PATH_TO_BASKET" => "/personal/cart/",
		"ORDERS_PER_PAGE" => "20",
		"ID" => $ID,
		"SET_TITLE" => "Y",
		"SAVE_IN_SESSION" => "Y",
		"NAV_TEMPLATE" => "",
		"HISTORIC_STATUSES" => array(
			0 => "F",
		),
		"STATUS_COLOR_N" => "green",
		"STATUS_COLOR_F" => "gray",
		"STATUS_COLOR_P" => "yellow",
		"STATUS_COLOR_PSEUDO_CANCELLED" => "red"
	),
	false
);?>
				</div>
			</div>
		</section>
		</main>

		<div class="container">
			<article class="article">
				<?
				$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					".default",
					array(
						"AREA_FILE_SHOW" => "file",
						"EDIT_TEMPLATE" => "",
						"COMPONENT_TEMPLATE" => ".default",
						"PATH" => "/include/personal-text.php"
					),
					false
				);
				?>
			</article>
		</div>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
