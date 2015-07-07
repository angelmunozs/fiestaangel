  $(document).ready(function() {
		//the min chars for username
		var min_chars = 5;
		//result texts
		var characters_error = '<span style="color:#fff">5 caracteres como mínimo</span>';
		var checking_html = '<img src="imagenes/loading.gif" /><span style="color:#fff"> Comprobando...</span>';
		//when button is clicked
		$('#form_usuario').blur(function(){
			//run the character number check
			if($('#form_usuario').val().length < min_chars){
				//if it's bellow the minimum show characters_error text
				$('#username_availability_result').html(characters_error);
			}
			else{			
				//else show the cheking_text and run the function to check
				$('#username_availability_result').html(checking_html);
				check_username_availability();
			}
		});
  });
//function to check username availability	
function check_username_availability(){
		//get the username
		var form_usuario = $('#form_usuario').val();
		//use ajax to run the check
		$.post("acciones/existe_invitado.php", { form_usuario: form_usuario },
			function(result){
				//if the result is 1
				if(result == 1){
					//show that the username is available
					$('#username_availability_result').html('<span class="no_invitado"><img src="imagenes/wrong.gif" style="padding-right:10px;vertical-align:middle;" /><b>' +form_usuario + '</b> no está invitado</span>');
				}
				else{
					//show that the username is NOT available
					$('#username_availability_result').html('<span class="si_invitado"><img src="imagenes/right.gif" style="padding-right:10px;vertical-align:middle;" /><b>' +form_usuario + '</b> está invitado</span>');
				}
		});
}  