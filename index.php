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

include "post.php";
echo "<br><br>";

$queryFollowings = $db->prepare("SELECT user_id, follow_id FROM follow WHERE user_id = '$userID'");
$queryFollowings->execute();
$resultFollowings = $queryFollowings->fetchAll();

$followings = array();


foreach($resultFollowings AS $follow) {
    array_push($followings, $follow["follow_id"]);
}

array_push($followings, $userID);



$queryPosts = $db->prepare("SELECT p.post_ID, p.Text, p.img_id, p.user_id, u.user_name, i.id, i.img_name
                                      FROM posts p 
                                      INNER JOIN users u ON (p.user_id = u.user_id) 
                                      LEFT JOIN Image_upload i ON (p.img_id = i.id)
                                      ORDER BY p.post_ID DESC");
$queryPosts->execute();
$resultPosts = $queryPosts->fetchAll();
$postCount = 0;

foreach($resultPosts AS $post) {
    if (in_array($post["user_id"], $followings, true)) {
        echo "<a href='profil.php?user=".$post["user_name"]."'>";
        echo $post["user_name"];
        echo "</a>";
        echo ": " . $post["Text"];
        echo "<br>";

        if($post["img_id"] != 0) {
            echo "<img src='upload/" . $post["img_name"] . "'>";
            echo "<br>";
        }

        echo "<br>";

        $postCount++;
    }
}

if ($postCount == 0) {
    echo "No posts! :(";
}
=======
<?php


//echo "<div class='row'>";
//echo "<div class='col-md-8 col-md-offset-2' style='text-align: center; font-family: sans-serif; font-weight: 100; margin-top: 60px'>";
session_start();

if(!isset($_SESSION['user_id'])) {include "header_login_register.php";
    die('<h2 style="font-weight: 200; text-align: center">Willkommen bei Aloha! Du musst dich zuerst <a href="login.php">einloggen</a>. Du hast noch kein Profil? Kein Problem! Du kannst dich hier sofort <a href="register.php">registrieren!</a></h2><br>
         <div class=\'row\'>
         <img src=\'Blume.png\' style="display: block;margin-left: auto;margin-right: auto">');
}
include "header.php";
//echo "<div class='row'>";
//echo "<img src='Blume.png'>";

//echo "<div>";
//echo "<div>";

//Abfrage der Nutzer ID vom Login
$userID = $_SESSION['user_id'];


include_once "dbzugriff.php";
echo "<div class='row'>";
echo "<div class='col-md-6 col-md-offset-3'>";
echo "<div class='posten'>";
include "post.php";
echo "</div>";
echo "<br>";

$queryFollowings = $db->prepare("SELECT user_id, follow_id FROM follow WHERE user_id = '$userID'");
$queryFollowings->execute();
$resultFollowings = $queryFollowings->fetchAll();

$followings = array();


foreach($resultFollowings AS $follow) {
    array_push($followings, $follow["follow_id"]);
}

array_push($followings, $userID);



$queryPosts = $db->prepare("SELECT p.post_ID, p.Text, p.img_id, p.user_id, u.user_name, i.id, i.img_name
                                      FROM posts p 
                                      INNER JOIN users u ON (p.user_id = u.user_id) 
                                      LEFT JOIN Image_upload i ON (p.img_id = i.id)
                                      ORDER BY p.post_ID DESC");
$queryPosts->execute();
$resultPosts = $queryPosts->fetchAll();
$postCount = 0;

foreach($resultPosts AS $post) {
    if (in_array($post["user_id"], $followings, true)) {
        echo "<div class='posting'>";
        echo "<a class='post-link' href='profil.php?user=".$post["user_name"]."'>";
        echo "<img class='post-profil img-circle' src='profilpictures/" . $post["user_id"] . "'>";
        echo "<span class='post-name'>" . $post["user_name"] . "</span>";
        echo "</a>";
        echo "<div class='post-text lead'>" . $post["Text"] . "</div>";

        if($post["img_id"] != 0) {
            echo "<img class='post-pic' src='upload/" . $post["img_name"] . " ' style='width: 300px;
    height: auto;
    object-fit: cover;
    display: block;
    margin-left: auto;
    margin-right: auto;'>";
            echo "<br>";
        }

        echo "</div>";
        echo "<br>";
        $postCount++;
    }
}

if ($postCount == 0) {
    echo "No posts! :(";
}

echo "</div></div>";
>>>>>>> Finaler Re-Upload
