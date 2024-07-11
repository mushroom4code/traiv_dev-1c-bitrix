<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
    <?$APPLICATION->SetTitle("Снятие покрытия");?>
<section id="content">
	<div class="container">
        <?/*$APPLICATION->AddChainItem('Услуги компании', "/services/");*/?>
        <?$APPLICATION->AddChainItem('Снятие покрытия', "/services/snjatie-pokrytija/");?>

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
    	<h1><span>Снятие покрытия</span></h1>
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
            <p align="justify">
                <img alt="Снятие покрытия с метизов" src="/images/articles/snyatie-pokrytiya-s-metizov.jpg" title="Снятие покрытия с метизов" style="margin-right: 10px;" width="130" border="0" align="left">В настоящее время производителями практически весь выпускаемый крепеж подвергается антикоррозийной обработке. Она может заключаться в том, что на металлический элемент наносится тонкий слой цинка или лакокрасочное покрытие. В результате крепеж приобретает лучшую стойкость к воздействию окружающей среды.&nbsp;
            </p>
            <p align="justify">
                Но со временем под действием внешних факторов, например вследствие механических повреждений антикоррозийный слой нарушается и тогда его приходится восстанавливать.&nbsp;
            </p>
            <p align="justify">
                Или может оказаться так, что цинковое покрытие было нанесено некачественно и в этом случае перед использованием деталей ее следует подвергнуть дополнительной обработке.&nbsp;
            </p>
            <p align="justify">
                Рассмотрим, каким образом осуществляется снятие покрытий с метизов и крепежа.
            </p>
            <h2>Чем удаляются покрытия с различных материалов</h2>
            <p align="justify">
                Крепеж может изготавливаться из различных материалов и следовательно эти материалы будут обладать различными физическими свойствами. Поэтому выбор способа удаления покрытий осуществляется в зависимости от того, какое покрытие и с какого материала предстоит удалять. Так как в большинстве случаев на метизах в качестве антикоррозийного покрытия используется цинк, то рассмотрим, каким образом он удаляется с тех или иных материалов.
            </p>
            <p align="justify">
                Если крепеж был изготовлен из стали, то удаления с него покрытия осуществляется при помощи цианистых растворов. Они станут активно взаимодействовать с цинком и в тоже время останутся инертны к стали. Если изделие было изготовлено из латуни или меди, то необходимо использовать серную кислоту или растворы щелочи. Только эти вещества способны растворить цинк и не нанести вреда основной поверхности детали. Скорость растворения цинка в активных средах составляет 100 мкм/час при условии, что процесс происходит при комнатной температуре. После того, как обработка поверхностей будет завершена на деталях остается окалина, которую необходимо снять. Делается это при помощи различных видов обработки, например карцеванием.
            </p>
            <div align="center">
                <img alt="Снятие покрытия с метизов" src="/images/articles/snyatie-pokrytiya-s-krepega.jpg" style="max-width: 95%;" title="Снятие покрытия с метизов" vspace="5" hspace="5" border="0">
            </div>
            <h2>Особенности проведения работ</h2>
            <p align="justify">
                Вы наверняка обратили внимание на то, что рассматриваемый вид работ осуществляется с использованием химически активных веществ. Для работы с такими веществами необходимо иметь опыт, защитное и производственное оборудование. Именно поэтому все действия по обработке крепежа должны осуществляться специализированной компанией. Только в этом случае можно гарантировать, что все действия будут выполнены качественно с минимальными затратами времени и средств.
            </p>
            <p align="justify">
                <span>Для того чтобы <b>снять покрытие с метизов</b> позвоните нам по тел. +7(812)313-22-80 или отправьте заявку на почту: <a href="mailto:info@traivkomplekt.ru">info@traiv-komplekt.ru</a></span><br>
                <br>
            </p>
        </div>
    </div>
</div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>