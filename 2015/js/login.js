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
function escondeMensajes(){
	document.getElementById('username_availability_result').innerHTML = "";
}