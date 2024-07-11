<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult["ITEMS"] as $key => $arItem) {
    $arResult["ITEMS"][$key]["RESIZE_IMAGE"] = array();
    if (!empty($arItem['PREVIEW_PICTURE'])) {
        $arFileTmp = CFile::ResizeImageGet(
            $arItem['PREVIEW_PICTURE']["ID"],
            array("width" => 930, "height" => 270),
            BX_RESIZE_IMAGE_EXACT ,
            true
        );
        $arResult["ITEMS"][$key]["RESIZE_IMAGE"] = $arFileTmp;
    }
}