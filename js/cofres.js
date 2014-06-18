var cofresId = [];
var cofres = [];

function cargarCofres(dataCofres){
	var index = 0;
	//buscar en los cofres viejos, si existen en la lista de nuevos cofres
	for(var cofre in cofresId){
		if(!buscarCofre(cofresId[cofre], dataCofres)){//no existe... Ya es un ataque viejo
			cofresId.splice(index, 1);
			scene.remove( cofres[index] );
			cofres.splice(index, 1);
		}
		index = index + 1;
	}


	//Solo los cofres nuevos, incorporarlos a la lista
	index = 0;
	for(var cofre in dataCofres){
		if(!buscarCofrePlus(dataCofres[cofre].id, cofresId)){
			cofresId.push(dataCofres[cofre].id);
			jsonLoader.load( "./models/cofre.js", agregarCofre(dataCofres[cofre].posX, dataCofres[cofre].posY));
		}else{
			reubicarCofre(cofres[index], dataCofres[cofre].posX, dataCofres[cofre].posY);
		}
		index = index + 1;
	}	

}

function reubicarCofre(unCofre, posX, posY){
	unCofre.position.x = posX;
	unCofre.position.z = posY;
}

function buscarCofre(unCofre, dataCofres){
	for(var cofre in dataCofres){
		if (dataCofres[cofre].id == unCofre){
			return true;
		}
	}
	return false;
}

function buscarCofrePlus(unCofre, dataCofres){
	for(var cofre in dataCofres){
		if (dataCofres[cofre] == unCofre){
			return true;
		}
	}
	return false;
}

function agregarCofre(posX, posY){
	return function(geometry, materials){
		crearCofre(geometry, materials, posX, posY);
	}
}

function crearCofre(geometry, materials, posX, posY){
	var material = new THREE.MeshFaceMaterial( materials );
	var cofre = new THREE.Mesh( geometry, material );
	cofre.scale.set(10,10,10);
	cofre.position.set(posX,-8,posY); 
	scene.add( cofre );
	cofres.push( cofre );
}