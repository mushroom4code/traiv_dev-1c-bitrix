<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>  <div class="content">
    <div class="container">

        <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
            "COMPONENT_TEMPLATE" => ".default",
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => "zf",
        ),
            false
        ); ?>
        <aside class="aside">
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "catalog_left_menu",
                array(
                    "COMPONENT_TEMPLATE" => "catalog_left_menu",
                    "ROOT_MENU_TYPE" => "news_left_menu",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_CACHE_GET_VARS" => array(),
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N",
                ),
                false
            ); ?>

            <div class="u-none--m">
                <script type="text/javascript" src="//vk.com/js/api/openapi.js?146"></script>
                <div id="vk_groups"></div>
                <script type="text/javascript">
                    VK.Widgets.Group("vk_groups", {mode: 4, height: "400"}, 47382243);
                </script>
            </div>
        </aside>
        <main class="spaced-left">

            <?

//            $arrFilter = array(
//                    "SECTION_CODE" => $_GET["SECTION_CODE"]
//            );

            // Новости
            $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"template1", 
	array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "29",
		"NEWS_COUNT" => "10",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "Y",
		"USE_REVIEW" => "N",
		"USE_FILTER" => "Y",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "production",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "Y",
		"USE_PERMISSIONS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_TEXT",
			3 => "DETAIL_PICTURE",
			4 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_ACTIVE_DATE_FORMAT" => "",
		"DETAIL_FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_TEXT",
			3 => "DETAIL_PICTURE",
			4 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"PAGER_TEMPLATE" => "traiv",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"COMPONENT_TEMPLATE" => "template1",
		"SET_LAST_MODIFIED" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "N",
		"DETAIL_SET_CANONICAL_URL" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"STRICT_SECTION_CHECK" => "N",
		"CATEGORY_IBLOCK" => "",
		"CATEGORY_CODE" => "CATEGORY",
		"CATEGORY_ITEMS_COUNT" => "5",
		"TEMPLATE_THEME" => "blue",
		"MEDIA_PROPERTY" => "",
		"SLIDER_PROPERTY" => "",
		"TAGS_CLOUD_ELEMENTS" => "150",
		"PERIOD_NEW_TAGS" => "",
		"DISPLAY_AS_RATING" => "rating",
		"FONT_MAX" => "50",
		"FONT_MIN" => "10",
		"COLOR_NEW" => "3E74E6",
		"COLOR_OLD" => "C0C0C0",
		"TAGS_CLOUD_WIDTH" => "100%",
		"FILTER_NAME" => "arrFilter",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_URL" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => $_GET["SECTION_CODE"],
		"INCLUDE_SUBSECTIONS" => "Y"
	),
	false
);
            ?>

        </main>
    </div>
</div>

    <script>
        $(document).ready(function() {
            //doesn't wait for images, style sheets etc..
            //is called after the DOM has been initialized
            $(".categories").removeClass('u-none');
        });
    </script>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>