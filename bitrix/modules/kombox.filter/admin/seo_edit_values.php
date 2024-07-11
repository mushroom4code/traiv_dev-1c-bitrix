<?
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Kombox\Filter\SeoTable;
use Kombox\Filter\SeoPropertiesTable;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

Loc::loadMessages(dirname(__FILE__).'/seo_edit.php');

if (!$USER->CanDoOperation('seo_tools'))
{
	return false;
}

if(!Main\Loader::includeModule('kombox.filter'))
{
	return false;
}

$IBLOCK_ID = IntVal($iblock_id);
$arIBlock = CIBlock::GetArrayByID($IBLOCK_ID);

$iblocks_seo = COption::GetOptionString('kombox.filter', "iblocks_seo");
	
if(strlen($iblocks_seo))
	$iblocks_seo = unserialize($iblocks_seo);
	
if(!in_array($IBLOCK_ID, $iblocks_seo)){
	return false;
}

$PROPERTY_ID = IntVal($property_id);
/*
$arIBlockProperties = array();
foreach(CIBlockSectionPropertyLink::GetArray($IBLOCK_ID, 0) as $PID => $arLink)
{
	if($arLink['SMART_FILTER'] !== 'Y')
		continue;
	
	$arIBlockProperties[$PID] = true;
}

$arOffersProperties = array();
$SKU_IBLOCK_ID = 0;
if(Main\Loader::includeModule('catalog'))
{
	$arCatalog = CCatalogSKU::GetInfoByProductIBlock($IBLOCK_ID);
	if (!empty($arCatalog) && is_array($arCatalog))
	{
		$SKU_IBLOCK_ID = $arCatalog['IBLOCK_ID'];
		foreach(CIBlockSectionPropertyLink::GetArray($SKU_IBLOCK_ID, 0) as $PID => $arLink)
		{
			if($arLink['SMART_FILTER'] !== 'Y')
				continue;
				
			$arOffersProperties[$PID] = true;
		}
	}
}
*/

//if(isset($arIBlockProperties[$PROPERTY_ID]) || isset($arOffersProperties[$PROPERTY_ID]))
//{
	$rsProperty = CIBlockProperty::GetByID($PROPERTY_ID);
	$arProperty = $rsProperty->Fetch();
	
	$arrFilter = array(
		'IBLOCK_ID' => isset($arIBlockProperties[$PROPERTY_ID]) ? $IBLOCK_ID : $SKU_IBLOCK_ID,
		'ACTIVE_DATE' => 'Y',
		'ACTIVE' => 'Y',
		'CHECK_PERMISSIONS' => 'Y'
	);
	
	$arValues = array();
	
	$rsValues = CIBlockElement::GetList(array(), $arrFilter, array('PROPERTY_'.$PROPERTY_ID));
	while($arValue = $rsValues->Fetch()){
		if(isset($arValue['PROPERTY_'.$PROPERTY_ID.'_ENUM_ID']))
			$arValues[] = $arValue['PROPERTY_'.$PROPERTY_ID.'_ENUM_ID'];
		else
			$arValues[] = $arValue['PROPERTY_'.$PROPERTY_ID.'_VALUE'];
	}
	
	$arResult = array();
	foreach($arValues as $value){
		if(strlen($value))
		{
			$arResult[] = array(
				'VALUE' => base64_encode($value),
				'NAME' => Kombox\Filter\Tools::getFormatValue($arProperty, $value)
			);
		}
	}
	
	echo CUtil::PHPToJSObject($arResult);
	die();
//}
//else
//{
//	return false;
//}