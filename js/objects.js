var objects = [];
//var objectsId = [];
//var objectsName = [];
//var objectsVida = [];
var waypoint;

var ataques = [];
var target=null;
var targetId=null;
var glowTarget;

function crearWaypoint(geometry, materials, posX, posY, posZ, direction){
	var material = new THREE.MeshFaceMaterial( materials );
	waypoint = new THREE.Mesh( geometry, material );
	waypoint.scale.set(20,20,30);
	waypoint.position.set(posX,posY,posZ); 
	scene.add( waypoint );
	waypoint.rotation.y += direction;
}

function reubicarWaypoint(posX, posY, posZ, direction){
	waypoint.position.set(posX,posY,posZ);
	waypoint.rotation.y = direction;
}

function eliminarWaypoint(){
	scene.remove(waypoint);
}

function crearBarco(geometry, materials, posX, posY, posZ, direction, objectId, objectName, objectVida, textura){
	//var material = new THREE.MeshFaceMaterial( materials );
	var texture = new THREE.ImageUtils.loadTexture( textura );
	//var material = new THREE.MeshBasicMaterial({map:texture});
	var material = new THREE.MeshLambertMaterial({map:texture});
	var barco = new THREE.Mesh( geometry, material );
	barco.castShadow = true;
	barco.receiveShadow = true;
	barco.scale.set(10,10,10);
	barco.position.set(posX,posY,posZ);
	var objeto = [];
	objeto["id"] = objectId;
	objeto["nombre"] = objectName;
	objeto["vida"] = objectVida;
	objeto["object"] = barco; 
	scene.add( barco );
	//objectsId[barco['id']] = objectId;
	//objectsName[barco['id']] = objectName;
	//objectsVida[barco['id']] = objectVida;	
	objects.push( objeto );
	barco.rotation.y += direction;
	barco.rotation.x = 0;
}

function undir(objectName, x, y){
	for(var object in objects){
		if (objects[object]["nombre"] == objectName){
			objects[object]["object"].rotation.x = x;
			objects[object]["object"].position.y = -1 * y;
			if (targetId == objects[object]["object"]["id"]){		
				targetId = null;
				$("#dialog").dialog('close');
			}
		}
	}	
}

function reubicarBarco(objectName, posX, posY, posZ, direction, vida, viajeX, viajeZ){
	for(var object in objects){
		if (objects[object]["nombre"] == objectName){
			objects[object]["vida"] = vida;
			objects[object]["object"].rotation.y = direction;
			objects[object]["object"].rotation.x = 0;
			objects[object]["object"].position.set(posX,posY,posZ);
		}
	}
}

function animateObject(anObject, aPosX, aPosY, aPosZ, aTime){
	//console.log(aPosX + ', ' + aPosY + ', ' + aPosZ);
	setTimeout(function(){
	anObject.position.set(aPosX, aPosY, aPosZ)
	}, aTime);
}

/*function existeBarco(objectName){
	var consulta = buscarBarco(objectName);
	console.log("C:" + consulta);
	if (consulta == false){
		return false;
	}else{
		return true;
	}
}*/


function cleanOldEnemigs(enemigsList){
	var index=0;
	var delIndex = 0;
	for(var object in objects){
		existe = false;
		for(var enemig in enemigsList){
			if (enemigsList[enemig] == objects[object]["nombre"]){
				existe = true;
			}
		}
		
		if(existe == false){
			scene.remove(objects[object]["object"]);
			objects.splice(object, 1);
		}
		index = index + 1;
	}	
}


function buscarBarcoNombre(objectName){
	for(var object in objects){
		if (objects[object]["nombre"] == objectName){
			return true;
		}
	}
	return false;
}

function buscarBarcoNombrexId(objectId){
	for(var object in objects){
		if (objects[object]["id"] == objectId){
			return objects[object]["nombre"];
		}
	}
	return false;
}

function buscarBarcoIdxId(objectId){
	for(var object in objects){
		if (objects[object]["object"]["id"] == objectId){
			return objects[object]["id"];
		}
	}
	return false;
}

function buscarBarcoVidaxId(objectId){
	for(var object in objects){
		if (objects[object]["id"] == objectId){
			return objects[object]["vida"];
		}
	}
	return false;
}

function listarBarcosId(){
	var retorno = [];
	for(var object in objects){
		retorno.push (objects[object]["object"]);
	}
	return retorno;
}

/*function buscarBarcoId(objectName, objectsList){
	var index=0;
	for(var object in objectsList){
		if (objectsList[object] == objectName){
			return index;
		}
		index = index + 1;
	}
	return false;
}*/

function buscarCofreId(objectId, objectsList){
	var index=0;
	for(var object in objectsList){
		if (objectsList[object].id == objectId){
			return index;
		}
		index = index + 1;
	}
	return false;
}

function buscarMobsId(objectId, objectsList){
	var index=0;
	for(var object in objectsList){
		if (objectsList[object].id == objectId){
			return index;
		}
		index = index + 1;
	}
	return false;
}

function buscarPescaId(objectId, objectsList){
	var index=0;
	for(var object in objectsList){
		if (objectsList[object].id == objectId){
			return index;
		}
		index = index + 1;
	}
	return false;
}

/*function findObjectById(objectId){
	for(var object in objectsName){

	}
}*/

function addBarcoToScene(posX, posY, posZ, direction, objectId, objectName, objectVida, textura) 
{
	return function(geometry, materials){
		crearBarco(geometry, materials, posX, posY, posZ, direction, objectId, objectName, objectVida, textura);
		console.log('no existe ' + objectName + ' x:' + posX + ' y:' + posY);
	}
}

function addWaypointToScene(posX, posY, posZ, direction) 
{
	return function(geometry, materials){
		crearWaypoint(geometry, materials, posX, posY, posZ, direction);
	}
}

function targetRemoveGlow(){
	targetId=null;
	if (target){
		target.remove(glowTarget);
	}
}

function targetGlow(newTarget){
	targetRemoveGlow();
	// SUPER SIMPLE GLOW EFFECT
	// use sprite because it appears the same from all angles
	var spriteMaterial = new THREE.SpriteMaterial( 
	{ 
		map: new THREE.ImageUtils.loadTexture( 'images/glow.png' ), 
		useScreenCoordinates: true,
		color: 0xff0000, transparent: false, blending: THREE.AdditiveBlending
	});

	glowTarget = new THREE.Sprite( spriteMaterial );
	glowTarget.scale.set(300, 400, 0.1);
	

	newTarget.add(glowTarget);

	return newTarget;
}


function searchObjectClicked(event){
		event.preventDefault();

		var vector = new THREE.Vector3( ( event.clientX / window.innerWidth ) * 2 - 1, - ( event.clientY / window.innerHeight ) * 2 + 1, 1 );
		projector.unprojectVector( vector, camera );

		var raycaster = new THREE.Raycaster( camera.position, vector.sub( camera.position ).normalize() );

		var intersects;

		targetId = null;

		intersects = raycaster.intersectObjects( cofres );
		
		if ( intersects.length > 0 ) {//coicide con un cofre
			target = targetGlow(intersects[0]['object']);
			targetId = intersects[0]['object']['id'];
			$("#dialog").dialog('option', 'title', 'Objetivo: Cofre');
			$("#dialog").html('<div id="" onclick="javascript:capturarCofre(\'' + buscarCofreId(intersects[0]['object']['id'], cofres) + '\');">Capturar Cofre</div>');
			$("#dialog").dialog('open');
			return true;
		}


		intersects = raycaster.intersectObjects( listarMobsId() );
		
		if ( intersects.length > 0 ) {//coicide con un mob
			target = targetGlow(intersects[0]['object']);
			targetId = intersects[0]['object']['id'];
			$("#dialog").dialog('option', 'title', 'Objetivo: Mob');
			atacarMob(buscarMobIdxId(intersects[0]['object']['id']), buscarMobVidaxId(intersects[0]['object']['id']));
			$("#dialog").dialog('open');
			return true;
		}

		intersects = raycaster.intersectObjects( pescas );
			
		if ( intersects.length > 0 ) {//coicide con una red
			target = targetGlow(intersects[0]['object']);
			targetId = intersects[0]['object']['id'];
			$("#dialog").dialog('option', 'title', 'Objetivo: Pesca');
			$("#dialog").html('<div id="" onclick="javascript:capturarPesca(\'' + buscarPescaId(intersects[0]['object']['id'], pescas) + '\');">Capturar Pesca</div>');
			$("#dialog").dialog('open');
			return true;
		}		


		intersects = raycaster.intersectObjects( listarBarcosId() );

		if ( intersects.length > 0 ) {//coicide con un barco
			if (buscarBarcoIdxId(intersects[0]['object']['id']) == playerId){//Es tu barco
				target = targetGlow(intersects[0]['object']);
				targetId = intersects[0]['object']['id'];
				$("#dialog").dialog('option', 'title', 'Objetivo: ' + buscarBarcoNombrexId(intersects[0]['object']['id']) + ' Vida: ' + buscarBarcoVidaxId(intersects[0]['object']['id']) + '%');
				$("#dialog").html('<div id="" onclick="javascript:pescar();">PESCAR</div><br><br>' +
				'<div id="" onclick="javascript:mejoras();">MEJORAS</div>');
				$("#dialog").dialog('open');
				return true;
			}else{
				//coincide con un barco enemigo
				target = targetGlow(intersects[0]['object']);
				targetId = intersects[0]['object']['id'];
				$("#dialog").dialog('option', 'title', 'Objetivo: ' + buscarBarcoNombrexId(intersects[0]['object']['id']) + ' Vida: ' + buscarBarcoVidaxId(intersects[0]['object']['id']) + '%');
				
				$("#dialog").dialog('open');
				atacarEnemigo(buscarBarcoIdxId(intersects[0]['object']['id']), buscarBarcoNombrexId(intersects[0]['object']['id']), buscarBarcoVidaxId(intersects[0]['object']['id']));
				return true;				
			}
		}


		return false;
}

function buscarAtaque(unAtaque, unaLista){
	for(var object in unaLista){
		if (unaLista[object].id == unAtaque.id){
			return true;
		}
	}
	return false;
}

function cargarAtaques(ataquesList){
	var index = 0;
	//buscar en los ataques viejos, si existen en la lista de nuevos ataques
	for(var ataque in ataques){
		if(!buscarAtaque(ataques[ataque], ataquesList)){//no existe... Ya es un ataque viejo
			ataques.splice(index, 1);
		}
		index = index + 1;
	}


	//Solo los ataques nuevos, incorporarlos a la lista
	for(var ataque in ataquesList){
		if(!buscarAtaque(ataquesList[ataque], ataques)){
			ataques.push(ataquesList[ataque]);
			agregarDisparos(ataquesList[ataque].arma, ataquesList[ataque].origenX, ataquesList[ataque].origenY, ataquesList[ataque].posX, ataquesList[ataque].posY, ataquesList[ataque].direccion);
		}
	}	
}