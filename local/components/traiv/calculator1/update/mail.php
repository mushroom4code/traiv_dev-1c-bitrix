<?php
$to = "info@traiv-komplekt.ru";
$subject = "Заявка с сайта";

$name_call = 'Имя: '.$_POST["name"];
$phone_call = 'Телефон: '.$_POST["phone"];
$campany_call = 'Компания:'.$_POST["campany"];
$comments_call = 'Комментарий: '.$_POST["comments"];

$name = 'Имя: '.$_POST["name"].'<br/>';
$phone = 'Телефон: '.$_POST["phone"].'<br/>';
$campany = 'Компания:'.$_POST["campany"].'<br/>';
$city = 'Город: '.$_POST["city"].'<br/>';
$inn = 'ИИН: '.$_POST["inn"].'<br/>';
$comments = 'Комментарий: '.$_POST["comments"].'<br/>';
$text = $_POST["text"].'<br/>';

if (!empty($name) && !empty($phone) && !empty($campany) && !empty($city) && !empty($inn) && !empty($comments)) {
    $ct_site_id = '52033';
    $subject_call = "Форма заказа Калькулятор";
    $requestUrl = "https://traiv-komplekt.ru/calculator/";
    $requestNumber = rand(900000,1000000);
    $requestDate = date("d.m.Y H:i:s");
    
    $call_value = $_COOKIE['_ct_session_id']; /* ID сессии Calltouch, полученный из cookie */
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded;charset=utf-8"));
    curl_setopt($ch, CURLOPT_URL,'https://api.calltouch.ru/calls-service/RestAPI/requests/'.$ct_site_id.'/register/');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
        "fio=".urlencode($name_call)
        ."&phoneNumber=".$phone_call
        ."&subject=".urlencode($subject_call)
        ."&requestNumber=".$requestNumber
        ."&requestDate=".$requestDate
        ."&requestUrl=".urlencode($requestUrl)
        ."&comment=".urlencode($comments_call)
        ."".($call_value != 'undefined' ? "&sessionId=".$call_value : ""));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $calltouch = curl_exec ($ch);
    curl_close ($ch);
}

$message = $name.$phone.$campany.$city.$inn.$comments.$text;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@example.com>' . "\r\n";
$headers .= 'Cc: example@example.com' . "\r\n";

mail($to,$subject,$message,$headers);
?>
