window.onload = function (){
	if (screen.width < 960) {
		document.getElementById('loader').style.display="none";
		document.getElementById('cuerpo').className="option animated fadeIn";
		document.getElementById('cuerpo').style.display="block";
		document.getElementById('solopc').style.display="none";
		document.getElementById('solomovil').className="option animated fadeIn";
		document.getElementById('solomovil').style.display="block";
		//document.write('<?php include "includes/infomovil.php"; ?>');
	}
	else {
		document.getElementById('loader').style.display="none";
		document.getElementById('cuerpo').className="option animated fadeIn";
		document.getElementById('cuerpo').style.display="block";
		document.getElementById('solomovil').style.display="none";
		document.getElementById('solopc').className="option animated fadeIn";
		document.getElementById('solopc').style.display="block";
		//document.write('<?php include "includes/infopc.php"; ?>');
	}
}