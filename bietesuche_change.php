<?php

include "header.php";

session_start();

if(!isset($_SESSION['user_id'])) {

    die('Du musst dich zuerst <a href="login.php">einloggen</a>!');

}
//Abfrage der Nutzer ID vom Login

$userID = $_SESSION['user_id'];

include "dbzugriff.php";

$ichbiete = $_POST['biete'];
$ichsuche = $_POST['suche'];

$sql = ("UPDATE users SET suche='$ichsuche', biete='$ichbiete' WHERE user_id = '$userID'");
$query = $db->prepare($sql);
$execute = $query->execute();

if($execute === true) {

//Bestätigung der Anmeldung - wenn success

    echo "Dein Eintrag wurde aktualisiert! Zurück zum Profil";

    exit;

} else {

// Fehler anzeigen - wenn error

    echo "Ein Fehler ist aufgetreten: <br><br>".$query->errorCode();

    exit;

}

?>

