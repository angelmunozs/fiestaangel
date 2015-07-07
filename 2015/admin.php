<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<link href='animate.css' rel='stylesheet' type='text/css'>
<link href='css/admin.css' rel='stylesheet' type='text/css'>
<title>Fiesta | Panel de administración</title>
<script src="js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="js/admin.js"></script>
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
if($_SESSION["online"]!="1"){
	echo'<div id="titulo" align="center"><img src="imagenes/tituloadmin.png" /></div>
		<div id="subtitulo" align="center">Inicia sesión para acceder al panel de administración</div>
		<form method="post" action="acciones/login_admin">
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
	if($_SESSION["usuario"]!='admin'){
		echo '<script type="text/javascript">alert("Acceso denegado");window.location.href="index";</script>';
	}
	else{
		echo '
			<div id="titulo" align="center"><img src="imagenes/tituloadmin.png" /></div>
			<div id="subtitulo" align="center">Panel de control de fiestaangel.es</div>';
			$novedades="";
			if($total>0){
				$consulta1 = mysql_query("SELECT usuario, creado FROM 2015_07_10_comentarios WHERE seenByAdmin=0 ORDER BY creado DESC");
				$consulta2 = mysql_query("SELECT usuario, sent FROM 2015_07_10_encuesta WHERE seenByAdmin=0 ORDER BY sent DESC");
				$consulta3 = mysql_query("SELECT usuario, sent FROM 2015_07_10_canciones WHERE seenByAdmin=0 ORDER BY sent DESC");
				$nuevosComments = array();
				$nuevosCommentsFecha = array();
				$nuevasEncuestas = array();
				$nuevasEncuestasFecha = array();
				$nuevasCanciones = array();
				$nuevasCancionesFecha = array();
				$lasNovedades = "";
				if(mysql_num_rows($consulta1)>0){
					while ($row = mysql_fetch_array($consulta1)) {
						array_push($nuevosComments, $row["usuario"]);
						array_push($nuevosCommentsFecha, $row["creado"]);
					}
					for($i=0; $i<count($nuevosComments);$i++){
						$lasNovedades=$lasNovedades.'<span style="color:#999;">'.$nuevosCommentsFecha[$i].'</span>&nbsp;&nbsp;&nbsp;<span style="color:#FACC2E">'.$nuevosComments[$i].'</span> ha escrito un comentario<br />';
					}
				}
				if(mysql_num_rows($consulta2)>0){
					while ($row = mysql_fetch_array($consulta2)) {
						array_push($nuevasEncuestas, $row["usuario"]);
						array_push($nuevasEncuestasFecha, $row["sent"]);
					}
					for($i=0; $i<count($nuevasEncuestas);$i++){
						$lasNovedades=$lasNovedades.'<span style="color:#999;">'.$nuevasEncuestasFecha[$i].'</span>&nbsp;&nbsp;&nbsp;<span style="color:#FACC2E">'.$nuevasEncuestas[$i].'</span> ha rellenado su encuesta<br />';
					}
				}
				if(mysql_num_rows($consulta3)>0){
					while ($row = mysql_fetch_array($consulta3)) {
						array_push($nuevasCanciones, $row["usuario"]);
						array_push($nuevasCancionesFecha, $row["sent"]);
					}
					for($i=0; $i<count($nuevasCanciones);$i++){
						$lasNovedades=$lasNovedades.'<span style="color:#999;">'.$nuevasCancionesFecha[$i].'</span>&nbsp;&nbsp;&nbsp;<span style="color:#FACC2E">'.$nuevasCanciones[$i].'</span> ha enviado una canción<br />';
					}
				}
				$novedades1='<table width="100%" cellspacing="8px" cellpadding="8px" align="center">
					<td id="tituloAccion" width="100%" align="center" style="background-color:rgba(0, 0, 0, 0.7);padding-bottom:20px;color:#fff">
						<div style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:24px;padding:8px;padding-bottom:0px;">Actividad <span style="color:#fff;font-size:15px;">('.$total.')</span></div><br />';
				$novedades2 ='</td></table>';
				echo $novedades1;
				echo $lasNovedades;
				echo $novedades2;
			}
			echo '<table width="100%" cellspacing="8px" cellpadding="8px" align="center">
				<td id="tituloAccion" width="25%" align="center" style="background-color:rgba(0, 0, 0, 0.7);">
					<form id="desactivaUsuario" name="desactivaUsuario" method="post" action="acciones/desactiva_usuario">
					<div style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:24px;padding:8px;padding-bottom:0px;">Desactivar un usuario</div><br />
					<select name="elUsuario">
					<option name="" value=""></option>';
						$consulta = mysql_query("SELECT usuario FROM 2015_07_10_invitados WHERE activo=1 AND usuario!='admin' ORDER BY usuario ASC");
						$usuariosActivos=array();
						while ($row = mysql_fetch_array($consulta)) {
							array_push($usuariosActivos, $row["usuario"]);
						}
						for($i=0;$i<mysql_num_rows($consulta);$i++){
							echo '<option name="'.$usuariosActivos[$i].'" value="'.$usuariosActivos[$i].'">'.$usuariosActivos[$i].'</option>';
						}
					echo '</select><br />
					<div align="center" style="font-size:14px; color:#777777"><i>'.mysql_num_rows($consulta).' usuarios activos</i></div>
					<input type="submit" value="Desactivar" />
					</form>
				</td>
				<td id="tituloAccion" width="25%" align="center" style="background-color:rgba(0, 0, 0, 0.7);">
					<form id="reactivaUsuario" name="reactivaUsuario" method="post" action="acciones/reactiva_usuario">
					<div style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:24px;padding:8px;padding-bottom:0px;">Reactivar un usuario</div><br />
					<select name="elUsuario">
					<option name="" value=""></option>';
						$consulta1 = mysql_query("SELECT usuario FROM 2015_07_10_invitados WHERE activo=0 AND usuario!='admin' ORDER BY usuario ASC");
						$usuariosNoActivos=array();
						while ($row = mysql_fetch_array($consulta1)) {
							array_push($usuariosNoActivos, $row["usuario"]);
						}
						for($i=0;$i<mysql_num_rows($consulta1);$i++){
							echo '<option name="'.$usuariosNoActivos[$i].'" value="'.$usuariosNoActivos[$i].'">'.$usuariosNoActivos[$i].'</option>';
						}
					echo '</select><br />
					<div align="center" style="font-size:14px; color:#777777"><i>'.mysql_num_rows($consulta1).' usuarios inactivos</i></div>
					<input type="submit" value="Reactivar" />
					</form>
				</td>';
						$consulta2 = mysql_query("SELECT usuario FROM 2015_07_10_invitados WHERE usuario!='admin' ORDER BY usuario ASC");
						$usuariosTodos=array();
						while ($row = mysql_fetch_array($consulta2)) {
							array_push($usuariosTodos, $row["usuario"]);
						}
						$queryencuestas = mysql_query("SELECT encuesta FROM 2015_07_10_invitados WHERE encuesta=1");
						$usuarioEncuestaHecha= mysql_query("SELECT usuario FROM 2015_07_10_invitados WHERE encuesta=1 AND usuario!='admin' ORDER BY usuario ASC");
						$usuariosEncuestaHecha=array();
						while ($row = mysql_fetch_array($usuarioEncuestaHecha)) {
							array_push($usuariosEncuestaHecha, $row["usuario"]);
						}
						for($i=0;$i<mysql_num_rows($usuarioEncuestaHecha);$i++){
							echo '<option name="'.$usuariosEncuestaHecha[$i].'" value="'.$usuariosEncuestaHecha[$i].'">'.$usuariosEncuestaHecha[$i].'</option>';
						}
						$cuantasencuestas = mysql_num_rows($queryencuestas);
						$queryultima = mysql_query("SELECT sent FROM 2015_07_10_encuesta ORDER BY sent DESC");
						$fechasencuesta = array();
						while ($row = mysql_fetch_array($queryultima)) {
							array_push($fechasencuesta, $row["sent"]);
						}
				echo '<td id="tituloAccion" width="25%" align="center" style="background-color:rgba(0, 0, 0, 0.7);">
					<form id="eliminaUsuario" name="eliminaUsuario" method="post" action="acciones/elimina_usuario">
					<div style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:24px;padding:8px;padding-bottom:0px;">Eliminar un usuario</div><br />
					<select name="elUsuario">
					<option name="" value=""></option>';
						for($i=0;$i<mysql_num_rows($consulta2);$i++){
							echo '<option name="'.$usuariosTodos[$i].'" value="'.$usuariosTodos[$i].'">'.$usuariosTodos[$i].'</option>';
						}
					echo '</select><br />
					<div align="center" style="font-size:14px; color:#777777"><i>'.mysql_num_rows($consulta2).' usuarios en total</i></div>
					<input onclick="return confirmarEliminarUsuario()" type="submit" value="Eliminar" />
					</form>
				</td>
				<td id="tituloAccion" width="25%" align="center" style="background-color:rgba(0, 0, 0, 0.7);" valign="top">
					<div style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:24px;padding:8px;padding-bottom:0px;margin-bottom:0px;">Contraseñas</div><br />
					<select name="consultaPass" size="4" style="font-size:16px;margin-top:0px;padding-top:0px;">';
						$consulta6 = mysql_query("SELECT password FROM 2015_07_10_invitados WHERE usuario!='admin' ORDER BY usuario ASC");
						$passwordsTodos=array();
						while ($row = mysql_fetch_array($consulta6)) {
							array_push($passwordsTodos, $row["password"]);
						}
						for($i=0;$i<mysql_num_rows($consulta2);$i++){
							echo '<optgroup label="'.$usuariosTodos[$i].'"></optgroup><option name="'.$passwordsTodos[$i].'" value="'.$passwordsTodos[$i].'">'.$passwordsTodos[$i].'</option>';
						}
					echo '</select><br />
				</td>
			</table>
			<table width="100%" cellspacing="8px" cellpadding="8px" align="center">
				<td id="tituloAccion" width="35%" align="center" style="background-color:rgba(0, 0, 0, 0.7);">
					<form id="nuevoInvitado" name="nuevoInvitado" method="post" action="acciones/nuevo_invitado">
					<div style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:24px;padding:8px;padding-bottom:0px;">Añadir un nuevo invitado</div><br />
					<div id="Nombre" class="tituloForm">Nombre</div>
					<input type="text" size="30" maxlength="64" placeholder="Nombre" name="nuevoNombre" id="nuevoNombre" style="margin-bottom:6px;" /><br />
					<div id="errorNombre" class="errorNuevo" align="center"></div>
					<div id="Apellido" class="tituloForm">Apellido</div>
					<input type="text" size="30" maxlength="64" placeholder="Apellido" name="nuevoApellido" id="nuevoApellido" style="margin-bottom:6px;" /><br />
					<div id="errorApellido" class="errorNuevo" align="center"></div>
					<div id="Password" class="tituloForm">Asignar contraseña</div>
					<input type="text" size="30" maxlength="64" placeholder="Contraseña" name="nuevoPassword" id="nuevoPassword" style="margin-bottom:6px;" /><br/>
					<div id="errorPassword" class="errorNuevo" align="center"></div>
					<br />
					<input onclick="return compruebaCamposNuevo()" type="submit" value="Añadir" />
					</form>
				</td>
				<td id="tituloAccion" width="65%" align="center" style="background-color:rgba(0, 0, 0, 0.7);" valign="top">
					<div style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:24px;padding:8px;padding-bottom:0px;">Últimos usuarios logeados
					<span style="font-size:14px;color:#aaa;font-style:italic;"> (mostrando 9 últimos)</span>
					</div>
					<table width="100%" align="center" cellspacing="2px" cellpadding="3px" valign="top" style="color:#fff;font-size:16px;margin-top:12px;">
					<tr style="background-color:rgba(0, 0, 0, 0.7);font-size:17px;">
						<td width="35%" align="center" style="color:#FACC2E"><b>Usuario</b></td>
						<td width="30%" align="center" style="color:#FACC2E">Veces que ha entrado</td>
						<td width="35%" align="center" style="color:#FACC2E"><b>Último login</b></td>
					</tr>
					';
						$consulta3 = mysql_query("SELECT usuario FROM 2015_07_10_invitados WHERE timesloggedin>0 ORDER BY lastlogin DESC");
						$consulta4 = mysql_query("SELECT lastlogin FROM 2015_07_10_invitados WHERE timesloggedin>0 ORDER BY lastlogin DESC");
						$consulta5 = mysql_query("SELECT timesloggedin FROM 2015_07_10_invitados WHERE timesloggedin>0 ORDER BY lastlogin DESC");
						$usuariosYaLogeados=array();
						$fechasDeUltimoLogin=array();
						$vecesLogeados=array();
						while ($row = mysql_fetch_array($consulta3)) {
							array_push($usuariosYaLogeados, $row["usuario"]);
						}
						while ($row = mysql_fetch_array($consulta4)) {
							array_push($fechasDeUltimoLogin, $row["lastlogin"]);
						}
						while ($row = mysql_fetch_array($consulta5)) {
							array_push($vecesLogeados, $row["timesloggedin"]);
						}
						if(count($usuariosYaLogeados)<9){
							for($i=0;$i<count($usuariosYaLogeados);$i++){
								echo '<tr style="background-color:rgba(0, 0, 0, 0.7);">';
								echo '<td width="35%" align="center">'.$usuariosYaLogeados[$i].'</td>';
								echo '<td width="30%" align="center">'.$vecesLogeados[$i].'</td>';
								echo '<td width="35%" align="center">'.$fechasDeUltimoLogin[$i].'</td>';
								echo '</tr>';
							}
						}
						else{
							for($i=0;$i<9;$i++){
								echo '<tr style="background-color:rgba(0, 0, 0, 0.7);">';
								echo '<td width="35%" align="center">'.$usuariosYaLogeados[$i].'</td>';
								echo '<td width="30%" align="center">'.$vecesLogeados[$i].'</td>';
								echo '<td width="35%" align="center">'.$fechasDeUltimoLogin[$i].'</td>';
								echo '</tr>';
							}
						}
					echo '</table>
				</td>
			</table>
			<table width="100%" cellspacing="8px" cellpadding="8px" align="center">
				<tr>
				<td id="tituloAccion" width="100%" align="center" style="background-color:rgba(0, 0, 0, 0.7);">
					<div style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:24px;padding:8px;padding-bottom:0px;">Canciones recibidas
					<span id="muestraCuantasTexto2" style="font-size:14px;color:#aaa;font-style:italic;"> (mostrando 6 últimas)</span>
					<span id="muestraTodoTexto2" style="font-size:16px;color:#FACC2E;font-weight:normal;cursor:pointer;"> <a onclick="mostrarTodosLosArchivos()">&nbsp;&nbsp;&nbsp;Mostrar todo</a></span>
					</div>
					<table width="100%" id="tablaArchivos10Ultimos" align="center" cellspacing="2px" cellpadding="3px" valign="top" style="color:#fff;font-size:16px;margin-top:12px;">
					<tr style="background-color:rgba(0, 0, 0, 0.7);font-size:17px;">
						<td width="15%" align="center" style="color:#CEF6F5">Usuario</td>
						<td width="32%" align="center" style="color:#0080FF"><b>Artista</b></td>
						<td width="32%" align="center" style="color:#0080FF"><b>Título</b></td>
						<td width="7%" align="center" style="color:#ffffff;font-size:12px;">Tamaño</td>
						<td width="7%" align="center" style="color:#ffffff;font-size:12px;">Descargar</td>
						<td width="7%" align="center" style="color:#ffffff;font-size:12px;">Eliminar</td>
					</tr>
					';
						$consulta6 = mysql_query("SELECT usuario FROM 2015_07_10_canciones WHERE link='' AND archivo!='' ORDER BY sent DESC LIMIT 6");
						$consulta7 = mysql_query("SELECT artista FROM 2015_07_10_canciones WHERE link='' AND archivo!='' ORDER BY sent DESC LIMIT 6");
						$consulta8 = mysql_query("SELECT titulo FROM 2015_07_10_canciones WHERE link='' AND archivo!='' ORDER BY sent DESC LIMIT 6");
						$consulta9 = mysql_query("SELECT archivo FROM 2015_07_10_canciones WHERE link='' AND archivo!='' ORDER BY sent DESC LIMIT 6");
						$usuariosCancion=array();
						$artistasCancion=array();
						$titulosCancion=array();
						$archivosCancion=array();
						while ($row = mysql_fetch_array($consulta6)) {
							array_push($usuariosCancion, $row["usuario"]);
						}
						while ($row = mysql_fetch_array($consulta7)) {
							array_push($artistasCancion, $row["artista"]);
						}
						while ($row = mysql_fetch_array($consulta8)) {
							array_push($titulosCancion, $row["titulo"]);
						}
						while ($row = mysql_fetch_array($consulta9)) {
							array_push($archivosCancion, $row["archivo"]);
						}
						for($i=0;$i<count($usuariosCancion);$i++){
							echo '<tr style="background-color:rgba(0, 0, 0, 0.7);">';
							echo '<td width="15%" align="center">'.$usuariosCancion[$i].'</td>';
							echo '<td width="32%" align="center">'.$artistasCancion[$i].'</td>';
							echo '<td width="32%" align="center">'.$titulosCancion[$i].'</td>';
							$pathArchivo = 'musica/'.$archivosCancion[$i];
							$tamano = filesize($pathArchivo);
							$tamanoMB = round($tamano/1000000,2);
							echo '<td width="7%" align="center" valign="middle">'.$tamanoMB.' MB</td>';
							echo '<td width="7%" align="center" valign="middle"><a href="musica/'.$archivosCancion[$i].'" target="_same"><img src="imagenes/download.png" alt="Download" /></td>';
							echo '<td width="7%" align="center" valign="middle">
							<form method="post" action="acciones/elimina_cancion">
							<input type="hidden" name="cancionBorrada" value="'.$archivosCancion[$i].'" />
							<input onclick="return confirmarDeleteCancion()" type="submit" value="" style="background: url('."'imagenes/delete.png'".');width:20px;height:20px;padding:0px;margin:0px;" />
							</form>
							</td>';
							echo '</tr>';
						}
					echo '</table>
					<table width="100%" id="tablaArchivosTodos" align="center" cellspacing="2px" cellpadding="3px" valign="top" style="display:none;color:#fff;font-size:16px;margin-top:12px;">
					<tr style="background-color:rgba(0, 0, 0, 0.7);font-size:17px;">
						<td width="15%" align="center" style="color:#CEF6F5">Usuario</td>
						<td width="32%" align="center" style="color:#0080FF"><b>Artista</b></td>
						<td width="32%" align="center" style="color:#0080FF"><b>Título</b></td>
						<td width="7%" align="center" style="color:#ffffff;font-size:12px;">Tamaño</td>
						<td width="7%" align="center" style="color:#ffffff;font-size:12px;">Descargar</td>
						<td width="7%" align="center" style="color:#ffffff;font-size:12px;">Eliminar</td>
					</tr>
					';
						$consulta6 = mysql_query("SELECT usuario FROM 2015_07_10_canciones WHERE link='' AND archivo!='' ORDER BY sent DESC");
						$consulta7 = mysql_query("SELECT artista FROM 2015_07_10_canciones WHERE link='' AND archivo!='' ORDER BY sent DESC");
						$consulta8 = mysql_query("SELECT titulo FROM 2015_07_10_canciones WHERE link='' AND archivo!='' ORDER BY sent DESC");
						$consulta9 = mysql_query("SELECT archivo FROM 2015_07_10_canciones WHERE link='' AND archivo!='' ORDER BY sent DESC");
						$usuariosCancion=array();
						$artistasCancion=array();
						$titulosCancion=array();
						$archivosCancion=array();
						while ($row = mysql_fetch_array($consulta6)) {
							array_push($usuariosCancion, $row["usuario"]);
						}
						while ($row = mysql_fetch_array($consulta7)) {
							array_push($artistasCancion, $row["artista"]);
						}
						while ($row = mysql_fetch_array($consulta8)) {
							array_push($titulosCancion, $row["titulo"]);
						}
						while ($row = mysql_fetch_array($consulta9)) {
							array_push($archivosCancion, $row["archivo"]);
						}
						for($i=0;$i<count($usuariosCancion);$i++){
							echo '<tr style="background-color:rgba(0, 0, 0, 0.7);">';
							echo '<td width="15%" align="center">'.$usuariosCancion[$i].'</td>';
							echo '<td width="32%" align="center">'.$artistasCancion[$i].'</td>';
							echo '<td width="32%" align="center">'.$titulosCancion[$i].'</td>';
							$pathArchivo = 'musica/'.$archivosCancion[$i];
							$tamano = filesize($pathArchivo);
							$tamanoMB = round($tamano/1000000,2);
							echo '<td width="7%" align="center" valign="middle">'.$tamanoMB.' MB</td>';
							echo '<td width="7%" align="center" valign="middle"><a href="musica/'.$archivosCancion[$i].'" target="_same"><img src="imagenes/download.png" alt="Download" /></td>';
							echo '<td width="7%" align="center" valign="middle">
							<form method="post" action="acciones/elimina_cancion">
							<input type="hidden" name="cancionBorrada" value="'.$archivosCancion[$i].'" />
							<input onclick="return confirmarDeleteCancion()" type="submit" value="" style="background: url('."'imagenes/delete.png'".');width:20px;height:20px;padding:0px;margin:0px;" />
							</form>
							</td>';
							echo '</tr>';
						}
					echo '</table>
					</td>
				</tr>
				<tr>
				<td id="tituloAccion" width="100%" align="center" style="background-color:rgba(0, 0, 0, 0.7);">
					<div style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:24px;padding:8px;padding-bottom:0px;">Canciones recomendadas
					<span id="muestraCuantasTexto1" style="font-size:14px;color:#aaa;font-style:italic;"> (mostrando 6 últimas)</span>
					<span id="muestraTodoTexto1" style="font-size:16px;color:#FACC2E;font-weight:normal;cursor:pointer;"> <a onclick="mostrarTodasLasCanciones()">&nbsp;&nbsp;&nbsp;Mostrar todo</a></span>
					</div>
					<table width="100%" id="tabla2015_07_10_canciones0Ultimas" align="center" cellspacing="2px" cellpadding="3px" valign="top" style="color:#fff;font-size:16px;margin-top:12px;">
					<tr style="background-color:rgba(0, 0, 0, 0.7);font-size:17px;">
						<td width="20%" align="center" style="color:#CEF6F5">Usuario</td>
						<td width="35%" align="center" style="color:#0080FF"><b>Artista</b></td>
						<td width="35%" align="center" style="color:#0080FF"><b>Título</b></td>
						<td width="10%" align="center" style="color:#ffffff;font-size:12px;">Link</td>
					</tr>
					';
						$consulta6 = mysql_query("SELECT usuario FROM 2015_07_10_canciones WHERE archivo='' AND link!='' ORDER BY sent DESC LIMIT 6");
						$consulta7 = mysql_query("SELECT artista FROM 2015_07_10_canciones WHERE archivo='' AND link!='' ORDER BY sent DESC LIMIT 6");
						$consulta8 = mysql_query("SELECT titulo FROM 2015_07_10_canciones WHERE archivo='' AND link!='' ORDER BY sent DESC LIMIT 6");
						$consulta9 = mysql_query("SELECT link FROM 2015_07_10_canciones WHERE archivo='' AND link!='' ORDER BY sent DESC LIMIT 6");
						$usuariosCancion=array();
						$artistasCancion=array();
						$titulosCancion=array();
						$linksCancion=array();
						while ($row = mysql_fetch_array($consulta6)) {
							array_push($usuariosCancion, $row["usuario"]);
						}
						while ($row = mysql_fetch_array($consulta7)) {
							array_push($artistasCancion, $row["artista"]);
						}
						while ($row = mysql_fetch_array($consulta8)) {
							array_push($titulosCancion, $row["titulo"]);
						}
						while ($row = mysql_fetch_array($consulta9)) {
							array_push($linksCancion, $row["link"]);
						}
						for($i=0;$i<count($usuariosCancion);$i++){
							echo '<tr style="background-color:rgba(0, 0, 0, 0.7);">';
							echo '<td width="20%" align="center">'.$usuariosCancion[$i].'</td>';
							echo '<td width="35%" align="center">'.$artistasCancion[$i].'</td>';
							echo '<td width="35%" align="center">'.$titulosCancion[$i].'</td>';
							echo '<td width="10%" align="center" valign="middle"><a href="'.$linksCancion[$i].'" target="_blank"><img src="imagenes/youtube.png" alt="Download" /></td>';
							echo '</tr>';
						}
					echo '</table>
					<table width="100%" id="tablaCancionesTodas" align="center" cellspacing="2px" cellpadding="3px" valign="top" style="color:#fff;font-size:16px;margin-top:12px;display:none">
					<tr style="background-color:rgba(0, 0, 0, 0.7);font-size:17px;">
						<td width="20%" align="center" style="color:#CEF6F5">Usuario</td>
						<td width="35%" align="center" style="color:#0080FF"><b>Artista</b></td>
						<td width="35%" align="center" style="color:#0080FF"><b>Título</b></td>
						<td width="10%" align="center" style="color:#ffffff;font-size:12px;">Link</td>
					</tr>
					';
						$consulta6 = mysql_query("SELECT usuario FROM 2015_07_10_canciones WHERE archivo='' AND link!='' ORDER BY sent DESC");
						$consulta7 = mysql_query("SELECT artista FROM 2015_07_10_canciones WHERE archivo='' AND link!='' ORDER BY sent DESC");
						$consulta8 = mysql_query("SELECT titulo FROM 2015_07_10_canciones WHERE archivo='' AND link!='' ORDER BY sent DESC");
						$consulta9 = mysql_query("SELECT link FROM 2015_07_10_canciones WHERE archivo='' AND link!='' ORDER BY sent DESC");
						$usuariosCancion=array();
						$artistasCancion=array();
						$titulosCancion=array();
						$linksCancion=array();
						while ($row = mysql_fetch_array($consulta6)) {
							array_push($usuariosCancion, $row["usuario"]);
						}
						while ($row = mysql_fetch_array($consulta7)) {
							array_push($artistasCancion, $row["artista"]);
						}
						while ($row = mysql_fetch_array($consulta8)) {
							array_push($titulosCancion, $row["titulo"]);
						}
						while ($row = mysql_fetch_array($consulta9)) {
							array_push($linksCancion, $row["link"]);
						}
						for($i=0;$i<count($usuariosCancion);$i++){
							echo '<tr style="background-color:rgba(0, 0, 0, 0.7);">';
							echo '<td width="20%" align="center">'.$usuariosCancion[$i].'</td>';
							echo '<td width="35%" align="center">'.$artistasCancion[$i].'</td>';
							echo '<td width="35%" align="center">'.$titulosCancion[$i].'</td>';
							echo '<td width="10%" align="center" valign="middle"><a href="'.$linksCancion[$i].'" target="_blank"><img src="imagenes/youtube.png" alt="Download" /></td>';
							echo '</tr>';
						}
					echo '</table>
				</td>
				</tr>
			</table>
			<div align="center" style="margin-top:10px;"><a href="http://sql29.hostinger.es/phpmyadmin/index.php?db=u504203516_uno&token=55ca0b53496d84e9c655fa26d4d24bfd" target="_blank"><img src="imagenes/phpmyadmin.png" alt="" /></a></div>
			<div align="center" style="margin-top:10px;font-size:14px;color:#aaa;font-style:italic;">Usuario:&nbsp;&nbsp;&nbsp;<span style="color:#fff;font-style:normal;">u504203516_admin</span></div>
			<div align="center" style="margin-top:1px;font-size:14px;color:#aaa;font-style:italic;">Contraseña:&nbsp;&nbsp;&nbsp;<span style="color:#fff;font-style:normal;">disQbo3oKqHJWdF7e5</span></div>
		';
		if($total>0){
			mysql_query("UPDATE 2015_07_10_encuesta SET seenByAdmin=1 WHERE seenByAdmin=0");
			mysql_query("UPDATE 2015_07_10_canciones SET seenByAdmin=1 WHERE seenByAdmin=0");
			mysql_query("UPDATE 2015_07_10_comentarios SET seenByAdmin=1 WHERE seenByAdmin=0");
		}
	}
}
?>
</div>
</div>
</body>
</html>
