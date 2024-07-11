<?php
/* $xml = new SimpleXMLElement('<xml version="1.0" encoding="utf-8"/>');*/
die;
$xml = new SimpleXMLElement("<feed></feed>");
$xml->addAttribute('version', '1');

$offers = $xml->addChild('offers');

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$array_cat = [
    '52',
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
    '1334'
/*'50',
'52',    
'53',
'54',
'55',
'1161',
'58',
'68',
'1178',
'65',
'1334',
'67',
'69',
'73',
'74',
'75з',
'76',
'77',
'994',
'78',
'79'*/
];

$db_list = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 18, 'SECTION_ID' => $array_cat, /*'ID' => '504',*/ 'ACTIVE'=>'Y'], ['ID','IBLOCK_SECTION_ID']);
$i=1;
while($ar_result = $db_list->GetNext())
{
    
    $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'SECTION_ID' => $ar_result['ID'], /*'ID' => '108310',*/ 'ACTIVE'=>'Y',">CATALOG_PRICE_2" => 0, array(
        "LOGIC" => "OR",
        ">CATALOG_QUANTITY" => 0, ">PROPERTY_EUROPE_STORAGE" => 0), 'CATALOG_GROUP_ID' => 2], /*['ID','NAME','DETAIL_TEXT','DETAIL_PICTURE','CATALOG_PRICE_2','CATALOG_QUANTITY']*/false);
    
    while($ar_result_in = $db_list_in->GetNext())
    {
     
        if ($ar_result['IBLOCK_SECTION_ID'] == '52' || $ar_result['IBLOCK_SECTION_ID'] == '53') {
            $category = 'Винты и болты';
        }
            else if ($ar_result['IBLOCK_SECTION_ID'] == '54' || $ar_result['IBLOCK_SECTION_ID'] == '65' || $ar_result['IBLOCK_SECTION_ID'] == '68' || $ar_result['IBLOCK_SECTION_ID'] == '74') {
                $category = 'Шайбы и гайки';
            }
            else if ($ar_result['IBLOCK_SECTION_ID'] == '58') {
                $category = 'Заклепки';
            }
            else if ($ar_result['IBLOCK_SECTION_ID'] == '69') {
                $category = 'Такелаж';
            }
            else if ($ar_result['IBLOCK_SECTION_ID'] == '75' || $ar_result['IBLOCK_SECTION_ID'] == '994') {
                $category = 'Шпильки крепежные';
            }
            else{
                $category = 'Крепеж и фурнитура';
            }
        
        $offer = $offers->addChild('offer');
        $offer->addChild('id',$ar_result_in["ID"].$i.rand(1,9));
        $seller = $offer->addChild('seller');
        $contacts = $seller->addChild('contacts');
        $contacts->addChild('phone',"8 800 707-25-98");
        $contacts->addChild('contact-method',"only-phone");
        
        $locations = $seller->addChild('locations');
        $location = $locations->addChild('location');
        $location->addChild('address',"Россия, Санкт-Петербург, Кудрово, ул.Центральная, дом 41");
        
        $origname = $ar_result_in["NAME"];
        $formatedPACKname = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/","",$origname);
        $formatedname = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|Евр|Ев|PU=.*|RU=.*/","",$formatedPACKname);
        
        $offer->addChild('title',$formatedname);
        //$offer->addChild('description',html_entity_decode(htmlspecialchars(strip_tags(str_replace("«","",str_replace("»","",$ar_result_in['DETAIL_TEXT']))))));
        $offer->addChild('condition','new');
        
        $offer->addChild('category',$category);
        
        $images = $offer->addChild('images');
        
        $arFile = CFile::GetFileArray($ar_result_in['DETAIL_PICTURE']);
        if (!empty($arFile['SRC'])){
            $img = "https://traiv-komplekt.ru".$arFile['SRC'];
        } else {
            $img = "https://traiv-komplekt.ru/upload/nfuni.jpg";
        }
        
        $images->addChild('image',$img);

        $offer->addChild('price',round($ar_result_in["CATALOG_PRICE_2"]));
        
        
        $i++;
    }
}

Header('Content-type: text/xml');
echo $xml->asXML();
?>
