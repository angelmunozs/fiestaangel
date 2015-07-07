var mensajes = 0;
function escondeMensajes(){
	document.getElementById('username_availability_result').innerHTML = "";
}
function quitaTodo(){
	document.getElementById("notelo").style.display="none";
	document.getElementById("soyirlan").style.display="none";
	document.getElementById("marquess").style.display="none";
	document.getElementById("frankkvitta").style.display="none";
	document.getElementById("skrillex").style.display="none";
	document.getElementById("jorisvoorn").style.display="none";
	document.getElementById("donomar").style.display="none";
	document.getElementById("pitbull").style.display="none";
	document.getElementById("abrahammateo").style.display="none";
}
function muestraMarquess(){
	document.getElementById("notelo").style.display="none";
	document.getElementById("soyirlan").style.display="none";
	document.getElementById("frankkvitta").style.display="none";
	document.getElementById("jorisvoorn").style.display="none";
	document.getElementById("skrillex").style.display="none";
	document.getElementById("donomar").style.display="none";
	document.getElementById("pitbull").style.display="none";
	document.getElementById("abrahammateo").style.display="none";
	document.getElementById("marquess").className="option animated bounceIn";
	document.getElementById("marquess").style.display="block";
}
function muestraFrankKvitta(){
	document.getElementById("notelo").style.display="none";
	document.getElementById("soyirlan").style.display="none";
	document.getElementById("marquess").style.display="none";
	document.getElementById("jorisvoorn").style.display="none";
	document.getElementById("skrillex").style.display="none";
	document.getElementById("donomar").style.display="none";
	document.getElementById("pitbull").style.display="none";
	document.getElementById("abrahammateo").style.display="none";
	document.getElementById("frankkvitta").className="option animated bounceIn";
	document.getElementById("frankkvitta").style.display="block";
}
function muestraSkrillex(){
	document.getElementById("notelo").style.display="none";
	document.getElementById("soyirlan").style.display="none";
	document.getElementById("marquess").style.display="none";
	document.getElementById("jorisvoorn").style.display="none";
	document.getElementById("frankkvitta").style.display="none";
	document.getElementById("donomar").style.display="none";
	document.getElementById("pitbull").style.display="none";
	document.getElementById("abrahammateo").style.display="none";
	document.getElementById("skrillex").className="option animated bounceIn";
	document.getElementById("skrillex").style.display="block";
}
function muestraJorisVoorn(){
	document.getElementById("notelo").style.display="none";
	document.getElementById("soyirlan").style.display="none";
	document.getElementById("marquess").style.display="none";
	document.getElementById("skrillex").style.display="none";
	document.getElementById("frankkvitta").style.display="none";
	document.getElementById("donomar").style.display="none";
	document.getElementById("pitbull").style.display="none";
	document.getElementById("abrahammateo").style.display="none";
	document.getElementById("jorisvoorn").className="option animated bounceIn";
	document.getElementById("jorisvoorn").style.display="block";
}
function muestraAbrahamMateo(){
	document.getElementById("notelo").style.display="none";
	document.getElementById("soyirlan").style.display="none";
	document.getElementById("marquess").style.display="none";
	document.getElementById("skrillex").style.display="none";
	document.getElementById("frankkvitta").style.display="none";
	document.getElementById("donomar").style.display="none";
	document.getElementById("pitbull").style.display="none";
	document.getElementById("jorisvoorn").style.display="none";
	document.getElementById("abrahammateo").className="option animated bounceIn";
	document.getElementById("abrahammateo").style.display="block";
}
function muestraPitbull(){
	document.getElementById("notelo").style.display="none";
	document.getElementById("soyirlan").style.display="none";
	document.getElementById("marquess").style.display="none";
	document.getElementById("skrillex").style.display="none";
	document.getElementById("frankkvitta").style.display="none";
	document.getElementById("donomar").style.display="none";
	document.getElementById("abrahammateo").style.display="none";
	document.getElementById("jorisvoorn").style.display="none";
	document.getElementById("pitbull").className="option animated bounceIn";
	document.getElementById("pitbull").style.display="block";
}
function muestraDonOmar(){
	document.getElementById("notelo").style.display="none";
	document.getElementById("soyirlan").style.display="none";
	document.getElementById("marquess").style.display="none";
	document.getElementById("skrillex").style.display="none";
	document.getElementById("frankkvitta").style.display="none";
	document.getElementById("pitbull").style.display="none";
	document.getElementById("abrahammateo").style.display="none";
	document.getElementById("jorisvoorn").style.display="none";
	document.getElementById("donomar").className="option animated bounceIn";
	document.getElementById("donomar").style.display="block";
}
function otraBebida1(){
	document.getElementById("bebida1").style.display="none";
	document.getElementById("otrabebida1").className="option animated fadeIn";
	document.getElementById("otrabebida1").style.display="inline";
}
function otraBebida1Cancel(){
	document.getElementById("otrabebida1").style.display="none";
	document.getElementById("bebida1").style.display="inline";
}
function otraBebida2(){
	document.getElementById("bebida2").style.display="none";
	document.getElementById("otrabebida2").className="option animated fadeIn";
	document.getElementById("otrabebida2").style.display="inline";
}
function otraBebida2Cancel(){
	document.getElementById("otrabebida2").style.display="none";
	document.getElementById("bebida2").style.display="inline";
}
function noTeLoCrees(){
	document.getElementById("soyirlan").style.display="none";
	document.getElementById("notelo").className="option animated shake";
	document.getElementById("notelo").style.display="block";
}
function soyIrlandes(){
	document.getElementById("notelo").style.display="none";
	document.getElementById("soyirlan").className="option animated fadeIn";
	document.getElementById("soyirlan").style.display="block";
}
function muestraError(){
	mensajes++;
	if(mensajes==1){
		alert('Respuesta no válida. Ten cojones a intentarlo otra vez.');
		document.getElementById('aguantar').getElementsByTagName('option')[1].selected = 'selected'
	}
	else if(mensajes==2){
		alert('¡He dicho que no! ¡Te quedas hasta el final!');
		document.getElementById('aguantar').getElementsByTagName('option')[1].selected = 'selected'
	}
	else{
		alert('¡Vaya! Tenemos un mierdas en la lista de 2015_07_10_invitados.');
		document.getElementById('aguantar').getElementsByTagName('option')[1].selected = 'selected'
		document.getElementById('aguantar').style.display="none";
		document.getElementById('maricon').style.display="block";
		mensajes=0;
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
function confirmarReset(){
	var r=confirm("\xBFEst\xE1s seguro?\n\nLos valores guardados en la encuesta anterior se borrar\xE1n");
	if(r==true){
		return true;
	} 
	else{
		return false;
	} 
}