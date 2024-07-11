<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

// Ресайзим картинки
$width = 105;
$heigth = 105;
foreach ($arResult["ITEMS"] as $key => $arItem) {
    // Отресайзим изображение
    $image = array();
    if (!empty($arItem["PREVIEW_PICTURE"]) || !empty($arItem["DETAIL_PICTURE"])) {
        $id = empty($arItem["PREVIEW_PICTURE"]) ? $arItem["DETAIL_PICTURE"]["ID"] : $arItem["PREVIEW_PICTURE"]["ID"];
        $image = CFile::ResizeImageGet($id, array("width" => $width, "height" => $heigth), BX_RESIZE_IMAGE_PROPORTIONAL, true); 
    }
    $arResult["ITEMS"][$key]["IMAGE"] = $image;
}
