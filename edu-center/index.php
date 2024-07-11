<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Учебный центр");
?>

<section id="content">
	<div class="container">
	
			 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"traiv",
	Array(
		"COMPONENT_TEMPLATE" => "traiv",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?>

<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span>Учебный центр</span></h1>
    </div>
</div>


<div class="row g-0 position-relative">
	
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pt-xl-0 pt-lg-0 text-left">
<div class="row d-flex align-items-center h-100">

     <div class="col-12 col-xl-5 col-lg-5 col-md-5 text-left edu-image-area">
  <img src="<?=SITE_TEMPLATE_PATH?>/edu/edu-mainimg.jpg" class="edu-image"/>
</div>

<div class="col-12 col-xl-7 col-lg-7 col-md-7 text-left">

        <div class="text-black">
          <div class="card-body">

            <h2 class="eduh2"><span>Курс</span> Оператор станков с ЧПУ</h2>
<p class="lead edu-title-text">
			<?
			$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "_title",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);

			?>
</p>
          </div>
        </div>


<div class="row position-relative" style="padding: 1rem 1rem;">
                            <div class="col-lg-5 col-sm-6">
                                <div class="edu-area-type">
                                    <div class="title">Продолжительность обучения</div>
                                    <p>1,5 месяца /166 часов</p>
                                </div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-4 col-sm-6 is-service-about-area">
                                <div class="edu-area-type">
                                    <div class="title">Режим занятий</div>
                                    <p>вечер, выходного дня</p>
                                </div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-3 col-sm-6 is-service-about-area">
                                <div class="edu-area-type">
                                    <div class="title">Форма обучения</div>
                                    <p>очно</p>
                                </div>
                            </div>

<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 text-center text-xl-left text-lg-left text-sm-left position-relative"><div class="btn-group">
<a href="#w-form-kurs" class="btn-group-new btn-group-new-land-white text-center"><span>Записаться на курс</span></a>
</div></div>

                        </div>

</div>
    
</div>
	</div>
	
</div>	


<div class="row d-flex align-items-center h-100 edu-map-area g-0">

<div class="col-12 col-xl-7 col-lg-7 col-md-7 text-left p-1 p-xl-5 p-lg-5 p-md-5">
<div class="eduh2 d-none">Что предлагаем:</div>
<ul class="edu-list">
	<li><i class="fa fa-check-circle-o "></i><span>Научим пользоваться фрезерными и токарными металлорежущими станками</span></li>
	<li><i class="fa fa-check-circle-o "></i><span>Обучение проводят опытные преподаватели-практики</span></li>
	<li><i class="fa fa-check-circle-o "></i><span>Актуальные обучающие материалы</span></li>
	<li><i class="fa fa-check-circle-o "></i><span>100 часов практических работ на современных станках</span></li>
</ul>

<div class="edu-result-area">
	<div class="edu-result-text text-center">Трудоустройство по окончании курса</div>
</div>

     </div>

     <div class="col-12 col-xl-5 col-lg-5 col-md-5 text-left">
     
     	<div id="edu-map"></div>
     
     </div>
</div>

    <div class="row mt-5">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-left">
        	<div class="eduh2">Программа курса</div>
        	<hr>
        </div>
    </div>
    
    <div class="row d-flex align-items-center h-100 g-0">

<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-left">
<ul class="edu-list">
	<li><i class="fa fa-check-circle-o "></i><span>Основные понятия о станках ЧПУ/токарные; фрезерные.
Классификация станков с ЧПУ.
</span></li>
	<li><i class="fa fa-check-circle-o "></i><span>Металловедение Технология конструкционных материалов.
Основы технологии обработки материалов резанием.
</span></li>
	<li><i class="fa fa-check-circle-o "></i><span>Чтение чертежей. ECKD</span></li>
	<li><i class="fa fa-check-circle-o "></i><span>Система допусков и посадок. Контроль и корректировка геометрических параметров станка.</span></li>
	<li><i class="fa fa-check-circle-o "></i><span>Основы программирования станков с ЧПУ.
Направляющие точки. Создание технологической карты
</span></li>
	<li><i class="fa fa-check-circle-o "></i><span>Панель управления станка с ЧПУ.
Наладка станка с ЧПУ. Системы привязки и контроля размеров. Техническое обслуживание и техника безопасности. Подналадка отдельных узлов станка.
</span></li>
	<li><i class="fa fa-check-circle-o "></i><span>Постоянные циклы станка с ЧПУ</span></li>
	<li><i class="fa fa-check-circle-o "></i><span>Экзамен</span></li>
</ul>
     </div>
</div>

            <div class="row mt-5">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-left">
        	<div class="eduh2">Учебная программа</div>
        	<hr>
        </div>
    </div>
    
    <div class="row">
	<div class="col-12 col-lg-4 col-md-4 col-sm-4 offset-lg-2 offset-md-2 offset-sm-2 text-center">
    	<div class="el-item bordered position-relative">
      		<a data-fancybox="gallery" class="fancy-img" href="<?=SITE_TEMPLATE_PATH?>/edu/plan-programm-titul.jpg"><img src="<?=SITE_TEMPLATE_PATH?>/edu/plan-programm-titul.jpg"/></a>
    		<div class="position-relative"><a href="<?=SITE_TEMPLATE_PATH?>/edu/plan-programm-titul.pdf" class="map-link-small" target="_blank"><div class="active">Скачать</div></a></div>
    	</div>
    	
  	</div>
  	<div class="col-12 col-lg-4 col-md-4 col-sm-4 text-center">
  		<div class="el-item bordered position-relative">
  			<a data-fancybox="gallery" class="fancy-img" href="<?=SITE_TEMPLATE_PATH?>/edu/plan-programm.jpg"><img src="<?=SITE_TEMPLATE_PATH?>/edu/plan-programm.jpg"/></a>
  			<div class="position-relative"><a href="<?=SITE_TEMPLATE_PATH?>/edu/plan-programm.pdf" class="map-link-small" target="_blank"><div class="active">Скачать</div></a></div>
  		</div>	
  	</div>
  
</div>
 


    <div class="row mt-5">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-left">
        	<div class="eduh2">Обучение проводится на станках с ЧПУ</div>
        	<hr>
        </div>
    </div>

<div class="row position-relative mt-5"><div class="col-12 col-xl-4 col-lg-4 col-md-4 p-xl-3 p-lg-3 p-md-3 text-left position-relative"><div class="el-item bordered position-relative"><div class="el-img text-center"><img class="ami-lazy loaded" src="/upload/adwex.minified/webp/7e8/100/7e8f5df944c8b4bf1db48c46cabe4417.webp" data-src="/upload/adwex.minified/webp/7e8/100/7e8f5df944c8b4bf1db48c46cabe4417.webp" data-was-processed="true"></div><div class="el-name text-center">
                                            		Токарно-обрабатывающий центр SКM NL2500SY                                            		</div></div></div><div class="col-12 col-xl-4 col-lg-4 col-md-4 p-xl-3 p-lg-3 p-md-3 text-left position-relative"><div class="el-item bordered position-relative"><div class="el-img text-center"><img class="ami-lazy loaded" src="/upload/adwex.minified/webp/3ba/100/3ba0e35b5ad5ece4ce058a3187ad2a77.webp" data-src="/upload/adwex.minified/webp/3ba/100/3ba0e35b5ad5ece4ce058a3187ad2a77.webp" data-was-processed="true"></div><div class="el-name text-center">
                                            		Токарно-обрабатывающий центр SКM NL2000M                                            		</div></div></div><div class="col-12 col-xl-4 col-lg-4 col-md-4 p-xl-3 p-lg-3 p-md-3 text-left position-relative"><div class="el-item bordered position-relative"><div class="el-img text-center"><img class="ami-lazy loaded" src="/upload/adwex.minified/webp/6cf/100/6cfd81d51f870405703aacf4cac05119.webp" data-src="/upload/adwex.minified/webp/6cf/100/6cfd81d51f870405703aacf4cac05119.webp" data-was-processed="true"></div><div class="el-name text-center">
                                            		Токарно-обрабатывающий центр SКM NL1500M                                            		</div></div></div></div>


    <div class="row mt-5">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-left">
        	<div class="eduh2">Часто задаваемые вопросы</div>
        	<hr>
        </div>
    </div>

<div class="row position-relative"><div class="col-12 col-xl-6 col-lg-6 col-md-6 p-xl-5 p-lg-5 p-md-5 text-left position-relative"><div class="hang-item position-relative"><div class="hang-title">Кто ваши преподаватели?</div>
<div class="hang-note">Наши преподаватели  - это практики, которые имеют опыт работы на производстве. Кроме того, каждый наш преподаватель регулярно передает знания новичкам и является опытным наставником. Преподаватели нашего центра помогут вам стать профессионалом в максимально короткий срок.</div></div></div>

<div class="col-12 col-xl-6 col-lg-6 col-md-6 p-xl-5 p-lg-5 p-md-5 text-left position-relative"><div class="hang-item position-relative"><div class="hang-title">Как построено обучение?</div><div class="hang-note">Все наши курсы построены с учетом принципов андрогогики. Это не скучные лекции, а практические семинары с разбором рабочих ситуаций, что позволяет слушателям быстрее осваивать материал.</div></div></div>

<div class="col-12 col-xl-6 col-lg-6 col-md-6 p-xl-5 p-lg-5 p-md-5 text-left position-relative"><div class="hang-item position-relative"><div class="hang-title">Есть ли дополнительный материал для изучения?</div><div class="hang-note">Курсы включают в себя не только практические семинары, но и возможность изучать дополнительный материал на нашей Учебной платформе.</div></div></div>

<div class="col-12 col-xl-6 col-lg-6 col-md-6 p-xl-5 p-lg-5 p-md-5 text-left position-relative"><div class="hang-item position-relative"><div class="hang-title">В какое время проходит обучение?</div><div class="hang-note">В нашем Центре занятия проходят в вечернее время и субботу. Это значит, что вы сможете посещать занятия без отрыва от основного места работы. Так же мы рассматриваем вариант дневных групп. Вы можете оставить заявку и мы вам подберем удобный формат для обучения.</div></div></div></div>

    <div class="row mt-5">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-left">
        	<div class="eduh2">Результаты обучения на Курсе</div>
        	<hr>
        </div>
    </div>
    
    <div class="row d-flex align-items-center h-100 g-0 mb-5">

<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-left">
<ul class="edu-list">
	<li><i class="fa fa-check-circle-o "></i><span>Вы научитесь читать чертежи и работать с измерительным инструментом
</span></li>
	<li><i class="fa fa-check-circle-o "></i><span>Познакомитесь с особенностями обработки разных металлов
</span></li>
	<li><i class="fa fa-check-circle-o "></i><span>Приобретете навыки написания программ для станков с ЧПУ. Сможете анализировать возникающие ошибки в программах и  вносить корректировки</span></li>
	<li><i class="fa fa-check-circle-o "></i><span>Сможете самостоятельно изготовить деталь</span></li>
	<li><i class="fa fa-check-circle-o "></i><span>Всего за 1,5 месяца вы станете готовым специалистом к работе на производстве и освоите новую профессию
</span></li>
</ul>
     </div>
</div>




<div class="row d-flex align-items-center h-100 g-0 mb-5">

<div class="col-12 col-xl-10 col-lg-10 col-md-10 text-left">

        <div class="text-black">
          <div class="card-body">
<p class="lead edu-title-text">
			<?
			$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "_contacts",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);

			?>
</p>
          </div>
        </div>


<div class="row position-relative" style="padding: 1rem 1rem;">
                            <div class="col-lg-4 col-sm-4">
                                <div class="edu-area-type">
                                    <a href="tel:88003339116" class="phone">8 (800) 333-91-16</a>
                                </div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-4 col-sm-4">
                                <div class="edu-area-type">
                                    <a href="tel:+79213198984" class="phone">+7 (921) 319-89-84</a>
                                </div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-4 col-sm-4">
                                <div class="edu-area-type">
                                    <a href="tel:+79113066438" class="phone">+7 (911) 306-64-38</a>
                                </div>
                            </div>



                        </div>

</div>

<div class="col-12 col-xl-2 col-lg-2 col-md-2 text-center">
<div class="btn-group">
<a href="#w-form-kurs" class="btn-group-new btn-group-new-land-white text-center"><span>Записаться на курс</span></a>
</div>
</div>

</div>



	
	</div>
</section>


	         <a href="#x" class="w-form__overlay" id="w-form-kurs"></a>
         <div class="w-form__popup">
             <?$APPLICATION->IncludeComponent(
	"slam:easyform", 
	"traiv-edu", 
	array(
		"COMPONENT_TEMPLATE" => "traiv-edu",
		"FORM_ID" => "FORM100",
		"FORM_NAME" => "Запись на курс",
	    "WIDTH_FORM" => "620px",
		"DISPLAY_FIELDS" => array(
			0 => "TITLE",
			1 => "PHONE",
			2 => "CUR_URL",
		),
		"REQUIRED_FIELDS" => array(
			0 => "TITLE",
			1 => "PHONE",
		),
		"FIELDS_ORDER" => "TITLE,PHONE,CUR_URL",
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
		"EMAIL_TO" => "vso@traiv.ru",
		"EMAIL_BCC" => "jilinskaya@traiv.ru",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы Запись на курс",
		"EMAIL_FILE" => "Y",
		"EMAIL_SEND_FROM" => "N",
		"CREATE_SEND_MAIL_SENDER" => "",
		"EVENT_MESSAGE_ID_SENDER" => array(
			0 => "121",
		),
		"EMAIL_BCC_SENDER" => "dmitrii.kozlov@traiv.ru",
		"MAIL_SUBJECT_SENDER" => "#SITE_NAME#: Сообщение из формы Запись на курс",
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
		"CATEGORY_MESSAGE_TITLE" => "Сообщение",
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
	    "CATEGORY_CUR_URL_IBLOCK_FIELD" => "FORM_CUR_URL"
	),
	false
);?>
             <a class="w-form__close" title="Закрыть" href="#w-form__close"><i class="fa fa-close"></i></a>
         </div>

<?
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/edu.css");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>