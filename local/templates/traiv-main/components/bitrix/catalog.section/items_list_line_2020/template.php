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
/*if($arParams['CUSTOM_COUNT_SUBSECTIONS'] == 0){*/
$this->setFrameMode(true);

if(count($arResult['ITEMS'])){
    ?>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <? echo $arResult["NAV_STRING"]; ?>
    <? endif ?>

    <?

    $widthsizen="35";
    $heightsizen="35";

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
    <div class="list-line-titles">
        <div class="xol p3"><strong>№</strong></div>
        <div class="col x1d12"><strong> Фото</strong></div>
        <div class="col x3d10"><strong>Наименование</strong></div>
        <div class="col x1d10"><strong>Артикул</strong></div>
        <div class="col x1d10"><strong>Размер</strong></div>
        <div class="col x1d12"><strong>Материал</strong></div>
        <div class="col x1d8"><strong>Цена за шт.</strong></div>
        <div class="col x1d12"><strong>Кол-во</strong></div>
        <div class="col x1d12"><strong>Купить</strong></div>
    </div>
    <ul class="row traiv-catalog-line-default loadmore_wrap">
        <? foreach ($arResult['ITEMS'] as $index => $item): ?>

        <?
        $position = $index + 1;

        $this->AddEditAction($item['ID'], $item['EDIT_LINK'], $strElementEdit);
        $this->AddDeleteAction(
            $item['ID'],
            $item['DELETE_LINK'],
            $strElementDelete,
            $arElementDeleteParams);
        $strMainID = $this->GetEditAreaId($item['ID']);

        $origname = $item["NAME"];
        $formatedPACKname = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/","",$origname);
        $formatedname = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|Евр|Ев|PU=.*|RU=.*/","",$formatedPACKname);

        $BASE_PRICE = $item['PRICES']['BASE'];
        $originalPrice = intval($BASE_PRICE['VALUE']);
        $discontPrice = intval($BASE_PRICE['DISCOUNT_VALUE']);
        $printPriceValue = $originalPrice <= $discontPrice ?
            $BASE_PRICE['PRINT_VALUE']
            : $BASE_PRICE['PRINT_DISCOUNT_VALUE'];

        $printPriceValue = !empty($printPriceValue) ? $printPriceValue : 'по запросу';

        
        
        $label = '';
        $buttonLabel = 'Купить';
        /*   if($item['CAN_BUY'] and $item['PRODUCT']['QUANTITY'] > 0) {
               $label = 'В наличии';
               $buttonLabel = 'Добавить';
           }elseif($item['CAN_BUY'] and ($item['PRODUCT']['QUANTITY'] == 0)){
               $label = 'Под заказ';
               $buttonLabel = 'Заказать';
           }elseif (!$item['CAN_BUY'] and ($item['PRODUCT']['QUANTITY'] == 0)){
               $label = 'Уведомить о появлении';
               $buttonLabel = 'Уведомить о появлении';
           }else{
               $label = 'Цена и наличие по запросу';
               $buttonLabel = 'Запросить';
           } */

        $dlina = $item["PROPERTIES"]["DLINA_1"]["VALUE"];
        $diametr = $item["PROPERTIES"]["DIAMETR_1"]["VALUE"];
        $material = $item["PROPERTIES"]["MATERIAL_1"]["VALUE"];

        empty($dlina) && !empty($diametr) ? $diametr = 'd '.$diametr : ''
        ?>
<div class="item-list-container"><li class="col x1 x1--t x1--s" id='<?= $strMainID ?>'><div class="new-item-line loadmore_item"><div class="position-list xol p3"><?=$position.'. '?></div><div class="col x1d12 x1d8--m"><div class="new-item-line__image overflow-h"><?$checkUrl = str_replace('https://traiv-komplekt.ru','',$item['CANONICAL_PAGE_URL']);if ($item['DETAIL_PAGE_URL'] !== $checkUrl){$item['DETAIL_PAGE_URL'] = $checkUrl;}?><a href="<?= $item['DETAIL_PAGE_URL'] ?>" rel="<?php echo $item["CANONICAL_PAGE_URL"];?>"><?if(!empty($item['DETAIL_PICTURE']['SRC'])){$picturl = CFile::ResizeImageGet($item['DETAIL_PICTURE'],array('width'=>35, 'height'=>35), BX_RESIZE_IMAGE_PROPORTIONAL, true);?><img src="<?=$picturl['src']?>" alt="<?=$formatedname?>" id="<?=$item["ID"]?>"/>
<?}else{$db_groups = CIBlockElement::GetElementGroups($item['ID'], true);while($ar_group = $db_groups->Fetch()) {$getGroup = CIBlockSection::GetList(array(), array('ID' => $ar_group["ID"],"IBLOCK_ID"=>18), false, Array('UF_TAG_SECTION'));if($getGroupItem = $getGroup->GetNext()) {if ($getGroupItem['UF_TAG_SECTION'] !== '1'){$sect_id = $ar_group["ID"];}}}$rsElement1 = CIBlockSection::GetList(array(), array('ID' => $sect_id), false, array('ID', 'IBLOCK_SECTION_ID', 'PICTURE'));if($arElement1 = $rsElement1->Fetch()) {$pict = $arElement1['DETAIL_PICTURE']?$arElement['DETAIL_PICTURE']:$arElement1['PICTURE'];}$picturl = CFile::ResizeImageGet($pict,array('width'=>35, 'height'=>35), BX_RESIZE_IMAGE_PROPORTIONAL, true);?><img  src="<?= $picturl['src']?>" alt="<?= $formatedname?>" title="<?=$formatedname?>" id="<?=$item["ID"]?>"/><?}?></a></div></div><div class="new-item-line__header col x3d10 x3d4--m"><div class="new-item-line__title"><a href="<?= $item['DETAIL_PAGE_URL'] ?>" style="font-size:14px;"><?=$formatedname?></a></div></div><div class="col x1d10 size"><span><?php echo $item["PROPERTIES"]["CML2_ARTICLE"]["VALUE"];?></span></div><div class="col x1d10 size"><span><?=$dlina ? '<div style="display: inline-block">M </div> ' . $diametr.' x '.$dlina : $diametr?></span></div><div class="col x1d12 material"><span><nobr><?=$material?></nobr></span></div><div class="col x1d8 x1d3--m"><span class="new-item-line__price"><span><?if ($printPriceValue !== '0 руб.'){echo $printPriceValue;} else {?><a href="#w-form-one-click" class="btn new-item-line-buy opt"><div class="opt-btn-label">Запросить</div></a><?}?></span></span></div><div class="col x1d12 x1d3--m"><?$ymarket = $item["PROPERTIES"]["YMARKET"]["VALUE"];!$ymarket ? $pack = $item["PROPERTIES"]["KRATNOST_UPAKOVKI"]["VALUE"] : $pack = 1;!$pack && $pack = 1;?><input type="number" name='QUANTITY' class="quantity section_list" id="<?= $item["ID"]?>-item-quantity"  size="5" value="<?=$pack?>" step="<?=$pack?>" min="<?=$pack?>"></div><div class="col x1d12 x1d3--m list-cart"><?php if($item['CAN_BUY']) {$item['~ADD_URL'] .= '&QUANTITY=';?><a data-href="<?= str_replace("index.php", "", $item['~ADD_URL']); ?>" class="btn new-item-line-buy" data-ajax-order><img src="/img/ico/cart-30x25.png"><div class="buy-btn-label"><?= $buttonLabel ?></div></a>
                        <?}
                        elseif (($arParams['PRODUCT_SUBSCRIPTION'] === 'Y') || ($item['CATALOG_SUBSCRIBE'] === 'Y')){}?></div></div><div class="clear"></li></div>
            <?endforeach;?></ul></div>
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
		"CATEGORY_PHONE_INPUTMASK" => "N",
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "",
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



    <?php   $bxajaxid = CAjax::GetComponentID($component->__name, $component->__template->__name, $component->arParams['AJAX_OPTION_ADDITIONAL']);
    ?>
    <?if($arResult["NAV_RESULT"]->nEndPage > 1 && $arResult["NAV_RESULT"]->NavPageNomer<$arResult["NAV_RESULT"]->nEndPage):?>
        <div id="btn_<?=$bxajaxid?>" class="load_more">
            <a data-ajax-id="<?=$bxajaxid?>" href="javascript:void(0)" data-show-more="<?=$arResult["NAV_RESULT"]->NavNum?>" data-next-page="<?=($arResult["NAV_RESULT"]->NavPageNomer + 1)?>" data-max-page="<?=$arResult["NAV_RESULT"]->nEndPage?>"><div class="btn show-more-btn">Показать еще</div></a>
        </div>
    <?endif?>

<?}?>

<?$db_list = CIBlockSection::GetList(Array(), $arFilter = Array("IBLOCK_ID"=>18, "ID"=>$arResult["ID"]), true, Array("UF_RECOMEND", "UF_CANONICAL", "UF_LONGTEXT")); $props_array = $db_list->GetNext();


if (!empty($props_array["UF_CANONICAL"])) {
    $arResult['UF_CANONICAL'] = $props_array["UF_CANONICAL"];

    //  echo $arResult['UF_CANONICAL'];

}?>


<?
if (!empty($props_array["UF_RECOMEND"])) {
    //echo '2';
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
