<?php
session_start(); // Eine sitzung muss gestartet werden

// falls keine Fehler ausgegeben werden
error_reporting(E_ALL);
ini_set('display_errors','On');

// loginDB
$mysqli = new mysqli("localhost",
    "nw051",
    "ABesoo9ahf",
    "u-nw051");

// überprüfung, ob die POST's gesetzt sind
if(isset($_POST['e_mail_input'], $_POST['password_input'])) { // Alternativ: $_GET['login']

    // vars definieren
    $email = $_POST['e_mail_input'];
    $passwort = $_POST['password_input'];

    // ab hier das statement
    $query = "SELECT * FROM `users` WHERE `e_mail` = '$email'";
    $result = $mysqli->query($query)  or trigger_error($mysqli->error."[$query]");
    $row = $result->fetch_array(MYSQLI_ASSOC);

    // überprüfung des pw's
    $pwhash_e = substr(md5($passwort), 0, -2);
    if($row !== false && $pwhash_e == $row['pw']) {
        $_SESSION['user_id'] = $row['user_id'];
        echo 'Login erfolgreich. Weiter zu <a href="geschuetzt.php">internen Bereich</a>';
        exit;
    } else {
        $errorMessage = "E-Mail oder Passwort ungültig<br><br>db_hash:".$row['pw']."<br>input_hash:$pwhash_e";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<?php
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>

<form action="?login=1" method="post">
    E-Mail:<br>
    <input type="email" size="40" maxlength="250" name="e_mail_input"><br><br>

    Dein Passwort:<br>
    <input type="password" size="40"  maxlength="250" name="password_input"><br>

    <input type="submit" value="Abschicken">
</form>
</body>
</html>
