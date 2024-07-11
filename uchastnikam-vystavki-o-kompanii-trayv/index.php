<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Участникам выставки о компании \"Трайв\"");
?>	<section id="content">


<?php 
/*if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {*/
?>

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
<h1><span>«Трайв» - формула надёжного крепежа</span></h1>
</div>
</div>

<div class="row g-0 position-relative" id="service-row-image">
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
		<div class="expopage-title-back-black">
			<span class="big-title">Изготовление металлоизделий на заказ в Санкт-Петербурге</span>
			<span class="small-title">Современное производство, отраслевые решения, складские запасы стандартного крепежа и уникальных позиций, продуманная логистика.</span>

<div class="row mt-4">
<div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center text-sm-right text-lg-right text-md-right text-xl-right">
      	<div class="btn-group-blue-100">
                    <a href="/catalog/" class="btn-white-back">
                        <span>Каталог продукции</span>
                    </a>
                </div>
</div>

<div class="col-12 col-xl-6 col-lg-6 col-md-6 pt-3 pt-sm-0 pt-xl-0 pt-lg-0 pt-md-0 text-center text-sm-left text-lg-left text-md-left text-xl-left">
				<div class="btn-group-blue-100">
                    <a href="/actions/" class="btn-white-back" style="width:180px;">
                        <span>Акции</span>
                    </a>
                </div>
				</div>
</div>

		</div>



	</div>
	
</div>

<div class="row is-services mb-3 mt-5 position-relative g-0">
<div class="is-services-about-back"></div>

                            <!--service item-->
                            <div class="col-lg-3 col-sm-6 is-service-about-area">
                                <div class="is-service-about-area-item">
                                    <i class="fa fa-industry" aria-hidden="true"></i>
                                    <h4 class="title">Собственное производство в Санкт-Петербурге</h4>
                                </div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-3 col-sm-6 is-service-about-area">
                                <div class="is-service-about-area-item">
                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                    <h4 class="title">Работаем со сложными видами покрытий</h4>
                                </div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-3 col-sm-6 is-service-about-area">
                                <div class="is-service-about-area-item">
                                    <i class="fa fa-object-group" aria-hidden="true"></i>
                                    <h4 class="title">Изготавливаем любые металлические изделия по чертежам </h4>
                                </div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-3 col-sm-6 is-service-about-area">
                                <div class="is-service-about-area-item">
                                    <i class="fa fa-calendar-check-o"></i>
                                    <h4 class="title">Проверка качества на всех производственных этапах
</h4>
                                </div>
                            </div>

                        </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12">
        <h2>Отраслевые решения</h2>
        <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "maintext",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EDIT_TEMPLATE" => ""
	)
);?>
        </div>
    </div>
    
    <div class="row expopage-is-item mt-3">
    <!-- slider -->
    
    <?php 
 
        $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"industry-solutions-expopage", 
	array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "47",
		"NEWS_COUNT" => "50",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "DESCRIPTION",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => $_REQUEST["SECTION_CODE"],
		"INCLUDE_SUBSECTIONS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "Y",
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "industry-solutions",
		"STRICT_SECTION_CHECK" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"FILE_404" => ""
	),
	false
);
 
?>
    </div>
    <!-- end slider -->
    
</div>

<div class="container">
    <div class="row">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12">
        <h2>Более 100 000 товарных позиций</h2>
        <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "position",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EDIT_TEMPLATE" => ""
	)
);?>
        </div>
        
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 mt-5 mb-5">
            <div class="text-center">
            	<div class="btn-group-blue"><a href="/price-list/" class="btn-white"><i class="fa fa-list" aria-hidden="true"></i><span>Получить прайс-лист</span></a></div>
            </div>
        </div>
        
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12">
        <h2>Собственное производство</h2>
        <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "pro",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EDIT_TEMPLATE" => ""
	)
);?>
</div>

<div class="col-12 col-xl-6 col-lg-6 col-md-6">
<img src="<?=SITE_TEMPLATE_PATH?>/expopage/sklad1.jpg" class="img responsive exp-img mt-4"/>
</div>
        
        <div class="col-12 col-xl-6 col-lg-6 col-md-6 mt-5">
        <div class="row h-100">
        	
    			<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
    			<div href="#" class='quicklinks-item bordered expopage-h'>
        			<div class='quicklinks-item-content'>
    					<!-- <img src="<?=SITE_TEMPLATE_PATH?>/images/quicklinks4.jpg"/> -->
    					<div class="quicklinks-item-title-big expopage-pro-text">Токарная обработка</div>
    				</div>
        			</div>
    			</div>
    			
    			<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
    			<div href="#" class='quicklinks-item bordered expopage-h'>
        			<div class='quicklinks-item-content'>
    					<!-- <img src="<?=SITE_TEMPLATE_PATH?>/images/quicklinks4.jpg"/> -->
    					<div class="quicklinks-item-title-big expopage-pro-text">Фрезерная обработка</div>
    				</div>
        			</div>
    			</div>
    			
    			<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
    			<div href="#" class='quicklinks-item bordered expopage-h'>
        			<div class='quicklinks-item-content'>
    					<!-- <img src="<?=SITE_TEMPLATE_PATH?>/images/quicklinks4.jpg"/> -->
    					<div class="quicklinks-item-title-big expopage-pro-text">Резка</div>
    				</div>
        			</div>
    			</div>
    			
    			<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
    			<div href="#" class='quicklinks-item bordered expopage-h'>
        			<div class='quicklinks-item-content'>
    					<!-- <img src="<?=SITE_TEMPLATE_PATH?>/images/quicklinks4.jpg"/> -->
    					<div class="quicklinks-item-title-big expopage-pro-text">Сверление</div>
    				</div>
        			</div>
    			</div>
    			
    			<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
    			<div href="#" class='quicklinks-item bordered expopage-h'>
        			<div class='quicklinks-item-content'>
    					<!-- <img src="<?=SITE_TEMPLATE_PATH?>/images/quicklinks4.jpg"/> -->
    					<div class="quicklinks-item-title-big expopage-pro-text">Калибровка</div>
    				</div>
        			</div>
    			</div>
    			
    			<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
    			<div href="#" class='quicklinks-item bordered expopage-h'>
        			<div class='quicklinks-item-content'>
    					<!-- <img src="<?=SITE_TEMPLATE_PATH?>/images/quicklinks4.jpg"/> -->
    					<div class="quicklinks-item-title-big expopage-pro-text">Накатка</div>
    				</div>
        			</div>
    			</div>
    			
    			<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
    			<div href="#" class='quicklinks-item bordered expopage-h'>
        			<div class='quicklinks-item-content'>
    					<!-- <img src="<?=SITE_TEMPLATE_PATH?>/images/quicklinks4.jpg"/> -->
    					<div class="quicklinks-item-title-big expopage-pro-text">Покрытие металлоизделий</div>
    				</div>
        			</div>
    			</div>
    			
    			
			</div>
			</div>
        
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 mt-5 mb-5">
            <div class="text-center">
            	<div class="btn-group-blue"><a href="/services/" class="btn-white"><i class="fa fa-industry" aria-hidden="true"></i><span>Узнать о производстве</span></a></div>
            </div>
        </div>
        
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12">
        <h2>Доставляем по России и СНГ</h2>
        <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "delivery",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EDIT_TEMPLATE" => ""
	)
);?>
        </div>
        
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 mt-5 mb-5">
            <div class="text-center">
            	<div class="btn-group-blue"><a href="/price-list/" class="btn-white"><i class="fa fa-list" aria-hidden="true"></i><span>Получить прайс-лист</span></a></div>
            </div>
        </div>
        
    </div>
</div>

<div class="container">
<div class="row h-100">
<div class="col-12 col-xl-12 col-lg-12 col-md-12">
        <h2>Связаться с нами</h2>
        
        <?/*$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "delivery",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EDIT_TEMPLATE" => ""
	)
);*/?>
        </div>
        </div>
<div class="row h-100 mt-4">        
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
            			<p class="mt-3 cont-item-title-child">Россия, Санкт-Петербург, Кудрово, ул. Центральная, д. 41</p>
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
            			<p class="mt-3 cont-item-title-child">Время работы офиса 8:00 - 18:00</p>
            			<p class="cont-item-title-child">Время работы склада 09:00 - 21:00</p>
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

<div class="container">
    <div class="row">
    
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
        <div class="row">
            <div class="col-12 col-xl-10 col-lg-12 col-md-12">
            	<div class="h1title mb-0"><span>Новости с нашего производства</span></div>
            </div>
            
            <div class="col-12 col-xl-12 col-lg-12 col-md-12">

            	<?$APPLICATION->IncludeComponent(
            	    "bitrix:news.list",
            	    "expopage_news_2021",
            	    Array(
            	        "ACTIVE_DATE_FORMAT" => "d.m.Y",
            	        "ADD_SECTIONS_CHAIN" => "N",
            	        "AJAX_MODE" => "N",
            	        "AJAX_OPTION_ADDITIONAL" => "",
            	        "AJAX_OPTION_HISTORY" => "N",
            	        "AJAX_OPTION_JUMP" => "N",
            	        "AJAX_OPTION_STYLE" => "N",
            	        "CACHE_FILTER" => "N",
            	        "CACHE_GROUPS" => "Y",
            	        "CACHE_TIME" => "36000000",
            	        "CACHE_TYPE" => "A",
            	        "CHECK_DATES" => "Y",
            	        "COMPONENT_TEMPLATE" => ".default",
            	        "DETAIL_URL" => "",
            	        "DISPLAY_BOTTOM_PAGER" => "N",
            	        "DISPLAY_DATE" => "Y",
            	        "DISPLAY_NAME" => "Y",
            	        "DISPLAY_PICTURE" => "Y",
            	        "DISPLAY_PREVIEW_TEXT" => "Y",
            	        "DISPLAY_TOP_PAGER" => "N",
            	        "FIELD_CODE" => array(0=>"",1=>"",),
            	        "FILTER_NAME" => "",
            	        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            	        "IBLOCK_ID" => "6",
            	        "IBLOCK_TYPE" => "content",
            	        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            	        "INCLUDE_SUBSECTIONS" => "Y",
            	        "MESSAGE_404" => "",
            	        "NEWS_COUNT" => "3",
            	        "PAGER_BASE_LINK_ENABLE" => "N",
            	        "PAGER_DESC_NUMBERING" => "N",
            	        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            	        "PAGER_SHOW_ALL" => "N",
            	        "PAGER_SHOW_ALWAYS" => "N",
            	        "PAGER_TEMPLATE" => ".default",
            	        "PAGER_TITLE" => "Новости",
            	        "PARENT_SECTION" => "",
            	        "PARENT_SECTION_CODE" => "",
            	        "PREVIEW_TRUNCATE_LEN" => "",
            	        "PROPERTY_CODE" => array(0=>"",1=>"",),
            	        "SET_BROWSER_TITLE" => "N",
            	        "SET_LAST_MODIFIED" => "N",
            	        "SET_META_DESCRIPTION" => "N",
            	        "SET_META_KEYWORDS" => "N",
            	        "SET_STATUS_404" => "N",
            	        "SET_TITLE" => "N",
            	        "SHOW_404" => "N",
            	        "SORT_BY1" => "SORT",
            	        "SORT_BY2" => "ACTIVE_FROM",
            	        "SORT_ORDER1" => "ASC",
            	        "SORT_ORDER2" => "DESC"
            	    )
            	    );
            	?>
            </div>
            
        </div>
    </div>
    
  
     

 

    
    </div>
</div>

<?php 
   // }
//}
?>

		<div class="container d-none">



<div class="row">
<div class="col-12 col-xl-12 col-lg-12 col-md-12">
<h1><span>Участникам выставки о компании «Трайв»</span></h1>
</div>
</div>



<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EDIT_TEMPLATE" => ""
	)
);?>
</div>

</section>
<?
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/expopage.css");?>
<link href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>