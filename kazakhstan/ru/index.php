<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Приглашаем к сотрудничеству производственные организации Казахстана");
$APPLICATION->SetPageProperty("title", "Приглашаем к сотрудничеству производственные организации Казахстана");
$APPLICATION->SetTitle("Приглашаем к сотрудничеству производственные организации Казахстана");
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
<h1><span>Приглашаем к сотрудничеству производственные организации Казахстана</span></h1>
</div>
</div>

<div class="row">
			<?
			// Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
			$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "_ru",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);

			?>


		</div>
	</div>
</section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>