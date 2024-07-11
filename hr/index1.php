<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Вакансии компании «Трайв-Комплект»");
$APPLICATION->SetPageProperty("title", "Вакансии компании «Трайв-Комплект»");
$APPLICATION->SetTitle("Вакансии");

?>  <section id="content">
        <div class="container">

            <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "s1",
            ),
                false
            ); ?>
            
            <?php
?>
<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span><?$APPLICATION->ShowTitle(false)?></span></h1>
    </div>
</div>

          <div class="row">
        <div class="col-12 col-xl-6 col-lg-6 col-md-6 pt-4 vacansies-about-text">
       <p>Группа компаний Трайв основана в 2006 году и включает в себя несколько юридических лиц со своей специализацией.</p> 

<p>Трайв - ключевой поставщик метизов и решений промышленным предприятиям и производителям на рынке России и CНГ с 16-летней историей. Наши клиенты - это крупные производственные предприятия, нефтеперерабатывающие корпорации, строительные объекты, государственные заводы и институты.
С 2010 года запущено новое направление деятельности компании "Трайв" – производство машиностроительного и строительного крепежа, а также предоставление дополнительных услуг (дополнительная обработка поверхности деталей). 
</p> 
<p>Команда Global специализируется на рынке электротехнической продукции. Продукт компании - продажа оборудования, решений, а также программного обеспечения для промышленной автоматизации. Наши основные партнеры Siemens, ABB, Schneider, Mitsubishi.
</p> 
<p>При работе с нашими постоянными клиентами мы обратили внимание на очень частую проблему многих предприятий и организаций – на большинстве из них существует проблема с обеспечением рабочих и служащих специальной одеждой и СИЗ, так появилось направление - ПТК Спецодежда.
</p> 
 <p>Сейчас в команде 100+ сотрудников с Санкт-Петербурге и Москве и более 60.000 постоянных клиентов по всей России. Мы находимся в стадии интенсивного развития, наш штат постоянно расширяется (за последний год мы выросли на 30%).
Наши сотрудники – наша основная ценность. Мы гордимся каждым и знаем, что вместе мы решим любые задачи.
</p> 
<p>Присоединяйтесь к сильной компании и развивайтесь вместе с нами!</p> 
        </div>
        <div class="col-12 col-xl-5 col-lg-5 col-md-5 offset-md-1 offset-sm-1 offset-lg-1 offset-xl-1 pt-3">
        
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 position-relative hh-script-area">
        <div class="hh-script">
        </div>
        <script class="hh-script" src="https://api.hh.ru/widgets/vacancies/employer?employer_id=973412&locale=RU&links_color=1560b2&border_color=ffffff&title="></script>
        
        </div>
        </div>
</div>



            <!-- <main class="spaced-left"> -->

                <?

                // Новости
              /*  $APPLICATION->IncludeComponent(
	"bitrix:news", 
	"vacancies", 
	array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "26",
		"NEWS_COUNT" => "40",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_REVIEW" => "N",
		"USE_FILTER" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/vacancies/",
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
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_TEXT",
			3 => "DETAIL_PICTURE",
			4 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "VAC_MONEY",
			1 => "VAC_TASKS",
			2 => "VAC_LOC",
			3 => "VAC_REQ",
			4 => "VAC_COND",
			5 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Вакансия",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"PAGER_TEMPLATE" => "traiv",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Вакансии",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"COMPONENT_TEMPLATE" => "vacancies",
		"SET_LAST_MODIFIED" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "N",
		"DETAIL_SET_CANONICAL_URL" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"STRICT_SECTION_CHECK" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);*/
                ?>

            <!-- </main> -->
        </div>
    </section>

    <script>
        $(document).ready(function() {
            //doesn't wait for images, style sheets etc..
            //is called after the DOM has been initialized
            $(".categories").removeClass('u-none');
        });
    </script>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>