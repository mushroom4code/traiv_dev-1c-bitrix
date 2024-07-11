<div class="row mt-0 mb-3">
    <div class="col-6 col-xl-2 col-lg-2 col-md-2">
    
        <div class="btn-group-blue w-100">
            <a href="#" class="btn-blue-round w-100 delivery_block_link">
                <span>Доставка</span>
            </a>
        </div>
    
    </div>
    
    <div class="col-6 col-xl-2 col-lg-2 col-md-2">
    
        <div class="btn-group-blue w-100">
            <a href="#" class="btn-gray-round w-100 payment_block_link">
                <span>Оплата</span>
            </a>
        </div>
    
    </div>
</div>

<div id="delivery_block" class="active">
    <div class="row">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12">
            <p>
            	 Компания Трайв рада предложить своим клиентам любые удобные для вас виды доставки. Купленный товар доставят в любую точку России быстро, выгодно и максимально надежно. Также действует бесплатная доставка. Для получения более подробной информации обратитесь по телефону, указанному на сайте или получите консультацию у наших менеджеров.
            </p>
        </div>  
    </div>
    
     <div class="row h-100 mb-5">
 
	<div class="col mt-5">
	
        <div class="delpay-item text-center">
			<div class="text-center delpay-item-img-area rounded-circle">
				<i class="fa fa-list-alt" aria-hidden="true"></i>
			</div>
			<div class="mb-0 delpay-item-title">Выберите ассортимент из каталога</div>
		</div>
		
    </div>
    
    	<div class="col mt-5">
	
        <div class="delpay-item text-center">
			<div class="text-center delpay-item-img-area rounded-circle">
				<i class="fa fa-volume-control-phone" aria-hidden="true"></i>
			</div>
			<div class="mb-0 delpay-item-title">Отправьте заявку по почте, и с вами свяжется менеджер</div>
		</div>
		
    </div>
    
        	<div class="col mt-5">
	
        <div class="delpay-item text-center">
			<div class="text-center delpay-item-img-area rounded-circle">
				<i class="fa fa-file-text-o" aria-hidden="true"></i>
			</div>
			<div class="mb-0 delpay-item-title">Получите счет</div>
		</div>
		
    </div>
    
    
        	<div class="col mt-5">
	
        <div class="delpay-item text-center">
			<div class="text-center delpay-item-img-area rounded-circle">
				<i class="fa fa-money" aria-hidden="true"></i>
			</div>
			<div class="mb-0 delpay-item-title">Оплатите товар
наличным или безналичным способом</div>
		</div>
		
    </div>
    
            	<div class="col mt-5">
	
        <div class="delpay-item text-center">
			<div class="text-center delpay-item-img-area rounded-circle">
				<i class="fa fa-truck" aria-hidden="true"></i>
			</div>
			<div class="mb-0 delpay-item-title">Получите Ваш товар
удобным способом</div>
		</div>
		
    </div>
        
 </div>
 
  <div class="row mt-5 mb-5">
 
 <div class="col-12 col-xl-12 col-lg-12 col-md-12">
     <div id="eShopLogisticWidgetForm" data-key="167880-1724-1713"></div>
    <script src="https://api.eshoplogistic.ru/widget/form/app.js"></script>
 </div>
 
</div>
 
    <div class="Order_one_click">
        
        
        <div class="btn-group-blue">
            <a href="#w-form-one-click" class="btn-blue-round setDeliveryShop" rel="nofollow">
                <span>Оформить доставку</span>
            </a>
        </div>
        
        <a href="#x" class="w-form__overlay-one-click" id="w-form-one-click"></a>
        <div class="w-form__popup-one-click">
            <?$APPLICATION->IncludeComponent(
	"slam:easyform", 
	"traiv-delivery", 
	array(
		"COMPONENT_TEMPLATE" => "traiv-delivery",
		"FORM_ID" => "FORM6",
		"FORM_NAME" => "Оформить доставку",
		"WIDTH_FORM" => "600px",
		"DISPLAY_FIELDS" => array(
			0 => "TITLE",
			1 => "EMAIL",
			2 => "PHONE",
			3 => "HIDDEN",
			4 => "",
			5 => "",
		),
		"REQUIRED_FIELDS" => array(
			0 => "TITLE",
			1 => "EMAIL",
			2 => "PHONE",
		),
		"FIELDS_ORDER" => "TITLE,EMAIL,PHONE,ИНН,HIDDEN",
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
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы ОФОРМИТЬ ДОСТАВКУ",
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
		"CATEGORY_PHONE_INPUTMASK" => "N",
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "",
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
		"IBLOCK_TYPE" => "formresult",
		"IBLOCK_ID" => "33",
		"ACTIVE_ELEMENT" => "N",
		"CATEGORY_TITLE_IBLOCK_FIELD" => "NAME",
		"CATEGORY_EMAIL_IBLOCK_FIELD" => "FORM_EMAIL",
		"CATEGORY_PHONE_IBLOCK_FIELD" => "FORM_PHONE",
		"CATEGORY_MESSAGE_IBLOCK_FIELD" => "PREVIEW_TEXT",
		"CATEGORY_DOCS_IBLOCK_FIELD" => "FORM_DOCS",
		"CATEGORY_______________________________________________IBLOCK_FIELD" => "FORM_ИНН (для юридических лиц)",
		"FORM_SUBMIT_VARNING" => "Нажимая на кнопку \"#BUTTON#\", вы даете согласие на обработку <a target=\"_blanc\" href=\"/politika-konfidentsialnosti/\">персональных данных</a>",
		"CATEGORY________TITLE" => "ИНН",
		"CATEGORY________TYPE" => "hidden",
		"CATEGORY________PLACEHOLDER" => "",
		"CATEGORY________VALUE" => "",
		"CATEGORY________VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY________IBLOCK_FIELD" => "FORM_ИНН",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CATEGORY_HIDDEN_TITLE" => "Расчет доставки",
		"CATEGORY_HIDDEN_TYPE" => "hidden",
		"CATEGORY_HIDDEN_VALUE" => "",
		"CATEGORY_HIDDEN_IBLOCK_FIELD" => "FORM_HIDDEN"
	),
	false
);?>
            <a class="w-form__close" title="Закрыть" href="#w-form__close"><i class="fa fa-close"></i></a>
        </div>
    </div>
    
    <!-- Варианты доставки -->
<div class="row h-100 mt-5"> 

	<div class="col-6">
    	<div class="del-item">
        	<div class='del-item-title'>
        		<i class="fa fa-map-marker"></i><span>Доставка по Москве</span>
        	</div>
        	<div class='del-item-content'>
				<p>Самовывоз (бесплатно при любом минимальном заказе).</p>
					<p>Адрес: г. Москва, Балашиха, д. Дятловка, владение 57 А.</p>
                 <p>Стоимость доставки рассчитывается индивидуально.</p>
        	</div>
    	</div>       
    </div>   
    
    <div class="col-6">
    	<div class="del-item">
        	<div class='del-item-title'>
        		<i class="fa fa-map-marker"></i><span>Доставка по Санкт-Петербургу</span>
        	</div>
        	<div class='del-item-content'>
				<p>Самовывоз (бесплатно при любом минимальном заказе).</p>
					<p>Адрес: г. Санкт-Петербург, Кудрово, Ул. Центральная, дом 41.</p>
                 <p>Стоимость доставки рассчитывается индивидуально.</p>
        	</div>
    	</div>       
    </div> 
    
    	<div class="col-6">
    	<div class="del-item">
        	<div class='del-item-title'>
        		<i class="fa fa-map-marker"></i><span>Доставка в Екатеринбург</span>
        	</div>
        	<div class='del-item-content'>
				<p>Самовывоз (бесплатно при любом минимальном заказе).</p>
					<p>Адреса выдачи заказов согласовываются со специалистом отдела продаж.</p>
                 <p>Стоимость доставки рассчитывается индивидуально.</p>
        	</div>
    	</div>       
    </div>  


 <div class="col-6">
    	<div class="del-item">
        	<div class='del-item-title'>
        		<i class="fa fa-map-marker"></i><span>Доставка в Пермь</span>
        	</div>
        	<div class='del-item-content'>
				<p>Самовывоз (бесплатно при любом минимальном заказе).</p>
					<p>Адреса выдачи заказов согласовываются со специалистом отдела продаж.</p>
                 <p>Стоимость доставки рассчитывается индивидуально.</p>
        	</div>
    	</div>       
    </div>
    
        <div class="col-6">
    	<div class="del-item">
		<div class='del-item-title'>
        	
        	<i class="fa fa-map-marker"></i><span>Доставка по всей России</span>
        	</div>
        	<div class='del-item-content'>
				<p>Самовывоз (бесплатно при любом минимальном заказе).</p>
					<p>Адреса выдачи заказов согласовываются со специалистом отдела продаж.</p>
                 <p>Стоимость доставки рассчитывается индивидуально.</p>
        	</div>
    	</div>       
    </div>
 </div>

<hr>

<div class="row h-100 mt-5"> 
        <div class="col-6">
    	<div class="del-item">
        	<div class='del-item-title'>
        		<i class="fa fa-map-marker"></i><span>Доставка в Беларусь</span>
        	</div>
        	<div class='del-item-content'>
			<p>Доставка осуществляется транспортной компанией.</p>
                 <p>Стоимость доставки рассчитывается индивидуально.</p>
        	</div>
    	</div>       
    </div>

        <div class="col-6">
    	<div class="del-item">
        	<div class='del-item-title'>
        		<i class="fa fa-map-marker"></i><span>Доставка в Казахстан</span>
        	</div>
        	<div class='del-item-content'>
			<p>Доставка осуществляется транспортной компанией.</p>
                 <p>Стоимость доставки рассчитывается индивидуально.</p>
        	</div>
    	</div>       
    </div>

        <div class="col-6">
    	<div class="del-item">
        	<div class='del-item-title'>
        		<i class="fa fa-map-marker"></i><span>Доставка в Узбекистан</span>
        	</div>
        	<div class='del-item-content'>
			<p>Доставка осуществляется транспортной компанией.</p>
                 <p>Стоимость доставки рассчитывается индивидуально.</p>
        	</div>
    	</div>       
    </div>

        <div class="col-6">
    	<div class="del-item">
        	<div class='del-item-title'>
        		<i class="fa fa-map-marker"></i><span>Доставка в страны СНГ</span>
        	</div>
        	<div class='del-item-content'>
			<p>Доставка осуществляется транспортной компанией.</p>
                 <p>Стоимость доставки рассчитывается индивидуально.</p>
        	</div>
    	</div>       
    </div>
    
 </div>
 <!-- Варианты доставки -->
 
     <!-- Виды доставки -->
<div class="row mt-5"> 

<div class="col-12 col-xl-3 col-lg-3 col-md-12">
<div class="row h-100 mt-5"> 
	<div class="col-12">
    	<div class="del-item">
        	<div class='del-item-title del-item-mt'>
        		<i class="fa fa-archive"></i><span>В течение дня</span>
        	</div>
        	<div class='del-item-content'>
				<p>Осуществляем доставку с 9:00 до 18:00. Вы можете оформить доставку на текущий день, а после 15:00 - на следующий.</p>
        	</div>
    	</div>       
    </div>   
    
    <div class="col-12">
    	<div class="del-item">
        	<div class='del-item-title del-item-mt'>
        		<i class="fa fa-archive"></i><span>Точно ко времени</span>
        	</div>
        	<div class='del-item-content'>
				<p>Осуществляется круглосуточно к точно указанному времени, но не раньше, чем через 3 часа с момента заказа.</p>
        	</div>
    	</div>       
    </div> 
    
    	<div class="col-12">
    	<div class="del-item">
        	<div class='del-item-title del-item-mt'>
        		<i class="fa fa-archive"></i><span>Курьерская доставка</span>
        	</div>
        	<div class='del-item-content'>
				<p>Осуществляем доставку по Санкт-Петербургу и Ленинградской области в течение рабочего дня. Заберем Ваш груз и отвезеем (например, сопроводительные документы). Сдадим Ваш груз в транспортную компанию.</p>
        	</div>
    	</div>       
    </div>
    
    </div>
     </div>
     
     <div class="col-12 col-xl-9 col-lg-9 col-md-12">
     
     	<div id="map_mp" class="mt-5">
	
    	<div class="map_office_area">
    	
    	</div>
	
	</div>
     
     </div>
    
    
    
 </div>
 <!-- Варианты доставки -->
    
    <?php 
    /*
if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {*/
 ?>

 <?php        
/*    }
}*/
?>
    
</div>

<div id="payment_block">
    <div class="row">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12">
            <p>
            	Компания Трайв-Комплект рада предложить своим клиентам любые удобные для вас виды оплаты. 
            </p>
        </div>  
    </div>
    
     <div class="row h-100 mb-5">
 
	<div class="col mt-5">
	
        <div class="delpay-item text-center">
			<div class="text-center delpay-item-img-area rounded-circle">
				<i class="fa fa-list-alt" aria-hidden="true"></i>
			</div>
			<div class="mb-0 delpay-item-title">Выберите ассортимент из каталога</div>
		</div>
		
    </div>
    
    	<div class="col mt-5">
	
        <div class="delpay-item text-center">
			<div class="text-center delpay-item-img-area rounded-circle">
				<i class="fa fa-volume-control-phone" aria-hidden="true"></i>
			</div>
			<div class="mb-0 delpay-item-title">Отправьте заявку по почте и с Вами свяжеться менеджер</div>
		</div>
		
    </div>
    
        	<div class="col mt-5">
	
        <div class="delpay-item text-center">
			<div class="text-center delpay-item-img-area rounded-circle">
				<i class="fa fa-file-text-o" aria-hidden="true"></i>
			</div>
			<div class="mb-0 delpay-item-title">Получите счет</div>
		</div>
		
    </div>
    
    
        	<div class="col mt-5">
	
        <div class="delpay-item text-center">
			<div class="text-center delpay-item-img-area rounded-circle">
				<i class="fa fa-money" aria-hidden="true"></i>
			</div>
			<div class="mb-0 delpay-item-title">Оплатите товар
наличным или безналичным способом</div>
		</div>
		
    </div>
    
            	<div class="col mt-5">
	
        <div class="delpay-item text-center">
			<div class="text-center delpay-item-img-area rounded-circle">
				<i class="fa fa-truck" aria-hidden="true"></i>
			</div>
			<div class="mb-0 delpay-item-title">Получите Ваш товар
удобным способом</div>
		</div>
		
    </div>
        
 </div>
 
 <blockquote>
 <strong><em>Покупая от 5000 рублей и более, вы получаете стоимость без розничной наценки.</em></strong>
</blockquote>

<div class="row h-100 mt-5"> 
	<div class="col-12 col-xl-6 col-lg-6 col-md-6">
    	<div class="del-item">
        	<div class='del-item-title del-item-mt'>
        		<i class="fa fa-credit-card"></i><span>Безналичный расчет</span><br><div class="del-item-font">(Только для юр. лиц)</div>
        	</div>
        	<div class='del-item-content'>
				<p>Вы отправляете свой заказ, реквизиты и адрес доставки (если не самовывоз) на почту&nbsp;<a onclick='goPage("mailto:info@traiv-komplekt.ru"); return false;' style="cursor: pointer" rel="nofollow">info@traiv-komplekt.ru</a> </p>
		<p>Мы выставляем Вам счет на оплату</p>
		<p>Вы оплачиваете счет</p>
		<p>Мы собираем Ваш заказ</p>
		<p>Мы отгружаем Ваш заказ (доставка или самовывоз)</p>
        	</div>
    	</div>       
    </div>   
    
    <div class="col-12 col-xl-6 col-lg-6 col-md-6">
    	<div class="del-item">
        	<div class='del-item-title del-item-mt'>
        		<i class="fa fa-credit-card"></i><span>Наличный расчет</span><br><div class="del-item-font">(Только для физ. лиц)</div>
        	</div>
        	<div class='del-item-content'>
				<p>Вы приезжаете к нам в офис (п.Кудрово, ул. Центральная, 41), делаете заказ и производите оплату</p>
		<p>если товар в наличии – сразу забираете со склада нашего парнера, либо заказываете у нас доставку</p>
		<p>если необходимого товара на складе нет, забираете товар после прихода на склад нашего партнера ИП Григорьев, либо мы доставим его Вам сами</p>
        	</div>
    	</div>       
    </div> 
    
    	<div class="col-12 mt-5">
    	<div class="del-item">
        	<div class='del-item-title del-item-mt'>
        		<i class="fa fa-credit-card"></i><span>Наличный расчет перечислением денег через банк</span>
        	</div>
        	<div class='del-item-content'>
						<p>Вы отправляете свой заказ, паспортные данные и адрес доставки (если не самовывоз) на почту&nbsp;<a onclick='goPage("mailto:info@traiv-komplekt.ru"); return false;' style="cursor: pointer" rel="nofollow">info@traiv-komplekt.ru</a> </p>
		<p>Мы отправляем Вам счет на оплату и реквизиты для перечисления денег</p>
		<p>Вы оплачиваете счет по приложенным реквизитам. Для оплаты можете прийти в кассу Сбербанк, воспользоваться терминалом Сбербанка или онлайн-банком Сбербанка или аналогичными услугами других сторонних банков.</p>
		<p>Мы собираем Ваш заказ</p>
		<p>Мы отгружаем Ваш заказ (организуем доставку или самовывоз)</p>
        	</div>
    	</div>       
    </div>
    
    </div>
 
 
</div>