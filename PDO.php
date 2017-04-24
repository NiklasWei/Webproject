<?php
$dsn = "mysql:dbhost=https://mars.iuk.hdm-stuttgart.de;dbname=u-nw051";
$dbuser = "nw051";
$dbpass = "ABesoo9ahf";
$db = new PDO($dsn,$dbuser,$dbpass);
$sql = "INSERT INTO Benutzer (user_name)
VALUES ('$_POST[user_name_input]');";
$query = $db->prepare($sql);
$query->execute();

echo "Your user with the username " . $_POST['user_name_input'] . " has been created."
?>