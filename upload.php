<? 

// Session starten
@session_start();

$userid = $_SESSION['userid'];


$logourl  = "../logos/";



/* FUNCTION resize

Resampling von auf dem Server gespeicherten PNG oder JPEG Bildern.
Bildgröße ist in diesem Fall fest eingestellt. Maximal 600 x 600 Pixel.
Das Speicherformat ist auf PNG festgelegt -> höhere Bildqualität.

Übergeben werden folgende Variablen:
$quellbild	Rohdaten eines Bildes. JPEG oder PNG.
$name		Bildname bzw. URL unter der das Bild abgelegt werden soll
$breite		maximale Abmessung (X oder Y) in der das Bild erstellt werden soll
 */

function resize($quellbild,$url,$maxsize) {

	// Bildinformationen einlesen und zuweisen
	$info = getimagesize($quellbild);
	$breitalt = $info[0];
	$hochalt = $info[1];
	
	// Falls das Bild schon die benötigte Größe besitzt kopieren
	IF (($breitalt <= $maxsize) AND ($hochalt <= $maxsize)) { copy($quellbild, $url); }
	
	//sonst Umrechnung starten
	ELSE {
		// Bildformat überprüfen Hochformat / Querformat
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
		
		// Leeres Bild mit neuen Abmaßen generieren
		$bildneu = imagecreate($breit , $hoch);
		
		// Ersetzen durch imagecopyresampled
		// Bild umkopieren
		imagecopyresized($bildneu , $bildalt , 0 , 0 , 0 , 0 , $breit ,$hoch , $breitalt , $hochalt);
		
		/* Bild als jpg auf Server speichern.
		   JPG Format wurde wegen der höheren Qualität gewählt 
		   Bei truecolor Unterstützung der GD-Bibliothek auf PNG umstellen   */
		   
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
include ("../modules/connect.inc.php");

/*
// Funktionen einbinden
include ("functions.inc.php");

// Auswahllisten laden
include("../modules/listen.inc.php");

// Module für Fehlerprüfung laden
include("../modules/verify.inc.php");

// Module für Dateipfade laden
include("../modules/path.inc.php");

// Fehlervariable zurücksetzen
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

if(isset($_FILES['logo']))			$logo = $_FILES['logo'];

/*
if(isset($_POST['gruendung']))		$gruendung = $_POST['gruendung']; else $gruendung = "";
if(isset($_POST['igebdatum']))		$igebdatum = $_POST['igebdatum']; else $igebdatum = "";
*/

if(isset($_POST['speichern'])) $speichern = $_POST['speichern'];
IF (isset($speichern)) {

	// Auf Pflichteingaben und Eingabefehler prüfen
/*	verify("name",$aname,$errormessage,$error,$formerror); 		// Vorname verifizieren
	verify("vorname",$avorname,$errormessage,$error,$formerror);// Straße verifizieren
	
	IF ($gruendung <> "") { verify("gruendung",$gruendung,$errormessage,$error,$formerror);}		// Gruendungsdatum verifizieren
	IF ($igebdatum <> "") { verify("igebdatum",$gebrutsdatum,$errormessage,$error,$formerror);}		// Geburtsdatum verifizieren
*/	
	
	// Ersetzen mit Projektstandard
	// Alten Datensatz einlesen
	$sql = "SELECT logo FROM users WHERE id='$userid'";
	$result = @mysql_query($sql,$link);
	$old = mysql_fetch_array($result);
	
	// Wenn ein Bild hochgeladen wurden - kopieren und Namen erzeugen
	IF (isset($logo) && $logo['tmp_name'] != "") {
		// Prüfen ob die Datei hochgeladen wurde
		if (!is_uploaded_file($logo['tmp_name'])) {
			$formerror = true;
			$errormessage.= "Die Datei konnte nicht hochgeladen werden. Bitte versuchen Sie es erneut.";
		}
		else {
			// Zulässige Dateitypen kontrollieren
			if(!($logo['type'] == 'image/jpeg' or $logo['type'] == 'image/png')) {
				$formerror = true;
				$errormessage.="Der Dateityp ist nicht zulässig.<br><br>Zugelassen sind nur Dateien vom Typ JPEG oder PNG!";
			}
			// Dateityp ist zulässig
			else {
				$uniquename=uniqid("");
				IF ($old[logo] <> "") {
					$logoname = $old[logo];
				}
				ELSE {
					$logoname = $uniquename.".jpg";
				}
				$logourl .= $logoname;
				$maxsize = 180;		
				/* Aufruf von "resize" Image wird skaliert und gespeichert*/
				resize($logo['tmp_name'], $logourl, $maxsize);
			}
		}
	}
	ELSE { $logoname = $old['logo']; }

	// Wenn keine Fehler aufgetreten sind Daten in die Datenbank übernehmen
	if ($formerror == false) {

	// Daten in der Datenbank ändern
/*	$sql = "UPDATE users SET 		 aanrede='$aanrede',
									 aname='$aname',
									 avorname='$avorname',
									 atelefonvw='$atelefonvw',
									 atelefon='$atelefon',
 									 atelefaxvw='$atelefaxvw',
 									 atelefax='$atelefax',
 									 amobilvw='$amobilvw',
 									 amobil='$amobil',
									 amail='$amail',
							 		 url='$url',
									 beschreibung='$beschreibung',
									 logo='$logoname'
						WHERE id='$userid'";*/
						
						
			$sql = "UPDATE users SET 		
									 logo='$logoname'
						WHERE id='$userid'";
							
			
		$result =  mysql_query($sql,$link);

		//konnten die daten gespeichert werden? wenn nicht enthält ergebnis TRUE andernfalls FALSE
		if ($result) {$datenbankfehler = false;} else {$datenbankfehler = true;}

		// Datenbankverbindung schließen
		mysql_close($link);
	
		// Weiterleiten falls kein Datenbankfehler aufgetreten ist.
		if ($datenbankfehler == false) {
			header ("Location:vcard.php"); 
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
	
	//Stammdaten zuweisen
	$firma = $unternehmen["firma"];
	$art = $unternehmen["art"];
	$rechtsform = $unternehmen["rechtsform"];
	$branche = $unternehmen["branche"];
	
	$strasse = $unternehmen["strasse"];
	$hnr = $unternehmen["hnr"];
	$ort = $unternehmen["ort"];
	$ortsteil = $unternehmen["ortsteil"];	
	$plz = $unternehmen["plz"];
		
	$ianrede = $unternehmen["ivorname"];
	$iname = $unternehmen["iname"];	
	$ivorname = $unternehmen["ivorname"];
	
	$logo = $unternehmen["logo"];*/
	}

}
ELSE
{	// Stammdaten laden
/*	$sql = "SELECT * FROM users WHERE id='$userid'";
	$result = mysql_query($sql,$link);
	$unternehmen = mysql_fetch_array($result);
	
	//Stammdaten zuweisen
	$firma = $unternehmen["firma"];
	$art = $unternehmen["art"];
	$rechtsform = $unternehmen["rechtsform"];
	$branche = $unternehmen["branche"];
	
	$strasse = $unternehmen["strasse"];
	$hnr = $unternehmen["hnr"];
	$ort = $unternehmen["ort"];
	$ortsteil = $unternehmen["ortsteil"];	
	$plz = $unternehmen["plz"];
		
	$ianrede = $unternehmen["ivorname"];
	$iname = $unternehmen["iname"];	
	$ivorname = $unternehmen["ivorname"];
	
	$aanrede = $unternehmen["aanrede"];
	$aname = $unternehmen["aname"];	
	$avorname = $unternehmen["avorname"];
	
	$atelefonvw = $unternehmen["atelefonvw"];
	$atelefon = $unternehmen["atelefon"];
	$atelefaxvw = $unternehmen["atelefaxvw"];
	$atelefax = $unternehmen["atelefax"];
	$amobilvw = $unternehmen["amobilvw"];
	$amobil = $unternehmen["amobil"];
	$amail = $unternehmen["amail"];
	
	$url = $unternehmen["url"];
	$logo = $unternehmen["logo"];
	$beschreibung = $unternehmen["beschreibung"];*/
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
	echo "<tr><td colspan=\"4\" class=\"fehlerheader\"><b>Beim Ausfüllen des Formulares sind Fehler aufgreten</b></td></tr>";
	echo "<tr><td colspan=\"4\" bgcolor=\"White\"><b>Bitte Korrigieren Sie Folgende Angaben:</b></td></tr>";
	echo "<tr><td colspan=\"4\" bgcolor=\"White\">$errormessage</td></tr>";
}
?>
<tr>
	<th colspan="4" class="liste"><b>Allgemeine Angaben</b></th>
</tr>
<tr><td colspan="4" class="help">Diese Angaben werden aus den Stammdaten übernommen.<font color="green"> * </font> </td></tr>
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
<tr>
	<th colspan="4" class="liste"><b>Ansprechpartner für Interessenten</b></th>
</tr>

<tr>
	<td class="formbez">Anrede<font color="Red">*</font><font color="green"> * </font> </td>
	<td><? Anreden("aanrede",$aanrede)?></td>
</tr>

<tr>
	<td <? if (isset($error['avorname'])) {echo "class=\"formerr\"";} else {echo "class=\"formbez\"";}?>>Vorname<font color="Red">*</font><font color="green"> * </font> </td>
	<td><input type="text" name="avorname" value="<? echo $avorname; ?>"></td>

	<td <? if (isset($error['aname'])) {echo "class=\"formerr\"";} else {echo "class=\"formbez\"";}?>>Nachname<font color="Red">*</font><font color="green"> * </font> </td>
	<td><input type="text" name="aname" value="<? echo $aname ?>"></td>
</tr>




<tr>

	<td class="formbez">Telefon<font color="green"> * </font> </td>
	<td><input type="text" name="atelefonvw" value="<? echo $atelefonvw ?>" size="10" maxlength="7">&nbsp;/&nbsp;<input type="text" name="atelefon" value="<? echo $atelefon ?>" size="10" maxlength="12"></td>
	<td class="formbez">Telefax<font color="green"> * </font> </td>
	<td><input type="text" name="atelefaxvw" value="<? echo $atelefaxvw ?>" size="10" maxlength="7">&nbsp;/&nbsp;<input type="text" name="atelefax" value="<? echo $atelefax ?>" size="10" maxlength="12"></td>

</tr>


<tr>

	<td class="formbez">Mobil<font color="green"> * </font> </td>
	<td><input type="text" name="amobilvw" value="<? echo $amobilvw ?>" size="10" maxlength="4">&nbsp;/&nbsp;<input type="text" name="amobil" value="<? echo $amobil ?>" size="10" maxlength="8"></td>

</tr>

<tr>
	<td <? if (isset($error['amail'])) {echo "class=\"formerr\"";} else {echo "class=\"formbez\"";}?>>E-Mail<font color="green"> * </font> </td>
	<td colspan="3"><input type="text" size="50"  name="amail" value="<? echo $amail ?>"></td>
</tr>
<tr>
	<td <? if (isset($error['url'])) {echo "class=\"formerr\"";} else {echo "class=\"formbez\"";}?>>Internet<font color="green"> * </font> </td>
	<td colspan="3"><input type="text" size="50"  name="url" value="<? echo $url ?>"></td>
</tr>


<tr>
	<th colspan="4" class="liste"><b>Beschreibungstext</b></th>
</tr>
<tr>
	<td class="formbez">Beschreibung<font color="green"> * </font> </td>
	<td colspan="3"><textarea cols="50" rows="7" name="beschreibung"><? echo $beschreibung ?></textarea></td>
</tr>
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
<tr><td colspan="4"><font color="green"> * </font> Diese Daten werden veröffentlicht.</td></tr>
<tr><td colspan="4">Hinweis: Beim Hochladen eines neuen Logos kann es nötig sein in Ihrem Browser den "Aktualisieren-Button" zu betätigen, damit die Änderungen sichtbar werden.</td></tr>
</table>
</form>
			<!-- End page content -->
            </td>
         </tr>
         <!-- Fußzeile -->
         <tr>
            <td colspan="2" align="center" class="bottom">
                <? include ("bottom.inc.php"); ?>
			</td>
		 </tr>
      </table>
   </body>
</html>

