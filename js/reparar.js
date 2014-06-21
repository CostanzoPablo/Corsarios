function reparar(){
		openObject('loading');
		$.ajax({
			url: './reparar.php',
			context: document.body
			}).done(function( data ) {
				closeObject('loading');
				if (cleanString(data) == "oro"){
					alert('Necesitas mas oro...');
					return false;
				}			
				if (cleanString(data) != 'ok'){
					alert('Estado inesperado. Respuesta del servidor: ' + data);
				}else{
					$("#dialog").dialog('close');
				}
		});		
}