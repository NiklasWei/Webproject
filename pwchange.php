<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    die('Du musst dich zuerst <a href="login.php">einloggen</a>!');
}
include "header.php";
include "dbzugriff.php";

//Abfrage der Nutzer ID von der Session
$userID = $_SESSION['user_id'];

//neues Passwort eingeben
if(isset($_GET['send'])) {
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];

    if ($passwort != $passwort2) {
        echo "Bitte identische Passwörter eingeben";
    } else { //Speichert neues Passwort
        $passworthash = md5($passwort);
        $sql = ("UPDATE users SET pw = '$passworthash' WHERE user_id = '$userID'");
        $query = $db->prepare($sql);
        $execute_CFE = $query->execute();
        if ($execute_CFE === true) {
//Bestätigung der Anmeldung - wenn success
            echo "Dein Passwort wurde geändert!";
            exit;
        } else {
// Fehler anzeigen - wenn error
            echo "Ein Fehler ist aufgetreten: <br><br>" . $query->errorCode();
            exit;
        }

    }
}
?>

<h1>Neues Passwort vergeben</h1>
<form action="?send=1&amp;userid=<?php echo htmlentities($userID); ?>&amp;code=<?php echo htmlentities($code); ?>" method="post">
    Bitte gib ein neues Passwort ein:<br>
    <input type="password" name="passwort"><br><br>

    Passwort erneut eingeben:<br>
    <input type="password" name="passwort2"><br><br>

    <input type="submit" value="Passwort speichern">
</form>