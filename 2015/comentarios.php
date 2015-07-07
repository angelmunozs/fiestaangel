<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<link href='animate.css' rel='stylesheet' type='text/css'>
<link href='css/comentarios.css' rel='stylesheet' type='text/css'>
<title>Fiesta | Comentarios</title>
</head>
<script type="text/javascript" src="js/ajustabody.js"></script>
<!-- Loader -->
<script type="text/javascript">
window.onload = function (){
		document.getElementById('loader').style.display="none";
		document.getElementById('cuerpo').className="option animated fadeIn";
		document.getElementById('cuerpo').style.display="block";
}
</script>
<div id="loader" style="width:100px; height:100px; position: absolute; top:0; bottom: 0; left: 0; right: 0; margin: auto;">
<img src="imagenes/loader_big.gif" />
</div>
<!-- End loader -->
<div style="display:none;"><img src="imagenes/loading.gif" /></div>
<div style="display:none;"><img src="imagenes/right.gif" /></div>
<div style="display:none;"><img src="imagenes/wrong.gif" /></div>
<div id="superior" align="center">
<script type="text/javascript" src="js/ajustasuperior.js"></script>
        <tr>
            <td align="left" width="67px" id="tdsuperior" ><a id="tdsuperiorlink1" href="index">Inicio</a></td>
            <td align="left" width="120px" id="tdsuperior" ><a id="tdsuperiorlink3" href="info">Información</a></td>
            <td align="left" width="150px" id="tdsuperior" ><a id="tdsuperiorlink5" href="musica">Envíame música</a></td>
            <td align="left" width="200px" id="tdsuperior" ><a id="tdsuperiorlink6" href="comentarios">Comentarios</a></td>
<?php
     session_start();
		include('config.php');
		mysql_connect ($dbhost, $dbusername, $dbuserpass);
		mysql_select_db($dbname) or die("El servidor ha experimentado un problema al conectar con la base de datos. Por favor, inténtalo de nuevo.");
?>
<?php
	$buscanombre = mysql_query("SELECT * FROM 2015_07_10_invitados WHERE usuario = '".$_SESSION['usuario']."'") or die(mysql_error());
	$fila = mysql_fetch_array($buscanombre);
	$nombreusuario = $fila['nombre'];
     if($_SESSION["online"] != "1"){ echo '<td align="right"  id="tdsuperior" ><a id="tdsuperiorlink4" href="login">Log in</a></td>';}
	 else{
		 if($_SESSION["usuario"]=="admin"){
			 $notificaciones1 = mysql_query("SELECT * FROM 2015_07_10_encuesta WHERE seenByAdmin=0");
			 $notificaciones2 = mysql_query("SELECT * FROM 2015_07_10_canciones WHERE seenByAdmin=0");
			 $notificaciones3 = mysql_query("SELECT * FROM 2015_07_10_comentarios WHERE seenByAdmin=0");
			 $total = mysql_num_rows($notificaciones1)+mysql_num_rows($notificaciones2)+mysql_num_rows($notificaciones3);
			 $campanita = "<img src='imagenes/disabledBell.png' style='vertical-align:middle;' />";
			 $muestraTotal = "";
			 if($total>0){
				 $campanita="<img src='imagenes/activeBell.png' style='vertical-align:middle;' />";
				 $muestraTotal='<span style="color:#DF3A01;font-size:15px;">('.$total.')</span>';
			 }
			echo '<td align="right"  id="tdsuperior" >Hola, <span style="color:#FACC2E"><a href="admin" style="color:#FACC2E">'.$nombreusuario.'</a></span>&nbsp;&nbsp;'.$campanita.$muestraTotal.'</td><td align="right"  id="tdsuperior" width="80px" ><a id="tdsuperiorlink4" href="acciones/logout_action">Log out</a></td>';
		 }
		 else{
			echo '<td align="right"  id="tdsuperior" >Hola, <span style="color:#FACC2E">'.$nombreusuario.'</span></td><td align="right"  id="tdsuperior" width="80px" ><a id="tdsuperiorlink4" href="acciones/logout_action">Log out</a></td>';
		 }
	}
?>            
        </tr>
    </table>
</div>
<script type="text/javascript" src="js/ajustacuerpo.js"></script>
<div id="titulo" align="center"><img src="imagenes/titulocomentarios.png" /></div>
<div id="subtitulo" align="center">Últimos comentarios sobre la fiesta</div>
<?php
$queryids = mysql_query("SELECT id FROM 2015_07_10_comentarios WHERE deleted=0 ORDER BY creado DESC");
$queryautores = mysql_query("SELECT usuario FROM 2015_07_10_comentarios WHERE deleted=0 ORDER BY creado DESC");
$querycomentarios = mysql_query("SELECT comentario FROM 2015_07_10_comentarios WHERE deleted=0 ORDER BY creado DESC");
$queryfechas = mysql_query("SELECT creado FROM 2015_07_10_comentarios WHERE deleted=0 ORDER BY creado DESC");
$querypadres = mysql_query("SELECT parent FROM 2015_07_10_comentarios WHERE deleted=0 ORDER BY creado DESC");
$querynombres = mysql_query("SELECT 2015_07_10_invitados.nombre AS nombre FROM 2015_07_10_invitados JOIN 2015_07_10_comentarios ON 2015_07_10_invitados.usuario = 2015_07_10_comentarios.usuario ORDER BY 2015_07_10_comentarios.creado DESC");
// Ids
$ids = array();
while ($row = mysql_fetch_array($queryids)) {
	array_push($ids, $row["id"]);
}
// Nombres
$nombres = array();
while ($row = mysql_fetch_array($querynombres)) {
	array_push($nombres, $row["nombre"]);
}
// Autores
$autores = array();
while ($row = mysql_fetch_array($queryautores)) {
	array_push($autores, $row["usuario"]);
}
// Comentarios
$comentarios = array();
while ($row = mysql_fetch_array($querycomentarios)) {
	array_push($comentarios, $row["comentario"]);
}
// Fechas de creación
$fechas = array();
while ($row = mysql_fetch_array($queryfechas)) {
	array_push($fechas, $row["creado"]);
}
// Parent
$padres = array();
while ($row = mysql_fetch_array($querypadres)) {
	array_push($padres, $row["parent"]);
}
if(mysql_num_rows($queryids)<1){
	echo '<div align="center" id="subtitulo" style="color:#777;font-size;25px;font-style:normal">Aún no se han publicado comentarios</div>';
}
else{
	for($j=0;$j<mysql_num_rows($querycomentarios);$j++){
		$respondeA="";
		if($padres[$j]!=0){
			$aQuienResponde = mysql_query("SELECT usuario FROM 2015_07_10_comentarios WHERE id='".$padres[$j]."'");
			$respondidos = array();
			while ($row = mysql_fetch_array($aQuienResponde)) {
				array_push($respondidos, $row["usuario"]);
			}
			$respondeA = '<i style="color:#aaa">, en respuesta a </i>'.$respondidos[0];
		}
		echo '<table cellpadding="6px" cellspacing="0px" width="80%" align="center" style="color:#fff;margin-bottom:15px;">';
		echo '	<tr style="background-color:rgba(0,0,0,0.8);">';
		echo '		<td width="90%" align="left" style="padding-left:25px;padding-right:25px;"><i style="color:#aaa">Comentario por</i>&nbsp;&nbsp;<span style="color:#FACC2E">'.$nombres[$j].'</span>&nbsp;&nbsp;<i style="color:#aaa">el</i>&nbsp;&nbsp;'.substr($fechas[$j],0,10).'&nbsp;&nbsp;<i style="color:#aaa">a las</i>&nbsp;&nbsp;'.substr($fechas[$j],10,18).$respondeA;
		if(($autores[$j]==$_SESSION['usuario'])||($_SESSION['usuario']=="admin")){
			echo '		<form method="post"><input type="hidden" name="laId" value="'.$ids[$j].'" />';
			echo '		<td width="10%" align="center" style="font-size:18px;" class="sinestilo"><input type="submit" name="borrarComment" value="Borrar" /></td></form>';
		}
		else{
			echo '		<td width="10%" align="center" style="font-size:18px;">&nbsp;</td>';
		}
		echo '		</td>';
		echo '	</tr>';
		echo '	<tr style="background-color:rgba(0,0,0,0.4);">';
		echo '		<td width="90%" align="left" style="font-size:18px;padding-left:25px;padding-bottom:15px;font-family:'."'Open Sans Condensed'".'">'.$comentarios[$j].'</td>';
		echo '		<td width="10%" align="center" style="font-size:18px;">&nbsp;</td>';
		echo '	</tr>';
		echo '</table>';
	}
}
?>
<?php
if($_SESSION["online"] == "1"){
	echo '<div id="titularComment" align="center" style="margin-top:20px;margin-bottom:13px;">Escribe un comentario </div>';
	echo '<form name="nuevocomment" method="post">';
	echo '<div class="comentario" align="center"><textarea id="comentario" name="comentario" cols="80" rows="3"></textarea></div><div align="center" style="margin-left:10px;color:#888;font-size:14px;text-transform:uppercase;font-style:normal">Nota: puedes usar código HTML</div>';
	echo '<div class="comentario" align="center"><input type="submit" name="submit" value="Comentar" /></div>';
	echo '</form>';
}
if(isset($_POST['submit'])){
	if(!$_POST['comentario']){
		echo '<div align="center" style="color:#ddd;margin-top:10px;">¡No puedes publicar un comentario vacío!</div>';
	}
	else{
		$nuevo_usuario = $_SESSION["usuario"];
		$nuevo_comentario = $_POST['comentario'];
		date_default_timezone_set('Europe/Madrid');
		$nuevo_creado=date('Y/m/d H:i:s');
		$nuevo_parent = 0;
		$querynuevocomment = "INSERT INTO 2015_07_10_comentarios (usuario, comentario, creado, parent) VALUES ('".$nuevo_usuario."', '".$nuevo_comentario."', '".$nuevo_creado."', '".$nuevo_parent."')";
		mysql_query($querynuevocomment);
		echo '<script>window.location.href="comentarios"</script>';
	}
}
if(isset($_POST['borrarComment'])){
	if(!$_POST['laId']){
	}
	else{
		$antiguo_comment = $_POST['laId'];
		$queryborrarcomment = "UPDATE 2015_07_10_comentarios SET deleted=1 WHERE id='$antiguo_comment'";
		mysql_query($queryborrarcomment);
		echo '<script>location.reload();</script>';
	}
}
?>
</div>
</div>
</body>
</html>