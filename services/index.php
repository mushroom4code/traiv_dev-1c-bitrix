<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Услуги компании «Трайв»: производство машиностроительного и строительного крепежа, изделий из специальных сплавов и стали, покраска изделий из металла, гальваника и антикоррозийная обработка.");
$APPLICATION->SetTitle("Услуги компании");

?><section id="content">
	<div class="container">
		 <?
        /*$FirstUrl = 'https://traiv-komplekt.ru/services/proizvodstvo-metizov/';*/
        /*$APPLICATION->AddChainItem('Производство и изготовление', "/services/proizvodstvo-metizov/");*/?> 
        
        
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
    	<h1><span>Производство</span></h1>
    </div>
</div>

<?php 
/*if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {*/

if($APPLICATION->GetCurPage() !== "/services/") {
    $class_provo_left = "col-12 col-xl-4 col-lg-4 col-md-4";
    $class_provo_right = "col-12 col-xl-8 col-lg-8 col-md-8";
} else {
    $class_provo_left = "d-none";
    $class_provo_right = "col-12 col-xl-12 col-lg-12 col-md-12";
}

        ?>
<div class="row g-0">
<div class="<?php echo $class_provo_left;?>">
<?php
if($APPLICATION->GetCurPage() !== "/services/") {
        $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"sections-elements", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "provo",
		"COMPONENT_TEMPLATE" => "sections-elements",
		"DELAY" => "N",
		"MAX_LEVEL" => "3",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_THEME" => "site",
		"ROOT_MENU_TYPE" => "provo",
		"USE_EXT" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);
}
?>
</div>

<div class="<?php echo $class_provo_right;?>">

<!-- blocks -->
            <div class="row services-list">

        
	<div class="col-12 col-xl-4 col-lg-4 col-md-4 posts-i">
		<a class="posts-i-img" href="/services/proizvodstvo-metizov/"><span style="background: url(/img/gaiki-po-chertezham.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/services/proizvodstvo-metizov/">Производство крепежа</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        <p>
                        С 2010 года запущено новое направление деятельности компании «Трайв-Комплект» — производство машиностроительного и строительного крепежа.
                        </p>
                        <div class="btn-group-blue mt-3">
                        	<a href="/services/proizvodstvo-metizov/" class="btn-blue">
                            	<span>Подробнее</span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>
	
		<div class="col-12 col-xl-4 col-lg-4 col-md-4 posts-i">
		<a class="posts-i-img" href="/services/proizvodstvo-izdelij-iz-specstali/"><span style="background: url(/img/service_spec1.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/services/proizvodstvo-metizov/works/">Наши<br> работы</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        <p>
                        Группа компаний Трайв успешно реализовала многие производственные проекты. Работы выполнены на высокоточном оборудовании и проверены отделом технического контроля.
                        </p>
                        <div class="btn-group-blue mt-3">
                        	<a href="/services/proizvodstvo-metizov/works/" class="btn-blue">
                            	<span>Подробнее</span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>
	
				<!-- <div class="col-12 col-xl-4 col-lg-4 col-md-4 posts-i">
		<a class="posts-i-img" href="/services/pokraska-izdelij-iz-metalla/"><span style="background: url(/img/services_okr11.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/services/pokraska-izdelij-iz-metalla/">Покраска изделий из металла</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        <p>
                        Краски против коррозии используются для металлических изделий любого вида, это могут быть: метизы, металлические заборы и ворота, окна, лестницы, и другое.
                        </p>
                        <div class="btn-group-blue mt-3">
                        	<a href="/services/pokraska-izdelij-iz-metalla/" class="btn-blue">
                            	<span>Подробнее</span>
                            </a>
                        </div>
                    </div>
                </div>

	</div> -->
	
			<div class="col-12 col-xl-4 col-lg-4 col-md-4 posts-i">
		<a class="posts-i-img" href="/services/snjatie-pokrytija/"><span style="background: url(/img/sn_pokr1.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/services/coatings/">Нанесение<br> покрытий</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        <p>
                        В настоящее время производителями практически весь выпускаемый крепеж подвергается антикоррозийной обработке. Она может заключаться в том, что на металлический элемент наносится тонкий слой цинка или лакокрасочное покрытие.
                        </p>
                        <div class="btn-group-blue mt-3">
                        	<a href="/services/coatings/" class="btn-blue">
                            	<span>Подробнее</span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>
	
					<div class="col-12 col-xl-4 col-lg-4 col-md-4 posts-i">
		<a class="posts-i-img" href="/services/nakatka-rezby/"><span style="background: url(/images/articles/nakatka_rezby.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/services/nakatka-rezby/">Накатка<br> резьбы</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        <div class="btn-group-blue mt-3">
                        	<a href="/services/nakatka-rezby/" class="btn-blue">
                            	<span>Подробнее</span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>
	
						<div class="col-12 col-xl-4 col-lg-4 col-md-4 posts-i">
		<a class="posts-i-img" href="/services/kalibrovka-rezby/"><span style="background: url(/images/articles/kalibrovka_rezby.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/services/kalibrovka-rezby/">Калибровка<br> резьбы</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        <div class="btn-group-blue mt-3">
                        	<a href="/services/kalibrovka-rezby/" class="btn-blue">
                            	<span>Подробнее</span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>
	
							<div class="col-12 col-xl-4 col-lg-4 col-md-4 posts-i">
		<a class="posts-i-img" href="/services/paketnoe-pilenie-shpilek/"><span style="background: url(/images/articles/paketnoe_pilenie_shpilek-2.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/services/paketnoe-pilenie-shpilek/">Пакетное пиление<br> шпилек</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        <div class="btn-group-blue mt-3">
                        	<a href="/services/paketnoe-pilenie-shpilek/" class="btn-blue">
                            	<span>Подробнее</span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>
	
								<div class="col-12 col-xl-4 col-lg-4 col-md-4 posts-i">
		<a class="posts-i-img" href="/services/termicheskaya-obrabotka-obyemnaya-krepezha-i-metalla/"><span style="background: url(/images/articles/zakalka_metizov.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/services/termicheskaya-obrabotka-obyemnaya-krepezha-i-metalla/">Термическая <br> обработка </a></h3>
                    <div class="posts-i-ttl-note text-center">
                        <div class="btn-group-blue mt-3">
                        	<a href="/services/termicheskaya-obrabotka-obyemnaya-krepezha-i-metalla/" class="btn-blue">
                            	<span>Подробнее</span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>
	
				<div class="col-12 col-xl-4 col-lg-4 col-md-4 posts-i">
		<a class="posts-i-img" href="/services/express-dostavka/"><span style="background: url(/img/dostavka_iz_kitaya.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/services/express-dostavka/">Экспресс<br> доставка</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        <p>
                        Организуем срочную грузоперевозку из Китая в Россию. 
                        </p>
                        <div class="btn-group-blue mt-3">
                        	<a href="/services/express-dostavka/" class="btn-blue">
                            	<span>Подробнее</span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>
	
				<!-- <div class="col-12 col-xl-4 col-lg-4 col-md-4 posts-i">
		<a class="posts-i-img" href="/services/galvanika/"><span style="background: url(/img/services_galv.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/services/galvanika/">Гальваника</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        <p>
                        Гальваника — защиты материалов. Эта методика позволяет наносить на один вид металла, подверженный коррозии, тонкий слой другого металла, устойчивого к окислению.
                        </p>
                        <div class="btn-group-blue mt-3">
                        	<a href="/services/galvanika/" class="btn-blue">
                            	<span>Подробнее</span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>-->



    </div>
<!-- end blocks -->

</div>

</div>
<?php 
  /*  }
}*/
?>

        <?/*$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"traiv.production",
	Array(
		"COMPONENT_TEMPLATE" => "traiv.production.detail",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PATH" => "/",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);*/?>
		<?if (
		        CSite::InDir('/services/proizvodstvo-metizov/') ||
            CSite::InDir('/services/snjatie-pokrytija/') ||
            CSite::InDir('/services/pokraska-izdelij-iz-metalla/') ||
            CSite::InDir('/services/proizvodstvo-izdelij-iz-specstali/') ||
            CSite::InDir('/services/galvanika/')
        ){
                		$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"catalog_vertical",
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "catalog_left_menu",
		"COMPONENT_TEMPLATE" => "catalog_vertical",
		"DELAY" => "N",
		"MAX_LEVEL" => "4",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "N",
		"ROOT_MENU_TYPE" => "news_left_menu",
		"USE_EXT" => "Y",
		"MENU_THEME" => "site"
	),
	false
);
} else {
    
} ?>
  <main class="spaced-left">

		<?if (CSite::InDir('/services/index.php')) {

		    ?>
		    
            <div class="row services-list d-none">

        
	<div class="col-12 col-xl-6 col-lg-6 col-md-6 posts-i">
		<a class="posts-i-img" href="/services/proizvodstvo-metizov/"><span style="background: url(/img/gaiki-po-chertezham.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/services/proizvodstvo-metizov/works/">Производство крепежа</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        <p>
                        С 2010 года запущено новое направление деятельности компании «Трайв-Комплект» — производство машиностроительного и строительного крепежа.
                        </p>
                        <div class="btn-group-blue mt-3">
                        	<a href="/services/proizvodstvo-metizov/" class="btn-blue">
                            	<span>Подробнее</span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>
	
		<div class="col-12 col-xl-6 col-lg-6 col-md-6 posts-i">
		<a class="posts-i-img" href="/services/proizvodstvo-izdelij-iz-specstali/"><span style="background: url(/img/service_spec1.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/services/proizvodstvo-izdelij-iz-specstali/">Производство изделий из спецстали</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        <p>
                        Компания Трайв-Комплект поставляет специальный крепеж для нефтяной и газовой промышленности, изготовленного из специальных сплавов и стали. Широкий спектр болтов, винтов, гаек, шпилек, и многого другого на наших ближайших складах в Европе!
                        </p>
                        <div class="btn-group-blue mt-3">
                        	<a href="/services/proizvodstvo-izdelij-iz-specstali/" class="btn-blue">
                            	<span>Подробнее</span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>
	
				<div class="col-12 col-xl-6 col-lg-6 col-md-6 posts-i">
		<a class="posts-i-img" href="/services/pokraska-izdelij-iz-metalla/"><span style="background: url(/img/services_okr11.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/services/pokraska-izdelij-iz-metalla/">Покраска изделий из металла</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        <p>
                        Краски против коррозии используются для металлических изделий любого вида, это могут быть: метизы, металлические заборы и ворота, окна, лестницы, и другое.
                        </p>
                        <div class="btn-group-blue mt-3">
                        	<a href="/services/pokraska-izdelij-iz-metalla/" class="btn-blue">
                            	<span>Подробнее</span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>
	
			<div class="col-12 col-xl-6 col-lg-6 col-md-6 posts-i">
		<a class="posts-i-img" href="/services/snjatie-pokrytija/"><span style="background: url(/img/sn_pokr1.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/services/snjatie-pokrytija/">Снятие покрытия</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        <p>
                        В настоящее время производителями практически весь выпускаемый крепеж подвергается антикоррозийной обработке. Она может заключаться в том, что на металлический элемент наносится тонкий слой цинка или лакокрасочное покрытие.
                        </p>
                        <div class="btn-group-blue mt-3">
                        	<a href="/services/snjatie-pokrytija/" class="btn-blue">
                            	<span>Подробнее</span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>
	
				<div class="col-12 col-xl-6 col-lg-6 col-md-6 posts-i">
		<a class="posts-i-img" href="/services/galvanika/"><span style="background: url(/img/services_galv.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/services/galvanika/">Гальваника</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        <p>
                        Гальваника — защиты материалов. Эта методика позволяет наносить на один вид металла, подверженный коррозии, тонкий слой другого металла, устойчивого к окислению.
                        </p>
                        <div class="btn-group-blue mt-3">
                        	<a href="/services/galvanika/" class="btn-blue">
                            	<span>Подробнее</span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>



    </div>

<?}?>


            <?/*

            $APPLICATION->IncludeComponent(
	"bitrix:news", 
	"services", 
	array(
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_NOTES" => "",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "services",
		"DETAIL_ACTIVE_DATE_FORMAT" => "",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_TEXT",
			3 => "DETAIL_PICTURE",
			4 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "25",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_TEXT",
			3 => "DETAIL_PICTURE",
			4 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "10",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "traiv",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_FOLDER" => "/services/",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);
        }*/?>

            <?/*$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "news-slider-2020",
                array(
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
                    "CACHE_TYPE" => "N",
                    "CHECK_DATES" => "Y",
                    "COMPONENT_TEMPLATE" => "news-slider-2020",
                    "DETAIL_URL" => "/services/proizvodstvo-metizov/works/#ELEMENT_CODE#",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "42",
                    "IBLOCK_TYPE" => "content",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "12",
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
                    "PROPERTY_CODE" => array(
                        0 => "",
                        1 => "DATA_PROIZVODSTVA",
                        2 => "",
                    ),
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
                    "SORT_ORDER2" => "DESC",
                    "STRICT_SECTION_CHECK" => "N"
                ),
                false
            );*/?>


	</div>
</section>
    <script>
        $(document).ready(function() {
            $(".categories").removeClass('u-none');
        });
    </script><? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>