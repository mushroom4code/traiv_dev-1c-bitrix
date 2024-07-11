<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @global array $arCurrentValues */
/** @var array $templateProperties */

use Bitrix\Main\Loader,
	Bitrix\Catalog,
	Bitrix\Iblock;

if (!Loader::includeModule('sale'))
	return;


$arComponentParameters = array(
    "GROUPS" => array(
    ),
    "PARAMETERS" => array(
     "AJAX_MODE" => array(),
     "USER_CONSENT" => array(),
    )
); 


