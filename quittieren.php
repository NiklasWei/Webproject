<?
// Session starten
@session_start();

$userid = $_SESSION['userid'];

// Pr�fen ob die userid registriert ist und ggf. abbrechen
if (!session_is_registered('userid')) { 
	session_destroy();
	header ("Location:index.php"); 
}
else {
	// Verbindung zum Datenbankserver herstellen
	include("../modules/connect.inc.php");
	
	// Nachricht l�schen
	IF (isset($mid)) {
		$sql = "SELECT userid FROM nachrichten WHERE messageid='$mid'";
		$result = mysql_query($sql,$link);
		$nachricht = mysql_fetch_array($result);
		
		if ($nachricht['userid'] == $userid) {
			$sql = "DELETE FROM nachrichten WHERE messageid='$mid'";
			$result = @mysql_query($sql,$link);
			}
		else  {
			session_destroy();
			header ("Location:index.php"); 
			}
	}
	// Datenbankverbindung schlie�en
	@mysql_close($link);
	header ("Location:messages.php");
}
?>






?>