<?php
die;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$db_list = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'ID' => '129631','ACTIVE'=>'Y'], [/*'ID','IBLOCK_SECTION_ID','PROPERTY_CML2_ARTICLE'*/'*']);

while($ar_result = $db_list->GetNext())
{
    //$db_props = CIBlockElement::GetProperty(18, '106087', array("sort" => "asc"), Array("CODE" => "CML2_ARTICLE"));
    
    //$arResult["IPROPERTY_VALUES"] = $ipropValues->getValues();
    ?><pre><?print_r($ar_result);?></pre><?
    
}

?>
