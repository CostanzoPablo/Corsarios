var mobs = [];

function cargarMobs(dataMobs){
	var index = 0;
	var existe;
	//buscar en los mobs viejos, si existen en la lista de nuevos mobs
	for(var mob in mobs){
		existe = false;
		for(var newmob in dataMobs){
			if (mobs[mob]["id"] == dataMobs[newmob].id){
				existe = true;
			}
		}

		if(existe == false){//no existe...
			if (targetId == mobs[index]["object"]["id"]){		
				targetId = null;
				$("#dialog").dialog('close');
			}			
			scene.remove( mobs[index]['object'] );
			mobs.splice(index, 1);
		}
		index = index + 1;
	}


	index = 0;
	//Solo los mobs nuevos, incorporarlos a la lista
	for(var newmob in dataMobs){
		existe = false;
		for(var mob in mobs){
			if (mobs[mob]["id"] == dataMobs[newmob].id){
				existe = true;
				mobs[mob]["vida"] = dataMobs[newmob].vida;
				reubicarMob(mobs[mob]["object"], dataMobs[newmob].posX, dataMobs[newmob].posY, dataMobs[newmob].direction);
			}
		}

		if(existe == false){//no existe... 
			jsonLoader.load( "./models/" + dataMobs[newmob].model + ".js", agregarMob(dataMobs[newmob].posX, dataMobs[newmob].posY, dataMobs[newmob].direction, "./models/" + dataMobs[newmob].model + ".png", dataMobs[newmob].id, dataMobs[newmob].vida));
		}
		index = index + 1;
	}
}

function listarMobsId(){
	var retorno = [];
	for(var mob in mobs){
		retorno.push (mobs[mob]["object"]);
	}
	return retorno;
}

function buscarMobVidaxId(objectId){
	for(var mob in mobs){
		if (mobs[mob]["id"] == objectId){
			return mobs[mob]["vida"];
		}
	}
	return false;
}

function buscarMobIdxId(objectId){
	for(var mob in mobs){
		if (mobs[mob]["object"]["id"] == objectId){
			return mobs[mob]["id"];
		}
	}
	return false;
}

function reubicarMob(unMob, posX, posY, direction){
	unMob.position.x = posX;
	unMob.position.z = posY;
	unMob.rotation.y = direction;
}


function agregarMob(posX, posY, direction, textura, id, vida){
	return function(geometry, materials){
		crearMob(geometry, materials, posX, posY, direction, textura, id, vida);
	}
}

function crearMob(geometry, materials, posX, posY, direction, textura, id, vida){
	var texture = new THREE.ImageUtils.loadTexture( textura );
	var material = new THREE.MeshLambertMaterial({map:texture});
	var mob = new THREE.Mesh( geometry, material );
	mob.scale.set(100,100,100);
	mob.rotation.y += direction;
	mob.position.set(posX,-8,posY);
	scene.add( mob );
	
	var amob = [];
	amob["id"] = id;
	amob["vida"] = vida;
	amob["object"] = mob; 
	//console.log(amob["id"] + "->" + amob["vida"] + ' X:' + posX + 'Y:' + posY);
	mobs.push( amob );
}