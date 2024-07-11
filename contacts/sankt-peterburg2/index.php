<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Офис «Трайв-Комплект» в Санкт-Петербурге");
$APPLICATION->SetTitle("Офис «Трайв-Комплект» в Санкт-Петербурге");
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
    <h1><span>Офис Трайв в Санкт-Петербурге</span></h1>
    </div>
</div>

<div>
<div class="row h-100">        
           <div class="col-lg-3 col-md-3 col-sm-3 text-md-left text-center">
            <div class="cont-item bordered text-center">
    			
    			<div class="row">
					<div class="col-lg-3 col-md-3 text-center">
						<div class="cont-icon rounded-circle"><i class="fa fa-phone"></i></div>
					</div>
					<div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
        				<span class="mb-0 cont-item-title-child2">Телефон:</span>
        				
            			<p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:88123132280" class="cont-item-rows-child-link"><span>8 (812) 313-22-80</span></a></p>
            			<!-- <p class="mt-1 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:+79219317932" class="cont-item-rows-child-link"><span>+7 (921) 931-79-32</span></a></p> -->
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
            			<p class="mt-3 cont-item-title-child">Россия, Санкт-Петербург, набережная реки Смоленки, д. 14</p>
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

	<div id="map_spb2" class="mt-5">
	
	</div>

</div>
</section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>