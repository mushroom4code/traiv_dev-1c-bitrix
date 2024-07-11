<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult['ORDERS'] as &$order){
    foreach ($order['BASKET_ITEMS'] as $basketItem){
        $order['RES_TOTAL_WEIGHT'] += intval($basketItem['WEIGHT'] )/ 1000;
    }
}