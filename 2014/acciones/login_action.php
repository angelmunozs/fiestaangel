<?
// Configura los datos de tu cuenta
include('../config.php');
session_start();
// Conectar a la base de datos
mysql_connect ($dbhost, $dbusername, $dbuserpass);
mysql_select_db($dbname) or die("El servidor ha experimentado un problema al conectar con la base de datos. Por favor, inténtalo de nuevo.");

if (!$_POST['form_usuario']) {
	echo "<script language='javascript'>window.location.href = '../login';</script>";
}
else{
	// Comprobacion del envio del nombre de usuario y password
	$usuario=$_POST['form_usuario'];
	$password=$_POST['form_password'];
		if ($password==NULL) {      
		}
		else{
			$query = mysql_query("SELECT usuario, password FROM 2014_07_19_invitados WHERE usuario = '$usuario'") or die(mysql_error());
			$data = mysql_fetch_array($query);
			if($data['password'] != $password) {
				echo "<script language='javascript'>alert('Usuario o password incorrecto');window.location.href = '../login';</script>";
			}
			else{
				$query1 = mysql_query("SELECT activo FROM 2014_07_19_invitados WHERE usuario = '$usuario'") or die(mysql_error());
				$data1 = mysql_fetch_array($query1);
				if($data1['activo'] != 1){
					echo "<script language='javascript'>alert('Tu cuenta se encuentra desactivada');window.location.href = '../login';</script>";
				}
				else{
					$query = mysql_query("SELECT usuario, password FROM 2014_07_19_invitados WHERE usuario = '$usuario'") or die(mysql_error());
					$row = mysql_fetch_array($query);
					$_SESSION["id"] = $row['id'];
					$_SESSION["online"] = "1";
					$_SESSION['usuario']=$_REQUEST['usuario'];
					// Actualiza las veces que se ha hecho login
					$timesloggedin = "UPDATE 2014_07_19_invitados SET timesloggedin=timesloggedin+1 WHERE usuario = '$usuario'";
					mysql_query($timesloggedin);
					// Actualiza la fecha del último login
					date_default_timezone_set('Europe/Madrid');
					$fecha=date('Y/m/d H:i:s');
					$lastlogin = "UPDATE 2014_07_19_invitados SET lastlogin='$fecha' WHERE usuario = '$usuario'";
					mysql_query($lastlogin);
					// Redirige
					echo "<script language='javascript'>window.location.href = '../index';</script>";
				}
			}
		}
}
?> 