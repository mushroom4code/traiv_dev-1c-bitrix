<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
die;
$array_cat = [
    '52'/*,
    '53',
    '54',
    '58',
    '68',
    '69',
    '74',
    '75',
    '76',
    '77',
    '994',
    '78',
    '1334'*/
];

/*$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(18, 52);
$arResult["IPROPERTY_VALUES"] = $ipropValues->getValues();
?><pre><?var_dump($arResult["IPROPERTY_VALUES"]);?></pre><?
    echo "<br>";
    
    
    $bs = new CIBlockSection();
    $arFields = [];
    $arFields["IPROPERTY_TEMPLATES"] = array(
        "SECTION_META_DESCRIPTION" => 'Купить болты в Санкт-Петербурге (Спб): все виды, размеры и типы. Низкие цены, оптом и в розницу.'
    );
  */  
    
    //$bs->Update('52', $arFields);
    

$db_list = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 18, /*'SECTION_ID' => '45','ID' => '280',*/ 'ACTIVE'=>'Y'], ['ID','IBLOCK_SECTION_ID']);

while($ar_result = $db_list->GetNext())
{
    $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(18, $ar_result['ID']);
    $arResult["IPROPERTY_VALUES"] = $ipropValues->getValues();
   /* ?><pre><?print_r($arResult["IPROPERTY_VALUES"]);?></pre><?*/
    if (strpos($arResult["IPROPERTY_VALUES"]['SECTION_META_TITLE'],'продажа') !== false ) {
        echo 'SECTION_META_TITLE - <a href="https://traiv-komplekt.ru/bitrix/admin/iblock_section_edit.php?IBLOCK_ID=18&type=catalog&lang=ru&ID='.$ar_result['ID'].'&find_section_section=106&form_section_18_active_tab=edit5" target="_blank">Исправить</a> '.$ar_result['ID'].' - '.$arResult["IPROPERTY_VALUES"]['SECTION_META_TITLE'];
        echo "<br>";
        echo $arResult["IPROPERTY_VALUES"]['SECTION_META_TITLE'];
        echo "<br>";
        echo $NEW_SECTION_META_TITLE = str_replace("продажа","купить",$arResult["IPROPERTY_VALUES"]['SECTION_META_TITLE']);
        
        $bs = new CIBlockSection();
        $arFields = [];
        $arFields["IPROPERTY_TEMPLATES"] = array(
            "SECTION_META_TITLE" => $NEW_SECTION_META_TITLE
        );
        
        
       // $bs->Update($ar_result['ID'], $arFields);
        
    }
    if (strpos($arResult["IPROPERTY_VALUES"]['SECTION_META_DESCRIPTION'],'продажа') !== false) {
        echo 'SECTION_META_DESCRIPTION - <a href="https://traiv-komplekt.ru/bitrix/admin/iblock_section_edit.php?IBLOCK_ID=18&type=catalog&lang=ru&ID='.$ar_result['ID'].'&find_section_section=106&form_section_18_active_tab=edit5" target="_blank">Исправить</a> '.$ar_result['ID'].' - '.$arResult["IPROPERTY_VALUES"]['SECTION_META_DESCRIPTION'];
        echo "<br>";
        
        echo $arResult["IPROPERTY_VALUES"]['SECTION_META_DESCRIPTION'];
        echo "<br>";
        echo $NEW_SECTION_META_DESCRIPTION = str_replace("продажа","купить",$arResult["IPROPERTY_VALUES"]['SECTION_META_DESCRIPTION']);
        
        $bs = new CIBlockSection();
        $arFields = [];
        $arFields["IPROPERTY_TEMPLATES"] = array(
            "SECTION_META_DESCRIPTION" => $NEW_SECTION_META_DESCRIPTION
        );
        
        
       // $bs->Update($ar_result['ID'], $arFields);
        
    }
    
    
}

?>
