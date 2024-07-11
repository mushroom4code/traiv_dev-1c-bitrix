<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Контакты «Трайв» в Краснодаре.");
$APPLICATION->SetPageProperty("title", "Контакты «Трайв» в Краснодаре");
$APPLICATION->SetTitle("Контакты «Трайв» в Краснодаре");
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
<h1><span>Контакты Трайв в Краснодаре</span></h1>
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
    <span itemprop="addressLocality">Краснодар</span>,
    <span itemprop="streetAddress">ул. Московская д.123, оф. 207</span>
    <span itemprop="postalCode">350024</span>
</div>
<span class="mb-0 cont-item-title-child" itemprop="name">Контакты Трайв в Краснодаре</span>
</div>
        				
            			<p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:88003339116" class="cont-item-rows-child-link"><span itemprop="telephone">8 (800) 333-91-16 доб. 189</span></a></p>
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
            			<p class="mt-3 cont-item-title-child">Россия, Краснодар, ул. Московская д.123, оф. 207</p>
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
            			<p class="mt-3 cont-item-title-child">Время работы офиса 08:00 - 17:30</p>
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

	<div id="map_krasnodar" class="mt-5">
	
	</div>
</div>

</section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>