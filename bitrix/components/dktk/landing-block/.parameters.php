<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

$arTypeProd = array('usl' => 'Услуги произоводства', 'zakaz' => 'Производство на заказ', 'coating' => 'Нанесение покрытий');

$arComponentParameters = array(
    'PARAMETERS' => array(
        'URL' => array(
            'NAME' => 'URL',
            'TYPE' => 'STRING',
            'MULTIPLE' => 'N',
            'PARENT' => 'BASE',
        ),
        
        "TYPE_LABEL" => array(
            "PARENT" => "BASE",
            "NAME" => "Тип раздела",
            "TYPE" => "LIST",
            "VALUES" => $arTypeProd,
            "REFRESH" => "N",
        ),
        
        'ELEMENT_CODE' => array(
            'NAME' => 'ELEMENT_CODE',
            'TYPE' => 'STRING',
            'MULTIPLE' => 'N',
            'PARENT' => 'BASE',
        ),
        
    ),

);
?>