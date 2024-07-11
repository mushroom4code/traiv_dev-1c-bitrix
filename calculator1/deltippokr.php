<?php

require('bd.php');

$id = $_GET["id"];
$qq = "DELETE FROM `pokr` WHERE `id` = ".$id;


mysqli_query($link,$qq); // запрос на выборку

$g = $_SERVER['HTTP_REFERER'];
echo "<script> document.location.href = '".$g."' </script>";


?>