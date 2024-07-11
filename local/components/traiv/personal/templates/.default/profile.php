<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die(); ?>
<?
if (!$USER->IsAuthorized()) {
    if ($_REQUEST["AJAX_MODE"] != "Y") {
        LocalRedirect("/auth/?backurl=".$APPLICATION->GetCurPage());
    }
}
include_once 'top.php'; ?>
<?

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        $comp = "newlk";
    }
    else {
        $comp = "newlk";
    }
}
else {
        $comp = "newlk";
}

$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
    $comp,
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
