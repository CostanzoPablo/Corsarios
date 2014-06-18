var pescasId = [];
var pescas = [];

function cargarPesca(dataPescas){
	var index = 0;
	//buscar en los pescas viejos, si existen en la lista de nuevos pescas
	for(var pesca in pescasId){
		if(!buscarPesca(pescasId[pesca], dataPescas)){//no existe... Ya es un ataque viejo
			pescasId.splice(index, 1);
			scene.remove( pescas[index] );
			pescas.splice(index, 1);
		}
		index = index + 1;
	}

	//Solo los pescas nuevos, incorporarlos a la lista
	index = 0;
	for(var pesca in dataPescas){
		if(!buscarPescaPlus(dataPescas[pesca].id, pescasId)){
			pescasId.push(dataPescas[pesca].id);
			jsonLoader.load( "./models/Red.js", agregarPesca(dataPescas[pesca].posX, dataPescas[pesca].posY, "./models/Red.png"));
		}else{
			reubicarPesca(pescas[index], dataPescas[pesca].posX, dataPescas[pesca].posY);
		}
		index = index + 1;
	}	

}

function mostrarRedes(){
		$("#dialog").dialog("open");
		openObject('loading');
		$.ajax({
			url: './mostrarRedes.php',
			context: document.body
			}).done(function( data ) {
				closeObject('loading');
				var dataParsed = JSON.parse(cleanString(data));
				//dibujarRadar(dataParsed.enemigs);
				$("#dialog").dialog('option', 'title', 'Ubicacion de tus redes');
				$("#dialog").html('');
				for(var enemig in dataParsed){	
					$("#dialog").append('<div style="white-space: nowrap;" onclick="viajar(' + parseInt(dataParsed[enemig].posX) + ', ' + parseInt(dataParsed[enemig].posZ) + ');">' + ' Grados: ' + parseInt(dataParsed[enemig].grados) + ' &deg; Coordenadas: ' + parseInt(dataParsed[enemig].posXreal) + ':' + parseInt(dataParsed[enemig].posYreal) + ' -> VIAJAR ' + dataParsed[enemig].distancia + ' km</div>');
				}
		});		
}

function reubicarPesca(unaPesca, posX, posY){
	unaPesca.position.x = posX;
	unaPesca.position.z = posY;
}

function buscarPesca(unaPesca, dataPescas){
	for(var pesca in dataPescas){
		if (dataPescas[pesca].id == unaPesca){
			return true;
		}
	}
	return false;
}

function buscarPescaPlus(unaPesca, dataPescas){
	for(var pesca in dataPescas){
		if (dataPescas[pesca] == unaPesca){
			return true;
		}
	}
	return false;
}

function agregarPesca(posX, posY, textura){
	return function(geometry, materials){
		crearPesca(geometry, materials, posX, posY, textura);
	}
}

function crearPesca(geometry, materials, posX, posY, textura){
	var texture = new THREE.ImageUtils.loadTexture( textura );
	var material = new THREE.MeshBasicMaterial({map:texture});
	var pesca = new THREE.Mesh( geometry, material );
	pesca.scale.set(20,20,20);
	pesca.position.set(posX,3,posY); 
	scene.add( pesca );
	pescas.push( pesca );
}