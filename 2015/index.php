<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
	<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Quicksand:300' rel='stylesheet' type='text/css'>
	<link href='css/index.css' rel='stylesheet' type='text/css'>
	<link href="jplayer/dist/skin/blue.monday/css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css" />
	<link href='animate.css' rel='stylesheet' type='text/css'>
	<link href='css/thickbox.css' rel='stylesheet' type='text/css'>

	<title>Fiesta | Home</title>

	<script src="js/jquery1.4.4.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="js/asistencia.js"></script>
	<script language="javascript" type="text/javascript" src="flashmp3player/swfobject.js" ></script>
	<script language="javascript" type="text/javascript" src="js/thickbox-compressed.js" ></script>  

	<script src="countdown/countdown.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		$(function(){
		        $(".digits1").countdown({
		          image: "countdown/digits.png",
		          format: "dd:hh:mm:ss",
		          endTime: new Date("July 10, 2015 23:30:00")
		        });
		      });
	</script>
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

<div class="hidden-xs hidden-sm hidden-md">
	<div class="titulo-linea-1" style="width: 100%; position: absolute; margin-top: -20px; font-size: 7em; text-align: center; font-family: Quicksand">
		FIESTA
	</div>
	<div class="titulo-linea-2" style="width: 100%; position: absolute; margin-top: 70px; font-size: 6em; text-align: center; font-family: Quicksand">
		VERANO
	</div>
	<div class="titulo-linea-3" style="width: 100%; position: absolute; margin-top: 130px; font-size: 9em; text-align: center; font-family: Quicksand">
		2015
	</div>

	<div id="titluar-imagen">
		<img src="imagenes/titular_transparente.png" style="width: 100%; height: auto" alt="Fiesta 10 de julio de 2015">
	</div>

	<div id="digits1" align="center" style="width: 100%; position: absolute; margin-top: -90px">
		<div align="center" style="margin-bottom: 10px">
			<img src="countdown/dhms.png"/>
		</div>
		<div align="center">
		        <div class="wrapper">
		          <div class="cell">
		            <div id="holder">
		              <div class="digits1"></div>
		            </div>
		          </div>
		        </div>
		</div>
	</div>

	<?php
	// Devuelve los últimos usuarios que han enviado canciones
	$usuariosQueHanEnviado = "SELECT DISTINCT(i.nombre), i.apellido FROM 2015_07_10_invitados i JOIN 2015_07_10_canciones c ON c.usuario = i.usuario WHERE  c.usuario NOT LIKE 'admin' ORDER BY c.sent DESC LIMIT 4";
	$losQueHanEnviado = mysql_query($usuariosQueHanEnviado);
	$todosLosQueHanEnviado = array();
	while ($row = mysql_fetch_array($losQueHanEnviado)) {
		array_push($todosLosQueHanEnviado, $row["nombre"].' '.$row["apellido"]);
	}
	?>

	<div style="height: 70px; background: #000"></div>

	<table width="100%" cellpadding="0px" cellspacing="0px" style="margin-top: 1%">
		<tr>
			<td class="label" align="center" width="35%" valign="top">        
			    <div align="center" style="padding:18px;padding-top:8px;margin-top:0px;"><div style="color:#fff; font-size:24px; padding-bottom:6px; border-radius:1px;">
			    	Canciones recibidas
			    </div>

	            <!-- Div that contains player. -->
	            <div id="player">
		            <h1 style="color:#fff;font-size:19px;">¡No has instalado flash player!</h1>
		            <p style="color:#fff;font-size:17px;">Sin haber instalado flash player, no puedes visualizar el reproductor. Clic<a href="http://www.macromedia.com/go/getflashplayer" > aquí </a> para descargarlo desde la página de Macromedia.</p>
	            </div>
	            <!-- Script that embeds player. -->
	            <script language="javascript" type="text/javascript">
					var flashvars = {};
					var params = { wmode: "opaque" };
					var attributes = {};
					var so = new SWFObject("flashmp3player/flashmp3player.swf", "player", "100%", "300px", "9"); // Location of swf file. You can change player width and height here (using pixels or percents).
		            so.addParam("quality","high");
		            so.addVariable("content_path","mp3"); // Location of a folder with mp3 files (relative to php script).
		            so.addVariable("color_path","flashmp3player/default.xml"); // Location of xml file with color settings.
		            so.addVariable("script_path","flashmp3player/flashmp3player.php"); // Location of php script.ç
		            so.addParam("wmode", "opaque");
		            so.write("player");
	            </script>

			    <div style="color:#fff; font-size:22px;margin-top:15px;font-family:'PT Sans Narrow';">Últimos <?php echo mysql_num_rows($losQueHanEnviado); ?> usuarios que han enviado canciones:</div>
			    <div style="color:#aaa; font-size:15px;">
				<?php  
				for($i=0;$i<mysql_num_rows($losQueHanEnviado)-1;$i++){
					echo $todosLosQueHanEnviado[$i].', ';
				}
				$cuantos = mysql_num_rows($losQueHanEnviado)-1;
				echo $todosLosQueHanEnviado[$cuantos];
				?>
			    </div>
			    </div>
			</td>
			<?php
				$consulta5 = mysql_query("SELECT nombre, apellido FROM 2015_07_10_invitados WHERE confirmado = 1 AND usuario NOT LIKE 'admin' ORDER BY lastlogin DESC LIMIT 6");
				$consulta6 = mysql_query("SELECT nombre, apellido FROM 2015_07_10_invitados WHERE confirmado = 2 AND usuario NOT LIKE 'admin' ORDER BY lastlogin DESC LIMIT 6");
				$usuariosYaConfirmados=array();
				$usuariosQueNoSaben=array();
				while ($row = mysql_fetch_array($consulta5)) {
					array_push($usuariosYaConfirmados, $row["nombre"].' '.$row["apellido"]);
				}
				while ($row = mysql_fetch_array($consulta6)) {
					array_push($usuariosQueNoSaben, $row["nombre"].' '.$row["apellido"]);
				}
			?>
			<td width="1%"></td>
			<td class="label" align="center" width="28%" valign="top">
				<div style="color:#fff;font-family:'PT Sans Narrow';font-size:24px;padding:8px;padding-bottom:0px;">Asistentes confirmados <span style="color:#aaa;font-size:12px;font-style:italic">(mostrando <?php echo mysql_num_rows($consulta5); ?> últimos)</span></div>
				<table width="92%" align="center" cellspacing="2px" cellpadding="2px" valign="top" style="color:#fff;font-size:16px;margin-top:12px;margin-bottom:15px;">
					<?php
						for($i=0;$i<mysql_num_rows($consulta5);$i++){
							echo '<tr style="background-color:rgba(0, 0, 0, 0.7);">';
							echo '<td width="50%" align="center">'.$usuariosYaConfirmados[$i].'</td>';
							echo '</tr>';
						}
					?>
			     </table>
				<div align="center">
					<a style="font-size:14px; font-family:'Open Sans Condensed'; color:#FACC2E;text-decoration:none;margin-bottom:10px" href="ajax/invitados.php?height=300&width=500" class="thickbox" title="Asistentes confirmados">
						Ver la lista comlpeta
					</a>
				</div>
				
				<div style="color:#fff;font-family:'PT Sans Narrow';font-size:24px;padding:8px;padding-bottom:0px;">Todavía no saben <span style="color:#aaa;font-size:12px;font-style:italic">(mostrando <?php echo mysql_num_rows($consulta6); ?> últimos)</span></div>
				
				<table width="92%" align="center" cellspacing="2px" cellpadding="2px" valign="top" style="color:#fff;font-size:16px;margin-top:12px;margin-bottom:15px;">
					<?php
						for($i=0;$i<mysql_num_rows($consulta6);$i++){
							echo '<tr style="background-color:rgba(0, 0, 0, 0.7);">';
							echo '<td width="50%" align="center">'.$usuariosQueNoSaben[$i].'</td>';
							echo '</tr>';
						}
					?>
			     </table>
			</td>
			<?php
				$consulta3 = mysql_query("SELECT nombre, apellido FROM 2015_07_10_invitados WHERE timesloggedin>0 AND usuario!='admin' AND usuario NOT LIKE '%prueba%' ORDER BY lastlogin DESC LIMIT 15");
				$consulta4 = mysql_query("SELECT lastlogin FROM 2015_07_10_invitados WHERE timesloggedin>0 AND usuario!='admin' AND usuario NOT LIKE '%prueba%' ORDER BY lastlogin DESC LIMIT 15");
				$usuariosYaLogeados=array();
				$fechasDeUltimoLogin=array();
				while ($row = mysql_fetch_array($consulta3)) {
					array_push($usuariosYaLogeados, $row["nombre"].' '.$row["apellido"]);
				}
				while ($row = mysql_fetch_array($consulta4)) {
					array_push($fechasDeUltimoLogin, $row["lastlogin"]);
				}
			?>
			<td width="1%"></td>
			<td class="label" align="center" width="35%" valign="top">
				<div style="color:#fff;font-family:'PT Sans Narrow';font-size:24px;padding:8px;padding-bottom:0px;">Últimos usuarios logeados <span style="color:#aaa;font-size:12px;font-style:italic">(mostrando <?php echo mysql_num_rows($consulta3); ?> últimos)</span></div>
				<table width="92%" align="center" cellspacing="2px" cellpadding="2px" valign="top" style="color:#fff;font-size:16px;margin-top:12px;margin-bottom:15px;">
			        <tr style="background-color:rgba(0, 0, 0, 0.7);font-size:16px;">
			            <td width="50%" align="center" style="color:#FACC2E"><b>Usuario</b></td>
			            <td width="50%" align="center" style="color:#FACC2E"><b>Último login</b></td>
			        </tr>
					<?php
						for($i=0;$i<mysql_num_rows($consulta3);$i++){
							echo '<tr style="background-color:rgba(0, 0, 0, 0.7);">';
							echo '<td width="50%" align="center">'.$usuariosYaLogeados[$i].'</td>';
							echo '<td width="50%" align="center">'.$fechasDeUltimoLogin[$i].'</td>';
							echo '</tr>';
						}
					?>
			     </table>
			</td>
		</tr>      
	</table>

</div>
<div class="hidden-lg">
	<div class="titulo-linea-1" style="width: 100%; position: absolute; margin-top: -20px; font-size: 7em; text-align: center; font-family: Quicksand">
		FIESTA
	</div>
	<div class="titulo-linea-2" style="width: 100%; position: absolute; margin-top: 70px; font-size: 6em; text-align: center; font-family: Quicksand">
		VERANO
	</div>
	<div class="titulo-linea-3" style="width: 100%; position: absolute; margin-top: 130px; font-size: 9em; text-align: center; font-family: Quicksand">
		2015
	</div>

	<div id="titluar-imagen">
		<img src="imagenes/titular_transparente_sm.png" style="width: 100%; height: auto" alt="Fiesta 10 de julio de 2015">
	</div>

	<div id="digits2" align="center" style="width: 100%; position: absolute; margin-top: -150px">
		<div align="center" style="margin-bottom: 10px">
			<img src="countdown/dhms.png"/>
		</div>
		<div align="center">
		        <div class="wrapper">
		          <div class="cell">
		            <div id="holder">
		              <div class="digits2"></div>
		            </div>
		          </div>
		        </div>
		</div>
	</div>

	<table width="100%" cellpadding="0px" cellspacing="0px" style="margin-top: 1%">
		<tr>
			<td class="label" align="center" width="100%" valign="top">
				<div style="color:#fff;font-family:'PT Sans Narrow';font-size:24px;padding:8px;padding-bottom:0px;">Últimos usuarios logeados <span style="color:#aaa;font-size:12px;font-style:italic">(mostrando <?php echo mysql_num_rows($consulta3); ?> últimos)</span></div>
				<table width="92%" align="center" cellspacing="2px" cellpadding="2px" valign="top" style="color:#fff;font-size:16px;margin-top:12px;margin-bottom:15px;">
			        <tr style="background-color:rgba(0, 0, 0, 0.7);font-size:16px;">
			            <td width="50%" align="center" style="color:#FACC2E"><b>Usuario</b></td>
			            <td width="50%" align="center" style="color:#FACC2E"><b>Último login</b></td>
			        </tr>
					<?php
						for($i=0;$i<mysql_num_rows($consulta3);$i++){
							echo '<tr style="background-color:rgba(0, 0, 0, 0.7);">';
							echo '<td width="50%" align="center">'.$usuariosYaLogeados[$i].'</td>';
							echo '<td width="50%" align="center">'.$fechasDeUltimoLogin[$i].'</td>';
							echo '</tr>';
						}
					?>
			     </table>
			</td>
		</tr>      
	</table>
	<table width="100%" cellpadding="0px" cellspacing="0px" style="margin-top: 1%">
		<tr>
			<td class="label" align="center" width="28%" valign="top">
				<div style="color:#fff;font-family:'PT Sans Narrow';font-size:24px;padding:8px;padding-bottom:0px;">Asistentes confirmados <span style="color:#aaa;font-size:12px;font-style:italic">(mostrando <?php echo mysql_num_rows($consulta5); ?> últimos)</span></div>
				<table width="92%" align="center" cellspacing="2px" cellpadding="2px" valign="top" style="color:#fff;font-size:16px;margin-top:12px;margin-bottom:15px;">
					<?php
						for($i=0;$i<mysql_num_rows($consulta5);$i++){
							echo '<tr style="background-color:rgba(0, 0, 0, 0.7);">';
							echo '<td width="50%" align="center">'.$usuariosYaConfirmados[$i].'</td>';
							echo '</tr>';
						}
					?>
			     </table>
				<div style="color:#fff;font-family:'PT Sans Narrow';font-size:24px;padding:8px;padding-bottom:0px;">Todavía no saben <span style="color:#aaa;font-size:12px;font-style:italic">(mostrando <?php echo mysql_num_rows($consulta6); ?> últimos)</span></div>
				<table width="92%" align="center" cellspacing="2px" cellpadding="2px" valign="top" style="color:#fff;font-size:16px;margin-top:12px;margin-bottom:15px;">
					<?php
						for($i=0;$i<mysql_num_rows($consulta6);$i++){
							echo '<tr style="background-color:rgba(0, 0, 0, 0.7);">';
							echo '<td width="50%" align="center">'.$usuariosQueNoSaben[$i].'</td>';
							echo '</tr>';
						}
					?>
			     </table>
			</td>
		</tr>
	</table>

</div>
        
</div>
</div>

<div id="confirma-asistencia" style="display: none; width: 100%; height: 100%; position:fixed; top: 0; bottom: 0; left: 0; right: 0">
	<div align="center" style="margin-top: 300px; z-index: 100; background-color: rgba(0,0,0,0.95); border: 1px solid #eee; color: #fff; padding: 120px; margin-left: 30%; margin-right: 30%;">
		<div align="center" style="font-size: 2em; font-family: Quicksand; color: #ccc;margin-bottom: 30px">Confirmación de asistencia</div>
		<form method="post" action="acciones/invitados_asistencia.php">
			<button style="cursor: pointer; padding: 5px; margin: 8px; font-family: PT Sans Narrow; font-size: 1.8em; color: #fff; border-radius: 4px; border: none; background: rgba(0,222,0,1)" type="submit" name="si" value="1">Sí <img src="imagenes/whatsapp1.png" style="max-width: 25px"></button>
			<button style="cursor: pointer; padding: 5px; margin: 8px; font-family: PT Sans Narrow; font-size: 1.8em; color: #fff; border-radius: 4px; border: none; background: #7537ff" type="submit" name="no" value="0">No <img src="imagenes/whatsapp2.png" style="max-width: 25px"></button>
			<button style="cursor: pointer; padding: 5px; margin: 8px; font-family: PT Sans Narrow; font-size: 1.8em; color: #fff; border-radius: 4px; border: none; background: #e45f84" type="submit" name="puede" value="2">No lo sé</button>
		</form>
	</div>
</div>

</body>
</html>