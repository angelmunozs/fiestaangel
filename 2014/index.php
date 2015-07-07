<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<link href='animate.css' rel='stylesheet' type='text/css'>
<link href='css/index.css' rel='stylesheet' type='text/css'>
<link href='css/thickbox.css' rel='stylesheet' type='text/css'>
<title>Fiesta | Home</title>
<script src="js/jquery1.4.4.js" type="text/javascript" charset="utf-8"></script>
<script src="countdown/countdown.js" type="text/javascript" charset="utf-8"></script>
<script language="javascript" type="text/javascript" src="flashmp3player/swfobject.js" ></script> 
<script language="javascript" type="text/javascript" src="js/thickbox-compressed.js" ></script> 
<script type="text/javascript">
$(function(){
        $(".digits").countdown({
          image: "countdown/digits.png",
          format: "dd:hh:mm:ss",
          endTime: new Date(2014, 7, 19)
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
    <div align="center">
            <div class="wrapper">
              <div class="cell">
                <div id="holder">
                  <div class="digits"></div>
                </div>
              </div>
            </div>
    </div>
    <div align="center">
    <img src="countdown/dhms.png"/>
    </div>
<?php
// Saca los datos de la encuesta

// Conexion con base de datos
// Request a la db
		$personas = mysql_query('SELECT * FROM 2014_07_19_encuesta');
		$personas = mysql_num_rows($personas);
		if($personas==0){
			$personas = 1;
		}
// Inicialización de variables
		$array1 = mysql_query("SELECT bebida1 FROM 2014_07_19_encuesta WHERE bebida1='Ron'");
		$array2 = mysql_query("SELECT bebida2 FROM 2014_07_19_encuesta WHERE bebida2='Ron'");
		$bebidaRon = mysql_num_rows($array1)+mysql_num_rows($array2);
		$array1 = mysql_query("SELECT bebida1 FROM 2014_07_19_encuesta WHERE bebida1='Whiskey'");
		$array2 = mysql_query("SELECT bebida2 FROM 2014_07_19_encuesta WHERE bebida2='Whiskey'");
		$bebidaWhiskey = mysql_num_rows($array1)+mysql_num_rows($array2);
		$array1 = mysql_query("SELECT bebida1 FROM 2014_07_19_encuesta WHERE bebida1='Ginebra'");
		$array2 = mysql_query("SELECT bebida2 FROM 2014_07_19_encuesta WHERE bebida2='Ginebra'");
		$bebidaGinebra = mysql_num_rows($array1)+mysql_num_rows($array2);
		$array1 = mysql_query("SELECT bebida1 FROM 2014_07_19_encuesta WHERE bebida1='Vodka'");
		$array2 = mysql_query("SELECT bebida2 FROM 2014_07_19_encuesta WHERE bebida2='Vodka'");
		$bebidaVodka = mysql_num_rows($array1)+mysql_num_rows($array2);
		$array1 = mysql_query("SELECT bebida1 FROM 2014_07_19_encuesta WHERE bebida1='Otro'");
		$array2 = mysql_query("SELECT bebida2 FROM 2014_07_19_encuesta WHERE bebida2='Otro'");
		$bebidaOtro = mysql_num_rows($array1)+mysql_num_rows($array2);
		$array = mysql_query("SELECT coche FROM 2014_07_19_encuesta WHERE coche='Si'");
		$cocheSi = mysql_num_rows($array);
		$cocheNo = $personas - $cocheSi;
		$array = mysql_query("SELECT dormir FROM 2014_07_19_encuesta WHERE dormir='Coche'");
		$dormirCoche = mysql_num_rows($array);
		$array = mysql_query("SELECT dormir FROM 2014_07_19_encuesta WHERE dormir='Tienda'");
		$dormirTienda = mysql_num_rows($array);
		$dormirNoPiensa = $personas - $dormirCoche - $dormirTienda;
		$array = mysql_query("SELECT copas FROM 2014_07_19_encuesta");
		
		$totalCopas = 0;
		while($info = mysql_fetch_array($array)){ 
			$totalCopas = $totalCopas + $info['copas'];
		}
		$array = mysql_query("SELECT cervezas FROM 2014_07_19_encuesta");
		$totalCervezas =  0;
		while($info = mysql_fetch_array($array)){ 
			$totalCervezas = $totalCervezas + $info['cervezas'];
		}
		$copasMedia = round($totalCopas/$personas, 2);
		$cervezasMedia = round($totalCervezas/$personas, 2);
		$array = mysql_query("SELECT artista FROM 2014_07_19_encuesta WHERE artista='Frank Kvitta'");
		$artistaFrankKvitta = mysql_num_rows($array);
		$array = mysql_query("SELECT artista FROM 2014_07_19_encuesta WHERE artista='Marquess'");
		$artistaMarquess = mysql_num_rows($array);
		$array = mysql_query("SELECT artista FROM 2014_07_19_encuesta WHERE artista='Skrillex'");
		$artistaSkrillex = mysql_num_rows($array);
		$array = mysql_query("SELECT artista FROM 2014_07_19_encuesta WHERE artista='Joris Voorn'");
		$artistaJorisVoorn = mysql_num_rows($array);
		$array = mysql_query("SELECT artista FROM 2014_07_19_encuesta WHERE artista='Abraham Mateo'");
		$artistaAbrahamMateo = mysql_num_rows($array);
		$array = mysql_query("SELECT artista FROM 2014_07_19_encuesta WHERE artista='Pitbull'");
		$artistaPitbull = mysql_num_rows($array);
		$array = mysql_query("SELECT artista FROM 2014_07_19_encuesta WHERE artista='Don Omar'");
		$artistaDonOmar = mysql_num_rows($array);
		$votosArtista = max($artistaFrankKvitta, $artistaMarquess, $artistaSkrillex, $artistaJorisVoorn, $artistaAbrahamMateo, $artistaPitbull, $artistaDonOmar);
		$array = mysql_query("SELECT artista FROM 2014_07_19_encuesta");
		$artistaSEO = "";
		$porcentajeArtista=0;
		// Array con la columna artistas de la tabla 2014_07_19_encuesta
		$artistas = array();
		while ($row = mysql_fetch_array($array)) {
			array_push($artistas, $row["artista"]);
		}
		// Función que devuelve el elemento más frecuente de un array
		function mostFrequent($x) {
			$counted = array_count_values($x);
			arsort($counted);
			return(key($counted));    
		}		
		$artistaMasFrecuente = mostFrequent($artistas);
		// Localiza el artista y su correspondiente imagen
		if($artistaMasFrecuente=="Frank Kvitta"){
			$artistaSEO="../artistas/frank_kvitta.jpg";
			$porcentajeArtista = round($artistaFrankKvitta/$personas*100, 2);
		}
		elseif($artistaMasFrecuente=="Marquess"){
			$artistaSEO="../artistas/marquess.jpg";
			$porcentajeArtista = round($artistaMarquess/$personas*100, 2);
		}
		elseif($artistaMasFrecuente=="Skrillex"){
			$artistaSEO="../artistas/skrillex.jpg";
			$porcentajeArtista = round($artistaSkrillex/$personas*100, 2);
		}
		elseif($artistaMasFrecuente=="Joris Voorn"){
			$artistaSEO="../artistas/joris_voorn.jpg";
			$porcentajeArtista = round($artistaJorisVoorn/$personas*100, 2);
		}
		elseif($artistaMasFrecuente=="Abraham Mateo"){
			$artistaSEO="../artistas/abraham_mateo.jpg";
			$porcentajeArtista = round($artistaAbrahamMateo/$personas*100, 2);
		}
		elseif($artistaMasFrecuente=="Pitbull"){
			$artistaSEO="../artistas/pitbull.jpg";
			$porcentajeArtista = round($artistaPitbull/$personas*100, 2);
		}
		else{
			$artistaSEO="../artistas/don_omar.jpg";
			$porcentajeArtista = round($artistaDonOmar/$personas*100, 2);
		}
		$array = mysql_query("SELECT beerpong FROM 2014_07_19_encuesta WHERE beerpong='Si'");
		$participantesBeerPong = mysql_num_rows($array);
		$array = mysql_query("SELECT dardos FROM 2014_07_19_encuesta WHERE dardos='Si'");
		$participantesDardos = mysql_num_rows($array);
		$array = mysql_query("SELECT chupitos FROM 2014_07_19_encuesta WHERE chupitos='Si'");
		$participantesRuleta = mysql_num_rows($array);
		$array = mysql_query("SELECT artista FROM 2014_07_19_canciones ORDER BY id DESC");
		$artistasCancion = array();
		while ($row = mysql_fetch_array($array)) {
			array_push($artistasCancion, $row["artista"]);
		}
		$array = mysql_query("SELECT titulo FROM 2014_07_19_canciones ORDER BY id DESC");
		$titulosCancion = array();
		while ($row = mysql_fetch_array($array)) {
			array_push($titulosCancion, $row["titulo"]);
		}
		$cancionesRecibidas = mysql_num_rows($array);
		$ultimaSugerencia = "";
		$quienHaSugerido = "";
		$consultaSugerencias = mysql_query("SELECT sugerencia FROM 2014_07_19_encuesta ORDER BY id ASC");
		$consultaSugerencias1 = mysql_query("SELECT 2014_07_19_invitados.nombre FROM 2014_07_19_invitados INNER JOIN 2014_07_19_encuesta ON 2014_07_19_encuesta.usuario = 2014_07_19_invitados.usuario ORDER BY 2014_07_19_encuesta.id ASC");
		$arraySugerencias = array();
		$arraySugerencias1 = array();
		while ($row = mysql_fetch_array($consultaSugerencias)) {
			array_push($arraySugerencias, $row["sugerencia"]);
		}
		while ($row = mysql_fetch_array($consultaSugerencias1)) {
			array_push($arraySugerencias1, $row["nombre"]);
		}
		for($i=0;$i<mysql_num_rows($consultaSugerencias);$i++){
			if($arraySugerencias[$i]!=""){
				$ultimaSugerencia = $arraySugerencias[$i];
			}
		}
		for($i=0;$i<mysql_num_rows($consultaSugerencias1);$i++){
			if($arraySugerencias[$i]!=""){
				$quienHaSugerido = $arraySugerencias1[$i];
			}
		}
?>
<table align="center" width="100%" cellpadding="0px" cellspacing="15px" style="margin-top:40px">
	<tr>
    	<td width="33%" class="label" align="center" valign="top">Bebidas más votadas<br />
            <table align="center" width="100%" cellpadding="0px" cellspacing="6px" style="margin:10px; font-size:20px; font-family:'Open Sans Condensed'">
            	<tr>
                	<td width="20%">Ron</td>
                	<td width="5%">&nbsp;</td>
                	<td width="71%" style="border: 1px dotted #555; padding:5px; background-color:rgba(0, 0, 0, 0.7);font-size:16px;" align="left">
					<img src="imagenes/ron.png" height="30px" style="vertical-align:middle;padding-right:10px;" width="<?php $bebidaRonPorciento = $bebidaRon/(2*$personas)*100; echo round($bebidaRonPorciento,0) ?>%" />
					<?php echo $bebidaRon ?> (<?php echo round($bebidaRonPorciento,2) ?> %)
                    </td>
                	<td width="4%">&nbsp;</td>
                </tr>
            	<tr>
                	<td width="20%">Whiskey</td>
                	<td width="5%">&nbsp;</td>
                	<td width="71%" style="border: 1px dotted #555; padding:5px; background-color:rgba(0, 0, 0, 0.7);font-size:16px;" align="left">
					<img src="imagenes/whiskey.png" height="30px" style="vertical-align:middle;padding-right:10px;" width="<?php $bebidaWhiskeyPorciento = $bebidaWhiskey/(2*$personas)*100; echo round($bebidaWhiskeyPorciento,0) ?>%" />
					<?php echo $bebidaWhiskey ?> (<?php echo round($bebidaWhiskeyPorciento,2) ?> %)
                    </td>
                	<td width="4%">&nbsp;</td>
                </tr>
            	<tr>
                	<td width="20%">Ginebra</td>
                	<td width="5%">&nbsp;</td>
                	<td width="71%" style="border: 1px dotted #555; padding:5px; background-color:rgba(0, 0, 0, 0.7);font-size:16px;" align="left">
					<img src="imagenes/ginebra.png" height="30px" style="vertical-align:middle;padding-right:10px;" width="<?php $bebidaGinebraPorciento = $bebidaGinebra/(2*$personas)*100; echo round($bebidaGinebraPorciento,0) ?>%" />
					<?php echo $bebidaGinebra ?> (<?php echo round($bebidaGinebraPorciento,2) ?> %)
                    </td>
                	<td width="4%">&nbsp;</td>
                </tr>
            	<tr>
                	<td width="20%">Vodka</td>
                	<td width="5%">&nbsp;</td>
                	<td width="71%" style="border: 1px dotted #555; padding:5px; background-color:rgba(0, 0, 0, 0.7);font-size:16px;" align="left">
					<img src="imagenes/vodka.png" height="30px" style="vertical-align:middle;padding-right:10px;" width="<?php $bebidaVodkaPorciento = $bebidaVodka/(2*$personas)*100; echo round($bebidaVodkaPorciento,0) ?>%" />
					<?php echo $bebidaVodka ?> (<?php echo round($bebidaVodkaPorciento,2) ?> %)
                    </td>
                	<td width="4%">&nbsp;</td>
                </tr>
            	<tr>
                	<td width="20%">Otra</td>
                	<td width="5%">&nbsp;</td>
                	<td width="71%" style="border: 1px dotted #555; padding:5px; background-color:rgba(0, 0, 0, 0.7);font-size:16px;" align="left">
					<img src="imagenes/otro.png" height="30px" style="vertical-align:middle;padding-right:10px;" width="<?php $bebidaOtroPorciento = $bebidaOtro/(2*$personas)*100; echo round($bebidaOtroPorciento,0) ?>%" />
					<?php echo $bebidaOtro ?> (<?php echo round($bebidaOtroPorciento,2) ?> %)
                    </td>
                	<td width="4%">&nbsp;</td>
                </tr>
            </table>
        </td>
    	<td width="34%" class="label" align="center" valign="top">Artista más votado: <span style="color:#FACC2E;"><?php echo $artistaMasFrecuente ?></span><br />
        <div align="center" style="margin:10px; font-size:20px; font-family:'Open Sans Condensed'">Con un <?php echo $porcentajeArtista ?> % de los votos</div>
        <div align="center"><img src="imagenes/<?php echo $artistaSEO ?>" alt="<?php echo $artistaMasFrecuente ?>" style="margin-top:20px;margin-bottom:30px;max-width:100%" /></div>
        </td>    	
        <td width="33%" class="label" align="center" valign="top">Piensan traer coche<br />
            <table align="center" width="100%" cellpadding="0px" cellspacing="6px" style="margin:10px; font-size:20px; font-family:'Open Sans Condensed'">
            	<tr>
                	<td width="10%">Sí</td>
                	<td width="5%">&nbsp;</td>
                	<td width="81%" style="border: 1px dotted #555; padding:5px; background-color:rgba(0, 0, 0, 0.7);" align="center">
					<?php echo $cocheSi ?> (<?php $cocheSiPorciento = $cocheSi/$personas*100; echo round($cocheSiPorciento,2) ?> %)
                    </td>
                	<td width="4%">&nbsp;</td>
                </tr>
            	<tr>
                	<td width="10%">No</td>
                	<td width="5%">&nbsp;</td>
                	<td width="81%" style="border: 1px dotted #555; padding:5px; background-color:rgba(0, 0, 0, 0.7);" align="center">
					<?php echo $cocheNo ?> (<?php $cocheNoPorciento = $cocheNo/$personas*100; echo round($cocheNoPorciento,2) ?> %)
                    </td>
                	<td width="4%">&nbsp;</td>
                </tr>
            </table>
            Bebida media por persona <br />
            <table align="center" width="100%" cellpadding="0px" cellspacing="6px" style="margin:10px; font-size:20px; font-family:'Open Sans Condensed'">
            	<tr>
                	<td width="15%">Copas</td>
                	<td width="5%">&nbsp;</td>
                	<td width="76%" style="border: 1px dotted #555; padding:5px; background-color:rgba(0, 0, 0, 0.7);" align="center">
					<?php echo $copasMedia ?>
                    </td>
                	<td width="4%">&nbsp;</td>
                </tr>
            	<tr>
                	<td width="15%">Cerveza</td>
                	<td width="5%">&nbsp;</td>
                	<td width="76%" style="border: 1px dotted #555; padding:5px; background-color:rgba(0, 0, 0, 0.7);" align="center">
					<?php echo $cervezasMedia ?>
                    </td>
                	<td width="4%">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table align="center" width="100%" cellpadding="0px" cellspacing="15px" style="margin-top:10px">
	<tr>
    	<td width="40%" class="label" align="center" valign="top">Para dormir<br />
            <table align="center" width="100%" cellpadding="0px" cellspacing="6px" style="margin:10px; font-size:20px; font-family:'Open Sans Condensed'">
            	<tr>
                	<td width="30%">En coche</td>
                	<td width="2%">&nbsp;</td>
                	<td width="11%"><img src="imagenes/car.png" style="vertical-align:middle" /></td>
                	<td width="2%">&nbsp;</td>
                	<td width="51%" style="border: 1px dotted #555; padding:5px; background-color:rgba(0, 0, 0, 0.7);" align="center">
					<?php echo $dormirCoche ?> (<?php $dormirCochePorciento = $dormirCoche/$personas*100; echo round($dormirCochePorciento,2) ?> %)
                    </td>
                	<td width="4%">&nbsp;</td>
                </tr>
            	<tr>
                	<td width="30%">En tienda</td>
                	<td width="2%">&nbsp;</td>
                	<td width="11%"><img src="imagenes/tent.png" style="vertical-align:middle" /></td>
                	<td width="2%">&nbsp;</td>
                	<td width="51%" style="border: 1px dotted #555; padding:5px; background-color:rgba(0, 0, 0, 0.7);" align="center">
					<?php echo $dormirTienda ?> (<?php $dormirTiendaPorciento = $dormirTienda/$personas*100; echo round($dormirTiendaPorciento,2) ?> %)
                    </td>
                	<td width="4%">&nbsp;</td>
                </tr>
            	<tr>
                	<td width="30%">No piensa dormir</td>
                	<td width="2%">&nbsp;</td>
                	<td width="11%"><img src="imagenes/death.png" style="vertical-align:middle" /></td>
                	<td width="2%">&nbsp;</td>
                	<td width="51%" style="border: 1px dotted #555; padding:5px; background-color:rgba(0, 0, 0, 0.7);" align="center">
					<?php echo $dormirNoPiensa ?> (<?php $dormirNoPiensaPorciento = $dormirNoPiensa/$personas*100; echo round($dormirNoPiensaPorciento,2) ?> %)
                    </td>
                	<td width="4%">&nbsp;</td>
                </tr>
            </table>
            Última sugerencia para el picoteo:
            <div align="center" style="border: 1px dotted #555; padding:5px;font-size:20px; font-family:'Open Sans Condensed'; margin:15px; background-color:rgba(0, 0, 0, 0.7);"><?php echo $ultimaSugerencia ?><span style="color:#777; font-size:16px;">, por </span><span style="color:#FC3"><?php echo $quienHaSugerido ?></span></div>
        </td>
    	<td width="20%" class="label" align="center" valign="top">Beer-Pong<br />
        <div align="center"><img src="imagenes/beerpong.png" alt="Beer Pong" style="margin-top:20px;margin-bottom:10px;" /></div>
        <div align="center" style="margin-left:10px;margin-right:10px; font-size:24px; font-family:'Open Sans Condensed'"><span style="color:#FACC2E;font-size:46px; font-weight:bold;"><?php echo $participantesBeerPong ?></span>  participantes</div>
        <div align="center"><a style="font-size:14px; font-family:'Open Sans Condensed'; color:#999;text-decoration:none;margin-bottom:10px" href="ajax/beerpong.php?height=220&width=400" class="thickbox" title="Fiesta de Ángel">Ver participantes</a></div>
        </td>
    	<td width="20%" class="label" align="center" valign="top">Dardos<br />
        <div align="center"><img src="imagenes/dardos.png" alt="Dardos" style="margin-top:20px;margin-bottom:10px;" /></div>
        <div align="center" style="margin-left:10px;margin-right:10px; font-size:24px; font-family:'Open Sans Condensed'"><span style="color:#FACC2E;font-size:46px;font-weight:bold;"><?php echo $participantesDardos ?></span>  participantes</div>
        <div align="center"><a style="font-size:14px; font-family:'Open Sans Condensed'; color:#999;text-decoration:none;margin-bottom:10px" href="ajax/dardos.php?height=220&width=400" class="thickbox" title="Fiesta de Ángel">Ver participantes</a></div>
        </td>
    	<td width="20%" class="label" align="center" valign="top">Ruleta de chupitos<br />
        <div align="center"><img src="imagenes/ruleta.png" alt="Chupitos" style="margin-top:20px;margin-bottom:10px;" /></div>
        <div align="center" style="margin-left:10px;margin-right:10px; font-size:24px; font-family:'Open Sans Condensed'"><span style="color:#FACC2E;font-size:46px; font-weight:bold;"><?php echo $participantesRuleta ?></span>  participantes</div>
        <div align="center"><a style="font-size:14px; font-family:'Open Sans Condensed'; color:#999;text-decoration:none;margin-bottom:10px" href="ajax/ruleta.php?height=220&width=400" class="thickbox" title="Fiesta de Ángel">Ver participantes</a></div>
        </td>
    </tr>
</table>
<table align="center" width="100%" cellpadding="0px" cellspacing="15px" style="margin-top:10px">
	<tr>
    	<?php
		// Devuelve los últimos usuarios que han enviado canciones
		$usuariosQueHanEnviado = "SELECT DISTINCT(usuario) FROM 2014_07_19_canciones ORDER BY sent DESC LIMIT 5";
		$losQueHanEnviado = mysql_query($usuariosQueHanEnviado);
		$todosLosQueHanEnviado = array();
		while ($row = mysql_fetch_array($losQueHanEnviado)) {
			array_push($todosLosQueHanEnviado, $row["usuario"]);
		}
		?>
    	<td width="50%" class="label" align="center" valign="top">        
            <div align="center" style="padding:18px;padding-top:8px;margin-top:0px;margin-left:2%;margin-right:2%;"><div style="color:#fff; font-size:24px; padding-bottom:6px; border-radius:1px;">Canciones recibidas</div>
            <!-- Div that contains player. -->
            <div id="player">
            <h1 style="color:#fff;font-size:19px;">¡No has instalado flash player!</h1>
            <p style="color:#fff;font-size:17px;">Sin haber instalado flash player, no puedes visualizar el reproductor. Clic<a href="http://www.macromedia.com/go/getflashplayer" > aquí </a> para descargarlo desde la página de Macromedia.</p>
            </div>
            <!-- Script that embeds player. -->
            <script language="javascript" type="text/javascript">
            var so = new SWFObject("flashmp3player/flashmp3player.swf", "player", "100%", "200px", "9"); // Location of swf file. You can change player width and height here (using pixels or percents).
            so.addParam("quality","high");
            so.addVariable("content_path","mp3"); // Location of a folder with mp3 files (relative to php script).
            so.addVariable("color_path","flashmp3player/default.xml"); // Location of xml file with color settings.
            so.addVariable("script_path","flashmp3player/flashmp3player.php"); // Location of php script.
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
			$consulta3 = mysql_query("SELECT usuario FROM 2014_07_19_invitados WHERE timesloggedin>0 AND usuario!='admin' AND usuario NOT LIKE '%prueba%' ORDER BY lastlogin DESC LIMIT 10");
			$consulta4 = mysql_query("SELECT lastlogin FROM 2014_07_19_invitados WHERE timesloggedin>0 AND usuario!='admin' AND usuario NOT LIKE '%prueba%' ORDER BY lastlogin DESC LIMIT 10");
			$usuariosYaLogeados=array();
			$fechasDeUltimoLogin=array();
			while ($row = mysql_fetch_array($consulta3)) {
				array_push($usuariosYaLogeados, $row["usuario"]);
			}
			while ($row = mysql_fetch_array($consulta4)) {
				array_push($fechasDeUltimoLogin, $row["lastlogin"]);
			}
		?>
        <td width="50%" align="center" valign="top" style="background-color:rgba(0,0,0,0.7);">
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
        
<div align="center" style="margin:10px;font-size:24px; font-family:'PT Sans Narrow'; color:#eee">Visitas:</div>
<div align="center"><a href="http://www.contadorvisitasgratis.com" title="contador de visitas"><img src="http://counter6.statcounterfree.com/private/contadorvisitasgratis.php?c=8e9378f55a7038d26d77f71985249af9" border="0" title="contador de visitas" alt="contador de visitas"></a></div>
</div>
</div>
</body>
</html>