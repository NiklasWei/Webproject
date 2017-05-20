<? 

// Session starten
@session_start();

$userid = $_SESSION['userid'];


$bildurl  = "../img/";



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
		break;}
		
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


// Ersetzen mit Projektstandard
// Prüfen ob die userid registriert ist und ggf. abbrechen
if (!isset($_SESSION['userid'])) { 
	session_destroy();
	header ("Location:index.php"); 
}


// Ersetzen mit Projektstandard
// Datenbankverbindung herstellen
include ("../mars.iuk.hdm-stuttgart.de;dbname=u-nw051\");
$dbuser = \"nw051\";
$dbpass = \"ABesoo9ahf\";
// DATENBANK LOGIN / -----------
$db = new PDO($dsn, $dbuser, $dbpass);


/*
// Funktionen einbinden
include ("functions.inc.php");

// Auswahllisten laden
include("../modules/listen.inc.php");

// Module f�r Fehlerpr�fung laden
include("../modules/verify.inc.php");

// Module f�r Dateipfade laden
include("../modules/path.inc.php");

// Fehlervariable zur�cksetzen
$formerror = false;
$errormessage = "";
$error = "";

// HTML-Tags entfernen
$allowedTags = '<b><br>';

if(isset($_POST['aanrede']))		$aanrede = $_POST['aanrede'];
if(isset($_POST['aname']))			$aname = strip_tags($_POST['aname']);
if(isset($_POST['avorname'])) 		$avorname = strip_tags($_POST['avorname']);
if(isset($_POST['atelefonvw'])) 	$atelefonvw = strip_tags($_POST['atelefonvw']);
if(isset($_POST['atelefon'])) 		$atelefon = strip_tags($_POST['atelefon']);
if(isset($_POST['atelefaxvw'])) 	$atelefaxvw = strip_tags($_POST['atelefaxvw']);
if(isset($_POST['atelefax'])) 		$atelefax = strip_tags($_POST['atelefax']);
if(isset($_POST['amobilvw'])) 		$amobilvw = strip_tags($_POST['amobilvw']);
if(isset($_POST['amobil'])) 		$amobil = strip_tags($_POST['amobil']);
if(isset($_POST['amail'])) 			$amail = strip_tags($_POST['amail']);
if(isset($_POST['url'])) 			$url = strip_tags($_POST['url']);
if(isset($_POST['beschreibung'])) 	$beschreibung = strip_tags($_POST['beschreibung'],$allowedTags);
*/

if(isset($_FILES['Bild']))			$logo = $_FILES['Bild'];

/*
if(isset($_POST['gruendung']))		$gruendung = $_POST['gruendung']; else $gruendung = "";
if(isset($_POST['igebdatum']))		$igebdatum = $_POST['igebdatum']; else $igebdatum = "";
*/

if(isset($_POST['speichern'])) $speichern = $_POST['speichern'];
IF (isset($speichern)) {

	// Auf Pflichteingaben und Eingabefehler pr�fen
/*	verify("name",$aname,$errormessage,$error,$formerror); 		// Vorname verifizieren
	verify("vorname",$avorname,$errormessage,$error,$formerror);// Stra�e verifizieren
	
	IF ($gruendung <> "") { verify("gruendung",$gruendung,$errormessage,$error,$formerror);}		// Gruendungsdatum verifizieren
	IF ($igebdatum <> "") { verify("igebdatum",$gebrutsdatum,$errormessage,$error,$formerror);}		// Geburtsdatum verifizieren
*/	
	
	// Ersetzen mit Projektstandard
	// Alten Datensatz einlesen
	$sql = "SELECT Bild FROM users WHERE id='$userid'";
	$result = @mysql_query($sql,$link);
	$old = mysql_fetch_array($result);
	
	// Wenn ein Bild hochgeladen wurden - kopieren und Namen erzeugen
	IF (isset($bild) && $bild['tmp_name'] != "") {
		// Pr�fen ob die Datei hochgeladen wurde
		if (!is_uploaded_file($bild['tmp_name'])) {
			$formerror = true;
			$errormessage.= "Die Datei konnte nicht hochgeladen werden. Bitte versuchen Sie es erneut.";
		}
		else {
			// Zul�ssige Dateitypen kontrollieren
			if(!($bild['type'] == 'image/jpeg' or $bild['type'] == 'image/png')) {
				$formerror = true;
				$errormessage.="Der Dateityp ist nicht zul�ssig.<br><br>Zugelassen sind nur Dateien vom Typ JPEG oder PNG!";
			}
			// Dateityp ist zul�ssig
			else {
				$uniquename=uniqid("");
				IF ($old[bild] <> "") {
					$bildname = $old[bild];
				}
				ELSE {
					$bildname = $uniquename.".jpg";
				}
				$bildurl .= $bildname;
				$maxsize = 180;		
				/* Aufruf von "resize" Image wird skaliert und gespeichert*/
				resize($bild['tmp_name'], $bildurl, $maxsize);
			}
		}
	}
	ELSE { $bildname = $old['bild']; }

	// Wenn keine Fehler aufgetreten sind Daten in die Datenbank �bernehmen
	if ($formerror == false) {

	// Daten in der Datenbank �ndern
/*	$sql = "UPDATE users SET 		 name='$name',
									 nachname ='$nachname',
									 benutzer='$benutzer',
									 email='$email',
									 bild='$bild',
									 bildna = '$bildname',

						WHERE id='$userid'";*/
						
						
			$sql = "UPDATE users SET 		
									 bild='$bildname'
						WHERE id='$userid'";
							
			
		$result =  mysql_query($sql,$link);

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
	ELSE {
/*	// Stammdaten laden im Fehlerfall
	$sql = "SELECT * FROM users WHERE id='$userid'";
	$result = mysql_query($sql,$link);
	$unternehmen = mysql_fetch_array($result);
	
	

}
ELSE
{	 Stammdaten laden
	$sql = "SELECT * FROM users WHERE id='$userid'";
	$result = mysql_query($sql,$link);
	$stammdaten = mysql_fetch_array($result);
	
	//Stammdaten zuweisen
	$name = $stammdaten["name"];
	$nachname = $stammdaten["nachname"];
	$benutzername = $stammdaten["benutzername"];
	$email = $stammdaten ["email"];
	$img = $stammdaten ["img"];
	$bild = $stammdaten ["bild"];
	$bildname = $stammdaten ["bildname"];
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
   <head>
      <title>Bilder Upload</title
		  !!<link rel="stylesheet" type="text/css" href="../css/user.css">
   </head>
   <body>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="White">
         <!-- Kopfzeile -->
         <tr>
            <td colspan="2" align="center" class="top">
               <img src="../gfx/logo_gv.gif" width="360" height="80" border="0" alt="" vspace="0" hspace="20">
            </td>
         </tr>
         <!-- Inhalt -->
         <tr>
            <!-- Seitenfenster -->
            <td valign="top" bgcolor="#F5F5F5" style="border-right: 1px solid #003366;">
               <? include ("navigation.inc.php"); ?>
            </td>		 
            <!-- Hauptfenster -->
            <td align="center" valign="middle">
		 	<!-- Page content -->             	
				<form action="<?$php_self?>" method="post" enctype="multipart/form-data">
<table border="0" cellspacing="10" cellpadding="0" align="center" class="content">
<?
if ($formerror == true) {
	echo "<tr><td colspan=\"4\" class=\"fehlerheader\"><b>Beim hochladen des Bildes ist ein Fehler aufgetreten</b></td></tr>";
	echo "<tr><td colspan=\"4\" bgcolor=\"White\"><b>Bitte Korrigieren Sie Folgende Angaben:</b></td></tr>";
	echo "<tr><td colspan=\"4\" bgcolor=\"White\">$errormessage</td></tr>";
}
?>
<tr>
	<th colspan="4" class="liste"><b>Allgemeine Angaben</b></th>
</tr>
<tr><td colspan="4" class="help">Diese Angaben werden aus den Stammdaten �bernommen.<font color="green"> * </font> </td></tr>
<tr>
	<td colspan="4"><? echo $firma." ".$rechtsform; ?></td>
</tr>
<tr>
	<td colspan="4"><? echo $art; ?></td>
</tr>
<? IF (($rechtsform == "Einzelunternehmen") OR ($rechtsform == "GbR")){
?>
<tr>
	<td colspan="4"><? echo $ianrede." ".$ivorname." ".$iname; ?></td>
</tr>
<?
}
?>
<tr>	
	<td colspan="4"><? echo $strasse." ".$hnr; ?></td>
</tr>
<tr>
	<td colspan="4"><? echo $plz." ".$ort." / ".$ortsteil; ?></td>
</tr>

		</table>
   </body>
</html>

