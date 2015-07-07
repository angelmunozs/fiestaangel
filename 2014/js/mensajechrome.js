var is_chrome = navigator.userAgent.toLowerCase().indexOf("chrome") > -1;
if (is_chrome) {
	document.write('<div align="center" id="avisoChrome" style="margin-left:30%; margin-right:30%; background-color:#fff; border:solid 2px #000; border-radius:15px; padding:15px;"><table align="center" width="100%" cellpadding="0px" cellspacing="0px"><tr><td align="left" width="60px"><img src="freeow/style/freeow/images/notice.png" /></td><td align="left" style="font-family:Arial; font-size:15px;"><b>Estás usando Google Chrome</b><br />Algunas funciones están desactivadas en tu navegador</td><td align="right" style="padding-right:3px; cursor:pointer;" valign="top"><img src="freeow/style/freeow/images/close.png" onclick="quitaAviso()" /></td></tr></table></div>');
}
function quitaAviso(){
	document.getElementById('avisoChrome').style.display="none";
}