<?php
session_start();
if($_SESSION["online"] != "1"){
	echo '<script language="javascript">window.location.href = "../musica";</script>';
}
else{
	if(!isset($_FILES['file'])||empty($_FILES['file']['name'])){
		echo '<script language="javascript">alert("Por favor, selecciona un archivo de hasta 5 MB en formato mp3.");window.location.href = "../musica";</script>';
	}
	else{
		$allowedExts = array("mp3");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		if (((in_array($extension, $allowedExts))||($_FILES["file"]["type"] == "audio/mp3"))&& ($_FILES["file"]["size"] < 5000000)) {
			if ($_FILES["file"]["error"] > 0) {
				echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
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
				//$elartistaSEO = str_replace(' ','_',$elartista);
				//$elartistaSEO = strtolower($elartistaSEO);
				//$lacancionSEO = str_replace(' ','_',$lacancion);
				//$lacancionSEO = strtolower($lacancionSEO);
				$cancionSEO = $elartista.' - '.$lacancion.'.mp3';
				$linkNulo = "";
				if (file_exists("../flashmp3player/mp3/" . $cancionSEO)) {
					echo '<script language="javascript">alert("Este archivo ya ha sido enviado.");window.history.back();</script>';
				} 
				else {
					move_uploaded_file($_FILES["file"]["tmp_name"], "../flashmp3player/mp3/" . $cancionSEO);
					// Conecta con la base de datos
					include('../config.php');
					mysql_connect ($dbhost, $dbusername, $dbuserpass);
					mysql_select_db($dbname) or die("<div align='center' style='color:#000;font-size:26px'>El servidor ha experimentado un problema al conectar con la base de datos.<br />Por favor, inténtalo de nuevo.</div>");
					date_default_timezone_set('Europe/Madrid');
					$fecha=date('Y/m/d H:i:s');
					$insertar = "INSERT INTO 2015_07_10_canciones(usuario, artista, titulo, archivo, link, sent) VALUES ('$usuariocancion', '$elartista', '$lacancion', '$cancionSEO', '$linkNulo', '$fecha')";
					mysql_query($insertar);
					// Actualiza metadatos. NO FUNCIONA
					//$datos = array("title" => $lacancion, "artist" => $elartista, "album" => "Fiesta 19-07-14");
					//$resultado1 = id3_remove_tag( "../flashmp3player/mp3/" . $cancionSEO, ID3_V1_0 );
					//$resultado2 = id3_set_tag( "../flashmp3player/mp3/" . $cancionSEO, $datos, ID3_V1_0);
					echo '<script language="javascript">alert("Archivo enviado con exito.");window.location.href = "../musica";</script>';
				}
			}
		} 
		else{
			echo '<script language="javascript">alert("Por favor, selecciona un archivo de hasta 5 MB en formato mp3.");window.location.href = "../musica";</script>';
		}
	}
}
?>