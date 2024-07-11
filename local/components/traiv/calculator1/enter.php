<?php
if ($_COOKIE['enter'] == 'yes') {
	$g = 'http://traiv-komplekt.ru/calculator1/admin.php';
	echo "<script> document.location.href = '".$g."' </script>";
}

$login = $_POST['login'];
$password = $_POST['password'];
if (($login == 'admin74345Hddg@') && ($password == 'aSfhwlpc7234%$dsnJH')) {
	setcookie('enter','yes');
	$g = 'http://traiv-komplekt.ru/calculator1/admin.php';
	echo "<script> document.location.href = '".$g."' </script>";
}




?>

<style>

html {
	    background: #333;
}

form {
	width: 300px;
    text-align: CENTER;
    margin: 0 auto;
	margin-top: 220px;
}

.ss {
	display: block;
    margin: 0 auto;    margin-top: 12px;
}

input {
margin-top: 12px;
    border: 1px solid #333;
    padding: 10px;
    border-radius: 5px;
	
}



</style>







<form method="POST">
<input type="text" name="login" placeholder="Login"/>
<input type="password" name="password" placeholder="Password"/>
<input type="submit" class="ss" value="Войти"/>
</form>