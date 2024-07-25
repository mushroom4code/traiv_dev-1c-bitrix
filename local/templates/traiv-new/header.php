<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
$pos = strpos($_SERVER['REQUEST_URI'], '/bitrix/');
if ($pos === false) {
    $parts_url = explode("?", $_SERVER['REQUEST_URI']);
    $parts_url_0= $parts_url[0];
    $parts_url_1= $parts_url[1];
    
    if ( $parts_url_0 != strtolower( $parts_url_0) ) {
        if(empty($parts_url_1)){
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: https://'.$_SERVER['HTTP_HOST'].strtolower($parts_url_0), true, 301);
        }else{
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: https://'.$_SERVER['HTTP_HOST'], true, 301);
        }
        exit();
    }
}

use Bitrix\Main\Page\Asset;
use Bitrix\Main\UI\Extension;
$asset = Asset::getInstance();

?><!DOCTYPE html><!--[if lt ie 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]--><!--[if ie 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]--><!--[if ie 8]>
<html class="no-js lt-ie9"> <![endif]--><!--[if gt ie 8]><!-->
<html class="no-js" lang="ru">
<!--<![endif]-->
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <?
    $APPLICATION->ShowMeta("description", false, true);
    CJSCore::Init(array("jquery"));
    Extension::load('ui.bootstrap4');
    ?>
<title><? $APPLICATION->ShowTitle() ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=LANG_CHARSET?>" />
<?$APPLICATION->ShowMeta("robots")?>
<?$APPLICATION->ShowCSS()?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/js/fancybox/jquery.fancybox.min.css");?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/font-awesome.min.css");?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery.bxslider.css");?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/js/fancybox/jquery.fancybox.min.css");?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/flexslider.css");?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/item.css");?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/simplebar.css");?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/rateit.css");?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/slick.css");?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery.mb.YTPlayer.min.css");?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/custom.css");?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/responsive.css");?>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">

<?php 
if ($USER->GetID() == '3092' || $USER->GetID() == '2743' || $USER->GetID() == '4677' || $USER->GetID() == '552' || $USER->GetID() == '1788') {
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery.kviz.css");
}

    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/magnific-popup.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/newstyle.css");
    
    /*if ($USER->GetID() == '3092' || $USER->GetID() == '7174') {*/
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/apicalc.css");
    //}
    
    ?>

<?$APPLICATION->ShowHeadStrings()?>

<meta name="google-site-verification" content="yqm6C7HDOWdF3AhUjsB0DFD87YoFogMp-yd5bXKMJZU" />
<meta name="yandex-verification" content="89e4bea17821993d" />
<meta name="yandex-verification" content="6429b000fbcb9c5c" />

</head>
<body class="theme-default">
<div id="panel"><?if ($USER->isAdmin() || $USER->GetID() == '3866') $APPLICATION->ShowPanel();?></div>

<?

if ( $USER->IsAuthorized() )
{
    if (($USER->GetID() == '3092' || $USER->GetID() == '7174') && ($APPLICATION->GetCurPage(false) !== '/personal/decode/' && $APPLICATION->GetCurPage(false) !== '/calculator/')) {
     ?>
     
     <div class="apicalc-area">
     
     <div class="apicalc-area-button">
     	<a href="#" class="apicalc-area-link">
     		<i class="fa fa-calculator" aria-hidden="true"></i>
     	</a>
     </div>
     
     <form method="post" id="decodeForm">
     	<div class="container">
            	<div class="row position-relative">
            	
            	<!-- <div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center text-sm-left">
            		<div class="apicalc-form-input">
            			<input type="hidden" name="metiz" id="metizIdcurrent"/>
            			<label for="exampleFormControlInput1" class="form-label">Тип метиза:</label>
            			<select class="form-select" id="metizList">
            			<option value="0">Начать</option>
            			</select>
            		</div>
            	</div>-->
            	<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center text-sm-left">
            		<div class="apicalc-form-input">
            			<input type="text" class="form-control" id="searchStandartcalc" placeholder="Поиск по стандарту"/>
            		</div>
            		<div class="apicalc-form-input">
            			<input type="hidden" name="standartId" id="standartIdcurrent"/>
            			<label for="exampleFormControlInput1" class="form-label">Стандарт:</label>
            			<select class="form-select" id="standartList" size="5">
            			<!-- <option value="0">Начать</option>-->
            			</select>
            		</div>
            	</div>
            	<div class="col-12 col-xl-4 col-lg-4 col-md-4 text-center text-sm-left">
            	<div class="apicalc-form-input">
            			<input type="hidden" name="diametrId" id="diametrIdcurrent"/>
            			<label for="exampleFormControlInput1" class="form-label">Диаметр:</label>
            			<select class="form-select" id="diametrList" disabled="disabled">
            			<option value="0"></option>
            			</select>
            		</div>
            	</div>
            	
            	<div class="col-12 col-xl-4 col-lg-4 col-md-4 text-center text-sm-left">
            	<div class="apicalc-form-input">
            			<input type="hidden" name="dlinaId" id="dlinaIdcurrent"/>
            			<label for="exampleFormControlInput1" class="form-label">Длина:</label>
            			<select class="form-select" id="dlinaList" disabled="disabled">
            			<option value="0"></option>
            			</select>
            		</div>
            	</div>
            	
            	<div class="col-12 col-xl-4 col-lg-4 col-md-4 text-center text-sm-left">
            	<div class="apicalc-form-input">
            			<input type="hidden" name="materialId" id="materialIdcurrent"/>
            			<label for="exampleFormControlInput1" class="form-label">Материал:</label>
            			<select class="form-select" id="materialList" disabled="disabled">
            			<option value="0"></option>
            			</select>
            		</div>
            	</div>
            	
            	
            	</div>
            	
            	<div class="row position-relative">
                	<div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center text-sm-left">
                		<div class="apicalc-form-input">
                		  	<label for="exampleFormControlInput1" class="form-label">Количество (шт.):</label>
  							<input type="text" class="form-control" id="calculate-sht" value="1000" autocomplete="off" disabled="disabled">
						</div>
                	</div>	
                	
                	<div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center text-sm-left">
                		<div class="apicalc-form-input">
                		  	<label for="exampleFormControlInput2" class="form-label">Вес (кг.):</label>
  							<input type="text" class="form-control" id="calculate-weight" value="" autocomplete="off" disabled="disabled">
						</div>
                	</div>	
            	</div>
            	
     </div>
     </form>
     <input type="hidden" id="resultval"/>
     </div>
     <?php    
    }
}

/*if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {*/
        require_once $_SERVER["DOCUMENT_ROOT"] .'/local/php_interface/include/Mobile_Detect.php';
        $detect = new Mobile_Detect;
        $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
        
        if ($deviceType == 'computer'){

            ?>
        <section id="header-new">
        <div id="top-header">
            <div class="container">
            	<div class="row position-relative">
            	
            	<div class="col-6 col-xl-1 col-lg-1 col-md-1 text-center text-sm-left">
            	
            	        <div class="logotype-tpp" alt="«Трайв» - член союза СПб ТПП РФ"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo-tpp.png" class="logotpp"/></div>
            		<div class="newloc d-none">
            			<a href="#" class="newloc-link"><i class="fa fa-map-marker"></i> <span>Россия</span></a>
            		</div>
            	</div>
            	
            	<div class="col-6 col-xl-2 col-lg-2 col-md-2 text-center text-sm-left">
            		<div class="newloc">
            			<a href="#" class="newloc-link"><i class="fa fa-clock-o"></i> <span>ПН-ПТ: 08:00 - 17:30</span></a>
            		</div>
            	</div>
            	
            	<div class="col-6 col-xl-2 col-lg-2 col-md-2 text-right">
            		<div class="newphone position-relative">
            			<a href="tel:88123132280" class="newphone-link" onclick="ym(18248638,'reachGoal','clickPhone'); return true;"><div class="round-area"><i class="fa fa-phone"></i></div> <span itemprop="telephone">8 (812) 313-22-80</span></a>
            		</div>
            	</div>
            	
            	<div class="col-6 col-xl-2 col-lg-2 col-md-2 text-center">
            		<div class="newphone position-relative">
            			<a href="mailto:info@traiv-komplekt.ru" class="newphone-link"><div class="round-area"><i class="fa fa-envelope-o headermail"></i></div> <span><nobr>info@traiv-komplekt.ru</nobr></span></a>
            			<!-- <a href="#" class="mail-copied" rel="info@traiv-komplekt.ru"><i class="fa fa-clone clone-icon"></i></a>-->
            		</div>
            	</div>
            	
            	<div class="col-6 col-xl-2 col-lg-2 col-md-2 text-center">
            		<div class="newphone position-relative">
            			<span class="topnew-social-new"><a href="https://api.whatsapp.com/send?phone=+7 901 328-44-31&text=Добрый день, меня интересует" target="_blank" onclick="ym(18248638,'reachGoal','clickWa'); return true;"><i class="fa fa-whatsapp whatsapp-icon"></i></a></span>
            			<span class="topnew-social-new"><a href="https://web.telegram.org/k/#@gktraiv" target="_blank" style="position:relative;bottom:2px;">
            			<div class="telegram-circle"></div>
            			<i class="fa fa-telegram telegram-icon"></i>
            			
            			 <span class="telegram-bottom-title">Группа</span>
            			 
            			</a></span>
            			
            			 <span class="topnew-social-new"><a href="https://t.me/traivdirect" target="_blank" style="position:relative;bottom:2px;">
            			
            			<i class="fa fa-telegram telegram-icon"></i>
            			 <span class="telegram-bottom-title" style="left: 4px;">Чат</span>
            			 
            			</a></span>       

            			        <span class="topnew-social-new"><a href="https://t.me/TraivLiveBot" target="_blank" style="position:relative;bottom:2px;">
            			
            			<img src="<?=SITE_TEMPLATE_PATH?>/images/chatbot-header-temp.png" class="chat-bot-img"/>
            			 <span class="chat-bot-title"><nobr>Умный бот</nobr></span>
            			 
            			</a></span>   			
            		</div>
            	</div>
            	
            	<div class="col-6 col-xl-3 col-lg-3 col-md-3 text-right">
            	<div class="row">
            	<div class="col-5 text-right">
            	<div class="newphone position-relative">
            			<span class="topnew-oicon-new"><a href="/calculator/"><i class="fa fa-calculator" aria-hidden="true"></i></a></span>
            			<span class="topnew-oicon-new"><a href="/personal/" rel="nofollow"><i class="fa fa-user-o"></i></a></span>
            		</div>
            	</div>
            	<div class="col-7">
            	<div class="btn-group">
            		<a href="#w-form" class="btn-group-new btn-group-new-blue" rel="nofollow"><span>Отправить запрос</span></a>
        		</div>
            	</div>
            	</div>
            	</div>
            	
            	
            	</div>
            </div>
             </div>
            
            <div id="header-new-fixed-content">
            <div id="middle-header">
            <div class="container">
            	<div class="row position-relative">
            		<div class="col-6 col-xl-3 col-lg-3 col-md-3 text-center text-sm-left" id="logotype-area">
            		
            		<?php 
            		        if ($APPLICATION->GetCurPage(false) === '/'){
            		            ?>
            		            <span class="logotype-new" alt="«Трайв» - поставки крепежа и метизов из Европы и Азии"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo2023nh.png" class="logotype"/></span>
            		            <?php 
            		        } else {
            		            ?>
            		            <a href="/" class="logotype-new" alt="«Трайв» - поставки крепежа и метизов из Европы и Азии"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo2023nh.png" class="logotype"/></a>
            		            <?php
            		        }
            		?>
            		
            			
            		</div>
            		
            		<div class="col-6 col-xl-4 col-lg-4 col-md-4 text-center text-sm-left top-fixed" id="catalog-copy-area-parent">
            		<div class="row position-relative" id="catalog-copy-area">
            		</div>
            		</div>
            		
            		<div class="col-6 col-xl-5 col-lg-5 col-md-5 offset-xl-1 offset-lg-1 offset-md-1 text-center" id="header-new-top-search">
            		        <?
        $APPLICATION->IncludeComponent(
	"arturgolubev:search.title", 
	"traiv-2023", 
	array(
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "title-search",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "150",
		"SHOW_PREVIEW" => "Y",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"PAGE" => "#SITE_DIR#search/",
		"NUM_CATEGORIES" => "0",
		"TOP_COUNT" => "20",
		"ORDER" => "rank",
		"USE_LANGUAGE_GUESS" => "Y",
		"CHECK_DATES" => "Y",
		"SHOW_OTHERS" => "Y",
		"CATEGORY_0_TITLE" => "Товары",
		"CATEGORY_0" => array(
			0 => "main",
			1 => "iblock_catalog",
			2 => "iblock_content",
		),
		"COMPONENT_TEMPLATE" => "traiv-2023",
		"CATEGORY_OTHERS_TITLE" => "Информационные страницы",
		"CATEGORY_0_iblock_catalog_1c" => array(
			0 => "all",
		),
		"CATEGORY_1_TITLE" => "",
		"CATEGORY_1" => array(
			0 => "no",
		),
		"CATEGORY_2_TITLE" => "",
		"CATEGORY_2" => array(
			0 => "no",
		),
		"CATEGORY_3_TITLE" => "",
		"CATEGORY_3" => array(
			0 => "no",
		),
		"CATEGORY_4_TITLE" => "",
		"CATEGORY_4" => "",
		"CATEGORY_5_TITLE" => "",
		"CATEGORY_5" => "",
		"CATEGORY_6_TITLE" => "",
		"CATEGORY_6" => "",
		"CATEGORY_7_TITLE" => "",
		"CATEGORY_7" => "",
		"CATEGORY_8_TITLE" => "",
		"CATEGORY_8" => "",
		"CATEGORY_9_TITLE" => "",
		"CATEGORY_9" => "",
		"CATEGORY_0_iblock_content" => array(
			0 => "6",
			1 => "7",
			2 => "23",
			3 => "29",
		),
		"CATEGORY_0_iblock_catalog" => array(
			0 => "18",
			1 => "32",
			2 => "54",
		),
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"FILTER_NAME" => "",
		"SHOW_PREVIEW_TEXT" => "N",
		"SHOW_PROPS" => "",
		"ANIMATE_HINTS" => array(
		),
		"ANIMATE_HINTS_SPEED" => "1",
		"CATEGORY_0_main" => array(
		)
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);
                            ?>
            		</div>
            		
            		<div class="col-6 col-xl-2 col-lg-2 col-md-2 text-center w-form-recall-area">
                	<div class="btn-group">
                		<a href="#w-form-recall" class="btn-group-new btn-group-new-gray" rel="nofollow"><span>Нужна консультация</span></a>
            		</div>
            	</div>
            		
            		<div class="col-6 col-xl-2 col-lg-2 col-md-2 text-center top-fixed" id="header-new-fixed-icon-area">
            		<div class="fixed-icon-items position-relative">
            		
            			<span class="fixed-icon-item"><a href="#w-form-recall" class="newphone-link"><i class="fa fa-phone" style="font-size:20px;"></i></a></span>
            			<span class="fixed-icon-item"><a href="mailto:info@traiv-komplekt.ru" class="fixed-icon-link"><i class="fa fa-envelope-o headermail" style="font-size:20px;"></i></a></span>
            			<span class="fixed-icon-item"><a href="https://api.whatsapp.com/send?phone=+7 905 233-81-63&text=Добрый день, меня интересует" target="_blank" onclick="ym(18248638,'reachGoal','clickWa'); return true;"><i class="fa fa-whatsapp whatsapp-icon" style="font-size:20px;"></i></a></span>
            			<span class="fixed-icon-item"><a href="https://web.telegram.org/k/#@gktraiv" target="_blank" style="position:relative;">
            			<div class="telegram-circle-small"></div><i class="fa fa-telegram telegram-icon" style="font-size:20px;"></i></a></span>

            			        <span class="fixed-icon-item"><a href="https://t.me/TraivLiveBot" target="_blank" class="fixed-icon-link" alt="Умный бот">
            			        <img src="<?=SITE_TEMPLATE_PATH?>/images/chatbot-header-temp.png" class="chat-bot-img-small" data-amwebp-skip/>
            			        </a></span>

            			<!-- <span class="fixed-icon-item" style="position:relative;top:2px;"><a href="/personal/cart/"><img src="<?=SITE_TEMPLATE_PATH?>/images/cart_icon_new_small.png"></a></span> -->
            			<span class="fixed-icon-item" style="position:relative;top:2px;" id="ajax-basket-copy-parent"></span>
            		</div>
            	</div>
            		
            		        <div class="col-6 col-xl-1 col-lg-1 col-md-1 text-center pb-2 pb-sm-0" id="header-new-basket-line">
        	<div id="ajax_basket">
        	

        <!-- <div class="cart_tips">
        	        	<div class="cart_tips_arrow"></div>
                    	<div class="cart_tips_text">Товар добавлен в корзину</div>	
        		</div>-->
        <?php        
        //if($APPLICATION->GetCurPage() !== '/personal/cart/') {
        

                                        $APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"header_new", 
	array(
		"PATH_TO_BASKET" => SITE_DIR."personal/order/make/",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_TOTAL_PRICE" => "Y",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_PERSONAL_LINK" => "N",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"SHOW_AUTHOR" => "N",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"SHOW_PRODUCTS" => "N",
		"POSITION_FIXED" => "N",
		"COMPONENT_TEMPLATE" => "header",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"HIDE_ON_BASKET_PAGES" => "Y",
		"PATH_TO_AUTHORIZE" => "",
		"SHOW_DELAY" => "N",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_SUBSCRIBE" => "N",
		"SHOW_IMAGE" => "Y",
		"SHOW_PRICE" => "Y",
		"SHOW_SUMMARY" => "Y",
		"POSITION_HORIZONTAL" => "right",
		"POSITION_VERTICAL" => "top",
		"SHOW_REGISTRATION" => "Y",
		"MAX_IMAGE_SIZE" => "70",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);
        //}
?>

                                        

        </div>
        
        </div>
        
        
        <div class="col-2 col-xl-2 col-lg-2 col-md-2 right-button-form top-fixed">
            	<div class="btn-group">
            		<a href="#w-form" class="btn-group-new btn-group-new-blue"><span>Отправить запрос</span></a>
        		</div>
            	</div>
        
            		
            	</div>
            </div>
            </div>
            
            <div class="container" id="bottom-header">
            
            <div class="row pb-2 position-relative">
                <div class="col-6 col-xl-3 col-lg-3 col-md-3 text-center text-sm-left">
                	<span class="header-new-description">Производитель и дистрибьютор крепежа и метизов с 2006 года</span>
                </div>
                
                <div class="col-6 col-xl-8 col-lg-8 col-md-8 offset-xl-1 offset-lg-1 offset-md-1 text-center text-sm-left">
            		<div class="row position-relative" id="header-new-catarea-copy-parent">
            			<div class="col-6 col-xl-3 col-lg-3 col-md-3 text-left" id="header-new-catarea-copy">
            				<div class="btn-group">
                        		<a href="#" class="btn-group-new-nav btn-group-new-nav-dark header-new-catlink w-auto"><i class="fa fa-bars"></i><span>Каталог</span></a>
                    		</div>
                    		
                    		
                    		<div class="header-new-catarea">
                    		   <? 
                        $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "traiv_vertical_multilevel_2023",
                            array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "left",
                                "COMPONENT_TEMPLATE" => $left_menu_tpl,
                                "DELAY" => "N",
                                "MAX_LEVEL" => "2",
                                "MENU_CACHE_GET_VARS" => "",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "N",
                                "ROOT_MENU_TYPE" => "left",
                                "USE_EXT" => "Y",
                                "CACHE_SELECTED_ITEMS" => "N",
                                "MENU_CACHE_USE_USERS" => "N",
                            ),
                            false
                            );
                        ?>
                        
                    		</div>
                    		
                    		<?php 
                    		/*if ( $USER->IsAuthorized() )
                    		{
                    		    if ($USER->GetID() == '3092') {
                    		        ?>
                    		        <?php 
                    		    }
                    		    else {
                    		       ?>
                    		       <div class="top-fixed" id="header-new-provo-top">
            				<div class="btn-group">
                        		<a href="/services/proizvodstvo-metizov/" class="btn-group-new-nav btn-group-new-nav-trans w-150"><span>Производство</span></a>
                    		</div>
                    		</div>
                    		       <?php  
                    		    }
                    		}
                    		else
                    		{
                    		 ?>
                    		 <div class="top-fixed" id="header-new-provo-top">
            				<div class="btn-group">
                        		<a href="/services/proizvodstvo-metizov/" class="btn-group-new-nav btn-group-new-nav-trans w-150"><span>Производство</span></a>
                    		</div>
                    		</div>
                    		 <?php    
                    		}*/
                    		?>
            			
                    		
            			</div>		
            			
            			<?php 
            			
            			/*if ( $USER->IsAuthorized() )
            			{
            			    if ($USER->GetID() == '3092') {*/
            			 ?>
            			 <div class="col-6 col-xl-3 col-lg-3 col-md-3 text-center" id="header-new-servarea-copy">
            				<div class="btn-group">
                        		<!-- <a href="/services/proizvodstvo-metizov/" class="btn-group-new-nav btn-group-new-nav-trans"><span>Производство</span></a> -->
                        		<a href="#" class="btn-group-new-nav btn-group-new-nav-dark header-new-servlink w-auto"><i class="fa fa-bars"></i><span>Производство</span></a>
                    		</div>
                             <?php $cur_page = $APPLICATION->GetCurPage(false); ?>
                    		<div class="header-new-servarea">                    		
                    			<ul class="hn-serv-menu">
                    				<li><a href="/services/proizvodstvo-metizov/" class="item <?= ('/services/proizvodstvo-metizov/' == $cur_page || strpos($cur_page,'/services/proizvodstvo-metizov/')!==false) ? 'vertical-multilevel-selected' : ''?>">Производство крепежа</a></li>
                    				<li><a href="/oborudovanie-na-nashem-proizvodstve/" class="item <?= ('/oborudovanie-na-nashem-proizvodstve/' == $cur_page || strpos($cur_page,'/oborudovanie-na-nashem-proizvodstve/')!==false) ? 'vertical-multilevel-selected' : ''?>">Наше оборудование</a></li>
                    				<li><a href="/services/proizvodstvo-metizov/works/" class="item <?= ('/services/proizvodstvo-metizov/works/' == $cur_page || strpos($cur_page,'/services/proizvodstvo-metizov/works/')!==false) ? 'vertical-multilevel-selected' : ''?>">Наши работы</a></li>
                    				<li><a href="/services/coatings/" class="item <?= ('/services/coatings/' == $cur_page || strpos($cur_page,'/services/coatings/')!==false) ? 'vertical-multilevel-selected' : ''?>">Нанесение покрытий</a></li>
                    				<li><a href="/services/nakatka-rezby/" class="item <?= ('/services/nakatka-rezby/' == $cur_page || strpos($cur_page,'/services/nakatka-rezby/')!==false) ? 'vertical-multilevel-selected' : ''?>">Накатка резьбы</a></li>
                    				<li><a href="/services/kalibrovka-rezby/" class="item <?= ('/services/kalibrovka-rezby/' == $cur_page || strpos($cur_page,'/services/kalibrovka-rezby/')!==false) ? 'vertical-multilevel-selected' : ''?>">Калибровка резьбы</a></li>
                    				<li><a href="/services/paketnoe-pilenie-shpilek/" class="item <?= ('/services/paketnoe-pilenie-shpilek/' == $cur_page || strpos($cur_page,'/services/paketnoe-pilenie-shpilek/')!==false) ? 'vertical-multilevel-selected' : ''?>">Пакетное пиление шпилек</a></li>
                    				<li><a href="/services/termicheskaya-obrabotka-obyemnaya-krepezha-i-metalla/" class="item <?= ('/services/termicheskaya-obrabotka-obyemnaya-krepezha-i-metalla/' == $cur_page || strpos($cur_page,'/services/termicheskaya-obrabotka-obyemnaya-krepezha-i-metalla/')!==false) ? 'vertical-multilevel-selected' : ''?>">Термическая обработка</a></li>
                    			</ul>
                    		</div>
                    		
            			</div>
            			 <?php        
            			   /* }
            			    else {
            			       ?>
            			       <div class="col-6 col-xl-3 col-lg-3 col-md-3 text-center">
            				<div class="btn-group">
                        		<a href="/services/proizvodstvo-metizov/" class="btn-group-new-nav btn-group-new-nav-trans"><span>Производство</span></a>
                    		</div>
            			</div>
            			       <?php  
            			    }
            			}
            			else
            			{
            			    ?>
            			<div class="col-6 col-xl-3 col-lg-3 col-md-3 text-center">
            				<div class="btn-group">
                        		<a href="/services/proizvodstvo-metizov/" class="btn-group-new-nav btn-group-new-nav-trans"><span>Производство</span></a>
                    		</div>
            			</div>    
            			    <?php 
            			}
            			*/
            			?>
            			
            			<div class="col-6 col-xl-3 col-lg-3 col-md-3 text-center">
            				<div class="btn-group">
                        		<a href="/price-list/" class="btn-group-new-nav btn-group-new-nav-trans"><span>Прайс-листы</span></a>
                    		</div>
            			</div>
            			
            			<div class="col-6 col-xl-3 col-lg-3 col-md-3 text-center">
            				<div class="btn-group">
                        		<a href="/contacts/" class="btn-group-new-nav btn-group-new-nav-trans"><span>Контакты</span></a>
                    		</div>
            			</div>
            			
            		</div>    	
                </div>
                
            </div>
            
            </div>
            
            <div class="header-new-mainmenu-area">
            <div class="container" id="header-new-mainmenu">
            	<div class="row position-relative">
            	
            	      <?
                            $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"header-new-mainmenu", 
	array(
		"ROOT_MENU_TYPE" => "header_new_mainmenu",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "podmenu",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "header-new-mainmenu"
	),
	false
);
                            ?>
            	
            	</div>
           	</div>
           	</div>
           	</div>
            
            
        </section>
        <?php 
        
        $APPLICATION->IncludeComponent(
            "bitrix:sale.basket.basket",
            "traiv-header-new",
            array(
                "COMPONENT_TEMPLATE" => "traiv",
                "COLUMNS_LIST" => array(
                    0 => "NAME",
                    1 => "DISCOUNT",
                    2 => "WEIGHT",
                    3 => "PROPS",
                    4 => "DELETE",
                    5 => "PRICE",
                    6 => "QUANTITY",
                    7 => "SUM",
                    8 => "PROPERTY_TSVET",
                    9 => "PROPERTY_FORMA",
                    10 => "PROPERTY_CML2_ARTICLE",
                    11 => "PROPERTY_CML2_ATTRIBUTES",
                    12 => "PROPERTY_CML2_MANUFACTURER",
                    13 => "PROPERTY_POKRYTIE",
                    14 => "PROPERTY_MATERIAL",
                    15 => "PROPERTY_DIAMETR",
                    16 => "PROPERTY_DLINA",
                    17 => "PROPERTY_SHAG_REZBY",
                    18 => "PROPERTY_UPAKOVKA",
                    19 => "CML2_ARTICLE",
                ),
                "TEMPLATE_THEME" => "",
                "PATH_TO_ORDER" => "/personal/order.php",
                "HIDE_COUPON" => "Y",
                "PRICE_VAT_SHOW_VALUE" => "N",
                "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
                "USE_PREPAYMENT" => "N",
                "QUANTITY_FLOAT" => "N",
                "AUTO_CALCULATION" => "Y",
                "SET_TITLE" => "Y",
                "ACTION_VARIABLE" => "basketAction",
                "OFFERS_PROPS" => array(
                    0 => "CML2_ARTICLE",
                    1 => "CML2_ATTRIBUTES",
                    2 => "CML2_BAR_CODE",
                    3 => "CML2_BASE_UNIT",
                    4 => "CML2_MANUFACTURER",
                    5 => "CML2_TAXES",
                    6 => "CML2_TRAITS",
                    7 => "PROPERTY_CML2_ARTICLE"
                ),
                "USE_GIFTS" => "N",
                "COLUMNS_LIST_EXT" => array(
                    0 => "PREVIEW_PICTURE",
                    1 => "DISCOUNT",
                    2 => "DELETE",
                    3 => "DELAY",
                    4 => "TYPE",
                    5 => "SUM",
                    6 => "PROPERTY_CML2_ARTICLE",
                    7 => "CML2_ARTICLE",
                ),
                "CORRECT_RATIO" => "Y",
                "COMPATIBLE_MODE" => "Y",
                "IS_SET_MIN_SUM" => "1",
                "MIN_SUM" => "3000",
                "ADDITIONAL_PICT_PROP_18" => "-",
                "ADDITIONAL_PICT_PROP_19" => "-",
                "BASKET_IMAGES_SCALING" => "adaptive",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "ADDITIONAL_PICT_PROP_32" => "-"
            ),
            false
            );
            
        } else {
            ?>
        
        <section id="topnav" <?php echo $m_check;?>>
<div class="container d-none d-lg-block">
  <div class="row">
    <div class="col-6 col-xl-3 col-lg-3 col-md-3 text-center text-sm-left">
        <div class="top_location">
        
        <?
	        if (!empty($_COOKIE['geo']) && ($_COOKIE['geo'] == 'KZ' || $_COOKIE['geo'] == 'UZ' || $_COOKIE['geo'] == 'BY')){
	        ?>
	      <i class="fa fa-map-marker"></i><span class="top_location_title">Ваша страна: </span>
	      <div href="#" class="link_location">
	      <?php 
	      if ($_COOKIE['geo'] == 'KZ'){
	          ?>
	      <img src="/images/media/kz.png"/><span class="top_location_text">Казахстан</span>
	      <?php } elseif ($_COOKIE['geo'] == 'UZ'){
	          ?>
	      <img src="/images/media/uz.png"/><span class="top_location_text">Узбекистан</span>    
	          <?php 
	      } elseif ($_COOKIE['geo'] == 'BY'){
	          ?>
	      <img src="/images/media/rb.png"/><span class="top_location_text">Беларусь</span>    
	          <?php 
	      }?>
	      </div>
	      <?php   
	        } else {
	            
	                 ?>
	                 <i class="fa fa-map-marker"></i><span class="top_location_title">Ваша страна:</span>
        	<div class="menu_tips_area">
        	<a href="#" class="link_location"><span class="top_location_text">Россия</span></a>
        	        	<div class="menu_tips">
        	        	<div class="menu_tips_arrow"></div>
                    		<ul>
                    			<li><a href="#" id="loc_rus" class="menu_tips_link"><span class="menu_tips_link_country"><img src="/images/media/ru.png"/></span>Россия</a></li>
                    			<li><a href="#" id="loc_mos" class="menu_tips_link"><span class="menu_tips_link_country"><img src="/images/media/rb.png"/></span>Беларусь</a></li>
                    			<li><a href="#" id="loc_spb" class="menu_tips_link"><span class="menu_tips_link_country"><img src="/images/media/uz.png"/></span>Узбекистан</a></li>
                    			<li><a href="#" id="loc_eka" class="menu_tips_link"><span class="menu_tips_link_country"><img src="/images/media/kz.png"/></span>Казахстан</a></li>
                    		</ul>
        		</div>
        	</div>
	            <?php
	        }
	?>
        </div>
    </div>
    <div class="col-6 col-xl-2 col-lg-2 col-md-2 sm-nopadding text-center text-sm-left">
      	<div class="top_location">
        	<a href="/contacts/" rel="nofollow"><i class="fa fa-clock-o"></i><span class="timework">ПН-ПТ с 08:00 до 18:00</span></a>
        </div>
    </div>
    <div class="col-6 col-xl-2 col-lg-2 col-md-2 text-center pt-2 pt-sm-0">
      <div class="top_location">
                             <a href="/favorites/" class="prod-favorites-top" rel="nofollow"><i class="fa fa-heart-o favorites"></i> <span class='prod-favorites-top-text'> Избранное
                             <?php 
                               $fav_list_array = json_decode($_COOKIE['fav_list']);
                    $arrayFav = [];
                    foreach ($fav_list_array as $value) {
                        $arrayFav[] = $value->element_id;
                    }

                    $arrFilterFav=Array("ID" => $array);
                    if (count($arrayFav) > 0){
                        echo "(<span id='prod-favorites-top-count'>".count($arrayFav)."</span>)";
                    }
                    else {
                        echo "(<span id='prod-favorites-top-count'>0</span>)";
                    }
                    
                    ?></span></a> 
        </div>
    </div>
    <div class="col-6 col-xl-2 col-lg-2 col-md-2 text-center pt-2 pt-sm-0">
      <div class="top_location">
                                 <?
                                 global $USER;
                                 if ($USER->IsAuthorized()) { 
                                         $m_user_link = "/personal/";?>
                                         <a href="/personal/" title="Перейти в личный кабинет" rel="nofollow"><i class="fa fa-user"></i><span><?/*=$USER->GetFirstName()*/?>Личный кабинет</span></a>
                                 <? } else { 
                                     $m_user_link = "/auth/";
                                     ?>
                                         <a href="/auth/" title="Вход на сайт" rel="nofollow"><i class="fa fa-user"></i><span>Войти</span></a>/<a href="/registration/" title="Регистрация на сайте" class="reg" rel="nofollow"><span>Регистрация</span></a>
                                 <? } ?>
        </div>
    </div>
    
    <div class="col-6 col-xl-1 col-lg-1 col-md-1 sm-nopadding text-center text-sm-right">
      <div class="top_calc">
		<a href="/calculator/" rel="nofollow" alt="Калькулятор расчета веса крепежа и метизов" title="Калькулятор расчета веса крепежа и метизов"><i class="fa fa-calculator" aria-hidden="true"></i></a>
      </div>
    </div>
    
    <div class="col-12 col-xl-2 col-lg-2 col-md-2 text-center text-sm-right pt-2 pb-2 pt-sm-0 pb-sm-0">
      <div class="top_location">
        	<span>
      	<div class="btn-group-blue">
                    <a href="#w-form" class="btn-blue">
                        <span>Отправить запрос</span>
                    </a>
                </div>
        	</span>
        </div>
    </div>
    
  </div>
</div>
</section>

<section id="topbottom" <?php echo $m_check;?>>
    <div class="container">
      <div class="row topbottom_scroll">
        <div class="col-6 col-xl-3 col-lg-3 col-md-3 pt-2 pt-sm-0 text-left">
             <a href="/" class="logotype" alt="«Трайв» - поставки крепежа и метизов из Европы и Азии"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo_new_tk2023.png" class="logotype_img"/></a>

              <div class="logotype-description">Производство и продажа крепежа и метизов с 2006 года</div>

        </div>
        
	  <div class="col-6 col-xl-2 col-lg-2 col-md-2 text-center text-sm-right pt-2 pb-2 pt-sm-0 pb-sm-0 d-block d-sm-none">
      <div class="top_location">
        	<span>
      <div class="btn-group-blue">
                    <a href="#w-form" class="btn-blue">
                        <span>Отправить запрос</span>
                    </a>
                </div>
        	</span>

           <div class="row mobil-before-mmenu-area" style="min-height: 30px;">
           
           <div class="col-4 mobil-before-mmenu text-center">
           		<a href="https://api.whatsapp.com/send?phone=+7 901 328-44-31&text=Добрый день, меня интересует" target="_blank" onclick="ym(18248638,'reachGoal','clickWa'); return true;"><i class="fa fa-whatsapp whatsapp"></i></a>
           </div>
           
           <div class="col-4 mobil-before-mmenu text-center">
           		<a href="https://web.telegram.org/k/#@gktraiv" target="_blank"><i class="fa fa-telegram telegram-icon telegram"></i></a>
           </div>
           
           <div class="col-4 mobil-before-mmenu text-center">
           		<a href="https://t.me/TraivLiveBot" target="_blank"><img src="<?=SITE_TEMPLATE_PATH?>/images/chatbot-header-temp.png" class="chat-bot-img-mmenu"/></a>
           </div>
           
           </div>

        </div>
    </div>
        
        <div class="col-12 col-xl-5 col-lg-5 col-md-5 p-2 p-sm-0">
        <?
        $APPLICATION->IncludeComponent(
	"arturgolubev:search.title", 
	"traiv-2020-new", 
	array(
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "title-search",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "150",
		"SHOW_PREVIEW" => "Y",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"PAGE" => "#SITE_DIR#search/",
		"NUM_CATEGORIES" => "0",
		"TOP_COUNT" => "20",
		"ORDER" => "rank",
		"USE_LANGUAGE_GUESS" => "Y",
		"CHECK_DATES" => "Y",
		"SHOW_OTHERS" => "Y",
		"CATEGORY_0_TITLE" => "Товары",
		"CATEGORY_0" => array(
			0 => "no",
		),
		"COMPONENT_TEMPLATE" => "traiv-2020",
		"CATEGORY_OTHERS_TITLE" => "Информационные страницы",
		"CATEGORY_0_iblock_catalog_1c" => array(
			0 => "all",
		),
		"CATEGORY_1_TITLE" => "",
		"CATEGORY_1" => array(
			0 => "no",
		),
		"CATEGORY_2_TITLE" => "",
		"CATEGORY_2" => array(
			0 => "no",
		),
		"CATEGORY_3_TITLE" => "",
		"CATEGORY_3" => array(
			0 => "no",
		),
		"CATEGORY_4_TITLE" => "",
		"CATEGORY_4" => "",
		"CATEGORY_5_TITLE" => "",
		"CATEGORY_5" => "",
		"CATEGORY_6_TITLE" => "",
		"CATEGORY_6" => "",
		"CATEGORY_7_TITLE" => "",
		"CATEGORY_7" => "",
		"CATEGORY_8_TITLE" => "",
		"CATEGORY_8" => "",
		"CATEGORY_9_TITLE" => "",
		"CATEGORY_9" => "",
		"CATEGORY_0_iblock_content" => array(
			0 => "6",
			1 => "7",
			2 => "23",
			3 => "25",
			4 => "29",
		),
		"CATEGORY_0_iblock_catalog" => array(
			0 => "18",
		),
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"FILTER_NAME" => "",
		"SHOW_PREVIEW_TEXT" => "N",
		"SHOW_PROPS" => ""
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);
                            ?>
            
        </div>
        
	<div class="col-5 col-xl-4 col-lg-4 col-md-4 text-center text-sm-left pb-2 pb-sm-0 d-block d-sm-none" id="mob_location">
                <div class="top_location">
        	<!-- <i class="fa fa-map-marker"></i><span class="top_location_text">Ваш город:</span>-->
        	<div class="menu_tips_area">
        	<a href="#" class="link_location"><span class="top_location_text">Вся Россия</span></a>
        	        	<div class="menu_tips">
        	        	<div class="menu_tips_arrow"></div>
                    		<ul>
                    			<li><a href="#" id="loc_rus" class="menu_tips_link">Вся Россия</a></li>
                    			<li><a href="#" id="loc_mos" class="menu_tips_link">Москва</a></li>
                    			<li><a href="#" id="loc_spb" class="menu_tips_link">Санкт-Петербург</a></li>
                    			<li><a href="#" id="loc_eka" class="menu_tips_link">Екатеринбург</a></li>
                    			<li><a href="#" id="loc_perm" class="menu_tips_link">Пермь</a></li>
                    		</ul>
        		</div>
        	</div>
        </div>
    </div>
        
            <div class="col-12 col-xl-2 col-lg-2 col-md-2 text-center text-sm-right pt-2 pb-2 pt-sm-0 pb-sm-0" id="scroll-to-fixed-button">
      <div class="top_location">
        	<span>
      <div class="btn-group-blue">
                    <a href="#w-form" class="btn-blue">
                        <span>Отправить запрос</span>
                    </a>
                </div>
        	</span>
        </div>
    </div>
        
        <div class="col-7 col-xl-2 col-lg-2 col-md-2 text-center pb-2 pb-sm-0">
        	<div class="top-phone">
        		<a href="tel:88007072598" id="loc_rus_phone" rel="nofollow" style="display:block;"><i class="fa fa-phone"></i><span>8 (800) 707-25-98</span></a>
        		<a href="tel:83432887940" id="loc_eka_phone" rel="nofollow" style="display:none;"><i class="fa fa-phone"></i><span>8 (343) 288-79-40</span></a>
        		<a href="tel:84953748270" id="loc_mos_phone" rel="nofollow" style="display:none;"><i class="fa fa-phone"></i><span>8 (495) 374-82-70</span></a>
        		<a href="tel:88123132280" id="loc_spb_phone" rel="nofollow" style="display:none;"><i class="fa fa-phone"></i><span>8 (812) 313-22-80</span></a>
        		<a href="tel:89650605995" id="loc_perm_phone" rel="nofollow" style="display:none;"><i class="fa fa-phone"></i><span>8 (965) 060-59-95</span></a>
        	</div>
        	<div class="top-callback d-none d-lg-block">
        		<a href="#w-form-recall" class="link-callback" rel="nofollow">Заказать звонок</a>
        	</div>
        </div>
        
        
        <div class="col-6 col-xl-2 col-lg-2 col-md-2 text-center pb-2 pb-sm-0 d-none d-lg-block">
        	<div id="ajax_basket">
        	

        <div class="cart_tips">
        	        	<div class="cart_tips_arrow"></div>
                    	<div class="cart_tips_text">Товар добавлен в корзину</div>	
        		</div>
        <?php        
        if($APPLICATION->GetCurPage() !== '/personal/cart/') {
        

                                        $APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"header", 
	array(
		"PATH_TO_BASKET" => SITE_DIR."personal/order/make/",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_TOTAL_PRICE" => "Y",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_PERSONAL_LINK" => "N",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"SHOW_AUTHOR" => "N",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"SHOW_PRODUCTS" => "N",
		"POSITION_FIXED" => "N",
		"COMPONENT_TEMPLATE" => "header",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"HIDE_ON_BASKET_PAGES" => "Y",
		"PATH_TO_AUTHORIZE" => "",
		"SHOW_DELAY" => "N",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_SUBSCRIBE" => "N",
		"SHOW_IMAGE" => "Y",
		"SHOW_PRICE" => "Y",
		"SHOW_SUMMARY" => "Y",
		"POSITION_HORIZONTAL" => "right",
		"POSITION_VERTICAL" => "top",
		"SHOW_REGISTRATION" => "Y",
		"MAX_IMAGE_SIZE" => "70",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);
        }
?>

                                        

        </div>
        
        </div>
            
            <!-- this -->
            <div class="cart__dropdown">
            <div class="cart__dropdown_arrow"><i class="fa fa-caret-up" aria-hidden="true"></i></div>
                                            <?
                                            $APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket", 
	"traiv", 
	array(
		"COMPONENT_TEMPLATE" => "traiv",
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "DISCOUNT",
			2 => "WEIGHT",
			3 => "PROPS",
			4 => "DELETE",
			5 => "PRICE",
			6 => "QUANTITY",
			7 => "SUM",
			8 => "PROPERTY_TSVET",
			9 => "PROPERTY_FORMA",
			10 => "PROPERTY_CML2_ARTICLE",
			11 => "PROPERTY_CML2_ATTRIBUTES",
			12 => "PROPERTY_CML2_MANUFACTURER",
			13 => "PROPERTY_POKRYTIE",
			14 => "PROPERTY_MATERIAL",
			15 => "PROPERTY_DIAMETR",
			16 => "PROPERTY_DLINA",
			17 => "PROPERTY_SHAG_REZBY",
			18 => "PROPERTY_UPAKOVKA",
		    19 => "CML2_ARTICLE",
		),
		"TEMPLATE_THEME" => "",
		"PATH_TO_ORDER" => "/personal/order.php",
		"HIDE_COUPON" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"USE_PREPAYMENT" => "N",
		"QUANTITY_FLOAT" => "N",
		"AUTO_CALCULATION" => "Y",
		"SET_TITLE" => "Y",
		"ACTION_VARIABLE" => "basketAction",
		"OFFERS_PROPS" => array(
			0 => "CML2_ARTICLE",
			1 => "CML2_ATTRIBUTES",
			2 => "CML2_BAR_CODE",
			3 => "CML2_BASE_UNIT",
			4 => "CML2_MANUFACTURER",
			5 => "CML2_TAXES",
			6 => "CML2_TRAITS",
		    7 => "PROPERTY_CML2_ARTICLE"
		),
		"USE_GIFTS" => "N",
		"COLUMNS_LIST_EXT" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DISCOUNT",
			2 => "DELETE",
			3 => "DELAY",
			4 => "TYPE",
			5 => "SUM",
			6 => "PROPERTY_CML2_ARTICLE",
		    7 => "CML2_ARTICLE",
		),
		"CORRECT_RATIO" => "Y",
		"COMPATIBLE_MODE" => "Y",
		"IS_SET_MIN_SUM" => "1",
		"MIN_SUM" => "3000",
		"ADDITIONAL_PICT_PROP_18" => "-",
		"ADDITIONAL_PICT_PROP_19" => "-",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ADDITIONAL_PICT_PROP_32" => "-"
	),
	false
);
                                            ?>
                                        </div>
      </div>
    </div>
</section>

<section id="mainmenu" <?php echo $m_check;?>>

   <div class="container d-block d-sm-none sm-nopadding" id="modil_cont_catalog_menu">
  
   
      <div class="row g-0">
      
      <div class="col-4 text-center" id="mv_catalog_item">
      <a href="#" class="mv_catalog_link">
      <i class="fa fa-bars"></i>
      <span>Каталог</span></a>
      </div>
      
       
      <div class="col-3 text-center" id="menu_item">
      <a href="#" class="mv_menu_link">
      <i class="fa fa-bars"></i>
      <span>Меню</span></a>
      </div>
      
      <div class="col-2 text-center" id="user_item">
      <a href="<?php echo $m_user_link;?>" class="user_link">
      <i class="fa fa-user-circle"></i>
      <span></span></a>
      </div>
      
      <div class="col-1 text-center" id="user_item">
      <a href="/calculator/" class="user_link">
      <i class="fa fa-calculator"></i>
      <span></span></a>
      </div>
      
      <div class="col-2 text-center" id="cart_item">
      <a href="/personal/order/make/" class="cart_link">
      <i class="fa fa-shopping-cart"></i>
      <span></span></a>
      </div>
      
      
      </div>
      
       <?
                            $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"main_right_menu_mobil", 
	array(
		"ROOT_MENU_TYPE" => "main_right_menu",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "podmenu",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "main_right_menu"
	),
	false
);
                            ?>      
            <? $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "traiv_vertical_multilevel_2021_mobil",
                            array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "left",
                                "COMPONENT_TEMPLATE" => $left_menu_tpl,
                                "DELAY" => "N",
                                "MAX_LEVEL" => "2",
                                "MENU_CACHE_GET_VARS" => "",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "N",
                                "ROOT_MENU_TYPE" => "left",
                                "USE_EXT" => "Y",
                                "CACHE_SELECTED_ITEMS" => "N",
                                "MENU_CACHE_USE_USERS" => "N",
                            ),
                            false
                            );
                        ?>
      
	</div>

   <div class="container d-none d-lg-block" id="cont_catalog_menu">
   <? 
                        $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "traiv_vertical_multilevel_2021",
                            array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "left",
                                "COMPONENT_TEMPLATE" => $left_menu_tpl,
                                "DELAY" => "N",
                                "MAX_LEVEL" => "2",
                                "MENU_CACHE_GET_VARS" => "",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "N",
                                "ROOT_MENU_TYPE" => "left",
                                "USE_EXT" => "Y",
                                "CACHE_SELECTED_ITEMS" => "N",
                                "MENU_CACHE_USE_USERS" => "N",
                            ),
                            false
                            );
                        ?>
   
      <div class="row g-0">
      <div class="col-2 text-center" id="catalog_item">
      <a href="#" class="catalog_link">
      <i class="fa fa-bars"></i>
      <span>Каталог</span></a>
      </div>
      
      <?php 
      $col = "col-10";
      ?>
      
      <div class="<?php echo $col;?> text-center">
      
                       <ul id="horizontal-multilevel-menu-open-cat" class="row">
                           <li class="col"><a href="/actions/" class="root-item">Наши<br> акции</a></li>
                           <li class="col"><a href="/catalog/po-svoistvam/vysokoprochnyi-krepezh/" class="root-item">Высокопрочный крепеж</a></li>
                           <li class="col"><a href="/catalog/po-svoistvam/nerzhavejushchii-krepezh/" class="root-item">Нержавеющий крепеж</a></li>
                           <li class="col"><a href="/catalog/po-vidy-materialov/poliamidnyi-krepezh/" class="root-item">Полиамидный крепеж</a></li>
                           <li class="col"><a href="/catalog/po-vidy-materialov/latynnyi-krepezh/" class="root-item">Латунный<br> крепеж</a></li>
                           <li class="col"><a href="/catalog/po-svoistvam/djuimovyi-krepezh/" class="root-item">Дюймовый<br> крепеж</a></li>
                           <li class="col"><a href="/catalog/categories/shaiby/din-25201-shaiba-nord-lock/shayby_nord_lock_2fix/" class="root-item">Шайбы<br> 2fix</a></li>
                       </ul>   
      
      <?
                            $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"main_right_menu", 
	array(
		"ROOT_MENU_TYPE" => "main_right_menu",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "podmenu",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "main_right_menu"
	),
	false
);
                            ?>
      </div>
      </div>
	</div>
</section>
        
        <?php 
        }
        

        
/*    }

}*/

	?>



	         <a href="#x" class="w-form__overlay" id="w-form-recall"></a>
         <div class="w-form__popup">
             <!--  <a href="#" class="send-request"  data-fancybox="" data-src="#dialog-request" href="javascript:;">Отправить заявку</a>  -->
             <?$APPLICATION->IncludeComponent(
	"slam:easyform", 
	"traiv", 
	array(
		"COMPONENT_TEMPLATE" => "traiv",
		"FORM_ID" => "FORM5",
		"FORM_NAME" => "Обратный звонок",
		"WIDTH_FORM" => "450px",
		"DISPLAY_FIELDS" => array(
			0 => "TITLE",
			1 => "PHONE",
			2 => "CUR_URL",
		),
		"REQUIRED_FIELDS" => array(
			0 => "TITLE",
			1 => "PHONE",
		),
		"FIELDS_ORDER" => "TITLE,PHONE,CUR_URL",
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
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы Обратный звонок",
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
	    "CATEGORY_PHONE_INPUTMASK" => "Y",
	    "CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
		"CATEGORY_MESSAGE_TITLE" => "Сообщение",
		"CATEGORY_MESSAGE_TYPE" => "textarea",
		"CATEGORY_MESSAGE_PLACEHOLDER" => "",
		"CATEGORY_MESSAGE_VALUE" => "",
		"CATEGORY_MESSAGE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"USE_CAPTCHA" => "N",
		"USE_MODULE_VARNING" => "N",
		"USE_FORMVALIDATION_JS" => "Y",
		"HIDE_FORMVALIDATION_TEXT" => "N",
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
		"USE_INPUTMASK_JS" => "N",
		"CATEGORY_______________________________________________TITLE" => "ИНН (для юридических лиц)",
		"CATEGORY_______________________________________________TYPE" => "text",
		"CATEGORY_______________________________________________PLACEHOLDER" => "",
		"CATEGORY_______________________________________________VALUE" => "",
		"CATEGORY_______________________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "^[a-zA-Z0-9_]+\$",
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
	
	
	         <a href="#x" class="w-form__overlay" id="w-form"></a>
         <div class="w-form__popup">
             <?$APPLICATION->IncludeComponent(
	"slam:easyform", 
	"traiv", 
	array(
		"COMPONENT_TEMPLATE" => "traiv",
		"FORM_ID" => "FORM3",
		"FORM_NAME" => "Отправить запрос",
		"WIDTH_FORM" => "620px",
		"DISPLAY_FIELDS" => array(
			0 => "TITLE",
			1 => "EMAIL",
			2 => "PHONE",
			3 => "MESSAGE",
			4 => "DOCS",
			5 => "CUR_URL",
			6 => "ИНН (для юридических лиц)",
			7 => "",
		),
		"REQUIRED_FIELDS" => array(
			0 => "TITLE",
			1 => "EMAIL",
			2 => "PHONE",
		),
		"FIELDS_ORDER" => "TITLE,EMAIL,PHONE,ИНН (для юридических лиц),DOCS,MESSAGE,CUR_URL",
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
		"EMAIL_TO" => "info@traiv-komplekt.ru",
		"EMAIL_BCC" => "dmitrii.kozlov@traiv.ru",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы Отправить запрос",
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
		"CATEGORY_PHONE_INPUTMASK" => "Y",
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-99-99",
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
