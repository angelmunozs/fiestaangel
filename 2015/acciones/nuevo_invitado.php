<?php
// Guarda el nombre
$elNombre = $_POST['nuevoNombre'];
// Convierte a minusculas
$nuevoNombre = strtolower($elNombre);
// Guarda el apelllido
$elApellido = $_POST['nuevoApellido'];
// Convierte a minusculas
$nuevoApellido = strtolower($elApellido);
// Construye el username
$elUsuario = $nuevoNombre.$nuevoApellido;
$elUsuario = str_replace(" ","",$elUsuario);
$elUsuario = str_replace("ñ","n",$elUsuario);
$elUsuario = str_replace("á","a",$elUsuario);
$elUsuario = str_replace("é","e",$elUsuario);
$elUsuario = str_replace("í","i",$elUsuario);
$elUsuario = str_replace("ó","o",$elUsuario);
$elUsuario = str_replace("ú","u",$elUsuario);
$elUsuario = str_replace("Á","A",$elUsuario);
$elUsuario = str_replace("É","E",$elUsuario);
$elUsuario = str_replace("Í","I",$elUsuario);
$elUsuario = str_replace("Ó","O",$elUsuario);
$elUsuario = str_replace("Ú","U",$elUsuario);
$elUsuario = str_replace("ç","c",$elUsuario);
$elUsuario = str_replace("ä","a",$elUsuario);
$elUsuario = str_replace("ë","e",$elUsuario);
$elUsuario = str_replace("ï","i",$elUsuario);
$elUsuario = str_replace("ö","o",$elUsuario);
$elUsuario = str_replace("ü","u",$elUsuario);
// Guarda el password
$elPassword = $_POST['nuevoPassword'];
$elPassword = str_replace(" ","",$elPassword);
$elPassword = str_replace("ñ","n",$elPassword);
$elPassword = str_replace("á","a",$elPassword);
$elPassword = str_replace("é","e",$elPassword);
$elPassword = str_replace("í","i",$elPassword);
$elPassword = str_replace("ó","o",$elPassword);
$elPassword = str_replace("ú","u",$elPassword);
$elPassword = str_replace("Á","A",$elPassword);
$elPassword = str_replace("É","E",$elPassword);
$elPassword = str_replace("Í","I",$elPassword);
$elPassword = str_replace("Ó","O",$elPassword);
$elPassword = str_replace("Ú","U",$elPassword);
$elPassword = str_replace("ç","c",$elPassword);
$elPassword = str_replace("ä","a",$elPassword);
$elPassword = str_replace("ë","e",$elPassword);
$elPassword = str_replace("ï","i",$elPassword);
$elPassword = str_replace("ö","o",$elPassword);
$elPassword = str_replace("ü","u",$elPassword);
session_start();
if($_SESSION["online"] != "1"){
	echo '<script language="javascript">window.location.href = "../admin";</script>';
}
else{
	if(!$elNombre||!$elApellido||!$elPassword){
		echo "<script language='javascript'>alert('Por favor, rellena todos los campos.');window.location.href = '../admin';</script>";
	}
	else{
		// Configura los datos de tu cuenta
		include('../config.php');
		// Conectar a la base de datos
		mysql_connect ($dbhost, $dbusername, $dbuserpass);
		mysql_select_db($dbname) or die("<div align='center' style='color:#000;font-size:26px'>El servidor ha experimentado un problema al conectar con la base de datos.<br />Por favor, inténtalo de nuevo.</div>");		
		$query = 'SELECT * FROM 2015_07_10_invitados'; 
		$invitados = mysql_query($query); 
		$existe_invitado = 0;
		while($result = mysql_fetch_object($invitados)){ 
			if($result->usuario == $elUsuario){ 
				$existe_invitado = 1; 
			} 
		} 
		if($existe_invitado!=0){
			echo "<script language='javascript'>alert('El usuario ya existe.');window.location.href = '../admin';</script>";
		}
		else{
			$query = mysql_query("INSERT INTO 2015_07_10_invitados (usuario, password, nombre, apellido) VALUES ('$elUsuario','$elPassword','$elNombre', '$elApellido')") or die(mysql_error());
			echo '<script language="javascript">alert("Nuevo usuario a\u00F1adido:\n\nUsuario:  '.$elUsuario.' \nPassword:  '.$elPassword.' \n");window.location.href = "../admin";</script>';
		}
	}
}
?>