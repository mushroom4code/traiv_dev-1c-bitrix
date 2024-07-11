<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
$neededPropertiesForFilterTuning = array(
    'open' => array(
        467, 468, 466, 469, 470, //master flash
        491, 492, 477, 476, 480, 483, 481, 484, 482, 485, 488,//болты
        524, 525, 521, 522, 526, 527, 530, 548//винты
    ),
    'hidden' => array(512, 548)
);

$availableProperties = [];
foreach ($arResult['PROPERTIES'] as $property){
    if(!empty($property['VALUE'])){
        if(in_array(intval($property['ID']), $neededPropertiesForFilterTuning['open'])){
            $availableProperties['open'][] = intval($property['ID']);
        }elseif(in_array(intval($property['ID']), $neededPropertiesForFilterTuning['hidden'])){
            $availableProperties['hidden'][] = intval($property['ID']);
        }
    }
}
//Получаем все значения свойств для фильтра
if (CModule::IncludeModule("iblock")) {
    $property_enums = CIBlockPropertyEnum::GetList(array(), array("IBLOCK_ID" => $arResult["IBLOCK_ID"]));
    while ($enum_fields = $property_enums->GetNext()) {
        if(in_array($enum_fields['PROPERTY_ID'], array_merge($availableProperties['hidden'], $availableProperties['open']))){
            $arResult['RES_MOD']['SEARCH_PROPERTIES'][$enum_fields['PROPERTY_ID']]['ID'] = $enum_fields['PROPERTY_ID'];
            $arResult['RES_MOD']['SEARCH_PROPERTIES'][$enum_fields['PROPERTY_ID']]['open'] = in_array($enum_fields['PROPERTY_ID'], $availableProperties['hidden']) ? 0 : 1;
            if($arResult['RES_MOD']['SEARCH_PROPERTIES'][$enum_fields['PROPERTY_ID']]['open']){
                $arResult['RES_MOD']['SEARCH_PROPERTIES'][$enum_fields['PROPERTY_ID']]['NAME'] = $enum_fields['PROPERTY_NAME'];
                $arResult['RES_MOD']['SEARCH_PROPERTIES'][$enum_fields['PROPERTY_ID']]['VALUES'][] = array(
                    'ID' => $enum_fields['ID'],
                    'VALUE' => $enum_fields['VALUE'],
                    //'SELECTED' => $enum_fields['VALUE'] === $arResult['PROPERTIES'][$enum_fields['PROPERTY_CODE']]['VALUE'] ? 1 : 0
                );
            }else{
                if(empty($arResult['RES_MOD']['SEARCH_PROPERTIES'][$enum_fields['PROPERTY_ID']]['VALUE'])){
                    $arResult['RES_MOD']['SEARCH_PROPERTIES'][$enum_fields['PROPERTY_ID']]['VALUE'] = getPropertyValueCurrentProductByID($enum_fields['PROPERTY_ID'], $arResult['PROPERTIES']);
                }
            }

        }
    }
}
$arResult['RES_MOD']['FILTER_AVAILABLE'] = count($availableProperties) > 0;

//print_r($arResult['RES_MOD']['SEARCH_PROPERTIES']);

unset($availableProperties, $neededPropertiesForFilterTuning);


function getPropertyValueCurrentProductByID($id, $properties){
    foreach ($properties as $property){
        if($property["ID"] == $id and ($property['VALUE_XML_ID'] != "")){
            return $property["VALUE"];
        }
    }
    return false;
}