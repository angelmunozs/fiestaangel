<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<link href='animate.css' rel='stylesheet' type='text/css'>
<link href='css/musica.css' rel='stylesheet' type='text/css'>
<title>Fiesta | Enviar música</title>
<script type="text/javascript" src="js/musica.js"></script>
<script src="js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="js/comprobacionajax.js"></script>
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
<?php
     if($_SESSION["online"] != "1"){
		 echo '
			<div id="titulo" align="center"><img src="imagenes/titulomusica.png" /></div>
			<div id="subtitulo" align="center">Por favor, inicia sesión para acceder al contenido</div>
			<form method="post" action="acciones/login_musica">
			<div id="encuesta" align="center" class="label">
			Nombre de usuario:
			</div>
			<div id="encuesta" align="center" class="field">
			<input type="text" name="form_usuario" id="form_usuario" size="30" maxlength="32" placeholder="Usuario" onkeyup="escondeMensajes()" onfocus="escondeMensajes()" />
			</div>
			<div id="username_availability_result" align="center"></div>
			<div id="encuesta" align="center" class="label">
			Password:
			</div>
			<div id="encuesta" align="center" class="field">
			<input type="password" name="form_password" id="form_password" size="30" maxlength="32" placeholder="Password" />
			</div>
			<div id="encuesta" align="center" class="enviar">
			<input type="submit" value="Log in" onclick="return compruebaCampos()" />
			</div>
			</form>	 
		 ';
	 }
	 else{
		 echo '
			<div id="titulo" align="center"><img src="imagenes/titulomusica.png" /></div>
			<div id="subtitulo" align="center">Selecciona una acción</div>
            <div align="center"><button id="accionesMusica1" class="acciones" onclick="muestraEnviarLink()">Enviar un link de YouTube</button></div>
            <div align="center"><button id="accionesMusica2" class="acciones" onclick="muestraEnviarArchivo()">Enviar un archivo de hasta 5 MB</button></div>
            <div id="mandarArchivo" style="display:none;">
			<form method="post" action="acciones/musica_archivo.php" enctype="multipart/form-data">
			<div id="encuesta" align="center" class="label">
			Rellena estos datos
			</div>
            <table align="center" width="50%">
            	<tr>
                	<td width="30%" style="padding-right:15px;" class="label" align="right">Artista</td>
                	<td width="70%" style="padding-left:15px;text-transform:capitalize;" class="field" align="left"><input id="artista" name="artista" type="text" size="30" maxlength="64" placeholder="Nombre del artista" /></td>
                </tr>
            	<tr id="errorArtista" style="display:none">
                	<td width="30%" style="padding-right:15px;" class="label" align="right">&nbsp;</td>
                	<td width="70%" style="padding-left:30px;" class="fieldError" align="left">Por favor, rellena este campo</td>
                </tr>
            	<tr>
                	<td width="30%" style="padding-right:15px;" class="label" align="right">Título</td>
                	<td width="70%" style="padding-left:15px;text-transform:capitalize;" class="field" align="left"><input id="cancion" name="cancion" type="text" size="30" maxlength="64" placeholder="Título de la canci&oacute;n" /></td>
                </tr>
            	<tr id="errorTitulo" style="display:none">
                	<td width="30%" style="padding-right:15px;" class="label" align="right">&nbsp;</td>
                	<td width="70%" style="padding-left:30px;" class="fieldError" align="left">Por favor, rellena este campo</td>
                </tr>
            </table>
			<div id="encuesta" align="center" class="label">
			Sube un archivo mp3 de hasta 5 MB
			</div>
			<div id="encuesta" align="center" class="fieldFile">
            <input type="file" name="file" id="file" />
			</div>
            <input type="hidden" name="usuariocancion" value="'.$_SESSION["usuario"].'" />
            <div id="errorArchivo" style="padding-left:30px;display:none" class="fieldError" align="center">Por favor, selecciona un archivo</div>
			<div id="encuesta" align="center" class="enviar" style="margin-bottom:10px">
			<input type="submit" name="submit" value="Enviar" id="botonUpload" onclick="return compruebaTodo1()" />
			</div>
			<div id="linkAtras" align="center"><img src="imagenes/back.png" alt="" style="vertical-align:middle" />&nbsp;&nbsp;<a onclick="escondeDivs()">Volver</a></div>
            <div id="loadingAnimation" align="center" style="visibility:hidden;font-size:24px;color:#fff;"><img src="imagenes/loading.gif" style="margin-right:20px" />Procesando...</div>
			</form>
            </div>
            <div id="mandarLink" style="display:none;">
			<form method="post" action="acciones/musica_link.php">
			<div id="encuesta" align="center" class="label">
			Rellena estos datos
			</div>
            <table align="center" width="50%">
            	<tr>
                	<td width="30%" style="padding-right:15px;" class="label" align="right">Artista</td>
                	<td width="70%" style="padding-left:15px;text-transform:capitalize;" class="field" align="left"><input id="artista2" name="artista" type="text" size="30" maxlength="64" placeholder="Nombre del artista" /></td>
                </tr>
            	<tr id="errorArtista2" style="display:none">
                	<td width="30%" style="padding-right:15px;" class="label" align="right">&nbsp;</td>
                	<td width="70%" style="padding-left:30px;" class="fieldError" align="left">Por favor, rellena este campo</td>
                </tr>
            	<tr>
                	<td width="30%" style="padding-right:15px;" class="label" align="right">Título</td>
                	<td width="70%" style="padding-left:15px;text-transform:capitalize;" class="field" align="left"><input id="cancion2" name="cancion" type="text" size="30" maxlength="64" placeholder="Título de la canci&oacute;n" /></td>
                </tr>
            	<tr id="errorTitulo2" style="display:none">
                	<td width="30%" style="padding-right:15px;" class="label" align="right">&nbsp;</td>
                	<td width="70%" style="padding-left:30px;" class="fieldError" align="left">Por favor, rellena este campo</td>
                </tr>
            </table>
			<div id="encuesta" align="center" class="label">
			Escribe el link de Youtube
			</div>
			<div id="encuesta" align="center" class="fieldFile">
            <td width="70%" style="padding-left:15px;text-transform:capitalize;" class="field" align="left"><input id="link" name="link" type="url" size="50" maxlength="256" placeholder="Link del vídeo" /></td>
			</div>
            <input type="hidden" name="usuariocancion" value="'.$_SESSION["usuario"].'" />
            <div id="errorURL" style="display:none" class="fieldError" align="center">Por favor, escribe una URL válida</div>
			<div id="encuesta" align="center" class="enviar" style="margin-bottom:10px">
			<input type="submit" name="submit" value="Enviar" id="botonUpload" onclick="return compruebaTodo2()" />
			</div>
			<div id="linkAtras" align="center"><img src="imagenes/back.png" alt="" style="vertical-align:middle" />&nbsp;&nbsp;<a onclick="escondeDivs()">Volver</a></div>
            <div id="loadingAnimation2" align="center" style="visibility:hidden;font-size:24px;color:#fff;"><img src="imagenes/loading.gif" style="margin-right:20px" />Procesando...</div>
			</form>
            </div>
			';
	 }
?>
</div>
</div>
</body>
</html>