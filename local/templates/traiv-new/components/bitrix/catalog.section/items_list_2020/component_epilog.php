<? // for canonical url categories
if (!empty($arResult['UF_CANONICAL'])) {
    $APPLICATION->AddHeadString('<link href="https://' . SITE_SERVER_NAME . $arResult['UF_CANONICAL'] . '" rel="canonical" />', true);
}

$LastModified_unix = Bitrix\Main\Type\DateTime::createFromUserTime($arResult['TIMESTAMP_X']); // время последнего изменения страницы
$LastModified_unix=$LastModified_unix->getTimestamp();

$LastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
$IfModifiedSince = false;
if (isset($_ENV['HTTP_IF_MODIFIED_SINCE']))
    $IfModifiedSince = strtotime(substr($_ENV['HTTP_IF_MODIFIED_SINCE'], 5));
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']))
    $IfModifiedSince = strtotime(substr($_SERVER['HTTP_IF_MODIFIED_SINCE'], 5));
if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
    exit;
}
header('Last-Modified: '. $LastModified);