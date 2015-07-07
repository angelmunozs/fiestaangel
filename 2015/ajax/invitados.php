<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<?php
session_start();
include('../config.php');
mysql_connect ($dbhost, $dbusername, $dbuserpass);
mysql_select_db($dbname) or die("El servidor ha experimentado un problema al conectar con la base de datos. Por favor, inténtalo de nuevo.");
// Cabecera
echo '<div style="background-color:rgba(0, 0, 0, 0.7); padding-bottom:18px;">';
echo '<div align="center" style="font-family:'."'PT Sans Narrow'".';color:#FACC2E; font-size:24px; padding:15px; border-radius:1px;">'.
	'Asistentes confirmados'.
	'</div>';
// Saca datos
$invitadosConfirmados = array();
$array = mysql_query("SELECT 2015_07_10_invitados.nombre AS nombre, 2015_07_10_invitados.apellido AS apellido FROM 2015_07_10_invitados WHERE confirmado=1 AND usuario!='admin' ORDER BY 2015_07_10_invitados.lastlogin DESC");
while ($row = mysql_fetch_array($array)) {
	array_push($invitadosConfirmados, $row["nombre"].' '.$row["apellido"]);
}
for ($i=0;$i<mysql_num_rows($array);$i++){
	echo '<div align="center" style="font-family:'."'Open Sans Condensed'".';color:#eee;font-size:17px;">'.$invitadosConfirmados[$i].'</div>';
}
echo '</div>';
?>