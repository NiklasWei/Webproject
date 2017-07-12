<<<<<<< HEAD
<?php
// Session starten
session_start();
if(!isset($_SESSION['user_id'])) {
    die('Du musst dich zuerst <a href="login.php">einloggen</a>!');
}
include "header.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Prüfen ob die userid registriert ist und ggf. abbrechen
if(!isset($_SESSION['user_id'])) {
    die('Du musst dich zuerst <a href="login.php">einloggen</a>!');
}

// Speicherort für Bilder
$img_url  = "/profilpictures/";

$formerror = false; //wenn true dann ist etwas falsch gelaufen

// Datenbankverbindung herstellen
include_once "dbzugriff.php";

$userID = $_SESSION['user_id'];

function uploadImg ($userID, $db) {

    $dir = "profilpictures/";
    $file = $dir . $userID . ".jpg";
    if(file_exists($file)) {
        unlink($file);
    }


    if(move_uploaded_file($_FILES["bild"]["tmp_name"], $file)) {
        echo "Upload success!";
    } else {
        echo "Error uploading file.";
        exit;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Aloha / Profilbildupload</title>

</head>
<body style='font-family:Arial,sans-serif;font-size:13px;'>
<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
    <input type="file" name="bild" id="bild" size="45" accept="image/jpeg,image/x-png">
    <input type="submit" name="speichern" value="upload">
</form>
</body>
=======
<?php
// Session starten
session_start();
if(!isset($_SESSION['user_id'])) {
    die('Du musst dich zuerst <a href="login.php">einloggen</a>!');
}
include "header.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Speicherort für Bilder
$img_url  = "/profilpictures/";

$formerror = false; //wenn true dann ist etwas falsch gelaufen

// Datenbankverbindung herstellen
include_once "dbzugriff.php";

$userID = $_SESSION['user_id'];

function uploadImg ($userID) {

    $dir = "profilpictures/";
    $file = $dir . $userID . ".jpg";
    if(file_exists($file)) {
        unlink($file);
    }


    if(move_uploaded_file($_FILES["bild"]["tmp_name"], $file)) {
        echo "<div class='col-md-6 col-md-offset-3' style='text-align: center'><h1>Upload erfolgreich!</h1></div>";
    } else {
        echo "<h1>Error! Upload fehlgeschlagen.</h1>";
        exit;
    }
}

if(isset($_POST['speichern'])) {
    $uploadingImg = uploadImg($userID);
    echo $uploadingImg;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Aloha / Profilbildupload</title>
    <script>
        $(function() {

            // We can attach the `fileselect` event to all file inputs on the page
            $(document).on('change', ':file', function() {
                var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });

            // We can watch for our custom `fileselect` event like this
            $(document).ready( function() {
                $(':file').on('fileselect', function(event, numFiles, label) {

                    var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;

                    if( input.length ) {
                        input.val(log);
                    } else {
                        if( log ) alert(log);
                    }

                });
            });

        });
    </script>

</head>
<body style='font-family:Arial,sans-serif;font-size:13px;'>

<div class="row">
    <div class="col-md-6 col-md-offset-4">
        <h1 style='
        font-family: sans-serif;
        font-weight: 100;'>Neues Profilbild festlegen.</h1><br>
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">


            <div class="input-group group-upload">
                <label class="input-group-btn">
                    <span class="btn btn-success">
                        Browse&hellip;
                            <input type="file" style="display:none" name="bild" id="bild" size="45" accept="image/jpeg,image/x-png">
                    </span>
                </label>
                <input type="text" class="file-upload form-control" readonly>
            </div>
            <input type="submit" class="btn btn-success btn-upload" style="width:auto" name="speichern" value="upload">

        </form>
    </div>
</div>
</body>
>>>>>>> Finaler Re-Upload
</html>