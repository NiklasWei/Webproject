<?php
include "header.php";
?>

<!DOCTYPE html>

<html>

<head>

    <title>Login</title>

</head>

<body>
<div class="row">
    <div class="col-md-8 col-md-offset-2" style="margin-top: 70px">
        <h1 style="font-family: sans-serif; font-weight: 100; text-align: center">Mache auf dich aufmerksam. Zeige der Community was du bietest und was du suchst.</h1>
    </div>
</div><br><br>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
<form role="form" action="bietesuche_change.php" method="post">
    <input type="text" class="form-control" size="50" maxlength="250" name="suche" placeholder="Ich suche" required><br>
    <input type="text" class="form-control" size="50" maxlength="250" name="biete" placeholder="Ich biete" required><br>
    <input type="submit"class="btn btn-success" value="aktualisieren">
</form>
    </div>

</div>
</body>

</html>