<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Политика конфиденциальности");
?>	<section id="content">
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
<h1><span>Политика конфиденциальности</span></h1>
</div>
</div>

			<?
			$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				".default",
				array(
					// region Параметры компонента
					"AREA_FILE_SHOW"    =>  "page",  // Показывать включаемую область : array ( 'page' => 'для страницы', 'sect' => 'для раздела', )
					"AREA_FILE_SUFFIX"  =>  "inc_politica_conf",   // Суффикс имени файла включаемой области
					"EDIT_TEMPLATE"     =>  "",      // Шаблон области по умолчанию : array ( 'standard.php' => '[standard.php] Стандартная страница', )
					// endregion
				)
			);

			?>


		</div>
	</section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>