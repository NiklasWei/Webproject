<?php
    $dsn = "mysql:dbhost=mars.iuk.hdm-stuttgart.de;dbname=u-nw051";
    $dbuser = "nw051";
    $dbpass = "ABesoo9ahf";
    $db = new PDO($dsn,$dbuser,$dbpass);
    $sql = "INSERT INTO Benutzer(user_name)
    VALUES ($_Post[user_name_input]);";
    $query = $db->prepare($sql);
    $query->execute();
    while ($zeile = $query->fetchObject()) {
        echo $zeile->user_name . "<br/>\n";
    }
?>