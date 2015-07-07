<?php
// Configura los datos de tu cuenta
include('../config.php');
session_start();
// Conectar a la base de datos
mysql_connect ($dbhost, $dbusername, $dbuserpass);
mysql_select_db($dbname) or die("Please, try again. We had a problem when connecting to database");
$query = mysql_query("SELECT password FROM 2015_07_10_invitados WHERE usuario = '".$_POST['consultaPass']."'") or die(mysql_error());
$row = mysql_fetch_array($query);
$elPassword = $row['password'];
	echo '<script language="javascript">alert("Usuario:  '.$_POST['consultaPass'].' \nPassword:  '.$elPassword.' \n");window.location.href = "../admin";</script>';
?>