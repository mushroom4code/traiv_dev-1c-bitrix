<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die(); ?>
<? include_once 'top.php'; ?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"",
	Array(
		"CHECK_RIGHTS" => "N",
		"SEND_INFO" => "N",
		"SET_TITLE" => "N",
		"USER_PROPERTY" => array("UF_ORGANIZATION","UF_INN","UF_SITE"),
		"USER_PROPERTY_NAME" => ""
	),
        $component
);?>
<? include_once 'bottom.php'; ?>
