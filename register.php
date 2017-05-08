<?php
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
    $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
// wenn keine fehler, SQL-Befehl und Ausführen der Abfrage

    $sql = "INSERT INTO users (fore_name, sur_name, e_mail, user_name, password)
VALUES ('$vorname','$nachname','$email','$username','$passwort_hash');";
    $query = $db->prepare($sql);
    $query->execute();

//Bestätigung der Anmeldung
    echo "Hey ".$vorname.". Your user with the username ".$username." has been created. Thank you for choosing friendship :)";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrierung</title>
</head>
<body>

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
    <input type="password" size="40"  maxlength="250" name="passwort" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Das Passwort muss mindestens 1 Großbuchstabe, 1 Kleinbuchstabe und eine Zahl enthalten. Außerdem muss es aus mindestens 8 Zeichen bestehen."><br>

    Passwort wiederholen:<br>
    <input type="password" size="40" maxlength="250" name="passwort2" required><br><br>

    <input type="submit" value="Abschicken">
</form>

</body>
</html>