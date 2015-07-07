<?php
//Guarda datos de la encuesta
$elUsuario = $_POST['elUsuario'];
session_start();
if($_SESSION["online"] != "1"){
	echo '<script language="javascript">window.location.href = "../admin";</script>';
}
else{
	if(!$elUsuario){
		echo "<script language='javascript'>alert('Por favor, selecciona un usuario.');window.location.href = '../admin';</script>";
	}
	else{
		// Configura los datos de tu cuenta
		include('../config.php');
		// Conectar a la base de datos
		mysql_connect ($dbhost, $dbusername, $dbuserpass);
		mysql_select_db($dbname) or die("<div align='center' style='color:#000;font-size:26px'>El servidor ha experimentado un problema al conectar con la base de datos.<br />Por favor, inténtalo de nuevo.</div>");
		$query = mysql_query("SELECT * FROM 2014_07_19_invitados WHERE usuario = '".$elUsuario."'") or die(mysql_error());
		$row = mysql_fetch_array($query);
		$encuestahecha = $row['encuesta'];
		// Si no se ha hecho...
		if($encuestahecha==0){
			// Elimina el usuario de la lista definitivamente
			$eliminainvitado = "DELETE FROM 2014_07_19_invitados WHERE usuario='$elUsuario'";
			mysql_query($eliminainvitado);
			echo '<script language="javascript">window.location.href = "../admin";</script>';
		}
		// Si ya se ha hecho...
		else{
			// Primero elimina la encuesta
			$eliminaencuesta = "DELETE FROM 2014_07_19_encuesta WHERE usuario='$elUsuario'";
			mysql_query($eliminaencuesta);
			// Después elimina el usuario de la lista definitivamente
			$eliminainvitado = "DELETE FROM 2014_07_19_invitados WHERE usuario='$elUsuario'";
			mysql_query($eliminainvitado);
			echo '<script language="javascript">window.location.href = "../admin";</script>';
		}
	}
}
?>