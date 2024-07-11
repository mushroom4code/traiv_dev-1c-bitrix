<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вес по din 936: гайка низкая шестигранная");
?><div class="content">
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
		<?
        if (CSite::InDir('/poleznoe/ves-izdeliy-po-din/')){ ?> <a class="calc_banner_one" href="/calculator/">
		<p style="text-align:center">
			<img alt="Калькулятор крепежа и метизов" src="/images/banners/bannet_calc_ves.png">
		</p>
		</a> <?}			$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "_din-936",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);

			?>
		
			   
			<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,twitter,viber,whatsapp,skype,telegram">
			</div>
		</div>
	</div>
</div>
<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>