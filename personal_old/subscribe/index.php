<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Подписка");
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
					<? $APPLICATION->IncludeComponent(
						"asd:subscribe.quick.form",
						".default",
						array(
							"COMPONENT_TEMPLATE" => ".default",
							"RUBRICS" => array(
								0 => "1",
							),
							"SHOW_RUBRICS" => "Y",
							"INC_JQUERY" => "N",
							"NOT_CONFIRM" => "Y",
							"FORMAT" => "text"
						),
						false
					); ?>
				</div>
			</div>
		</section>
	</main>

	<div class="container">
		<article class="article">
			<h3 class="sm-title sm-title--blue">«Трайв-Комплект» специализируется на поставках оптом метизов и крепежных элементов.</h3>
			<p>Крепежи используются во многих промышленных областях. В частности, в строительстве, в производстве мебели, в автомобильной и железнодорожной промышленности.
				В зависимости от области применения и функционального назначения различают силовой и малонагруженный крепежи.</p>
			<p>В понятие крепежа включается и такое понятие, как метизы (т.е., металлические изделия). Основная классификация метизов: метизы широкого назначения и метизы промышленного назначения.
				«Трайв-Комплект» занимается поставками метизов промышленного назначения и строительного крепежа. К этому виду метизов относят: винты, шайбы, болты, гайки, шпильки, заклепки, саморезы, шплинты и другие элементы крепежа.
				«Трайв-Комплект» предлагает приобрести крепеж и метизы оптом. Ассортимент этой продукции представлен во всем многообразии: крепеж общего назначения, крепеж для высоких нагрузок, для теплоизоляции, сантехники, электропроводки. Также всегда в наличии имеется нержавеющий крепеж, высокопрочный крепеж, полиамидный крепеж, латунный крепеж и многие другие виды крепежа.
				Все перечисленные позиции можно заказать на сайте «Трайв-Комплект» оптом или купить в розничном магазине компании.
			</p>
			<p>Метизы и крепеж, поставляемые нашим магазином, соответствуют европейским стандартам качества ISO и DIN. Любая гайка, болт, шпилька и прочие элементы, приобретенные у "Трайв-Комплект", изготовлены с соблюдением всех необходимых требований.</p>
		</article>
	</div>
</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>   