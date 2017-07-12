<?php
session_start();

if(!isset($_SESSION['user_id'])) {

    die('Du musst dich zuerst <a href="login.php">einloggen</a>!');

}

include "dbzugriff.php";

//biete abfrage für Profil
$query = $db->prepare("SELECT biete FROM users WHERE user_name LIKE '$username'");
$query->execute();
$result = $query->fetchAll();
$biete = $result[0]["biete"];


//suche abfrage für Profil
$query = $db->prepare("SELECT suche FROM users WHERE user_name LIKE '$username'");
$query->execute();
$result = $query->fetchAll();
$suche = $result[0]["suche"];
