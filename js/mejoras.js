function mejoras(){
		openObject('loading');
		$.ajax({
			url: './checkMejoras.php',
			context: document.body
			}).done(function( data ) {
				$("#dialog").html(cleanString(data));				
				closeObject('loading');
		});		
}

function mejorar(unaMejora){
		openObject('loading');
		$.ajax({
			url: './mejorar.php',
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