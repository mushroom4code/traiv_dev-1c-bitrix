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
          //  LocalRedirect($_SERVER['HTTP_HOST'] . strtolower($parts_url_0), true, 301);
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: https://'.$_SERVER['HTTP_HOST'].strtolower($parts_url_0), true, 301);
        }else{
            //   LocalRedirect($_SERVER['HTTP_HOST'], true, 301);
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: https://'.$_SERVER['HTTP_HOST'], true, 301);
        }
        exit();
    }
}

use Bitrix\Main\Page\Asset;
$asset = Asset::getInstance();

$dir = $APPLICATION->GetCurDir();

?><!DOCTYPE html><!--[if lt ie 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]--><!--[if ie 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]--><!--[if ie 8]>
<html class="no-js lt-ie9"> <![endif]--><!--[if gt ie 8]><!-->
<html class="no-js" lang="ru">
<!--<![endif]-->
<head>
    <meta name="yandex-verification" content="6429b000fbcb9c5c" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">

   <!-- <link rel="preload" href="/local/templates/traiv-main/fonts/icomoon/regular/icomoon.ttf" as="style">-->
    <?
    //$APPLICATION->ShowMeta("keywords", false, true);
    $APPLICATION->ShowMeta("description", false, true);

    //$asset->addJs(SITE_TEMPLATE_PATH . "/js/vendor/jquery-2.1.0.min.js");
    CJSCore::Init(array("jquery"));
    ?>

    <link rel="shortcut icon" type="image/x-icon" href=/images/favicon.ico>

    <title><? $APPLICATION->ShowTitle() ?></title>

    <?


    $asset->addJs(SITE_TEMPLATE_PATH . "/js/vendor/modernizr-2.7.1.min.js");

    $asset->addJs(SITE_TEMPLATE_PATH . "/js/plugins/jquery.form.js");

   /* $asset->addJs(SITE_TEMPLATE_PATH . "/js/send_request.js");*/

    /*$asset->addJs("/local/templates/traiv-main/js/jquery-ui.js");  NOT WORKING */
    ?>

    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/fancybox/jquery.fancybox.min.js");?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/js/fancybox/jquery.fancybox.min.css");?>

<meta name="google-site-verification" content="gt_Z6DRzh-ZN5kntvSNwx_bHksW7al4YxjLvc8_BGSw" />
<meta http-equiv="Content-Type" content="text/html; charset=<?=LANG_CHARSET?>" />
<?$APPLICATION->ShowMeta("robots")?>
<?$APPLICATION->ShowCSS()?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery.bxslider.css");?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/flexslider.css");?>


<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/custom.css");?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/icofont.css");?>

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700;900&display=swap" rel="stylesheet">

<?
	        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/item.css");
	        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/simplebar.css");
	        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/cntl.css");
	        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/font-awesome.min.css");
	        if ( $USER->IsAuthorized() )
	        {
	            if ($USER->GetID() == '3092' || $USER->GetID() == '2743' || $USER->GetID() == '1788' || $USER->GetID() == '2938' || $USER->GetID() == '3959') {
	                $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/ion.rangeSlider.css");
	                $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/ion.rangeSlider.skinFlat.css");
	                $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/timeline.min.css");
	            }
	            
	            if ($USER->GetID() == '3092' || $USER->GetID() == '2743') {
	                $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery.kviz.css");
	            }
	        }
	?>

    <?//$APPLICATION->ShowHead();?>
<?$APPLICATION->ShowHeadStrings()?>

    <!--<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->

    <!--<script type="text/javascript" data-skip-moving="true">
    var __cs = __cs || [];
    __cs.push(["setCsAccount", "cz4S40VeOGK0oEFrNWGiL9DgdI5p4e8n"]);
    </script>
    <script type="text/javascript" async src="https://app.comagic.ru/static/cs.min.js" data-skip-moving="true"></script>-->

</head>

<body style="overflow-x: hidden;">

<!--noindex><div id="info" class="message">
    <a id="close" title="Закрыть"  href="#" onClick="document.getElementById('info').setAttribute('style','display: none;');">&times;</a>
	<span>Уважаемые клиенты!</span> Вы можете воспользоваться <u><a href="http://old.traiv.ru/" target="_blank" rel="nofollow">старой версией</a></u> сайта.
	</div></noindex-->

<div id="panel"><?if ($USER->isAdmin()) $APPLICATION->ShowPanel();?></div>

<?
	        if ( $USER->IsAuthorized() )
	        {            
	            if ($USER->GetID() == '3092' || $USER->GetID() == '2743') {
	                if($APPLICATION->GetCurPage() == "/poleznoe/") {
	                ?>
	                	<div id="kviz-area"></div>
	                <?php
	                }
	                
	                if($APPLICATION->GetCurPage() == "/info/") {
	                    ?>
	                	<div id="kviz-area2"></div>
	                <?php
	                }
	                
	            }
	        }
	?>

<div class="layout">
    <div class="layout-overlay"></div>

     <header class="header">
         <div class="u-none--m">
        <? /*
        <div class="top-bar">
            <div class="container">
                <div class="u-clearfix">
                    <div class="u-pull-left top-bar__left">
                        <div class="nav-outer">
                            <button class="nav-toggle">
								<span class="hamburger">
									<i class="hamburger__dash"></i>
									<i class="hamburger__dash"></i>
									<i class="hamburger__dash"></i>
								</span>
                                <span><?
                                    // Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        ".default",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "EDIT_TEMPLATE" => "",
                                            "COMPONENT_TEMPLATE" => ".default",

                                        )
                                    );
                                    ?></span>
                            </button>
                            <?
                            // Меню - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/navigation/menu.php
                            $APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "top_menu",
                                array(
                                    "ROOT_MENU_TYPE" => "top",
                                    "MENU_CACHE_TYPE" => "A",
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "MENU_CACHE_GET_VARS" => array(),
                                    "MAX_LEVEL" => "1",
                                    "CHILD_MENU_TYPE" => "",
                                    "USE_EXT" => "Y",
                                    "DELAY" => "N",
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "COMPONENT_TEMPLATE" => "top_menu",
                                ),
                                false
                            );
                            ?>
                        </div>
                    </div>

                    <div class="u-pull-right top-bar__right">
                        <div class="auth dialog-holder">
                            <div class="auth-controls">
                                <?if ($USER->IsAuthorized()) {?>
                                    <a href="/personal/">Личный кабинет</a> / <a href="?logout=yes">Выход</a>
                                <?} else {?>
                                    <? /* Раскоммментировать, когда понадобится регистрация
                                    <a href="#" data-target="sign-in">
                                        <?
                                        // Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
                                        $APPLICATION->IncludeComponent(
                                            "bitrix:main.include",
                                            ".default",
                                            array(
                                                "AREA_FILE_SHOW" => "file",
                                                "EDIT_TEMPLATE" => "",
                                                "COMPONENT_TEMPLATE" => ".default",
                                                "PATH" => "/include/enter.php",
                                            )
                                        );
                                        ?>

                                    </a>
                                    <a href="#" data-target="sign-up">
                                        <?
                                        $APPLICATION->IncludeComponent(
                                            "bitrix:main.include",
                                            ".default",
                                            array(
                                                "AREA_FILE_SHOW" => "file",
                                                "EDIT_TEMPLATE" => "",
                                                "COMPONENT_TEMPLATE" => ".default",
                                                "PATH" => "/include/reg.php",
                                            )
                                        );
                                        ?>
                                    </a>

                                    ?>
                                <?}?>
                            </div>
                            <div id="sign-up" data-id="sign-up" class="auth__dialog dialog">
                                <h5 class="md-title"><?
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        ".default",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "EDIT_TEMPLATE" => "",
                                            "COMPONENT_TEMPLATE" => ".default",
                                            "PATH" => "/include/reg.php",
                                        )
                                    );

                                    ?>
                                </h5>
                                <?
                                // Настраиваемая регистрация - http://dev.1c-bitrix.ru/user_help/settings/users/components_2/main_register.php
                                $APPLICATION->IncludeComponent("bitrix:main.register", "main", Array(
                                    "SHOW_FIELDS" => array(    // Поля, которые показывать в форме
                                        0 => "EMAIL",
                                        1 => "PERSONAL_PHONE",
                                    ),
                                    "REQUIRED_FIELDS" => array(    // Поля, обязательные для заполнения
                                        0 => "EMAIL",
                                        1 => "PERSONAL_PHONE",
                                    ),
                                    "AUTH" => "N",
                                    // Автоматически авторизовать пользователей
                                    "USE_BACKURL" => "Y",
                                    // Отправлять пользователя по обратной ссылке, если она есть
                                    "SUCCESS_PAGE" => "",
                                    // Страница окончания регистрации
                                    "SET_TITLE" => "Y",
                                    // Устанавливать заголовок страницы
                                    "USER_PROPERTY" => "",
                                    // Показывать доп. свойства
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "USER_PROPERTY_NAME" => "",

                                    "AJAX_MODE" => "Y",  // режим AJAX
                                    "AJAX_OPTION_SHADOW" => "N", // затемнять область
                                    "AJAX_OPTION_JUMP" => "N", // скроллить страницу до компонента
                                    "AJAX_OPTION_STYLE" => "Y", // подключать стили
                                    "AJAX_OPTION_HISTORY" => "N",
                                    // Название блока пользовательских свойств
                                ),
                                    false
                                );
                                ?>
                            </div>

                            <div data-id="sign-in" class="auth__dialog dialog">
                                <h5 class="md-title">Вход в личный кабинет</h5>
                                <?
                                // Форма авторизации - http://dev.1c-bitrix.ru/user_help/settings/users/components_2/system_auth_form.php
                                $APPLICATION->IncludeComponent(
                                    "bitrix:system.auth.form",
                                    "main",                // [eshop_adapt, eshop_adapt_auth, .default]
                                    array(
                                        // region Дополнительные настройки
                                        "REGISTER_URL" => "",
                                        // Страница регистрации
                                        "FORGOT_PASSWORD_URL" => "",
                                        // Страница забытого пароля
                                        "PROFILE_URL" => "",
                                        // Страница профиля
                                        "SHOW_ERRORS" => "Y",
                                        // Показывать ошибки
                                        // endregion
                                        "AJAX_MODE" => "Y",  // режим AJAX
                                        "AJAX_OPTION_SHADOW" => "N", // затемнять область
                                        "AJAX_OPTION_JUMP" => "N", // скроллить страницу до компонента
                                        "AJAX_OPTION_STYLE" => "Y", // подключать стили
                                        "AJAX_OPTION_HISTORY" => "N",
                                    )
                                );
                                ?>
                            </div>

                            <div id="registration-success" data-id="registration-success" class="auth__dialog dialog">
                                <h5 class="md-title">Спасибо за регистрацию!</h5>

                                <p>Мы выслали вам на почту письмо с кодом подтверждения.</p>
                                <a href="#" data-target="sign-in" class="btn btn--submit">Войти</a>
                            </div>

                            <div data-id="password-recovery" class="auth__dialog dialog">
                                <h5 class="md-title">Восстановление пароля</h5>
                                <?
                                $APPLICATION->IncludeComponent("bitrix:system.auth.forgotpasswd", "main",
                                    array("AUTH_URL" => "auth"))

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<? */ ?>

             <div class="middle-bar">
                 <div class="container">
                     <div class="middle-bar__left">
                         <a href="/" class="logotype" alt="«Трайв-Комплект» - поставки крепежа и метизов из Европы и Азии"></a>
                     </div>
                     <div class="middle-bar__right">
                         <div class="u-pull-left middle-bar__cell">
                             <?$APPLICATION->IncludeComponent(
                                 "traiv:region.select",
                                 "",
                                 array(
                                     "REGIONS" => array(
                                         "Санкт-Петербург" => "+7 (812) 313-22-80",
                                         "Москва" => "+7 (495) 374-82-70",
                                         "Екатеринбург" => "+7 (343) 288-79-40",
                                         "Вся Россия" => "8 800 707-25-98"
                                     )
                                 )
                             );?>


                             <div class="header-contacts-work">
                                 <p>8-800-707-25-98 (звонок бесплатный)</p>
                                 <p>ПН - ПТ с 9:00 до 21:00 (по Москве)</p>
                             </div>
                             
                             
                             
                         </div>

                         <div class="u-pull-right middle-bar__cell">
                             <div class="column-send">
                                 <a href="#w-form" class="iconed iconed--left" rel="nofollow">Отправить запрос</a>
                                 <?
                                 global $USER;
                                 if ($USER->IsAuthorized()) { ?>
                                     <div class="personal">
                                         <p><a href="/personal/" title="Перейти в личный кабинет" rel="nofollow">Здраствуйте, <br><?=$USER->GetFirstName()?></a></p>

                                     </div>
                                 <? } else { ?>
                                     <div class="auth">
                                         <a href="/auth/" title="Вход на сайт" rel="nofollow">Войти</a> <a href="/registration/" title="Регистрация на сайте" class="reg" rel="nofollow">Зарегистрироваться</a>
                                     </div>
                                 <? } ?>
                             </div>
                             <div class="column-phone">
                                 <div class="region-select-phone"> <? $APPLICATION->ShowViewContent('region-select-phone'); ?></div>
                                 <div class="clear"></div>
                                 <!--   <a data-fancybox="" data-src="#recall-form" href="javascript:;" class="iconed iconed--left2"/>Обратный звонок</a>  -->

                                 <a href="#w-form-recall" class="callback" rel="nofollow">Заказать звонок</a>

                                 <!--
                                <div id="dialog-request">
                                    <div data-id="application-form">
                                    <?/*
                                    // Заполнение веб-формы - http://dev.1c-bitrix.ru/user_help/service/form/components_2/form_result_new.php
                                    $APPLICATION->IncludeComponent("traiv:form.result.new", "request", Array(
                                        "WEB_FORM_ID" => "1",
                                        // ID веб-формы
                                        "IGNORE_CUSTOM_TEMPLATE" => "N",
                                        // Игнорировать свой шаблон
                                        "USE_EXTENDED_ERRORS" => "Y",
                                        // Использовать расширенный вывод сообщений об ошибках
                                        "SEF_MODE" => "N",
                                        // Включить поддержку ЧПУ
                                        "SEF_FOLDER" => "",
                                        // Каталог ЧПУ (относительно корня сайта)
                                        "CACHE_TYPE" => "A",
                                        // Тип кеширования
                                        "CACHE_TIME" => "3600",
                                        // Время кеширования (сек.)
                                        "CACHE_NOTES" => "",
                                        "LIST_URL" => "",
                                        // Страница со списком результатов
                                        "EDIT_URL" => "",
                                        // Страница редактирования результата
                                        "SUCCESS_URL" => "",
                                        // Страница с сообщением об успешной отправке
                                        "CHAIN_ITEM_TEXT" => "",
                                        // Название дополнительного пункта в навигационной цепочке
                                        "CHAIN_ITEM_LINK" => "",
                                        // Ссылка на дополнительном пункте в навигационной цепочке
                                        "COMPONENT_TEMPLATE" => ".default",
                                        "VARIABLE_ALIASES" => array(
                                            "WEB_FORM_ID" => "WEB_FORM_ID",
                                            "RESULT_ID" => "RESULT_ID",
                                        ),
                                        "AJAX_MODE" => "Y",
                                    ),
                                        false
                                    );
                                    */
                                 ?>
                                </div>
                                </div>
-->



                             </div>

                         </div>
                     </div>
                 </div>
             </div>

        <div class="bottom-bar">
            <div class="bottom-bar__inner">
                
                <div class="container">
                    <!-- <div class="categories__dropdown dropdown" style="background: #fafafa">-->
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
                        /*
                        if ( $USER->IsAuthorized() )
                        {
                            if ($USER->GetID() == '3092' || $USER->GetID() == '2743' || $USER->GetID() == '1788') {
                             
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
                                
                            }
                            else {
                                ?>
                                <div class="categories__dropdown dropdown" style="background: #fafafa">
                                <?php 
                                
                                $APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    "catalog-sections-header-old",
                                    array(
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "CHILD_MENU_TYPE" => "",
                                        "COMPONENT_TEMPLATE" => "catalog-sections-header-old",
                                        "DELAY" => "N",
                                        "MAX_LEVEL" => "3",
                                        "MENU_CACHE_GET_VARS" => array(
                                        ),
                                        "MENU_CACHE_TIME" => "3600",
                                        "MENU_CACHE_TYPE" => "Y",
                                        "MENU_CACHE_USE_GROUPS" => "N",
                                        "ROOT_MENU_TYPE" => "float_header",
                                        "USE_EXT" => "Y",
                                        "COMPOSITE_FRAME_MODE" => "A",
                                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                                        "CACHE_SELECTED_ITEMS" => "N"
                                    ),
                                    false
                                    );
                                ?>
                                </div>
                                <?php 
                            }
                        }
                        else
                        {
                            ?>
                                <div class="categories__dropdown dropdown" style="background: #fafafa">
                                <?php
                            $APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "catalog-sections-header-old",
                                array(
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "CHILD_MENU_TYPE" => "",
                                    "COMPONENT_TEMPLATE" => "catalog-sections-header-old",
                                    "DELAY" => "N",
                                    "MAX_LEVEL" => "3",
                                    "MENU_CACHE_GET_VARS" => array(
                                    ),
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_TYPE" => "Y",
                                    "MENU_CACHE_USE_GROUPS" => "N",
                                    "ROOT_MENU_TYPE" => "float_header",
                                    "USE_EXT" => "Y",
                                    "COMPOSITE_FRAME_MODE" => "A",
                                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                                    "CACHE_SELECTED_ITEMS" => "N"
                                ),
                                false
                                );
                            ?>
                                </div>
                                <?php 
                        }
                        */
                        ?>
                    <!-- </div> -->
                    <div class="bottom-bar__aligner">

<?php
$checkb = "style='display:none;'";
?>
 <div class="bottom-bar__cell">
       	<p class="header_catalog_menu"><a href="#" class="header_catalog_menu_link" rel="nofollow"><i class="icofont icofont-navigation-menu"></i> Каталог</a></p>
       </div>
<?php 
$APPLICATION->IncludeComponent("bitrix:menu", "top-middle", Array(
    "ROOT_MENU_TYPE" => "middle",	// Тип меню для первого уровня
    "MENU_CACHE_TYPE" => "A",	// Тип кеширования
    "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
    "MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
    "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
    "MAX_LEVEL" => "2",	// Уровень вложенности меню
    "CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
    "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
    "DELAY" => "N",	// Откладывать выполнение шаблона меню
    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
    "COMPONENT_TEMPLATE" => "middle_menu",
    "CACHE_SELECTED_ITEMS" => "N"
),
    false
    );

/*if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '2743' || $USER->GetID() == '1788') {
     $checkb = "style='display:none;'";
     ?>
       <div class="bottom-bar__cell">
       	<p class="header_catalog_menu"><a href="#" class="header_catalog_menu_link" rel="nofollow"><i class="icofont icofont-navigation-menu"></i> Каталог</a></p>
       </div>
       
       
       <?
        // Меню - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/navigation/menu.php
        $APPLICATION->IncludeComponent("bitrix:menu", "top-middle", Array(
	"ROOT_MENU_TYPE" => "middle",	// Тип меню для первого уровня
		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
		"MAX_LEVEL" => "2",	// Уровень вложенности меню
		"CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
		"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"COMPONENT_TEMPLATE" => "middle_menu",
        "CACHE_SELECTED_ITEMS" => "N"
	),
	false
);
        ?>
       

     <?php 
    }
    else {
        
    }
}
else
{
    
}*/
?>

                        <div class="bottom-bar__cell" <?php echo $checkb;?>>
                            <div class="categories <? if ($dir == "/") {
                                echo "u-none";
                            } ?>">
                                <button class="categories__toggle dropdown-toggle">
									<span class="hamburger hamburger--white">
										<i class="hamburger__dash"></i>
										<i class="hamburger__dash"></i>
										<i class="hamburger__dash"></i>
									</span>
                                    <span><?
                                        $APPLICATION->IncludeComponent(
                                            "bitrix:main.include",
                                            ".default",
                                            array(
                                                "AREA_FILE_SHOW" => "file",
                                                "EDIT_TEMPLATE" => "",
                                                "COMPONENT_TEMPLATE" => ".default",
                                                "PATH" => "/include/catalog.php",
                                            ),
                                            false
                                        );
                                        ?></span>
                                </button>
                            </div>
                        </div>

                        <?
                        $APPLICATION->ShowViewContent('add_catalog');
                        ?>

                        <div class="bottom-bar__cell">
                            <?
                            // Поиск по заголовкам - http://dev.1c-bitrix.ru/user_help/settings/search/components_2/search_title.php
                            $APPLICATION->IncludeComponent(
	"arturgolubev:search.title", 
	"traiv-2020", 
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
                        <div class="bottom-bar__cell">
                            <?
                            // Малая корзина
//                            if (false) {
//                                $APPLICATION->IncludeComponent(
//                                    "bitrix:sale.basket.basket.small.mail",
//                                    ".default",
//                                    array(
//                                        "PATH_TO_BASKET" => "/personal/basket.php",
//                                        "PATH_TO_ORDER" => "/personal/order.php",
//                                        "SHOW_DELAY" => "Y",
//                                        "SHOW_NOTAVAIL" => "Y",
//                                        "SHOW_SUBSCRIBE" => "Y",
//                                        "COMPONENT_TEMPLATE" => ".default",
//                                        "COLUMNS_LIST" => array(
//                                            0 => "NAME",
//                                        ),
//                                        "USER_ID" => "{#USER_ID#}",
//                                    ),
//                                    false
//                                );
//                            }
                            ?>
                            <? if ($dir != "/personal/cart/") { ?>

                                <div class="cart dropdown">
                                    <div id='ajax_basket'>
                                        <?
                                        // Ссылка на корзину
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
                                        ?>
                                        <div class="cart__dropdown dropdown-hidden">
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
                            <? } ?>
                        </div>
                    </div>
                                           	                                
                </div>
                
            </div>
        </div>


        <?
        // Меню - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/navigation/menu.php
        $APPLICATION->IncludeComponent("bitrix:menu", "top-bottom", Array(
	"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
		"MAX_LEVEL" => "2",	// Уровень вложенности меню
		"CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
		"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"COMPONENT_TEMPLATE" => "top_menu",
        "CACHE_SELECTED_ITEMS" => "N"
	),
	false
);
        ?>
                 </div>


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
			2 => "",
		),
		"REQUIRED_FIELDS" => array(
			0 => "TITLE",
			1 => "PHONE",
		),
		"FIELDS_ORDER" => "TITLE,PHONE",
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
		"EMAIL_BCC_SENDER" => "makarov@traiv.ru",
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
		"CATEGORY_PHONE_PLACEHOLDER" => "",
		"CATEGORY_PHONE_VALUE" => "",
		"CATEGORY_PHONE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_PHONE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_PHONE_INPUTMASK" => "N",
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "",
		"CATEGORY_MESSAGE_TITLE" => "Сообщение",
		"CATEGORY_MESSAGE_TYPE" => "textarea",
		"CATEGORY_MESSAGE_PLACEHOLDER" => "",
		"CATEGORY_MESSAGE_VALUE" => "",
		"CATEGORY_MESSAGE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"USE_CAPTCHA" => "Y",
		"USE_MODULE_VARNING" => "N",
		"USE_FORMVALIDATION_JS" => "N",
		"HIDE_FORMVALIDATION_TEXT" => "N",
		"INCLUDE_BOOTSRAP_JS" => "Y",
		"USE_JQUERY" => "Y",
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
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
             <a class="w-form__close" title="Закрыть" href="#w-form__close"></a>
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
			5 => "ИНН (для юридических лиц)",
			6 => "",
		),
		"REQUIRED_FIELDS" => array(
			0 => "TITLE",
			1 => "EMAIL",
			2 => "PHONE",
		),
		"FIELDS_ORDER" => "TITLE,EMAIL,PHONE,ИНН (для юридических лиц),DOCS,MESSAGE",
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
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы Отправить запрос",
		"EMAIL_FILE" => "Y",
		"EMAIL_SEND_FROM" => "N",
		"CREATE_SEND_MAIL_SENDER" => "",
		"EVENT_MESSAGE_ID_SENDER" => array(
			0 => "121",
		),
		"EMAIL_BCC_SENDER" => "makarov@traiv.ru",
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
		"CATEGORY_PHONE_PLACEHOLDER" => "Мобильный телефон",
		"CATEGORY_PHONE_VALUE" => "",
		"CATEGORY_PHONE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_PHONE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_PHONE_INPUTMASK" => "N",
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "",
		"CATEGORY_MESSAGE_TITLE" => "Сообщение",
		"CATEGORY_MESSAGE_TYPE" => "textarea",
		"CATEGORY_MESSAGE_PLACEHOLDER" => "",
		"CATEGORY_MESSAGE_VALUE" => "Здравствуйте! Меня интересует:",
		"CATEGORY_MESSAGE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"USE_CAPTCHA" => "Y",
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
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
             <a class="w-form__close" title="Закрыть" href="#w-form__close"></a>
         </div>



         <div class="howto_buy_btn opened"><i class="fas fa-angle-double-right"></i><a href="/mobile/payment/"> Как купить?</a></div>
         <div class="howto_deliver_btn opened"><i class="fas fa-angle-double-right"></i><a href="/mobile/delivery/""> Как получить?</a></div>

         <div class="menu-mobile">
             <div class="mobile-logo-phone"><a href="tel:88007072598">8-800-707-25-98</a></div>
             <div class="row-buttons">
                 <div class="categories u-none"><button class="categories__toggle dropdown-toggle"><span class="hamburger hamburger--white"><i class="hamburger__dash"></i><i class="hamburger__dash"></i><i class="hamburger__dash"></i></span></button></div>
                 <a href="#map" class="map-icon"></a>
                 <a href="/contacts/" class="tel-icon"></a>

                 <!--<div class="row-logo">-->

                 <a href="/" alt="«Трайв-Комплект» - поставки крепежа и метизов из Европы и Азии" title="«Трайв-Комплект» - поставки крепежа и метизов из Европы и Азии"><img class="main-mobile-logo" src="<?=SITE_TEMPLATE_PATH?>/img/logo-mobile.png" /></a>

                 <div class="categories__dropdown dropdown">
                     <? $APPLICATION->IncludeComponent(
                         "bitrix:menu",
                         "catalog-sections-header-mobile",
                         array(
                             "ALLOW_MULTI_SELECT" => "N",
                             "CHILD_MENU_TYPE" => "",
                             "COMPONENT_TEMPLATE" => "catalog-sections-header",
                             "DELAY" => "N",
                             "MAX_LEVEL" => "",
                             "MENU_CACHE_GET_VARS" => array(
                             ),
                             "MENU_CACHE_TIME" => "3600",
                             "MENU_CACHE_TYPE" => "Y",
                             "MENU_CACHE_USE_GROUPS" => "Y",
                             "ROOT_MENU_TYPE" => "top",
                             "USE_EXT" => "Y"
                         ),
                         false
                     ); ?>
                 </div>
                 <!--<div class="clear"></div>-->

                 <a href="#x" class="w-form__overlay" id="w-form">Отправить запрос</a>

                 <?
                 // Ссылка на корзину
                 $APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"mobile", 
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
		"COMPONENT_TEMPLATE" => "mobile",
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
                 ?>
                 <!--<a href="<?/*=($USER->IsAuthorized()) ? '/personal/' : '/auth/' */?>" class="auth-icon"></a>-->
                 <div class="clear"></div>
                 <!--</div>-->


             </div>

             <div class="traiv-from-search">
                 <form action="/search/" method="get">
                     <input type="text" name="q" placeholder="Поиск среди 86 680 товаров">
                     <input type="submit" value="Найти">
                 </form>
             </div>
         </div>

         <?$APPLICATION->IncludeComponent(
	"intervolga:tips.activator",
	"popover_traiv",
	array(
		"COMPONENT_TEMPLATE" => "popover_traiv",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "2592000",
		"POSITION" => "TOP_LEFT",
		"HINT_STYLE" => "DASHED",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>



    </header>