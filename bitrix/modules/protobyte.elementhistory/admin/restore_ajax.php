<?
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
use \Bitrix\Main\Loader;
use Protobyte\ElementHistory\DataTable;


require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
if ( ! Loader::includeModule( 'protobyte.elementhistory' )
) {
    throw new \Exception( 'Not loaded module protobyte.antiparsing' );
}

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$id = (int)$request->getPost("id");

header('Content-Type: application/json; charset='.SITE_CHARSET);
if ($id==0){
    echo json_encode(["status"=>"error", "text"=>"Error: ID=0"]);
	die;
}

$dump = new \Protobyte\ElementHistory\Dump();
if ($dump->getById($id) === false ){
    echo json_encode(["status"=>"error", "text"=>"Error: Backup not found"]);
    die;
}
$arOutput = $dump->restore();

echo json_encode($arOutput);
