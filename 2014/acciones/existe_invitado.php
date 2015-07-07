<?php
// Configura los datos de tu cuenta
include('../config.php');
session_start();
// Conectar a la base de datos
mysql_connect ($dbhost, $dbusername, $dbuserpass);
mysql_select_db($dbname) or die("Please, try again. We had a problem when connecting to database");
$sql_invitado = 'SELECT * FROM 2014_07_19_invitados'; 
$rec_invitado = mysql_query($sql_invitado); 
$esta_invitado = 0;
while($result = mysql_fetch_object($rec_invitado)){ 
	if($result->usuario == $_POST['form_usuario']){ 
		$esta_invitado = 1; 
	} 
} 
if($esta_invitado == 0){
	echo 1;
}
else{
	echo 0;
}
?>