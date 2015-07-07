<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
		<meta charset='utf-8'>
	</head>
	<body>
		<div style="background-color:rgba(0, 0, 0, 0.7); padding-bottom:18px;">
		<div align="center" style="font-family:'."'PT Sans Narrow'".'; color:#FACC2E; font-size:24px; padding:15px; border-radius:1px;">
			¿Vas a venir a la fiesta?
		</div>
		<form method="post">
			<div align="center">
				<button style="background: rgba(0,222,0,1); padding: 6px; margin: 3px; border-radius: 3px; border: none;" type="submit" name="confirmado" value="1">Sí</button>
				<button style="background: #7537ff; padding: 6px; margin: 3px; border-radius: 3px; border: none;" type="submit" name="confirmado" value="0">No</button>
				<button style="background: #e45f84; padding: 6px; margin: 3px; border-radius: 3px; border: none;" type="submit" name="confirmado" value="2">Aún no lo sé</button>
			</div>
		</form>
		</div>
	</body>
</html>
<?php
	// Cabecera
	if(isset($_POST['confirmado'])) {
		echo $_POST['confirmado'];
		// Configura los datos de tu cuenta
		include('../config.php');
		// Conectar a la base de datos
		mysql_connect ($dbhost, $dbusername, $dbuserpass);
		mysql_select_db($dbname) or die("<div align='center' style='color:#000;font-size:26px'>El servidor ha experimentado un problema al conectar con la base de datos.<br />Por favor, inténtalo de nuevo.</div>");
		$sql = 'UPDATE 2015_07_10_invitados SET confirmado = '.$_POST['confirmado'].' WHERE ususario LIKE '.$_SESSION['usuario'];
		mysql_query($sql);
	}
?>