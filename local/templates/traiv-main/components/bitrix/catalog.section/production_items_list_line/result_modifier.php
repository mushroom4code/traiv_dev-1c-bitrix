<?php
//usort($arResult['ITEMS'], function($a, $b) {
//    $a = $a['PRICES']['BASE']['VALUE'];
//    $b = $b['PRICES']['BASE']['VALUE'];
//
//
//    if ($a == $b) {
//        return 0;
//    } elseif (($a < $b)) {
//        return empty($a) ? 1 : -1;
//    } else {
//        return empty($b) ? -1 : 1;
//    }
//});
$arResult["ITEMS"] = rewriteUrl($arResult["ITEMS"]);