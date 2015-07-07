<?php
	session_start();
	// Configura los datos de tu cuenta
	if($_SESSION["online"] != "1") {
		echo 2;
	}
	else {
		include('../config.php');
		// Conectar a la base de datos
		mysql_connect ($dbhost, $dbusername, $dbuserpass);
		mysql_select_db($dbname) or die("Please, try again. We had a problem when connecting to database");
		$sql_invitado = 'SELECT confirmado FROM 2015_07_10_invitados WHERE usuario LIKE "'.$_SESSION['usuario'].'"';
		$result = mysql_query($sql_invitado);
		$data = mysql_fetch_array($result);
		echo $data['confirmado'];
	}
?>