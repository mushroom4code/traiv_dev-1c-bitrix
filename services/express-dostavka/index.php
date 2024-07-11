<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Экспресс-доставка грузов из Китая - от компании \"Трайв\" в Санкт-Петербурге (СПБ) и Москве (МСК)! Звоните 8 (800) 707-25-98!");
$APPLICATION->SetPageProperty("title", "Экспресс-доставка грузов из Китая на заказ в Санкт-Петербурге (СПБ) и Москве (МСК)");?>
    <?$APPLICATION->SetTitle("Экспресс-доставка грузов из Китая");?>
<section id="content">
	<div class="container">
        <?/*$APPLICATION->AddChainItem('Услуги компании', "/services/");*/?>
        <?$APPLICATION->AddChainItem('Экспресс-доставка грузов из Китая', "/services/express-dostavka/");?>

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
    	<h1><span>Экспресс-доставка грузов из Китая</span></h1>
    </div>
</div>
            
        <div class="row">
    <div class="col-12 col-xl-6 col-lg-6 col-md-6">
        <div class="news-detail">
            <p align="justify">
               Организуем срочную грузоперевозку из Китая в Россию. Для вас всё будет просто — нужно только оставить заявку менеджеру. Остальные вопросы мы возьмём на себя.
            </p>
            <p align="justify">
                Экспресс-доставка — оптимальный вариант для тех, кто ценит время. Благодаря современной материально-технической базе и опытному персоналу каждый этап логистической цепочки мы реализуем в кратчайшие сроки. В среднем доставка занимает 15-20 дней вместо стандартных 60-100 дней. 
            </p>
            <p align="justify">
                Высокой скорости удаётся добиться за счёт использования авиатранспорта. Сначала на самолете мы доставляем груз из Китая в Москву на наш склад. Затем после проведения необходимых складских операций сразу отправляем грузы клиентам в пункты назначения. 
            </p>
            <h2>Преимущества экспресс-доставки:</h2>
            
<ul>
	<li><b>Скорость</b> - Получите товар за 15-20 дней вместо стандартных 60-100;</li>
    <li><b>Широкий охват</b> - Доставим в любой регион РФ;</li>
    <li><b>Надёжность</b> - Работаем с проверенными компаниями, поэтому в пути ничего не потеряется;</li>
    <li><b>Ответственность</b> - Проводим страхование каждого груза;</li>
    <li><b>Удобство</b> - Все вопросы по документальному сопровождению берём на себя;</li>
</ul>
 
        </div>
    </div>
    
    <div class="col-12 col-xl-5 col-lg-5 col-md-5 offset-md-1 offset-xl-1 offset-lg-1">
    <div class="alert alert-secondary" role="alert">
    <?php
            $APPLICATION->IncludeComponent(
                "slam:easyform",
                "traiv",
                array(
                    "COMPONENT_TEMPLATE" => "traiv",
                    "FORM_ID" => "FORM99",
                    "FORM_NAME" => "Заявка на экспресс-доставку",
                    "WIDTH_FORM" => "auto",
                    "DISPLAY_FIELDS" => array(
                        0 => "TITLE",
                        1 => "EMAIL",
                        2 => "PHONE",
                        3 => "MESSAGE",
                        4 => "HIDDEN",
                        5 => "",
                    ),
                    "REQUIRED_FIELDS" => array(
                        0 => "TITLE",
                        1 => "EMAIL",
                        2 => "PHONE",
                        3 => "MESSAGE",
                    ),
                    "FIELDS_ORDER" => "TITLE,EMAIL,PHONE,MESSAGE,HIDDEN",
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
                    "MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи ЭКСПРЕСС-ДОСТАВКА",
                    "EMAIL_FILE" => "Y",
                    "EMAIL_SEND_FROM" => "N",
                    "CREATE_SEND_MAIL_SENDER" => "",
                    "EVENT_MESSAGE_ID_SENDER" => array(
                        0 => "121",
                    ),
                    "EMAIL_BCC_SENDER" => "dmitrii.kozlov@traiv.ru",
                    "MAIL_SUBJECT_SENDER" => "#SITE_NAME#: Сообщение из формы обратной связи",
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
                    "USE_CAPTCHA" => "Y",
                    "USE_MODULE_VARNING" => "N",
                    "USE_FORMVALIDATION_JS" => "Y",
                    "HIDE_FORMVALIDATION_TEXT" => "N",
                    "INCLUDE_BOOTSRAP_JS" => "Y",
                    "USE_JQUERY" => "N",
                    "USE_BOOTSRAP_CSS" => "Y",
                    "USE_BOOTSRAP_JS" => "N",
                    "CUSTOM_FORM" => "",
                    "CAPTCHA_TITLE" => "",
                    "CATEGORY_DOCS_TITLE" => "Вложение",
                    "CATEGORY_DOCS_TYPE" => "file",
                    "CATEGORY_DOCS_FILE_EXTENSION" => "doc, docx, xls, xlsx, txt, rtf, pdf, png, jpeg, jpg, gif",
                    "CATEGORY_DOCS_FILE_MAX_SIZE" => "20971520",
                    "CATEGORY_DOCS_DROPZONE_INCLUDE" => "N",
                    "USE_INPUTMASK_JS" => "Y",
                    "CATEGORY_______________________________________________TITLE" => "ИНН (для юридических лиц)",
                    "CATEGORY_______________________________________________TYPE" => "text",
                    "CATEGORY_______________________________________________PLACEHOLDER" => "",
                    "CATEGORY_______________________________________________VALUE" => "",
                    "CATEGORY_______________________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "^[a-zA-Z0-9_]+\$",
                    "CREATE_IBLOCK" => "",
                    "IBLOCK_TYPE" => "-",
                    "IBLOCK_ID" => "37",
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
                    "ELEMENT_ID" => $arResult["ID"],
                    "FORMATED_NAME" => $formatedname,
                    "CATEGORY_MESSAGE_VALIDATION_MESSAGE" => "Обязательное поле",
                    "CATEGORY_HIDDEN_TITLE" => "Скрытое поле",
                    "CATEGORY_HIDDEN_TYPE" => "hidden",
                    "CATEGORY_HIDDEN_VALUE" => "",
                    "CATEGORY_HIDDEN_IBLOCK_FIELD" => "FORM_HIDDEN"
                ),
                false
                );
     
    ?>
    </div>
    </div>
    
</div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>