<?php
$dsn = "mysql:dbhost=https://mars.iuk.hdm-stuttgart.de;dbname=u-nw051";
$dbuser = "nw051";
$dbpass = "ABesoo9ahf";
$db = new PDO($dsn,$dbuser,$dbpass);
$sql = "INSERT INTO users (fore_name, sur_name, e_mail, user_name, password)
VALUES ('$_POST[fore_name_input]','$_POST[sur_name_input]','$_POST[e_mail_input]','$_POST[user_name_input]','$_POST[password_input]');";
$query = $db->prepare($sql);
$query->execute();



echo "Hey " . $_POST['fore_name_input'] . ". Your user with the username " . $_POST['user_name_input'] . " has been created. Thank you for choosing friendship :)"
?>