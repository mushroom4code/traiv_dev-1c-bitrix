<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
$arResult["REGIONS"] = array();
if (count($arParams["REGIONS"]) > 0) {
    foreach ($arParams["REGIONS"] as $city => $phone) {
        $code = Cutil::translit($city,"ru");
        $arResult["REGIONS"][$code] = array(
            "CITY" => $city,
            "PHONE" => $phone,
            "LINK_PHONE" => str_replace(array(" ", "-", "(", ")"), "", $phone)
        );
    }
}
$code = "vsya_rossiya";
// Берем город из куки, если отсутствует, то берем из местоположения

//ВСЯ ЭТА ХЕРНЯ С IPGEOBASE ВЕШАЕТ САЙТ
/*
if (isset($_COOKIE["TRAIV_USER_GEOTARGETING"])) {
    $code = $_COOKIE["TRAIV_USER_GEOTARGETING"];
} else {
	$ip = $_SERVER['REMOTE_ADDR'];
    $result = file_get_contents("http://ipgeobase.ru:7020/geo?ip=".$ip);
	if (empty($result)) {
		$code = "vsya_rossiya";
	} else {
		$xml = new SimpleXMLElement($result);

		$city = $xml->ip->city;
		$code = Cutil::translit($city, "ru");
		// Если такой город не описан, присвоим вся россия
		if (!isset($arResult["REGIONS"][$code]))
		{
			$code = "vsya_rossiya";
		}
		setcookie ("TRAIV_USER_GEOTARGETING", $code, time() + 3153600);
	}
}*/
$arResult["SELECTED"] = $code;
$this->IncludeComponentTemplate();