
<?php
if ($_COOKIE['enter'] != 'yes') {
	$g = 'http://traiv-komplekt.ru/calculator1/enter.php';
	echo "<script> document.location.href = '".$g."' </script>";
}
?>








<html>
	
	<style>
	
	
	.sssss2 {
	display: inline-block;
	}
	
	.sssss2 label {
	display: block;	
	}
	
	.delete {
	color: #fff;
    text-decoration: none;
    font-family: monospace;
	}
	
	
	
	
		
		.form {
  background: #9a9a9a;   padding: 9px; vertical-align: top;
		}
		
		
		form {
    margin-bottom: 0px;
    padding-bottom: 12px;
    background: #9a9a9a;
    padding-left: 12px;
		}
		
		
		.form input {
			    width: 110px;
    font-size: 13px; 
		}
		
		.rtp {
	color: #fff;
    font-family: sans-serif;
    text-align: center;    margin-bottom: 12px;
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
<form method="POST" action="addPosition.php">

<select name="metizi">
<?php
$ter = "SELECT * FROM `metizi` ORDER BY `id` DESC";
$result = mysqli_query($link,$ter); // запрос на выборку
while($row=mysqli_fetch_array($result))
{
?>
<option value="<?php echo $row["id"]; ?>"> <?php echo $row["name"]; ?> </option>
<?php
}
?>
</select>


<select name="standart">
<?php
$ter = "SELECT * FROM `standart` ORDER BY `id` DESC";
$result = mysqli_query($link,$ter); // запрос на выборку
while($row=mysqli_fetch_array($result))
{
?>
<option value="<?php echo $row["id"]; ?>"> <?php echo $row["name"]; ?> </option>
<?php
}
?>
</select>



<select name="material">
<?php
$ter = "SELECT * FROM `material` ORDER BY `id` DESC";
$result = mysqli_query($link,$ter); // запрос на выборку
while($row=mysqli_fetch_array($result))
{
?>
<option value="<?php echo $row["id"]; ?>"> <?php echo $row["name"]; ?> </option>
<?php
}
?>
</select>





<select name="diametr">
<?php
$ter = "SELECT * FROM `diametr` ORDER BY `id` DESC";
$result = mysqli_query($link,$ter); // запрос на выборку
while($row=mysqli_fetch_array($result))
{
?>
<option value="<?php echo $row["id"]; ?>"> <?php echo $row["name"]; ?> </option>
<?php
}
?>
</select>





<select name="dlina">
<?php
$ter = "SELECT * FROM `dlina` ORDER BY `id` DESC";
$result = mysqli_query($link,$ter); // запрос на выборку
while($row=mysqli_fetch_array($result))
{
?>
<option value="<?php echo $row["id"]; ?>"> <?php echo $row["name"]; ?> </option>
<?php
}
?>
</select>



<select name="pokr">
<?php
$ter = "SELECT * FROM `pokr` ORDER BY `id` DESC";
$result = mysqli_query($link,$ter); // запрос на выборку
while($row=mysqli_fetch_array($result))
{
?>
<option value="<?php echo $row["id"]; ?>"> <?php echo $row["name"]; ?> </option>
<?php
}
?>
</select>






<select name="classproch">
<?php
$ter = "SELECT * FROM `classproch` ORDER BY `id` DESC";
$result = mysqli_query($link,$ter); // запрос на выборку
while($row=mysqli_fetch_array($result))
{
?>
<option value="<?php echo $row["id"]; ?>"> <?php echo $row["name"]; ?> </option>
<?php
}
?>
</select>





<input type="text" required name="result" placeholder="Результат" />	





<input type="submit" value="добавить"/>	

</form>	


</div>	
	
	
<?php
$ter = "SELECT * FROM `position` ORDER BY id DESC";
$result = mysqli_query($link,$ter); // запрос на выборку
while($row=mysqli_fetch_array($result))
{
?>
<form method="POST" action="repostition.php">

<div class="sssss2">
<label> Тип метизов </label>
<select name="metizi">
<?php
$ter1 = "SELECT * FROM `metizi` ORDER BY `id` DESC";
$result1 = mysqli_query($link,$ter1); // запрос на выборку
while($row1 = mysqli_fetch_array($result1)) {
?>
<option value="<?php echo $row1["id"];  ?>" <?php if ($row1["id"] == $row["metiz"]) { echo ' selected ';  } ?>> <?php echo $row1["name"];  ?> </option>	
<?php	
}
?>
</select>
</div>

<div class="sssss2">
<label> Стандарт </label>
<select name="standart">
<?php
$ter1 = "SELECT * FROM `standart` ORDER BY `id` DESC";
$result1 = mysqli_query($link,$ter1); // запрос на выборку
while($row1 = mysqli_fetch_array($result1)) {
?>
<option value="<?php echo $row1["id"];  ?>" <?php if ($row1["id"] == $row["standart"]) { echo ' selected ';  } ?>> <?php echo $row1["name"];  ?> </option>	
<?php	
}
?>
</select>
</div>


<div class="sssss2">
<label> Материал </label>
<select name="material">
<?php
$ter1 = "SELECT * FROM `material` ORDER BY `id` DESC";
$result1 = mysqli_query($link,$ter1); // запрос на выборку
while($row1 = mysqli_fetch_array($result1)) {
?>
<option value="<?php echo $row1["id"];  ?>" <?php if ($row1["id"] == $row["material"]) { echo ' selected ';  } ?>> <?php echo $row1["name"];  ?> </option>	
<?php	
}
?>
</select>
</div>


<div class="sssss2">
<label> Диаметр </label>
<select name="diametr">
<?php
$ter1 = "SELECT * FROM `diametr` ORDER BY `id` DESC";
$result1 = mysqli_query($link,$ter1); // запрос на выборку
while($row1 = mysqli_fetch_array($result1)) {
?>
<option value="<?php echo $row1["id"];  ?>" <?php if ($row1["id"] == $row["diametr"]) { echo ' selected ';  } ?>> <?php echo $row1["name"];  ?> </option>	
<?php	
}
?>
</select>
</div>



<div class="sssss2">
<label> Длина </label>
<select name="dlina">
<?php
$ter1 = "SELECT * FROM `dlina` ORDER BY `id` DESC";
$result1 = mysqli_query($link,$ter1); // запрос на выборку
while($row1 = mysqli_fetch_array($result1)) {
?>
<option value="<?php echo $row1["id"];  ?>" <?php if ($row1["id"] == $row["dlina"]) { echo ' selected ';  } ?>> <?php echo $row1["name"];  ?> </option>	
<?php	
}
?>
</select>
</div>

<div class="sssss2">
<label> Тип покрытия </label>
<select name="pokr">
<?php
$ter1 = "SELECT * FROM `pokr` ORDER BY `id` DESC";
$result1 = mysqli_query($link,$ter1); // запрос на выборку
while($row1 = mysqli_fetch_array($result1)) {
?>
<option value="<?php echo $row1["id"];  ?>" <?php if ($row1["id"] == $row["tippokr"]) { echo ' selected ';  } ?>> <?php echo $row1["name"];  ?> </option>	
<?php	
}
?>
</select>
</div>

<div class="sssss2">
<label> Класс прочности </label>
<select name="classproch">
<?php
$ter1 = "SELECT * FROM `classproch` ORDER BY `id` DESC";
$result1 = mysqli_query($link,$ter1); // запрос на выборку
while($row1 = mysqli_fetch_array($result1)) {
?>
<option value="<?php echo $row1["id"];  ?>" <?php if ($row1["id"] == $row["classprochn"]) { echo ' selected ';  } ?>> <?php echo $row1["name"];  ?> </option>	
<?php	
}
?>
</select>
</div>


<input type="hidden" name="id" value="<?php echo $row["id"]; ?>"/> 


<input type="text" required name="result" value="<?php echo $row["result"]; ?>"/>
 
<input type="submit" value="сохранить"/> 
<a class="delete" href="deleposition.php?id=<?php echo $row["id"]; ?>">удалить</a>

</form>
<?php
}
?>

	
	
	
</html>