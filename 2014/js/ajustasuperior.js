var anchurapantalla = screen.width;
var anchurapantalla1 = anchurapantalla*0.8;
if (screen.width < 768) {
	document.write('<table id="tablamenu" align="center" width="90%" cellpadding="0px" cellspacing="3px" style="font-size:23px">');
}
else{
	document.write('<table id="tablamenu" align="center" width="'+ anchurapantalla1 +'px" cellpadding="0px" cellspacing="3px" style="font-size:23px">');
}