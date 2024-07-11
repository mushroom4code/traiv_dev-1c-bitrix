<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Отраслевые решения");
$APPLICATION->SetPageProperty("title", "Отраслевые решения");
$APPLICATION->SetTitle("Отраслевые решения");
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
    	<h1 style="margin:0px;"><span><?$APPLICATION->ShowTitle(false)?></span></h1>
    </div>
</div>	


<?php 
/*if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '4677' || $USER->GetID() == '2743' || $USER->GetID() == '5108') {*/
 
        if($APPLICATION->GetCurPage() == "/industry-solutions/svetovoe-oborudovanie/") {
            /*echo "LF";
        } else {
            echo "Нет";
        }*/
        ?>
 </div>
<!-- <div class="container">
<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-right">
    	<div class="btn-group-blue mt-3 mb-3 pl-2"><a href="/upload/iblock/453/56qy5wusjb6kl974a3rhfw99jz3ocmrz/Световое оборудование.pdf" target="_blank" class="btn-404"><span><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Световое оборудование.pdf</span></a></div>
    </div>
</div>
</div>-->

<div class="is-landing-big-image mt-5">

<div class="container">
<div class="row g-0">
    <div class="col-12 col-xl-6 col-lg-6 col-md-6 text-right">
    	
    </div>
    
    <div class="col-12 col-xl-6 col-lg-6 col-md-6 text-left position-relative">
    	<div class="is-title">
    	<div>Крепеж для производства светового оборудования</div>
    	<div class="pt-3">
    	<!-- 
    	<div class="btn-group-blue w-100"><a href="#w-form" class="btn-white w-100"><i class="fa fa-envelope" aria-hidden="true"></i><span>Отправить запрос</span></a></div>
    	-->
    	
    	<div class="shadow-cont-filex">
         <? $APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"is2", 
	array(
		"COMPONENT_TEMPLATE" => "is2",
		"ELEMENT_ID" => $arResult["ID"],
		"WEB_FORM_ID" => "11",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "Y",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"LIST_URL" => "/ajax/forms/is_saved.php",
		"EDIT_URL" => "/ajax/forms/is_saved.php",
		"SUCCESS_URL" => "/ajax/forms/is_saved.php",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>
                                
                                </div>
    	
    	</div>
    	</div>
    	<div class="is-title-area"></div>
    </div>
    
</div>
</div>
</div>

<div class="container">
<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-right pt-5 pt-sm-0">
    	<div class="shadow-cont-filex" style="top:-40px;padding-top:40px;padding-bottom:40px;">
    	<?php 
    	$APPLICATION->IncludeComponent(
    	    "DM:recomended-items",
    	    "is",
    	    array(
    	        "COMPONENT_TEMPLATE" => ".default",
    	        "IBLOCK_ID" => "18",
    	        "PRESENT_ID" => "206298",
    	        "ENGINE" => "Y",
    	    ),
    	    false,
    	    array(
    	    ),
    	    $component
    	    );
    	?>
    </div>	
    </div>
</div>
</div>

<div class="container">

<div class="row is-services mb-20 position-relative g-0">



                            <div class="col-md-12 text-center is-service-item-area">
                                <div class="sub-heading">
                                    <h3>Наши преимущества</h3>
                                </div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-4 col-sm-6 is-service-item-area">
                                <div class="is-service-item">
                                    <i class="fa fa-ship" aria-hidden="true"></i>
                                    <h4 class="title">Еженедельные контейнерные поставки напрямую от производителей</h4>
                                    <p>Еженедельные контейнерные поставки напрямую от производителей</p>
                                </div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-4 col-sm-6 is-service-item-area">
                                <div class="is-service-item">
                                    <i class="fa fa-certificate"></i>
                                    <h4 class="title">Сертификаты на продукт</h4>
                                    <p>Ежедневные контейнерные поставки.</p>
                                </div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-4 col-sm-6 is-service-item-area">
                                <div class="is-service-item">
                                    <i class="fa fa-calendar-check-o"></i>
                                    <h4 class="title">Наличие ходовых позиций на складе в Москве и СПб</h4>
                                    <p>Ежедневные контейнерные поставки.</p>
                                </div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-4 col-sm-6 is-service-item-area">
                                <div class="is-service-item">
                                    <i class="fa fa-star"></i>
                                    <h4 class="title">3 склада: Санкт-Петербург, Москва, Шанхай</h4>
                                    <p>3 склада: Санкт-Петербург, Москва, Шанхай</p>
                                </div>
                            </div>
                            
                             <!--service item-->
                            <div class="col-lg-4 col-sm-6 is-service-item-area">
                                <div class="is-service-item">
                                    <i class="fa fa-industry"></i>
                                    <h4 class="title">Производство изделий по чертежам</h4>
                                    <p>Ежедневные контейнерные поставки.</p>
                                </div>
                            </div>
                            
                            
                             <!--service item-->
                            <div class="col-lg-4 col-sm-6 is-service-item-area">
                                <div class="is-service-item">
                                    <i class="fa fa-thumbs-up"></i>
                                    <h4 class="title">Проверка готовых изделий ОТК</h4>
                                    <p>Ежедневные контейнерные поставки.</p>
                                </div>
                            </div>
<div class="is-services-back"></div>
                        </div>
                        </div>
                        
                        <div class="container">
                        <div class="row mt-5">
                            <div class="col-12 col-xl-4 col-lg-4 col-md-4 text-left">
                                <div class="shadow-cont-filex">
         <? $APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"is", 
	array(
		"COMPONENT_TEMPLATE" => "is",
		"ELEMENT_ID" => $arResult["ID"],
		"WEB_FORM_ID" => "11",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "Y",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"LIST_URL" => "/ajax/forms/is_saved.php",
		"EDIT_URL" => "/ajax/forms/is_saved.php",
		"SUCCESS_URL" => "/ajax/forms/is_saved.php",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>
                                
                                </div>
                            </div>
                            
			<div class="col-12 col-xl-8 col-lg-8 col-md-8 text-left pt-5 pt-xl-0 pt-lg-0">         
			
			<h2 style="padding:10px 10px;margin:10px 10px;">Решение задач на производстве</h2>
			
                <ul class='is-list'>
                  <li>
                    <div class="is-list-block"><i class="fa fa-check-circle-o"></i> <span>Соединение делатей с высокой точностью</span></div>
                  </li>
                  <li>
                    <div class="is-list-block"><i class="fa fa-check-circle-o"></i> <span>Облегчение технологического процесса, связанного с созданием и ремонтом оборудования</span></div>
                  </li>
                  <li>
                    <div class="is-list-block"><i class="fa fa-check-circle-o"></i> <span>Выполнение прочных соединений</span></div>
                  </li>
                  <li>
                    <div class="is-list-block"><i class="fa fa-check-circle-o"></i> <span>Обеспечение устойчивости осветительного и иного оборудования к негативным факторам</span></div>
                  </li>
                  <li>
                    <div class="is-list-block"><i class="fa fa-check-circle-o"></i> <span>Повышение устойчивости к механической нагрузке</span></div>
                  </li>
                  <li>
                    <div class="is-list-block"><i class="fa fa-check-circle-o"></i> <span>Снижение веса оборудования</span></div>
                  </li>
                  <li>
                    <div class="is-list-block"><i class="fa fa-check-circle-o"></i> <span>Улучшение токопроводности соединительных элементов</span></div>
                  </li>
                  <li>
                    <div class="is-list-block"><i class="fa fa-check-circle-o"></i> <span>Изоляция токоведущих частей</span></div>
                  </li>
                </ul>
            </div>
                            
                        </div>
                           </div>
                           
<!-- склад -->
<div class="container">
    <div class="row g-0 mt-5 position-relative" id="is-landing-row-image">
       <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
       		<div class="is-title-back-black"><span>Поставки в СНГ</span></div>
       </div>
    </div>
    
    
    <div class="row g-0 mt-3 position-relative">
       
       <div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center position-relative" id="is-landing-sklad-image1">
       		<div class="is-title-back-black"><span>Склад СПб<p class="is-title-back-black-addr">Кудрово, Центральная ул., д.41</p></span></div>
       </div>
       
       <div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center position-relative pl-2" id="is-landing-sklad-image2">
       		<div class="is-title-back-black"><span>Склад МСК<p class="is-title-back-black-addr">Рязанский проспект, 2с49, БЦ "Карачарово", офис 203</p></span></div>
       </div>
       
    </div>
    
</div>
<!-- склад -->

<!-- склад -->
<div class="container">
    <div class="row g-0 mt-5 position-relative">
       <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
       		<div class="pt-3"><div class="btn-group-blue"><a href="#w-form" class="btn-white"><i class="fa fa-envelope" aria-hidden="true"></i><span>Отправить запрос</span></a></div></div>
       </div>
    </div>
    
</div>
<!-- склад -->
                           

</div>
  
 <div class="container">
 <?       
        }
    /*}
}*/
?>

<div class="row">

<?php 

$APPLICATION->IncludeComponent("bitrix:news.detail","industry-solutions",Array(
    "DISPLAY_DATE" => "Y",
    "DISPLAY_NAME" => "N",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "Y",
    "USE_SHARE" => "N",
    "SHARE_HIDE" => "N",
    "SHARE_TEMPLATE" => "",
    "SHARE_HANDLERS" => array("delicious"),
    "SHARE_SHORTEN_URL_LOGIN" => "",
    "SHARE_SHORTEN_URL_KEY" => "",
    "AJAX_MODE" => "Y",
    "IBLOCK_TYPE" => "industry-solutions",
    "IBLOCK_ID" => "47",
    "ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
    "ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
    "CHECK_DATES" => "Y",
    "FIELD_CODE" => Array("ID"),
    "PROPERTY_CODE" => Array("PDF_FILE"),
    "IBLOCK_URL" => "",
    "DETAIL_URL" => "",
    "SET_TITLE" => "Y",
    "SET_CANONICAL_URL" => "Y",
    "SET_BROWSER_TITLE" => "Y",
    "BROWSER_TITLE" => "-",
    "SET_META_KEYWORDS" => "Y",
    "META_KEYWORDS" => "-",
    "SET_META_DESCRIPTION" => "Y",
    "META_DESCRIPTION" => "-",
    "SET_STATUS_404" => "Y",
    "SET_LAST_MODIFIED" => "Y",
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    "ADD_SECTIONS_CHAIN" => "N",
    "ADD_ELEMENT_CHAIN" => "Y",
    "ACTIVE_DATE_FORMAT" => "d.m.Y",
    "USE_PERMISSIONS" => "N",
    "GROUP_PERMISSIONS" => Array("1"),
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
    "CACHE_GROUPS" => "N",
    "DISPLAY_TOP_PAGER" => "Y",
    "DISPLAY_BOTTOM_PAGER" => "Y",
    "PAGER_TITLE" => "Страница",
    "PAGER_TEMPLATE" => "",
    "PAGER_SHOW_ALL" => "Y",
    "PAGER_BASE_LINK_ENABLE" => "N",
    "SHOW_404" => "Y",
    "MESSAGE_404" => "",
    "STRICT_SECTION_CHECK" => "Y",
    "PAGER_BASE_LINK" => "",
    "PAGER_PARAMS_NAME" => "arrPager",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "AJAX_OPTION_HISTORY" => "N"
)
    );?>

    </div>


		</div>
	</section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>