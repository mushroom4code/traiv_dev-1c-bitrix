<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

$this->addExternalJS("/local/templates/traiv-main/js/jquery-ui.js");

$buttonLabel = 'Купить';

If ($arResult['ORIGINAL_PARAMETERS']['GLOBAL_FILTER']['=PROPERTY_606'] ||
    $arResult['ORIGINAL_PARAMETERS']['GLOBAL_FILTER']['=PROPERTY_610'] ||
    $arResult['ORIGINAL_PARAMETERS']['GLOBAL_FILTER']['=PROPERTY_612'] ||
    $arResult['ORIGINAL_PARAMETERS']['GLOBAL_FILTER']['=PROPERTY_613'] ||
    $arResult['ORIGINAL_PARAMETERS']['GLOBAL_FILTER']['=PROPERTY_624']
) :    $isKomboxFilter = 'Y';
endif;
//Вывод сертификата


$rsResult = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 18, "ID" =>$arResult["ID"]), false, Array("UF_SERTIFICAT")); $temp_array = $rsResult->GetNext();
?>
<? (CSite::InDir('/catalog/rasprodazha_so_sklada/')) ? $flag = 'sale': $flag = '';?>


<div class="sertimg <?=$flag?>"><?
    foreach($temp_array["UF_SERTIFICAT"] as $what):?>
        <?$SERT=CFile::GetFileArray($what); ?>


        <a href="<?echo ($SERT["SRC"]);?>" title="<?$strKb = $SERT['FILE_SIZE']/1024; echo round($strKb).' Кб';?>">
            <?$f=$SERT['SRC'];$p=pathinfo($f);$pdf=array($p['extension']);if(in_array('pdf',$pdf)):?><tr><td><img src="/images/gost/pdf.png" width="24px" class="lazy"><?echo $SERT['ORIGINAL_NAME'];?></td></tr><?else:?><?endif;?>
            <?$f=$SERT['SRC'];$p=pathinfo($f);$doc=array($p['extension']);if(in_array('doc',$doc)):?><tr><td><img src="/images/gost/doc.png" width="24px" class="lazy"><?echo $SERT['ORIGINAL_NAME'];?></td></tr><?else:?><?endif;?></a>
        <br>
    <?endforeach?>

</div>
<?

$page_title = $APPLICATION->GetDirProperty("TITLE");

?>

<?
//Вывод рекомендованных категорий

$db_list = CIBlockSection::GetList(Array(), $arFilter = Array("IBLOCK_ID"=>18, "ID"=>$arResult["ID"]), true, Array("UF_RECOMEND", "UF_CANONICAL", "UF_LONGTEXT")); $props_array = $db_list->GetNext();


if (!empty($props_array["UF_CANONICAL"])) {
    $arResult['UF_CANONICAL'] = $props_array["UF_CANONICAL"];

    //echo $arResult['UF_CANONICAL'];

}


/*if($arParams['CUSTOM_COUNT_SUBSECTIONS'] == 0 or isset($isKomboxFilter)){*/

    $this->setFrameMode(true);
    if (($arParams["DISPLAY_BOTTOM_PAGER"]) and count($arResult['ITEMS'])): ?>
        <? echo $arResult["NAV_STRING"]; ?>
    <? endif ?>


    <?
    $widthsizen="120";
    $heightsizen="120";

    $arFileTmpn = CFile::ResizeImageGet(
        $arResult['PICTURE'],
        array("width" => $widthsizen, "height" => $heightsizen),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true, $arFilter
    );

    $arResult['LIST_PICT'] = array(
        'SRC' => $arFileTmpn["src"],
        'WIDTH' => $arFileTmpn["width"],
        'HEIGHT' => $arFileTmpn["height"],
    );
    ?>

    <ul class="row loadmore_wrap">
        <? foreach ($arResult['ITEMS'] as $item):

            //    echo '<pre>'; print_r($item['PROPERTIES']['ACTION']['VALUE']); echo '</pre>';

            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], $strElementEdit);
            $this->AddDeleteAction(
                $item['ID'],
                $item['DELETE_LINK'],
                $strElementDelete,
                $arElementDeleteParams);


            $origname = $item["NAME"];
            $formatedPACKname = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/","",$origname);
            $formatedname = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|Ев|PU=S|PU=K|RU=S|RU=K|PU=К/","",$formatedPACKname);


            $pack = $item['PROPERTIES']['UPAKOVKA_VINTI']['VALUE'];

            IF (!empty($pack)) {

                $db_measure = CCatalogMeasureRatio::getList(array(), $arFilter = array('PRODUCT_ID' => $item["ID"]), false, false);  // получим единицу измерения только что созданного товара

                $ar_measure = $db_measure->fetch();

                $ar_measure = CCatalogMeasureRatio::update($ar_measure['ID'], array("PRODUCT_ID" => $item["ID"], "RATIO" => $pack));

            }

            $standart = $item['PROPERTIES']['STANDART']['VALUE'];
            $diametr = $item['PROPERTIES']['DIAMETR_1']['VALUE'];
            $dlina = $item['PROPERTIES']['DLINA_1']['VALUE'];
            $material = $item['PROPERTIES']['MATERIAL_1']['VALUE'];
            $pokrytie = $item['PROPERTIES']['POKRYTIE_1']['VALUE'];


            ?><div class="col x1d4 x1d3--md x1d2--s x1--xs" id='<?= $strMainID ?>'>
            <div class="new-item">

                <?if ($item['PROPERTIES']['ACTION']['VALUE']){?>

                    <div class="bx_stick average left top"></div>

                <?}?>

                <a href="<?= $item['DETAIL_PAGE_URL'] ?>">

                    <div class="new-item__header-properties">
                        <?

                        if (!empty($standart)) echo 'Стандарт: '.$standart.'<br>';
                        if (!empty($diametr) & !empty ($dlina)) {echo 'Размер: '.'<div style="display: inline-block">'.'M '. '</div> '  .$diametr.' x '. $dlina.'<br>' ;}
                        else
                        {
                            if (!empty($diametr)) echo 'Диаметр: '.$diametr.'<br>';
                            if (!empty($dlina)) echo 'Длина: '.$dlina.'<br>';
                        };
                        if (!empty($material)) echo 'Материал: '.$material.'<br>';
                        if (!empty($pokrytie)) echo 'Покрытие: '.$pokrytie.'<br>';


                        ?>
                    </div>


                    <!--div class="catalog-item__state"><?=$item['RES_MOD']['label']?></div-->

                    <div class="new-item__image" id="img_<?=$item["ID"]?>"> <!--  catalog-item__image class for fix animation  -->

                        <?//*Вывод изображения стандарт**///?>
                        <?if (!empty($item['DETAIL_PICTURE']['SRC'])):?>
                            <img src="<?=$item['DETAIL_PICTURE']['SRC']?>" alt="<?=$formatedname?>" title="<?=$formatedname?>" id="<?=$item["ID"]?>" class="lazy">
                        <?else :?>

                            <?//*Вывод изображения из каталога**///
                            $rsElement = CIBlockElement::GetList(array(), array('ID' => $item['ID']), false, false, array('ID', 'IBLOCK_SECTION_ID', 'DETAIL_PICTURE'));
                            if($arElement = $rsElement->Fetch())


                                $rsElement = CIBlockSection::GetList(array(), array('ID' => $arElement['IBLOCK_SECTION_ID']), false, array('ID', 'IBLOCK_SECTION_ID', 'PICTURE'));
                            if($arElement = $rsElement->Fetch())

                                $pict = $arElement['DETAIL_PICTURE'] ? $arElement['DETAIL_PICTURE'] : $arElement['PICTURE'];

                            $picturl = CFile::ResizeImageGet($pict,array('width'=>120, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                            ?>
                            <img   class="lazy"
                                    src="<?= $picturl['src'] //? $item['DETAIL_PICTURE']['SRC'] : '/images/no_image.png') ?>"
                                    alt="<?= $formatedname ?>" title="<?=$formatedname?>" id="<?=$item["ID"]?>">
                        <? endif ?>

                    </div>
                    <div class="new-item__title" >
                        <?= $formatedname ?>
                    </div>
                </a>
                <div class="new-item__price">Цена: <?if ($item["PRICES"]["BASE"]["VALUE"] == 0):
                        ?><a href="#w-form-one-click" class="new-item__buy-btn opt"><!--<img src="/img/ico/letter-43x25.png">--><div class="opt-btn-label">Запросить</div></a><?

                    else:
                        echo $item["PRICES"]["BASE"]["VALUE"]. ' р.';?>

                    <?endif?></div>

                <div class="new-item__footer">

                    <?$ymarket = $item["PROPERTIES"]["YMARKET"]["VALUE"];?>
                    <? !$ymarket ? $pack = $item["PROPERTIES"]["KRATNOST_UPAKOVKI"]["VALUE"] : $pack = 1;
                        !$pack && $pack = 1;
                    ?>

                    <input type="number" name='QUANTITY' class="quantity section_list col x1d3" id="<?= $item["ID"]?>-item-quantity"  size="5" value="<?=$pack?>" step="<?=$pack?>" min="<?=$pack?>">

                    <!--     <div class="catalog-item__hidden">   -->
                    <?php if($item['CAN_BUY']): ?>
                        <?$item['~ADD_URL'] .= '&QUANTITY=';?>
                        <a data-href="<?= $item['~ADD_URL'] ?>" class="new-item__buy-btn col x2d3" data-ajax-order><img src="/img/ico/cart-30x25.png"><div class="buy-btn-label"><?= $buttonLabel ?></div></a>
                    <? elseif(($arParams['PRODUCT_SUBSCRIPTION'] === 'Y') || ($item['CATALOG_SUBSCRIBE'] === 'Y')): ?>
                        <?/*php
                        $APPLICATION->IncludeComponent(
                            'bitrix:catalog.product.subscribe',
                            '',
                            array(
                                'PRODUCT_ID' => $item['ID'],
                                'BUTTON_ID' => $item['SUBSCRIBE_URL'],
                                'BUTTON_CLASS' => 'btn',
                                'DEFAULT_DISPLAY' => !$item['CAN_BUY'],
                            ),
                            $component,
                            array('HIDE_ICONS' => 'Y')
                        );
                       */ ?>
                    <? endif ?>
                    <!--       </div>     -->



                </div>
            </div>
            </div><?
        endforeach; ?>
    </ul>
    <ul class="row loadmore_wrap"></ul>

<a href="#x" class="w-form__overlay-one-click" id="w-form-one-click"></a>
<div class="w-form__popup-one-click">
    <?$APPLICATION->IncludeComponent(
        "slam:easyform",
        "traiv",
        array(
            "COMPONENT_TEMPLATE" => "traiv",
            "FORM_ID" => "FORM4",
            "FORM_NAME" => "Оптовая цена",
            "WIDTH_FORM" => "500px",
            "DISPLAY_FIELDS" => array(
                0 => "TITLE",
                1 => "EMAIL",
                2 => "PHONE",
                3 => "MESSAGE",
                4 => "HIDDEN",
                5 => "",
            ),
            "REQUIRED_FIELDS" => array(
                0 => "TITLE",
                1 => "EMAIL",
                2 => "PHONE",
                3 => "MESSAGE",
            ),
            "FIELDS_ORDER" => "TITLE,EMAIL,PHONE,MESSAGE,HIDDEN",
            "FORM_AUTOCOMPLETE" => "Y",
            "HIDE_FIELD_NAME" => "N",
            "HIDE_ASTERISK" => "N",
            "FORM_SUBMIT_VALUE" => "Отправить",
            "SEND_AJAX" => "Y",
            "SHOW_MODAL" => "Y",
            "_CALLBACKS" => "",
            "TITLE_SHOW_MODAL" => "Спасибо!",
            "OK_TEXT" => "Ваше сообщение отправлено. Мы свяжемся с вами в течение ближайшего рабочего часа",
            "ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
            "ENABLE_SEND_MAIL" => "Y",
            "CREATE_SEND_MAIL" => "",
            "EVENT_MESSAGE_ID" => array(
            ),
            "EMAIL_TO" => "info@traiv-komplekt.ru",
            "EMAIL_BCC" => "makarov@traiv.ru",
            "MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы обратной связи ОПТОВАЯ ЦЕНА",
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
            "CATEGORY_MESSAGE_TYPE" => "textarea",
            "CATEGORY_MESSAGE_PLACEHOLDER" => "",
            "CATEGORY_MESSAGE_VALUE" => "",
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
            "IBLOCK_ID" => "37",
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
            //  "ELEMENT_ID" => $item['ID'],
            //  "FORMATED_NAME" => $formatedname,
            "CATEGORY_MESSAGE_VALIDATION_MESSAGE" => "Обязательное поле",
            "CATEGORY_HIDDEN_TITLE" => "Скрытое поле",
            "CATEGORY_HIDDEN_TYPE" => "hidden",
            "CATEGORY_HIDDEN_VALUE" => "",
            "CATEGORY_HIDDEN_IBLOCK_FIELD" => "FORM_HIDDEN"
        ),
        false
    );?>
    <a class="w-form__close" title="Закрыть" href="#w-form__close"></a>
</div>


    <?  $bxajaxid = CAjax::GetComponentID($component->__name, $component->__template->__name, $component->arParams['AJAX_OPTION_ADDITIONAL']);

    if($arResult["NAV_RESULT"]->nEndPage > 1 && $arResult["NAV_RESULT"]->NavPageNomer<$arResult["NAV_RESULT"]->nEndPage):?>
    <div id="btn_<?=$bxajaxid?>" class="load_more">
        <a data-ajax-id="<?=$bxajaxid?>" href="javascript:void(0)" data-show-more="<?=$arResult["NAV_RESULT"]->NavNum?>" data-next-page="<?=($arResult["NAV_RESULT"]->NavPageNomer + 1)?>" data-max-page="<?=$arResult["NAV_RESULT"]->nEndPage?>"><div class="btn show-more-btn">Показать еще</div></a>
    </div>
    <?endif?>

    <? if (($arParams["DISPLAY_BOTTOM_PAGER"]) and count($arResult['ITEMS'])): ?>
            <!--        <?/* if ($arResult["NAV_RESULT"]->nEndPage > 1):*/?>
            <div id="traiv-catalog-section-link-more">Показать ещё +</div>
        --><?/* endif*/?>
        <div class="bottom-nav">
            <? echo $arResult["NAV_STRING"]; ?>
        </div>
    <? endif ?>

<?php
/*}*/?>
<?
if (!empty($props_array["UF_RECOMEND"])) {
    $rsSections = CIBlockSection::GetList(
        array("SORT" => "ASC"),
        array("IBLOCK_ID" => $IBLOCK_ID, "ACTIVE" => "Y", "ID" => $props_array["UF_RECOMEND"]),
        false,
        array("NAME", "DETAIL_PICTURE", "PICTURE", "SECTION_PAGE_URL"),
        false
    );

    ?>

    <div class="analogues">
        <h2 class="recomend-title">Аналоги:</h2>
        <ul class="recomended">
            <?
            while ($arSections = $rsSections->GetNext()) {
                ?>

                <?   $widthsizen="150";
                $heightsizen="150";

                $arFileRecTmpn = CFile::ResizeImageGet(
                    $arSections['PICTURE'],
                    array("width" => $widthsizen, "height" => $heightsizen),
                    BX_RESIZE_IMAGE_PROPORTIONAL,
                    true, $arFilter
                );

                ?>



                <li class="col x1d4 x1d4--md x1d2--s x1--xs">
                    <div class="catalog-item-rec">
                        <div class="catalog-item__image">
                            <img src="<?= $arFileRecTmpn['src']?>" class="recomend-img-art lazy" alt="<?= $arSections['NAME'] ?>" title="<?= $arSections['NAME'] ?>">
                        </div>
                        <div class="catalog-item__title" >
                            <h4><a href="<?= $arSections['SECTION_PAGE_URL'] ?>"><?= $arSections['NAME'] ?>  </a></h4>
                        </div>
                    </div>
                </li>

                <?
            }
            ?>
        </ul>
        <p>Обозначение "Аналог товара" - не является на 100% гарантией, что аналог будет точной копией исходного изделия (по техническим параметрам, по цветовой палитре и т.д.).
            Для избежания ошибок, рекомендуем Вам проконсультироваться с <a href="#w-form-recall" >нашими специалистами.</a></p>
        <br>
        Информация, представленная на сайте носит справочных характер, и не является публичной офертой.</p>
    </div>
    <?
}
?>
<script>
    $(window).on('load', function() {
        var counter;
        var counter = <?=$arResult["ID"] ?>;

        $.ajax({
            type: 'POST',
            url: "/local/templates/traiv-main/components/bitrix/catalog.section/items_list_2020/counter.php",
            data: {
                counter:counter
            },
            success: function(){

                console.log(' ');
            }

        });

    })

</script>
