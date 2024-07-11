<?php

require('bd.php');

$name = $_POST["name"];
$qq = "INSERT INTO `diametr`(`name`) VALUES ('".$name."')";
$q_isset = "SELECT * FROM `diametr` WHERE `name` = '".$name."'";
$isset = mysqli_query($link,$q_isset);
if(!$isset->num_rows){
    mysqli_query($link,$qq); // запрос на выборку
}

$g = $_SERVER['HTTP_REFERER'];
echo "<script> document.location.href = '".$g."' </script>";


?>