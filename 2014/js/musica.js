function escondeMensajes(){
	document.getElementById('username_availability_result').innerHTML = "";
}
function compruebaTodo1(){
	var elartista = document.getElementById('artista').value;
	var lacancion = document.getElementById('cancion').value;
	var elarchivo = document.getElementById('file').value;
	if(elartista==""&&lacancion==""){
		document.getElementById('errorArchivo').style.display = "none";
		document.getElementById('errorArtista').style.display = "table-row";
		document.getElementById('errorTitulo').style.display = "table-row";
		return false;
	}
	else if(elartista==""&&lacancion!=""){
		document.getElementById('errorArchivo').style.display = "none";
		document.getElementById('errorArtista').style.display = "table-row";
		document.getElementById('errorTitulo').style.display = "none";
		return false;
	}
	else if(elartista!=""&&lacancion==""){
		document.getElementById('errorArchivo').style.display = "none";
		document.getElementById('errorArtista').style.display = "none";
		document.getElementById('errorTitulo').style.display = "table-row";
		return false;
	}
	else{
		if(elarchivo!=""){
			document.getElementById('errorArtista').style.display = "none";
			document.getElementById('errorTitulo').style.display = "none";
			document.getElementById('errorArchivo').style.display = "none";
			document.getElementById('loadingAnimation').className = "option animated fadeIn";
			document.getElementById('loadingAnimation').style.visibility = "visible";
			document.getElementById('linkAtras').style.visibility = "hidden";
			return true;
		}
		else{
			document.getElementById('errorArtista').style.display = "none";
			document.getElementById('errorTitulo').style.display = "none";
			document.getElementById('errorArchivo').style.display = "block";
			return false;
		}
	}
}
function compruebaTodo2(){
	var elartista2 = document.getElementById('artista2').value;
	var lacancion2 = document.getElementById('cancion2').value;
	var ellink = document.getElementById('link').value;
	if(elartista2==""&&lacancion2==""){
		document.getElementById('errorURL').style.display = "none";
		document.getElementById('errorArtista2').style.display = "table-row";
		document.getElementById('errorTitulo2').style.display = "table-row";
		return false;
	}
	else if(elartista2==""&&lacancion2!=""){
		document.getElementById('errorURL').style.display = "none";
		document.getElementById('errorArtista2').style.display = "table-row";
		document.getElementById('errorTitulo2').style.display = "none";
		return false;
	}
	else if(elartista2!=""&&lacancion2==""){
		document.getElementById('errorURL').style.display = "none";
		document.getElementById('errorArtista2').style.display = "none";
		document.getElementById('errorTitulo2').style.display = "table-row";
		return false;
	}
	else{
		if(ellink!=""){
			document.getElementById('errorArtista2').style.display = "none";
			document.getElementById('errorTitulo2').style.display = "none";
			document.getElementById('errorURL').style.display = "none";
			document.getElementById('loadingAnimation2').className = "option animated fadeIn";
			document.getElementById('loadingAnimation2').style.visibility = "visible";
			document.getElementById('linkAtras').style.visibility = "hidden";
			return true;
		}
		else{
			document.getElementById('errorArtista2').style.display = "none";
			document.getElementById('errorTitulo2').style.display = "none";
			document.getElementById('errorURL').style.display = "block";
			return false;
		}
	}
}
function compruebaCampos(){
	var user = document.getElementById("form_usuario").value;
	var contra = document.getElementById("form_password").value;
	if((user.length<5)||(user=='')){
		alert('Por favor, escribe tu nombre de usuario');
		return false;
	}
	else if((contra.length<5)||(contra=='')){
		alert('Por favor, escribe tu password');
		return false;
	}
	else{
		return true;
	}
}
function muestraEnviarLink(){
	document.getElementById('subtitulo').style.display="none";
	document.getElementById('subtitulo').innerHTML="Envíame un link a la canción";
	document.getElementById('subtitulo').className="option animated fadeIn";
	document.getElementById('subtitulo').style.display="block";
	document.getElementById('accionesMusica2').style.display="none";
	document.getElementById('mandarArchivo').style.display="none";
	document.getElementById('mandarLink').className="option animated fadeIn";
	document.getElementById('mandarLink').style.display="block";
}
function muestraEnviarArchivo(){
	document.getElementById('subtitulo').style.display="none";
	document.getElementById('subtitulo').innerHTML="Envíame un archivo";
	document.getElementById('subtitulo').className="option animated fadeIn";
	document.getElementById('subtitulo').style.display="block";
	document.getElementById('accionesMusica1').style.display="none";
	document.getElementById('mandarLink').style.display="none";
	document.getElementById('mandarArchivo').className="option animated fadeIn";
	document.getElementById('mandarArchivo').style.display="block";
}
function escondeDivs(){
	document.getElementById('subtitulo').style.display="none";
	document.getElementById('subtitulo').innerHTML="Selecciona una acción";
	document.getElementById('subtitulo').className="option animated fadeIn";
	document.getElementById('subtitulo').style.display="block";
	document.getElementById('mandarLink').style.display="none";
	document.getElementById('mandarArchivo').style.display="none";
	document.getElementById('accionesMusica1').style.display="block";
	document.getElementById('accionesMusica2').style.display="block";
}