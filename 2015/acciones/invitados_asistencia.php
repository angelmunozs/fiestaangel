<?php
	session_start();
	// Configura los datos de tu cuenta
	if($_SESSION["online"] == "1") {
		include('../config.php');
		// Conectar a la base de datos
		mysql_connect ($dbhost, $dbusername, $dbuserpass);
		mysql_select_db($dbname) or die("Please, try again. We had a problem when connecting to database");
		//	Actualiza asistencia
		$asiste = null;
		if($_POST['si']) {
			$asiste = 1;
		}
		elseif($_POST['puede']) {
			$asiste = 2;
		}
		else {
			$asiste = 0;
		}
		$sql_invitado = 'UPDATE 2015_07_10_invitados SET confirmado = '.$asiste.' WHERE usuario LIKE "'.$_SESSION['usuario'].'"'; 
		mysql_query($sql_invitado) or die("Please, try again. We had a problem when connecting to database");
		//	Redirige
		echo "<script language='javascript'>window.location.href = '../index';</script>";
	}
	else {
		echo "<script language='javascript'>window.location.href = '../index';</script>";
	}
?>