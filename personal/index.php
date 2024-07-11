<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Личный кабинет");
$APPLICATION->SetPageProperty("title", "Личный кабинет");
$APPLICATION->SetTitle("Личный кабинет");
?>
<section id="content">
<?
global $USER;
if (!$USER->IsAuthorized())
{
    LocalRedirect("/auth/?backurl=".$APPLICATION->GetCurPage());
}
$APPLICATION->IncludeComponent(
	"traiv:personal",
	"",
Array()
);?>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>