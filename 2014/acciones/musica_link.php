<?php
session_start();
if($_SESSION["online"] != "1"){
	echo '<script language="javascript">window.location.href = "../musica";</script>';
}
else{
	if (!$_POST["artista"]||!$_POST["cancion"]||!$_POST["link"]) {
		echo '<script language="javascript">alert("Por favor, rellena todos los campos.");window.history.back();</script>';
	} 
	else{
		$usuariocancion = $_POST['usuariocancion'];
		$elartista = $_POST['artista'];
		$elartista = ucwords($elartista);
		$elartista = str_replace("'",'',$elartista);
		$elartista = str_replace('"','',$elartista);
		$lacancion = $_POST['cancion'];
		$lacancion = ucwords($lacancion);
		$lacancion = str_replace("'",'',$lacancion);
		$lacancion = str_replace('"','',$lacancion);
		$elLink = $_POST['link'];
		$cancionSEOnulo = "";
		
		include('../config.php');
		// Conectar a la base de datos
		mysql_connect ($dbhost, $dbusername, $dbuserpass);
		mysql_select_db($dbname) or die("<div align='center' style='color:#000;font-size:26px'>El servidor ha experimentado un problema al conectar con la base de datos.<br />Por favor, inténtalo de nuevo.</div>");
		date_default_timezone_set('Europe/Madrid');
		$fecha=date('Y/m/d H:i:s');
		$insertar = "INSERT INTO 2014_07_19_canciones(usuario, artista, titulo, archivo, link, sent) VALUES ('$usuariocancion', '$elartista', '$lacancion', '$cancionSEOnulo', '$elLink', '$fecha')";
		mysql_query($insertar);
		echo '<script language="javascript">alert("Gracias por enviar tu cancion.");window.location.href = "../musica";</script>';
	}
}
?>