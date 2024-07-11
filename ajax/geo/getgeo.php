<?php 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
/*
function getGeo() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $arrGeo = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
    $country = $arrGeo['geoplugin_countryCode'];
    if (!empty($country)) {
        return $country;
    } else {
        return "RU";
    }
}

echo getGeo();*/

function getLocationInfoByIp(){
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = @$_SERVER['REMOTE_ADDR'];
    $result  = array('country'=>'', 'city'=>'');
    if(filter_var($client, FILTER_VALIDATE_IP)){
        $ip = $client;
    }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }else{
        $ip = $remote;
    }
    //$ip = '80.94.224.0';
    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
    if($ip_data && $ip_data->geoplugin_countryName != null){
        $result['country'] = $ip_data->geoplugin_countryCode;
        $result['city'] = $ip_data->geoplugin_city;
    }
    
    $country = $result['country'];
    
    if (!empty($country)) {
        return $country;
    } else {
        return "RU";
    }
}
echo getLocationInfoByIp();

?>