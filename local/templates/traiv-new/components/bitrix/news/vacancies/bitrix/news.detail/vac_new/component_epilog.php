<? // for canonical url categories
if (!empty($arResult['PROPERTIES']['CANT']['VALUE'])) {
    $APPLICATION->AddHeadString('<link href="' . $arResult['PROPERTIES']['CANT']['VALUE'] . '" rel="canonical" />', true);
}