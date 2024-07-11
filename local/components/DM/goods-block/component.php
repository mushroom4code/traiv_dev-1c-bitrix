<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule('iblock');
/*if (!empty($arParams['ARRITEMS'])){
    $arParams['ARRITEMS'] = explode(",", $arParams['ARRITEMS']);
}*/
$arResult['ARRITEMS'] = $arParams['ARRITEMS'];
$this->IncludeComponentTemplate();

?>