<?php
die;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

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

$db_list = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 18, 'SECTION_ID' => $array_cat, 'ID' => '518', 'ACTIVE'=>'Y'], ['ID','IBLOCK_SECTION_ID']);

while($ar_result = $db_list->GetNext())
{
   /* echo "<pre>";
    print_r($ar_result);
    echo "</pre>";*/
    $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'SECTION_ID' => $ar_result['ID'], 'ID' => '108310', 'ACTIVE'=>'Y',">CATALOG_PRICE_2" => 0, array(
        "LOGIC" => "OR",
        ">CATALOG_QUANTITY" => 0, ">PROPERTY_EUROPE_STORAGE" => 0), 'CATALOG_GROUP_ID' => 2], false);
    $i=1;
    while($ar_result_in = $db_list_in->GetNext())
    {
     echo "<pre>";
     print_r($ar_result_in);
     echo "</pre>";
        //die;
        
        /*if ($ar_result['IBLOCK_SECTION_ID'] == '50') {
            $category = 'Анкерные болты';
        }
        else */if ($ar_result['IBLOCK_SECTION_ID'] == '52' || $ar_result['IBLOCK_SECTION_ID'] == '53') {
            $category = 'Винты и болты';
        }
        else if ($ar_result['IBLOCK_SECTION_ID'] == '54' || $ar_result['IBLOCK_SECTION_ID'] == '65' || $ar_result['IBLOCK_SECTION_ID'] == '68' || $ar_result['IBLOCK_SECTION_ID'] == '74') {
            $category = 'Шайбы и гайки';
        }
        /*else if ($ar_result['IBLOCK_SECTION_ID'] == '55') {
            $category = 'Гвозди';
        }*/
        else if ($ar_result['IBLOCK_SECTION_ID'] == '58') {
            $category = 'Заклепки';
        }/*
        else if ($ar_result['IBLOCK_SECTION_ID'] == '67' || $ar_result['IBLOCK_SECTION_ID'] == '79') {
            $category = 'Шурупы и саморезы';
        }*/
        else if ($ar_result['IBLOCK_SECTION_ID'] == '69') {
            $category = 'Такелаж';
        }
        else if ($ar_result['IBLOCK_SECTION_ID'] == '75' || $ar_result['IBLOCK_SECTION_ID'] == '994') {
            $category = 'Шпильки крепежные';
        }/*
        else if ($ar_result['IBLOCK_SECTION_ID'] == '1161') {
            $category = 'Дюбели';
        }*/
        else{
            $category = 'Крепеж и фурнитура';
        }
        
        echo $id = $ar_result_in["ID"].$i;

        $origname = $ar_result_in["NAME"];
        $formatedPACKname = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/","",$origname);
        echo $formatedname = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|Евр|Ев|PU=.*|RU=.*/","",$formatedPACKname);
        

        echo html_entity_decode(htmlspecialchars(strip_tags(str_replace("«","",str_replace("»","",$ar_result_in['DETAIL_TEXT'])))));

        
        echo $category;
        
        
        $arFile = CFile::GetFileArray($ar_result_in['DETAIL_PICTURE']);
        if (!empty($arFile['SRC'])){
            $img = "https://traiv-komplekt.ru".$arFile['SRC'];
        } else {
            $img = "https://traiv-komplekt.ru/upload/nfuni.jpg";
        }
        
        echo $img;
        echo $price = $ar_result_in["CATALOG_PRICE_2"];
       
        echo "<br>";
        $i++;
    }
}

?>
