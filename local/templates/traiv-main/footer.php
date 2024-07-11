<?
use Bitrix\Main\Page\Asset;

$asset = Asset::getInstance();
?>
<footer class="footer">



    <div class="container">

        <div class="goup">
        <a class="goup_link" id="goup"><i class="icofont icofont-square-up" ></i><span class="goup_link_title" rel="nofollow">Наверх</span></a>
        </div>

        <div class="row">      
            <div class="col x3d4 x1d1--t">
                <div class="f-categories">
                    <a href="/"><img src="/local/templates/traiv-main/img/logo-white-s-4.png" alt="Главная страница" class="footer-logo"></a>
                    <!-- <a href="/personal/subscribe/" class="subscribe">Подписаться</a>-->
                    
                    
                    
                    <div class="hide-desctop telephone">
                <div class="sm-title sm-title--white">Контакты «Трайв-Комплект»</div>

                <ul class="contacts">
                    <li class="contacts__item">
                        <div class="contacts__title"><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/spb.php"
                                )
                            );
                            ?></div>
						<span>
							<?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/spb_tel_1.php"
                                )
                            );
                            ?>

						</span>
						<span><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/spb_tel_2.php"
                                )
                            );
                            ?></span>
						<span><a href="#"><?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    ".default",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "EDIT_TEMPLATE" => "",
                                        "COMPONENT_TEMPLATE" => ".default",
                                        "PATH" => "/include/mail.php"
                                    )
                                );

                                ?></a></span>
						<span><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/spb_addr.php"
                                )
                            );

                            ?></span>
                    </li>
                    <li class="contacts__item">
                        <div class="contacts__title"><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/mosca.php"
                                )
                            );

                            ?></div>
						<span><?
								$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									".default",
									array(
										"AREA_FILE_SHOW"     => "file",
										"EDIT_TEMPLATE"      => "",
										"COMPONENT_TEMPLATE" => ".default",
										"PATH"               => "/include/mosca_phone.php"
									)
								);
                            ?></span>
                    </li>
                    <li class="contacts__item">
                        <div class="contacts__title"><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/ekb.php"
                                )
                            );

                            ?></div>
						<span><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/ekb_phone.php"
                                )
                            );

                            ?></span>
                    </li>
                    <li class="contacts__item">
                        <div class="contacts__title"><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/russia.php"
                                )
                            );

                            ?></div>
						<span><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/phone.php"
                                )
                            );

                            ?><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/phone_text.php"
                                )
                            );

                            ?></span>
                    </li>
                </ul>
            </div>
                        

                    
                    <div class="show-desctop">
                    <?

                    // Меню - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/navigation/menu.php
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
                </div>

                <div class="credits">

                          <div class="row">
                          <div class="col x3d5 x1d1--t">
                          <?php 
                          // Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
                          $APPLICATION->IncludeComponent(
                          "bitrix:main.include",
                          ".default",
                          array(
                          "AREA_FILE_SHOW" => "file",
                          "EDIT_TEMPLATE" => "",
                          "COMPONENT_TEMPLATE" => ".default",
                          "PATH" => "/include/credits.php"
                        ),
                        false
                        );
                          ?>
                          </div>
                          <div class="col x2d5 x1d1--t maps_politics">
                          <span><a href="/karta-sayta/" rel="nofollow">Карта сайта</a></span>
                          <span><a href="/politika-konfidentsialnosti/" rel="nofollow"> Политика конфиденциальности </a></span>
                          </div>
                          </div>


                </div>

 <div class="copi">
                    <?
                    // Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "EDIT_TEMPLATE" => "",
                            "COMPONENT_TEMPLATE" => ".default",
                            "PATH" => "/include/copi.php"
                        ),
                        false
                    );
                    ?>


                </div>


            </div>

            <div class="col x1d4 u-align-right u-none--t">
                <div class="sm-title sm-title--white">Контакты «Трайв-Комплект»</div>

                <ul class="contacts">
                    <li class="contacts__item">
                        <div class="contacts__title"><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/spb.php"
                                )
                            );
                            ?></div>
						<span>
							<?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/spb_tel_1.php"
                                )
                            );
                            ?>

						</span>
						<span><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/spb_tel_2.php"
                                )
                            );
                            ?></span>
						<span><a href="#" rel="nofollow"><?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    ".default",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "EDIT_TEMPLATE" => "",
                                        "COMPONENT_TEMPLATE" => ".default",
                                        "PATH" => "/include/mail.php"
                                    )
                                );

                                ?></a></span>
						<span><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/spb_addr.php"
                                )
                            );

                            ?></span>
                    </li>
                    <li class="contacts__item">
                        <div class="contacts__title"><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/mosca.php"
                                )
                            );

                            ?></div>
						<span><?
								$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									".default",
									array(
										"AREA_FILE_SHOW"     => "file",
										"EDIT_TEMPLATE"      => "",
										"COMPONENT_TEMPLATE" => ".default",
										"PATH"               => "/include/mosca_phone.php"
									)
								);
                            ?></span>
                    </li>
                    <li class="contacts__item">
                        <div class="contacts__title"><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/ekb.php"
                                )
                            );

                            ?></div>
						<span><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/ekb_phone.php"
                                )
                            );

                            ?></span>
                    </li>
                    <li class="contacts__item">
                        <h5 class="contacts__title"><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/russia.php"
                                )
                            );

                            ?></h5>
						<span><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/phone.php"
                                )
                            );

                            ?><?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/phone_text.php"
                                )
                            );

                            ?></span>
                    </li>
                </ul>

            <ul class="social">
                <li class="social__item">
                    <a href="https://vk.com/traivkomplekt" rel="nofollow" class="social__link" target="_blank">
                        <i class="icon icon--vk"></i>
                    </a>
                </li>
                <li class="social__item">
                    <a href="https://www.facebook.com/traivkomplekt" rel="nofollow" class="social__link" target="_blank">
                        <i class="icon icon--facebook"></i>
                    </a>
                </li>
                <li class="social__item">
                    <a href="https://instagram.com/traivkomplekt?igshid=ltl4upsq73ni" rel="nofollow" class="social__link" target="_blank">
                        <i class="icon icon--instagram"></i>
                    </a>
                </li>
                <li class="social__item">
                    <a href="https://twitter.com/traiv_komplekt" rel="nofollow" class="social__link" target="_blank">
                        <i class="icon icon--twitter"></i>
                    </a>
                </li>
						<li class="social__item">
                    <a href="https://www.youtube.com/user/traivkomplekt/" rel="nofollow" class="social__link" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                </li>
            </ul>
</div>

        </div>
    </div>
</footer>
        <div id="recall-form">
<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"recall", 
	array(
		"COMPONENT_TEMPLATE" => "recall",
		"WEB_FORM_ID" => "7",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "Y",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "N",
		"LIST_URL" => "/ajax/forms/recall_success.php",
		"EDIT_URL" => "/ajax/forms/recall_success.php",
		"SUCCESS_URL" => "/ajax/forms/recall_success.php",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"CACHE_TIME" => "3600",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>
        </div>
<?
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

</div>

<div style="display: none;">
<?
/*if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {*/
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
    /*}
}*/
?>
</div>

<!--from header 2108 -->
<?$asset->addJs(SITE_TEMPLATE_PATH . "/js/vendor/minify.min.js");?>
<!--from header 2108 -->
<?
$asset->addCss(SITE_TEMPLATE_PATH . '/css/grid.min.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/css/skin.min.css');
$asset->addCss(SITE_TEMPLATE_PATH . '/css/additional.css');
?>

<!--from header 2108 -->

<link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="preload stylesheet">

<script src="<?= SITE_TEMPLATE_PATH ?>/js/script.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/plugins/jquery.modal.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/plugins/jquery.customselect.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/plugins/jquery.carousel.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/plugins/jquery.maskedinput.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/plugins/jquery.validate.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.bxslider.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.flexslider-min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/simplebar.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.cntl.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.cookie.js"></script>
<?$asset->addJs(SITE_TEMPLATE_PATH."/js/ajax_order.js");?>
<?php $asset->addJs(SITE_TEMPLATE_PATH . "/js/jquery-scrolltofixed.js");?>

<div class='left_catalog_area_overlay'></div>

<?php 
if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '2743' || $USER->GetID() == '1788' || $USER->GetID() == '2938' || $USER->GetID() == '3959') {
        ?>
        
<script src="<?= SITE_TEMPLATE_PATH ?>/js/ion.rangeSlider.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/chosen.jquery.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.waypoints.min.js"></script>
<!-- <script src="<?= SITE_TEMPLATE_PATH ?>/js/progressbar.min.js"></script>-->
<!-- <script src="<?= SITE_TEMPLATE_PATH ?>/js/timeline.min.js"></script> -->

        <?php 
    }
    if ($USER->GetID() == '3092' || $USER->GetID() == '2743') {
        ?>
        <script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.kviz.js"></script>
        <?
    }
}

?>
<?php $asset->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");?>
<script>

    setTimeout(function(){
        var elem = document.createElement('script');
        elem.type = 'text/javascript';
        elem.src = '//api-maps.yandex.ru/2.1/?load=package.standard&lang=ru-RU&onload=getYaMap';
        document.getElementsByTagName('body')[0].appendChild(elem);

    }, 9000);
    function getYaMap(){
        var MAP = new ymaps.Map("map",{center: [59.899466, 30.502386],zoom: 13});
        ymaps.ready(function() {
            place = new ymaps.Placemark([59.899466, 30.502386]);
            MAP.geoObjects.add(place);
            MAP.behaviors.disable('scrollZoom')
        });
    }

    </script>

<!--from header 2108 -->
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
    setTimeout(appJivosite,10000)

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
    $(document).one('scroll mosemove',AppMetrica);
    setTimeout(AppMetrica,8000)

</script>
<noscript><div><img src="https://mc.yandex.ru/watch/18248638" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<meta name="yandex-verification" content="6429b000fbcb9c5c" />



<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-135884975-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-135884975-1');
</script>




</body>
</html>