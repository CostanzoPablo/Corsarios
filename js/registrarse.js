$(function() {
	$('#form-registrarse').click(function(e){

		var validacion = validarRegistro();

		if (validacion != true){
			$("#formRegistrarseError").html(validacion);
			return false;
		}

		//loading button
		var l = Ladda.create(this);
	 	l.start();


	    var postData = $("#formularioRegistrarse").serializeArray();
	    var formURL = $("#formularioRegistrarse").attr("action");
	    $.ajax(
	    {
	        url : formURL,
	        type: "POST",
	        data : postData,
	        success:function(data, textStatus, jqXHR)
	        {
	            if (cleanString(data) == "ok"){
	            	location.href = './game.htm';
	            }else{
	            	if (cleanString(data) == "logout"){
						$("#formRegistrarseError").html('Imposible registrarse. Ya estas identificado con otra cuenta <a href="./logout.php" target="_blank">LOGOUT</a>');
	            	}else{
	            		if (cleanString(data) == "existeNick"){
	            			$("#formRegistrarseError").html('Ya esta en uso el nick ingresado');
	            		}else{
	            			if (cleanString(data) == "existeMail"){
	            				$("#formRegistrarseError").html('Ya esta en uso el mail ingresado');	
	            			}else{
	            				$("#formRegistrarseError").html(data);
	            			}
	            		}
	            	}
	            }
	            l.stop();
	        },
	        error: function(jqXHR, textStatus, errorThrown)
	        {
	            l.stop();     
	        }
	    });
	 	
	 	return false;
	});
});


function validarRegistro(){

	$("#registrarseNick").removeClass('error');
	$("#registrarseMail").removeClass('error');
	$("#registrarseClave").removeClass('error');
	$("#registrarseRclave").removeClass('error');

	if(!($("#registrarseNick").val().length > 2)){
		$("#registrarseNick").focus();
		$("#registrarseNick").addClass('error');
		return 'Completar el campo Nick';
	}	
	if(!(IsEmail($("#registrarseMail").val()))){
		$("#registrarseMail").focus();
		$("#registrarseMail").addClass('error');
		return 'Completar el campo Mail';
	}	
	if(!($("#registrarseClave").val().length >= 7)){
		$("#registrarseClave").focus();
		$("#registrarseClave").addClass('error');
		return 'Completar el campo Clave. Minimo 6 caracteres';
	}	
	if(!($("#registrarseClave").val() == $("#registrarseRclave").val())){
		$("#registrarseRclave").focus();
		$("#registrarseRclave").addClass('error');
		return 'Completar el campo Repetir Clave igual que en el campo Clave';
	}		
	if(!($("#formRegistrarseAcepto").is(':checked'))) { 
		$("#formRegistrarseAcepto").focus();
		$("#formRegistrarseAcepto").addClass('error');
		return 'Para poder registrarte, tenes que Aceptar los Términos y condiciones';
	}
	return true;
}