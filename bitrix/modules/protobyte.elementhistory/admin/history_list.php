<?
use \Bitrix\Main\Loader;
use \Bitrix\Main\Config\Option;
use Protobyte\ElementHistory\DataTable;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

IncludeModuleLangFile(__FILE__);

if ( ! Loader::includeModule( 'protobyte.elementhistory' )
) {
	throw new \Exception( 'Not loaded module protobyte.antiparsing' );
}
$APPLICATION->SetTitle(GetMessage("HISTORY_LIST_TITLE"));
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

include($_SERVER['DOCUMENT_ROOT'].getLocalPath('modules/protobyte.elementhistory/table.php'));

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
?>