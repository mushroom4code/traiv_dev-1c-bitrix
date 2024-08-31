<section id="footer">
    <div class="container">
    	<div class="row">
    		<div class="col-lg-3 col-md-12 text-center">
    			<div class="logo_footer text-center">
    			<a href="/" class="logotype" alt="«Трайв» - поставки крепежа и метизов из Европы и Азии"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo_new_tk7.png" class="logotype_img_footer"/></a>
    			</div>
    			
    			<div class="info_footer mt-3">
    			<p>Данные на сайте представлены для ознакомления и публичной офертой не являются. Уточняйте текущие цены на крепеж и оборудование у специалистов нашей компании.</p>
    			</div>
    			
    			<div class="pt-4 text-center">
    			
    			<ul class="social">
                <li class="social__item">
                    <a href="https://vk.com/traivkomplekt" rel="nofollow" class="social__link rounded-circle" target="_blank">
                       <i class="fa fa-vk"></i>
                    </a>
                </li>
                <li class="social__item">
                    <a href="https://dzen.ru/id/5ca1e2a91b3a6c00b3291f67" rel="nofollow" class="social__link rounded-circle social_link_relative" target="_blank">
                      <span></span>
                    </a>
                </li>
                <!-- <li class="social__item">
                    <a href="https://www.facebook.com/traivkomplekt" rel="nofollow" class="social__link rounded-circle" target="_blank">
                        <i class="fa fa-facebook"></i>
                    </a>
                </li>
                <li class="social__item">
                    <a href="https://instagram.com/traivkomplekt?igshid=ltl4upsq73ni" rel="nofollow" class="social__link rounded-circle" target="_blank">
                        <i class="fa fa-instagram"></i>
                    </a>
                </li>-->
                <li class="social__item">
                    <a href="https://t.me/gktraiv" rel="nofollow" class="social__link rounded-circle" target="_blank">
                        <i class="fa fa-telegram"></i>
                    </a>
                </li>
						<li class="social__item">
                    <a href="https://www.youtube.com/user/traivkomplekt/" rel="nofollow" class="social__link rounded-circle" target="_blank">
                        <i class="fa fa-youtube"></i>
                    </a>
                </li>
            </ul>
    			
    			</div>
    			
    			<div class="mt-4 mb-4 text-center">
    			<div class="btn-group-blue">
                        <a href="#w-form" class="btn-blue-round" rel="nofollow">
                            <span>Отправить запрос</span>
                        </a>
                    </div>
    			</div>
    		</div>
    		
    		
    		<div class="col-3 col-lg-3 d-none d-lg-block">
    		                    <?
                    $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"catalog-sections-footer", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MENU_CACHE_TYPE" => "Y",
		"MENU_CACHE_TIME" => "360000",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => "",
		"CACHE_SELECTED_ITEMS" => "N",
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "catalog-sections-footer"
	),
	false
);

                    ?>
    		</div>
    		
<div class="col-2 col-lg-2 pl-3 pl-lg-5 pt-0 pt-lg-0 d-none d-lg-block">
<?
$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom-menu", 
	array(
		"ROOT_MENU_TYPE" => "bottom-menu",
		"MENU_CACHE_TYPE" => "Y",
		"MENU_CACHE_TIME" => "360000",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"CACHE_SELECTED_ITEMS" => "N",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "bottom_menu",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "bottom-menu"
	),
	false
);

?>
    		</div>
    		
    		<?php
    		if(!CSite::InDir('/contacts/')){
    		        ?>
    		        <div style="overflow:hidden;width:0px;height:0px;opacity:0;position:absolute;">
    		        
    		        <div class="col-lg-3 col-md-3 col-sm-3 text-md-left text-center" itemscope itemtype="http://schema.org/Organization">
    		        
    		        <div class="cont-item bordered text-center">
    		        <div class="row d-flex align-items-center h-100">
    		        <div class="col-lg-3 col-md-3 text-center">
    		        <div class="cont-icon rounded-circle"><i class="fa fa-map-marker"></i></div>
    		        </div>
    		        <div class="col-lg-9 col-md-9 mb-30 text-md-left text-center">
    		        <span class="mb-0 cont-item-title-child" itemprop="name">Главный офис и склад «Трайв» в Санкт-Петербурге</span>
    		        
    		        <div style='display:block;opacity:0;width:0px;height:0px;position:relative;'>
    		        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    		        <span itemprop="addressLocality">Санкт-Петербург</span>,
    		        <span itemprop="streetAddress">Кудрово, ул.Центральная, дом 41</span>
    		        <span itemprop="postalCode">193168</span>
    		        </div>
    		        </div>
    		        
    		        <p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:88123132280" class="cont-item-rows-child-link" onclick="ym(18248638,'reachGoal','clickPhone'); return true;"><span itemprop="telephone">8 (812) 313-22-80</span></a></p>
    		        <!-- <p class="mt-1 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:+79219317932" class="cont-item-rows-child-link"><span>+7 (921) 931-79-32</span></a></p>-->
    		        <a href="/contacts/sankt-peterburg/" class="cont-item-link">Подробнее...</a>
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
    		        
    		        <div style='display:block;opacity:0;width:0px;height:0px;position:relative;'>
    		        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    		        <span itemprop="addressLocality">Москва</span>,
    		        <span itemprop="streetAddress">Рязанский проспект, 2с49, БЦ "Карачарово", офис 203</span>
    		        <span itemprop="postalCode">109428</span>
    		        </div>
    		        </div>
    		        
    		        <p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:84953748270" class="cont-item-rows-child-link" onclick="ym(18248638,'reachGoal','clickPhone'); return true;"><span itemprop="telephone">8 (495) 374-82-70</span></a></p>
    		        <a href="/contacts/moskva/" class="cont-item-link">Подробнее...</a>
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
    		        
    		        <span class="mb-0 cont-item-title-child" itemprop="name">Филиал «Трайв» в Екатеринбурге</span>
    		        <div style='display:block;opacity:0;width:0px;height:0px;position:relative;'>
    		        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    		        <span itemprop="addressLocality">Екатеринбург</span>,
    		        <span itemprop="streetAddress">Екатеринбург, Елизаветинское шоссе, 39</span>
    		        <span itemprop="postalCode">620024</span>
    		        </div>
    		        </div>
    		        <p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:83432887940" class="cont-item-rows-child-link" onclick="ym(18248638,'reachGoal','clickPhone'); return true;"><span itemprop="telephone">8 (343) 288-79-40</span></a></p>
    		        <a href="/contacts/ekaterinburg/" class="cont-item-link">Подробнее...</a>
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
    		        
    		        <span class="mb-0 cont-item-title-child" itemprop="name">Филиал «Трайв» в Перми</span>
    		        <div style='display:block;opacity:0;width:0px;height:0px;position:relative;'>
    		        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    		        <span itemprop="addressLocality">Пермь</span>,
    		        <span itemprop="streetAddress">Пермь, шоссе Космонавтов 111И, корпус 1, 2 этаж, офис 36</span>
    		        <span itemprop="postalCode">614066</span>
    		        </div>
    		        </div>
    		        <p class="mt-3 cont-item-rows-child"><i class="fa fa-phone"></i><a href="tel:89650605995" class="cont-item-rows-child-link" onclick="ym(18248638,'reachGoal','clickPhone'); return true;"><span itemprop="telephone">8 (965) 060-59-95</span></a></p>
    		        <a href="/contacts/perm/" class="cont-item-link">Подробнее...</a>
    		        </div>
    		        </div>
    		        
    		        </div>
    		        </div>
    		        </div>
    		        <?php 
    		        }
    		?>
    		
    		<div class="col-lg-4 pt-0 pt-lg-0">
    		<div class="footer-catalog-menu-title pb-2 text-center text-lg-left">Контакты</div>
    		
    		<div class="row footer-contacts gx-0">
    		
    		<div class="col-lg-6">
    		<div class="row">
    		
            	<div class="col-lg-2 d-lg-block text-center text-lg-left"><img src="<?=SITE_TEMPLATE_PATH?>/images/contacts_rus.png" class="f_contact_icon"/></div>
            	<div class="col-lg-10 text-center text-lg-left gx-0">
            		<span class="footer-contacts-item-title">Поставки по России:</span>
            		<div class="footer-contacts-item-note"><a href="tel:88007072598" class="footer-contacts-item-phone" onclick="ym(18248638,'reachGoal','clickPhone'); return true;">8 (800) 707-25-98</a></div>
            		<div class="footer-contacts-item-note mb-3"><a href="mailto:info@traiv-komplekt.ru" class="footer-contacts-item-mail">info@traiv-komplekt.ru</a></div>
        		</div>
        		
        		</div>
        		</div>
        		
        		<div class="col-lg-6">
    		<div class="row">
        		<div class="col-lg-2 d-lg-block text-center text-lg-left"><img src="<?=SITE_TEMPLATE_PATH?>/images/contacts_spb.png" class="f_contact_icon"/></div>
            	<div class="col-lg-10 col-sm-12 text-center text-lg-left gx-0">
            		<span class="footer-contacts-item-title">Санкт-Петербург:</span>
            		<div class="footer-contacts-item-note address-hide-mobile"><a href="/contacts/sankt-peterburg/" class="footer-contacts-item-address">193168, Кудрово, Центральная 41</a></div>
            		<div class="footer-contacts-item-note mb-3"><a href="tel:+78123132280" class="footer-contacts-item-phone" onclick="ym(18248638,'reachGoal','clickPhone'); return true;">+7 (812) 313-22-80</a></div>
            		<!-- <div class="footer-contacts-item-note mb-3"><a href="tel:+79219317932" class="footer-contacts-item-phone">+7 (921) 931-79-32</a></div> -->
        		</div>
        		</div>
        		</div>
        		
        		<div class="col-lg-6 ">
    		<div class="row">
        		<div class="col-lg-2 d-lg-block text-center text-lg-left"><img src="<?=SITE_TEMPLATE_PATH?>/images/contacts_msk.png" class="f_contact_icon"/></div>
            	<div class="col-lg-10 text-center text-lg-left gx-0">
            		<span class="footer-contacts-item-title">Москва:</span>
            		<div class="footer-contacts-item-note address-hide-mobile"><a href="/contacts/moskva/" class="footer-contacts-item-address">Рязанский проспект, 2с49, БЦ "Карачарово", офис 203</a></div>
            		<div class="footer-contacts-item-note mb-3"><a href="tel:+74953748270" class="footer-contacts-item-phone" onclick="ym(18248638,'reachGoal','clickPhone'); return true;">+7 (495) 374-82-70</a></div>
        		</div>
        		</div>
        		</div>
        		
        		<div class="col-lg-6 ">
    		<div class="row">
        		<div class="col-lg-2 d-lg-block text-center text-lg-left"><img src="<?=SITE_TEMPLATE_PATH?>/images/contacts_ekt.png"/ class="f_contact_icon"></div>
            	<div class="col-lg-10 text-center text-lg-left gx-0">
            		<span class="footer-contacts-item-title">Екатеринбург:</span>
            		<div class="footer-contacts-item-note address-hide-mobile"><a href="/contacts/ekaterinburg/" class="footer-contacts-item-address">620024, Екатеринбург, Елизаветинское шоссе, 39</a></div>
            		<div class="footer-contacts-item-note mb-3"><a href="tel:+73432887940" class="footer-contacts-item-phone" onclick="ym(18248638,'reachGoal','clickPhone'); return true;">+7 (343) 288-79-40</a></div>
        		</div>
        		</div>
        		</div>
        		
        		<div class="col-lg-6">
    		<div class="row">
        		<div class="col-lg-2 d-lg-block text-center text-lg-left"><img src="<?=SITE_TEMPLATE_PATH?>/images/contacts_perm.png"/ class="f_contact_icon"></div>
            	<div class="col-lg-10 text-center text-lg-left gx-0">
            		<span class="footer-contacts-item-title">Пермь:</span>
            		<div class="footer-contacts-item-note address-hide-mobile"><a href="/contacts/perm/" class="footer-contacts-item-address">614066, Пермь, шоссе Космонавтов 111И, корпус 1, 2 этаж, офис 36</a></div>
            		<div class="footer-contacts-item-note mb-3"><a href="tel:+79650605995" class="footer-contacts-item-phone" onclick="ym(18248638,'reachGoal','clickPhone'); return true;">+7 (965) 060-59-95</a></div>
        		</div>
        		</div>
        		</div>
        		
        		<div class="col-lg-6">
    		<div class="row">
        		<div class="col-lg-2 d-lg-block text-center text-lg-left"><img src="<?=SITE_TEMPLATE_PATH?>/images/contacts_krasnodar.png"/ class="f_contact_icon"></div>
            	<div class="col-lg-10 text-center text-lg-left gx-0">
            		<span class="footer-contacts-item-title">Краснодар:</span>
            		<div class="footer-contacts-item-note address-hide-mobile"><a href="/contacts/krasnodar/" class="footer-contacts-item-address">350024, Краснодар, ул. Московская д.123, оф. 207</a></div>
            		<div class="footer-contacts-item-note mb-3"><a href="tel:+78003339116" class="footer-contacts-item-phone" onclick="ym(18248638,'reachGoal','clickPhone'); return true;">8 (800) 333-91-16 доб. 189</a></div>
        		</div>
        		</div>
        		</div>
        		
        		<div class="col-lg-6">
    		<div class="row">
        		<div class="col-lg-2 d-lg-block text-center text-lg-left"><img src="<?=SITE_TEMPLATE_PATH?>/images/contacts_kazan.png"/ class="f_contact_icon"></div>
            	<div class="col-lg-10 text-center text-lg-left gx-0">
            		<span class="footer-contacts-item-title">Казань:</span>
            		<div class="footer-contacts-item-note address-hide-mobile"><a href="/contacts/krasnodar/" class="footer-contacts-item-address">420021, Казань, ул. Габдуллы Тукая д. 115, к.3, оф. 502</a></div>
            		<div class="footer-contacts-item-note mb-3"><a href="tel:+78003339116" class="footer-contacts-item-phone" onclick="ym(18248638,'reachGoal','clickPhone'); return true;">8 (800) 333-91-16 доб. 183</a></div>
        		</div>
        		</div>
        		</div>
        		
    		</div>
    		
    		</div>
    		
    		</div>
    		
    		
    	</div>
    	</div>
    	
    	<div class="copyright">
        	<div class="container">
            	<div class="row h-100">
            		<div class="col-lg-9 col-md-9 mt-3 text-center text-sm-left mb-3 c_text">
            		<?php 
            		if ( $USER->IsAuthorized() )
            		{
            		    if ($USER->GetID() == '3092') {
            		        ?>
            		        	<a href="#price-popup" class="open-popup-link">Show inline popup</a>
            		        <?php 
            		    }
            		}
            		?>
            		2006 - <?php echo date("Y")?> © Компания «Трайв» производитель и дистрибьютор метизов и крепежа</div>
            		<div class="col-lg-3 col-md-3 mt-3 mb-3 text-center text-sm-left"><a href="/politika-konfidentsialnosti/" rel="nofollow" class="c_link">Политика конфиденциальности</a></div>
            	</div>
        	</div>
    	</div>
    	
</section>

<div class="backlayer"></div>

 <div class='price-list-right-area'>

     <div class="button-area">
     <div class="button-area-item">
             <form method="post" action="/price-list/get_all_price.php">
        <div class="btn-group-blue"><a href="#" class="btn-404 w-100" rel="nofollow" id="getAllPrice" onclick="ym(18248638,'reachGoal','get_all_price'); return true;"><span class="price-list-right-span"><i class="fa fa-download"></i> Скачать полный прайс-лист</span></a></div>
        </form> 
     </div>
     
     <div class="button-area-item second">
              <div class="btn-group-blue"><a href="/katalog-standartnogo-krepezha/" class="btn-404 w-100"><span class="price-list-right-span"><i class="fa fa-eye"></i> Каталог стандартного крепежа</span></a></div>
     </div>
     
     
     </div>

     <div class="btn-group-blue">
     	<a class="btn" id="price-list-right-area-button">
            <span><i class="fa fa-list-alt "></i></span>
        </a>
     </div>
     

     
 </div>

<div class='up_area'>
    <div class="btn-group-blue">
        <a class="btn-up">
            <span><i class="fa fa-chevron-up"></i></span>
        </a>
    </div>
</div>
            		        <div id="price-popup" class="price-popup-ex mfp-hide">
                              <div class="price-popup-ex-area">
                              <div class="row pt-3">
                              	<div class="col-lg-8 col-md-8 col-sm-8 text-center text-lg-left text-md-left">
                              		<div class="price-popup-logo text-center">
                              		<img src="<?=SITE_TEMPLATE_PATH?>/images/logo2023nh.png" class="img-responsive"/>
                              		</div>
                              		<div class="price-popup-title">
                              			Скачать прайс наличия на складе
                              		</div>
                              		
                              		<div class="price-popup-note">
                              			По ссылке ниже вы можете скачать прайс-лист на позиции: для вашего удобства, мы подготовили прайс с табличном формате.
                              		</div>
                              		
                              		<div class="price-popup-button">
                              			<div class="btn-group-blue"><a href="/price-list/" class="btn-404"><span><i class="fa fa-download"></i> Скачать полный прайс-лист</span></a></div>
                              		</div>
                              		
                              		<div class="price-popup-note">
                              			Так же мы публикуем каталог стандартного крепежа в формате PDF
                              		</div>
                              		
                              		<div class="price-popup-button">
                              			<div class="btn-group-blue"><a href="/katalog-standartnogo-krepezha/" class="btn-404"><span><i class="fa fa-eye"></i> Каталог стандартного крепежа</span></a></div>
                              		</div>
                              		
                              	</div>
                              	<div class="col-lg-2 col-md-2 col-sm-2">
                              	
                              	</div>
                              </div>	
                              </div>
                              
                              <div class="price-popup-ex-back">
                              </div>
                              
                            </div>
            		        <?php 
            		        if (!empty($_COOKIE['price_list_popup']) && empty($_SESSION['price_list_popup'])){
            		            setcookie("price_list_popup", "", time()-20, "/", "traiv-komplekt.ru", 1);
            		        }
            		?>

<!-- <div class='wts_area d-block d-sm-none'>
    <div class="btn-group-blue">
        <a href="https://api.whatsapp.com/send?phone=+7 905 233-81-63&text=Добрый день, меня интересует " onclick="ym(18248638,'reachGoal','towtp'); return true;" class="wts-up">
            <span><i class="fa fa-whatsapp"></i></span>
        </a>
    </div>
</div>-->
        <?php
$APPLICATION->IncludeComponent(
	"traiv:buy.one.click", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"USER_CONSENT" => "Y",
		"USER_CONSENT_ID" => "2",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);

?>

<div style="display: none;">
<?
        $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "coffeediz.schema.org",
            array(
                "START_FROM" => $arParams['START_FROM'],
                "PATH" => $arParams['PATH'],
                "SITE_ID" => $arParams['SITE_ID'],
                "LAST_ELEMENT" => $arParams['LAST_ELEMENT'],
            ),
            false,
            array('HIDE_ICONS' => 'Y')
            );
?>
</div>
<div class="general-nav-spacer-mobile"></div>
<section id="mainmenu" <?php echo $m_check;?>>
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

    <div class="container d-none main-menu-container nopadding" id="modil_cont_catalog_menu">


        <div class="row g-0">

            <div class="col-4 text-center" id="mv_catalog_item">
                <a href="#" class="mv_catalog_link">
                    <i class="fa fa-bars"></i>
                    <span>Каталог</span></a>
            </div>


            <div class="col-3 text-center" id="menu_item">
                <a href="#" class="mv_menu_link">
                    <i class="fa fa-cog"></i>
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
                    <i class="fa fa-shopping-cart position-relative">
                 <span id="decodeCardNums">
                     <?php if ($APPLICATION->GetCurPage() !== '/personal/cart/' && $APPLICATION->GetCurPage() !== '/personal/order/make/'): ?>
                         <div id="cart_total_count_mobile"
                              class="header-new-cart-count header-new-cart-count-mobile rounded-circle">0</div>
                     <?php endif; ?>
                </span>
                    </i>
                    <script>
                        $('#cart_total_count_mobile').text($('#cart_total_count').text());
                    </script>
                    <span></span></a>
            </div>


        </div>


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


<?
use Bitrix\Main\Page\Asset;
$asset = Asset::getInstance();
$asset->addJs(SITE_TEMPLATE_PATH . "/js/vendor/modernizr-2.7.1.min.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/vendor/minify.min.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/jquery.bxslider.min.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/jquery.easing.min.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/plugins/jquery.modal.min.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/plugins/jquery.maskedinput.min.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/simplebar.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/jquery.flexslider-min.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/jquery-scrolltofixed-min.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/fancybox/jquery.fancybox.min.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/jquery.cntl.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/ajax-order.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/jquery.cookie.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/jquery.rateit.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/isotope.min.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/hc-offcanvas-nav.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/slick.min.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/ruplayer.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/jquery.mb.YTPlayer.min.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");
if ($APPLICATION->GetCurPage() != '/personal/order/make/')
{
    $asset->addJs('https://api-maps.yandex.ru/2.1/?load=package.search&apikey=4a58b8c2-3610-4a5a-a30f-09d2107f74d9&lang=ru-RU');
}
$asset->addJs('https://www.google.com/recaptcha/api.js?render=' . RECAPTCHA_KEY);


        ?>
        <script>
        $(document).ready(function($) {
            $('#main-nav').hcOffcanvasNav({
                disableAt: false,
                customToggle: '.toggle',
                levelSpacing: 40,
                navTitle: 'Производство',
                levelTitles: true,
                levelTitleAsBack: true,
                pushContent: '#container',
                labelClose: false,
                width:320
            });

          });
        </script>



<?php
$asset->addJs(SITE_TEMPLATE_PATH . "/js/apicalc_ws.js");
if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '2743' || $USER->GetID() == '4677' || $USER->GetID() == '552' || $USER->GetID() == '1788')  {
        $asset->addJs(SITE_TEMPLATE_PATH . "/js/jquery.kviz.js");
    }
    
    if ($USER->GetID() == '3092' || $USER->GetID() == '7174')  {
        $asset->addJs(SITE_TEMPLATE_PATH . "/js/apicalc_ws.js");
    }
    
    if ($USER->GetID() == '3092'){
        if($APPLICATION->GetCurPage() == "/articles/" || $APPLICATION->GetCurPage() == "/articles/search/" || $APPLICATION->GetCurPage() == "/articles/osvoenie-arktiki-i-razvitie-severnogo-morskogo-puti-krepyezh-dlya-nizkikh-temperatur/") {
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/magazine.css");
            $asset->addJs(SITE_TEMPLATE_PATH . "/js/magazine.js");
        }
    }
    
}

?>
<!--[if lt IE 9]>
    <script src="<?=SITE_TEMPLATE_PATH?>/js/vendor/html5shiv.js"></script><![endif]-->
    
    <script crossorigin="anonymous" async id="check-code-pozvonim" charset="UTF-8">
 /*   setTimeout(function(){
        var elem = document.createElement('script');
        elem.type = 'text/javascript';
        elem.src = '//api.pozvonim.com/widget/callback/v3/9270b523c259eb7f36c978ed386dfebe/connect';
        document.getElementsByTagName('body')[0].appendChild(elem);


    }, 11000);
    setTimeout(function(){
        $('.pozvonim-mobile-hide-button').click();
    }, 14000);*/
</script>

<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    function appJivosite () {
        (function () {
            var widget_id = 'QL2KH4sdMr';
            var d = document;
            var w = window;

            function l() {
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = '//code.jivosite.com/script/widget/' + widget_id;
                var ss = document.getElementsByTagName('script')[0];
                ss.parentNode.insertBefore(s, ss);
            }

            if (d.readyState == 'complete') {
                l();
            } else {
                if (w.attachEvent) {
                    w.attachEvent('onload', l);
                } else {
                    w.addEventListener('load', l, false);
                }
            }
        })();
    }
        $(document).one('scroll mosemove',appJivosite);
    setTimeout(appJivosite,5000)

</script>
<!-- {/literal} END JIVOSITE CODE -->





<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    function AppMetrica(){
    	(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
    	m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    	(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    	ym(18248638, "init", {
    	clickmap:true,
    	trackLinks:true,
    	accurateTrackBounce:true,
    	webvisor:true,
    	ecommerce:"dataLayer"
    	});
        /*(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(18248638, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });*/
    }
    //$(document).one('scroll mosemove',AppMetrica);
    //setTimeout(AppMetrica,8000)
    AppMetrica();

</script>
<noscript><div><img src="https://mc.yandex.ru/watch/18248638" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<meta name="yandex-verification" content="6429b000fbcb9c5c" />



<!-- Global site tag (gtag.js) - Google Analytics -->

<!-- Google tag (gtag.js) --> 
<script async src="https://www.googletagmanager.com/gtag/js?id=G-EEVLT6MWLW"></script> 
<script> 
  window.dataLayer = window.dataLayer || []; 
  function gtag(){dataLayer.push(arguments);} 
  gtag('js', new Date()); 
 
  gtag('config', 'G-EEVLT6MWLW'); 
</script>

<!-- Google Tag Manager --> 
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': 
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], 
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); 
})(window,document,'script','dataLayer','GTM-TBVM343');</script> 
<!-- End Google Tag Manager -->

<!-- Google Tag Manager (noscript) --> 
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TBVM343" 
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> 
<!-- End Google Tag Manager (noscript) -->

<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-135884975-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-135884975-1');
</script> -->

<!-- calltouch -->
<script type="text/javascript">
(function(w,d,n,c){w.CalltouchDataObject=n;w[n]=function(){w[n]["callbacks"].push(arguments)};if(!w[n]["callbacks"]){w[n]["callbacks"]=[]}w[n]["loaded"]=false;if(typeof c!=="object"){c=[c]}w[n]["counters"]=c;for(var i=0;i<c.length;i+=1){p(c[i])}function p(cId){var a=d.getElementsByTagName("script")[0],s=d.createElement("script"),i=function(){a.parentNode.insertBefore(s,a)},m=typeof Array.prototype.find === 'function',n=m?"init-min.js":"init.js";s.type="text/javascript";s.async=true;s.src="https://mod.calltouch.ru/"+n+"?id="+cId;if(w.opera=="[object Opera]"){d.addEventListener("DOMContentLoaded",i,false)}else{i()}}})(window,document,"ct","qpdnl9xy");
</script>
<!-- calltouch -->

<!-- vk.com -->
<script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src='https://vk.com/js/api/openapi.js?169',t.onload=function(){VK.Retargeting.Init("VK-RTRG-1859135-5Vlgm"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script><noscript><img src="https://vk.com/rtrg?p=VK-RTRG-1859135-5Vlgm" style="position:fixed; left:-999px;" alt=""/></noscript>
<!-- end vk.com -->

<script>
window.addEventListener ("DOMContentLoaded", function () {
    Element.prototype.matches||(Element.prototype.matches=Element.prototype.matchesSelector||Element.prototype.webkitMatchesSelector||Element.prototype.mozMatchesSelector||Element.prototype.msMatchesSelector),Element.prototype.closest||(Element.prototype.closest=function(e){for(var t=this;t;){if(t.matches(e))return t;t=t.parentElement}return null});
    document.addEventListener('click',function(e){
        if(e.target.closest('.submit-button')) {
            var f = e.target.closest('#buy-one-click');
            if (!!f) { try {
                var name_ct = f.querySelector('#order-name').value;
                var phone_ct = f.querySelector('#order-phone').value;
                var checker = f.querySelector('#check_main_request').value;
                var ct_valid = !!name_ct && !!phone_ct && !!checker;
                console.log(phone_ct);
                phone_ct = phone_ct.replace(/[^0-9]/gim, '');
                if (!!ct_valid){
                    if (phone_ct[0] == '8') {phone_ct=phone_ct.substring(1);}
                    if (phone_ct[0] == '7') {phone_ct=phone_ct.substring(1);}
                    phone_ct= '7' +phone_ct;
                    window.ctw.createRequest('traiv_komplekt', phone_ct, [], function(success, data){ console.log(success, data); } );
                }
                } catch (e) { console.log(e); }
            }
        }
        if(e.target.closest('[type="submit"]')) {
            var f = e.target.closest('form');
            if (!!f){ try {
                    var name_ct = f.querySelector('input[placeholder*="имя"]').value;
                    var email_ct = f.querySelector('input[type="email"]').value;
                    var phone_ct = f.querySelector('input[type="tel"]').value;
                    var recaptcha = document.querySelector('[name="g-recaptcha-response"]').value;
                    var ct_valid = !!name_ct && !!email_ct && !!phone_ct && !!recaptcha;
                    console.log(phone_ct);
                    phone_ct = phone_ct.replace(/[^0-9]/gim, '');
                    if (!!ct_valid){
                        if (phone_ct[0] == '8') {phone_ct=phone_ct.substring(1);}
                        if (phone_ct[0] == '7') {phone_ct=phone_ct.substring(1);}
                        phone_ct= '7' +phone_ct;
                        window.ctw.createRequest('traiv_komplekt', phone_ct, [], function(success, data){ console.log(success, data); } );
                    }
                } catch (e) { console.log(e); }
            }
        }
        if(e.target.closest('[type="submit"]')) {

		function padTo2Digits(num) {
			  return num.toString().padStart(2, '0');
			}

			function formatDate(date) {
			  return (
			    [
			     padTo2Digits(date.getDate()),
			     padTo2Digits(date.getMonth() + 1),
			      date.getFullYear(),
			      ].join('.') +
			    ' ' +
			    [
			      padTo2Digits(date.getHours()),
			      padTo2Digits(date.getMinutes()),
			      padTo2Digits(date.getSeconds()),
			    ].join(':')
			  );
			}
            
            var f = e.target.closest('#FORM5');
            if (!!f){ try {
                    var name_ct = f.querySelector('input[name*="[TITLE]"]').value;
                    var phone_ct = f.querySelector('input[name*="[PHONE]"]').value;
                    var ct_valid = !!name_ct && !!phone_ct;
                    console.log(phone_ct);
                    phone_ct = phone_ct.replace(/[^0-9]/gim, '');
                    if (!!ct_valid){
                        if (phone_ct[0] == '8') {phone_ct=phone_ct.substring(1);}
                        if (phone_ct[0] == '7') {phone_ct=phone_ct.substring(1);}
                        phone_ct= '7' +phone_ct;
                        window.ctw.createRequest('traiv_komplekt', phone_ct, [], function(success, data){ console.log(success, data); } );

                        var unix = Math.round(+new Date()/1000);
			var dformat = formatDate(new Date());
			var ct_site_id = '52033';
			var ct_data = {             
			fio: name_ct,
			phoneNumber: phone_ct,
			email: '',
			subject: 'Заказать звонок',
			//requestNumber: unix,
			requestDate: dformat,
			tags: '',
			comment: '',
			requestUrl: location.href,
			sessionId: window.ct('calltracking_params','qpdnl9xy').sessionId
			};
			jQuery.ajax({  
			  url: 'https://api.calltouch.ru/calls-service/RestAPI/requests/'+ct_site_id+'/register/',      
			  dataType: 'json',         
			  type: 'POST',          
			  data: ct_data
			});
                        
                    }
                } catch (e) { console.log(e); }
            }
        }
    });
    /*document.addEventListener('mouseup',function(e){
        if(e.target.closest('#bx-soa-orderSave a, a.btn-order-save')) {
            console.log('ct test');
            var f = e.target.closest('form');
            if (!!f){ try {
                    var name_ct = f.querySelector('input[name="ORDER_PROP_1"],input[autocomplete="name"]').value;
                    var phone_ct = f.querySelector('input[name="ORDER_PROP_3"],input[autocomplete="tel"]').value;
                    var email_ct = f.querySelector('input[name="ORDER_PROP_2"],input[autocomplete="email"]').value;
                    var checker = f.querySelector('#check_main_request').value;
                    var ct_valid = !!name_ct && !!phone_ct && !!email_ct && !!checker;
                    console.log(phone_ct);
                    phone_ct = phone_ct.replace(/[^0-9]/gim, '');
                    if (!!ct_valid){
                        if (phone_ct[0] == '8') {phone_ct=phone_ct.substring(1);}
                        if (phone_ct[0] == '7') {phone_ct=phone_ct.substring(1);}
                        phone_ct= '7' +phone_ct;
                        window.ctw.createRequest('traiv_komplekt', phone_ct, [], function(success, data){ console.log(success, data); } );
                    }
                } catch (e) { console.log(e); }
            }
        }
    });
    document.addEventListener('touchend',function(e){
        if(e.target.closest('#bx-soa-orderSave a, a.btn-order-save')) {
            console.log('ct test');
            var f = e.target.closest('form');
            if (!!f){ try {
                    var name_ct = f.querySelector('input[name="ORDER_PROP_1"],input[autocomplete="name"]').value;
                    var phone_ct = f.querySelector('input[name="ORDER_PROP_3"],input[autocomplete="tel"]').value;
                    var email_ct = f.querySelector('input[name="ORDER_PROP_2"],input[autocomplete="email"]').value;
                    var checker = f.querySelector('#check_main_request').value;
                    var ct_valid = !!name_ct && !!phone_ct && !!email_ct && !!checker;
                    console.log(phone_ct);
                    phone_ct = phone_ct.replace(/[^0-9]/gim, '');
                    if (!!ct_valid){
                        if (phone_ct[0] == '8') {phone_ct=phone_ct.substring(1);}
                        if (phone_ct[0] == '7') {phone_ct=phone_ct.substring(1);}
                        phone_ct= '7' +phone_ct;
                        window.ctw.createRequest('traiv_komplekt', phone_ct, [], function(success, data){ console.log(success, data); } );
                    }
                } catch (e) { console.log(e); }
            }
        }
    });*/
});
</script>

<?php
      /* if (empty($_COOKIE['geo'])) {
            ?>
<script type="text/javascript" >        
        function AppGeo(){

            $.ajax({
                type: "GET",
                url:"https://traiv-komplekt.ru/ajax/geo/getgeo.php",
                data: 'i=1',
                success: function(res) {
					console.log(res);

					if (res === 'KZ') {
		                		document.cookie = "geo=" + res + ";max-age=2629743";
		                				$('.top_location_title').text('Ваша страна: ');
			                            $('.menu_tips_area').children('.link_location').remove();
			                            $('.top_location_title').append('<div href="#" class="link_location"><img src="/images/media/kz.png"/><span class="top_location_text">Казахстан</span></div>');    
		                    } else if (res == 'BY') {
		                	document.cookie = "geo=" + res + ";max-age=2629743";
		                	$('.top_location_title').text('Ваша страна: ');
		                            $('.menu_tips_area').children('.link_location').remove();
		                            $('.top_location_title').append('<div href="#" class="link_location"><img src="/images/media/rb.png"/><span class="top_location_text">Беларусь</span></div>');
		                        } else if (res == 'UZ') {
		                document.cookie = "geo=" + res + ";max-age=2629743";
		                            $('.top_location_title').text('Ваша страна: ');
		                            $('.menu_tips_area').children('.link_location').remove();
		                            $('.top_location_title').append('<div href="#" class="link_location"><img src="/images/media/uz.png"/><span class="top_location_text">Узбекистан</span></div>');
		                        } else {
							document.cookie = "geo=RU;max-age=2629743";
		                        }
					
                }
            });   
        }
      setTimeout(AppGeo,2000);        
</script>

<?php 
}*/


?>

</body>
</html>
