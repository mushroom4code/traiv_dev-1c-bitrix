<?php


$host = '127.0.0.1';
$db   = 'game';
$user = 'root';
$pass = 'Kr@$ny1k1t';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $opt);


$name = ( isset($_POST['name'] ) && strlen( $_POST['name'] ) ? $_POST['name'] : 'нет значения');
$city = ( isset($_POST['city'] ) && strlen( $_POST['city'] ) ? $_POST['city'] : 'нет значения');
$email = ( isset($_POST['email'] ) && strlen( $_POST['email'] ) ? $_POST['email'] : 'нет значения');
$timergame = ( isset($_POST['timegame'] ) && strlen( $_POST['timegame'] ) ? $_POST['timegame'] : 'нет значения');


// Check if already exist

$check = $pdo->prepare('SELECT `name` FROM result_table WHERE email = :email');

$check->execute(array('email' => $email));

$nameExist = $check->fetchColumn();

    If (empty ($nameExist) and ($nameExist != 'нет значения'))

    {

// Save record

$save = $pdo->prepare("INSERT INTO result_table (`name`, `timergame`, `city`, `email`) VALUES (:username, :timergame, :city, :email)");

$save->execute( array( ':username'=>$name, ':timergame'=>$timergame, ':city'=>$city, ':email'=>$email ) );

    } else {

// Update old record searched by email

$checkTime = $pdo->prepare('SELECT `timergame` FROM result_table WHERE email = :email');

$checkTime->execute(array('email' => $email));

$timeExist = $checkTime->fetchColumn();

If ($timeExist > 0 and $timergame < $timeExist) {

    $update = $pdo->prepare("UPDATE `result_table` SET `timergame`=:timergame WHERE `email` = :email");

    $update->execute(array(':timergame' => $timergame, ':email' => $email));

}

    }

// Show rating

$showRating = $pdo->query('SELECT * FROM `result_table` ORDER BY `timergame`');

while ($row = $showRating->fetch())
{

    If  ($row['timergame'] != 0) {
        $minutes = floor($row['timergame'] / 60);
        $seconds = $row['timergame'] - ($minutes * 60);
        If ($seconds < 10) {
            $seconds = '0' . $seconds;
        }
        $resultTime = $minutes . ':' . $seconds;

        echo $row['name'] . '----------' . $resultTime . '<br>';
    }
}

?>