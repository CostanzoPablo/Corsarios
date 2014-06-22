function mostrarMensajes(){
	$("#dialog").dialog('option', 'title', 'Mensajes');
	$("#dialog").html('');
	var index=0;
	for(var mensaje in mensajes){		
		$("#dialog").append('<div onclick="leerMensaje(\'' + index + '\');"><img width="32" height="25" src="./images/leido_' + parseInt(mensajes[mensaje].leido) + '.png"> ' + mensajes[mensaje].fecha + ' - ' + mensajes[mensaje].titulo + '</div>');
		index = index + 1;
	}
	$("#dialog").dialog('open');	
}

function leerMensaje(unMensaje){
	marcarMensaje(mensajes[unMensaje].id);
	$("#dialog").html(mensajes[unMensaje].fecha + ' - ' + mensajes[unMensaje].titulo + '<br>' + mensajes[unMensaje].mensaje + '<br>' + '<div onclick="eliminarMensaje(\'' + mensajes[unMensaje].id + '\');">BORRAR</div>');
}

function eliminarMensaje(unIdMensaje){
		openObject('loading');
		$.ajax({
			url: './borrarMensaje.php?mensaje=' + unIdMensaje,
			context: document.body
			}).done(function( data ) {
				//lo borro...
				mensajes = JSON.parse(cleanString(data));
				closeObject('loading');
				mostrarMensajes();
		});	
}

function marcarMensaje(unIdMensaje){
		$.ajax({
			url: './marcarMensaje.php?mensaje=' + unIdMensaje,
			context: document.body
			}).done(function( data ) {
				//lo marco como leido...
				mensajes = JSON.parse(cleanString(data));
		});	
}