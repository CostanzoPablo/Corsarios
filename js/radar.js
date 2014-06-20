var camaraGrados;

/*function buscarEnemigos(){
		$("#dialog").dialog("open");
		openObject('loading');
		$.ajax({
			url: './radar.php',
			context: document.body
			}).done(function( data ) {
				closeObject('loading');
				var dataParsed = JSON.parse(cleanString(data));
				//dibujarRadar(dataParsed.enemigs);
				$("#dialog").dialog('option', 'title', 'Reporte del Periscopio - Radio 10 KM');
				$("#dialog").html('');
				var index=0;
				for(var enemig in dataParsed){
					if (index > 0){	
						$("#dialog").append('<div style="white-space: nowrap;" onclick="viajar(' + parseInt(dataParsed[enemig].posX) + ', ' + parseInt(dataParsed[enemig].posZ) + ');">' + dataParsed[enemig].nick + ' Grados: ' + parseInt(dataParsed[enemig].grados) + ' &deg; Coordenadas: ' + parseInt(dataParsed[enemig].posXreal) + ':' + parseInt(dataParsed[enemig].posYreal) + ' -> VIAJAR ' + dataParsed[enemig].distancia + ' km</div>');
					}
					index=index+1;
				}
		});		
}*/

function radarLimpiar(){
	$("#menu_enemigos").html('');
}


function radarAgregar(unEnemigoId, unEnemigo, unEnemigoTop, unEnemigoLeft){
	var enemigoTop = ((unEnemigoTop + 10000) * 150) / 20000;
	var enemigoLeft = ((unEnemigoLeft + 10000) * 150) / 20000;

	if (unEnemigoId == playerId){
		var iconoPlayer = 'menu_player';
	}else{
		var iconoPlayer = 'menu_enemigo';
	}

	$("#menu_enemigos").append('<div class="' + iconoPlayer + '" style="top:' + enemigoTop + 'px;left:' + enemigoLeft + 'px;" onclick="viajar(' + unEnemigoTop + ', ' + unEnemigoLeft + ');">&nbsp;</div>');
}

function checkRadarEnemigs(dataEnemigs, playerDirection){
	radarLimpiar();
	//var virar = parseInt((playerDirection * 360) / 6.3)+90;
	var virar = rad2deg(playerDirection)+90;
	radarDireccion(virar);
	for(var enemig in dataEnemigs){	
		radarAgregar(dataEnemigs[enemig].id, dataEnemigs[enemig].nick, dataEnemigs[enemig].posX, dataEnemigs[enemig].posZ);
	}
}

function radarRotar(rotarGrados){
	camaraGrados = rotarGrados;

	var virar = rad2deg(rotarGrados);
	//console.log(virar);
	virar = (virar * -1) + 45;
	var div = document.getElementById('menu_camera');
	if (div){
		div.style.webkitTransform = 'rotate('+virar+'deg)'; 
	    div.style.mozTransform    = 'rotate('+virar+'deg)'; 
	    div.style.msTransform     = 'rotate('+virar+'deg)'; 
	    div.style.oTransform      = 'rotate('+virar+'deg)'; 
	    div.style.transform       = 'rotate('+virar+'deg)';	
    }
}

function radarDireccion(gradosDireccion){
	gradosDireccion = (gradosDireccion * -1) - 225;
	$("#menu_inferior").append('<div id="menu_direction">&nbsp;</div>');
	
    var div = document.getElementById('menu_direction');

    div.style.webkitTransform = 'rotate('+gradosDireccion+'deg)'; 
    div.style.mozTransform    = 'rotate('+gradosDireccion+'deg)'; 
    div.style.msTransform     = 'rotate('+gradosDireccion+'deg)'; 
    div.style.oTransform      = 'rotate('+gradosDireccion+'deg)'; 
    div.style.transform       = 'rotate('+gradosDireccion+'deg)';
}