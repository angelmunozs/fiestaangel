<?php
//Guarda datos de la encuesta
$usuarioencuesta = $_POST['usuarioencuesta'];
$preg0 = $_POST['0']; 
$preg1a = $_POST['1a']; 
$preg1b = $_POST['1b']; 
$preg2 = $_POST['2']; 
$preg3 = $_POST['3'];
$preg4 = $_POST['4'];
$preg5 = $_POST['5'];
$preg6 = $_POST['6'];
if ($preg6==''){
	$preg6="No";
}
$preg7 = $_POST['7'];
if ($preg7==''){
	$preg7="No";
}
$preg8 = $_POST['8'];
if ($preg8==''){
	$preg8="No";
}
$preg9 = $_POST['9'];
$preg10 = $_POST['10'];
$preg10min = strtolower($preg10);
$preg10 = ucfirst($preg10min);
$preg11 = $_POST['11'];
$preg12 = $_POST['12'];
if ($preg12==''){
	$preg12="No";
}
$opcion1 = $_POST['opciones1'];
if ($opcion1==''){
	$opcion1="No";
}
else{
	$opcion1min = strtolower($opcion1);
	$opcion1 = ucfirst($opcion1min);
}
$opcion2 = $_POST['opciones2'];
if ($opcion2==''){
	$opcion2="No";
}
else{
	$opcion2min = strtolower($opcion2);
	$opcion2 = ucfirst($opcion2min);
}
session_start();
if($_SESSION["online"] != "1"){
	echo '<script language="javascript">window.location.href = "../encuesta";</script>';
}
else{
	if(!$preg0||!$preg1a||!$preg2||!$preg3||!$preg4||!$preg5||!$preg9||!$preg11){
		echo "<script language='javascript'>alert('Por favor, rellena todos los campos antes de enviar la encuesta.');window.history.back();</script>";
	}
	else{
		// Configura los datos de tu cuenta
		include('../config.php');
		// Conectar a la base de datos
		mysql_connect ($dbhost, $dbusername, $dbuserpass);
		mysql_select_db($dbname) or die("<div align='center' style='color:#000;font-size:26px'>El servidor ha experimentado un problema al conectar con la base de datos.<br />Por favor, inténtalo de nuevo.</div>");
		date_default_timezone_set('Europe/Madrid');
		$fecha=date('Y/m/d H:i:s');
		// Guarda los resultados de la encuesta
		$insertar = "INSERT INTO 2015_07_10_encuesta(usuario,pasta,bebida1,bebida2,otrabebida1,otrabebida2,copas,cervezas,coche,dormir,beerpong,dardos,chupitos,artista,sugerencia,aguantar,secompromete,sent) VALUES ('$usuarioencuesta', '$preg0', '$preg1a', '$preg1b', '$opcion1', '$opcion2', '$preg2', '$preg3', '$preg4', '$preg5', '$preg6', '$preg7', '$preg8', '$preg9', '$preg10', '$preg11', '$preg12','$fecha')";
		mysql_query($insertar);
		// Indica que la encuesta ya está realizada
		$cambiaencuesta = "UPDATE 2015_07_10_invitados SET encuesta=1 WHERE usuario='$usuarioencuesta'";
		mysql_query($cambiaencuesta);
		// Falta actualizar campo 'encuesta' de la tabla usuarios
		echo "<script language='javascript'>window.location.href = '../encuesta';</script>";
	}
}
?>