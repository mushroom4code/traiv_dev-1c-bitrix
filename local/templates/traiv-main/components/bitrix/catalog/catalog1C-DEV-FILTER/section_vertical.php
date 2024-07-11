<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$countSubsections = 0;

$_section = (new CIBlockSection)->GetList(
    Array("SORT"=>"ASC"),
    [
	    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            'CODE' => $arResult['VARIABLES']['SECTION_CODE']
    ]
);

if($_section = $_section->Fetch()){
    //есть ли подразделы?

    $countSubsections = (new CIBlockSection)->GetCount(
        [
            'SECTION_ID' => $_section['ID']
        ]
    );
}

$countElementsInSection = (new CIBlockSection)->GetSectionElementsCount(
    $_section['ID'],
    [
        'CNT_ACTIVE' => 'Y'
    ]
);?>

<?/* alternative section count method
                    $rsParentSection = CIBlockSection::GetByID($arResult["VARIABLES"]["SECTION_ID"]);
                    if ($arParentSection = $rsParentSection->GetNext())
                    {
                    $arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'],'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']); // выберет потомков без учета активности
                    $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
                        $CountDazBrokenSheet = 0;
                    while ($arSect = $rsSect->GetNext())
                    {
                        $CountDazBrokenSheet++;
                        ?><pre><?//print_r($arSect)?></pre><?


                    }
                    }

//echo $CountDazBrokenSheet;
*/?>

?>
<div class="content">
	<div class="container">
		<? $APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"traiv",
	array(
		"COMPONENT_TEMPLATE" => "traiv",
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1"
	),
	false
); ?>


        <?// if ($isFilter and !$countSubsections): ?>
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
				<? if (SHOW_VK_WIDGET): // task: replace vk widget with side menu ?>
				<!--	<script type="text/javascript" src="//vk.com/js/api/openapi.js?127"></script>
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
					</script> -->
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "catalog-sections-hiden",
                        Array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left",
                            "COMPONENT_TEMPLATE" => "catalog-sections",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "2",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "left",
                            "USE_EXT" => "Y"
                        )
                    );?>



                <?// endif ?>

			</div>
		</aside>
        <? endif; //isFilter?>
		<main class="spaced-left">

			<section class="section">

<?
$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(18,$arResult["VARIABLES"]["SECTION_ID"]);
$IPROPERTY  = $ipropValues->getValues();
$ButtonName = $IPROPERTY['SECTION_META_TITLE'];

?>

                <?//form for empty items categories

                If ($countElementsInSection == 0){
                    ?>
                    <div class="Order_one_click" >
                        <a href="#callback-form" rel="nofollow" class="btn-mfp-dialog">Оформить запрос<?//echo $ButtonName?></a>
                        <div id='callback-form' class="popup-dialog mfp-hide">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:form.result.new",
                                "one_click_catalog_default",
                                array(
                                    "NAME" => "Оформить запрос",
                                    "COMPONENT_TEMPLATE" => "one_click_catalog_default",
                                    "ELEMENT_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                                    "WEB_FORM_ID" => "9",
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
                ?>

<?
/*
$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(18,$arResult["VARIABLES"]["SECTION_ID"]);
$IPROPERTY  = $ipropValues->getValues();
?><pre><?print_r($IPROPERTY['SECTION_META_TITLE'])?></pre><?

$CurrentUrl = $_SERVER["REQUEST_URI"];

                $GLOBALS['test1'] = $arResult["VARIABLES"]["SECTION_ID"];

   // $page_title = \Bitrix\Iblock\InheritedProperty\SectionValues::getId();
echo 'Тайтл: '.$page_title;

              /* $rsSection = CIBlockSection::GetList(
                    array(),
                    array(
                        "IBLOCK_ID"=>$arParams['IBLOCK_ID'],
                        "ACTIVE"=>"Y",
                        "=CODE"=>$arParams["SECTION_CODE"]),
                    false
                );

                if($arSection = $rsSection->GetNext()){

                    $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(
                        $arSection["IBLOCK_ID"],
                        $arSection["ID"]
                    );

                    $arSection["IPROPERTY_VALUES"] = $ipropValues->getValues();
                    echo "<pre>"; print_r($arSection); echo '</pre>';
                }



$dir = $APPLICATION->GetCurDir();
echo '$dir: '.$dir;

$props = $APPLICATION->GetDirPropertyList();
foreach($props as $key=>$val)
    echo 'name="'.$key.'" content="'.htmlspecialchars($val).'"<br />';


$rsSections = CIBlockSection::GetList(array(),array('IBLOCK_ID' => 18, 'SECTION_CODE_PATH' => $CurrentUrl, "CHECK_PERMISSIONS" => "N"));
                if ($arSection = $rsSections->Fetch())
                {
                echo 'Имя секции: '.$arSection['keywords'];



                }



$CurrentUrl = $_SERVER["REQUEST_URI"];

$fullUrl = 'https://'.SITE_SERVER_NAME.$CurrentUrl;
$tags = get_meta_tags($fullUrl);
$SectionDescription = $tags['description'];
$SectionDescription = preg_replace("/, оптом и в розницу, в наличии и на заказ в Санкт-Петербурге и Москве, по низкой цене! Звоните!/","", $SectionDescription );

echo $SectionDescription;
*/




?>


				<div class='subsection'>

                    <?

                    $APPLICATION->IncludeComponent(
	"kombox:filter", 
	"i_horizontal_root", 
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
		"COMPONENT_TEMPLATE" => "i_horizontal_root",
		"PAGE_URL" => "/catalog/",
		"COLUMNS" => "1",
		"STORES_ID" => array(
		)
	),
	false
);




                    ?>


                        <?
                            $arFilter = Array("IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"], "IBLOCK_ID" => $arParams["IBLOCK_ID"], "CODE" => $arResult["VARIABLES"]["SECTION_CODE"]);
                            $arSelect = Array('UF_PREVIEW_TEXT', 'NAME', 'DESCRIPTION', 'UF_TERM', 'UF_LONGTEXT', 'UF_COUNTER', 'PICTURE', 'DEPTH_LEVEL','LEFT_MARGIN', 'RIGHT_MARGIN');
                            $db_list = CIBlockSection::GetList(Array(), $arFilter, true, $arSelect);
                            if ($section = $db_list->GetNext()) {




                                $SectPict=CFile::GetFileArray($section["PICTURE"]);

                                $widthsizen="150";
                                $heightsizen="150";

                                $SectPictResize = CFile::ResizeImageGet(
                                    $SectPict,
                                array("width" => $widthsizen, "height" => $heightsizen),
                                BX_RESIZE_IMAGE_PROPORTIONAL,
                                true, $arFilter
                                );

                                $SectPict = array(
                                    'SRC' => $SectPictResize["src"],
                                    'WIDTH' => $SectPictResize["width"],
                                    'HEIGHT' => $SectPictResize["height"],
                                );




            $ParrentIDs = array (50,52,53,54,1161,58);
            $i = 0;
foreach ($ParrentIDs as $keykey){

                                $rsParentSection = CIBlockSection::GetByID($keykey);
                                if ($arParentSection = $rsParentSection->GetNext())
                                {
                                    $arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'],'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']); // выберет потомков без учета активности
                                    $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);


                                    $k = 0;

                                    $DevArrayIDs = array();


                                    while ($arSect = $rsSect->GetNext()) //получили все подразделы
                                    {

                                        $DevArrayIDs[$k] = $arSect['ID'];
                                        $k++;
                                        /*
                                        foreach ($arSect as $keyone){
                                        $DevArrayIDs[$k] = $keyone['ID'];
                                        $k++;
                                        }
*/

                                        // $fffff = array(50,51,52,53);

                                        }

                                    $DevImOutput = $arResult["VARIABLES"]["SECTION_ID"];


                                    If (in_array($DevImOutput, $DevArrayIDs)) {
                                        ?>

                                        <img class="TitleImg" src="<?= $SectPict['SRC'] ?>" alt="<?= $section['NAME'] ?>"
                                             title="<?= $section['NAME'] ?>">

                                        <?


                                    }

                                }
                                $i++;

}

                                ?><pre><?//print_r($arResult["VARIABLES"]["SECTION_ID"])?></pre><?

                                if /*(!($_REQUEST['PAGEN_1'] > 1) and */ (!empty($section["~UF_PREVIEW_TEXT"])){
                                    echo '<div class="section_description">' . $section["~UF_PREVIEW_TEXT"] . '</div>' ;
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


					<?
					if($_REQUEST["catalog_items_in_list"]=="y"){
						$_SESSION["catalog_items_in_list"]="y";
					}elseif($_REQUEST["catalog_items_in_list"]=="n"){
						$_SESSION["catalog_items_in_list"]="n";
					}else{
						if(empty($_SESSION["catalog_items_in_list"])){
							$_SESSION["catalog_items_in_list"]="n";
						}
					}



					if(!empty($_REQUEST["PAGE_COUNT"]) && $_REQUEST["PAGE_COUNT"]<100){
						$arParams["PAGE_ELEMENT_COUNT"]=$_SESSION["PAGE_COUNT"]=$_REQUEST["PAGE_COUNT"];
					}
					if(!empty($_SESSION["PAGE_COUNT"])) {
						$arParams["PAGE_ELEMENT_COUNT"] = $_SESSION["PAGE_COUNT"];
					}





					if($_SESSION["catalog_items_in_list"]=="y"){
						$template = "items_list_line";
					}else{
						$template = "items_list";
					}



                    if($countSubsections > 0) {
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
		</main>
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

			<?if($section["DESCRIPTION"]){?>
				<article class="article">
					<?=$section["DESCRIPTION"];?>
				</article>
                <?
                If ($section["UF_LONGTEXT"]){
                echo '<div class="section_description">' . $section["~UF_LONGTEXT"] . '</div>' ; ?>
                    <?}?>
			<?
 $APPLICATION->IncludeComponent(
     "bitrix:forum.topic.reviews",
     "forum_comments_traiv",
     Array(
         "AJAX_POST" => "Y",
         "CACHE_TIME" => "0",
         "CACHE_TYPE" => "A",
         "COMPONENT_TEMPLATE" => ".default",
         "DATE_TIME_FORMAT" => "d.m.Y H:i:s",
         "EDITOR_CODE_DEFAULT" => "Y",
         "ELEMENT_ID" => "105200",
         "FILES_COUNT" => "0",
         "FORUM_ID" => "1",
         "IBLOCK_ID" => "18",
         "IBLOCK_TYPE" => "catalog",
         "MESSAGES_PER_PAGE" => "10",
         "NAME_TEMPLATE" => "",
         "PAGE_NAVIGATION_TEMPLATE" => "",
         "PREORDER" => "Y",
         "RATING_TYPE" => "",
         "SHOW_AVATAR" => "N",
         "SHOW_LINK_TO_FORUM" => "N",
         "SHOW_MINIMIZED" => "N",
         "SHOW_RATING" => "",
         "URL_TEMPLATES_DETAIL" => "nerzhavejushchii-krepezh",
         "URL_TEMPLATES_PROFILE_VIEW" => "",
         "URL_TEMPLATES_READ" => "",
         "USE_CAPTCHA" => "Y"
     )
 );?>
            <?}?><br>



            <div class="counter_one">
             <?//show counter from counter.php


     echo 'Просмотров: '.$section['UF_COUNTER'];

     ?>
            </div>

		</section>
	</div>
</div>