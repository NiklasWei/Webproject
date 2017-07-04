<?php
include "header.php";

if(isset($_POST['email'], $_POST['passwort'], $_POST['passwort2'])) {
    // variablen definieren
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];

    $vorname = $_POST['fore_name_input'];
    $nachname = $_POST['sur_name_input'];
    $username = $_POST['user_name_input'];

    // DATENBANK LOGIN -------------
    $dsn = "mysql:dbhost=https://mars.iuk.hdm-stuttgart.de;dbname=u-nw051";
    $dbuser = "nw051";
    $dbpass = "ABesoo9ahf";
    // DATENBANK LOGIN / -----------
    $db = new PDO($dsn, $dbuser, $dbpass);

    $nRowsEmail = $db->prepare("select * from users where e_mail = '$email'")->rowCount(); // zählt die registrierten user, mit der eingegeben email x
    $nRowsUsername = $db->prepare("select * from users where user_name = '$username'")->rowCount(); // zählt die registrierten user, mit der eingegeben username x

    // fehlerüberprüfung ...
    if($passwort != $passwort2) { // checkt, ob die pw eingaben übereinanderstimmen
        die('Die Passwortwiederholung stimmt nicht überein.');
    } else if ($nRowsEmail > 0) { // checkt, ob bereits nh user mit der angegebenen email existiert
        echo 'Es existiert bereits ein User mit der E-Mail '.$email.'.';
        exit;
    } else if ($nRowsUsername > 0) { // checkt, ob bereits nh user mit der angegebenen username existiert
        echo 'Es existiert bereits ein User mit dem Username '.$username.'.';
        exit;
    }
// auss passwort wird hash ... :D
    $passwort_hash = md5($passwort);
// wenn keine fehler, SQL-Befehl und Ausführen der Abfrage

    $sql = "INSERT INTO users (sur_name, user_name, followers_count, following_count, pw, fore_name, e_mail)
VALUES ('$nachname','$username','0','0','$passwort_hash','$vorname','$email');";
    $query = $db->prepare($sql);
    $execute_CFE = $query->execute();
    if($execute_CFE === true) {
//Bestätigung der Anmeldung - wenn success
        echo "Hey ".$vorname.". Your user with the username ".$username." has been created. Thank you for choosing friendship :)";
        exit;
    } else {
// Fehler anzeigen - wenn error
        echo "Ein Fehler ist aufgetreten: <br><br>".$query->errorCode();
        exit;
    }


}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Die 3 Meta-Tags oben *müssen* zuerst im head stehen; jeglicher sonstiger head-Inhalt muss *nach* diesen Tags kommen -->
    <title>Registrierung - Aloha</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Unterstützung für Media Queries und HTML5-Elemente in IE8 über HTML5 shim und Respond.js -->
    <!-- ACHTUNG: Respond.js funktioniert nicht, wenn du die Seite über file:// aufrufst -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<h1>Registrierung - Aloha!</h1>

<form action="?register=1" method="post">
    Vorname:<br>
    <input type="text" size="40" maxlength="250" name="fore_name_input" required><br><br>

    Nachname:<br>
    <input type="text" size="40" maxlength="250" name="sur_name_input" required><br><br>

    Username:<br>
    <input type="text" size="40" maxlength="250" name="user_name_input" required pattern="[A-Za-z0-9\t\r\n\f]*$"><br><br>

    E-Mail:<br>
    <input type="email" size="40" maxlength="250" name="email" required><br><br>

    Dein Passwort:<br>
    <input type="password" size="40"  maxlength="250" name="passwort" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Das Passwort muss mindestens 1 Großbuchstabe, 1 Kleinbuchstabe und eine Zahl enthalten. Außerdem muss es aus mindestens 8 Zeichen bestehen."><br><br>

    Passwort wiederholen:<br>
    <input type="password" size="40" maxlength="250" name="passwort2" required><br><br>

    <input type="submit" value="Abschicken">
</form>
<!-- jQuery (wird für Bootstrap JavaScript-Plugins benötigt) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>