<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Регистрация нового пользователя");
$APPLICATION->SetPageProperty("title", "Регистрация нового пользователя");
$APPLICATION->SetTitle("Регистрация");
?>
<section id="content">
<div class="container">

<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span><?$APPLICATION->ShowTitle(false);?></span></h1>
    </div>
</div>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.register",
	"registration",
	Array(
		"AUTH" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
	    "REQUIRED_FIELDS" => array("EMAIL","PERSONAL_PHONE"),
		"SET_TITLE" => "Y",
		"SHOW_FIELDS" => array("EMAIL","NAME","PERSONAL_PHONE"),
		"SUCCESS_PAGE" => "",
		"USER_PROPERTY" => array(),
		"USER_PROPERTY_NAME" => "",
		"USE_BACKURL" => "Y"
	)
);?>
</div>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>