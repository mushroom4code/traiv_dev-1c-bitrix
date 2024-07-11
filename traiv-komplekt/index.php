<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Traiv-Komplekt LTD");
$APPLICATION->SetTitle("Traiv-Komplekt");
?>	<div class="content">
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


			<?
			// Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
			$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				".default",
				array(
					// region Параметры компонента
					"AREA_FILE_SHOW"    =>  "page",  // Показывать включаемую область : array ( 'page' => 'для страницы', 'sect' => 'для раздела', )
					"AREA_FILE_SUFFIX"  =>  "inc_tk",   // Суффикс имени файла включаемой области
					"EDIT_TEMPLATE"     =>  "",      // Шаблон области по умолчанию : array ( 'standard.php' => '[standard.php] Стандартная страница', )
					// endregion
				)
			);

			?>


		</div>
	</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>