<? // Session starten@session_start();$userid = $_SESSION['userid'];// Pr�fen ob die userid registriert ist und ggf. abbrechenif (!session_is_registered('userid')) { 	session_destroy();	header ("Location:index.php"); }// Datenbankverbindung herstelleninclude ("../modules/connect.inc.php");// Funktionen einbindeninclude ("functions.inc.php");?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"><html>   <head>      <title>aloha.de / Share  your Skills</title>      <link rel="stylesheet" type="text/css" href="../css/user.css">   </head>   <body>      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="White">         <!-- Kopfzeile -->         <tr>            <td colspan="2" align="center" class="top">               <img src="../gfx/logo_gv.gif" width="360" height="80" border="0" alt="" vspace="0" hspace="20">            </td>         </tr>         <!-- Inhalt -->         <tr>            <!-- Seitenfenster -->            <td valign="top" bgcolor="#F5F5F5" style="border-right: 1px solid #003366;">               <? include ("navigation.inc.php"); ?>            </td>		             <!-- Hauptfenster -->            <td align="center" valign="middle">               <table border="0" cellspacing="15" cellpadding="0" align="center" class="content">                  <tr>                     <td colspan="2">					 	<!-- Page content -->             							<? message_table_user($link,$userid); ?>						<!-- End page content -->                     </td>                  </tr>               </table>            </td>         </tr>         <!-- Fu�zeile -->         <tr>            <td colspan="2" align="center" class="bottom">                <? include ("bottom.inc.php"); ?>			</td>		 </tr>      </table>   </body></html>