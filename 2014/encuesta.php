<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<link href='animate.css' rel='stylesheet' type='text/css'>
<link href='css/encuesta.css' rel='stylesheet' type='text/css'>
<title>Fiesta | Encuesta</title>
<script type="text/javascript" src="js/encuesta.js"></script>
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
            <td align="left" width="97px" id="tdsuperior" ><a id="tdsuperiorlink2"  href="encuesta">Encuesta</a></td>
            <td align="left" width="120px" id="tdsuperior" ><a id="tdsuperiorlink3" href="info">Información</a></td>
            <td align="left" width="150px" id="tdsuperior" ><a id="tdsuperiorlink5" href="musica">Envíame música</a></td>
            <td align="left" width="200px" id="tdsuperior" ><a id="tdsuperiorlink6" href="comentarios">Comentarios </a><span class="menu_nuevo">¡NUEVO!</span></td>
<?php
     session_start();
		include('config.php');
		mysql_connect ($dbhost, $dbusername, $dbuserpass);
		mysql_select_db($dbname) or die("El servidor ha experimentado un problema al conectar con la base de datos. Por favor, inténtalo de nuevo.");
?>

<?php
	$buscanombre = mysql_query("SELECT * FROM 2014_07_19_invitados WHERE usuario = '".$_SESSION['usuario']."'") or die(mysql_error());
	$fila = mysql_fetch_array($buscanombre);
	$nombreusuario = $fila['nombre'];
     if($_SESSION["online"] != "1"){ echo '<td align="right"  id="tdsuperior" ><a id="tdsuperiorlink4" href="login">Log in</a></td>';}
	 else{
		 if($_SESSION["usuario"]=="admin"){
			 $notificaciones1 = mysql_query("SELECT * FROM 2014_07_19_encuesta WHERE seenByAdmin=0");
			 $notificaciones2 = mysql_query("SELECT * FROM 2014_07_19_canciones WHERE seenByAdmin=0");
			 $notificaciones3 = mysql_query("SELECT * FROM 2014_07_19_comentarios WHERE seenByAdmin=0");
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
	echo'<div id="titulo" align="center"><img src="imagenes/tituloencuesta.png" /></div>
		<div id="subtitulo" align="center">Por favor, inicia sesión para acceder a la encuesta</div>
		<form method="post" action="acciones/login_encuesta">
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
		<input type="submit" value="Log in" onClick="return compruebaCampos()" />
		</div>
		</form>	 
	';
}
else{
	// Comprueba si ya se ha hecho la encuesta
		$query = mysql_query("SELECT * FROM 2014_07_19_invitados WHERE usuario = '".$_SESSION['usuario']."'") or die(mysql_error());
		$row = mysql_fetch_array($query);
		$encuestahecha = $row['encuesta'];
	// Si ya se ha hecho...
	if($encuestahecha!=0){
		$consultahecha = mysql_query("SELECT * FROM 2014_07_19_encuesta WHERE usuario = '".$_SESSION['usuario']."'") or die(mysql_error());
		$row = mysql_fetch_array($consultahecha);
		$selected_bebida1 = $row['bebida1'];
		if($selected_bebida1 == "Otro"){
			if($row['otrabebida1']!="No"){
				$selected_bebida1 = $row['otrabebida1'];
			}
		}
		$selected_bebida2 = $row['bebida2'];
		if($selected_bebida2 == "Otro"){
			if($row['otrabebida2']!="No"){
				$selected_bebida2 = $row['otrabebida2'];
			}
		}
		$selected_bebida2 = strtolower($selected_bebida2);
		$selected_copas = $row['copas'];
		$selected_cervezas = $row['cervezas'];
		$selected_coche = $row['coche'];
		$selected_dormir = $row['dormir'];
		$selected_beerpong = $row['beerpong'];
		$selected_dardos = $row['dardos'];
		$selected_chupitos = $row['chupitos'];
		$selected_artista = $row['artista'];
		$selected_sugerencia = $row['sugerencia'];
		if($selected_sugerencia==""){
			$selected_sugerencia = "Ninguna";
		}
		$selected_aguantar = $row['aguantar'];
		$selected_secompromete = $row['secompromete'];
		echo'<div id="titulo" align="center"><img src="imagenes/tituloencuesta.png" /></div>
			<div id="subtitulo" align="center">¡Gracias por participar! Consulta los resultados en la página de inicio.</div>
			<div align="center" style="margin-top:30px;"><img src="imagenes/alcohol.gif" /></div>
			<div id="encuesta" align="center" class="label">
			Estos son los datos que has rellenado
			</div>
			<table align="center" width="100%" cellpadding="5px" cellspacing="2px">
				<tr>
					<td width="37%" align="center">&nbsp;</td>				
					<td width="5%" align="left" style="color:#B5C9FF; font-weight:normal"><img src="iconos_encuesta/bebida.png" /></td>
					<td width="21%" align="left" style="color:#fff; font-weight:normal; background-color:rgba(0, 0, 0, 0.7); padding-left:25px;">'.$selected_bebida1.' y '.$selected_bebida2.'</td>
					<td width="37%" align="center">&nbsp;</td>				
				</tr>
				<tr>
					<td width="37%" align="center">&nbsp;</td>				
					<td width="5%" align="left" style="color:#B5C9FF; font-weight:normal"><img src="iconos_encuesta/copa.png" /></td>
					<td width="21%" align="left" style="color:#fff; font-weight:normal; background-color:rgba(0, 0, 0, 0.7); padding-left:25px;">'.$selected_copas.' copas y '.$selected_cervezas.' cervezas</td>
					<td width="37%" align="center">&nbsp;</td>				
				</tr>
				<tr>
					<td width="37%" align="center">&nbsp;</td>				
					<td width="5%" align="left" style="color:#B5C9FF; font-weight:normal"><img src="iconos_encuesta/coche.png" /></td>
					<td width="21%" align="left" style="color:#fff; font-weight:normal; background-color:rgba(0, 0, 0, 0.7); padding-left:25px;">'.$selected_coche.'</td>
					<td width="37%" align="center">&nbsp;</td>				
				</tr>
				<tr>
					<td width="37%" align="center">&nbsp;</td>				
					<td width="5%" align="left" style="color:#B5C9FF; font-weight:normal"><img src="iconos_encuesta/dormir.png" /></td>
					<td width="21%" align="left" style="color:#fff; font-weight:normal; background-color:rgba(0, 0, 0, 0.7); padding-left:25px;">'.$selected_dormir.'</td>
					<td width="37%" align="center">&nbsp;</td>				
				</tr>
				<tr>
					<td width="37%" align="center">&nbsp;</td>				
					<td width="5%" align="left" style="color:#B5C9FF; font-weight:normal"><img src="iconos_encuesta/beerpong.png" /></td>
					<td width="21%" align="left" style="color:#fff; font-weight:normal; background-color:rgba(0, 0, 0, 0.7); padding-left:25px;">'.$selected_beerpong.'</td>
					<td width="37%" align="center">&nbsp;</td>				
				</tr>
				<tr>
					<td width="37%" align="center">&nbsp;</td>				
					<td width="5%" align="left" style="color:#B5C9FF; font-weight:normal"><img src="iconos_encuesta/dardos.png" /></td>
					<td width="21%" align="left" style="color:#fff; font-weight:normal; background-color:rgba(0, 0, 0, 0.7); padding-left:25px;">'.$selected_dardos.'</td>
					<td width="37%" align="center">&nbsp;</td>				
				</tr>
				<tr>
					<td width="37%" align="center">&nbsp;</td>				
					<td width="5%" align="left" style="color:#B5C9FF; font-weight:normal"><img src="iconos_encuesta/ruleta.png" /></td>
					<td width="21%" align="left" style="color:#fff; font-weight:normal; background-color:rgba(0, 0, 0, 0.7); padding-left:25px;">'.$selected_chupitos.'</td>
					<td width="37%" align="center">&nbsp;</td>				
				</tr>
				<tr>
					<td width="37%" align="center">&nbsp;</td>				
					<td width="5%" align="left" style="color:#B5C9FF; font-weight:normal"><img src="iconos_encuesta/dj.png" /></td>
					<td width="21%" align="left" style="color:#fff; font-weight:normal; background-color:rgba(0, 0, 0, 0.7); padding-left:25px;">'.$selected_artista.'</td>
					<td width="37%" align="center">&nbsp;</td>				
				</tr>
				<tr>
					<td width="37%" align="center">&nbsp;</td>				
					<td width="5%" align="left" style="color:#B5C9FF; font-weight:normal"><img src="iconos_encuesta/cubiertos.png" /></td>
					<td width="21%" align="left" style="color:#fff; font-weight:normal; background-color:rgba(0, 0, 0, 0.7); padding-left:25px;">'.$selected_sugerencia.'</td>
					<td width="37%" align="center">&nbsp;</td>				
				</tr>
			</table>
			<div align="center" id="rehacer"><a onClick="return confirmarReset()" href="acciones/encuesta_resetear">Rehacer</a></div>
		';
	}
	// Si no se ha hecho...
	else{
		echo '
			<script language="javascript" type="text/javascript" src="js/mensajechrome.js"></script>	
					
			<div id="titulo" align="center"><img src="imagenes/tituloencuesta.png" /></div>
			<div id="subtitulo" align="center">Por favor, rellena todos los campos</div>
			<form method="post" action="acciones/encuesta_action.php">
			<div id="encuesta" align="center" class="label">
			¿Cuánto dinero estás dispuesto a pagar?
			</div>
			<div id="encuesta" align="center" class="field">
			<select name="0" id="pasta">
			<option selected="" value="" onClick="quitaTodo()"></option>
			<option value="Hasta 5" onClick="quitaTodo()">Hasta 5 €</option>
			<option value="Entre 5 y 10" onClick="quitaTodo()">Entre 5 y 10€</option>
			<option value="Entre 10 y 15" onClick="quitaTodo()">Entre 10 y 15€</option>
			</select>
			</div>
			<div id="encuesta" align="center" class="label">
			Selecciona los dos tipos de bebida que más sueles consumir.
			</div>
			<div id="encuesta" align="center" class="field">
			<select name="1a" id="bebida1">
			<option selected="" value="" onClick="quitaTodo()"></option>
			<option value="Ron" onClick="quitaTodo()">Ron</option>
			<option value="Whiskey" onClick="quitaTodo()">Whiskey</option>
			<option value="Vodka" onClick="quitaTodo()">Vodka</option>
			<option value="Ginebra" onClick="quitaTodo()">Ginebra</option>
			<option value="Otro" onClick="otraBebida1()">Alguna otra mariconada</option>
			</select>
			<input id="otrabebida1" name="opciones1" type="text" size="26" maxlength="20" placeholder="¿Qué otra mariconada?" style="display:none" />
			<select name="1b" id="bebida2">
			<option selected="" value=""></option>
			<option value="Ron" onClick="quitaTodo()">Ron</option>
			<option value="Whiskey" onClick="quitaTodo()">Whiskey</option>
			<option value="Vodka" onClick="quitaTodo()">Vodka</option>
			<option value="Ginebra" onClick="quitaTodo()">Ginebra</option>
			<option value="Otro" onClick="otraBebida2()">Alguna otra mariconada</option>
			</select>
			<input id="otrabebida2" name="opciones2" type="text" size="26" maxlength="20" placeholder="¿Qué otra mariconada?" style="display:none" />
			</div>
			<div id="encuesta" align="center" class="label">
			¿Cuántas copas eres capaz de beberte en una noche?
			</div>
			<div id="encuesta" align="center" class="field">
			<select name="2" id="copas">
			<option selected="" value="" onClick="quitaTodo()"></option>
			<option value="1" onClick="quitaTodo()">Una</option>
			<option value="2" onClick="quitaTodo()">Dos</option>
			<option value="3" onClick="quitaTodo()">Tres</option>
			<option value="4" onClick="quitaTodo()">Cuatro</option>
			<option value="5" onClick="quitaTodo()">Cinco</option>
			<option value="6" onClick="quitaTodo()">Seis</option>
			<option value="7" onClick="quitaTodo()">Siete</option>
			<option value="8" onClick="quitaTodo()">Ocho</option>
			<option value="9" onClick="quitaTodo()">Nueve</option>
			<option value="10" onClick="quitaTodo()">Diez</option>
			<option value="11" onClick="noTeLoCrees()">Hasta el infinito, y más allá</option>
			</select>
			<div id="notelo" align="center" style="display:none;"><img src="imagenes/partyhard.png" width="150px" height="150px" /></div>
			</div>
			<div id="encuesta" align="center" class="label">
			¿Y cuántas cervezas en una tarde?
			</div>
			<div id="encuesta" align="center" class="field">
			<select name="3" id="copas">
			<option selected="" value="" onClick="quitaTodo()"></option>
			<option value="1" onClick="quitaTodo()">Una</option>
			<option value="2" onClick="quitaTodo()">Dos</option>
			<option value="3" onClick="quitaTodo()">Tres</option>
			<option value="4" onClick="quitaTodo()">Cuatro</option>
			<option value="5" onClick="quitaTodo()">Cinco</option>
			<option value="6" onClick="quitaTodo()">Seis</option>
			<option value="7" onClick="quitaTodo()">Siete</option>
			<option value="8" onClick="quitaTodo()">Ocho</option>
			<option value="9" onClick="quitaTodo()">Nueve</option>
			<option value="10" onClick="quitaTodo()">Diez</option>
			<option value="11" onClick="soyIrlandes()">Soy irlandés</option>
			<option value="12" onClick="soyIrlandes()">Soy Piccione</option>
			</select>
			<div id="soyirlan" align="center" style="display:none;">¿En qué momento te invité a mi fiesta?</div>
			</div>
			<div id="encuesta" align="center" class="label">
			¿Piensas traer coche?
			</div>
			<div id="encuesta" align="center" class="field">
			<select name="4" id="coche">
			<option selected="" value="" onClick="quitaTodo()"></option>
			<option value="Si" onClick="quitaTodo()">Si</option>
			<option value="No" onClick="quitaTodo()">No</option>
			</select>
			</div>
			<div id="encuesta" align="center" class="label">
			¿Piensas dormir en un coche o en una tienda?
			</div>
			<div id="encuesta" align="center" class="field">
			<select name="5" id="coche">
			<option selected="" value="" onClick="quitaTodo()"></option>
			<option value="Coche" onClick="quitaTodo()">En coche</option>
			<option value="Tienda" onClick="quitaTodo()">En una tienda</option>
			<option value="No piensa dormir" onClick="quitaTodo()">No pienso dormir</option>
			</select>
			</div>    
			<div id="encuesta" align="center" class="label">
			¿En qué pruebas te gustaría participar?
			</div>
			<div id="encuesta" align="center" class="field">
			<input type="checkbox" name="6" value="Si" onClick="muestraConfirm()" />Beer-Pong&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="7" value="Si" onClick="muestraConfirm()" />Dardos&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="8" value="Si" onClick="muestraConfirm()" />Ruleta de chupitos&nbsp;&nbsp;&nbsp;
			</div>
			<div id="encuesta" align="center" class="label">
			Elige el artista que más te represente.
			</div>
			<div id="encuesta" align="center" class="field">
			<select name="9" id="musica">
			<option selected="" value="" onClick="quitaTodo()"></option>
			<option value="Frank Kvitta" onClick="muestraFrankKvitta()">Frank Kvitta</option>
			<option value="Marquess" onClick="muestraMarquess()">Marquess</option>
			<option value="Skrillex" onClick="muestraSkrillex()">Skrillex</option>
			<option value="Joris Voorn" onClick="muestraJorisVoorn()">Joris Voorn</option>
			<option value="Abraham Mateo" onClick="muestraAbrahamMateo()">Abraham Mateo</option>
			<option value="Pitbull" onClick="muestraPitbull()">Pitbull</option>
			<option value="Don Omar" onClick="muestraDonOmar()">Don Omar</option>
			</select>
			</div>
				<div id="frankkvitta" align="center" style="display:none;"><img src="imagenes/frankkvitta.png" /></div>
				<div id="marquess" align="center" style="display:none;"><img src="imagenes/marquess.png" /></div>
				<div id="skrillex" align="center" style="display:none;"><img src="imagenes/skrillex.png" /></div>
				<div id="jorisvoorn" align="center" style="display:none;"><img src="imagenes/jorisvoorn.png" /></div>
				<div id="abrahammateo" align="center" style="display:none;"><img src="imagenes/abrahammateo.png" /></div>
				<div id="pitbull" align="center" style="display:none;"><img src="imagenes/pitbull.png" /></div>
				<div id="donomar" align="center" style="display:none;"><img src="imagenes/donomar.png" /></div>
			<div id="encuesta" align="center" class="label">
			¿Alguna sugerencia para la comida de picoteo?
			</div>
			<div id="encuesta" align="center" class="field">
			<input id="sugerenciacomida" name="10" type="text" size="26" maxlength="32" placeholder="Sugiere, sugiere" />
			</div>
			<div id="encuesta" align="center" class="label">
			¿Piensas aguantar de principio a fin?
			</div>
			<div id="encuesta" align="center" class="field">
			<select name="11" id="aguantar" onClick="quitaTodo()">
			<option selected="" value=""></option>
			<option value="Si">Si</option>
			<option id="nomequedo" value="No" onClick="muestraError()">No</option>
			</select>
				<div id="maricon" style="display:none;"><img src="imagenes/gay.png" /></div>
			</div>
			<div id="subtitulo" align="center" style="margin-top:22px;">
			<input type="checkbox" name="12" value="Si" onClick="muestraConfirm()" />&nbsp;&nbsp;&nbsp;Me comprometo a beber hasta reventar.<br />
			</div>
			<input type="hidden" name="usuarioencuesta" value="'.$_SESSION["usuario"].' " />
			<div id="encuesta" align="center" class="enviar">
			<input type="submit" value="Enviar" />
			</div>
			</form>
		';
	}
}
?>
</div>
</div>
</body>
</html>
