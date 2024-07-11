<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
$APPLICATION->SetPageProperty("description", "Покрытие крепежа и металлоизделий - производство, изготовление и продажа от компании \"Трайв\" в Санкт-Петербурге (СПБ) и Москве (МСК)! Звоните 8 (800) 707-25-98!");
$APPLICATION->SetPageProperty("title", "Производство и изготовление: Покрытие крепежа и металлоизделий на заказ в Санкт-Петербурге (СПБ) и Москве (МСК)");
?><?$APPLICATION->SetTitle("{=this.property.HEADER}");?> <section id="content">
<div class="container">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"traiv",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => "",
		"SITE_ID" => "zf",
		"START_FROM" => "0"
	)
);?>
	<div class="row">
		<div class="col-12 col-xl-12 col-lg-12 col-md-12">
			<h1>Покрытие</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			 <?php 
        $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"coatings", 
	array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "49",
		"NEWS_COUNT" => "40",
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
		"COMPONENT_TEMPLATE" => "coatings",
		"STRICT_SECTION_CHECK" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"FILE_404" => ""
	),
	false
);
?>
			<div class="news-detail mt-3">
				<p align="justify">
 <img width="130" alt="Снятие покрытия с метизов" src="/images/articles/snyatie-pokrytiya-s-metizov.jpg" title="Снятие покрытия с метизов" style="margin-right: 10px;" border="0" align="left">В настоящее время производителями практически весь выпускаемый крепеж подвергается антикоррозийной обработке. Она может заключаться в том, что на металлический элемент наносится тонкий слой цинка или лакокрасочное покрытие. В результате крепеж приобретает лучшую стойкость к воздействию окружающей среды.&nbsp;
				</p>
				<p align="justify">
					 Но со временем под действием внешних факторов, например вследствие механических повреждений антикоррозийный слой нарушается и тогда его приходится восстанавливать.&nbsp;
				</p>
				<p align="justify">
					 Или может оказаться так, что цинковое покрытие было нанесено некачественно и в этом случае перед использованием деталей ее следует подвергнуть дополнительной обработке.&nbsp;
				</p>
				<p align="justify">
					 Рассмотрим, каким образом осуществляется снятие покрытий с метизов и крепежа.
				</p>
				<h2>Чем удаляются покрытия с различных материалов</h2>
				<p align="justify">
					 Крепеж может изготавливаться из различных материалов и следовательно эти материалы будут обладать различными физическими свойствами. Поэтому выбор способа удаления покрытий осуществляется в зависимости от того, какое покрытие и с какого материала предстоит удалять. Так как в большинстве случаев на метизах в качестве антикоррозийного покрытия используется цинк, то рассмотрим, каким образом он удаляется с тех или иных материалов.
				</p>
				<p align="justify">
					 Если крепеж был изготовлен из стали, то удаления с него покрытия осуществляется при помощи цианистых растворов. Они станут активно взаимодействовать с цинком и в тоже время останутся инертны к стали. Если изделие было изготовлено из латуни или меди, то необходимо использовать серную кислоту или растворы щелочи. Только эти вещества способны растворить цинк и не нанести вреда основной поверхности детали. Скорость растворения цинка в активных средах составляет 100 мкм/час при условии, что процесс происходит при комнатной температуре. После того, как обработка поверхностей будет завершена на деталях остается окалина, которую необходимо снять. Делается это при помощи различных видов обработки, например карцеванием.
				</p>
				<div align="center">
 <img alt="Снятие покрытия с метизов" src="/images/articles/snyatie-pokrytiya-s-krepega.jpg" style="max-width: 95%;" title="Снятие покрытия с метизов" vspace="5" hspace="5" border="0">
				</div>
				<h2>Особенности проведения работ</h2>
				<p align="justify">
					 Вы наверняка обратили внимание на то, что рассматриваемый вид работ осуществляется с использованием химически активных веществ. Для работы с такими веществами необходимо иметь опыт, защитное и производственное оборудование. Именно поэтому все действия по обработке крепежа должны осуществляться специализированной компанией. Только в этом случае можно гарантировать, что все действия будут выполнены качественно с минимальными затратами времени и средств.
				</p>
				<p align="justify">
 <span>Для того чтобы <b>снять покрытие с метизов</b> позвоните нам по тел. +7(812)313-22-80 или отправьте заявку на почту: <a href="mailto:info@traivkomplekt.ru">info@traiv-komplekt.ru</a></span>
				</p>
				<p align="justify">
					 
				</p>
			</div>
		</div>
	</div>
</div>
 </section><?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>