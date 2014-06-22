$(function() {
	$('#form-identificarse').click(function(e){

		//loading button
		var l = Ladda.create(this);
	 	l.start();


	    var postData = $("#formularioIdentificarse").serializeArray();
	    var formURL = $("#formularioIdentificarse").attr("action");
	    $.ajax(
	    {
	        url : formURL,
	        type: "POST",
	        data : postData,
	        success:function(data, textStatus, jqXHR)
	        {
	            //data: return data from server
	            if (cleanString(data) == "ok"){
	            	location.href = './game.htm';
	            }else{
					$("#formIdentificarseError").html(data);
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


function validarIdentificacion(){
	$("#formIdentificarseMail").removeClass('error');
	$("#formIdentificarseClave").removeClass('error');

	if(!(IsEmail($("#formIdentificarseMail").val()))){
		$("#formIdentificarseMail").focus();
		$("#formIdentificarseMail").addClass('error');
		return 'Completar el campo Mail';
	}	
	if(!($("#formIdentificarseClave").val().length >= 6)){
		$("#formIdentificarseClave").focus();
		$("#formIdentificarseClave").addClass('error');
		return 'Completar el campo Clave. Minimo 6 caracteres';
	}	
	return true;
}