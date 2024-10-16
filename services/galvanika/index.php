<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
    <?$APPLICATION->SetTitle("Гальваника");?>
<section id="content">
	<div class="container">
        <?/*$APPLICATION->AddChainItem('Услуги компании', "/services/");*/?>
        <?$APPLICATION->AddChainItem('Гальваника', "/services/galvanika/");?>

        <?/*$APPLICATION->IncludeComponent(
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
    	<h1><span>Гальваника</span></h1>
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
);*/?>
        </div>
    <div class="col-9">
        <div class="news-detail">
            <div style="text-align: justify;">
                <p align="justify"><img id="main_picture" src="/img/galvanika.jpg" style="margin-right:10px;" align="left" alt="Гальваника" title="Гальваника">
                    Долгосрочность и надежность любого соединения, в котором используются металлические элементы, напрямую зависят от качества защиты материала, который был использован для изготовления, от коррозии. Этот окислительный процесс способен очень быстро привести в негодность практически любую конструкцию, если металл ее не обработан по специальным технологиям и подвергается воздействию окружающей среды.
                </p>


                <p align="justify">
                <p>Одним из&nbsp;наиболее эффективных способов защиты материалов является гальваника. Эта методика позволяет наносить на&nbsp;один вид металла, подверженный коррозии, тонкий слой другого металла, устойчивого к&nbsp;окислению. Таким образом, создается надежное инертное покрытие, способное долгое время предотвращать разрушение структуры материала, из&nbsp;которого выполнено изделие. Технология имеет широкое распространение во&nbsp;многих отраслях и&nbsp;производствах еще и&nbsp;потому, что таким доступным и&nbsp;недорогим способом можно наносить равномерное покрытие на&nbsp;предметы любой формы, имеющей самые различные выпуклости, впадины и&nbsp;отверстия.</p>
                </p>
                <p align="justify">
                <p>Наиболее важным звеном в&nbsp;каждом соединении является крепеж, поэтому к&nbsp;его качеству предъявляются особые, высокие требования. И&nbsp;одним из&nbsp;параметров становится именно покрытие метизов, выполненное с&nbsp;помощью гальваники. Эта технология достаточно проста и&nbsp;не&nbsp;требует <nobr>каких-либо</nobr> значительных затрат, дает хороший результат и&nbsp;может использоваться для самых разных, даже не&nbsp;металлических, материалов. В&nbsp;основе методики лежит способность ионов металлов под действием постоянного электрического поля перемещаться в&nbsp;жидкости и&nbsp;оседать на&nbsp;поверхности предметов, образуя сплошной слой толщиной от&nbsp;нескольких атомов. Поэтому гальваника не&nbsp;изменяет размеров обработанного изделия, но&nbsp;при этом создает надежную защиту металла от&nbsp;воздействия кислорода воздуха. Такое покрытие не&nbsp;отслаивается со&nbsp;временем, а&nbsp;нарушить его можно только повредив основу, на&nbsp;которую он&nbsp;нанесен.</p>
                </p>

                <h2>Цены на гальваническое покрытие</h2>

                <div class="row" style="text-align: center;">
                    <div class="col-4 mb-2">
                        Гальваническое цинкование <br> ГОСТ 9.301-86.<br> Цена от 15 рублей за киллограм с НДС.&nbsp;<br>
                        <img alt="Гальваническое цинкование ГОСТ 9301-86" src="/img/galvanika_zink_gost_9301-86.jpg" border="0" title="">
                    </div>

                    <div class="col-4 mb-2">
                        Горячее цинкование <br>ГОСТ 9.307-89<br> Цена от 21 рублей за киллограм с НДС.<br>
                        <img alt="Горячее цинкование ГОСТ 9307-89" src="/img/goryachii_cink.jpg" border="0" title="">
                    </div>

                    <div class="col-4 mb-2">
                        Термодиффузиозное цинковое покрытие <br>ГОСТ 9.316-2006.<br> Цена от 15 рублей за киллограм с НДС.<br>
                        <img alt="Термодиффузиозное цинковое покрытие ГОСТ 9316-2006" src="/img/termo_zink_pokritie_gost930.jpg" border="0" title="">
                    </div>
                </div>


                <p align="justify">
                    Практически весь современный крепеж, если он не изготовлен из нержавеющей стали или устойчивых цветных сплавов, обязательно проходит процесс гальванизации. Это приводит к увеличению сроков использования изделий, следовательно, повышается их качество и спрос на такой крепеж. Кроме чисто утилитарного применения, гальванику можно выполнять для нанесения декоративного слоя на самые разнообразные предметы со сложными поверхностями – посуду, статуэтки, фурнитуру, детали и многое другое. </p>
                <p align="justify">
                    В каталоге нашего интернет-магазина всегда есть в наличии и в любом количестве предложение товаров, обработанных с помощью технологии гальванизирования. Кроме того, наше предприятие дополнительно предоставляет целый ряд услуг, способных помочь нашим клиентам получить самые качественные изделия из металлов. И наиболее востребованная среди них – гальваника, цены всех видов которой вы сможете узнать в предоставленном на сайте прайс-листе или у наших менеджеров. Современное оборудование, которым располагает наша производственная компания, позволяет нам производить значительный ассортимент работ по покрытию изделий защитным или декоративным слоем:<br>

                <ul>
                    <li>Хромирование</li>
                    <li>Меднение</li>
                    <li>Цинкование</li>
                    <li>Никелирование</li>
                    <li>Олово-висмутовое покрытие</li>
                    <li>Химическое оксидирование</li>
                    <li>Химическое пассивирование</li>
                    <li>Анодирование</li>
                    <li>Электрополировка</li>
                </ul>

                </p><p align="justify">
                    Все услуги гальваники мы осуществляем на собственном производстве, поэтому вы можете в любой момент обратиться за профессиональной помощью к нам и максимально быстро получить наиболее качественный результат. Наши специалисты владеют необходимой квалификацией для проведения всех технологических процессов на самом высоком профессиональном уровне, соответствующем самым требовательным международным стандартам качества. Поэтому любой ваш заказ будет выполнен наилучшим образом.<br>
                </p><p align="justify"></p><h2>Гальваника в СПб</h2><p align="justify"></p><p align="justify">
                    Для того чтобы&nbsp;сделать гальваническое покрытие&nbsp;позвоните нам по тел. +7(812)313-22-80 или отправьте заявку на почту:
                    <a href="mailto:info@traiv-komplekt.ru">info@traiv-komplekt.ru</a>.<br> <br>
                </p>

                <div style="text-align: center;">

                    <iframe width="420" height="315" src="https://www.youtube.com/embed/yvCEVwbaD_U" frameborder="0" allowfullscreen></iframe>

                </div>
        </div>
    </div>
</div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>