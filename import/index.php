<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Импортозамещение крепежа: ГК «Трайв» - ваш технологический партнер по импортозамещению. Быстрая доставка по Москве, Санкт-Петербургу и всей России ✅ Оптовикам скидки! ☎️ Звоните!");
$APPLICATION->SetTitle("Импортозамещение крепежа: ГК «Трайв» - ваш технологический партнер по импортозамещению");
?>
<section id="content">
	<div class="container">

            <? $APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"traiv-new", 
	array(
		"COMPONENT_TEMPLATE" => "traiv",
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>

<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span>Импортозамещение крепежа</span></h1>
    </div>
</div>

</div>


<div class="container">

<div class="row g-0 position-relative" id="is-landing-row-image">
	<div class="col-12 col-xl-6 col-lg-6 col-md-6 text-left">
		<div class="import-title-back-black">
			<span class="big-title">Импортозамещение</span>
			<span class="small-title">Интегрируем импортозамещение в ваше производство</span>


<div class="row mt-5">
<div class="col-12 col-xl-4 col-lg-4 col-md-4 text-center text-sm-left text-lg-left text-md-left text-xl-left">
      	<div class="btn-group-blue-100">
                    <a href="#w-form" class="btn-white-border" rel="nofollow">
                        <span>Отправить запрос</span>
                    </a>
                </div>
</div>

<div class="col-12 col-xl-4 col-lg-4 col-md-4 pt-3 pt-sm-0 pt-xl-0 pt-lg-0 pt-md-0 text-center text-sm-left text-lg-left text-md-left text-xl-left">
				<div class="btn-group-blue-100">
                    <a href="#part1" class="btn-white-border" rel="nofollow">
                        <span>Смотреть проекты</span>
                    </a>
                </div>
				</div>
</div>

		</div>



	</div>
	
	<div class="col-12 col-xl-6 col-lg-6 col-md-6 text-left">
		<div class="row h-100">
			<div class="col-12 col-xl-12 col-lg-12 col-md-12 position-relative">
			<ul class="import-title-cloud-item-area">
				<li><span class="import-title-cloud-item"><i class="fa fa-check-square-o"></i>Продукты металлообработки</span></li>
				<li><span class="import-title-cloud-item"><i class="fa fa-check-square-o"></i>Метизные изделия</span></li>
				<li><span class="import-title-cloud-item"><i class="fa fa-check-square-o"></i>Крепежные решения</span></li>
				<li><span class="import-title-cloud-item"><i class="fa fa-check-square-o"></i>Изделия по чертежам</span></li>
				<li><span class="import-title-cloud-item"><i class="fa fa-check-square-o"></i>Нанесение покрытий</span></li>
			</ul>
			</div>				
			
		</div>
	</div>
	
</div>

</div>

<?php
/*if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {*/
?>

<!-- <div class="container">
    <div class="row">
	    <div class="col-12 col-xl-12 pt-5 col-lg-12 col-md-12 text-center">-->
	    
	    	         <a href="#x" class="w-form__overlay" id="w-form-spec"></a>
         <div class="w-form__popup">
	    
	                 <?$APPLICATION->IncludeComponent(
	"slam:easyform", 
	"traiv-import", 
	array(
		"COMPONENT_TEMPLATE" => "traiv-import",
		"FORM_ID" => "FORM20",
		"FORM_NAME" => "Импортозамещение",
		"WIDTH_FORM" => "450px",
		"DISPLAY_FIELDS" => array(
			0 => "TITLE",
			1 => "EMAIL",
			2 => "PHONE",
			3 => "MESSAGE",
			4 => "DOCS",
			5 => "CUR_URL",
			6 => "NEED_ITEM",
			7 => "",
		),
		"REQUIRED_FIELDS" => array(
			0 => "TITLE",
			1 => "PHONE",
			2 => "NEED_ITEM",
		),
		"FIELDS_ORDER" => "TITLE,NEED_ITEM,PHONE,CUR_URL,EMAIL,MESSAGE,DOCS",
		"FORM_AUTOCOMPLETE" => "Y",
		"HIDE_FIELD_NAME" => "N",
		"HIDE_ASTERISK" => "N",
		"FORM_SUBMIT_VALUE" => "Отправить",
		"SEND_AJAX" => "Y",
		"SHOW_MODAL" => "N",
		"_CALLBACKS" => "",
		"TITLE_SHOW_MODAL" => "Спасибо!",
		"OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение ближайшего рабочего часа",
		"ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
		"ENABLE_SEND_MAIL" => "Y",
		"CREATE_SEND_MAIL" => "",
		"EVENT_MESSAGE_ID" => array(
		),
		"EMAIL_TO" => "info@traiv-komplekt.ru",
		"EMAIL_BCC" => "dmitrii.kozlov@traiv.ru",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы Импортозамещение",
		"EMAIL_FILE" => "Y",
		"EMAIL_SEND_FROM" => "N",
		"CREATE_SEND_MAIL_SENDER" => "",
		"EVENT_MESSAGE_ID_SENDER" => array(
			0 => "121",
		),
		"EMAIL_BCC_SENDER" => "gonchar@traiv.ru",
		"MAIL_SUBJECT_SENDER" => "#SITE_NAME#: Сообщение из формы Импортозамещение",
		"USE_IBLOCK_WRITE" => "Y",
		"CATEGORY_TITLE_TITLE" => "Ваше имя",
		"CATEGORY_TITLE_TYPE" => "text",
		"CATEGORY_TITLE_PLACEHOLDER" => "",
		"CATEGORY_TITLE_VALUE" => "",
		"CATEGORY_TITLE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_TITLE_VALIDATION_ADDITIONALLY_MESSAGE" => "maxlength=\"400\"",
		"CATEGORY_EMAIL_TITLE" => "Ваш E-mail",
		"CATEGORY_EMAIL_TYPE" => "email",
		"CATEGORY_EMAIL_PLACEHOLDER" => "example@example.com",
		"CATEGORY_EMAIL_VALUE" => "",
		"CATEGORY_EMAIL_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_EMAIL_VALIDATION_ADDITIONALLY_MESSAGE" => "data-bv-emailaddress-message=\"E-mail введен некорректно\"",
		"CATEGORY_PHONE_TITLE" => "Мобильный телефон",
		"CATEGORY_PHONE_TYPE" => "tel",
		"CATEGORY_PHONE_PLACEHOLDER" => "+7(999)999-99-99",
		"CATEGORY_PHONE_VALUE" => "",
		"CATEGORY_PHONE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_PHONE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_PHONE_INPUTMASK" => "Y",
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
		"CATEGORY_MESSAGE_TITLE" => "Комментарий, техническое задание",
		"CATEGORY_MESSAGE_TYPE" => "textarea",
		"CATEGORY_MESSAGE_PLACEHOLDER" => "",
		"CATEGORY_MESSAGE_VALUE" => "",
		"CATEGORY_MESSAGE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"USE_CAPTCHA" => "N",
		"USE_MODULE_VARNING" => "N",
		"USE_FORMVALIDATION_JS" => "Y",
		"HIDE_FORMVALIDATION_TEXT" => "N",
		"INCLUDE_BOOTSRAP_JS" => "Y",
		"USE_JQUERY" => "N",
		"USE_BOOTSRAP_CSS" => "Y",
		"USE_BOOTSRAP_JS" => "Y",
		"CUSTOM_FORM" => "",
		"CAPTCHA_TITLE" => "",
		"CATEGORY_DOCS_TITLE" => "Вложение",
		"CATEGORY_DOCS_TYPE" => "file",
		"CATEGORY_DOCS_FILE_EXTENSION" => "doc, docx, xls, xlsx, txt, rtf, pdf, png, jpeg, jpg, gif",
		"CATEGORY_DOCS_FILE_MAX_SIZE" => "20971520",
		"CATEGORY_DOCS_DROPZONE_INCLUDE" => "N",
		"USE_INPUTMASK_JS" => "N",
		"CATEGORY_______________________________________________TITLE" => "ИНН (для юридических лиц)",
		"CATEGORY_______________________________________________TYPE" => "text",
		"CATEGORY_______________________________________________PLACEHOLDER" => "",
		"CATEGORY_______________________________________________VALUE" => "",
		"CATEGORY_______________________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "^[a-zA-Z0-9_]+\$",
		"CREATE_IBLOCK" => "",
		"IBLOCK_TYPE" => "-",
		"IBLOCK_ID" => "33",
		"ACTIVE_ELEMENT" => "N",
		"CATEGORY_TITLE_IBLOCK_FIELD" => "NAME",
		"CATEGORY_EMAIL_IBLOCK_FIELD" => "FORM_EMAIL",
		"CATEGORY_PHONE_IBLOCK_FIELD" => "FORM_PHONE",
		"CATEGORY_MESSAGE_IBLOCK_FIELD" => "PREVIEW_TEXT",
		"CATEGORY_DOCS_IBLOCK_FIELD" => "FORM_DOCS",
		"CATEGORY_______________________________________________IBLOCK_FIELD" => "FORM_ИНН (для юридических лиц)",
		"FORM_SUBMIT_VARNING" => "Нажимая на кнопку \"#BUTTON#\", вы даете согласие на обработку <a target=\"_blanc\" href=\"/politika-konfidentsialnosti/\">персональных данных</a>",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CATEGORY_CUR_URL_TITLE" => "URL текущей страницы",
		"CATEGORY_CUR_URL_TYPE" => "hidden",
		"CATEGORY_CUR_URL_VALUE" => $GLOBALS["APPLICATION"]->GetCurDir(),
		"CATEGORY_CUR_URL_IBLOCK_FIELD" => "FORM_CUR_URL",
		"CATEGORY_ACCEPT_TITLE" => "Согласие на обработку данных",
		"CATEGORY_ACCEPT_TYPE" => "accept",
		"CATEGORY_ACCEPT_VALUE" => "Согласен на обработку <a href=\"#\" target=\"_blank\">персональныx данных</a>",
		"CATEGORY_ACCEPT_IBLOCK_FIELD" => "FORM_ACCEPT",
		"CATEGORY_NEED_ITEM_TITLE" => "Потребность (продукция - наименование, количество, периодичность заказов)",
		"CATEGORY_NEED_ITEM_TYPE" => "textarea",
		"CATEGORY_NEED_ITEM_PLACEHOLDER" => "",
		"CATEGORY_NEED_ITEM_VALUE" => "",
		"CATEGORY_NEED_ITEM_IBLOCK_FIELD" => "FORM_NEED_ITEM",
		"CATEGORY_NEED_ITEM_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_NEED_ITEM_VALIDATION_ADDITIONALLY_MESSAGE" => ""
	),
	false
);?>
             <a class="w-form__close" title="Закрыть" href="#w-form__close"><i class="fa fa-close"></i></a>
         </div>
       <!--   
	    </div>
    </div>
</div>
-->

<!-- <div class="btn-group-blue-100">
	<a href="#w-form-spec" class="btn-blue"><span><i class="fa fa-graduation-cap"></i>Пригласить специалиста тест</span></a>
</div>-->

<?php 
    /*}
}*/
?>

                        <div class="container" id="part1">

<div class="row is-services mb-20 p-3 p-md-5 p-xl-5 p-lg-5 p-sm-5 position-relative g-0 import-page-back">

                            <div class="col-md-12 text-left pb-5 is-service-item-area">
                                <div class="import-page-title">Портфель проектов</div>
                            </div>

                            <div class="col-12"><div class="row posts-list posts-list-np">
                            
                             <?php 
                            $arr_case = array(
                                
                                ['name'=>'
Нестандартные болты для решение для сложных задач','note'=>'В современном двигателестроении, где каждая деталь играет важную роль,  нестандартные решения становятся всё более востребованными.','img'=>'keys_17062024.jpg','link'=>'/services/proizvodstvo-metizov/works/nestandartnye-bolty-dlya-reshenie-dlya-slozhnykh-zadach/'],
                                
                                ['name'=>'
Импортозамещение литых деталей для горнодобывающей промышленности','note'=>'В прошлом многие предприятия горнодобывающей отрасли были вынуждены закупать специализированные литые...','img'=>'keys_20062024.jpg','link'=>'/services/proizvodstvo-metizov/works/importozameshchenie-litykh-detaley-dlya-gornodobyvayushchey-promyshlennosti/'],
                                
                                ['name'=>'
Импортозамещение ниппелей по ГОСТ для предприятий оборонной промышленности','note'=>'В условиях современных экономических реалий и ограничений, вызванных санкциями...','img'=>'keys_24062024.jpg','link'=>'/services/proizvodstvo-metizov/works/importozameshchenie-nippeley-po-gost-dlya-predpriyatiy-oboronnoy-promyshlennosti/'],
                                
                                ['name'=>'Болты по DIN 962','note'=>'Выполнили сверление 5366 болтов по стандарту DIN 962...','img'=>'din-962-1.jpg','link'=>'/news/vypolnili-zakaz-na-izgotovlenie-boltov-din-962-v-rossii-v-ramkakh-importozameshcheniya/'],
                                ['name'=>'Талреп DIN 1480','note'=>'Произвели талрепы DIN 1480 с концевиками шпилька-шпилька...','img'=>'talrep1480.jpg','link'=>'/news/gk-trayv-izgotovila-talrepy-din-1480-proizvoditelyu-oborudovaniya-dlya-ges/'],
                                ['name'=>'Болты для спецтехники по образцу','note'=>'Произвели болты из легированной стали для сервисного обслуживания спецтехники...','img'=>'image_27.jpg','link'=>'https://traiv-komplekt.ru/news/proizveli-bolty-iz-legirovannoy-stali-dlya-spetstekhniki/'],
                                ['name'=>'Конструкции с использованием полиамидного крепежа','note'=>'Облегчили вес конструкции, сохранив прочность. Продолжили бесперебойно поставлять полиамидный крепеж...','img'=>'poliam.jpg','link'=>'/news/kak-sokratit-ves-konstruktsii-v-7-raz-s-poliamidnym-krepezhom/'],
                                ['name'=>'Пробка с дюймовой резьбой','note'=>'Произвели пробки с дюймовой резьбойна собственном оборудовании в России...','img'=>'probka.png','link'=>'#'],
                                ['name'=>'Шайбы по DIN 93','note'=>'Произвели шайбы по DIN 93 собственном оборудовании в России...','img'=>'DIN-93.jpg','link'=>'/services/proizvodstvo-metizov/works/shayby-po-chertezham/'],
                                ['name'=>'Т-образные болты','note'=>'Производим Т-образные болты на собственном оборудовании в России...','img'=>'t-obraz.png','link'=>'javascript:void(0);'],
                                ['name'=>'Стопорно-клиновые шайбы 2fix','note'=>'Производим шайбы 2fix в рамках импортозамещения Nord-Lock...','img'=>'2fix_cover2.jpg','link'=>'/news/importozameshchenie-postavili-shayby-2fix-proizvoditelyu-tramvaynykh-reduktorov/'],
                                ['name'=>'Нанесение кадмиевого покрытия для приборостроения','note'=>'Произвели нанесение кадмиевого покрытия для производителя в приборостроении...','img'=>'kadmiy1.jpg','link'=>'/catalog/po-svoistvam/djuimovyi-krepezh/zaglushki_dyuymovye/'],
                            );
                            
                            foreach ($arr_case as $key=>$val) {
                                ?>
                            
                            <div class="col-12 col-xl-4 col-lg-4 col-md-4 posts2-i">
                            <a class="posts-i-img" href="<?php echo $val['link']?>"><span style="background: url(<?=SITE_TEMPLATE_PATH?>/import-page/<?php echo $val['img']?>)"></span></a><div class="posts-i-ttl"><a href="<?php echo $val['link']?>"><?php echo $val['name']?></a></div><p></p><p>
	<?php echo $val['note']?></p></div>

                           <?php 
                            }
                            
                            ?>

</div></div>


                        </div>
                        </div>

<div class="container">
    <div class="row g-0 pt-5 pb-5 position-relative import-page-back">
    
        <div class="col-12 col-xl-12 pt-5 col-lg-12 col-md-12 text-center">
        	<div class="import-page-start">
        	<div class="import-page-title-white pb-2">ГК «Трайв» - ваш технологический партнер по импортозамещению</div>
        	<div style="color:#ffffff;" class="pt-1 pb-3">
        		Поможем осуществить переход с учетом потребностей вашего бизнеса
        	</div>
        	
        	<div class="text-center text-sm-left text-lg-left text-md-left text-xl-left">
        	<div class="btn-group-blue-100">
                    <a href="#w-form" class="btn-white-border" rel="nofollow">
                        <span>Узнать больше</span>
                    </a>
                </div>
        	</div>
        	
        	</div>
        </div>
        
    </div>
</div>
<!-- 
<div class="container">
    <div class="row g-0 pt-5 pb-5 position-relative import-page-back">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
        	<div class="import-page-title">Соберите свой комплект решений</div>
        	<div class="import-page-title-sm">Выберите нужные категории и нажмите кнопку Получить предложение</div>
        </div>
        
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
        	<ul class="import-page-check-area">
            	<li class="import-page-check"><i class="fa fa-check-square-o"></i> Подбор аналога из неевропейских позиций</li>
            	<li class="import-page-check"><i class="fa fa-check-square-o"></i> Разработка производственного решения</li>
            	<li class="import-page-check"><i class="fa fa-check-square-o"></i> Комплексное решение: комбинация нескольких комплексных решений</li>
        	</ul>
        </div>
        
    </div>
</div>

                        <div class="container">

<div class="row pre-area mb-20 p-5 position-relative g-0 import-page-back-blue">


                            <div class="col-md-8 offset-md-2 text-left is-service-item-area position-relative" id="partners_icon">
                                <div class="import-page-title" style="padding-left:100px;">ГК «Трайв» - ваш технологический партнер по импортозамещению</div>
                            </div>
                            
                            <div class="col-md-8 offset-md-2 pt-4 pb-4 text-left">
        	<p>Предоставляем производственные и консультационные услуги по комплексному импортозамещению с учетом специфики вашего бизнеса</p>
        </div>
        
        <div class="col-md-8 offset-md-2 text-left"><div class="btn-group-blue"><a href="#w-form" class="btn-white-border"><span>Связаться с нами</span></a></div></div>
                            
                        </div>
                        </div>
                        -->

<div class="container">

<div class="row is-services mb-20 p-3 p-xl-5 p-sm-5 p-lg-5 p-md-5 position-relative g-0 import-page-back">



                            <div class="col-md-12 text-left is-service-item-area">
                                <div class="import-page-title">Услуги ГК Трайв</div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-3 col-sm-6 is-service-item-area">
                                <div class="is-service-item">
                                    <i class="fa fa-truck" aria-hidden="true"></i>
                                    <h4 class="title">Поставка европейских позиций</h4>
                                    <p>Успели закупить большие объемы евпропейского крепежа еще до санкций. Благодаря стоку на складе в Москве и СПб, поставляем в кратчайшие сроки</p>
                                </div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-3 col-sm-6 is-service-item-area">
                                <div class="is-service-item">
                                    <i class="fa fa-ship" aria-hidden="true"></i>
                                    <h4 class="title">Доставка редких позиций</h4>
                                    <p>Быстрая доставка редких позиций из наличия на складах по всему миру</p>
                                </div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-3 col-sm-6 is-service-item-area">
                                <div class="is-service-item">
                                    <i class="fa fa-support"></i>
                                    <h4 class="title">Подбор аналога европейских позиций</h4>
                                    <p>Подберем аналоги по DIN, ГОСТ, ISO из наличия на складе</p>
                                </div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-3 col-sm-6 is-service-item-area">
                                <div class="is-service-item">
                                    <i class="fa fa-cubes"></i>
                                    <h4 class="title">Поставка метизных изделий</h4>
                                    <p>Поставляем метизные изделия российских и азиатских производителей</p>
                                </div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-3 col-sm-6 is-service-item-area">
                                <div class="is-service-item">
                                    <i class="fa fa-cogs"></i>
                                    <h4 class="title">Разработка крепежных решений</h4>
                                    <p>Производим изделия по чертежам, эскизам и образцам</p>
                                </div>
                            </div>
                            
                            <!--service item-->
                            <div class="col-lg-3 col-sm-6 is-service-item-area">
                                <div class="is-service-item">
                                    <i class="fa fa-calendar-check-o "></i>
                                    <h4 class="title">Проведение исследований образцов</h4>
                                    <p>Проведем исследование по параметрам вязкости, твердости, определение материала</p>
                                </div>
                            </div>
                            
                            <!--service item-->
                            <div class="col-lg-3 col-sm-6 is-service-item-area">
                                <div class="is-service-item">
                                    <i class="fa fa-flask"></i>
                                    <h4 class="title">Нанесение покрытий</h4>
                                    <p>Гальваническое, горячее и термодиффузионное цинкование, покраска изделий по RAL</p>
                                </div>
                            </div>
                            
                            <!--service item-->
                            <div class="col-lg-3 col-sm-6 is-service-item-area">
                                <div class="is-service-item">
                                    <i class="fa fa-database"></i>
                                    <h4 class="title">Complex solution</h4>
                                    <p>Разработаем комплексное решение из нескольких прозводственных компонентов под вашу потребность</p>
                                </div>
                            </div>

<div class="is-services-back"></div>
                        </div>
                        </div>
                        
                        <div class="container">

<div class="row pre-area mb-20 p-3 p-xl-5 p-sm-5 p-lg-5 p-md-5 position-relative g-0 import-page-back-blue">

                            <div class="col-md-12 text-left is-service-item-area">
                                <div class="import-page-title">Преимущества работы с Трайв</div>
                            </div>
                            
                            <div class="col-12 col-xl-6 col-lg-6 col-md-6 text-left">
        	<ul class="import-page-pre">
            	<li class="import-page-pre-item"> Выполняем полный цикл — от стратегии до поддержки решения — или отдельные этапы импортозамещения.</li>
            	<li class="import-page-pre-item"> На практическом опыте знаем особенности импортозамещения в разных отраслях — нефтегазе, энергетике, металлургии и других.</li>
            	<li class="import-page-pre-item"> В каждом продуктовом направлении есть специалисты по импортозамещению, а работа с ними организована по принципу «единого окна».</li>
            	<li class="import-page-pre-item"> Организуем выезд специалиста на ваш объект, предприятие для оценки и разработки плана действий в проекте.</li>
            	
            	
        	</ul>
        </div>
        
        <div class="col-12 col-xl-6 col-lg-6 col-md-6 text-left">
        	<ul class="import-page-pre">
            	<li class="import-page-pre-item"> Отталкиваемся от потребностей компании: меняем только то, что требуют нормативные акты и задачи бизнеса.</li>
            	<li class="import-page-pre-item"> Гарантируем работоспособность и совместимость подобранных нами решений с вашей производственной инфраструктурой.</li>
            	<li class="import-page-pre-item"> Помогаем подобрать метизные изделия из более чем 30 000 позиций.</li>
        	</ul>
        </div>
        
                <div class="col-md-3 offset-md-2 text-center text-sm-left text-lg-left text-md-left text-xl-left">
        	<div class="btn-group-blue-100">
        		<a href="#w-form" class="btn-white-border" rel="nofollow"><span><i class="fa fa-envelope-o"></i>Связаться с нами</span></a>
        	</div>
        </div>
        
       <div class="col-md-3 text-center text-sm-left text-lg-left text-md-left text-xl-left pt-3 pt-xl-0 pt-sm-0 pt-lg-0 pt-md-0 pb-3 pb-xl-0 pb-sm-0 pb-lg-0 pb-md-0">
        	<div class="btn-group-blue-100">
        		<a href="#w-form-recall" class="btn-white-border" rel="nofollow"><span><i class="fa fa-phone"></i>Заказать звонок</span></a>
        	</div>
        </div>
        
        <div class="col-md-3 text-center text-sm-left text-lg-left text-md-left text-xl-left">
        	<div class="btn-group-blue-100">
        		<a href="#w-form-spec" class="btn-white-border" rel="nofollow"><span><i class="fa fa-graduation-cap"></i>Пригласить специалиста</span></a>
        	</div>
        </div>
        
                        </div>
                        </div>
                        
                                                <div class="container h-100">

<div class="row is-services mb-20 p-3 p-md-5 p-xl-5 p-lg-5 p-sm-5 position-relative g-0 import-page-back">



                            <div class="col-md-12 text-left is-service-item-area">
                                <div class="import-page-title">Эксперты</div>
                            </div>
                            
                            <div class="col-md-12 text-left pb-5 is-service-item-area">
                            <div class="row align-items-center h-100">
                            
                            <?php 
                            $arr_exp = array(
                                ['name'=>'Николай Гончар','dol'=>'Технический директор','email'=>'gonchar@traiv.ru','p'=>'m'],
                                //['name'=>'Екатерина Федорова','dol'=>'Директор по продукту','email'=>'fedorova@traiv.ru','p'=>'w'],
                                //['name'=>'Ирина Соколова','dol'=>'Руководитель товарного направления «Такелаж»','email'=>'sokolova@traiv.ru','p'=>'w'],
                                ['name'=>'Андрей Толубеев','dol'=>'Руководитель товарного направления Полиамид, Латунный крепеж','email'=>'tolubeev@traiv.ru','p'=>'m'],
                                ['name'=>'Андрей Ермилов','dol'=>'Руководитель товарного направления Стальной крепеж, Строительный крепеж','email'=>'ermilov@traiv.ru','p'=>'m'],
                                //['name'=>'Матвей Миронов','dol'=>'Менеджер по производству и внешней кооперации','email'=>'mironov@traiv.ru','p'=>'m'],
                                
                            );
                            
                            foreach ($arr_exp as $key=>$val) {
                                ?>
                                
                                <div class="col-12 col-xl-2 col-lg-2 col-md-2 pt-5 text-center text-md-left text-lg-left text-xl-left text-sm-left">
                                <!-- 
                                <?php 
                                if ($val['p'] == 'm'){
                                ?>
                            		<img src="<?=SITE_TEMPLATE_PATH?>/import-page/exp1.jpg" class="img responsive exp-img" />
                            		<?php 
                                } else {
                                    ?>
                                    <img src="<?=SITE_TEMPLATE_PATH?>/import-page/exp2.jpg" class="img responsive" />
                                    <?php 
                                }
                            		?>
                            		-->
                            	</div>
                            	<div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center text-md-left text-lg-left text-xl-left text-sm-left pt-5">
                            		<div class="exp-title"><?php echo $val['name'];?></div>
                            		<div class="exp-note">
                            		<p><?php echo $val['dol'];?></p>
                            		</div>
                            	</div>
                            	
                            	<div class="col-12 col-xl-4 col-lg-4 col-md-4 pt-2 pt-sm-5 pt-lg-5 pt-xl-5 pt-md-5 text-center text-md-left text-lg-left text-xl-left text-sm-left">
                            		<div class="btn-group-blue"><a href="mailto:<?php echo $val['email'];?>" class="btn-blue"><span>Связаться с экспертом</span></a></div>
                            	</div>
                                
                                <?php 
                            }
                            
                            ?>
                            	
                            </div>
                            </div>


                        </div>
                        </div>
                        
                                                <div class="container">

<div class="row pre-area mb-20 p-3 p-md-5 p-xl-5 p-lg-5 p-sm-5 position-relative g-0 import-page-back-blue">


                            <div class="col-md-8 offset-md-2 text-left is-service-item-area position-relative" id="q_icon">
                                <div class="import-page-title">Остались вопросы? Мы ответим?</div>
                            </div>
                            
                            <div class="col-md-8 offset-md-2 pt-5 pb-5 text-left">
        	<p>Предоставляем производственные и консультационные услуги по комплексному импортозамещению с учетом специфики вашего бизнеса</p>
        </div>
        
        <div class="col-12 col-md-3 offset-md-2 text-left">
        	<div class="btn-group-blue-100">
        		<a href="#w-form" class="btn-white-border" rel="nofollow"><span><i class="fa fa-envelope-o"></i>Связаться с нами</span></a>
        	</div>
        </div>
        
       <div class="col-12 col-md-3 text-left pt-3 pt-xl-0 pt-sm-0 pt-lg-0 pt-md-0 pb-3 pb-xl-0 pb-sm-0 pb-lg-0 pb-md-0">
        	<div class="btn-group-blue-100">
        		<a href="#w-form-recall" class="btn-white-border" rel="nofollow"><span><i class="fa fa-phone"></i>Заказать звонок</span></a>
        	</div>
        </div>
        
        <div class="col-12 col-md-3 text-left">
        	<div class="btn-group-blue-100">
        		<a href="#w-form-spec" class="btn-white-border" rel="nofollow"><span><i class="fa fa-graduation-cap"></i>Пригласить специалиста</span></a>
        	</div>
        </div>
                            
                        </div>
                        </div>

</section>

<?
 $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/import.css");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>