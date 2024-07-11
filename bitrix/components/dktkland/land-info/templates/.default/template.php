<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php

if(is_array($arResult['ITEMS']) && count($arResult['ITEMS'])>0){

//if (count($arResult['ITEMS']) > 0) {
    
   /* if ( $USER->IsAuthorized() )
    {
        if ($USER->GetID() == '3092') {
            echo "<pre>";
            print_r($arResult['ITEMS']);
            echo "</pre>";
        }
    }*/
    
    require_once $_SERVER["DOCUMENT_ROOT"] .'/local/php_interface/include/Mobile_Detect.php';
    $detect = new Mobile_Detect;
    if ( $detect->isMobile() || $detect->isTablet() ) {
        $mobile_check = true;
    }
    
    ?>
    <section class="landinfo-section">
    <?php
    foreach ($arResult['ITEMS'] as $key=>$val){
        /*for all typeitem*/
        if (!empty($val['TYPEITEMTEXTCOLOR'])){
            $textColor = 'style="color:'.$val['TYPEITEMTEXTCOLOR'].';"';
        }
        
        if (!empty($val['TYPEITEMBACKCOLOR'])){
            $backColor = 'style="background-color:'.$val['TYPEITEMBACKCOLOR'].';"';
        }
        /*end for all typeitem*/
        
        if ($val['TYPEITEMID'] == '20617'){
            if (!empty($val['TYPEITEMBACKIMG'])){
                if ($arParams['URL'] === '/promyshlennoe-meropriyatie-v-spb/' || $arParams['URL'] === '/meropriyatie-v-tule-2024/' || $arParams['URL'] === '/delovoy-zavtrak-v-tule-2024/'){
                    
                    if ($mobile_check !== true){
                        $hh = "height:780px;";
                        $hho = "height:640px;";
                    } else {
                        $hh = "";
                        $hho = "";
                    }
                    
                    $backfImage = 'style="background-image: url('.$val['TYPEITEMBACKIMG'].');'.$hh.'"';
                } else if ($arParams['URL'] === '/otpravka-obraztsov-2fix/'){
                    $backfImage = 'style="background-image: url('.$val['TYPEITEMBACKIMG'].');'.$hho.'"';
                }else {
                    $backfImage = 'style="background-image: url('.$val['TYPEITEMBACKIMG'].');"';
                }
                
            }
           
           
            ?>
                <div class="landinfo-img-area" <?php echo $backfImage;?>>
                	<div class="container">
						<div class="row g-0 position-relative">
						
						<div class="col-12 col-xl-8 col-lg-8 col-md-8 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
                        	<div class="landinfo-title" <?php echo $textColor;?>><?php echo $val['TYPEITEMTITLE'];?></div>
                        	<div class="landinfo-sm-title pt-2 pt-xl-5 pt-lg-5 pt-md-5" <?php echo $textColor;?>><?php echo $val['TYPEITEMSMTITLE'];?></div>
                        </div>
                        
                        <div class="col-12 col-xl-4 col-lg-4 col-md-4 p-xl-3 p-lg-3 p-md-3 pt-5 text-left position-relative" style="padding-top:40px !important;">
<noindex>
    <?php
    if ($arParams['URL'] === '/promyshlennoe-meropriyatie-v-spb/' || $arParams['URL'] === '/meropriyatie-v-tule-2024/' || $arParams['URL'] === '/delovoy-zavtrak-v-tule-2024/'){
            $APPLICATION->IncludeComponent(
	"slam:easyform", 
	"traiv-expo", 
	array(
		"COMPONENT_TEMPLATE" => "traiv-expo",
		"FORM_ID" => "FORM119",
		"FORM_NAME" => "Выставка",
		"WIDTH_FORM" => "auto",
		"DISPLAY_FIELDS" => array(
			0 => "TITLE",
			1 => "PHONE",
			2 => "MESSAGE",
			3 => "Название компании",
			4 => "",
		),
		"REQUIRED_FIELDS" => array(
			0 => "TITLE",
			1 => "PHONE",
			2 => "Название компании",
		),
		"FIELDS_ORDER" => "TITLE,PHONE,Название компании,MESSAGE",
		"FORM_AUTOCOMPLETE" => "Y",
		"HIDE_FIELD_NAME" => "Y",
		"HIDE_ASTERISK" => "N",
		"FORM_SUBMIT_VALUE" => "Зарегистрироваться",
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
		"EMAIL_BCC" => "belinin@traiv.ru,pletneva@traiv.ru,pr.info@traiv.ru",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи Трайв в жизни региона",
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
		"CATEGORY_TITLE_PLACEHOLDER" => "Имя",
		"CATEGORY_TITLE_VALUE" => "",
		"CATEGORY_TITLE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_TITLE_VALIDATION_ADDITIONALLY_MESSAGE" => "maxlength=\"400\"",
		"CATEGORY_EMAIL_TITLE" => "Ваш E-mail",
		"CATEGORY_EMAIL_TYPE" => "email",
		"CATEGORY_EMAIL_PLACEHOLDER" => "E-mail",
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
		"USE_CAPTCHA" => "Y",
		"USE_MODULE_VARNING" => "N",
		"USE_FORMVALIDATION_JS" => "Y",
		"HIDE_FORMVALIDATION_TEXT" => "Y",
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
		"CATEGORY_DOCS_IBLOCK_FIELD" => "FORM_DOCS",
		"CATEGORY_______________________________________________IBLOCK_FIELD" => "FORM_ИНН (для юридических лиц)",
		"FORM_SUBMIT_VARNING" => "Нажимая на кнопку \"#BUTTON#\", вы даете согласие на обработку <a target=\"_blank\" class=\"polslam\" href=\"/politika-konfidentsialnosti/\" >персональных данных</a>",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ELEMENT_ID" => $arResult["ID"],
		"FORMATED_NAME" => $formatedname,
		"CATEGORY_MESSAGE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_HIDDEN_TITLE" => "Скрытое поле",
		"CATEGORY_HIDDEN_TYPE" => "hidden",
		"CATEGORY_HIDDEN_VALUE" => "",
		"CATEGORY_HIDDEN_IBLOCK_FIELD" => "FORM_HIDDEN",
		"CATEGORY_MESSAGE_TITLE" => "Задайте вопрос",
		"CATEGORY_MESSAGE_TYPE" => "textarea",
		"CATEGORY_MESSAGE_PLACEHOLDER" => "Задайте вопрос",
		"CATEGORY_MESSAGE_VALUE" => "",
		"CATEGORY_MESSAGE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_MESSAGE_IBLOCK_FIELD" => "PREVIEW_TEXT",
		"CATEGORY___________________________________TITLE" => "Название компании",
		"CATEGORY___________________________________TYPE" => "text",
		"CATEGORY_PLACEHOLDER" => "Название компании",
		"CATEGORY___________________________________VALUE" => "",
		"CATEGORY___________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY___________________________________IBLOCK_FIELD" => "FORM_Название компании",
		"CATEGORY___________________________________PLACEHOLDER" => "Название компании",
		"CATEGORY_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY___________________________________VALIDATION_MESSAGE" => "Обязательное поле"
	),
	false
);
    } else if ($arParams['URL'] === '/otpravka-obraztsov-2fix/'){
        $APPLICATION->IncludeComponent(
	"slam:easyform", 
	"traiv-example", 
	array(
		"COMPONENT_TEMPLATE" => "traiv-example",
		"FORM_ID" => "FORM114",
		"FORM_NAME" => "Запрос образцов",
		"WIDTH_FORM" => "auto",
		"DISPLAY_FIELDS" => array(
			0 => "TITLE",
			1 => "EMAIL",
			2 => "PHONE",
			3 => "address",
			4 => "",
		),
		"REQUIRED_FIELDS" => array(
			0 => "PHONE",
		),
		"FIELDS_ORDER" => "TITLE,PHONE,EMAIL,address",
		"FORM_AUTOCOMPLETE" => "Y",
		"HIDE_FIELD_NAME" => "Y",
		"HIDE_ASTERISK" => "N",
		"FORM_SUBMIT_VALUE" => "Получить образцы",
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
		"EMAIL_BCC" => "dmitrii.kozlov@traiv.ru,pletneva@traiv.ru,k.fedorova@traiv.ru",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи Заказать образцы",
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
		"CATEGORY_TITLE_PLACEHOLDER" => "Имя",
		"CATEGORY_TITLE_VALUE" => "",
		"CATEGORY_TITLE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_TITLE_VALIDATION_ADDITIONALLY_MESSAGE" => "maxlength=\"400\"",
		"CATEGORY_EMAIL_TITLE" => "Ваш E-mail",
		"CATEGORY_EMAIL_TYPE" => "email",
		"CATEGORY_EMAIL_PLACEHOLDER" => "E-mail",
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
		"CATEGORY_DOCS_IBLOCK_FIELD" => "FORM_DOCS",
		"CATEGORY_______________________________________________IBLOCK_FIELD" => "FORM_ИНН (для юридических лиц)",
		"FORM_SUBMIT_VARNING" => "Нажимая на кнопку \"#BUTTON#\", вы даете согласие на обработку <a target=\"_blank\" class=\"polslam\" href=\"/politika-konfidentsialnosti/\" >персональных данных</a>",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ELEMENT_ID" => $arResult["ID"],
		"FORMATED_NAME" => $formatedname,
		"CATEGORY_MESSAGE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_HIDDEN_TITLE" => "Скрытое поле",
		"CATEGORY_HIDDEN_TYPE" => "hidden",
		"CATEGORY_HIDDEN_VALUE" => "",
		"CATEGORY_HIDDEN_IBLOCK_FIELD" => "FORM_HIDDEN",
		"CATEGORY_address_TITLE" => "Адрес для отправки образцов",
		"CATEGORY_address_TYPE" => "textarea",
		"CATEGORY_address_PLACEHOLDER" => "Адрес для отправки образцов",
		"CATEGORY_address_VALUE" => "",
		"CATEGORY_address_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_address_IBLOCK_FIELD" => "FORM_address"
	),
	false
);
    } else {
        $APPLICATION->IncludeComponent(
            "slam:easyform",
            "traiv-land",
            array(
                "COMPONENT_TEMPLATE" => "traiv-land",
                "FORM_ID" => "FORM109",
                "FORM_NAME" => "Запрос лендинг",
                "WIDTH_FORM" => "auto",
                "DISPLAY_FIELDS" => array(
                    0 => "TITLE",
                    1 => "EMAIL",
                    2 => "PHONE",
                    3 => "",
                ),
                "REQUIRED_FIELDS" => array(
                    0 => "PHONE",
                    1 => "",
                ),
                "FIELDS_ORDER" => "TITLE,PHONE,EMAIL",
                "FORM_AUTOCOMPLETE" => "Y",
                "HIDE_FIELD_NAME" => "Y",
                "HIDE_ASTERISK" => "N",
                "FORM_SUBMIT_VALUE" => "Получить консультацию",
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
                "MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи Лендинг производство",
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
                "CATEGORY_TITLE_PLACEHOLDER" => "Имя",
                "CATEGORY_TITLE_VALUE" => "",
                "CATEGORY_TITLE_VALIDATION_MESSAGE" => "Обязательное поле",
                "CATEGORY_TITLE_VALIDATION_ADDITIONALLY_MESSAGE" => "maxlength=\"400\"",
                "CATEGORY_EMAIL_TITLE" => "Ваш E-mail",
                "CATEGORY_EMAIL_TYPE" => "email",
                "CATEGORY_EMAIL_PLACEHOLDER" => "E-mail",
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
                "CATEGORY_DOCS_IBLOCK_FIELD" => "FORM_DOCS",
                "CATEGORY_______________________________________________IBLOCK_FIELD" => "FORM_ИНН (для юридических лиц)",
                "FORM_SUBMIT_VARNING" => "Нажимая на кнопку \"#BUTTON#\", вы даете согласие на обработку <a target=\"_blank\" class=\"polslam\" href=\"/politika-konfidentsialnosti/\" >персональных данных</a>",
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
    }
    ?>
</noindex>
</div>
						
						</div>
					</div>
                </div>
            
            <?php 
        }
        /*область с иконками*/
        else if ($val['TYPEITEMID'] == '20618'){
            ?>
            <div class="landinfo-color-area" <?php echo $backColor;?>>
                <div class="container">
        			<div class="row position-relative">
        			
        			        <div class="col-12 col-xl-12 col-lg-12 col-md-12 p-5 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
                            	<div class="landinfo-title" <?php echo $textColor;?>><?php echo $val['TYPEITEMTITLE'];?></div>
                            </div>
                            
                            <?php 
                            if (!empty($val['TYPEITEMSMTITLE'])){
                            ?>
                            
                            <div class="col-10 col-xl-10 col-lg-10 col-md-10 offset-md-2 offset-xl-2 offset-lg-2 pt-3 pb-3 text-left position-relative"><div class="landinfo-pre-title-text" <?php echo $textColor;?>>
            	<?php echo $val['TYPEITEMSMTITLE'];?>
            	</div></div>
            	<?php 
                            }
            	?>
                            
                            <div class="col-12 col-xl-12 col-lg-12 col-md-12 p-xl-5 p-lg-5 p-md-5 text-center position-relative">
                            	<div class="row position-relative g-0">
                            		<?php 
                            		if (count($val['TYPEITEMICONS']) > 0) {
                            		    foreach ($val['TYPEITEMICONS'] as $ickey=>$icval){
                            		        ?>
                            		    <div class="col-6 col-lg-2 col-sm-6">
                                		    <div class="landinfo-pre-about-area-item">
                                    		    <div class="landinfo-pre-about-area-item-img"><img src="<?php echo $icval['IMGICONS']?>"></div>
                                    		    <h4 class="title"><?php echo $icval['NAMEICONS']?></h4>
                                		    </div>
                            		    </div>
                            		    <?php 
                            		    }
                            		}
                            		?>
                            	</div>
                            </div>
        			
        			</div>
				</div>
            </div>
            <?php 
        }/*end область с иконками*/
        
        /*Контентная область*/
        else if ($val['TYPEITEMID'] == '20619'){
            ?>
            
<div class="land-text-area pb-5" <?php echo $backColor;?>>
    <div class="container">
        <div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="landinfo-title" <?php echo $textColor;?>><?php echo $val['TYPEITEMTITLE'];?></div>
            </div>
		</div>
		
		<?php 
		        $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv-new-largefont", Array(
		            "COMPONENT_TEMPLATE" => "traiv-new-largefont",
		            "START_FROM" => "0",
		            "PATH" => "",
		            "SITE_ID" => "zf",
		        ),
		            false
		            );
		?>
		
		 <div class="row position-relative">
            <div class="col-10 col-xl-10 col-lg-10 col-md-10 text-left position-relative">
            	<div class="landinfo-title-text" <?php echo $textColor;?>>
            	<?php echo $val['TYPEITEMSMTITLE'];?>
            	</div>
            </div>
            
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 text-left position-relative landinfo-main-text" <?php echo $textColor;?>>
            <?php echo $val['TYPEITEMTEXT'];?>
            </div>
            
		</div>
		
	</div>
</div>
            
            <?php 
        }
        /*end Контентная область*/
        
        /*Особенности*/
        else if ($val['TYPEITEMID'] == '20620'){
        ?>
        <div class="land-particular-area">
    <div class="container">
        <div class="row position-relative">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
            	<div class="landinfo-title" <?php echo $textColor;?>><?php echo $val['TYPEITEMTITLE'];?></div>
            </div>
		</div>
		
		
		<div class="row position-relative">
		
		<?php 
                            		if (count($val['TYPEITEMHANG']) > 0) {
                            		    $h=1;
                            		    foreach ($val['TYPEITEMHANG'] as $hkey=>$hval){
                            		        ?>
                            		        
                            		        <div class="col-12 col-xl-6 col-lg-6 col-md-6 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
                                            	<div class="hang-item position-relative">
                                            		<div class="hang-number"><?php echo "0".$h;?></div>
                                            		<div class="hang-title"><?php echo $hval['NAME']?></div>
                                            		<div class="hang-note"><?php echo $hval['NOTE']?></div>	
                                            	</div>
                                            </div>
                            		    <?php 
                            		    $h++;
                            		    }
                            		}
                            		?>
            
		</div>
		
	</div>
</div>
        <?php 
        }
        /*end Особенности*/
        
        /*Элементы*/
        else if ($val['TYPEITEMID'] == '20621'){
            ?>
            <div class="landinfo-elements-area" <?php echo $backColor;?>>
				<div class="container">
                    <div class="row position-relative">
                        <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
                        	<div class="landinfo-title" <?php echo $textColor;?>><?php echo $val['TYPEITEMTITLE'];?></div>
                        </div>
            		</div>
            		
            		 <div class="row position-relative">
            		  <?php 
                            if (!empty($val['TYPEITEMSMTITLE'])){
                            ?>
                        <div class="col-10 col-xl-10 col-lg-10 col-md-10 offset-md-2 offset-xl-2 offset-lg-2 text-left position-relative">
                        	<div class="landinfo-title-text" <?php echo $textColor;?>>
                        	<?php echo $val['TYPEITEMSMTITLE'];?>
                        	</div>
                        </div>
                        
                        <?php 
                            }
                        ?>
                        
            		</div>
            		
            		
            		<div class="row position-relative mt-5">
		
		<?php 
                            		if (count($val['TYPEITEMELEMENT']) > 0) {
                            		    foreach ($val['TYPEITEMELEMENT'] as $ekey=>$eval){
                            		        ?>
                            		        
                            		        <div class="col-12 col-xl-3 col-lg-3 col-md-3 p-xl-3 p-lg-3 p-md-3 text-left position-relative">
                                            	<a href="<?php echo $eval['URL']?>" class="el-item bordered position-relative">
                                            		<div class="el-img text-center">
                                            			<img src="<?php echo $eval['IMG']?>"/>
                                            		</div>	
                                            		<div class="el-name text-center">
                                            		<?php echo $eval['NAME']?>
                                            		</div>
                                            		
                                            		<div class="el-button">
                                            			<div href="#" class="landinfo-btn">Подробнее</div>
                                            		</div>
                                            		
                                            	</a>
                                            </div>
                            		    <?php 
                            		    $h++;
                            		    }
                            		}
                            		?>
            
		</div>
            		
            		
            	</div>
            </div>
            <?php 
        }
        /*end Элементы*/
        /*привязка к другим разделам*/
        else if ($val['TYPEITEMID'] == '20622'){
            ?>
            <div class="landinfo-elements-area" <?php echo $backColor;?>>
				<div class="container">
                    <div class="row position-relative">
                        <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
                        	<div class="landinfo-title" <?php echo $textColor;?>><?php echo $val['TYPEITEMTITLE'];?></div>
                        </div>
            		</div>
            		
            		 <div class="row position-relative">
            		  <?php 
                            if (!empty($val['TYPEITEMSMTITLE'])){
                            ?>
                        <div class="col-10 col-xl-10 col-lg-10 col-md-10 offset-md-2 offset-xl-2 offset-lg-2 text-left position-relative">
                        	<div class="landinfo-title-text" <?php echo $textColor;?>>
                        	<?php echo $val['TYPEITEMSMTITLE'];?>
                        	</div>
                        </div>
                        
                        <?php 
                            }
                        ?>
                        
            		</div>
            		
            		
            		<div class="row position-relative mt-5">
		
		<?php
		
		
                            		if (count($val['TYPEITEMLINK']) > 0) {
                            		    foreach ($val['TYPEITEMLINK'] as $lkey=>$lval){
                            		        ?>
                            		        
                            		        <div class="col-12 col-xl-4 col-lg-4 col-md-4 p-xl-3 p-lg-3 p-md-3 text-left position-relative">
                                            	<a href="<?php echo $lval['LINK']?>" class="el-item bordered position-relative">
                                            		<div class="el-img text-center">
                                            			<img src="<?php echo $lval['IMG']?>"/>
                                            		</div>	
                                            		<div class="el-name text-center">
                                            		<?php echo $lval['NAME']?>
                                            		</div>
                                            		
                                            		<div class="el-button">
                                            			<div class="landinfo-btn">Подробнее</div>
                                            		</div>
                                            		
                                            	</a>
                                            </div>
                            		    <?php 
                            		    $h++;
                            		    }
                            		}
                            		?>
            
		</div>
            		
            		
            	</div>
            </div>
            <?php 
        }
        /*end привязка к другим разделам*/
        
        /*привязка к основным разделам каталога*/
        
        else if ($val['TYPEITEMID'] == '20623'){
            ?>
            <div class="landinfo-elements-area" <?php echo $backColor;?>>
				<div class="container">
                    <div class="row position-relative">
                        <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
                        	<div class="landinfo-title" <?php echo $textColor;?>><?php echo $val['TYPEITEMTITLE'];?></div>
                        </div>
            		</div>
            		
            		 <div class="row position-relative">
            		  <?php 
                            if (!empty($val['TYPEITEMSMTITLE'])){
                            ?>
                        <div class="col-10 col-xl-10 col-lg-10 col-md-10 offset-md-2 offset-xl-2 offset-lg-2 text-left position-relative">
                        	<div class="landinfo-title-text" <?php echo $textColor;?>>
                        	<?php echo $val['TYPEITEMSMTITLE'];?>
                        	</div>
                        </div>
                        
                        <?php 
                            }
                        ?>
                        
            		</div>
            		
            		
            		<div class="row position-relative mt-5">
		
		<?php 
                            		if (count($val['TYPEITEMCATITEMS']) > 0) {
                            		    foreach ($val['TYPEITEMCATITEMS'] as $lkey=>$lval){
                            		        ?>
                            		        
                            		        <div class="col-12 col-xl-4 col-lg-4 col-md-4 p-xl-3 p-lg-3 p-md-3 text-left position-relative">
                                            	<a href="<?php echo $lval['URL']?>" class="el-item bordered position-relative">
                                            		<div class="el-img text-center">
                                            			<img src="<?php echo $lval['IMG']?>"/>
                                            		</div>	
                                            		<div class="el-name text-center">
                                            		<?php echo $lval['NAME']?>
                                            		</div>
                                            		
                                            		<div class="el-button">
                                            			<div class="landinfo-btn">Подробнее</div>
                                            		</div>
                                            		
                                            	</a>
                                            </div>
                            		    <?php 
                            		    $h++;
                            		    }
                            		}
                            		?>
            
		</div>
            		
            		
            	</div>
            </div>
            <?php 
        }
        
        /*end привязка к основным разделам каталога*/
        
        /*Галерея изображений*/
        
        else if ($val['TYPEITEMID'] == '20626'){
            ?>
            <div class="landinfo-elements-area" <?php echo $backColor;?>>
				<div class="container">
                    <div class="row position-relative">
                        <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 p-xl-5 p-lg-5 p-md-5 text-left position-relative">
                        	<div class="landinfo-title" <?php echo $textColor;?>><?php echo $val['TYPEITEMTITLE'];?></div>
                        </div>
            		</div>
            		
            		 <div class="row position-relative">
            		  <?php 
                            if (!empty($val['TYPEITEMSMTITLE'])){
                            ?>
                        <div class="col-10 col-xl-10 col-lg-10 col-md-10 offset-md-2 offset-xl-2 offset-lg-2 text-left position-relative">
                        	<div class="landinfo-title-text" <?php echo $textColor;?>>
                        	<?php echo $val['TYPEITEMSMTITLE'];?>
                        	</div>
                        </div>
                        
                        <?php 
                            }
                        ?>
                        
            		</div>
            		
            		
            		<div class="row position-relative mt-5">
		
		<?php 
                            		if (count($val['TYPEITEMIMGITEMS']) > 0) {
                            		    foreach ($val['TYPEITEMIMGITEMS'] as $ikey=>$ival){
                            		        ?>
                            		        
                            		        <div class="col-12 col-xl-3 col-lg-3 col-md-3 p-xl-3 p-lg-3 p-md-3 text-left position-relative">
                                            	<a href="<?php echo $ival['IMG']?>" class="i-item bordered position-relative fancy-img" data-fancybox="gallery">
                                            		<div class="i-img text-center" style="background-image:url(<?php echo $ival['IMG']?>);"></div>
                                            	</a>
                                            </div>
                            		    <?php 
                            		    $h++;
                            		    }
                            		}
                            		?>
            
		</div>
            		
            		
            	</div>
            </div>
            <?php 
        }
        
        /*end Галерея изображений*/
        
    }
    ?>
    </section>
    <?php 
}

?>
      <script type="text/javascript">
	/*BX.ready(function() {
		var landinfo = new JCDktklandinfo({
			items:<?=json_encode($arResult['ITEMS']);?>
		});
	});*/
</script>

