<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<link href='animate.css' rel='stylesheet' type='text/css'>
<link href='css/info.css' rel='stylesheet' type='text/css'>
<title>Fiesta | Información</title>
<script type="text/javascript" src="js/ajustainfo.js"></script>
<script src="js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="js/info.js"></script>
<script type="text/javascript" src="js/comprobacionajax.js"></script>
</head>
<script type="text/javascript" src="js/ajustabody.js"></script>
<!-- Loader -->
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
	echo'<div id="titulo" align="center"><img src="imagenes/tituloinfo.png" /></div>
		<div id="subtitulo" align="center">Por favor, inicia sesión para acceder a la información</div>
		<form method="post" action="acciones/login_info">
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
    <div id="titulo" align="center"><img src="imagenes/tituloinfo.png" /></div>
    
<!-- Sólo PC. Se muestra para anchura de pantalla superior a 768 pixels. -->
<div id="solopc" style="display:none;">
	<div id="subtitulo" align="center">Por favor, lee bien todos los apartados</div>
    <table id="tablainfo" cellpadding="0px" cellspacing="10px" align="center" width="100%">
    	<tr>
        	<td width="20%" align="center" style="background-color:rgba(0, 0, 0, 0.7);padding-top:5px" valign="top">
            	<div style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:24px;padding:8px;padding-bottom:16px;">Información general</div>
                <div style="background-color:rgba(0, 0, 0, 0.7);border-radius:25px;padding-bottom:10px;margin-left:10%;margin-right:10%;margin-bottom:12px;">
                    <img src="imagenes/tituloprecio.png" alt="" /><br />
                    <img src="imagenes/tituloprecio10.png" alt="" /><br />
                </div>
                <div style="background-color:rgba(0, 0, 0, 0.7);border-radius:25px;padding-bottom:10px;margin-left:10%;margin-right:10%;margin-bottom:12px;">
                    <img src="imagenes/titulofecha.png" alt="" /><br />
                    <img src="imagenes/fecha.png" alt="" /><br />
                </div>
                <div style="background-color:rgba(0, 0, 0, 0.7);border-radius:25px;padding-bottom:10px;margin-left:10%;margin-right:10%;margin-bottom:12px">
                    <img src="imagenes/titulolugar.png" alt="" /><br />
                    <img src="imagenes/house.png" alt="" /> <br /><div style="color:#eee">Casa de mi padre</div>
                </div>
                <div style="background-color:rgba(0, 0, 0, 0.7);border-radius:25px;padding-bottom:10px;margin-left:10%;margin-right:10%;margin-bottom:12px">
                    <img src="imagenes/titulodireccion.png" alt="" /><br />
                    <img src="imagenes/address.png" alt="" /><br /><div style="color:#888"><i>Preguntar por privado</i></div>
                </div>
            </td>
        	<td width="80%" align="left" style="padding-left:0px; background-color:rgba(0, 0, 0, 0.7);padding-top:5px;padding-right:30px;" valign="top">
            	<div align="center" style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:24px;padding:8px;">Planning</div>
                    <div id="contenidoinfo" align="left">
                        <ul style="color:#fff;font-family:'."'Open Sans Condensed'".';margin-left:15px;font-size:18px;">
                            <li><span style="color:#2E9AFE">El precio</span> final es de <b>10€</b>.</li>
                            <li><span style="color:#2E9AFE">El alcohol</span> lo compraré yo en Makro con el dinero recaudado.</li>
                            <li><span style="color:#2E9AFE">El dinero</span> me lo tendréis que dar, como mínimo, dos días antes de la fiesta.</li>
                            <li><span style="color:#2E9AFE">La comida</span> <span style="text-decoration:underline">no va incluida</span> en el precio, sólo cosas de picoteo. Es decir, la cena del día 20 corre a cuenta propia. No se puede cocinar en la casa.</li>
                            <li><span style="color:#2E9AFE">Se puede dormir </span>en mi casa. Para ello habilitaré el césped de abajo para instalar tiendas de campaña, y la pista de tennis para aparcar los coches.</li>
                            <li><span style="color:#2E9AFE">Traed bañador.</span> Habrá piscina.</li>
                            <li><span style="color:#2E9AFE">La música</span> será variada, y podéis traer caniones en un pen-drive o mandármelas a través de esta página para ponerlas en la fiesta, pero a los altavoces NO se podrán conectar móviles ni otro tipo de reproductores.</li>
                            <li><span style="color:#2E9AFE">La única entrada</span> y salida a la casa será la pista de tennis.</li>
                        </ul>
                    </div>
            <div align="center" style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:24px;padding:8px;">Normas</div>
            <table align="center" cellspacing="14px" cellpadding="16px" width="96%" style="margin-right:3px;">
            	<tr>
                	<td align="center" width="50%" style="background-color:rgba(0, 0, 0, 0.7);padding-top:12px;color:#fff;" valign="top">
                    <img src="imagenes/forbidden.png" alt="" style="vertical-align:middle" /> <span id="titulonormas" class="nosepuede">NO SE PUEDE:</span><br />
                    <div id="contenidonormascross" align="left">
                        <ul>
                            <li>Entrar en las zonas no habilitadas.</li>
                            <li>Cocinar en casa.</li>
                            <li>Entrar si no estás invitado*.</li>
                            <li>Tocar la música o la mesa de sonido.</li>
                            <li>Armar jaleo (tengo vecinos).</li>
                            <li>Mear en el jardín.</li>
                        	<div align="right" style="color:#fff; font-size:14px;margin-top:0px;padding-top:0px;">*No sería la primera vez que dejo a gente en la puerta.</div>
                        </ul>
                    </div>
                    </td>
                	<td align="center" width="50%" style="background-color:rgba(0, 0, 0, 0.7);padding-top:12px;color:#fff;" valign="top">
                    <img src="imagenes/permitted.png" alt="" style="vertical-align:middle" /> <span id="titulonormas" class="sepuede">SE PUEDE:</span><br />
                    <div id="contenidonormastick" align="left">
                        <ul>
                            <li>Traer comida y alcohol propios.</li>
                            <li>Aparcar en la pista de tennis.</li>
                            <li>Invitar a alguien con previo aviso* y pago.</li>
                            <li>Venir vestido como quieras.</li>
                            <li>Tirar la ceniza al suelo.</li>
                        	<div align="right" style="color:#fff; font-size:14px;margin-top:0px;padding-top:0px;">*Una semana antes de la fiesta, como mínimo.</div>
                        </ul>
                    </div>
                    </td>
                </tr>
            </table>
            </div>
            </td>
        </tr>
    </table>
    <table id="tablainfo" cellpadding="0px" cellspacing="10px" align="center" width="100%">
    	<tr>
        	<td width="50%" align="center" style="background-color:rgba(0, 0, 0, 0.7);padding-top:5px" valign="top">
            	<div style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:24px;padding:8px;padding-bottom:16px;">Medios de transporte</div>
                <table align="center" cellspacing="14px" cellpadding="16px" width="96%" style="margin-right:3px;">
                    <tr>
                        <td align="center" width="50%" style="background-color:rgba(0, 0, 0, 0.7);padding-top:12px;color:#fff;" valign="top">
                        <img src="imagenes/bus.png" alt="" style="vertical-align:middle" /> <span id="titulonormas" style="color:#eee;">Autobús:</span><br />
                        <div id="contenidonormascross" align="left">
                            <ul>
                                <li style="font-size:32px;color:#F4FA58;">518</li>
                                <div align="left" style="color:#999; font-size:20px;margin-top:0px;padding-top:0px;">Salida: <span style="color:#fff;font-size:17px;"> Príncipe Pío</span></div>
                                <div align="left" style="color:#999; font-size:20px;margin-top:0px;padding-top:0px;padding-bottom:13px;">Parada: <span style="color:#fff;font-size:17px;"> La última de todas</span></div>
                                    <div align="right" id="descargarhorarios" style="font-size:14px;margin-top:0px;padding-top:0px;">
                                    <a href="http://ctm-madrid.es/servlet/CalcItinerarioServlet?xh_ACCION=0&POPUP=1&xh_TIPO=25&xh_PAGINA=8&CODPANTALLA=11&xh_CLAVE=80518_518%20%20%20Madrid%20%28Pr%EDncipe%20P%EDo%29-Villaviciosa%20de%20Od%F3n&xh_horario_ida.x=1" target="_blank">
                                    Descargar horarios de ida.
                                    </a>
                                    </div>
                                    <div align="right" id="descargarhorarios" style="font-size:14px;margin-top:0px;padding-top:0px;">
                                    <a href="http://ctm-madrid.es/servlet/CalcItinerarioServlet?xh_ACCION=0&POPUP=1&xh_TIPO=25&xh_PAGINA=8&CODPANTALLA=11&xh_CLAVE=80518_518%20%20%20Madrid%20%28Pr%EDncipe%20P%EDo%29-Villaviciosa%20de%20Od%F3n&xh_horario_vta.x=1" target="_blank">
                                    Descargar horarios de vuelta.
                                    </a>
                                    </div>
                            </ul>
                        </div>
                        </td>
                        <td align="center" width="50%" style="background-color:rgba(0, 0, 0, 0.7);padding-top:12px;color:#fff;" valign="top">
                        <img src="imagenes/bus.png" alt="" style="vertical-align:middle" /> <span id="titulonormas" style="color:#eee;">Autobús nocturno:</span><br />
                        <div id="contenidonormascross" align="left">
                            <ul>
                                <li style="font-size:32px;color:#F4FA58;">N504</li>
                                <div align="left" style="color:#999; font-size:20px;margin-top:0px;padding-top:0px;">Salida: <span style="color:#fff;font-size:17px;"> Príncipe Pío</span></div>
                                <div align="left" style="color:#999; font-size:20px;margin-top:0px;padding-top:0px;padding-bottom:13px;">Parada: <span style="color:#fff;font-size:17px;"> La última de todas</span></div>
                                    <div align="right" id="descargarhorarios" style="font-size:14px;margin-top:0px;padding-top:0px;">
                                    <a href="http://www.ctm-madrid.es/servlet/CalcItinerarioServlet?xh_ACCION=0&POPUP=1&xh_TIPO=25&xh_PAGINA=8&CODPANTALLA=11&xh_CLAVE=8N504_N504%20%20Madrid%20%28Pr%C3%ADncipe%20P%C3%ADo%29-Villaviciosa%20de%20Od%C3%B3n&xh_horario_ida.x=1" target="_blank">
                                    Descargar horarios de ida.
                                    </a>
                                    </div>
                                    <div align="right" id="descargarhorarios" style="font-size:14px;margin-top:0px;padding-top:0px;">
                                    <a href="http://www.ctm-madrid.es/servlet/CalcItinerarioServlet?xh_ACCION=0&POPUP=1&xh_TIPO=25&xh_PAGINA=8&CODPANTALLA=11&xh_CLAVE=8N504_N504%20%20Madrid%20%28Pr%C3%ADncipe%20P%C3%ADo%29-Villaviciosa%20de%20Od%C3%B3n&xh_horario_vta.x=1" target="_blank">
                                    Descargar horarios de vuelta.
                                    </a>
                                    </div>
                            </ul>
                        </div>
                        </td>
                    </tr>
                </table>
            </td>
        	<td width="50%" align="center" style="background-color:rgba(0, 0, 0, 0.7);padding-top:5px" valign="top">
            	<div style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:24px;padding:8px;padding-bottom:16px;">El tiempo en Boadilla del Monte</div><br />
                <div id="cont_f5e34ebab39da821d9f985e3668c3f03">
                  <span id="h_f5e34ebab39da821d9f985e3668c3f03"></span>
                  <script type="text/javascript" src="http://www.tiempo.com/wid_loader/f5e34ebab39da821d9f985e3668c3f03"></script>
                </div>            
			</td>
        </tr>
    </table>
</div>

<!-- Sólo móvil. Se muestra para anchura de pantalla de hasta 768 pixels. -->
<div id="solomovil" style="display:none;">
	<div id="subtitulo" align="center">Por favor, lee bien todos los apartados</div>
    <div style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:50px;padding:8px;padding-bottom:16px;" align="center">Información general</div>
    <table id="tablainfo" cellpadding="0px" cellspacing="10px" align="center" width="100%">
    	<tr>
        	<td width="25%" align="center" style="background-color:rgba(0, 0, 0, 0.7);padding-top:5px" valign="top">
                <div style="background-color:rgba(0, 0, 0, 0.7);border-radius:25px;padding-bottom:10px;margin-left:10%;margin-right:10%;margin-bottom:12px;">
                    <img src="imagenes/tituloprecio.png" alt="" /><br />
                    <img src="imagenes/tituloprecio10.png" alt="" /><br />
                </div>
            </td>
        	<td width="25%" align="center" style="background-color:rgba(0, 0, 0, 0.7);padding-top:5px" valign="top">
                <div style="background-color:rgba(0, 0, 0, 0.7);border-radius:25px;padding-bottom:10px;margin-left:10%;margin-right:10%;margin-bottom:12px;">
                    <img src="imagenes/titulofecha.png" alt="" /><br />
                    <img src="imagenes/fecha.png" alt="" /><br />
                </div>
            </td>
        	<td width="25%" align="center" style="background-color:rgba(0, 0, 0, 0.7);padding-top:5px" valign="top">
                <div style="background-color:rgba(0, 0, 0, 0.7);border-radius:25px;padding-bottom:10px;margin-left:10%;margin-right:10%;margin-bottom:12px">
                    <img src="imagenes/titulolugar.png" alt="" /><br />
                    <img src="imagenes/house.png" alt="" /> <br /><div style="color:#eee">Casa de mi padre</div>
                </div>
            </td>
        	<td width="25%" align="center" style="background-color:rgba(0, 0, 0, 0.7);padding-top:5px" valign="top">
                <div style="background-color:rgba(0, 0, 0, 0.7);border-radius:25px;padding-bottom:10px;margin-left:10%;margin-right:10%;margin-bottom:12px">
                    <img src="imagenes/titulodireccion.png" alt="" /><br />
                    <img src="imagenes/address.png" alt="" /><br /><div style="color:#888"><i>Preguntar por privado</i></div>
                </div>
            </td>
		</tr>
	</table>
    <div align="center" style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:50px;padding:8px;">Planning</div>
    <table id="tablainfo" cellpadding="0px" cellspacing="10px" align="center" width="100%">
    	<tr>            	
        	<td width="80%" align="left" style="padding-left:0px; background-color:rgba(0, 0, 0, 0.7);padding-top:5px;padding-right:30px;" valign="top">
                    <div id="contenidoinfo" align="left">
                        <ul style="color:#fff;font-family:'."'Open Sans Condensed'".';margin-left:15px;font-size:18px;">
                            <li><span style="color:#2E9AFE">El precio</span> final es de <b>10€</b>.</li>
                            <li><span style="color:#2E9AFE">El alcohol</span> lo compraré yo en Makro con el dinero recaudado.</li>
                            <li><span style="color:#2E9AFE">El dinero</span> me lo tendréis que dar, como mínimo, dos días antes de la fiesta.</li>
                            <li><span style="color:#2E9AFE">La comida</span> <span style="text-decoration:underline">no va incluida</span> en el precio, sólo cosas de picoteo. Es decir, la cena del día 20 corre a cuenta propia. No se puede cocinar en la casa.</li>
                            <li><span style="color:#2E9AFE">Se puede dormir </span>en mi casa. Para ello habilitaré el césped de abajo para instalar tiendas de campaña, y la pista de tennis para aparcar los coches.</li>
                            <li><span style="color:#2E9AFE">Traed bañador.</span> Habrá piscina.</li>
                            <li><span style="color:#2E9AFE">La música</span> será variada, y podéis traer caniones en un pen-drive o mandármelas a través de esta página para ponerlas en la fiesta, pero a los altavoces NO se podrán conectar móviles ni otro tipo de reproductores.</li>
                            <li><span style="color:#2E9AFE">La única entrada</span> y salida a la casa será la pista de tennis.</li>
                        </ul>
                    </div>
            </td>
        </tr>
    </table>
    <div align="center" style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:50px;padding:8px;">Normas</div>
    <table align="center" cellspacing="14px" cellpadding="16px" width="100%" style="margin-right:3px;">
        <tr>
            <td align="center" width="100%" style="background-color:rgba(0, 0, 0, 0.7);padding-top:12px;color:#fff;" valign="top">
            <img src="imagenes/forbidden.png" alt="" style="vertical-align:middle" /> <span id="titulonormas" class="nosepuede">NO SE PUEDE:</span><br />
            <div id="contenidonormascross" align="left">
                <ul>
                    <li>Entrar en las zonas no habilitadas.</li>
                    <li>Cocinar en casa.</li>
                    <li>Entrar si no estás invitado*.</li>
                    <li>Tocar la música o la mesa de sonido.</li>
                    <li>Armar jaleo (tengo vecinos).</li>
                    <li>Mear en el jardín.</li>
                    <div align="right" style="color:#fff; font-size:14px;margin-top:0px;padding-top:0px;">*No sería la primera vez que dejo a gente en la puerta.</div>
                </ul>
            </div>
            </td>
		</tr>
		<tr>
            <td align="center" width="100%" style="background-color:rgba(0, 0, 0, 0.7);padding-top:12px;color:#fff;" valign="top">
            <img src="imagenes/permitted.png" alt="" style="vertical-align:middle" /> <span id="titulonormas" class="sepuede">SE PUEDE:</span><br />
            <div id="contenidonormastick" align="left">
                <ul>
                    <li>Traer comida y alcohol propios.</li>
                    <li>Aparcar en la pista de tennis.</li>
                    <li>Invitar a alguien con previo aviso* y pago.</li>
                    <li>Venir vestido como quieras.</li>
                    <li>Tirar la ceniza al suelo.</li>
                    <div align="right" style="color:#fff; font-size:14px;margin-top:0px;padding-top:0px;">*Una semana antes de la fiesta, como mínimo.</div>
                </ul>
            </div>
            </td>
        </tr>
    </table>
    <div style="color:#fff;font-family:'."'PT Sans Narrow'".';font-size:50px;padding:8px;padding-bottom:16px;" align="center">Medios de transporte</div>
    <table id="tablainfo" cellpadding="0px" cellspacing="10px" align="center" width="100%">
    	<tr>
			<td align="center" width="100%" style="background-color:rgba(0, 0, 0, 0.7);padding-top:12px;color:#fff;" valign="top">
			<img src="imagenes/bus.png" alt="" style="vertical-align:middle" /> <span id="titulonormas" style="color:#eee;">Autobús:</span><br />
			<div id="contenidonormascross" align="left">
				<ul>
					<li style="font-size:32px;color:#F4FA58;">518</li>
					<div align="left" style="color:#999; font-size:20px;margin-top:0px;padding-top:0px;">Salida: <span style="color:#fff;font-size:17px;"> Príncipe Pío</span></div>
					<div align="left" style="color:#999; font-size:20px;margin-top:0px;padding-top:0px;padding-bottom:13px;">Parada: <span style="color:#fff;font-size:17px;"> La última de todas</span></div>
						<div align="right" id="descargarhorarios" style="font-size:14px;margin-top:0px;padding-top:0px;">
						<a href="http://ctm-madrid.es/servlet/CalcItinerarioServlet?xh_ACCION=0&POPUP=1&xh_TIPO=25&xh_PAGINA=8&CODPANTALLA=11&xh_CLAVE=80518_518%20%20%20Madrid%20%28Pr%EDncipe%20P%EDo%29-Villaviciosa%20de%20Od%F3n&xh_horario_ida.x=1" target="_blank">
						Descargar horarios de ida.
						</a>
						</div>
						<div align="right" id="descargarhorarios" style="font-size:14px;margin-top:0px;padding-top:0px;">
						<a href="http://ctm-madrid.es/servlet/CalcItinerarioServlet?xh_ACCION=0&POPUP=1&xh_TIPO=25&xh_PAGINA=8&CODPANTALLA=11&xh_CLAVE=80518_518%20%20%20Madrid%20%28Pr%EDncipe%20P%EDo%29-Villaviciosa%20de%20Od%F3n&xh_horario_vta.x=1" target="_blank">
						Descargar horarios de vuelta.
						</a>
						</div>
				</ul>
			</div>
			</td>
        </tr>
    </table>
    <table id="tablainfo" cellpadding="0px" cellspacing="10px" align="center" width="100%">
    	<tr>
			<td align="center" width="100%" style="background-color:rgba(0, 0, 0, 0.7);padding-top:12px;color:#fff;" valign="top">
			<img src="imagenes/bus.png" alt="" style="vertical-align:middle" /> <span id="titulonormas" style="color:#eee;">Autobús nocturno:</span><br />
			<div id="contenidonormascross" align="left">
				<ul>
					<li style="font-size:32px;color:#F4FA58;">N504</li>
					<div align="left" style="color:#999; font-size:20px;margin-top:0px;padding-top:0px;">Salida: <span style="color:#fff;font-size:17px;"> Príncipe Pío</span></div>
					<div align="left" style="color:#999; font-size:20px;margin-top:0px;padding-top:0px;padding-bottom:13px;">Parada: <span style="color:#fff;font-size:17px;"> La última de todas</span></div>
						<div align="right" id="descargarhorarios" style="font-size:14px;margin-top:0px;padding-top:0px;">
						<a href="http://www.ctm-madrid.es/servlet/CalcItinerarioServlet?xh_ACCION=0&POPUP=1&xh_TIPO=25&xh_PAGINA=8&CODPANTALLA=11&xh_CLAVE=8N504_N504%20%20Madrid%20%28Pr%C3%ADncipe%20P%C3%ADo%29-Villaviciosa%20de%20Od%C3%B3n&xh_horario_ida.x=1" target="_blank">
						Descargar horarios de ida.
						</a>
						</div>
						<div align="right" id="descargarhorarios" style="font-size:14px;margin-top:0px;padding-top:0px;">
						<a href="http://www.ctm-madrid.es/servlet/CalcItinerarioServlet?xh_ACCION=0&POPUP=1&xh_TIPO=25&xh_PAGINA=8&CODPANTALLA=11&xh_CLAVE=8N504_N504%20%20Madrid%20%28Pr%C3%ADncipe%20P%C3%ADo%29-Villaviciosa%20de%20Od%C3%B3n&xh_horario_vta.x=1" target="_blank">
						Descargar horarios de vuelta.
						</a>
						</div>
				</ul>
			</div>
			</td>
        </tr>
    </table>
	
</div>

	';
}
?>
</div>
</div>
</body>
</html>
