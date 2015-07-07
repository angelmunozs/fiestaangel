<?php
session_start();
// Configura los datos de tu cuenta
include('../config.php');
// Conectar a la base de datos
mysql_connect ($dbhost, $dbusername, $dbuserpass);
mysql_select_db($dbname) or die("<div align='center' style='color:#000;font-size:26px'>El servidor ha experimentado un problema al conectar con la base de datos.<br />Por favor, inténtalo de nuevo.</div>");

if($_SESSION["online"] != "1"){
	echo '<script language="javascript">window.location.href = "../encuesta";</script>';
}
else{
	$query = mysql_query("SELECT * FROM 2015_07_10_invitados WHERE usuario = '".$_SESSION['usuario']."'") or die(mysql_error());
	$row = mysql_fetch_array($query);
	$encuestahecha = $row['encuesta'];
	$usuarioencuesta = $_SESSION['usuario'];
	// Si no se ha hecho...
	if($encuestahecha==0){
		echo '<script language="javascript">window.location.href = "../encuesta";</script>';
	}
	// Si ya se ha hecho...
	else{
		$eliminaanterior = "DELETE FROM 2015_07_10_encuesta WHERE usuario='$usuarioencuesta'";
		mysql_query($eliminaanterior);
		$cambiaencuesta = "UPDATE 2015_07_10_invitados SET encuesta=0 WHERE usuario='$usuarioencuesta'";
		mysql_query($cambiaencuesta);
		echo '<script language="javascript">window.location.href = "../encuesta";</script>';
	}
}
?>