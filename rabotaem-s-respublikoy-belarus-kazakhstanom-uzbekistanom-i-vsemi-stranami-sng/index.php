<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Работаем с Республикой Беларусь, Казахстаном, Узбекистаном и всеми странами СНГ");
?><section id="content">
<div class="container">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"traiv",
	Array(
		"COMPONENT_TEMPLATE" => "traiv",
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?>
	<div class="row">
		<h1>Работаем с Республикой Беларусь, Казахстаном, Узбекистаном и всеми странами СНГ</h1>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
Array()
);?>
	</div>
</div>
 </section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>