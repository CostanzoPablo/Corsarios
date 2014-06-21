var mensajes = null;
var playerId = null;
function cargarPlayerData(dataPlayer, dataWaypoint, dataMensajes){
	if (virarUpdater == true){//pasaron 5 segundos de clickearlo
		virar = parseInt((dataPlayer.direction * 360) / 6.3);
	}
	mensajes = dataMensajes;
	playerId = dataPlayer.id;

	/*$("#infoButton").html('<div id="menu_superior">' + 
	'&nbsp;<div id="menu_nick">' + dataPlayer.nick + '</div>' + 
	'&nbsp;<div id="menu_coordenadas">Coordenadas: ' + dataPlayer.posX + ':' + dataPlayer.posZ + '</div>' +
	'&nbsp;<div id="menu_destino">Destino:' + ~~(dataWaypoint.x + dataPlayer.posX) + ':' +  ~~(dataWaypoint.y + dataPlayer.posZ) + '</div>' + 
	'&nbsp;<div id="menu_oro">Oro:' + dataPlayer.oro + '</div>' + 
	'&nbsp;<div id="menu_redes" onclick="mostrarRedes();">Redes:' + dataPlayer.redesUsadas + '/' +  dataPlayer.redesTotal + '</div>' + 
	'&nbsp;<div id="menu_vida">Vida:' + dataPlayer.vida + '%' +  ' de ' + dataPlayer.vidaTope + '</div>' + 	
	'&nbsp;<div id="menu_virar">Virar:</div>' +
	'&nbsp;<div id="menu_vizquierda" onclick="virarIzquierda();">&lt;-</div>' + 
	'&nbsp;<div id="menu_virargrados">' + virar +'&deg;</div>' + 
	'&nbsp;<div id="menu_vderecha" onclick="virarDerecha();">-&gt;</div>' + 
	'&nbsp;<div id="menu_periscopio" onclick="buscarEnemigos();">PERISCOPIO</div>' + 
	'&nbsp;<div id="menu_mensajes" onclick="mostrarMensajes();">MENSAJES (' + mensajes.length + ')</div>' + 
	'&nbsp;<div id="menu_logout" onclick="logout();">LOGOUT</div>' + 
	'</div>');*/

	$("#infoButton").html('<div id="menu_superior">' + '<div id="menu_mensaje" onmousedown="mostrarMensajes();return false;">MENSAJES (' + mensajes.length + ')</div>' + '<div id="menu_nick">' + dataPlayer.nick + '</div>' + '<div id="menu_logout" onmousedown="logout();return false;">LOGOUT</div>' + '</div>');
	$("#infoButton").append('<div id="menu_secundario">' + '<div id="menu_oro">Oro: ' + dataPlayer.oro + '</div>' + '<div id="menu_vida">Vida: ' + dataPlayer.vida + '%' +  ' de ' + dataPlayer.vidaTope + '</div>' + '</div>');
	
	var destinoTiempo = (Math.abs(dataWaypoint.x) + Math.abs(dataWaypoint.y)) / 2;
	if (isNaN(destinoTiempo)){
	    destinoTiempo = "Anclado";
	}else{
    	if (destinoTiempo < 60){
    	   destinoTiempo = parseInt(destinoTiempo) + " segundos";
    	}else{
    	   destinoTiempo = (destinoTiempo / 60);
    	   if (destinoTiempo < 60){
    	   	  destinoTiempo = parseInt(destinoTiempo) + " minutos";
    	   }else{
    	      destinoTiempo = (destinoTiempo / 60);
    	      if (destinoTiempo <= 1){
    	      	 destinoMinutos = parseInt((destinoTiempo - parseInt(destinoTiempo)) * 60);
    	         destinoTiempo = parseInt(destinoTiempo) + " hora" + destinoMinutos + " minutos";
    	      }else{
    	      	 destinoMinutos = parseInt((destinoTiempo - parseInt(destinoTiempo)) * 60);
    	         destinoTiempo = parseInt(destinoTiempo) + " horas" + destinoMinutos + " minutos";
    	      }
    	   }
    	}
	}
	$("#infoButton").append('<div id="menu_inferior"><div id="menu_camera">&nbsp;</div>' + '<div id="inferior_int">' + '<div id="menu_redes" onmousedown="mostrarRedes();return false;">Redes: ' + dataPlayer.redesUsadas + '/' +  dataPlayer.redesTotal + '</div>' + '<div id="menu_enemigos" onMouseover="disableMouseClick();" onMouseout="enableMouseClick();"></div>' + '<div id="menu_coordenadas">Coordenadas: ' + dataPlayer.posX + ':' + dataPlayer.posZ + '</div>' + '<div id="menu_destino">Destino: ' + destinoTiempo + '</div>' + '</div>' + '</div>');
	radarRotar(camaraGrados);//fix, para no esperar hasta que renderize, lo ubicamos ya de ahora

	$('#menu_container').width ($( document ).width());
}