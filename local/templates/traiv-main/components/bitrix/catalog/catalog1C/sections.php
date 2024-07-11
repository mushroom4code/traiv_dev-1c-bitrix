<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
global $arrFilter;

if (!empty($_GET['tip_tovara'] || $_GET['standart'] || $_GET['diametr_1'] || $_GET['dlina_1'] || $_GET['material_1'] || $_GET['measurment'])) {$isGetFilter = 'Y';};

?>

<div class="content">
    <div class="container">
        <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
            "COMPONENT_TEMPLATE" => ".default",
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => "zf",
        ),
            false
        ); ?>
        <? /* comments Ivan
		<aside class="aside">
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
				<? endif ?>
			</div>
		</aside>

             */ ?>

        <?

	$rel = "style='display:none;'";
	/*if ( $USER->IsAuthorized() )
	{
	    if ($USER->GetID() == '3092' || $USER->GetID() == '1788' || $USER->GetID() == '2743' || $USER->GetID() == '3959' ) {*/
	        $rel = "style='position:relative;'";
	        $sl = "class='spaced-left'";
/*	    }
	}*/
	?>
        
        <aside class="aside" <?php echo $rel;?>>

        <?
/*if ( $USER->IsAuthorized() )
	{
	    if ($USER->GetID() == '3092' || $USER->GetID() == '1788' || $USER->GetID() == '2743' || $USER->GetID() == '3959' ) {*/
	        
	        $APPLICATION->IncludeComponent(
	"kombox:filter", 
	"vertical_left", 
	array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"HIDE_NOT_AVAILABLE" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => "N",
		"SAVE_IN_SESSION" => "N",
		"INCLUDE_JQUERY" => "Y",
		"MESSAGE_ALIGN" => "LEFT",
		"MESSAGE_TIME" => "0",
		"IS_SEF" => "N",
		"CLOSED_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"CLOSED_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SORT" => "N",
		"FIELDS" => array(
		),
		"PRICE_CODE" => array(
		),
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => $arParams["CURRENCY_ID"],
		"XML_EXPORT" => "Y",
		"SECTION_TITLE" => "NAME",
		"SECTION_DESCRIPTION" => "DESCRIPTION",
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"COMPONENT_TEMPLATE" => "vertical_left",
		"PAGE_URL" => "",
		"COLUMNS" => "1",
		"STORES_ID" => array(
		),
		"THEME" => "red",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);

/*	    }
	}*/
	?>  

            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "catalog_left_menu",
                array(
                    "COMPONENT_TEMPLATE" => "catalog_left_menu",
                    "ROOT_MENU_TYPE" => "catalog_left_menu",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "MENU_CACHE_GET_VARS" => "",
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N",
                    "CACHE_SELECTED_ITEMS" => "N",
                    "MENU_CACHE_USE_USERS" => "N",
                ),
                false
            ); ?>


        </aside>


<!-- class="spaced-left" -->
        <main <?php echo $sl;?>>
            <section class="section">



                <?php if(false){ ?>
                    <div class="subsection">
                        <div class="island">
                            <? /*
						$APPLICATION->IncludeComponent("bitrix:catalog.smart.filter", "common-filter", array(
	"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SAVE_IN_SESSION" => "N",
		"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
		"XML_EXPORT" => "N",
		"SECTION_TITLE" => "NAME",
		"SECTION_DESCRIPTION" => "-",
		"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
		"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
		"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
		"CURRENCY_ID" => $arParams["CURRENCY_ID"],
		"SEF_MODE" => $arParams["SEF_MODE"],
		"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
		"POPUP_POSITION" => "left",
		"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
		"SECTION_CODE_PATH" => $_REQUEST["SECTION_CODE_PATH"],
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SEF_RULE" => "/catalog/filter/#SMART_FILTER_PATH#/apply/",
		"COMPONENT_TEMPLATE" => "common-filter",
		"SEARCH_PROPERTIES" => array(
			0 => "247",
			1 => "247",
		)
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
); */ ?>

                        </div>
                    </div>
                <?php } ?>
                <div class="subsection">

                    <? /*
                    $APPLICATION->IncludeComponent(
                        "kombox:filter",
                        "i_horizontal", //шаблон - .default (можно указать horizontal, bitronic-vertical или bitronic-horizontal)
                        array(
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "FILTER_NAME" => $arParams["FILTER_NAME"],
                            "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                            "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                            "HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                            "SAVE_IN_SESSION" => "N",
                            "INCLUDE_JQUERY" => "Y",
                            "MESSAGE_ALIGN" => "LEFT",
                            "MESSAGE_TIME" => "0",
                            "IS_SEF" => "N",
                            "CLOSED_PROPERTY_CODE" => array(),
                            "CLOSED_OFFERS_PROPERTY_CODE" => array(),
                            "SORT" => "N",
                            "FIELDS" => array(),
                            "PRICE_CODE" => $arParams["PRICE_CODE"],
                            "CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
                            "CURRENCY_ID" => $arParams["CURRENCY_ID"],
                            "XML_EXPORT" => "Y",
                            "SECTION_TITLE" => "NAME",
                            "SECTION_DESCRIPTION" => "DESCRIPTION",
                            "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"]
                        ),
                        false
                    );

                 */   ?>


                    <? if (empty($arrFilter)): ?>

                        <? $APPLICATION->IncludeComponent(
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
                                "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
                            ),
                            $component
                        ); ?>

                    <? else: ?>

                        <? $intSectionID = $APPLICATION->IncludeComponent(
                            "bitrix:catalog.section",
                            "items_list_line_2020",
                            array(
                                "SHOW_ALL_WO_SECTION" => "Y",
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
                                "ADD_SECTIONS_CHAIN" => "N",
                                'ADD_TO_BASKET_ACTION' => $basketAction,
                                'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                                'COMPARE_PATH' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
                                'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
                                'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
                            ),
                            $component
                        ); ?>

                    <? endif; ?>
                </div>
            </section>
        </main>
    </div>
    <div class="container">
        <section class="section">
            <?
            /*
            $APPLICATION->IncludeComponent("bitrix:news.list", "main_page_partners", Array(
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
            );
            */
            ?>

            <?
            If (!$isGetFilter):
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                ".default",
                array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => "/includes/catalog_about_us.php",
                    "EDIT_TEMPLATE" => ""
                ),
                false
            );
            endif;
            ?>
        </section>
    </div>
</div>
<?php
If ($isGetFilter):


    function Lat2ru($string)
    {
        $rus = ['ё','ж','ц','ч','ш','щ','ю','я','Ё','Ж','Ц','Ч','Ш','Щ','Ю','Я'];

        $lat = ['yo','zh','tc','ch','sh','sh','yu','ya','YO','ZH','TC','CH','SH','SH','YU','YA'];
        $string = str_replace($lat,$rus,$string);

        $rus = [
            'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
            'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
            'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
            'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я', ' '
        ];
        $lat = [
            'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya',
            'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P',
            'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya', '_'
        ];
        $string = str_replace($lat, $rus, $string);
        return($string);
    }

    if (is_array($_GET['diametr_1'])){
        $resultstr = array();
        foreach ($_GET['diametr_1'] as $item) {$resultstr[] = 'M'.$item;}
        $diametr = implode(", ",$resultstr);
    }elseif (isset($_GET['diametr_1'])){$diametr = htmlspecialchars('M'.$_GET['diametr_1']);}

    if (is_array($_GET['dlina_1'])){
        $resultstr = array();
        foreach ($_GET['dlina_1'] as $item) {$resultstr[] = $item;}
        $dlina = implode(", ",$resultstr);
    }else{$dlina = htmlspecialchars($_GET['dlina_1']);}

    if (is_array($_GET['tip_tovara'])){
        $resultstr = array();
        foreach ($_GET['tip_tovara'] as $item) {$resultstr[] = Lat2ru(htmlspecialchars($item));}
        $tip_tovara = implode(", ",$resultstr);
    }else{$tip_tovara = Lat2ru(htmlspecialchars($_GET['tip_tovara']));}

    if (is_array($_GET['standart'])){
        $resultstr = array();
        foreach ($_GET['standart'] as $item) {$resultstr[] = str_replace('_',' ',htmlspecialchars(strtoupper($item)));}
        $standart = implode(", ",$resultstr);
    }else{$standart = str_replace('_',' ',htmlspecialchars(strtoupper($_GET['standart'])));}

    if (is_array($_GET['material_1'])){
        $resultstr = array();
        foreach ($_GET['material_1'] as $item) {
            $item = Lat2ru(htmlspecialchars($item));
            in_array($item, ['стал', 'латун', 'мед']) && $item = $item.'ь';
            $resultstr[] = $item;}
        $material = implode(", ",$resultstr);
    }else{$material = Lat2ru(htmlspecialchars($_GET['material_1']));
        in_array($material, ['стал', 'латун', 'мед']) && $material = $material.'ь';}

    if (!empty($diametr) & !empty ($dlina)) {$razmer = $diametr.' x '. $dlina ;}
    else
    {
        if (!empty($diametr)) $razmer = $diametr;
        if (!empty($dlina)) $razmer = $dlina;
    };

    ($diametr && !$dlina && !$tip_tovara && !$standart && !$material) && $razmer = ' с диаметром '.$razmer;
    (!$diametr && $dlina && !$tip_tovara && !$standart && !$material) && $razmer = ' с длиной '.$razmer;
    (!$diametr && !$dlina && !$tip_tovara && !$standart && $material) && $material = ' из материала '.$material;
    (!$tip_tovara && !$standart) && $tip_tovara = 'Крепёж ';

if (!$_GET['measurment']):
    $seoArr = array($tip_tovara, $standart, $razmer, $material);
    $seotitle = implode(" ",array_filter($seoArr)).', продажа в Санкт-Петербурге (СПБ) и в Москве (МСК)';

    $seotitle = mb_strtoupper(mb_substr($seotitle, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($seotitle, 1, mb_strlen($seotitle), 'UTF-8');

    $APPLICATION->SetPageProperty('title', $seotitle);
//$APPLICATION->SetPageProperty('keywords', $seotitle);
    $APPLICATION->SetPageProperty('description', $seotitle.', оптом и в розницу, в наличии и на заказ по низкой цене! Звоните!');
endif;
endif;

//echo $seotitle;
?>



