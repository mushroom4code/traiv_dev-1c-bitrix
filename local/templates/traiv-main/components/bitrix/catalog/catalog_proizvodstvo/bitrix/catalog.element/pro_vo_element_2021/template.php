<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$com_path = '/local/templates/traiv-main/';
$this->addExternalCss($com_path."css/masterslider.css");
$this->addExternalJS($com_path."js/jquery-3.1.1.min.js");
$this->addExternalJS($com_path."js/masterslider.js");
?>


<div class="news-detail prod">

    <?
    IF (!empty ($arResult['DISPLAY_PROPERTIES']['PHOTOS'])) {
    ?>

<? $k = 0;
$CustomImgSrc = array();
?>
    <?foreach ($arResult['DISPLAY_PROPERTIES']['PHOTOS']['VALUE'] as $item): ?>
<?
        $file[$k] = CFile::ResizeImageGet($item, array('width' => 2000,'height' => 450), BX_RESIZE_IMAGE_PROPORTIONAL, true);
?>

<?$k++; ?>

    <?endforeach;?>

    <!-- masterslider -->
<!--    <div class="master-slider ms-skin-light-3" id="masterslider" >-->



            <? $v = 0; ?>
            <?  foreach ($file as $SlideUrl):

                ?>

                <!-- new slide -->
                <!--<div class="ms-slide" >-->

            <!-- slide background -->
            <!--<img src="<?/*=$com_path.'img/blank.gif'*/?>" data-src="<?/*=$file[$v]['src']*/?>" alt="<?/*=$item['NAME']*/?>"/>-->
            <div class="prod-detail-img">
                <img src="<?=$SlideUrl['src']?>" alt="<?=$item['NAME']?>" class="zoom-image"/>
            </div>

                <script src="/local/templates/traiv-main/js/plugins/zoomsl-3.0.js">
                    jQuery(function(){
console.log('THIS');
                        $(".zoom-image").imagezoomsl({

                            zoomrange: [3, 3]
                        });
                    });
                </script>

            <!-- slide text layer
            <div class="ms-layer ms-caption" style="top:10px; left:30px;">

            </div> -->


        <!--</div>-->
        <!-- end of slide -->

        <?$v++;?>
        <?endforeach ?>

</div>
<!--<div class="prod-item-button">
    <a href="#w-form prod" rel="nofollow" class="w-form__orange-btn">Оформить запрос на изготовление<?/*//echo $ButtonName*/?></a>
</div>
    <a href="#x" class="w-form__overlay" id="w-form prod"></a>
    <div class="w-form__popup">-->
<br>

<!--        <a class="w-form__close" title="Закрыть" href="#w-form__close"></a>
    </div>-->
<!-- end of masterslider -->

<? } ?>

<!-- <h1><?//=$arResult['NAME']?></h1> -->

 <?  // echo  $item ?>
<!--
    <?// if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])) { ?>
        <img class="responsive detail_picture" border="0" src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>" height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>" title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"/>
    <?// } else { ?><? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["PREVIEW_PICTURE"])) { ?>
        <img class="responsive preview_picture" border="0" src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arResult["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arResult["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arResult["PREVIEW_PICTURE"]["TITLE"] ?>"/>
    <?// } ?>
-->


        <? if ($arParams["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
            <span class="news-date-time"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></span>
        <? endif; ?>



    <? } ?>
<?php if ($arResult["PROPERTIES"]["STANDARTS"]["VALUE"]): ?>
<div class="prod-block">
<div class="prod-standart-block">
<b><span class="prod-standart-title" ">Стандарт: </span></b>
<?
foreach ($arResult["PROPERTIES"]["STANDARTS"]["VALUE"] as $standart):


    $sections = \Bitrix\Iblock\SectionTable::getList(array(

        'filter' => array(
            'IBLOCK_ID' => 18,
            'NAME' => $standart,
        ),

        'select' =>  array(
                'ID',
                'CODE',
                'NAME',
                'SECTION_PAGE_URL_RAW' => 'IBLOCK.SECTION_PAGE_URL'
                ),
    ));

    foreach ($sections as $section) {

        $sectionList[$section['ID']] = [
            'ID' => $section['ID'],
            'NAME' => $section['NAME'],
            'SECTION_PAGE_URL' => \CIBlock::ReplaceDetailUrl($section['SECTION_PAGE_URL_RAW'], $section, true, 'S'),
        ];
     //   print_r($sectionList[$section['ID']]);
    }

    ?>
    <a href="<?=$sectionList[$section['ID']]['SECTION_PAGE_URL']?>"><?=$standart?></a>
    <span class="prod-comma"></span>
<?

endforeach;

?>
    <span class="btn prod-standart-less">Скрыть</span>
</div>
<span class="btn prod-standart-more">Показать все</span>

</div>
<?php endif; ?>

<div>

               <div class="prod-comment-form post-form slam-easyform">
               
     <div class="prod-comment-title">Заявка на <span style="text-transform: lowercase;"><?php echo $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'];?></span></div>
     <div class="check_type_pack"><i class="icofont icofont-warning-alt"></i>После получения заявки с Вами свяжется менеджер для уточнения деталей заказа.</div>
               
               <?php 
               $APPLICATION->IncludeComponent(
	"slam:easyform", 
	"traiv-prod-2021-new", 
	array(
		"COMPONENT_TEMPLATE" => "traiv-prod-2021-new",
		"FORM_ID" => "FORM12",
		"FORM_NAME" => "Отправить запрос на изготовление",
		"WIDTH_FORM" => "",
		"DISPLAY_FIELDS" => array(
			0 => "DOCS",
			1 => "Размер изделия",
			2 => "Количество изделий",
			3 => "Ваш комментарий",
			4 => "Ваше Имя",
			5 => "Телефон для связи",
			6 => "",
		),
		"REQUIRED_FIELDS" => array(
			0 => "Ваше Имя",
			1 => "Телефон для связи",
		),
		"FIELDS_ORDER" => "Размер изделия,Количество изделий,Ваш комментарий,Ваше Имя,Телефон для связи,DOCS",
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
		"EMAIL_TO" => "dmitrii.kozlov@traiv.ru",
		"EMAIL_BCC" => "",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы Отправить запрос на ПРОИЗВОДСТВО",
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
		"CATEGORY_PHONE_PLACEHOLDER" => "+7(999)999-99-99",
		"CATEGORY_PHONE_VALUE" => "",
		"CATEGORY_PHONE_VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_PHONE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_PHONE_INPUTMASK" => "Y",
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
		"CATEGORY_MESSAGE_TITLE" => "Сообщение",
		"CATEGORY_MESSAGE_TYPE" => "text",
		"CATEGORY_MESSAGE_PLACEHOLDER" => "",
		"CATEGORY_MESSAGE_VALUE" => "Дополнительные комментарии",
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
		"CATEGORY____________________________________________________________________________________email__TITLE" => "Укажите Ваши контактные данные (ФИО, телефон, email)",
		"CATEGORY____________________________________________________________________________________email__TYPE" => "text",
		"CATEGORY____________________________________________________________________________________email__PLACEHOLDER" => "",
		"CATEGORY____________________________________________________________________________________email__VALUE" => "",
		"CATEGORY____________________________________________________________________________________email__VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY____________________________________________________________________________________email__IBLOCK_FIELD" => "FORM_Укажите Ваши контактные данные (ФИО, телефон, email)",
		"CATEGORY__________________________________________________________TITLE" => "Напишите, что нужно изготовить",
		"CATEGORY__________________________________________________________TYPE" => "text",
		"CATEGORY__________________________________________________________PLACEHOLDER" => "Напишите, что нужно изготовить",
		"CATEGORY__________________________________________________________VALUE" => "",
		"CATEGORY__________________________________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY__________________________________________________________IBLOCK_FIELD" => "FORM_Напишите, что нужно изготовить",
		"CATEGORY____________________________________________________TITLE" => "Опишите применение изделия",
		"CATEGORY____________________________________________________TYPE" => "text",
		"CATEGORY____________________________________________________PLACEHOLDER" => "Опишите применение изделия",
		"CATEGORY____________________________________________________VALUE" => "",
		"CATEGORY____________________________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY____________________________________________________IBLOCK_FIELD" => "FORM_Опишите применение изделия",
		"CATEGORY______________________________TITLE" => "Размер изделия",
		"CATEGORY______________________________TYPE" => "text",
		"CATEGORY______________________________PLACEHOLDER" => "Размер изделия",
		"CATEGORY______________________________VALUE" => "",
		"CATEGORY______________________________VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY______________________________IBLOCK_FIELD" => "FORM_Размер изделия",
		"CATEGORY_______________________________________TITLE" => "Материал и покрытие",
		"CATEGORY_______________________________________TYPE" => "text",
		"CATEGORY_______________________________________PLACEHOLDER" => "Материал и покрытие",
		"CATEGORY_______________________________________VALUE" => "",
		"CATEGORY_______________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_______________________________________IBLOCK_FIELD" => "FORM_Материал и покрытие",
		"CATEGORY______________________________________TITLE" => "Количество изделий",
		"CATEGORY______________________________________TYPE" => "text",
		"CATEGORY______________________________________PLACEHOLDER" => "Количество изделий",
		"CATEGORY______________________________________VALUE" => "",
		"CATEGORY______________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY______________________________________IBLOCK_FIELD" => "NO_WRITE",
		"CATEGORY___________________________________________________________TITLE" => "Напишите, что нужно изготовить",
		"CATEGORY___________________________________________________________TYPE" => "text",
		"CATEGORY___________________________________________________________PLACEHOLDER" => "Напишите, что нужно изготовить",
		"CATEGORY___________________________________________________________VALUE" => "",
		"CATEGORY___________________________________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY___________________________________________________________IBLOCK_FIELD" => "FORM_Напишите, что нужно изготовить",
		"CATEGORY_____________________________________________________TITLE" => "Опишите применение изделия:",
		"CATEGORY_____________________________________________________TYPE" => "text",
		"CATEGORY_____________________________________________________PLACEHOLDER" => "Опишите применение изделия",
		"CATEGORY_____________________________________________________VALUE" => "",
		"CATEGORY_____________________________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_____________________________________________________IBLOCK_FIELD" => "NO_WRITE",
		"CATEGORY____________________________________TITLE" => "Контакты для связи",
		"CATEGORY____________________________________TYPE" => "text",
		"CATEGORY____________________________________PLACEHOLDER" => "Контакты для связи",
		"CATEGORY____________________________________VALUE" => "Контакты для связи",
		"CATEGORY____________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY____________________________________IBLOCK_FIELD" => "FORM_Контакты для связи",
		"CATEGORY_____________________________TITLE" => "Размер изделия",
		"CATEGORY_____________________________TYPE" => "text",
		"CATEGORY_____________________________PLACEHOLDER" => "",
		"CATEGORY_____________________________VALUE" => "",
		"CATEGORY_____________________________VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_____________________________IBLOCK_FIELD" => "FORM_Размер изделия",
		"CATEGORY_____________________________________TITLE" => "Количество изделий",
		"CATEGORY_____________________________________TYPE" => "text",
		"CATEGORY_____________________________________PLACEHOLDER" => "",
		"CATEGORY_____________________________________VALUE" => "",
		"CATEGORY_____________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_____________________________________IBLOCK_FIELD" => "FORM_Количество изделий",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CATEGORY_______________________________TITLE" => "Ваш комментарий",
		"CATEGORY_______________________________TYPE" => "textarea",
		"CATEGORY_______________________________PLACEHOLDER" => "",
		"CATEGORY_______________________________VALUE" => "",
		"CATEGORY_______________________________VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_______________________________IBLOCK_FIELD" => "FORM_Ваш комментарий",
		"CATEGORY_______________________________VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY_________________TITLE" => "Ваше Имя",
		"CATEGORY_________________TYPE" => "text",
		"CATEGORY_________________PLACEHOLDER" => "",
		"CATEGORY_________________VALUE" => "",
		"CATEGORY_________________VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY_________________IBLOCK_FIELD" => "FORM_Ваше Имя",
		"CATEGORY__________________________________TITLE" => "Телефон для связи",
		"CATEGORY__________________________________TYPE" => "text",
		"CATEGORY__________________________________PLACEHOLDER" => "",
		"CATEGORY__________________________________VALUE" => "",
		"CATEGORY__________________________________VALIDATION_ADDITIONALLY_MESSAGE" => "",
		"CATEGORY__________________________________IBLOCK_FIELD" => "FORM_Телефон для связи",
		"CATEGORY_________________VALIDATION_MESSAGE" => "Обязательное поле",
		"CATEGORY__________________________________VALIDATION_MESSAGE" => "Обязательное поле"
	),
	false
);?>

</div>                
<?php    

    if (!empty($arResult["DETAIL_TEXT"])){
        echo $arResult["DETAIL_TEXT"];
    } else {
        echo $arResult["PREVIEW_TEXT"];
    }
    ?>
    </div>
<!--<article class="article advantages-prod">
    <?/*
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        array(
            "AREA_FILE_SHOW" => "file",
            "EDIT_TEMPLATE" => "",
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => "/include/advantages.php",
        ),
        false
    );
    */?> </article>
<br>-->

<div style="clear: both;"></div>
<h2 class="production_steps_title">Этапы заказа изделий на производстве</h2>
<div class="production_steps_banner">
<img src="/images/production_banner.png?22052020" alt="Этапы производства Трайв-комплект" title="Этапы производства Трайв-комплект">
</div>


<br>
<? If ($arResult["PROPERTIES"]["TAGS"]["VALUE"]):?>
    <div class="tags">
        <p class="tag-title">Теги:</p>
        <?
        foreach ($arResult["PROPERTIES"]["TAGS"]["VALUE"] as $tagID):

            $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
            $arFilter = Array("IBLOCK_ID"=>40, "ID" => $tagID);

            $db_list = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

            while($ob = $db_list->GetNextElement()){

                $arProps = $ob->GetProperties();
                $tagword = $arProps["TAG_WORD"]["VALUE"];
                $tagurl = $arProps["TAG_URL"]["VALUE"];
            }
            ?>
            <div class="tag-word">
                <a href="<?=$tagurl?>"><?=$tagword?></a>
            </div>
        <? endforeach; ?>
    </div>
<? endif; ?>
<br>



    <?//show counter with session refresh
    session_start();
    if (!isset($_SESSION['counter'])) $_SESSION['counter'] = 0;

    $res = CIBlockElement::GetByID($arResult["ID"]);
    if($ar_res = $res->GetNext())
        $ar_res_hundred = $ar_res['SHOW_COUNTER'] + 100 + $_SESSION['counter']++;
    echo 'Просмотров: '.$ar_res_hundred;


    CModule::IncludeModule("iblock");
    if(CModule::IncludeModule("iblock")) {
        CIBlockElement::CounterInc($arResult["ID"]);
    }

    $ar_res['SHOW_COUNTER_START'] = substr( $ar_res['SHOW_COUNTER_START'], 0, -9);
    echo '<br>'.$ar_res['SHOW_COUNTER_START'];
    ?>


</div>

<!--<script>
    var slider = new MasterSlider();
    slider.control('timebar' ,{color:'#f90'});
    slider.control('arrows');
    slider.setup('masterslider' , {
        width:950,    // slider standard width
        height:350,   // slider standard height
        minHeight       : 0,
        space           : 0,
        start           : 1,
        grabCursor      : true,
        swipe           : true,
        mouse           : true,
        keyboard        : false,
        layout          : "boxed",
        wheel           : false,
        autoplay        : true,
        instantStartLayers:false,
        loop            : true,
        shuffle         : false,
        preload         : 0,
        heightLimit     : true,
        autoHeight      : false,
        smoothHeight    : true,
        endPause        : false,
        overPause       : true,
        fillMode        : "fill",
        centerControls  : true,
        startOnAppear   : false,
        layersMode      : "center",
        autofillTarget  : "",
        hideLayers      : false,
        fullscreenMargin: 0,
        speed           : 10,
        dir             : "h",
        parallaxMode    : 'swipe',
        view            : "fade"
    });
    // adds Arrows navigation control to the slider.

</script>-->

<noindex>
    <div class="yastatic_articles">
        Поделиться:
        <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
        <script src="//yastatic.net/share2/share.js"></script>
        <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,twitter,viber,whatsapp,skype,telegram"></div>
    </div>
</noindex>