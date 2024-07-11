<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Личные данные");
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
						"bitrix:main.profile",
						"personal",
						array(
							"SET_TITLE" => "Y",
							"COMPONENT_TEMPLATE" => "personal",
							//"AJAX_MODE" => "Y",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"AJAX_OPTION_HISTORY" => "N",
							"AJAX_OPTION_ADDITIONAL" => "undefined",
							"USER_PROPERTY" => array(
							),
							"SEND_INFO" => "Y",
							"CHECK_RIGHTS" => "N",
							"USER_PROPERTY_NAME" => ""
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