<?php
$outProducts = [];
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(CModule::IncludeModule("iblock")){

    $arrFilter["IBLOCK_ID"] = 18;
    $arrFilter["ACTIVE"] = "Y";
    foreach ($_GET['filter'] as $key => $value){
        $arrFilter['PROPERTY_' . $key] = $value;
    }

    $res = CIBlockElement::GetList(
        array(),
        $arrFilter,
        false,
        Array("nPageSize" => 1500),
        array("IBLOCK_ID", "ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "CATALOG_GROUP_2")
    );
    while($ob = $res->GetNext())
    {

        $productProperties = CIBlockElement::GetProperty(
            $arrFilter["IBLOCK_ID"],
            $ob['ID'],
            array(),
            array('EMPTY' => "N")
        );

        $image = ($ob['PREVIEW_PICTURE']) ? CFile::GetPath($ob['PREVIEW_PICTURE']) : "/images/no_image.png";

        $outProducts['COUNT']++;
        $outProducts['ITEMS'][$ob['ID']] = [
            'ID' => $ob['ID'],
            'NAME' => $ob['NAME'],
            'URL' => $ob['DETAIL_PAGE_URL'],
            'IMAGE' => $image,
            'PRICE' => $ob['CATALOG_PRICE_2']
        ];

        while($property = $productProperties->Fetch()){
            if(!empty($property['VALUE_ENUM']) and !isset($outProducts['PROPERTIERS'][$property['ID']][$property['VALUE']])){
                $outProducts['PROPERTIES'][$property['ID']][$property['VALUE']] = $property['VALUE_ENUM'];
            }
        }
    }
    header('Content-Type: application/json');
    echo json_encode($outProducts);


}