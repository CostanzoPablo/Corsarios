function registrarseMenu(){
	$("#dialog").dialog('option', 'title', 'Registrarse');
	$("#dialog").html('<div id="login" align="center"><input type="text" placeholder="Mail" id="mail"><input type="text" placeholder="Nick" id="nick"><br><input type="password" placeholder="Password" id="pass"><input type="password" placeholder="Repetir Password" id="rpass"><br><input type="button" value="REGISTRARSE" onclick="registrarseSend();"></div>');
	$("#dialog").dialog('open');
	$("#mail").focus();
}
//011-65150202 42552940
function registrarseSend(){
	if ($("#pass").val() != $("#rpass").val()){
		alert('Error. El campo Password es diferente del de Repetir Password');
		return false;
	}
	openObject('loading');
	$.ajax({
		url: './registrarse.php?mail=' + $("#mail").val() + '&nick=' + $("#nick").val() + '&pass=' + $("#pass").val(),
		context: document.body
		}).done(function( data ) {
			closeObject('loading');
			if (cleanString(data) == "existeNick"){				
				alert('Error. El Nick ' + $("#nick").val() + ' ya esta utilizado');
				return false;
			}
			if (cleanString(data) == "logout"){				
				alert("No podes registrarte, ya tenes una cuenta identificada en el sistema");
				return false;
			}
			if (cleanString(data) == "password"){				
				alert("El Password tiene que contener al menos 8 caracteres");
				return false;
			}
			if (cleanString(data) == "mail"){				
				alert("El Mail no es valido");
				return false;
			}			
			if (cleanString(data) == "existeMail"){				
				alert('Error. El Mail ' + $("#mail").val() + ' ya esta utilizado');
				return false;
			}			
			if (cleanString(data) != 'ok'){
				alert('Estado inesperado. Respuesta del servidor: ' + data);
				return false;
			}else{
				//autentificado
				alert('Registrado correctamente. Se te identifico automaticamente. Un mail se envio a tu correo para confirmar registro.');
				$("#dialog").dialog('close');
			}
		});
}