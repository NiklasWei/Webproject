<?php
session_start();
$dsn = "mysql:dbhost=https://mars.iuk.hdm-stuttgart.de;dbname=u-nw051";
$dbuser = "nw051";
$dbpass = "ABesoo9ahf";
$db = new PDO($dsn, $dbuser, $dbpass);

if(isset($_GET['login'])) {
    $email = $_POST['e_mail_input'];
    $passwort = $_POST['password_input'];

    $statement = $db->prepare("SELECT * FROM users WHERE e_mail = :e_mail_input");
    $result = $statement->execute(array('e_mail_input' => $email));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['password_input'])) {
        $_SESSION['user_id'] = $user['id'];
        die('Login erfolgreich. Weiter zu <a href="geschuetzt.php">internen Bereich</a>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
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

