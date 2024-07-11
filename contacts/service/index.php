<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Контакты производства «Трайв» в Санкт-Петербурге.");
$APPLICATION->SetPageProperty("title", "Контакты производства «Трайв» в Санкт-Петербурге.");
$APPLICATION->SetTitle("Контакты производства «Трайв» в Санкт-Петербурге.");
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
<h1><span>Контакты производства Трайв в Санкт-Петербурге.</span></h1>
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
        				
      <div style='display:block;opacity:0;width:0px;height:0px;position:relative;overflow:hidden;'>  				
<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    <span itemprop="addressLocality">Санкт-Петербург</span>,
    <span itemprop="streetAddress">ул. Караваевская 57С</span>
    <span itemprop="postalCode">192177</span>
</div>
</div>
        				
            			<p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:88123132280" class="cont-item-rows-child-link"><span itemprop="telephone">8 (800) 333-91-16</span></a></p>
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
            			<p class="mt-3 cont-item-title-child">Россия, Санкт-Петербург​, ул. Караваевская 57С</p>
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
            			<p class="mt-3 cont-item-title-child"> 08:00 - 18:00</p>
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

	<div id="map_service" class="mt-5">
	
	</div>

</div>

</section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>