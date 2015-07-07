var alturapantalla = window.innerHeight;
var anchurapantalla = screen.width;
var anchuramargen = anchurapantalla * 0.1;
var anchuracuerpo = anchurapantalla * 0.8;
if (screen.width < 768) {
	document.write('<div id="cuerpo" style="');
	document.write("display:none; margin-left:2%; margin-right:2%; min-height:"+alturapantalla+"px;");
	document.write('">');
}
else {
	document.write('<div align="center"><div id="cuerpo"  class="option animated fadeIn" style="');
	document.write("display:none; width:"+anchuracuerpo+"px; min-height:"+alturapantalla+"px;");
	document.write('">');
}