<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$countSubsections = 0;

$_section = (new CIBlockSection)->GetList(
    Array("SORT"=>"ASC"),
    [
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            'CODE' => $arResult['VARIABLES']['SECTION_CODE']
    ]
);

if($_section = $_section->Fetch()){
    //есть ли подразделы?
    $countSubsections = (new CIBlockSection)->GetCount(
        [
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            'SECTION_ID' => $_section['ID']
        ]
    );
}

$countElementsInSection = (new CIBlockSection)->GetSectionElementsCount(
    $_section['ID'],
    [
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'CNT_ACTIVE' => 'Y'
    ]
);
                    $rsParentSection = CIBlockSection::GetByID($arResult["VARIABLES"]["SECTION_ID"]);
                    if ($arParentSection = $rsParentSection->GetNext())
                    {
                    $arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'],'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']); // выберет потомков без учета активности
                    $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
                        $CountDatBrokenSheet = 0;
                    while ($arSect = $rsSect->GetNext())
                    {
                        $CountDatBrokenSheet++;
                    }
                    }
?>
<div class="content">
	<div class="container">
		<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv.production", array(
	"COMPONENT_TEMPLATE" => "traiv",
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
); ?>
        <? if ($isFilter and !$countSubsections): ?>
		<aside class="aside">

				<? $APPLICATION->IncludeComponent(
	"bitrix:catalog.smart.filter",
	"",
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "18",
		"SECTION_ID" => $arCurSection["ID"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => "N",
		"SAVE_IN_SESSION" => "N",
		"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
		"XML_EXPORT" => "N",
		"SECTION_TITLE" => "NAME",
		"SECTION_DESCRIPTION" => "DESCRIPTION",
		"HIDE_NOT_AVAILABLE" => "N",
		"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => $arParams["CURRENCY_ID"],
		"SEF_MODE" => "Y",
		"SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
		"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"INSTANT_RELOAD" => "N",
		"DISPLAY_ELEMENT_COUNT" => "Y",
		"SECTION_CODE" => $arCurSection["SECTION_CODE"],
		"SECTION_CODE_PATH" => "",
		"COMPONENT_TEMPLATE" => "section_filter"
	),
	false,
	array(
		"HIDE_ICONS" => "N",
		"ACTIVE_COMPONENT" => "Y"
	)
); ?>


			<? $APPLICATION->IncludeComponent(
				"bitrix:menu",
				"catalog_left_menu",
				array(
					"COMPONENT_TEMPLATE" => "catalog_left_menu",
					"ROOT_MENU_TYPE" => "catalog_left_menu",
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_CACHE_GET_VARS" => array(),
					"MAX_LEVEL" => "1",
					"CHILD_MENU_TYPE" => "left",
					"USE_EXT" => "N",
					"DELAY" => "N",
					"ALLOW_MULTI_SELECT" => "N"
				),
				false
			); ?>

			<div class="u-none--m">
				<? if (SHOW_VK_WIDGET): ?>
					<script type="text/javascript" src="//vk.com/js/api/openapi.js?127"></script>
					<div id="vk_groups"></div>
					<script type="text/javascript">
						VK.Widgets.Group(
							"vk_groups",
							{
								redesign: 1,
								mode: 4,
								width: "auto",
								height: "400",
								color1: 'FFFFFF',
								color2: '000000',
								color3: '5E81A8'
							},
                            47382243);
					</script>
				<? endif ?>

			</div>
		</aside>
        <? endif; //isFilter?>

        <?//form for empty items categories

        /*
If ($countElementsInSection == 0 and $CountDatBrokenSheet == 0){

    ?>
    <div class="Order_one_click" >
        <a href="#callback-form" rel="nofollow" class="btn-mfp-dialog">Заказать в 1 клик <?//echo $ButtonName?></a>
        <div id='callback-form' class="popup-dialog mfp-hide">
            <?$APPLICATION->IncludeComponent(
                "bitrix:form.result.new",
                "one_click_catalog_default",
                array(
                    "NAME" => "Заказать в 1 клик ",
                    "COMPONENT_TEMPLATE" => "one_click_catalog_default",
                    "ELEMENT_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                    "WEB_FORM_ID" => "10",
                    "IGNORE_CUSTOM_TEMPLATE" => "Y",
                    "USE_EXTENDED_ERRORS" => "Y",
                    "SEF_MODE" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "LIST_URL" => "",
                    "EDIT_URL" => "",
                    "SUCCESS_URL" => "/success.php",
                    "CHAIN_ITEM_TEXT" => "",
                    "CHAIN_ITEM_LINK" => "",
                    "VARIABLE_ALIASES" => array(
                        "WEB_FORM_ID" => "WEB_FORM_ID",
                        "RESULT_ID" => "RESULT_ID",
                    )
                ),
                false
            );?>
            <script defer src='<?=SITE_TEMPLATE_PATH."/js/one_click_form.js"?>'></script>
        </div>
    </div>
    <?
}

*/
        ?>

        <div class='subsection'>
            <?
            $arFilter = Array("IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"], "IBLOCK_ID" => $arParams["IBLOCK_ID"], "CODE" => $arResult["VARIABLES"]["SECTION_CODE"]);
            $arSelect = Array('UF_PREVIEW_TEXT', 'NAME', 'DESCRIPTION', 'UF_TERM', 'UF_LONGTEXT', 'UF_COUNTER', 'UF_HEADER_FIRST', 'UF_HEADER_SECOND');
            $db_list = CIBlockSection::GetList(Array(), $arFilter, true, $arSelect);
            if ($section = $db_list->GetNext()) {

                if(!($_REQUEST['PAGEN_1'] > 1) and (!empty($section["~UF_PREVIEW_TEXT"]))){

                    echo '<h3 class="uf_header_first">' . $section['UF_HEADER_FIRST'] . '</h3>';
                    echo '<div class="preview">' . $section["~UF_PREVIEW_TEXT"] . '</div>' ;
                    echo '<h4 class="uf_header_second">' . $section['UF_HEADER_SECOND'] . '</h4>';
                }

                // $s = CIBlockElement::GetByID($section['UF_TERM']);
                // if($s = $s->GetNext()){
                ?>
                <!--  <script>
                                       // $('.crumbs__item.is-active').append('&nbsp;<a target="_blank" href="<?//=$s['DETAIL_PAGE_URL']?>"><i class="fa fa-question-circle" aria-hidden="true"></i></a>');
                                    </script> -->
                <?

                //   }

            }

            ?>



			<section class="section">




					<?
/*					if($_REQUEST["catalog_items_in_list"]=="y"){
						$_SESSION["catalog_items_in_list"]="y";
					}elseif($_REQUEST["catalog_items_in_list"]=="n"){
						$_SESSION["catalog_items_in_list"]="n";
					}else{
						if(empty($_SESSION["catalog_items_in_list"])){
							$_SESSION["catalog_items_in_list"]="n";
						}
					}*/



					if(!empty($_REQUEST["PAGE_COUNT"]) && $_REQUEST["PAGE_COUNT"]<100){
						$arParams["PAGE_ELEMENT_COUNT"]=$_SESSION["PAGE_COUNT"]=$_REQUEST["PAGE_COUNT"];
					}
					if(!empty($_SESSION["PAGE_COUNT"])) {
						$arParams["PAGE_ELEMENT_COUNT"] = $_SESSION["PAGE_COUNT"];
					}





/*					if($_SESSION["catalog_items_in_list"]=="y"){*/
						$template = "production_items_list_line";
/*					}else{
						$template = "production_items_list";
					}*/



                    if($CountDatBrokenSheet > 0) {
                        //показ подкатегорий
                        if(!($_REQUEST['PAGEN_1'] > 1)){
                            $APPLICATION->IncludeComponent(
                                "bitrix:catalog.section.list",
                                "catalog_page",
                                array(
                                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                    "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
                                    "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
                                    "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                                    "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                                    "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                                    "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                                    "ADD_SECTIONS_CHAIN" => 'N',//(isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
                                    "SECTION_ID" => CIBlockFindTools::GetSectionID(
                                        $arResult["VARIABLES"]["SECTION_ID"],
                                        $arResult["VARIABLES"]["SECTION_CODE"],
                                        array("IBLOCK_ID" => $arParams["IBLOCK_ID"])
                                    )
                                ),
                                $component
                            );
                        }
                    }

                    if ($_POST['AJAX_MODE']=='Y') $APPLICATION->RestartBuffer();

                    $intSectionID = $APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        $template,
                        array(
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                            "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                            "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                            "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                            "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                            "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                            "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                            "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                            "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                            "BASKET_URL" => $arParams["BASKET_URL"],
                            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                            "FILTER_NAME" => $arParams["FILTER_NAME"],
                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                            "SET_TITLE" => $arParams["SET_TITLE"],
                            "MESSAGE_404" => $arParams["MESSAGE_404"],
                            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                            "SHOW_404" => $arParams["SHOW_404"],
                            "FILE_404" => $arParams["FILE_404"],
                            "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                            "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                            "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                            "PRICE_CODE" => $arParams["PRICE_CODE"],
                            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                            "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                            "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                            "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

                            "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                            "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                            "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                            "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                            "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                            "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                            "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                            "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

                            "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                            "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                            "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                            "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                            "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                            "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                            "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                            "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

                            "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                            "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                            "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                            "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
                            "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                            'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                            'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                            'SECTION_USER_FIELDS' => array(0 => 'UF_CANONICAL', 1 => '',),
                            'LABEL_PROP' => $arParams['LABEL_PROP'],
                            'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                            'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

                            'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                            'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                            'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                            'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
                            'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
                            'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
                            'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
                            'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

                            'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                            "ADD_SECTIONS_CHAIN" => $arParams['ADD_SECTIONS_CHAIN'],
                            'ADD_TO_BASKET_ACTION' => $basketAction,
                            'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                            'COMPARE_PATH' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
                            'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
                            'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
                            "CUSTOM_COUNT_SUBSECTIONS" => $countSubsections
                        ),
                        $component
                    );

                    if ($_POST['AJAX_MODE']=='Y') die();


					?>


				</div>
			</section>

        <div class="container">
            <?if($section["DESCRIPTION"]){?>
            <article class="article">
                <?=$section["DESCRIPTION"];?>
            </article>
            <article class="article advantages-prod">
                <?
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
                ?> </article>
        </div>



	</div>

	<div class="container">

		<section class="section">
			<? /*$APPLICATION->IncludeComponent("bitrix:news.list", "catalog_partners", Array(
				"COMPONENT_TEMPLATE" => ".default",
				"IBLOCK_TYPE" => "content", // Тип информационного блока (используется только для проверки)
				"IBLOCK_ID" => "8", // Код информационного блока
				"NEWS_COUNT" => "20", // Количество новостей на странице
				"SORT_BY1" => "SORT", // Поле для первой сортировки новостей
				"SORT_ORDER1" => "ASC", // Направление для первой сортировки новостей
				"SORT_BY2" => "ACTIVE_FROM",  // Поле для второй сортировки новостей
				"SORT_ORDER2" => "DESC",  // Направление для второй сортировки новостей
				"FILTER_NAME" => "",  // Фильтр
				"FIELD_CODE" => array(  // Поля
					0 => "",
					1 => "",
				),
				"PROPERTY_CODE" => array( // Свойства
					0 => "",
					1 => "",
				),
				"CHECK_DATES" => "Y", // Показывать только активные на данный момент элементы
				"DETAIL_URL" => "", // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
				"AJAX_MODE" => "N", // Включить режим AJAX
				"AJAX_OPTION_JUMP" => "N",  // Включить прокрутку к началу компонента
				"AJAX_OPTION_STYLE" => "N", // Включить подгрузку стилей
				"AJAX_OPTION_HISTORY" => "N", // Включить эмуляцию навигации браузера
				"AJAX_OPTION_ADDITIONAL" => "", // Дополнительный идентификатор
				"CACHE_TYPE" => "A",  // Тип кеширования
				"CACHE_TIME" => "36000000", // Время кеширования (сек.)
				"CACHE_FILTER" => "N",  // Кешировать при установленном фильтре
				"CACHE_GROUPS" => "Y",  // Учитывать права доступа
				"PREVIEW_TRUNCATE_LEN" => "", // Максимальная длина анонса для вывода (только для типа текст)
				"ACTIVE_DATE_FORMAT" => "d.m.Y",  // Формат показа даты
				"SET_TITLE" => "N", // Устанавливать заголовок страницы
				"SET_BROWSER_TITLE" => "N", // Устанавливать заголовок окна браузера
				"SET_META_KEYWORDS" => "N", // Устанавливать ключевые слова страницы
				"SET_META_DESCRIPTION" => "N",  // Устанавливать описание страницы
				"SET_LAST_MODIFIED" => "N", // Устанавливать в заголовках ответа время модификации страницы
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N", // Включать инфоблок в цепочку навигации
				"ADD_SECTIONS_CHAIN" => "N",  // Включать раздел в цепочку навигации
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",  // Скрывать ссылку, если нет детального описания
				"PARENT_SECTION" => "", // ID раздела
				"PARENT_SECTION_CODE" => "",  // Код раздела
				"INCLUDE_SUBSECTIONS" => "Y", // Показывать элементы подразделов раздела
				"DISPLAY_DATE" => "N",  // Выводить дату элемента
				"DISPLAY_NAME" => "Y",  // Выводить название элемента
				"DISPLAY_PICTURE" => "Y", // Выводить изображение для анонса
				"DISPLAY_PREVIEW_TEXT" => "N",  // Выводить текст анонса
				"PAGER_TEMPLATE" => ".default", // Шаблон постраничной навигации
				"DISPLAY_TOP_PAGER" => "N", // Выводить над списком
				"DISPLAY_BOTTOM_PAGER" => "N",  // Выводить под списком
				"PAGER_TITLE" => "Новости", // Название категорий
				"PAGER_SHOW_ALWAYS" => "N", // Выводить всегда
				"PAGER_DESC_NUMBERING" => "N",  // Использовать обратную навигацию
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000", // Время кеширования страниц для обратной навигации
				"PAGER_SHOW_ALL" => "N",  // Показывать ссылку "Все"
				"PAGER_BASE_LINK_ENABLE" => "N",  // Включить обработку ссылок
				"SET_STATUS_404" => "N",  // Устанавливать статус 404
				"SHOW_404" => "N",  // Показ специальной страницы
				"MESSAGE_404" => "",  // Сообщение для показа (по умолчанию из компонента)
			),
				false
			); */?>

                <?
                If ($section["UF_LONGTEXT"]){
                echo '<div class="section_description">' . $section["~UF_LONGTEXT"] . '</div>' ; ?>
                    <?}?>
			<?}?>
            <div class="counter_one">
                <?//show counter from counter.php

                echo 'Просмотров: '.$section['UF_COUNTER'];

                ?>
            </div>

        </section>
    </div>
</div>