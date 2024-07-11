<?php
$to = "info@traiv-komplekt.ru";
$subject = "Заявка с сайта";





$name = 'Имя: '.$_POST["name"].'<br/>';
$phone = 'Телефон: '.$_POST["phone"].'<br/>';
$campany = 'КОмпания:'.$_POST["campany"].'<br/>';
$city = 'Город: '.$_POST["city"].'<br/>';
$inn = 'ИИН: '.$_POST["inn"].'<br/>';
$comments = 'Комментарий: '.$_POST["comments"].'<br/>';
$text = $_POST["text"].'<br/>';


$message = $name.$phone.$campany.$city.$inn.$comments.$text;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@example.com>' . "\r\n";
$headers .= 'Cc: example@example.com' . "\r\n";

mail($to,$subject,$message,$headers);
?>
