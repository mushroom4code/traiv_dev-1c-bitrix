<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Доставка крепежа и способы оплаты за метизы");
$APPLICATION->SetPageProperty("title", "Доставка и оплата");
$APPLICATION->SetTitle("Доставка и оплата");

\Bitrix\Main\Page\Asset::getInstance()->addCss($APPLICATION->GetCurDir()."/style.css");

?>	<section id="content">
		<div class="container">
<? $APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"traiv", 
	array(
		"COMPONENT_TEMPLATE" => "traiv",
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>

<div class="row">
<div class="col-12 col-xl-12 col-lg-12 col-md-12">
<h1><span>Доставка и оплата</span></h1>
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
					"AREA_FILE_SUFFIX"  =>  "inc_1",   // Суффикс имени файла включаемой области
					"EDIT_TEMPLATE"     =>  "",      // Шаблон области по умолчанию : array ( 'standard.php' => '[standard.php] Стандартная страница', )
					// endregion
				)
			);

			?>
	</div>
	</section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>