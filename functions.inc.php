<?

/* FUNCTION colorchange($newcolor,$color1, $color2);

Tauscht zwei Farben miteinander aus.

Übergeben werden folgende Variablen:
$color1	RGB-Wert der ersten Farbe
$color2 RGB-Wert der zweiten Farbe
$newcolor Rückgabewert
*/

function colorchange($newcolor,$color1,$color2) {

	// Ausgabe startet mit Farbe 1
	if (!isset($newcolor)) {$newcolor = $color2;}

	switch ($newcolor){
		case $color1: $newcolor = $color2; break;
		case $color2: $newcolor = $color1;}
	return $newcolor;
}

function company_table_short($result) 
/* 	Diese Funktion gibt nur die Wichtigsten Daten eines Clienten aus: 
	ID, Name, Vorname, Firma 

	Varibalen:
	$result Ergebnis einer mySQL Abfrage
	*/
{
$farbe = "#ffffff";

       	echo "<table align='center' border=0 cellpadding='5' cellspacing='0'>";
       	echo "<tr>";
  		echo "<th colspan='4' bgcolor='#CCCCCC'></th>";
       	echo "<th bgcolor='#cccccc'>ID</th>";
       	echo "<th bgcolor='#cccccc'>Firma</th>";
       	echo "<th bgcolor='#cccccc'>Inhaber</th>";
       	echo "</tr>";
    	
    $num = mysql_num_rows($result);

	for ($j = 0; $j < $num; $j++) 
           		{
			        $row = mysql_fetch_array($result);
					$farbe = colorchange($farbe,"#f5f5f5","#ffffff");
	       	echo "<tr>";
				echo "<td bgcolor='$farbe'><a href='user_view.php?id=$row[id]&usertype=member'><img src='../gfx/user_view.gif' width='16' height='16' border='0' alt='Benutzerdaten ansehen'></a></td>" ;
				echo "<td bgcolor='$farbe'><a href='user_update.php?id=$row[id]&usertype=member'><img src='../gfx/user_data.gif' width='16' height='16' border='0' alt='Benutzerdaten ändern'></a></td>" ;
				echo "<td bgcolor='$farbe'><a href='user_pass.php?id=$row[id]&usertype=member'><img src='../gfx/user_pass.gif' width='16' height='16' border='0' alt=''></a></td>" ;
				echo "<td bgcolor='$farbe'><a href='user_delete.php?id=$row[id]&usertype=member'><img src='../gfx/user_sweep.gif' width='16' height='16' border='0' alt=''></a></td>";
				echo "<td bgcolor='$farbe'>$row[id]</td>";			
				echo "<td bgcolor='$farbe'>$row[firma]</td>";
				echo "<td bgcolor='$farbe'>$row[ivorname] $row[iname]</td>";
			echo "</tr>";}
	echo "</table>";
}

function association_table_short($result) 
/* 	Diese Funktion gibt nur die Wichtigsten Daten eines Clienten aus: 
	ID, Name, Vorname, Firma 

	Varibalen:
	$result Ergebnis einer mySQL Abfrage
	*/
{
$farbe = "#ffffff";

       	echo "<table align='center' border=0 cellpadding='5' cellspacing='0'>";
       	echo "<tr>";
  		echo "<th colspan='4' bgcolor='#CCCCCC'></th>";
       	echo "<th bgcolor='#cccccc'>ID</th>";
       	echo "<th bgcolor='#cccccc'>Verein</th>";
       	echo "<th bgcolor='#cccccc'>Vorstand</th>";
       	echo "</tr>";
    	
    $num = mysql_num_rows($result);

	for ($j = 0; $j < $num; $j++) 
           		{
			        $row = mysql_fetch_array($result);
					$farbe = colorchange($farbe,"#f5f5f5","#ffffff");
	       	echo "<tr>";
				echo "<td bgcolor='$farbe'><a href='user_view.php?id=$row[id]&usertype=assoc'><img src='../gfx/user_view.gif' width='16' height='16' border='0' alt='Benutzerdaten ansehen'></a></td>" ;
				echo "<td bgcolor='$farbe'><a href='user_update.php?id=$row[id]&usertype=assoc'><img src='../gfx/user_data.gif' width='16' height='16' border='0' alt='Benutzerdaten ändern'></a></td>" ;
				echo "<td bgcolor='$farbe'><a href='user_pass.php?id=$row[id]&usertype=assoc'><img src='../gfx/user_pass.gif' width='16' height='16' border='0' alt=''></a></td>" ;
				echo "<td bgcolor='$farbe'><a href='user_delete.php?id=$row[id]&usertype=assoc''><img src='../gfx/user_sweep.gif' width='16' height='16' border='0' alt=''></a></td>";
				echo "<td bgcolor='$farbe'>$row[id]</td>";			
				echo "<td bgcolor='$farbe'>$row[verein]</td>";
				echo "<td bgcolor='$farbe'>$row[vvorname] $row[vname]</td>";
			echo "</tr>";}
	echo "</table>";
}


function user_table_admin($result) 
/* 	Usertabelle für den Administrator

	Varibalen:
	$result Ergebnis einer mySQL Abfrage
	*/
{
$farbe = "#ffffff";
global $usortierung;
       	echo "<table align='center' border=0 cellpadding='8' cellspacing='0'>";
		echo "<form action=\"$php_self\">";		
		echo "<tr>";
		echo "<th colspan=\"5\" class=\"userform\"><img src=\"../gfx/view.gif\" border=\"0\" alt=\"\" align=\"absmiddle\">&nbsp;&nbsp;Alle User</th>";
		echo "<th colspan=\"1\" class=\"userform\">Sortieren nach</th>";
		echo "<th colspan=\"3\" class=\"userform\">";
		usortierung($usortierung);
		echo "</th>";
		echo "</tr>";		
		echo "</form>";		
       	echo "<tr>";
  		echo "<td colspan=\"8\"><a href='user_profile_new.php'><img src='../gfx/new.gif' border='0' alt='Neues Benutzerprofil'>&nbsp;&nbsp;Neus Benutzerprofil hinzufügen</a></td>";
       	echo "</tr>";		
       	echo "<tr>";
  		echo "<th colspan='4' bgcolor='#cccccc'></th>";
       	echo "<th bgcolor='#cccccc'>ID</th>";
       	echo "<th bgcolor='#cccccc'>Firma / Verein</th>";
		echo "<th bgcolor='#cccccc'>Inhaber</th>";
		echo "<th bgcolor='#cccccc'>Vorstand</th>";
       	echo "</tr>";
    	
    $num = mysql_num_rows($result);

	for ($j = 0; $j < $num; $j++) 
           		{
			        $row = mysql_fetch_array($result);
					$farbe = colorchange($farbe,"#f5f5f5","#ffffff");
	       	echo "<tr>";
				echo "<td bgcolor='$farbe'><a href='profiles.php?action=view&userid=$row[id]'><img src='../gfx/view.gif' border='0' alt='Details anzeigen'></a></td>" ;
				echo "<td bgcolor='$farbe'><a href='profiles.php?action=update&userid=$row[id]'><img src='../gfx/update.gif' border='0' alt='Benutzerprofil ändern'></a></td>" ;
				echo "<td bgcolor='$farbe'><a href='profiles.php?action=delete&userid=$row[id]'><img src='../gfx/delete.gif' border='0' alt='Benutzerprofil löschen'></a></td>";
				echo "<td bgcolor='$farbe'><a href='profiles.php?action=unlock&userid=$row[id]'><img src='../gfx/passport.gif' border='0' alt='Benutzerprofil freischalten'></a></td>";
				echo "<td bgcolor='$farbe'>$row[id]</td>";			
				echo "<td bgcolor='$farbe'>$row[firma]$row[verein]</td>";
				echo "<td bgcolor='$farbe'>$row[ivorname] $row[iname]</td>";
				echo "<td bgcolor='$farbe'>$row[vvorname] $row[vname]</td>";			
			echo "</tr>";}
	echo "</table>";
}


function event_table_admin($result) 
/* 	Eventtabelle für den Benutzer

	Varibalen:
	$result Ergebnis einer mySQL Abfrage
	*/
{
$farbe = "#ffffff";
global $esortierung;
       	echo "<table align='center' border=0 cellpadding='8' cellspacing='0'>";
		echo "<form action=\"$php_self\">";		
		echo "<tr>";
		echo "<th colspan=\"4\" class=\"userform\"><img src=\"../gfx/view.gif\" border=\"0\" alt=\"\" align=\"absmiddle\">&nbsp;&nbsp;Alle geplanten Veranstaltungen</th>";
		echo "<th colspan=\"1\" class=\"userform\">Sortieren nach</th>";
		echo "<th colspan=\"3\" class=\"userform\">";
		esortierung($esortierung);
		echo "</th>";
		echo "</tr>";		
		echo "</form>";		
       	echo "<tr>";
  		echo "<td colspan=\"8\"><a href='event_add_details.php'><img src='../gfx/new.gif' border='0' alt='Veranstaltungsdetails ansehen'>&nbsp;&nbsp;Neue Veranstaltung hinzufügen</a></td>";
       	echo "</tr>";		
       	echo "<tr>";
  		echo "<th colspan='3' bgcolor='#cccccc'></th>";
       	echo "<th bgcolor='#cccccc'>Titel</th>";
       	echo "<th bgcolor='#cccccc'>Veranstalter</th>";
       	echo "<th bgcolor='#cccccc'>Von</th>";
		echo "<th bgcolor='#cccccc'>Bis</th>";
       	echo "<th bgcolor='#cccccc'>Treffpunkt</th>";
       	echo "</tr>";
    	
    $num = mysql_num_rows($result);

	for ($j = 0; $j < $num; $j++) 
           		{
			        $row = mysql_fetch_array($result);
					$farbe = colorchange($farbe,"#f5f5f5","#ffffff");
	       	echo "<tr>";
				echo "<td bgcolor='$farbe'><a href='events.php?action=view&eventid=$row[eventid]'><img src='../gfx/view.gif' border='0' alt='Details anzeigen'></a></td>" ;
				echo "<td bgcolor='$farbe'><a href='events.php?action=update&eventid=$row[eventid]'><img src='../gfx/update.gif' border='0' alt='Veranstaltungsdaten ändern'></a></td>" ;
				echo "<td bgcolor='$farbe'><a href='events.php?action=delete&eventid=$row[eventid]'><img src='../gfx/delete.gif' border='0' alt='Veranstaltung löschen'></a></td>";
				echo "<td bgcolor='$farbe'>$row[titel]</td>";
				echo "<td bgcolor='$farbe'>$row[firma]$row[verein]</td>";			
				echo "<td bgcolor='$farbe'>$row[von]</td>";
				echo "<td bgcolor='$farbe'>$row[bis]</td>";
				echo "<td bgcolor='$farbe'>$row[treffpunkt]</td>";
			echo "</tr>";}
	echo "</table>";
}



function event_table_user($result) 
/* 	Eventtabelle für den Benutzer

	Varibalen:
	$result Ergebnis einer mySQL Abfrage
	*/
{
$farbe = "#ffffff";

       	echo "<table align='center' border=0 cellpadding='5' cellspacing='0'>";
       	echo "<tr>";
  		echo "<td colspan=\"7\"><a href=\"javascript:NeuesFenster('event2_add.php','')\"><img src='../gfx/new.gif' border='0' alt='Veranstaltungsdetails ansehen'>&nbsp;&nbsp;Neue Veranstaltung hinzufügen</a></td>";
       	echo "</tr>";		
       	echo "<tr>";
  		echo "<th colspan='4' bgcolor='#cccccc'></th>";
       	echo "<th bgcolor='#cccccc'>Titel</th>";
       	echo "<th bgcolor='#cccccc'>Von</th>";
		echo "<th bgcolor='#cccccc'>Bis</th>";
       	echo "<th bgcolor='#cccccc'>Treffpunkt</th>";
       	echo "</tr>";
    	
    $num = mysql_num_rows($result);

	for ($j = 0; $j < $num; $j++) 
           		{
			        $row = mysql_fetch_array($result);
					$farbe = colorchange($farbe,"#f5f5f5","#ffffff");
	       	echo "<tr>";
				echo "<td bgcolor='$farbe'><a href=\"javascript:NeuesFenster('event2_view.php?eventid=',$row[eventid])\"><img src='../gfx/view.gif' border='0' alt='Details anzeigen'></a></td>" ;
				echo "<td bgcolor='$farbe'><a href=\"javascript:NeuesFenster('event2_update.php?eventid=',$row[eventid])\"><img src='../gfx/open.gif' border='0' alt='Veranstaltungsdaten ändern'></a></td>" ;
				echo "<td bgcolor='$farbe'><a href=\"javascript:NeuesFenster('event2_clone.php?eventid=',$row[eventid])\"><img src='../gfx/copy.gif' border='0' alt='Veranstaltungsdaten kopieren'></a></td>" ;
				echo "<td bgcolor='$farbe'><a href=\"javascript:NeuesFenster('event2_delete.php?eventid=',$row[eventid])\"><img src='../gfx/delete.gif' border='0' alt='Veranstaltung löschen'></a></td>";
				echo "<td bgcolor='$farbe'>$row[titel]</td>";			
				echo "<td bgcolor='$farbe'>$row[von]</td>";
				echo "<td bgcolor='$farbe'>$row[bis]</td>";
				echo "<td bgcolor='$farbe'>$row[treffpunkt]</td>";
			echo "</tr>";}
	echo "</table>";
}

/* FUNCTION branchen_uebersicht

Gibt eine Branchenübersicht aus

Übergeben werden folgende Variablen:
$branchen	Ergebnis der mySQL Abfrage
*/

function branchen_uebersicht($branchen) {

	$anzahl = mysql_num_rows($branchen);
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\" align=\"center\">";
		echo "<tr bgcolor=\"$bg_farbe\">";
		for ($j = 0; $j < $anzahl; $j++) {
			$brancheninfo = mysql_fetch_array($branchen);
			$bg_farbe = colorchange($bg_farbe,"#ffffff","#f5f5f5");
			echo "<td valign=\"bottom\">";
				echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\" align=\"center\">";
					echo "<tr>";
						echo "<td align=\"center\">";
							echo "<a href=\"view_group.php?pgid=$groupinfo[pgid]\" title=\"zur Produktgruppe wechseln ... \" target=\"_self\">";
							echo "<img src=\"productgfx/".$groupinfo['pgid'].".gif\" border=\"0\" alt=\"zur Produktgruppe wechseln ... \">";
							echo "</a>";
						echo "</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<th class=\"subgroup\">";
							echo "<a href=\"view_branch.php?bid=$brancheninfo[id]\" title=\"zur Produktgruppe wechseln ... \" target=\"_self\">".$brancheninfo['branche']."</a>";
						echo "</th>";
					echo "</tr>";
				echo "</table>";
			echo "</td>";
			if (($j+1)%3 == 0) {
				echo "</tr>";	
				echo "<tr>";
			}
		}
		echo "</tr>";
	echo "</table>";
}

function unternehmen_listen($unternehmensliste) {

	$anzahl = mysql_num_rows($unternehmensliste);
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\" align=\"center\">";
		echo "<tr>";
			echo "<th class=\"artikelliste\">Firma</th>";
			echo "<th class=\"artikelliste\"></th>";
			echo "<th class=\"artikelliste\"></th>";
			echo "<th colspan=\"2\" class=\"artikelliste\">&nbsp;</th>";
		echo "</tr>";
		for ($j = 0; $j < $anzahl; $j++) {
			$unternehmen = mysql_fetch_array($unternehmensliste);
			$bg_farbe = colorchange($bg_farbe,"#ffffff","#f5f5f5");
			echo "<tr bgcolor=\"$bg_farbe\">";
				echo "<td bgcolor=\"$bg_farbe\"><a href=\"view_company.php?cid=$unternehmen[id]&bid=$unternehmen[branche]\" title=\"Artikeldetails ansehen ...\" target=\"_self\">".$unternehmen['firma']."</a></td>";
				echo "<td bgcolor=\"$bg_farbe\">".$unternehmen['vorname']."</td>";
				if (!$unternehmen['name'] == "") { echo "<td bgcolor=\"$bg_farbe\">".$unternehmen['name']."</td>";}
				echo "<td bgcolor=\"$bg_farbe\"><a href=\"view_article.php?id=$artikel[id]\" title=\"Artikeldetails ansehen ...\" target=\"_self\">".$artikel['artikelname']."</a></td>";
				echo "<td bgcolor=\"$bg_farbe\">$artikel[verpackung]</td>";
			echo "</tr>";
			echo "<tr bgcolor=\"$bg_farbe\">";
				echo "<td bgcolor=\"$bg_farbe\">".$unternehmen['beschreibung']."</td>";
			echo "</tr>";
		}
	echo "</table>";
}



function calendar($start,$ende,$intervallende,$funktion) {


	switch ($funktion) {
		case "start":
			$timestring = "ende=".$ende."&intervallende=".$intervallende;
			$datum = $start;
			break;
		case "ende":
			$timestring = "start=".$start."&intervallende=".$intervallende;
			$datum = $ende;
			break;
		case "intervallende":
			$timestring = "start=".$start."&ende=".$ende;
			$datum = $intervallende;
			break;
	}

	$today   = getdate(time ());
	$akt_month = $today['mon'];
	$akt_year  = $today['year'];
	
	
	$aktuell = getdate($datum);

	If ($funktion <> "intervallende") {
		$minute = $aktuell['minutes'];
		$hour   = $aktuell['hours'];
	}
	else {
		$minute = 59;
		$hour   = 23;
	}
	$day    = $aktuell['mday'];
	$month  = $aktuell['mon'];
	$year   = $aktuell['year'];

	$firstday = getdate(mktime(0, 0, 0, $month, 1, $year));
	$lastday  = date("t", mktime(0, 0, 0, $month, 1, $year));

	$monthday = 1;

	print "<table border='0' cellspacing='0' cellpadding='4' align='left'>\n";
	print "<tr>\n";
	print "<th class=\"calendar\" colspan=\"7\">".$firstday['month']." ".$firstday['year']."</th>\n";
	print "</tr>\n";	
	echo "<tr>\n";
	IF (mktime($hour, $minute, 0, $month-1, $day, $year) >= mktime(0, 0, 0, $akt_month, 0, $akt_year)) {
	$urlstring = $timestring."&".$funktion."=".mktime($hour, $minute, 0, $month-1, $day, $year);
	echo "<td colspan=\"3\" class=\"last\"><a href=\"$phpself?$urlstring\" class=\"last\"><&nbsp;letzter</td>";
	}
	else {
		echo "<td colspan=\"3\" class=\"next\">&nbsp;</td>";
	}
	echo "<td>&nbsp;</td>";
	IF (mktime($hour, $minute, 0, $month+1, $day, $year) <= mktime(0, 0, 0, $akt_month+12, 0, $akt_year)) {
	$urlstring = $timestring."&".$funktion."=".mktime($hour, $minute, 0, $month+1, $day, $year);
	echo "<td colspan=\"3\" class=\"next\"><a href=\"$phpself?$urlstring\" class=\"next\">nächster&nbsp;></td>";
	}
	else {
		echo "<td colspan=\"3\" class=\"next\">&nbsp;</td>";
	}
	echo "</tr>\n";


	echo "<tr>\n";
	echo "<th class=\"calendar\">So</th>";
	echo "<th class=\"calendar\">Mo</th>";	
	echo "<th class=\"calendar\">Di</th>";
	echo "<th class=\"calendar\">Mi</th>";
	echo "<th class=\"calendar\">Do</th>";
	echo "<th class=\"calendar\">Fr</th>";
	echo "<th class=\"calendar\">Sa</th>";

	echo "</tr>\n";

	while ($monthday <= $lastday) {
		echo "<tr>\n";
		for ($i=0;$i<7;$i++) {
			if (($i >= $firstday['wday'] and  $monthday <= 7) or ($monthday <= $lastday and $monthday > (7-$firstday['wday']))) {
				$urlstring = $timestring."&".$funktion."=".mktime($hour, $minute, 59, $month, $monthday, $year);
				if ($i == 0 || $i == 6)
					print "<td class=\"sunday\"><a href=\"$phpself?".$urlstring."\" class=\"sunday\">$monthday</a></td>\n";
				else {
					print "<td class=\"weekday\"><a href=\"$phpself?".$urlstring."\" class=\"weekday\">$monthday</a></td>\n";
				}
				$monthday++;
			}
			else {
				if ($i == 0 || $i == 6)
						print "<td>&nbsp;</td>\n";
				else
						print "<td>&nbsp;</td>\n";
				}
			}
		echo "</tr>\n";
	}
	
/*	If ($funktion <> "intervallende") {
	echo "<tr>\n";
	echo "<td colspan=\"2\" rowspan=\"2\" class=\"clock\">".date("H",$datum)."</td>";
	$urlstring = $timestring."&".$funktion."=".mktime($hour+1, $minute, 59, $month, $day, $year);
	echo "<td class=\"clock\"><a href=\"$phpself?".$urlstring."\"><img src=\"../gfx/clock_up.gif\" border=\"0\"></a></td>";
	echo "<td rowspan=\"2\" class=\"clock\">:</td>";
	echo "<td colspan=\"2\" rowspan=\"2\" class=\"clock\">".date("i",$datum)."</th>";
	$urlstring = $timestring."&".$funktion."=".mktime($hour, $minute+5, 59, $month, $day, $year);
	echo "<td class=\"clock\"><a href=\"$phpself?".$urlstring."\"><img src=\"../gfx/clock_up.gif\" border=\"0\"></a></td>";
	echo "<td rowspan=\"2\" class=\"clock\">Uhr</td>";
	echo "</tr>\n";
	echo "<tr>\n";
	$urlstring = $timestring."&".$funktion."=".mktime($hour-1, $minute, 59, $month, $day, $year);	
	echo "<td class=\"clock\"><a href=\"$phpself?".$urlstring."\"><img src=\"../gfx/clock_down.gif\" border=\"0\"></a></td>";
	$urlstring = $timestring."&".$funktion."=".mktime($hour, $minute-5, 59, $month, $day, $year);
	echo "<td class=\"clock\"><a href=\"$phpself?".$urlstring."\"><img src=\"../gfx/clock_down.gif\" border=\"0\"></a></td>";
	echo "</tr>\n";
	}
*/
	print "</table>\n";
}



function helpcalendar($start,$feld) {

	$datum = $start;

	$today   = getdate(time ());
	$akt_month = $today['mon'];
	$akt_year  = $today['year'];

	$aktuell = getdate($datum);

	$minute = $aktuell['minutes'];
	$hour   = $aktuell['hours'];
	$day    = $aktuell['mday'];
	$month  = $aktuell['mon'];
	$year   = $aktuell['year'];

	$firstday = getdate(mktime(0, 0, 0, $month, 1, $year));
	$lastday  = date("t", mktime(0, 0, 0, $month, 1, $year));

	$monthday = 1;

	print "<table border='0' cellspacing='0' cellpadding='4' align='left'>\n";
	print "<tr>\n";
	print "<th class=\"calendar\" colspan=\"7\">".$firstday['month']." ".$firstday['year']."</th>\n";
	print "</tr>\n";	
	echo "<tr>\n";
	IF (mktime($hour, $minute, 0, $month-1, $day, $year) >= mktime(0, 0, 0, $akt_month, 0, $akt_year)) {
	$urlstring = "start=".mktime($hour, $minute, 0, $month-1, $day, $year)."&feld=".$feld;
	echo "<td colspan=\"3\" class=\"last\"><a href=\"$phpself?$urlstring\" class=\"last\"><&nbsp;letzter</td>";
	}
	else {
		echo "<td colspan=\"3\" class=\"next\">&nbsp;</td>";
	}
	echo "<td>&nbsp;</td>";
	IF (mktime($hour, $minute, 0, $month+1, $day, $year) <= mktime(0, 0, 0, $akt_month+12, 0, $akt_year)) {
	$urlstring = "start=".mktime($hour, $minute, 0, $month+1, $day, $year)."&feld=".$feld;
	echo "<td colspan=\"3\" class=\"next\"><a href=\"$phpself?$urlstring\" class=\"next\">nächster&nbsp;></td>";
	}
	else {
		echo "<td colspan=\"3\" class=\"next\">&nbsp;</td>";
	}
	echo "</tr>\n";

	echo "<tr>\n";
	echo "<th class=\"calendar\">So</th>";
	echo "<th class=\"calendar\">Mo</th>";	
	echo "<th class=\"calendar\">Di</th>";
	echo "<th class=\"calendar\">Mi</th>";
	echo "<th class=\"calendar\">Do</th>";
	echo "<th class=\"calendar\">Fr</th>";
	echo "<th class=\"calendar\">Sa</th>";
	echo "</tr>\n";

	while ($monthday <= $lastday) {
		echo "<tr>\n";
		for ($i=0;$i<7;$i++) {
			if (($i >= $firstday['wday'] and  $monthday <= 7) or ($monthday <= $lastday and $monthday > (7-$firstday['wday']))) {
				$auswahl = date("d.m.Y",mktime(0, 0, 0, $month, $monthday, $year));
				if ($i == 0 || $i == 6)
					print "<td class=\"sunday\"><a href=\"javascript:datumuebernehmen('$auswahl','$feld')\" class=\"sunday\">$monthday</a></td>\n";
				else {
					print "<td class=\"weekday\"><a href=\"javascript:datumuebernehmen('$auswahl','$feld')\" class=\"weekday\">$monthday</a></td>\n";
				}
				$monthday++;
			}
			else {
				if ($i == 0 || $i == 6)
						print "<td>&nbsp;</td>\n";
				else
						print "<td>&nbsp;</td>\n";
				}
			}
		echo "</tr>\n";
	}
	print "</table>\n";
}

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


function message_table_user($link,$userid){

/*	Nachrichten des Benutzers auflisten
	2004-09-01

	Variablen:
	$link	Verbindung zur Datenbank
	$userid	Benutzer-ID des Benutzers
*/

	$sql = "SELECT * FROM nachrichten WHERE userid = '$userid' ORDER BY datum ";
	$nachrichten = mysql_query($sql,$link);
    
	$anzahl = mysql_num_rows($nachrichten);
	
	IF ($anzahl == 0) {
		echo "<b>Sie haben zur Zeit keine neuen Nachrichten.</b>";
	}
	ELSE {
		echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\" align=\"center\">";
			echo "<tr>";
				echo "<th colspan=\"3\" class=\"liste\">Ihre Nachrichten</th>";
			echo "</tr>";
			echo "<tr>";
				echo "<th>Datum</th>";
				echo "<th>Nachricht</th>";
				echo "<th>Quittieren</th>";
			echo "</tr>";
			for ($j = 0; $j < $anzahl; $j++) {
				$nachricht = mysql_fetch_array($nachrichten);
				$bg_farbe = colorchange($bg_farbe,"#ffffff","#f5f5f5");
				echo "<tr bgcolor=\"$bg_farbe\">";
					echo "<td valign=\"top\" bgcolor=\"$bg_farbe\">".$nachricht['datum']."</td>";
					echo "<td bgcolor=\"$bg_farbe\">".$nachricht['message']."</td>";
					echo "<td valign=\"top\" bgcolor=\"$bg_farbe\"><a href=\"quittieren.php?mid=$nachricht[messageid]\" title=\"Nachricht quittieren ...\" target=\"_self\">Nachricht löschen</a></td>";
				echo "</tr>";
			}
		echo "</table>";
	}
}


?>
