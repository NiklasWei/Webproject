<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Aloha - share your skills</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php

    include_once "dbzugriff.php";
    $userID = $_SESSION['user_id'];
    $query = $db->prepare("SELECT user_id, user_name FROM users WHERE user_id LIKE '$userID'");
    $query->execute();
    $result = $query->fetchAll();

    $username = $result[0]["user_name"];

    ?>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header navbar-left">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="
                padding-top: 10px;
                padding-left: 10px;">
                    <img alt="brand" src="Blume.png" style="
                    height: 40px;
                    width: auto;">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="navbar-header navbar-right">
                <a class="btn btn-success navbar-btn" href="index.php">
                    <span class="glyphicon glyphicon-home"></span>
                </a>

                <a class="btn btn-success navbar-btn" href="<?php echo 'profil.php?user=' . "$username"; ?>">Profil</a>

                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Einstellungen
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="profilbildupload.php">Profilbild ändern</a></li>
                    <li><a href="bietesuche_form.php">Profileinstellungen ändern</a></li>
                    <li><a href="pwchange.php">Passwort ändern</a></li>
                    <li><a href="logout.php">Ausloggen</a></li>
                </ul>
            </ul>
            <ul class="navbar-header navbar-right">
                <form action="Suchfunktion.php" method="get" style="padding: 0 20px;">
                        <div class="input-group" style="margin-top: 8px;">
                            <input type="text" class="form-control" name="suche" size="30" maxlength="30" placeholder="Namen eingeben" style="
                            float: left;
                            width: 200px;
                            border-radius: 5px;
                            margin-right: 5px;">
                            <input type="submit" class="btn btn-success btn-sm" value="Suchen" style="
                            float: left;
                            margin-top: 2px;">
                        </div>

                </form>

            </ul>

            </div>

    </nav>
    <div class="row">
        <div class="navbar navbar-default navbar-fixed-bottom">
            <div class="container">
                <p class="navbar-text pull-left">© 2017 - Aloha</p>
                <p class="navbar-text pull-right">
                    <a href="Impressum.php" style="margin-right: 2px">Impressum</a>
                    |
                    <a href="Datenschutz.php" style="margin-left: 2px">Datenschutz</a>
                </p>
            </div>
        </div>
    </div>

</head>
<body style="margin-bottom: 120px">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
>>>>>>> Finaler Re-Upload
</html>