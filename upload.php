<?php
// Session starten
session_start();

// Prüfen ob die userid registriert ist und ggf. abbrechen
if(!isset($_SESSION['user_id'])) {
	die('Du musst dich zuerst <a href="login.php">einloggen</a>!');
}

//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['user_id'];

// Speicherort für Bilder
$img_url  = "/upload/";



/* FUNCTION resize

Resampling von auf dem Server gespeicherten PNG oder JPEG Bildern.
Bildgröe ist in diesem Fall fest eingestellt. Maximal 600 x 600 Pixel.
Das Speicherformat ist auf PNG festgelegt -> h�here Bildqualität.

bergeben werden folgende Variablen:
$quellbild	Rohdaten eines Bildes. JPEG oder PNG.
$name		Bildname bzw. URL unter der das Bild abgelegt werden soll
$breite		maximale Abmessung (X oder Y) in der das Bild erstellt werden soll
 */

function resize($quellbild,$url,$maxsize) {

	// Bildinformationen einlesen und zuweisen
	$info = getimagesize($quellbild);
	$breitalt = $info[0];
	$hochalt = $info[1];
	
	// Falls das Bild schon die benötigte Grösse besitzt kopieren
	IF (($breitalt <= $maxsize) AND ($hochalt <= $maxsize)) { copy($quellbild, $url); }
	// höhe und breite sind auf maximalgröße, die quellbild URL wird kopiert
	//sonst Umrechnung starten
	ELSE {
		// Bildformat Überprüfen Hochformat / Querformat
		// Prüfen ob Bild im Querformat vorliegt
		if ($breitalt > $hochalt) {
		$breit=$maxsize;
		$hoch = ceil($hochalt*$breit/$breitalt);} 
		
		// Wenn das Bild im Hochformat vorliegt
		else {
		$hoch=$maxsize;
		$breit = ceil($breitalt*$hoch/$hochalt); }
		
		// Altes Bild in Variable schreiben, je nach Dateityp
		// [2] JPEG; [3] PNG;
		switch($info[2]) {
		case 2:
		$bildalt = imagecreatefromjpeg($quellbild); 
		break;
		case 3:
		$bildalt = imagecreatefrompng($quellbild); 
		break;
		default: $bildalt = imagecreate($breit , $hoch);} //wenn weder jpg, pgn dann wird ein leeres Bild erzeugt

		
		// Leeres Bild mit neuen Abma�en generieren
		$bildneu = imagecreate($breit , $hoch);
		
		// Ersetzen durch imagecopyresampled
		// Bild umkopieren
		imagecopyresized($bildneu , $bildalt , 0 , 0 , 0 , 0 , $breit ,$hoch , $breitalt , $hochalt);
		
		/* Bild als jpg auf Server speichern.
		   JPG Format wurde wegen der h�heren Qualit�t gew�hlt 
		   Bei truecolor Unterst�tzung der GD-Bibliothek auf PNG umstellen   */
		   
		imagejpeg($bildneu,$url,100);
		
		// Bildspeicher löschen
		imagedestroy($bildneu);
		imagedestroy($bildalt);
	}
}


// Datenbankverbindung herstellen

// Besser als include
$dsn = "mysql:dbhost=https://mars.iuk.hdm-stuttgart.de;dbname=u-nw051";
$dbuser = "nw051";
$dbpass = "ABesoo9ahf";
// DATENBANK LOGIN / -----------
$db = new PDO($dsn, $dbuser, $dbpass);


// Servervariablen werden ausgelesen
if(isset($_FILES['upload']))			$upload = $_FILES['upload'];

//bei Seitenübergabe auf Speichern überpürfen und holen uns den Inhalt
if(isset($_POST['speichern'])) $speichern = $_POST['speichern'];
IF (isset($speichern)) {
	
	// Wenn ein Bild hochgeladen wurden - kopieren und Namen erzeugen
	//tmp_name = temporärer Dateiname, überprüfen ob Server Variable leer oder voll ist
	IF (isset($upload) && $upload['tmp_name'] != "") {
		// Prüfen ob die Datei hochgeladen wurde
		if (!is_uploaded_file($upload['tmp_name'])) {
			$formerror = true;
			$errormessage.= "Die Datei konnte nicht hochgeladen werden. Bitte versuchen Sie es erneut.";
		}
		else {
			// Zul�ssige Dateitypen kontrollieren
			if(!($upload['type'] == 'image/jpeg' or $upload['type'] == 'image/png')) {
				//wenn es kein jpeg/png dann error

				$formerror = true;
				$errormessage.="Der Dateityp ist nicht zul�ssig.<br><br>Zugelassen sind nur Dateien vom Typ JPEG oder PNG!";
			}
			// Dateityp ist zul�ssig
			else {
				$uniquename=uniqid(""); //unique ID wird für einzelnes Bild erstellt
			    $img_name = $uniquename.".jpg";

				$img_url .= $img_name;
				$maxsize = 180;		
				/* Aufruf von "resize" Image wird skaliert und gespeichert*/
				resize($upload['tmp_name'], $img_url, $maxsize);
			}
		}
	}


	// Wenn keine Fehler aufgetreten sind Daten in die Datenbank übernehmen
	if ($formerror == false) {


						
			$sql = "INSERT INTO Image_upload ('user_id','img_name')
					VALUES ($userid, $img_name)";

		$result =  mysql_query($sql,$db);

		//konnten die daten gespeichert werden? wenn nicht enth�lt ergebnis TRUE andernfalls FALSE
		if ($result) {$datenbankfehler = false;} else {$datenbankfehler = true;}

		// Datenbankverbindung schlie�en
		mysql_close($link);
	
		// Weiterleiten falls kein Datenbankfehler aufgetreten ist.
		if ($datenbankfehler == false) {
			header ("Location:dbzugriff.php"); 
		}
		// Fehlermeldungen um Datenbankfehler erweitern.
		else {
			$errormessage = $errormessage."Beim Aufbau der Datenbankverbindung sind Fehler aufgetreten.<br><br>Bitte versuchen Sie es erneut.";
		}
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>mein-rosbach.de / Visitenkarte verwalten</title>
	<link rel="stylesheet" type="text/css" href="../css/user.css">
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="White">
	<!-- Kopfzeile -->
	>	<tr>
		<td colspan="2" align="center" class="top">
			<img src="aloah.png" border="0" alt="" vspace="0" hspace="20">
		</td>
	</tr
	<!-- Inhalt -->
	<tr>
		<!-- Hauptfenster -->
		<td align="center" valign="middle">
			<!-- Page content -->
			<form action="<?$php_self?>" method="post" enctype="multipart/form-data">
				<table border="0" cellspacing="10" cellpadding="0" align="center" class="content">
					<tr>
						<th colspan="4" class="liste"><b>Logo</b></th>
					</tr>
					<? IF ($logo <> "") { ?>
						<tr>
							<td colspan="4" align="center"><img src="<? echo $logourl.$logo; ?>" border="0" alt=""></td>
						</tr>
					<? } ?>
					<tr>
						<td class="formbez">Neues Logo</td>
						<td colspan="3"><input type="file" name="logo" size="45" accept="image/jpeg,image/x-png"></td>
					</tr>
					<tr>
						<td colspan="4" align="center"><input type="submit" name="speichern" value="Speichern"><input type="Reset"><input type="submit" name="escape" value="Abbrechen"></td>
					</tr>
					<tr><td colspan="4">Pflichtangaben sind mit einem<font color="Red"> * </font>gekennzeichnet.</td></tr>
					<tr><td colspan="4"><font color="green"> * </font> Diese Daten werden verˆffentlicht.</td></tr>
					<tr><td colspan="4">Hinweis: Beim Hochladen eines neuen Logos kann es nˆtig sein in Ihrem Browser den "Aktualisieren-Button" zu bet‰tigen, damit die ƒnderungen sichtbar werden.</td></tr>
				</table>
			</form>
			<!-- End page content -->
		</td>
	</tr>
	<!-- Fuﬂzeile -->
	<tr>
		<td colspan="2" align="center" class="bottom">
			<? include ("bottom.inc.php"); ?>
		</td>
	</tr>
</table>
</body>
</html>
