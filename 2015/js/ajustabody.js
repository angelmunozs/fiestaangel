if (screen.width < 960) {
	document.write('<body style="background-image:url(');
	document.write("'imagenes/background_movil.jpg'");
	document.write(');background-repeat:repeat;background-attachment:fixed;background-position:center top;">');
}
else {
	document.write('<body style="background-image:url(');
	document.write("'imagenes/background.jpg'");
	document.write(');background-repeat:no-repeat;background-attachment:fixed;background-position:center top;">');
}