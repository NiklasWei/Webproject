<?php

session_start();
if(!isset($_SESSION['user_id'])) {
    die('Du musst dich zuerst <a href="login.php">einloggen</a>!');
}

//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['user_id'];

echo "Hallo User: ".$userid;

echo "<a href=upload.php>Foto hochladen</a>";
/**
 * Created by PhpStorm.
 * User: cpnik
 * Date: 08.05.2017
 * Time: 11:29 top
 */
?>