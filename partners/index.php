<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Партнеры сотрудничающие с компанией «Трайв-Комплект»");
$APPLICATION->SetPageProperty("title", "Партнеры компании «Трайв-Комплект» ");
$APPLICATION->SetTitle("Партнеры");
?>
<section id="content">
	
		<div class="container">
<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "zf",
            ),
                false
            ); ?>
            
<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span>Партнеры</span></h1>
    </div>
</div>

<div class="row d-flex align-items-center h-100 partners-list">
<?php 
if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '4677') {
        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "partners",
            array(
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "N",
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => "8",
                "NEWS_COUNT" => "20",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array(
                    0 => "ID",
                    1 => "",
                ),
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "DESCRIPTION",
                    2 => "",
                ),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "Y",
                "SET_BROWSER_TITLE" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_META_DESCRIPTION" => "Y",
                "SET_LAST_MODIFIED" => "Y",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => $_REQUEST["SECTION_CODE"],
                "INCLUDE_SUBSECTIONS" => "Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_BASE_LINK_ENABLE" => "Y",
                "SET_STATUS_404" => "Y",
                "SHOW_404" => "Y",
                "MESSAGE_404" => "",
                "PAGER_BASE_LINK" => "",
                "PAGER_PARAMS_NAME" => "arrPager",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "COMPONENT_TEMPLATE" => "partners",
                "STRICT_SECTION_CHECK" => "N",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "FILE_404" => ""
            ),
            false
            );
    }
}
?>
</div>

<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 text-center">
    	<div class="btn-group-blue"><a href="#w-form" class="btn-404"><span><i class="fa fa-handshake-o"></i> Стать партнером</span></a></div>
    </div>
</div>

			<?
			// Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
			$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				".default",
				array(
					// region Параметры компонента
					"AREA_FILE_SHOW"    =>  "page",  // Показывать включаемую область : array ( 'page' => 'для страницы', 'sect' => 'для раздела', )
					"AREA_FILE_SUFFIX"  =>  "inc_partners",   // Суффикс имени файла включаемой области
					"EDIT_TEMPLATE"     =>  "",      // Шаблон области по умолчанию : array ( 'standard.php' => '[standard.php] Стандартная страница', )
					// endregion
				)
			);

			?>


		</div>
	
	</section>
	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>