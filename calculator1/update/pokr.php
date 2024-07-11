<?php
require('../bd.php');
$i = 0;
$idd = $_POST["id"];
$idd2 = $_POST["metizid"];
$standartid = $_POST["standartid"];
$materialid = $_POST["materialid"];
$diametrid = $_POST["diametrid"];
$dlinaid = $_POST["dlinaid"];

$ter1 = "SELECT * FROM `position` WHERE `dlina` = " . $idd
    . " AND `metiz` = " . $idd2
    . " AND `standart` = " . $standartid
    . " AND `material` = " . $materialid
    . " AND `diametr` = " . $diametrid;
$result1 = mysqli_query($link, $ter1); // запрос на выборку
while ($row1 = mysqli_fetch_array($result1)) {
    $sss[$i] = $row1["tippokr"];
    $i++;
}

$new = array_unique($sss);
$new = array_values($new);

$i = 0;
$arr = [];
while ($new[$i]) {
    $ter12 = "SELECT * FROM `pokr` WHERE `id` = " . $new[$i];
    $result12 = mysqli_query($link, $ter12);

    while ($row12 = mysqli_fetch_array($result12)) {
        $arr[$row12['id']] = $row12['name'];
    }
    $i++;
}

asort($arr);
foreach ($arr as $key => $val) {
    ?>
    <option value="<?= $key; ?>"> <?= $val; ?> </option>
    <?php
}