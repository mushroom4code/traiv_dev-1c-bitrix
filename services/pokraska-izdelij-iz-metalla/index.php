<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
    <?$APPLICATION->SetTitle("Покраска изделий из металла");?>
<section id="content">
	<div class="container">
        <?/*$APPLICATION->AddChainItem('Услуги компании', "/services/");*/?>
        <?$APPLICATION->AddChainItem('Покраска изделий из металла', "/services/pokraska-izdelij-iz-metalla/");?>

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
    	<h1><span>Покраска изделий из металла</span></h1>
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
                <img alt="Покраска изделий" src="/img/pokraska_metizov.jpg" style="margin-right:20px;" align="left">
                Металл достаточно практичный материал, но у него есть один небольшой минус – рано или поздно он поддается коррозии. <br>
                <br>
                Что бы такой проблемы не возникало, лучше всего обработать металл специальной краской.<br>
                <br>
                <br>
                Такая краска имеет целый ряд своих преимуществ по сравнению с другими покрытиями против коррозии:<br>
                <br>
                <ul>
                    <li>Цена. В наше время цена играет большую роль. Но, так как стоимость такой краски гораздо дешевле других покрытий, это выводит данный метод защиты на шаг вперед.</li>
                    <li>Покрытие можно осуществить в любом цвете.</li>
                    <li>Простота процесса нанесения.</li>
                </ul>
            </div>
            <p align="justify">
                Помимо всего этого покраска позволяет с легкостью обработать как крупногабаритные металлические конструкции так и мелкие детали.<br>
                <br>
                Для обработки металлических изделий используется несколько видов специальных красок:<br>
            </p>
            <ul>
                <li>«Быстромет» - специальная краска-эмаль, которая имеет высокую скорость высыхания.</li>
                <li>«Нержамет» - эмаль по металлу, которую нужно наносить на саму ржавчину.</li>
                <li>«Цикроль» - специальная краска, которая используется во избежание коррозии на оцинкованном металле.</li>
                <li>«Нержапласт» - так называемый «жидкий пластик», краска с эффектом пластмассы.</li>
                <li>«Нержалюкс» - эмаль для цветного металла.</li>
                <li>«Молотекс» - декоративная краска с эффектом кузнечного молота.</li>
            </ul>
            <p>
            </p>
            <p align="justify">
                К тому же помимо всего этого так же можно использовать специальную грунтовку, которая не даст цвета, но защитит металл от коррозии:<br>
            </p>
            <ul>
                <li>«Фосфогрунт» - «холодная» грунтовка.</li>
                <li>«Нержамент-Грунт» - алкидный грунт (быстросохнущий).</li>
                <li>«Цинконол» - «холодное» цинкование металла.</li>
                <li>«Фосфомет» - преобразовывает ржавчину в пыль.</li>
            </ul>
            <p>
            </p>
            <p align="justify">
                Очень важно правильно обработать материал перед окраской, ведь при соблюдении этого правила и инструкций по самой окраске, про качество и срок годности окраски можно вовсе не волноваться.
            </p>
            <p align="justify">
                Краски против коррозии используются для металлических изделий любого вида, это могут быть: металлические заборы и ворота, окна, лестницы, решётки и двери, сейфы, шкафы и стеллажи, и даже кровати со стульями. Так же окрасить можно отдельные части предмета, например, болты и гайки, что бы предать особую изящность предмету.
            </p>
            <p align="justify">
            </p>
            <h2><b>Покраска крепежа в СПб</b></h2>
            <p align="justify">
                Экономить на такой покраске не стоит, ведь лучше потратиться один раз на окраску, чем по нескольку раз заменять все металлическое в конструкции.<br>
                Заказать окраску металлических изделий можно на нашем сайте. Для этого вам нужно просто позвонить по номеру 8-800-333-36-30, либо оставить заявку-заказ на электронной почте <a href="mailto:info@traiv-komplekt.ru">info@traiv-komplekt.ru</a>. Окраска металла – лучшая его защита от коррозии!
            </p>
            <p align="justify">
                Для того чтобы&nbsp;сделать покраску метизов&nbsp;позвоните нам по тел. +7(812)313-22-80 или отправьте заявку на почту: <a href="mailto:info@traivkomplekt.ru">info@traiv-komplekt.ru</a>.<br>
            </p>
        </div>
    </div>
</div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>