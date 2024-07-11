<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Декодерум");
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
Array("TEMPLATE" => "decode")
);?>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>