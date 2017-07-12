<<<<<<< HEAD
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
=======
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

include "header_login_register.php";


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
        header('Location: index.php');
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
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <img border="0" alt="Aloha" src="Blume.png" style="
        width: auto;
        height: auto;
        padding-left: 25px;
"/>
    </div>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="heading-login" style="text-align: center;">
        <h1 style="'
    text-align: center;
    font-family: sans-serif;
    font-weight: 100;'">Aloha - Share your skills</h1>
        </div>
    </div>
</div>

</div>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <form action="?login=1" class="navbar-form navbar-left" role="form" method="post">
        <br>
        <div class="input-group">
        <span class="input-group-addon">

            <span class="glyphicon glyphicon-envelope"></span>

        </span>
            <input type="email" class="form-control" size="50" maxlength="250" name="e_mail_input" placeholder="E-Mail-Adresse">
        </div><br>
        <br>
        <div class="input-group">
        <span class="input-group-addon">

            <span class="glyphicon glyphicon-lock"></span>

        </span>
            <input type="password" class="form-control" size="50"  maxlength="250" name="password_input" placeholder="Passwort">
        </div><br>
        <br>
        <input type="submit" class="btn btn-success" value="Login">

        <form action="register.php">
            <input type="submit" class="btn btn-success" value="Registrieren" formaction="register.php">
        </form>
    </form>
    </div>
</div>


</body>
</html>
>>>>>>> Finaler Re-Upload
