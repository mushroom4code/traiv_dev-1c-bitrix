<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arViewModeList = array('LIST', 'LINE', 'TEXT', 'TILE');

$arDefaultParams = array(
	'VIEW_MODE' => 'LIST',
	'SHOW_PARENT_NAME' => 'Y',
	'HIDE_SECTION_NAME' => 'N'
);

$arParams = array_merge($arDefaultParams, $arParams);

if (!in_array($arParams['VIEW_MODE'], $arViewModeList))
	$arParams['VIEW_MODE'] = 'LIST';
if ('N' != $arParams['SHOW_PARENT_NAME'])
	$arParams['SHOW_PARENT_NAME'] = 'Y';
if ('Y' != $arParams['HIDE_SECTION_NAME'])
	$arParams['HIDE_SECTION_NAME'] = 'N';

$arResult['VIEW_MODE_LIST'] = $arViewModeList;


/*Фильтр зачем-то*/
if (0 < $arResult['SECTIONS_COUNT'])
{
	if ('LIST' != $arParams['VIEW_MODE'])
	{
		$boolClear = false;
		$arNewSections = array();
		foreach ($arResult['SECTIONS'] as &$arOneSection)
		{
			if (($arParams['SECTION_TOP_DEPTH'] < $arOneSection['RELATIVE_DEPTH_LEVEL']) and (!empty($arParams['SECTION_TOP_DEPTH'])))
			{
				$boolClear = true;
				continue;
			}
			$arNewSections[] = $arOneSection;
		}
		unset($arOneSection);
		if ($boolClear)
		{
			$arResult['SECTIONS'] = $arNewSections;
			$arResult['SECTIONS_COUNT'] = count($arNewSections);
		}
		unset($arNewSections);
	}
}
/**/

if (0 < $arResult['SECTIONS_COUNT'])
{
	$arSelect = array('ID', 'PICTURE');
	$arMap = array();
	if ('LINE' == $arParams['VIEW_MODE'] || 'TILE' == $arParams['VIEW_MODE'])
	{
		reset($arResult['SECTIONS']);
		$arCurrent = current($arResult['SECTIONS']);

		if ('LINE' == $arParams['VIEW_MODE'] && !array_key_exists('DESCRIPTION', $arCurrent))
		{
			$arSelect[] = 'DESCRIPTION';
			$arSelect[] = 'DESCRIPTION_TYPE';
		}
	}

    foreach ($arResult['SECTIONS'] as $key => $arSection)
    {
        $arMap[$arSection['ID']] = $key;
    }

    $rsSections = CIBlockSection::GetList(array(), array('ID' => array_keys($arMap)), false, $arSelect);
    while ($arSection = $rsSections->GetNext())
    {
        if (!isset($arMap[$arSection['ID']]))
            continue;
        $key = $arMap[$arSection['ID']];
        if (intval($arSection['PICTURE']) > 0)
        {
            $arSection['PICTURE'] = CFile::ResizeImageGet(CFile::GetFileArray($arSection['PICTURE']), array('width' => 200, 'height' => 140), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
            $arResult['SECTIONS'][$key]['PICTURE'] = $arSection['PICTURE'];
            $arResult['SECTIONS'][$key]['~PICTURE'] = $arSection['~PICTURE'];

        }
        if (!empty($arSection['DESCRIPTION']))
        {
            $arResult['SECTIONS'][$key]['DESCRIPTION'] = $arSection['DESCRIPTION'];
            $arResult['SECTIONS'][$key]['~DESCRIPTION'] = $arSection['~DESCRIPTION'];
            $arResult['SECTIONS'][$key]['DESCRIPTION_TYPE'] = $arSection['DESCRIPTION_TYPE'];
            $arResult['SECTIONS'][$key]['~DESCRIPTION_TYPE'] = $arSection['~DESCRIPTION_TYPE'];
        }
    }

}
?>