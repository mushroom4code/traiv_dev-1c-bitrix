<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
// echo '<pre>'; print_r($arParams); echo '</pre>';


if ($this->StartResultCache(360000))
{

    $engine = $arParams["ENGINE"];

    $arResult = array(
        "ENGINE" => $engine,
        "AR_USER" => $arParams["AR_USER"]
    );

   //   echo '<pre>'; print_r($arResult); echo '</pre>';
    $this->IncludeComponentTemplate();
}
?>