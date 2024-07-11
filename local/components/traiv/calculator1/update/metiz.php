<?php
require('../bd.php');
$i = 0;
$idd = $_POST["id"];


$RowWithName = "SELECT id from `standart` WHERE name='".$idd."'";
$ididid = mysqli_query($link,$RowWithName);
while($rowrowrow = mysqli_fetch_array($ididid)) {

    $idFromName = $rowrowrow["id"];
}


$ter1 = "SELECT * FROM `position` WHERE `standart` = ".$idFromName;
$result1 = mysqli_query($link,$ter1); // запрос на выборку
while($row1 = mysqli_fetch_array($result1)) {


    $sss[$i] = $row1["metiz"];


    $i++;
}




$new = array_unique($sss);



$new = array_values($new);




$i = 0;
$arr = [];
while($new[$i]) {
    $ter12 = "SELECT * FROM `metizi` WHERE `id` = ".$new[$i];




    $result12 = mysqli_query($link,$ter12);
    while($row12 = mysqli_fetch_array($result12)) {
        $arr[$row12['id']] = $row12['name'];
    }
    $i++;
}
asort($arr);
foreach ($arr as $key=>$val){
    ?>
    <option value="<?=$key;?>"> <?=$val;?> </option>
    <?php
}
