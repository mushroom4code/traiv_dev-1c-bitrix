<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пользовательское соглашение");
?>	<div class="content">
		<div class="container">
<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "zf",
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
					"AREA_FILE_SUFFIX"  =>  "inc_polzovatelskoe_soglashenie",   // Суффикс имени файла включаемой области
					"EDIT_TEMPLATE"     =>  "",      // Шаблон области по умолчанию : array ( 'standard.php' => '[standard.php] Стандартная страница', )
					// endregion
				)
			);

			?>


		</div>
	</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>