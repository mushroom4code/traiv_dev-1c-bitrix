<?php
require('../bd.php');
$i = 0;

$metizi = $_POST['metizi'];
$standart = $_POST['standart'];
$diametr = $_POST['diametr'];

$dlina = $_POST['dlina'];
$pokr = $_POST['pokr'];
$classproch = $_POST['classproch'];
$material = $_POST['material'];


$RowWithName = "SELECT id from `standart` WHERE name='".$standart."'";
$ididid = mysqli_query($link,$RowWithName);
while($rowrowrow = mysqli_fetch_array($ididid)) {

    $idFromName = $rowrowrow["id"];
}



/*$ter1 = "SELECT * FROM `position` WHERE 
`metiz` = '".$metizi."' AND 
`material` = '".$material."' AND
`standart` = '".$idFromName."' AND
`diametr` = '".$diametr."' AND
`dlina` = '".$dlina."' AND
`classprochn` = '".$classproch."' AND
`tippokr` = '".$pokr."'";*/
 
/*for gost*/

$ter1 = "SELECT * FROM `position` WHERE 
/*`metiz` = '".$metizi."' AND*/ 
`material` = '".$material."' AND
`standart` = '".$idFromName."' AND
`diametr` = '".$diametr."' AND
`dlina` = '".$dlina."' AND
/*`classprochn` = '".$classproch."' AND*/
`tippokr` = '".$pokr."'";


$result1 = mysqli_query($link,$ter1); // запрос на выборку
while($row1 = mysqli_fetch_array($result1)) {
echo htmlspecialchars($row1['result']);
break;
}