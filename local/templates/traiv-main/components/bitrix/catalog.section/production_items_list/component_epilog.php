<? // for canonical url categories
if (!empty($arResult['UF_CANONICAL'])) {
    $APPLICATION->AddHeadString('<link href="https://' . SITE_SERVER_NAME . $arResult['UF_CANONICAL'] . '" rel="canonical" />', true);
}