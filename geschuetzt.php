<?php

session_start();
if(!isset($_SESSION['userid'])) {
    die('Du musst dich zuerst <a href="login.php">einloggen</a>!');
}

//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];

echo "Hallo User: ".$userid;
/**
 * Created by PhpStorm.
 * User: cpnik
 * Date: 08.05.2017
 * Time: 11:29
 */
?>