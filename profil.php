<<<<<<< HEAD
<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    die('Du musst dich zuerst <a href="login.php">einloggen</a>!');
}

//Abfrage der Nutzer ID vom Login
$userID = $_SESSION['user_id'];

include "header.php";

include_once "dbzugriff.php";
//Wenn der User auf den FollowButton klickt werden die Daten in die Follow Tabelle eingetragen
if(isset($_POST["Follow"])) {
    $followID = $_POST["followID"];
    $sql = "INSERT INTO follow (user_id, follow_id) VALUES ($userID, $followID)";

    $query = $db->prepare($sql);
    $execute = $query->execute();

    if($execute === true) {
       // echo "followed.<br>";
    } else {
        echo "error<br>";
    }

}
//Wenn der User auf den Unfollow Button klickt werden die Daten aus der Follow Tabelle gelöscht
if(isset($_POST["Unfollow"])) {
    $followID = $_POST["followID"];
    $sql = "DELETE FROM follow WHERE user_id = $userID and follow_id = $followID";

    $query = $db->prepare($sql);
    $execute = $query->execute();

    if($execute === true) {
       // echo "unfollowed.<br>";
    } else {
        echo "error<br>";
    }

}




$getUser = $_GET["user"];


//Username und Userdaten vom aufgeruften Profil werden abgefragt - Username aus URL per GET
$query = $db->prepare("SELECT user_id, user_name, fore_name, sur_name FROM users WHERE user_name LIKE '$getUser'");
$query->execute();
$result = $query->fetchAll();

$username = $result[0]["user_name"];
$profilID = $result[0]["user_id"];
//Es wird überprüft ob der User der das Profil aufruft diesem user schon folgt oder nicht - dementsprechend wird Buttontext dargestellt
$queryFollow = $db->prepare("SELECT user_id, follow_id FROM follow WHERE user_id = $userID AND follow_id = $profilID");
$queryFollow->execute();
$resultFollow = $queryFollow->fetchAll();

if(empty($resultFollow)) {
    $followed = false;
    $btnText = "Follow";
} else {
    $followed = true;
    $btnText = "Unfollow";
}

//Userdaten die oben ausgelesen wurden werden hier ausgegeben
echo $username;
echo "<br>";
echo $result[0]["fore_name"] . " " . $result[0]["sur_name"];

?>

<form action="" method="post">
    <input type="hidden" name="followID" value="<?php echo $profilID ?>">
    <input type="submit" name="<?php echo $btnText; ?>" value="<?php echo $btnText . " " . $username ?>">
</form>

<br><br>

<?php

//Posts vom User des Profils das aufgerufen wird werden aus Datenbank ausgelesen und ausgegeben
$queryPosts = $db->prepare("SELECT post_ID, Text, img_id, user_id FROM posts WHERE user_id = $profilID");
$queryPosts->execute();
$resultPosts = $queryPosts->fetchAll();

foreach($resultPosts AS $post) {
    echo $post["Text"];
    echo "<br>";
}



=======
<?phpsession_start();if(!isset($_SESSION['user_id'])) {    die('Du musst dich zuerst <a href="login.php">einloggen</a>!');}//Abfrage der Nutzer ID vom Login$userID = $_SESSION['user_id'];include "header.php";include_once "dbzugriff.php";//Wenn der User auf den FollowButton klickt werden die Daten in die Follow Tabelle eingetragenif(isset($_POST["Follow"])) {    $followID = $_POST["followID"];    $sql = "INSERT INTO follow (user_id, follow_id) VALUES ($userID, $followID)";    $query = $db->prepare($sql);    $execute = $query->execute();    if($execute === true) {        // echo "followed.<br>";    } else {        echo "error<br>";    }}//Wenn der User auf den Unfollow Button klickt werden die Daten aus der Follow Tabelle gelöschtif(isset($_POST["Unfollow"])) {    $followID = $_POST["followID"];    $sql = "DELETE FROM follow WHERE user_id = $userID and follow_id = $followID";    $query = $db->prepare($sql);    $execute = $query->execute();    if($execute === true) {        // echo "unfollowed.<br>";    } else {        echo "error<br>";    }}$getUser = $_GET["user"];//Username und Userdaten vom aufgeruften Profil werden abgefragt - Username aus URL per GET$query = $db->prepare("SELECT user_id, user_name, fore_name, sur_name FROM users WHERE user_name LIKE '$getUser'");$query->execute();$result = $query->fetchAll();$username = $result[0]["user_name"];$profilID = $result[0]["user_id"];//Es wird überprüft ob der User der das Profil aufruft diesem user schon folgt oder nicht - dementsprechend wird Buttontext dargestellt$queryFollow = $db->prepare("SELECT user_id, follow_id FROM follow WHERE user_id = $userID AND follow_id = $profilID");$queryFollow->execute();$resultFollow = $queryFollow->fetchAll();if(empty($resultFollow)) {    $followed = false;    $btnText = "Follow";} else {    $followed = true;    $btnText = "Unfollow";}//Userdaten die oben ausgelesen wurden werden hier ausgegeben und das Profilbild nach der UserIDecho "<div class='row'>";echo "<div class='col-md-4 col-md-offset-1' style='border: 1px solid rgb(226, 226, 226);'><img class='profilbild' src='profilpictures/" . "$profilID" . "' style='    border-radius: 50%;    margin: auto;    display: block;    margin-top: 45px; width: 250px; height: 250px'>";echo "<br>";echo "<br>";echo "<br>";echo "<div class=\"panel panel-success\">    <div class=\"panel-heading\">        <h3 class=\"panel-title\">Username</h3>    </div>    <div class=\"panel-body\">        $username    </div></div>";echo "<br>";echo "<div class=\"panel panel-success\">    <div class=\"panel-heading\">        <h3 class=\"panel-title\">Name</h3>    </div>    <div class=\"panel-body\">".        $result[0]["fore_name"] . " " . $result[0]["sur_name"]."    </div>    </div>";echo "<br>";//biete suche abfrage über include der bietesuche.phpinclude "bietesuche.php";echo "<div class=\"panel panel-success\">    <div class=\"panel-heading\">        <h3 class=\"panel-title\">Ich suche</h3>    </div>    <div class=\"panel-body\">$suche    </div>    </div>";echo "<br>";echo "<div class=\"panel panel-success\">    <div class=\"panel-heading\">        <h3 class=\"panel-title\">Ich biete</h3>    </div>    <div class=\"panel-body\">$biete    </div>    </div>";?>    <form action="" method="post">        <input type="hidden" name="followID" value="<?php echo $profilID; ?>">        <input type="submit" class="btn btn-success" name="<?php echo $btnText; ?>" value="<?php echo $btnText . " " . $username; ?>">    </form>    <br></div><?php//Posts vom User des Profils das aufgerufen wird werden aus Datenbank ausgelesen und ausgegeben$queryPosts = $db->prepare("SELECT post_ID, Text, img_id, user_id FROM posts WHERE user_id = $profilID ORDER BY post_ID DESC");$queryPosts->execute();$resultPosts = $queryPosts->fetchAll();    echo "<div class='col-md-6'>";    foreach($resultPosts AS $post) {        echo "<div class='posting' style='margin-top:0px;'>";        echo "<a class='post-link'>";        echo "<img class='post-profil img-circle' src='profilpictures/" . $post["user_id"] . "'>";        echo "<span class='post-name'>" . $post['user_name'] . "</span>";        echo "</a>";        echo "<div class='post-text lead'>" . $post["Text"] . "</div>";        echo "</div>";        echo "<br>";    }    echo "</div></div>";?>
>>>>>>> Finaler Re-Upload
