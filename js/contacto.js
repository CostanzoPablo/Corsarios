$(function() {
	$('#form-contacto').click(function(e){

		var validacion = validarContacto();

		if (validacion != true){
			$("#formContactoError").html(validacion);
			return false;
		}

		//loading button
		var l = Ladda.create(this);
	 	l.start();


	    var postData = $("#formularioContacto").serializeArray();
	    var formURL = $("#formularioContacto").attr("action");
	    $.ajax(
	    {
	        url : formURL,
	        type: "POST",
	        data : postData,
	        success:function(data, textStatus, jqXHR)
	        {
	            if (cleanString(data) == "ok"){
	            	location.href = './index.htm';
	            }else{
     				$("#formContactoError").html(data);
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


function validarContacto(){

	$("#contactoMensaje").removeClass('error');
	$("#contactoMail").removeClass('error');

	if(!($("#contactoMensaje").val().length > 2)){
		$("#contactoMensaje").focus();
		$("#contactoMensaje").addClass('error');
		return 'Completar el campo Mensaje';
	}	
	if(!(IsEmail($("#contactoMail").val()))){
		console.log($("#contactoMail").val());
		$("#contactoMail").focus();
		$("#contactoMail").addClass('error');
		return 'Completar el campo Mail';
	}	
	return true;
}