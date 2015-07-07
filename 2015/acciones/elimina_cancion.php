<?php
session_start();
include('../config.php');
mysql_connect ($dbhost, $dbusername, $dbuserpass);
mysql_select_db($dbname) or die("El servidor ha experimentado un problema al conectar con la base de datos. Por favor, inténtalo de nuevo.");
$cancionBorrada = $_POST['cancionBorrada'];
if($_SESSION["online"] != "1"){
	echo '<script language="javascript">alert("1");window.location.href = "../admin";</script>';
}
else{
	if($_SESSION["usuario"] != "admin"){
		echo '<script language="javascript">alert("2");window.location.href = "../admin";</script>';
	}
	else{

		if(!$_POST['cancionBorrada']){
			echo'<script type="text/javascript">alert("3");window.location.href="../admin"</script>';
		}
		else{
			if(file_exists('../flashmp3player/mp3/'.$cancionBorrada)){
				$deleteQuery = "DELETE FROM 2015_07_10_canciones WHERE archivo LIKE '%".$cancionBorrada."%'";
				mysql_query($deleteQuery);
				unlink('../flashmp3player/mp3/'.$cancionBorrada);
				echo'<script type="text/javascript">window.location.href="../admin"</script>';
			}
			else{
				$deleteQuery = "DELETE FROM 2015_07_10_canciones WHERE archivo LIKE '%".$cancionBorrada."%'";
				mysql_query($deleteQuery);
				echo'<script type="text/javascript">window.location.href="../admin"</script>';
			}
		}
	}
}
?>