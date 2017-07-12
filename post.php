<<<<<<< HEAD
<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    die('Du musst dich zuerst <a href="login.php">einloggen</a>!');
}

//Abfrage der Nutzer ID vom Login
$userID = $_SESSION['user_id'];

include "header.php";
include 'upload.php';
//Variablen definieren

if(isset($_POST["speichern"])) {
    $img = 0;
    if(!empty($_FILES["bild"]["name"])) {
        echo "bild angehängt.";
        $img = uploadImg($userID, $db);
    }

    $text = $_POST["postText"];

    $sql = "INSERT INTO posts (Text, img_id, user_id) VALUES ('$text', $img, $userID)";

    $query = $db->prepare($sql);
    $execute = $query->execute();

    if($execute === true) {
        echo "posted.";

    } else {
        echo "error while posting.";
        exit;
    }


}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Aloha / Imageupload</title>

</head>
<body style='font-family:Arial,sans-serif;font-size:13px;'>
<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
    <input type="text" name="postText" size="40" maxlength="250" required>
    <input type="file" name="bild" id="bild" size="45" accept="image/jpeg,image/x-png">
    <input type="submit" name="speichern" value="Posten">
</form>
</body>
</html>
=======
<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    die('Du musst dich zuerst <a href="login.php">einloggen</a>!');
}

//Abfrage der Nutzer ID vom Login
$userID = $_SESSION['user_id'];

//include "header.php";
include 'upload.php';
//Variablen definieren

if(isset($_POST["speichern"])) {
    $img = 0;
    if(!empty($_FILES["bild"]["name"])) {
        echo "bild angehängt.";
        $img = uploadImg($userID, $db);
    }

    $text = $_POST["postText"];

    $sql = "INSERT INTO posts (Text, img_id, user_id) VALUES ('$text', $img, $userID)";

    $query = $db->prepare($sql);
    $execute = $query->execute();

    if($execute === true) {
        //echo "posted.";

    } else {
        echo "error while posting.";
        exit;
    }


}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Aloha / Imageupload</title>

</head>
<body style='font-family:Arial,sans-serif;font-size:13px;'>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
        <div class="input-group">
        <span class="input-group-addon" style="background-color: #5cb85c; color: white;">?</span>
        <input type="text" class="form-control" name="postText" size="40" maxlength="250" placeholder="Wazzup?" required>
        </div><br>
    <input type="file" name="bild" id="bild" size="45" accept="image/jpeg,image/x-png">
    <input type="submit" class="btn btn-sm btn-success" name="speichern" value="Posten" style="float: right; margin-top: -27px">

    </form>
    </div>
</div>
</body>
</html>
>>>>>>> Finaler Re-Upload
