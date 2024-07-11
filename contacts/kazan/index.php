<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Контакты «Трайв» в Казани.");
$APPLICATION->SetPageProperty("title", "Контакты «Трайв» в Казани");
$APPLICATION->SetTitle("Контакты «Трайв» в Казани");
?>	<section id="content">
		<div class="container">
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
<h1><span>Контакты Трайв в Казани</span></h1>
</div>
</div>

<div itemscope itemtype="http://schema.org/Organization">
<div class="row h-100">        
           <div class="col-lg-3 col-md-3 col-sm-3 text-md-left text-center">
            <div class="cont-item bordered text-center">
    			
    			<div class="row">
					<div class="col-lg-3 col-md-3 text-center">
						<div class="cont-icon rounded-circle"><i class="fa fa-phone"></i></div>
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
        				<span class="mb-0 cont-item-title-child2">Телефон:</span>
        				
        				        				      <div style='display:block;opacity:0;width:0px;height:0px;position:relative;'>  				
<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    <span itemprop="addressLocality">Казань</span>,
    <span itemprop="streetAddress">ул. Габдуллы Тукая д. 115, к.3, оф. 502</span>
    <span itemprop="postalCode">420021</span>
</div>
<span class="mb-0 cont-item-title-child" itemprop="name">Контакты Трайв в Казани</span>
</div>
        				
            			<p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:88003339116" class="cont-item-rows-child-link"><span itemprop="telephone">8 (800) 333-91-16 доб. 183</span></a></p>
					</div>
				</div>		
    		</div>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 text-md-left text-center">
            <div class="cont-item bordered text-center">
    			
    			<div class="row">
					<div class="col-lg-3 col-md-3 text-center">
						<div class="cont-icon rounded-circle"><i class="fa fa-map-signs"></i></div>
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
        				<span class="mb-0 cont-item-title-child2">Адрес:</span>
            			<p class="mt-3 cont-item-title-child">Россия, Казань, ул. Габдуллы Тукая д. 115, к.3, оф. 502</p>
					</div>
				</div>
    					
    		</div>
        </div>
        
                           <div class="col-lg-3 col-md-3 col-sm-3 text-md-left text-center">
            <div class="cont-item bordered text-center">
    			
    			<div class="row">
					<div class="col-lg-3 col-md-3 text-center">
						<div class="cont-icon rounded-circle"><i class="fa fa-clock-o"></i></div>
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
        				<span class="mb-0 cont-item-title-child2">Время работы:</span>
            			<p class="mt-3 cont-item-title-child">Время работы офиса 10:00 - 19:30</p>
					</div>
				</div>
    					
    		</div>
        </div>
        
                                   <div class="col-lg-3 col-md-3 col-sm-3 text-md-left text-center">
            <div href="javascript:void(0);return false;" class="cont-item bordered text-center">
    			
    			<div class="row">
					<div class="col-lg-3 col-md-3 text-center">
						<div class="cont-icon rounded-circle"><i class="fa fa-envelope-o"></i></div>
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
        				<span class="mb-0 cont-item-title-child2">Почта:</span>
            			<p class="mt-3 cont-item-title-child"><a href="mailto:info@traiv-komplekt.ru">info@traiv-komplekt.ru</a></p>
					</div>
				</div>
    					
    		</div>
        </div>

        
</div>
</div>

	<div id="map_kazan" class="mt-5">
	
	</div>

</div>

</section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>