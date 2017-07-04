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