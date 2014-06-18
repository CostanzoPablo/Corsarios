function loginMenu(){
	$("#dialog").dialog('option', 'title', 'Identificarse');
	$("#dialog").html('<div id="login" align="center"><input type="text" placeholder="Nick" id="nick"><br><input type="password" placeholder="Password" id="pass"><br><input type="button" value="IDENTIFICARSE" onclick="loginSend();"><br><br><input type="button" value="REGISTRARSE" onclick="registrarseMenu();"></div>');
	$("#dialog").dialog('open');
	$("#nick").focus();
}

function loginSend(){
	openObject('loading');
	$.ajax({
		url: './login.php?nick=' + $("#nick").val() + '&pass=' + $("#pass").val(),
		context: document.body
		}).done(function( data ) {
			closeObject('loading');
			if (cleanString(data) == "login"){				
				alert('Error. El Nick o el password son incorrectos');
				loginMenu();
				return false;
			}
			if (cleanString(data) != 'ok'){
				alert('Estado inesperado. Respuesta del servidor: ' + data);
				return false;
			}else{
				//autentificado
				$("#dialog").dialog('close');
			}
		});	
}


function checkLogin(dataLogin){
	if (dataLogin == "login"){				
		if (!$("#dialog").dialog('isOpen')){
			alert('Error. Se perdio la sesion. Identificarse nuevamente');
			loginMenu();
		}
		return false;
	}
	if (dataLogin != 'ok'){
		if (!$("#dialog").dialog('isOpen')){
			alert('Estado inesperado. Respuesta del servidor: ' + dataLogin);
		}
		return false;
	}
	return true;
}