<?php
// Session starten
session_start();
if(!isset($_SESSION['user_id'])) {
    die('Du musst dich zuerst <a href="login.php">einloggen</a>!');
}
include "header.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Prüfen ob die userid registriert ist und ggf. abbrechen
if(!isset($_SESSION['user_id'])) {
    die('Du musst dich zuerst <a href="login.php">einloggen</a>!');
}

// Speicherort für Bilder
$img_url  = "/profilpictures/";

$formerror = false; //wenn true dann ist etwas falsch gelaufen

// Datenbankverbindung herstellen
include_once "dbzugriff.php";

$userID = $_SESSION['user_id'];

function uploadImg ($userID, $db) {

    $dir = "profilpictures/";
    $file = $dir . $userID . ".jpg";
    if(file_exists($file)) {
        unlink($file);
    }


    if(move_uploaded_file($_FILES["bild"]["tmp_name"], $file)) {
        echo "Upload success!";
    } else {
        echo "Error uploading file.";
        exit;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Aloha / Profilbildupload</title>

</head>
<body style='font-family:Arial,sans-serif;font-size:13px;'>
<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
    <input type="file" name="bild" id="bild" size="45" accept="image/jpeg,image/x-png">
    <input type="submit" name="speichern" value="upload">
</form>
</body>
</html>