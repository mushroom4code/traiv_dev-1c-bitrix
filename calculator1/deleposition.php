<?php

require('bd.php');






$qq = "DELETE FROM `position` WHERE `id` = ".$_GET["id"];



mysqli_query($link,$qq); // запрос на выборку

$g = $_SERVER['HTTP_REFERER'];
echo "<script> document.location.href = '".$g."' </script>";


?>