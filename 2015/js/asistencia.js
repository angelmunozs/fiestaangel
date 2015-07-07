$(document).ready(function() {
	$.get('acciones/confirma_asistencia.php', function(result) {
		if(result.length == 0) {
			$('#confirma-asistencia').fadeIn()
		}
	})
})