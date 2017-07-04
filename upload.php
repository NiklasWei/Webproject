<?php
// Session starten
session_start();

include "header.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Prüfen ob die userid registriert ist und ggf. abbrechen
if(!isset($_SESSION['user_id'])) {
	die('Du musst dich zuerst <a href="login.php">einloggen</a>!');
}




// Speicherort für Bilder
$img_url  = "/upload/";

$formerror = false; //wenn treu dann ist etwas falsch gelaufen

// Datenbankverbindung herstellen
include_once "dbzugriff.php";

function addImgDB($userID, $img_name, $db) {

    $sql = "INSERT INTO Image_upload (user_id, img_name) VALUES ($userID, '$img_name')";
    $query = $db->prepare($sql);
    $execute = $query->execute();



    if($execute === true) {
        return $db->lastInsertId();
    } else {
        echo "error";
        print_r($db->errorInfo());
        exit;
    }
}




function uploadImg ($userID, $db) {

    $dir = "upload/";
    $file = $dir . basename($_FILES["bild"]["name"]);


    if(move_uploaded_file($_FILES["bild"]["tmp_name"], $file)) {
        echo "Upload success!";
        return addImgDB($userID, $_FILES["bild"]["name"], $db);
    } else {
        echo "Error uploading file.";
        exit;
    }
}

?>
