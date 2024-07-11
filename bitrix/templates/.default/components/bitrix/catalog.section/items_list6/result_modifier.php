<?php

foreach ($arResult['ITEMS'] as &$item){


    if(!empty($item['DETAIL_PICTURE']['SRC'])){
        $item['DETAIL_PICTURE']['SRC'] = CFile::ResizeImageGet(
            CFile::GetFileArray($item['DETAIL_PICTURE']['ID']),
            array('width' => 180, 'height' => 130),
            BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
            true
        )['src'];
    }

    $strMainID = $this->GetEditAreaId($item['ID']);

    $item['RES_MOD']['BASE_PRICE'] = $item['PRICES']['BASE'];
    $item['RES_MOD']['originalPrice'] = intval($item['RES_MOD']['BASE_PRICE']['VALUE']);
    $item['RES_MOD']['discontPrice'] = intval($item['RES_MOD']['BASE_PRICE']['DISCOUNT_VALUE']);
    $item['RES_MOD']['printPriceValue'] = $item['RES_MOD']['originalPrice'] <= $item['RES_MOD']['discontPrice'] ?
        $item['RES_MOD']['BASE_PRICE']['PRINT_VALUE']
        : $item['RES_MOD']['BASE_PRICE']['PRINT_DISCOUNT_VALUE'];
    $item['RES_MOD']['printPriceValue'] = $item['RES_MOD']['printPriceValue'] ? $item['RES_MOD']['printPriceValue'] : 'по запросу';


    $item['RES_MOD']['label'] = '';
    $item['RES_MOD']['buttonLabel'] = '';
    if($item['CAN_BUY'] and $item['PRODUCT']['QUANTITY'] > 0) {
        $item['RES_MOD']['label'] = 'В наличии';
        $item['RES_MOD']['buttonLabel'] = 'Добавить';
    }elseif($item['CAN_BUY'] and ($item['PRODUCT']['QUANTITY'] == 0)){
        $item['RES_MOD']['label'] = 'Под заказ';
        $item['RES_MOD']['buttonLabel'] = 'Заказать';
    }elseif (!$item['CAN_BUY'] and ($item['PRODUCT']['QUANTITY'] == 0)){
        $item['RES_MOD']['label'] = 'Уведомить о появлении';
        $item['RES_MOD']['buttonLabel'] = 'Уведомить о появлении';
    }else{
        $item['RES_MOD']['label'] = 'Цена и наличие по запросу';
        $item['RES_MOD']['buttonLabel'] = 'Запросить';
    }

}

$arResult["ITEMS"] = rewriteUrl($arResult["ITEMS"]);