<?php
if ($_COOKIE['enter'] != 'yes') {
    $g = '/calculator1/enter.php';
    echo "<script> document.location.href = '" . $g . "' </script>";
}
?>

<html>

<style>

    .form {
        display: inline-block;
        background: #9a9a9a;
        padding: 9px;
        vertical-align: top;
        display: inline-block;
        background: #9a9a9a;
        padding: 0px;
        vertical-align: top;
        width: 200px;
        text-align: center;
    }
    .form input {
        width: 110px;
        font-size: 13px;
    }
    .rtp {
        color: #fff;
        font-family: sans-serif;
        text-align: center;
        margin-bottom: 12px;
    }
    .rtp a {
        color: #ffffff;
        text-decoration: none;
        background: #686868;
        padding: 4px 5px;
        display: inline-block;
        border-radius: 5px;
        font-size: 13px;
    }

</style>


<?php require('bd.php'); ?>

<div class="form">
    <form method="POST" action="metiz.php">
        <input placeholder="ТИП МЕТИЗОВ" required type="text" name="name"/>
        <input type="submit" value="добавить"/>
    </form>
    <?php
    $ter = "SELECT * FROM `metizi` ORDER BY `name` ASC ";
    $result = mysqli_query($link, $ter); // запрос на выборку
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <div class="rtp"><?php echo $row['name']; ?> <a href="delmetizov.php?id=<?php echo $row['id']; ?>">удалить</a>
        </div>
        <?php
    }
    ?>
</div>
<div class="form">
    <form method="POST" action="standart.php">
        <input placeholder="СТАНДАРТ" required type="text" name="name"/>
        <input type="submit" value="добавить"/>
    </form>
    <?php
    $ter = "SELECT * FROM `standart` ORDER BY `name` ASC";
    $result = mysqli_query($link, $ter); // запрос на выборку
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <div class="rtp"><?php echo $row['name']; ?> <a href="delstandart.php?id=<?php echo $row['id']; ?>">удалить</a>
        </div>
        <?php
    }
    ?>
</div>


<div class="form">
    <form method="POST" action="diametr.php">
        <input placeholder="ДИАМЕТР" required type="text" name="name"/>
        <input type="submit" value="добавить"/>
    </form>

    <?php
    $ter = "SELECT * FROM `diametr` ORDER BY `name` ASC";
    $result = mysqli_query($link, $ter); // запрос на выборку
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <div class="rtp"><?php echo $row['name']; ?> <a href="deldiametr.php?id=<?php echo $row['id']; ?>">удалить</a>
        </div>
        <?php
    }
    ?>


</div>


<div class="form">
    <form method="POST" action="dlina.php">
        <input placeholder="ДЛИНА" required type="text" name="name"/>
        <input type="submit" value="добавить"/>
    </form>

    <?php
    $ter = "SELECT * FROM `dlina` ORDER BY `name` ASC";
    $result = mysqli_query($link, $ter); // запрос на выборку
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <div class="rtp"><?php echo $row['name']; ?> <a href="deldlina.php?id=<?php echo $row['id']; ?>">удалить</a>
        </div>
        <?php
    }
    ?>


</div>


<div class="form">
    <form method="POST" action="tippokr.php">
        <input placeholder="ТИП ПОКРЫТИЯ" required type="text" name="name"/>
        <input type="submit" value="добавить"/>
    </form>


    <?php
    $ter = "SELECT * FROM `pokr` ORDER BY `name` ASC";
    $result = mysqli_query($link, $ter); // запрос на выборку
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <div class="rtp"><?php echo $row['name']; ?> <a href="deltippokr.php?id=<?php echo $row['id']; ?>">удалить</a>
        </div>
        <?php
    }
    ?>

</div>


<div class="form">
    <form method="POST" action="classproch.php">
        <input placeholder="КЛАСС ПРОЧНОСТИ" required type="text" name="name"/>
        <input type="submit" value="добавить"/>
    </form>

    <?php
    $ter = "SELECT * FROM `classproch` ORDER BY `name` ASC";
    $result = mysqli_query($link, $ter); // запрос на выборку
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <div class="rtp"><?php echo $row['name']; ?> <a
                    href="delclassproch.php?id=<?php echo $row['id']; ?>">удалить</a></div>
        <?php
    }
    ?>


</div>


<div class="form">
    <form method="POST" action="material.php">
        <input placeholder="Материал" required type="text" name="name"/>
        <input type="submit" value="добавить"/>
    </form>

    <?php
    $ter = "SELECT * FROM `material` ORDER BY `name` ASC";
    $result = mysqli_query($link, $ter); // запрос на выборку
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <div class="rtp"><?php echo $row['name']; ?> <a href="delmaterial.php?id=<?php echo $row['id']; ?>">удалить</a>
        </div>
        <?php
    }
    ?>


</div>


</html>