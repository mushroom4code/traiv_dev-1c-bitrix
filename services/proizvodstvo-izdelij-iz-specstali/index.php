<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Производство изделий из спецстали. Быстрая доставка по Москве, Санкт-Петербургу и всей России ✅ Оптовикам скидки! ☎️ Звоните!");
$APPLICATION->SetTitle("");?>
<?$APPLICATION->SetTitle("Производство изделий из спецстали");?>
<section id="content">
	<div class="container">
	<?/*$APPLICATION->AddChainItem('Услуги компании', "/services/");*/?>
		 <?/*$APPLICATION->AddChainItem('Услуги', "/services/");?> <?$APPLICATION->AddChainItem('Производство изделий из спецстали', "/services/proizvodstvo-izdelij-iz-specstali/");?> <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"traiv.production",
	Array(
		"COMPONENT_TEMPLATE" => "traiv.new",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PATH" => "/",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);*/?>

        <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "zf",
            ),
                false
            ); ?>
            
                        <div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span>Производство изделий из спецстали</span></h1>
    </div>
</div>

 <div class="row">
        <div class="col-3">

        <?
        
        $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "sections-elements",
            array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "provo",
                "COMPONENT_TEMPLATE" => "sections-elements",
                "DELAY" => "N",
                "MAX_LEVEL" => "3",
                "MENU_CACHE_GET_VARS" => array(
                ),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_USE_GROUPS" => "N",
                "MENU_THEME" => "site",
                "ROOT_MENU_TYPE" => "provo",
                "USE_EXT" => "Y",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO"
            ),
            false
            );
        
        /*$APPLICATION->IncludeComponent("bitrix:menu", "catalog_services_menu", Array(
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"CHILD_MENU_TYPE" => "catalog_left_menu",	// Тип меню для остальных уровней
		"COMPONENT_TEMPLATE" => "catalog_vertical",
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"MAX_LEVEL" => "4",	// Уровень вложенности меню
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
		"MENU_CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
		"MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
		"ROOT_MENU_TYPE" => "news_left_menu",	// Тип меню для первого уровня
		"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"MENU_THEME" => "site",	// Тема меню
	),
	false
);
*/?>
        </div>
    <div class="col-9">
		<div class="news-detail">
			<p style="text-align:justify">
				 Компания Трайв-Комплект поставляет специальный крепеж для нефтяной и газовой промышленности, изготовленного из специальных сплавов и стали. Широкий спектр болтов, винтов, гаек, шпилек, и многого другого на наших ближайших складах в Европе! Огромный выбор размеров, материалов и покрытий. <strong>Нестандартный крепеж - это наш стандарт!</strong> Качество гарантировано! По требованию предоставляются сертификаты TUV и 3.1В.
			</p>
			<table class="content_tb_td_center" width="85%">
			<tbody>
			<tr>
				<th colspan="4">
					 Специальные стали и сплавы
				</th>
			</tr>
			<tr>
				<td>
 <strong>НЕРЖАВЕЮЩИЕ СТАЛИ</strong>
					<p>
						 303
					</p>
					<p>
						 304
					</p>
					<p>
						 304 STRAIN HARD
					</p>
					<p>
						 304 ELC
					</p>
					<p>
						 309
					</p>
					<p>
						 310
					</p>
					<p>
						 316
					</p>
					<p>
						 316 STRAIN HARD
					</p>
					<p>
						 316 ELC
					</p>
					<p>
						 317 ELC
					</p>
					<p>
						 321
					</p>
					<p>
						 330
					</p>
					<p>
						 347
					</p>
					<p>
						 410
					</p>
					<p>
						 410 HEAT TREATED
					</p>
					<p>
						 416
					</p>
					<p>
						 430
					</p>
					<p>
						 440C
					</p>
					<p>
						 501 HEAT TREATED
					</p>
					<p>
						 17-4 PH
					</p>
					<p>
						 904L
					</p>
					<p>
						 ALLOY 20
					</p>
					<p>
						 A286
					</p>
					<p>
						 254-SMO
					</p>
					<p>
						 CARPENTER 20 Cb3 vFERRALIUM 255
					</p>
					<p>
						 NITRONIC 50
					</p>
					<p>
						 NITRONIC 60
					</p>
				</td>
				<td>
 <strong>НЕРЖАВЕЮЩИЕ СТАЛИ</strong>
					<p>
						 ASTM A193 B5
					</p>
					<p>
						 ASTM A193 B6
					</p>
					<p>
						 ASTM A193 B8 CLASS 1
					</p>
					<p>
						 ASTM A193 B8 CLASS 2
					</p>
					<p>
						 ASTM A193 B8M CLASS 1
					</p>
					<p>
						 ASTM A193 B8M CLASS 2
					</p>
					<p>
						 ASTM A193 B8C
					</p>
					<p>
						 ASTM A193 B8R
					</p>
					<p>
						 ASTM A193 B8S
					</p>
					<p>
						 ASTM A193 B8T
					</p>
					<p>
						 ASTM A193 B8 CLASS 1
					</p>
					<p>
						 ASTM A193 B8 CLASS 2
					</p>
					<p>
						 ASTM A193 B8M CLASS 1
					</p>
					<p>
						 ASTM A193 B8M CLASS 2
					</p>
					<p>
						 ASTM A453 660B
					</p>
					<p>
						 ASTM A453 660D
					</p>
					<p>
 <strong>МЕДНЫЕ СПЛАВЫ</strong>
					</p>
					<p>
						 COPPER
					</p>
					<p>
						 BRASS
					</p>
					<p>
						 NAVAL BRASS
					</p>
					<p>
						 SILICON BRONZE
					</p>
					<p>
						 ALUMINIUM BRONZE
					</p>
					<p>
						 PHOSPHOR BRONZE
					</p>
					<p>
						 CUPRO-NICKEL
					</p>
				</td>
				<td>
					<p>
 <strong>НИКЕЛЕВЫЕ СПЛАВЫ</strong>
					</p>
					<p>
						 NICKEL 200
					</p>
					<p>
						 MONEL 400
					</p>
					<p>
						 MONEL R-405
					</p>
					<p>
						 MONEL K-500
					</p>
					<p>
						 INCONEL 600
					</p>
					<p>
						 INCONEL 601
					</p>
					<p>
						 INCONEL 625
					</p>
					<p>
						 INCONEL 718
					</p>
					<p>
						 INCONEL X-750
					</p>
					<p>
						 INCONEL 925
					</p>
					<p>
						 INCOLOY 800H
					</p>
					<p>
						 INCOLOY 825
					</p>
					<p>
						 HASTELLOY C-276
					</p>
					<p>
						 СПЛАВЫ DUPLEX
					</p>
					<p>
						 2205
					</p>
					<p>
						 AL-6XN
					</p>
					<p>
						 СПЛАВЫ SUPER DUPLEX
					</p>
					<p>
						 2507
					</p>
					<p>
						 ZERON 100
					</p>
					<p>
						 АЛЮМИНИЕВЫЕ СПЛАВЫ
					</p>
					<p>
						 2024Т4
					</p>
					<p>
						 6061Т6
					</p>
				</td>
				<td>
 <strong>ЛЕГИРОВАННЫЕ СТАЛИ</strong>
					<p>
						 4140
					</p>
					<p>
						 4340
					</p>
					<p>
						 ASTM A193 B7
					</p>
					<p>
						 ASTM A193 B7M
					</p>
					<p>
						 ASTM A193 B16
					</p>
					<p>
						 ASTM A320 L7
					</p>
					<p>
						 ASTM A320 L7M
					</p>
					<p>
						 ASTM A320 L43
					</p>
					<p>
						 ASTM A354 BC
					</p>
					<p>
						 ASTM A354 BD
					</p>
					<p>
						 SAE J429 Grade 8
					</p>
					<p>
 <strong>УГЛЕРОДИСТЫЕ СТАЛИ</strong>
					</p>
					<p>
						 1018
					</p>
					<p>
						 1020
					</p>
					<p>
						 1045
					</p>
					<p>
						 1117
					</p>
					<p>
						 12L14
					</p>
					<p>
						 1215
					</p>
					<p>
						 A36
					</p>
					<p>
 <strong>ТИТАН</strong>
					</p>
					<p>
						 ASTM B348
					</p>
					<p>
						 ASTM B381
					</p>
				</td>
			</tr>
			</tbody>
			</table>
			<p>
 <strong>Болт крюк</strong>
			</p>
			<p>
				 ASF стандартые типоразмеры
			</p>
			<p>
 <img alt="Болт крюк ASF" src="/images/catalog/asf_bent_bolt.jpg" title="Болт крюк ASF">
			</p>
			<p>
 <strong>Болты</strong>
			</p>
			<p>
				 ASF стандартые типоразмеры
			</p>
			<p>
 <img alt="Болт ASF" src="/images/catalog/asf_bolt.jpg" title="Болт ASF">
			</p>
			<p>
 <strong>Гайки</strong>
			</p>
			<p>
				 ASF стандартые типоразмеры
			</p>
			<p>
 <img alt="Гайки ASF" src="/images/catalog/asf_gaiki.jpg" title="Гайки ASF">
			</p>
			<p>
 <strong>Шпильки</strong>
			</p>
			<p>
				 ASF стандартые типоразмеры
			</p>
			<p>
 <img alt="Шпильки ASF" src="/images/catalog/asf_shpilki.jpg" title="Шпильки ASF">
			</p>
			<h3>Купить специальный крепеж</h3>
			<p style="text-align:justify">
				 В компании "Трайв-Комплект" вы можете купить любой вид крепежа изготовленного из специальных материалов для газовой и нефтяной промышленности. Чтобы сделать заказ на нужный вам крепеж, позвоните по телефону +7 (812) 313-22-80 и наши менеджеры предложат вам самые низкие цены и минимальные сроки поставки.
			</p>
 <br>
		</div>
 </div>
	</div>
</section><?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>