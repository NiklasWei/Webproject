<?php
include "dbzugriff.php";
include "header.php";
$suche=$_GET['suche'];

$query = $db->prepare("SELECT user_name FROM users WHERE user_name LIKE '%$suche%'");
$query->execute();
if ($query->rowCount() > 0) {
    $results = $query->fetchAll();
    foreach($results AS $ausgabe) {
        echo "<div class='row'>";
        echo "<div class='col-md-6 col-md-offset-3' style='text-align: center ;'>";
        echo "<a href='profil.php?user=".$ausgabe['user_name']."'>";
        echo "" . $ausgabe['user_name'] . "";
        echo "</a>";

        echo "</div>";
        echo "</div>";
    }
    }else {
        echo "Keinen Benutzer gefunden";
    }
?>








