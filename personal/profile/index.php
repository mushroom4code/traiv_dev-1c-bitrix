<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Профиль пользователя");
?>
<section id="content">
<?$APPLICATION->IncludeComponent(
	"traiv:personal",
	"",
Array("TEMPLATE" => "profile")
);?>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>