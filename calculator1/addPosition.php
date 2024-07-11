<?php

require('bd.php');

$metizi = $_POST["metizi"];
$standart = $_POST["standart"];
$diametr = $_POST["diametr"];
$dlina = $_POST["dlina"];
$pokr = $_POST["pokr"];
$classproch = $_POST["classproch"];
$result = $_POST["result"];
$material = $_POST["material"];

 


$qq = "INSERT INTO `position`(`material`,`result`,`metiz`, `standart`, `diametr`, `dlina`, `tippokr`, `classprochn`) VALUES 
('".$material."','".$result."','".$metizi."', '".$standart."', '".$diametr."', '".$dlina."','".$pokr."' ,'".$classproch."')";

$q_isset = "SELECT * FROM `position` WHERE `material` = '".$material."' AND "
    ."`result` = '".$result."' AND "
    ."`metiz` = '".$metizi."' AND "
    ."`standart` = '".$standart."' AND "
    ."`diametr` = '".$diametr."' AND "
    ."`dlina` = '".$dlina."' AND "
    ."`tippokr` = '".$pokr."' AND "
    ."`classprochn` = '".$classproch."'";

$isset = mysqli_query($link,$q_isset);

if(!$isset->num_rows){
    mysqli_query($link,$qq); // запрос на выборку
}

$g = $_SERVER['HTTP_REFERER'];
echo "<script> document.location.href = '".$g."' </script>";


?>