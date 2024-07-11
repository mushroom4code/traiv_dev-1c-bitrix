<?
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_admin_before.php");

define('ADMIN_MODULE_NAME', 'kombox.filter');

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Kombox\Filter\SeoTable;

Loc::loadMessages(dirname(__FILE__).'/seo.php');

if (!$USER->CanDoOperation('seo_tools'))
{
	$APPLICATION->AuthForm(Loc::getMessage("ACCESS_DENIED"));
}

if(!Main\Loader::includeModule('kombox.filter'))
{
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
	ShowError(Loc::getMessage("KOMBOX_MODULE_FILTER_NO_MODULE"));
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
}

$IBLOCK_ID = IntVal($iblock_id);
$arIBlock = CIBlock::GetArrayByID($IBLOCK_ID);

$iblocks_seo = COption::GetOptionString('kombox.filter', "iblocks_seo");
	
if(strlen($iblocks_seo))
	$iblocks_seo = unserialize($iblocks_seo);
	
if(!in_array($IBLOCK_ID, $iblocks_seo)){
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
	ShowError(Loc::getMessage("KOMBOX_MODULE_FILTER_NO_IBLOCK"));
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
}

//sections
$arSections = array();
$rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $IBLOCK_ID), false, array('ID', 'NAME'));
while($arSection = $rsSections->Fetch()){
	$arSections[$arSection['ID']] = $arSection['NAME'];
}

$tableID = "tbl_kombox_seo";

$oSort = new CAdminSorting($tableID, "ID", "desc");
$adminList = new CAdminList($tableID, $oSort);

if(($arID = $adminList->GroupAction()))
{
	if($_REQUEST['action_target']=='selected')
	{
		$arID = array();
		$rsData = SeoTable::getList(array(
			"select" => array("ID"),
		));

		while($arRes = $rsData->fetch())
		{
			$arID[] = $arRes['ID'];
		}
	}

	foreach($arID as $ID)
	{
		$ID = intval($ID);
		if($ID <= 0)
			continue;

		switch($_REQUEST['action'])
		{
			case "delete":
				SeoTable::delete($ID);
			break;
		}
	}
}

$map = SeoTable::getMap();
unset($map['SETTINGS']);

$rulesList = SeoTable::getList(array(
	'order' => array($by => $order),
	'select' => array_keys($map),
	'filter' => array('IBLOCK_ID' => $IBLOCK_ID)
	
));
$data = new CAdminResult($rulesList, $tableID);
$data->NavStart();

$arHeaders = array(
	array("id"=>"ID", "content"=>Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_HEADER_ID"), "sort"=>"ID", "default"=>true),
	array("id"=>"ACTIVE", "content"=>Loc::getMessage('KOMBOX_MODULE_FILTER_SEO_HEADER_ACTIVE'), "sort"=>"ACTIVE", "default"=>true, "align" => "center"),
	array("id"=>"SECTION_ID", "content"=>Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_HEADER_SECTION_ID"), "sort"=>"SECTION_ID", "default"=>true),
	array("id"=>"H1", "content"=>Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_HEADER_H1"), "default"=>true),
	array("id"=>"TITLE", "content"=>Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_HEADER_TITLE"), "default"=>true),
	array("id"=>"DESCRIPTION", "content"=>Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_HEADER_DESCRIPTION"), "default"=>false),
	array("id"=>"KEYWORDS", "content"=>Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_HEADER_KEYWORDS"), "default"=>false)
);

$adminList->AddHeaders($arHeaders);

$adminList->NavText($data->GetNavPrint(Loc::getMessage("PAGES")));
while($rule = $data->NavNext())
{
	$id = intval($rule['ID']);

	$row = &$adminList->AddRow($rule["ID"], $rule, "kombox_filter_seo_edit.php?iblock_id=".$IBLOCK_ID."&ID=".$rule["ID"]."&lang=".LANGUAGE_ID, Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_EDIT_TITLE"));

	$row->AddViewField("ID", $rule['ID']);
	$row->AddCheckField("ACTIVE");

	$section = $rule["SECTION_ID"];
	if(isset($arSections[$section]))
		$section = $arSections[$section] . ' ['.$section.']';

	$row->AddViewField("SECTION_ID", $section);	
	
	$row->AddInputField("SECTION_ID");
	$row->AddInputField("H1");
	$row->AddInputField("TITLE");
	$row->AddInputField("DESCRIPTION");
	$row->AddInputField("KEYWORDS");
	
	$row->AddActions(array(
		array(
			"ICON" => "edit",
			"TEXT" => Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_EDIT_TITLE"),
			"ACTION" => $adminList->ActionRedirect("kombox_filter_seo_edit.php?ID=".$rule["ID"]."&lang=".LANGUAGE_ID."&iblock_id=".$IBLOCK_ID),
			"DEFAULT" => true,
		),
		array(
			"ICON"=>"delete",
			"TEXT" => Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_DELETE_TITLE"),
			"ACTION" => "if(confirm('".\CUtil::JSEscape(Loc::getMessage('KOMBOX_MODULE_FILTER_SEO_DELETE_CONFIRM'))."')) ".$adminList->ActionDoGroup($id, "delete", "lang=".LANGUAGE_ID."&iblock_id=".$IBLOCK_ID)
		),
	));
}

$aContext = array();

$aContext[] = array(
	"TEXT"	=> Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_ADD"),
	"TITLE"	=> Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_ADD_TITLE"),
	"LINK" => "kombox_filter_seo_edit.php?ID=0&lang=".LANGUAGE_ID."&iblock_id=".$IBLOCK_ID,
);

$adminList->AddAdminContextMenu($aContext);
$adminList->AddGroupActionTable(array("delete"=>GetMessage("MAIN_ADMIN_LIST_DELETE")));

$adminList->CheckListMode();

$APPLICATION->SetTitle(Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_TITLE"));
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

$adminList->DisplayList();

require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
?>