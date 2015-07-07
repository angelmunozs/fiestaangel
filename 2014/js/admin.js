var abc = 0;
var cde = 0;
var def = 0;
function escondeMensajes(){
	document.getElementById('username_availability_result').innerHTML = "";
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
function confirmarEliminarUsuario(){
	var r=confirm("\xBFEst\xE1s seguro?\n\nEl usuario no se podr\xE1 recuperar");
	if(r==true){
		return true;
	} 
	else{
		return false;
	} 
}
function compruebaCamposNuevo(){
	var elnombre = document.getElementById("nuevoNombre").value;
	var elapellido = document.getElementById("nuevoApellido").value;
	var elpassword = document.getElementById("nuevoPassword").value;
	var errores = 0;
	document.getElementById("errorNombre").innerHTML="";
	document.getElementById("errorApellido").innerHTML="";
	document.getElementById("errorPassword").innerHTML="";
	if(elnombre==""||elnombre.length<2){
		document.getElementById("errorNombre").innerHTML="Añade un nombre";
		errores++;
	}
	if(elapellido==""||elapellido.length<2){
		document.getElementById("errorApellido").innerHTML="Añade un apellido";
		errores++;
	}
	if(elpassword==""||elpassword.length<6){
		document.getElementById("errorPassword").innerHTML="Al menos 6 caracteres";
		errores++;
	}
	if(errores!=0){
		return false;
	}
	else{
		return true;
	}
}
function confirmarDeleteCancion(){
	var r=confirm("\xBFEst\xE1s seguro?\n\nLa canción no se podr\xE1 recuperar");
	if(r==true){
		return true;
	} 
	else{
		return false;
	} 
}
function mostrarTodasLasEncuestas(){
	if(abc%2==0){
		document.getElementById('muestraCuantasTexto').innerHTML = " (mostrando todo)";
		document.getElementById('muestraTodoTexto').innerHTML = ' <a onclick="mostrarTodasLasEncuestas()">&nbsp;&nbsp;&nbsp;Mostrar sólo 8</a>';
		document.getElementById('tablaEncuestas10Ultimas').style.display = "none";
		document.getElementById('tablaEncuestasTodas').style.display = "table";
	}
	else{
		document.getElementById('muestraCuantasTexto').innerHTML = " (mostrando 8 últimas)";
		document.getElementById('muestraTodoTexto').innerHTML = ' <a onclick="mostrarTodasLasEncuestas()">&nbsp;&nbsp;&nbsp;Mostrar todo</a>';
		document.getElementById('tablaEncuestasTodas').style.display = "none";
		document.getElementById('tablaEncuestas10Ultimas').style.display = "table";
	}
	abc=abc+1;
}
function mostrarTodasLasCanciones(){
	if(cde%2==0){
		document.getElementById('muestraCuantasTexto1').innerHTML = " (mostrando todo)";
		document.getElementById('muestraTodoTexto1').innerHTML = ' <a onclick="mostrarTodasLasCanciones()">&nbsp;&nbsp;&nbsp;Mostrar sólo 6</a>';
		document.getElementById('tabla2014_07_19_canciones0Ultimas').style.display = "none";
		document.getElementById('tablaCancionesTodas').style.display = "table";
	}
	else{
		document.getElementById('muestraCuantasTexto1').innerHTML = " (mostrando 6 últimas)";
		document.getElementById('muestraTodoTexto1').innerHTML = ' <a onclick="mostrarTodasLasCanciones()">&nbsp;&nbsp;&nbsp;Mostrar todo</a>';
		document.getElementById('tablaCancionesTodas').style.display = "none";
		document.getElementById('tabla2014_07_19_canciones0Ultimas').style.display = "table";
	}
	cde=cde+1;
}
function mostrarTodosLosArchivos(){
	if(def%2==0){
		document.getElementById('muestraCuantasTexto2').innerHTML = " (mostrando todo)";
		document.getElementById('muestraTodoTexto2').innerHTML = ' <a onclick="mostrarTodosLosArchivos()">&nbsp;&nbsp;&nbsp;Mostrar sólo 6</a>';
		document.getElementById('tablaArchivos10Ultimos').style.display = "none";
		document.getElementById('tablaArchivosTodos').style.display = "table";
	}
	else{
		document.getElementById('muestraCuantasTexto2').innerHTML = " (mostrando 6 últimas)";
		document.getElementById('muestraTodoTexto2').innerHTML = ' <a onclick="mostrarTodosLosArchivos()">&nbsp;&nbsp;&nbsp;Mostrar todo</a>';
		document.getElementById('tablaArchivosTodos').style.display = "none";
		document.getElementById('tablaArchivos10Ultimos').style.display = "table";
	}
	def=def+1;
}