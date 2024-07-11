<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Контактные данные для связи компании Трайв . Телефон: 8 (800) 551-15-82 | Производитель и дистрибьютор стандартных и нестандартных метизных отраслевых решений Трайв . Склады в Санкт-Петербурге и Москве, доставка по всей России и странам СНГ");
$APPLICATION->SetPageProperty("title", "Контакты оптового поставщика и производителя ООО “Трайв”");
$APPLICATION->SetTitle("Контакты");
?>	<section id="content">
		<div class="container">
<? $APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"traiv", 
	array(
		"COMPONENT_TEMPLATE" => "traiv",
		"START_FROM" => "0",
		"SITE_ID" => "s1",
		"PATH" => ""
	),
	false
); ?>

<div class="row">
<div class="col-12 col-xl-8 col-lg-8 col-md-8">
<h1><span>Контакты</span></h1>
</div>

<div class="col-12 col-xl-4 col-lg-4 col-md-4">
<a href="https://t.me/TraivLiveBot" target="_blank">
<img src="<?=SITE_TEMPLATE_PATH?>/images/chatbot-bann-contact.jpg" data-amwebp-skip class="chatbot-bann-contact"/>
</a>
</div>        


</div>

<div>
<div class="row h-100">

    	<!-- <div class="col-lg-3 col-md-3 col-sm-3  text-md-left text-center">
            <a href="javascript:void();return false;" class="cont-item bordered text-center">
    			
    			<div class="row d-flex align-items-center">
					<div class="col-lg-3 col-md-3 text-left">
						<div class="cont-icon rounded-circle"><i class="fa fa-map-marker"></i></div>
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
						
        				<span class="mb-0 cont-item-title-child">Все регионы</span>
            			<p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><span>8 (800) 707-25-98</span></p>

					</div>
				</div>
    					
    		</a>
        </div> -->
        
        
           <div class="col-lg-3 col-md-3 col-sm-3 text-md-left text-center" itemscope itemtype="http://schema.org/Organization">
            
            <div class="cont-item bordered text-center">
    			<div class="row d-flex align-items-center h-100">
					<div class="col-lg-3 col-md-3 text-center">
						<div class="cont-icon rounded-circle"><i class="fa fa-map-marker"></i></div>
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
        				<span class="mb-0 cont-item-title-child" itemprop="name">Главный офис и склад «Трайв» в Санкт-Петербурге</span>
        				
      <div style='display:block;opacity:0;width:0px;height:0px;position:relative;overflow:hidden;'>  				
<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    <span itemprop="addressLocality">Санкт-Петербург</span>,
    <span itemprop="streetAddress">Кудрово, ул.Центральная, дом 41</span>
    <span itemprop="postalCode">193168</span>
</div>
</div>
        				
            			<p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:88123132280" class="cont-item-rows-child-link"><span itemprop="telephone">8 (812) 313-22-80</span></a></p>
            			<!-- <p class="mt-1 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:+79219317932" class="cont-item-rows-child-link"><span>+7 (921) 931-79-32</span></a></p>-->
            			<a href="/contacts/sankt-peterburg/" class="cont-item-link">Подробнее...</a>
					</div>
				</div>
				
    		</div>
    		
        </div>
        
                   <div class="col-lg-3 col-md-3 col-sm-3 text-md-left text-center">
            
            <div class="cont-item bordered text-center">
    			<div class="row d-flex align-items-center h-100">
					<div class="col-lg-3 col-md-3 text-center">
						<div class="cont-icon rounded-circle"><i class="fa fa-map-marker"></i></div>
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
        				<span class="mb-0 cont-item-title-child">Офис «Трайв» в Санкт-Петербурге</span>
        				
            			<p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:88123132280" class="cont-item-rows-child-link"><span itemprop="telephone">8 (812) 313-22-80</span></a></p>
            			<a href="/contacts/sankt-peterburg2/" class="cont-item-link">Подробнее...</a>
					</div>
				</div>
				
    		</div>
    		
        </div>
        
                   <div class="col-lg-3 col-md-3 col-sm-3 text-md-left text-center" itemscope itemtype="http://schema.org/Organization">
            
            <div class="cont-item bordered text-center">
    			<div class="row d-flex align-items-center h-100">
					<div class="col-lg-3 col-md-3 text-center">
						<div class="cont-icon rounded-circle"><i class="fa fa-map-marker"></i></div>
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
        				<span class="mb-0 cont-item-title-child" itemprop="name">Производство «Трайв» в Санкт-Петербурге</span>
        				
      <div style='display:block;opacity:0;width:0px;height:0px;position:relative;overflow:hidden;'>  				
<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    <span itemprop="addressLocality">Санкт-Петербург</span>,
    <span itemprop="streetAddress">ул. Караваевская 57С</span>
    <span itemprop="postalCode">192177</span>
</div>
</div>
        				
            			<p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:88123132280" class="cont-item-rows-child-link"><span itemprop="telephone">8 (800) 333-91-16</span></a></p>
            			<!-- <p class="mt-1 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:+79219317932" class="cont-item-rows-child-link"><span>+7 (921) 931-79-32</span></a></p>-->
            			<a href="/contacts/service/" class="cont-item-link">Подробнее...</a>
					</div>
				</div>
				
    		</div>
    		
        </div>
        
                   <div class="col-lg-3 col-md-3 col-sm-3 text-md-left text-center" itemscope itemtype="http://schema.org/Organization">
            <div class="cont-item bordered text-center">
    			
    			<div class="row d-flex align-items-center h-100">
					<div class="col-lg-3 col-md-3 text-center">
						<div class="cont-icon rounded-circle"><i class="fa fa-map-marker"></i></div>
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
						
        				<span class="mb-0 cont-item-title-child" itemprop="name">Офис и склад «Трайв» в Москве</span>
        				
        				      <div style='display:block;opacity:0;width:0px;height:0px;position:relative;overflow:hidden;'>  				
<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    <span itemprop="addressLocality">Москва</span>,
    <span itemprop="streetAddress">Рязанский проспект, 2с49, БЦ "Карачарово", офис 203</span>
    <span itemprop="postalCode">109428</span>
</div>
</div>
        				
            			<p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:84953748270" class="cont-item-rows-child-link"><span itemprop="telephone">8 (495) 374-82-70</span></a></p>
						<a href="/contacts/moskva/" class="cont-item-link">Подробнее...</a>
					</div>
				</div>
    					
    		</div>
        </div>
        
                           <div class="col-lg-3 col-md-3 col-sm-3 mt-5 text-md-left text-center" itemscope itemtype="http://schema.org/Organization">
            <div class="cont-item bordered text-center">
    			
    			<div class="row d-flex align-items-center h-100">
					<div class="col-lg-3 col-md-3 text-center">
						<div class="cont-icon rounded-circle"><i class="fa fa-map-marker"></i></div>
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
						
        				<span class="mb-0 cont-item-title-child" itemprop="name">Филиал «Трайв» в Екатеринбурге</span>
        				<div style='display:block;opacity:0;width:0px;height:0px;position:relative;overflow:hidden;'>  	
        				<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    <span itemprop="addressLocality">Екатеринбург</span>,
    <span itemprop="streetAddress">Екатеринбург, Елизаветинское шоссе, 39</span>
    <span itemprop="postalCode">620024</span>
</div>
</div>
            			<p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:83432887940" class="cont-item-rows-child-link"><span itemprop="telephone">8 (343) 288-79-40</span></a></p>
						<a href="/contacts/ekaterinburg/" class="cont-item-link">Подробнее...</a>
					</div>
				</div>
    					
    		</div>
        </div>
        
                                   <div class="col-lg-3 col-md-3 col-sm-3 text-md-left mt-5 text-center" itemscope itemtype="http://schema.org/Organization">
            <div class="cont-item bordered text-center">
    			
    			<div class="row d-flex align-items-center h-100">
					<div class="col-lg-3 col-md-3 text-center">
						<div class="cont-icon rounded-circle"><i class="fa fa-map-marker"></i></div>
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
						
        				<span class="mb-0 cont-item-title-child" itemprop="name">Филиал «Трайв» в Перми</span>
        				<div style='display:block;opacity:0;width:0px;height:0px;position:relative;overflow:hidden;'>  	
        				        				<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    <span itemprop="addressLocality">Пермь</span>,
    <span itemprop="streetAddress">Пермь, шоссе Космонавтов 111И, корпус 1, 2 этаж, офис 36</span>
    <span itemprop="postalCode">614066</span>
</div>
        </div>				
            			<p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:89650605995" class="cont-item-rows-child-link"><span itemprop="telephone">8 (965) 060-59-95</span></a></p>
						<a href="/contacts/perm/" class="cont-item-link">Подробнее...</a>
					</div>
				</div>
    					
    		</div>
        </div>
        
                                           <div class="col-lg-3 col-md-3 col-sm-3 text-md-left mt-5 text-center" itemscope itemtype="http://schema.org/Organization">
            <div class="cont-item bordered text-center">
    			
    			<div class="row d-flex align-items-center h-100">
					<div class="col-lg-3 col-md-3 text-center">
						<div class="cont-icon rounded-circle"><i class="fa fa-map-marker"></i></div>
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
						
        				<span class="mb-0 cont-item-title-child" itemprop="name">Филиал «Трайв» в Краснодаре</span>
        				<div style='display:block;opacity:0;width:0px;height:0px;position:relative;overflow:hidden;'>  	
        				        				<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    <span itemprop="addressLocality">Краснодар</span>,
    <span itemprop="streetAddress">Краснодар, ул. Московская д.123, оф. 207</span>
    <span itemprop="postalCode">350024</span>
</div>
        </div>				
            			<p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:89650605995" class="cont-item-rows-child-link"><span itemprop="telephone">8 (965) 060-59-95</span></a></p>
						<a href="/contacts/krasnodar/" class="cont-item-link">Подробнее...</a>
					</div>
				</div>
    					
    		</div>
        </div>
        
                                                   <div class="col-lg-3 col-md-3 col-sm-3 text-md-left mt-5 text-center" itemscope itemtype="http://schema.org/Organization">
            <div class="cont-item bordered text-center">
    			
    			<div class="row d-flex align-items-center h-100">
					<div class="col-lg-3 col-md-3 text-center">
						<div class="cont-icon rounded-circle"><i class="fa fa-map-marker"></i></div>
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
						
        				<span class="mb-0 cont-item-title-child" itemprop="name">Филиал «Трайв» в Казани</span>
        				<div style='display:block;opacity:0;width:0px;height:0px;position:relative;overflow:hidden;'>  	
        				        				<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    <span itemprop="addressLocality">Казань</span>,
    <span itemprop="streetAddress">Казань, ул. Габдуллы Тукая д. 115, к.3, оф. 502</span>
    <span itemprop="postalCode">420021</span>
</div>
        </div>				
            			<p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:84953748270" class="cont-item-rows-child-link"><span itemprop="telephone">8 (965) 060-59-95</span></a></p>
						<a href="/contacts/kazan/" class="cont-item-link">Подробнее...</a>
					</div>
				</div>
    					
    		</div>
        </div>
        
        </div>
        
        <div class="row mb-5">
		<div class="col-12 col-lg-4 col-md-4 col-sm-4 pt-5 text-center">
            <a href="tel:88007072598" class="cont-item-link-big">Вся Россия - 8 800 707-25-98</a>
        </div>
        
        <div class="col-12 col-lg-4 col-md-4 col-sm-4 pt-4 text-center">
        <div class="btn-group-blue mt-3 mb-2">
	<a href="#w-form-director" class="btn-i"><span><i class="fa fa-envelope"></i> Написать директору</span></a>
	</div>
	</div>
        
        <div class="col-12 col-lg-4 col-md-4 col-sm-4 pt-5 text-center">
            <a href="mailto:info@traiv-komplekt.ru" class="cont-item-link-big">E-mail: info@traiv-komplekt.ru</a>
        </div>
        </div>
        
        <div class="row">
                   <div class="col-lg-3 col-md-3 col-sm-3 text-md-left text-center">
            
            <div class="cont-item bordered text-center">
    			<div class="row d-flex align-items-center h-100">
					<div class="col-lg-3 col-md-3 text-center">
	 <div class="country-icon"><img src="/images/media/rb.png"/></div>					
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
        				<span class="mb-0 cont-item-title-child">Беларусь</span>
            			<p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:88005511582" class="cont-item-rows-child-link"><span>8 (800) 551-15-82</span></a></p>
            			<!-- <p class="mt-1 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:+79219317932" class="cont-item-rows-child-link"><span>+7 (921) 931-79-32</span></a></p>-->
            			<!-- a href="/contacts/sankt-peterburg/" class="cont-item-link">Подробнее...</a-->
					</div>
				</div>
				
    		</div>
    		
        </div>
        
                   <div class="col-lg-3 col-md-3 col-sm-3 text-md-left text-center">
            <div class="cont-item bordered text-center">
    			
    			<div class="row d-flex align-items-center h-100">
					<div class="col-lg-3 col-md-3 text-center">
						<div class="country-icon"><img src="/images/media/kz.png"/></div>
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
						
        				<span class="mb-0 cont-item-title-child">Казахстан</span>
           			<p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:88005511582" class="cont-item-rows-child-link"><span>8 (800) 551-15-82</span></a></p>
            			<!-- <p class="mt-1 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:+79219317932" class="cont-item-rows-child-link"><span>+7 (921) 931-79-32</span></a></p>-->
            			<!-- a href="/contacts/sankt-peterburg/" class="cont-item-link">Подробнее...</a-->
					</div>
				</div>
    					
    		</div>
        </div>
        
                           <div class="col-lg-3 col-md-3 col-sm-3 text-md-left text-center">
            <div class="cont-item bordered text-center">
    			
    			<div class="row d-flex align-items-center h-100">
					<div class="col-lg-3 col-md-3 text-center">
						<div class="country-icon"><img src="/images/media/uz.png"/></div>
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
						
        				<span class="mb-0 cont-item-title-child">Узбекистан</span>
           			<p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:88005511582" class="cont-item-rows-child-link"><span>8 (800) 551-15-82</span></a></p>
            			<!-- <p class="mt-1 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:+79219317932" class="cont-item-rows-child-link"><span>+7 (921) 931-79-32</span></a></p>-->
            			<!-- a href="/contacts/sankt-peterburg/" class="cont-item-link">Подробнее...</a-->
					</div>
				</div>
    					
    		</div>
        </div>
        
                                   <div class="col-lg-3 col-md-3 col-sm-3 text-md-left text-center">
            <div class="cont-item bordered text-center">
    			
    			<div class="row d-flex align-items-center h-100">
					<div class="col-lg-3 col-md-3 text-center">
						<div class="country-icon"><img src="/images/media/sng1.png"/></div>
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
						
        				<span class="mb-0 cont-item-title-child">Все страны СНГ</span>
           			<p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:88005116489" class="cont-item-rows-child-link"><span>8 (800) 551-15-82</span></a></p>
            			<!-- <p class="mt-1 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:+79219317932" class="cont-item-rows-child-link"><span>+7 (921) 931-79-32</span></a></p>-->
            			<!-- a href="/contacts/sankt-peterburg/" class="cont-item-link">Подробнее...</a-->
					</div>
				</div>
    					
    		</div>
        </div>
        
</div>
</div>

	<div id="map_mp" class="mt-5">
    	<div class="map_office_area">
    	</div>
	</div>

<div class="row h-100">
    <div class="col-12 col-lg-5 col-md-5 col-sm-5 text-md-left text-center">
    
    <h2>Реквизиты компании ООО «ТК МАШ»</h2>
    
     <div class="btn-group-blue mt-2 mb-2">
        <a href="/gosti-na-krepezh/file/requisitesPopupPdf.pdf" class="btn-i" target="_blank">
        	<span><i class="fa fa-download"></i> Скачать реквизиты</span>
        </a>
    </div>

<p><strong>Организационно-правовая форма:</strong> Общество с ограниченной ответственностью</p>

<p><strong>Наименование: </strong>ООО «ТК МАШ»</p>

<p><strong>Юридический адрес: </strong>199178, г. Санкт-Петербург, набережная реки Смоленки, д. 14, литер А, офис 347, пом. 1-Н</p>

<p><strong>Фактический адрес: </strong>199178, г. Санкт-Петербург, набережная реки Смоленки, д. 14, литер А, офис 347, пом. 1-Н</p>

<p><strong>Склад: </strong>188692, РФ, Ленинградская обл., г. Кудрово, ул. Центральная, д. 41.</p>

<p><strong>Почтовый адрес: </strong>193168, РФ, г. Санкт-Петербург, а/я 83.</p>

<p><strong>ИНН:</strong> 7801670793</p>

<p><strong>КПП:</strong>780101001</p>

<p><strong>ОГРН:</strong> 1197847176229 (дата присвоения ОГРН: 28.08.2019 г.)</p>

<p><strong>Телефон:</strong> 8(812)313-22-80</p>

<p><strong>E</strong><strong>-</strong><strong>mail</strong><strong>: </strong>info@traiv-komplekt.ru</p>

<p> </p>

<p><strong>Банковские реквизиты:</strong></p>


<p>р/с 40702810790550004167 ПАО "БАНК "САНКТ-ПЕТЕРБУРГ"</p>

<p>к/с 30101810900000000790</p>

<p>ИНН банка 7831000027</p>
<p>КПП банка 780601001</p>

<p> </p>
 
<p><strong>ОКАТО: </strong>40263000000</p>

<p><strong>ОКТМО: </strong>40309000000</p>

<p><strong>ОКПО:</strong> 41308885</p>

<p><strong>ОКОПФ: </strong>12300</p>

<p><strong>ОКОГУ:</strong> 4210014</p>

<p><strong>ОКФС: </strong>16</p>

<p><strong>ОКВЭД: </strong>46.74</p>

<p><strong>Генеральный директор: </strong>Леваков Владимир Евгеньевич (ИНН: 773209775305), действующий на основании Устава.</p>
    
    </div>
    
    
            <div class="col-12 col-lg-5 col-md-5 col-sm-5 offset-md-1 offset-xl-1 offset-lg-1 text-md-left text-center">
    
    <h2>Реквизиты компании ООО «ТК»</h2>
    
     <div class="btn-group-blue mt-2 mb-2">
        <a href="/gosti-na-krepezh/file/requisitesPopupPdfTK.pdf" class="btn-i" target="_blank">
        	<span><i class="fa fa-download"></i> Скачать реквизиты</span>
        </a>
    </div>

<p><strong>Организационно-правовая форма:</strong> Общество с ограниченной ответственностью</p>

<p><strong>Наименование: </strong>ООО «ТК»</p>

<p><strong>Юридический адрес: </strong>199178, г. Санкт-Петербург, набережная реки Смоленки, д. 14, литер А, офис 404, пом. 1-Н</p>

<p><strong>Фактический адрес: </strong>199178, г. Санкт-Петербург, набережная реки Смоленки, д. 14, литер А, офис 404, пом. 1-Н</p>


<p><strong>Почтовый адрес: </strong>193168, РФ, г. Санкт-Петербург, а/я 83.</p>

<p><strong>ИНН:</strong> 7804618544</p>

<p><strong>КПП:</strong>780101001</p>

<p><strong>ОГРН:</strong> 1187847101529</p>

<p><strong>Телефон:</strong> 8(812)313-22-80</p>

<p><strong>E</strong><strong>-</strong><strong>mail</strong><strong>: </strong>info@traiv-komplekt.ru</p>

<p> </p>

<p><strong>Банковские реквизиты:</strong></p>

<p>Р/с 40702810890550004203 в ПАО "БАНК "САНКТ-ПЕТЕРБУРГ"</p>
<p>К/с 30101810900000000790</p>
<p>БИК: 044030790</p>
<br>

<p>Р/с 40702810555000056404 в СЕВЕРО-ЗАПАДНЫЙ ФИЛИАЛ ПАО СБЕРБАНК </p>
<p>К/с 30101810500000000653</p>
<p>БИК: 044030653</p>


<p><strong>Генеральный директор: </strong>Ваганова Ольга Васильевна, на основании Устава.</p>
    
    </div>
    
    
</div>
<!-- 
<div style="display:none;" class="plashka_ff">
<div style="display:none;" itemscope itemtype="http://schema.org/Organization">


<span itemprop="name"><h2 class="contacts_blue_title"><a href="/contacts/sankt-peterburg/"><i class="fa fa-street-view"></i>Главный офис и склад «Трайв» в Санкт-Петербурге</a></h2></span>

                            <table style="width: 100%">
                <tbody>
                <tr>
                	<td style="text-align: center; width:20%; border:none"><a href="/contacts/sankt-peterburg/"><img src="/images/articles/office_traiv_komplekt2.jpg" style="width: 200px;"></a>
                	</td>
                	<td style="border:none">
                		<ul class="contacts_ul">
                            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                			<li>Телефон: <span style="font-weight:bold;color:#d82411"><span itemprop="telephone">+7 (812) 313-22-80</span> (Многоканальный), +7 (921) 931-79-32</span></li>
                			<li>Электронная почта: <span itemprop="email"><a onclick='goPage("mailto:info@traiv-komplekt.ru"); return false;' style="cursor: pointer" rel="nofollow">info@traiv-komplekt.ru</a></li></span>
<li><a onclick='goPage("mailto:director@traiv.ru"); return false;' style="cursor: pointer" rel="nofollow">Письмо директору</a></li>
                			<li>Почтовый адрес (для отправки писем): <a href="#"><span itemprop="postalCode">193168</span>, <span itemprop="addressLocality">г.Санкт-Петербург</span>, а/я 83</a></li>
                			<li>Адрес (офис и склад): <a href="/contacts/sankt-peterburg/">Санкт-Петербург, <span itemprop="streetAddress">Кудрово, ул.Центральная, дом 41</a></li></span></span>
                			<li>Режим работы: <span style="">Понедельник-Пятница: 9:00-21:00, Суббота-Воскресенье: Выходной</span></li>
<li><a href="/contacts/sankt-peterburg/">Подробнее...</a></li>
                            </div>
                		</ul>
                	</td>
                </tr>
                </tbody>
                </table style="width: 100%">
                <hr>
        
        
<span itemprop="name"><h2 class="contacts_blue_title"><a href="/contacts/moskva/"><i class="fa fa-street-view"></i>Офис и склад «Трайв» в Москве</a></h2></span>

                            <table style="width: 100%">
                <tbody>
                <tr>
                	<td style="text-align: center; width:20%; border:none"><a href="/contacts/moskva/"><img src="/images/articles/kartmsk.png" style="width: 200px;"></a>
                	</td>
                	<td style="border:none">
                		<ul class="contacts_ul">
                            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                			<li>Телефон: <span style="font-weight:bold;color:#d82411"><span itemprop="telephone">+7 (495) 374-82-70</span></span></li>
                			<li>Электронная почта: <span itemprop="email"><a onclick='goPage("mailto:info@traiv-komplekt.ru"); return false;' style="cursor: pointer" rel="nofollow">info@traiv-komplekt.ru</a></li></span>
<li><a onclick='goPage("mailto:director@traiv.ru"); return false;' style="cursor: pointer" rel="nofollow">Письмо директору</a></li>
                			<li>Адрес офиса: <a href="/contacts/moskva/"><span itemprop="postalCode">109202</span>, <span itemprop="addressLocality">Москва</span>, <span itemprop="streetAddress">ул. 1-я Фрезерная д.2/1 стр 1 ИТКОЛ-сервеинг</a></li></span>
<li>Адрес склада: <a href="/contacts/moskva/"><span itemprop="postalCode">143921</span>, <span itemprop="addressLocality">Москва</span>, <span itemprop="streetAddress">Балашиха, д. Дятловка, владение 57 А</a></li></span>
                			<li>Режим работы: <span style="">Понедельник-Пятница: 9:00-17:30, Суббота-Воскресенье: Выходной</span></li>
<li><a href="/contacts/moskva/">Подробнее...</a></li>
                            </div>
                		</ul>
                	</td>
                </tr>
                </tbody>
                </table style="width: 100%">
                <hr>




        
<span itemprop="name"><h2 class="contacts_blue_title"><a href="/contacts/moskva/"><a href="/contacts/ekaterinburg/"><i class="fa fa-street-view"></i>Филиал «Трайв» в Екатеринбурге</a></h2></span>

                        <table style="width: 100%">
                <tbody>
                <tr>
                	<td style="text-align: center; width:20%; border:none"><a href="/contacts/ekaterinburg/"><img src="/images/articles/kartekb.png" style="width: 200px;"></a>
                	</td>
                	<td style="border:none">
                		<ul class="contacts_ul">
                            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                			<li>Телефон: <span style="font-weight:bold;color:#d82411"><span itemprop="telephone">+7 (343) 288-79-40</span></span></li>
                			<li>Электронная почта: <span itemprop="email"><a onclick='goPage("mailto:info@traiv-komplekt.ru"); return false;' style="cursor: pointer" rel="nofollow" >info@traiv-komplekt.ru</a></li></span>
<li><a onclick='goPage("mailto:director@traiv.ru"); return false;' style="cursor: pointer" rel="nofollow" >Письмо директору</a></li>
                			<li>Адрес: <a href="/contacts/ekaterinburg/"><span itemprop="postalCode">620024</span>, <span itemprop="addressLocality">Екатеринбург</span>, <span itemprop="streetAddress">Елизаветинское шоссе, 39</a></li></span>
                			<li>Режим работы: <span style="">Понедельник-Пятница: 09:00-21:00, Суббота-Воскресенье: Выходной</span></li>
<li><a href="/contacts/ekaterinburg/">Подробнее...</a></li>
                            </div>
                		</ul>
                	</td>
                </tr>
                </tbody>
                </table>
                
                               <hr>
        
        
<span itemprop="name"><h2 class="contacts_blue_title"><a href="/contacts/perm/"><i class="fa fa-street-view"></i>Филиал «Трайв» в Перми</a></h2></span>

                            <table style="width: 100%">
                <tbody>
                <tr>
                	<td style="text-align: center; width:20%; border:none"><a href="/contacts/perm/"><img src="/images/articles/kartmsk.png" style="width: 200px;"></a>
                	</td>
                	<td style="border:none">
                		<ul class="contacts_ul">
                            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                			<li>Телефон: <span style="font-weight:bold;color:#d82411"><span itemprop="telephone">+7 (495) 374-82-70</span></span></li>
                			<li>Электронная почта: <span itemprop="email"><a onclick='goPage("mailto:info@traiv-komplekt.ru"); return false;' style="cursor: pointer" rel="nofollow">info@traiv-komplekt.ru</a></li></span>
<li><a onclick='goPage("mailto:director@traiv.ru"); return false;' style="cursor: pointer" rel="nofollow">Письмо директору</a></li>
                			<li>Адрес офиса: <a href="/contacts/moskva/"><span itemprop="postalCode">614065</span>, <span itemprop="addressLocality">Пермь</span>, <span itemprop="streetAddress">шоссе Космонавтов, д. 316 Б, офис 206</a></li></span>
</span>
                			<li>Режим работы: <span style="">Понедельник-Пятница: 9:00-17:30, Суббота-Воскресенье: Выходной</span></li>
<li><a href="/contacts/perm/">Подробнее...</a></li>
                            </div>
                		</ul>
                	</td>
                </tr>
                </tbody>
                </table style="width: 100%">
                

<div class="reg">
<span class="headercon">Все регионы
<br />
<i class="fa fa-phone"></i> 8 (800) 707-25-98</span>
</div>


<h2><i class="fa fa-credit-card"></i>Реквизиты компании «Трайв»</h2>

<p><strong>Организационно-правовая форма:</strong> Общество с ограниченной ответственностью</p>

<p><strong>Наименование: </strong>ООО «ТК МАШ»</p>

<p><strong>Юридический адрес: </strong>199178, г. Санкт-Петербург, набережная реки Смоленки, д. 14, литер А, офис 347, пом. 1-Н</p>

<p><strong>Фактический адрес: </strong>199178, г. Санкт-Петербург, набережная реки Смоленки, д. 14, литер А, офис 347, пом. 1-Н</p>

<p><strong>Склад: </strong>188692, РФ, Ленинградская обл., г. Кудрово, ул. Центральная, д. 41.</p>

<p><strong>Почтовый адрес: </strong>193168, РФ, г. Санкт-Петербург, а/я 83.</p>

<p><strong>ИНН:</strong> 7801670793</p>

<p><strong>КПП:</strong>780101001</p>

<p><strong>ОГРН:</strong> 1197847176229 (дата присвоения ОГРН: 28.08.2019 г.)</p>

<p><strong>Телефон:</strong> (812)313-22-80</p>

<p><strong>E</strong><strong>-</strong><strong>mail</strong><strong>: </strong>info@traiv-komplekt.ru</p>

<p> </p>

<p><strong>Банковские реквизиты:</strong></p>

<p>р/с 40702810894510003073 Северо-Западный филиал ПАО «РОСБАНК» г. Санкт-Петербург</p>

<p>к/с 30101810100000000778</p>

<p>БИК 044030778</p>

<p> </p>

<p>р/с 40702810455000081058 Банк СЕВЕРО-ЗАПАДНЫЙ БАНК ПАО СБЕРБАНК</p>

<p>к/с 30101810500000000653</p>

<p>БИК 044030653</p>

<p> </p>

<p><strong>ОКАТО: </strong>40263000000</p>

<p><strong>ОКТМО: </strong>40309000000</p>

<p><strong>ОКПО:</strong> 41308885</p>

<p><strong>ОКОПФ: </strong>12300</p>

<p><strong>ОКОГУ:</strong> 4210014</p>

<p><strong>ОКФС: </strong>16</p>

<p><strong>ОКВЭД: </strong>46.74</p>

<p><strong>Генеральный директор: </strong>Леваков Владимир Евгеньевич (ИНН: 773209775305), действующий на основании Устава.</p>








	</div>
</div>-->

</div>

<?php
CModule::IncludeModule('iblock');

$sectionIDs = array ('111','123','56');

$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=>18, "SECTION_ID"=>$sectionIDs);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
   // print_r($arFields['NAME'].'<br>');
}
?>

</section>


 <a href="#x" class="w-form__overlay" id="w-form-director"></a>
         <div class="w-form__popup">
             <?$APPLICATION->IncludeComponent(
	"slam:easyform", 
	"traiv_director", 
	array(
		"COMPONENT_TEMPLATE" => "traiv_director",
		"FORM_ID" => "FORM44",
		"FORM_NAME" => "Написать директору",
		"WIDTH_FORM" => "620px",
		"DISPLAY_FIELDS" => array(
			0 => "TITLE",
			1 => "EMAIL",
			2 => "PHONE",
			3 => "MESSAGE",
			4 => "CUR_URL",
			5 => "",
		),
		"REQUIRED_FIELDS" => array(
			0 => "TITLE",
			1 => "EMAIL",
			2 => "PHONE",
		),
		"FIELDS_ORDER" => "TITLE,EMAIL,PHONE,MESSAGE,CUR_URL",
		"FORM_AUTOCOMPLETE" => "Y",
		"HIDE_FIELD_NAME" => "Y",
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
		"EMAIL_TO" => "director@traiv.ru",
		"EMAIL_BCC" => "levakov@traiv.ru",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы Написать директору",
		"EMAIL_FILE" => "Y",
		"EMAIL_SEND_FROM" => "N",
		"CREATE_SEND_MAIL_SENDER" => "",
		"EVENT_MESSAGE_ID_SENDER" => array(
			0 => "121",
		),
		"EMAIL_BCC_SENDER" => "vozhdaenko@traiv.ru",
		"MAIL_SUBJECT_SENDER" => "#SITE_NAME#: Сообщение из формы обратной связи",
		"USE_IBLOCK_WRITE" => "Y",
		"CATEGORY_TITLE_TITLE" => "Ваше имя",
		"CATEGORY_TITLE_TYPE" => "text",
		"CATEGORY_TITLE_PLACEHOLDER" => "Ваше имя",
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
		"CATEGORY_PHONE_PLACEHOLDER" => "Мобильный телефон",
		"CATEGORY_PHONE_VALUE" => "",
		"CATEGORY_PHONE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_PHONE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_PHONE_INPUTMASK" => "N",
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "",
		"CATEGORY_MESSAGE_TITLE" => "Сообщение",
		"CATEGORY_MESSAGE_TYPE" => "textarea",
		"CATEGORY_MESSAGE_PLACEHOLDER" => "",
		"CATEGORY_MESSAGE_VALUE" => "Здравствуйте! Меня интересует:",
		"CATEGORY_MESSAGE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"USE_CAPTCHA" => "N",
		"USE_MODULE_VARNING" => "N",
		"USE_FORMVALIDATION_JS" => "Y",
		"HIDE_FORMVALIDATION_TEXT" => "N",
		"INCLUDE_BOOTSRAP_JS" => "Y",
		"USE_JQUERY" => "N",
		"USE_BOOTSRAP_CSS" => "Y",
		"USE_BOOTSRAP_JS" => "N",
		"CUSTOM_FORM" => "",
		"CAPTCHA_TITLE" => "",
		"USE_INPUTMASK_JS" => "Y",
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
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>