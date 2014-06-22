var particulas = [];

function agregarDisparos(tipo, posX, posY, dposX, dposY, direccion){
			var pY = -4;
			var pX = -30;
			var pZ = -30; 
			jsonLoader.load("./models/" + tipo + ".js", function(geometry, materials){
				//console.log("./models/" + tipo + ".js");
					var texture = new THREE.ImageUtils.loadTexture("./models/" + tipo + ".jpg");
					var material = new THREE.MeshBasicMaterial({map:texture});
					var particleSystem = new THREE.Mesh( geometry, material );
					particleSystem.rotation.y = direccion;
					particleSystem.scale.set(100,100,100);
					particleSystem.position.set(posX,-4,posY); 
					scene.add( particleSystem );		
					// also update the particle system to
					// sort the particles which enables
					// the behaviour we want
					//particleSystem.sortParticles = true;
					var packParticulas = [];
					packParticulas['origenX'] = posX;
					packParticulas['origenY'] = posY;
					packParticulas['destinoX'] = dposX;
					packParticulas['destinoY'] = dposY;
					packParticulas['particulas'] = particleSystem;
					
					particulas.push(packParticulas);
			});
}

function graficarDisparos(delta){
	//delta es el tiempo que paso
	var index = 0;
	for(var p in particulas){			
		moverParticula(particulas[p].origenX, particulas[p].origenY, particulas[p].particulas.position, particulas[p].destinoX, particulas[p].destinoY, delta);
		var falta = Math.abs(particulas[p].particulas.position.x - particulas[p].destinoX) + Math.abs(particulas[p].particulas.position.y - particulas[p].destinoY);
		var distancia = Math.abs(particulas[p].origenX - particulas[p].destinoX) + Math.abs(particulas[p].origenY - particulas[p].destinoY);

		if (falta <= 30){
			scene.remove(particulas[p].particulas);			
			particulas.splice(index, 1);
		}

		index = index + 1;
	}
}

function moverParticula(origenX, origenY, actual, destinoX, destinoY, delta){
	var velocidad = 0.1;
			
	var distanciaX = Math.abs(Math.abs(origenX) - Math.abs(destinoX));
	var distanciaY = Math.abs(Math.abs(origenY) - Math.abs(destinoY));
	if (distanciaX > distanciaY){
		pasosX = 1;
		pasosY = distanciaY / distanciaX;
	}else{
		pasosX = distanciaX / distanciaY;
		pasosY = 1;
	}

	if (Math.abs(Math.abs(actual.x) - Math.abs(destinoX)) > 30){
		if (actual.x < destinoX){
			actual.x = actual.x + (pasosX * velocidad * delta);
		}else{
			actual.x = actual.x - (pasosX * velocidad * delta);
		}
	}else{
		actual.x = destinoX;
	}

	if (Math.abs(Math.abs(actual.z) - Math.abs(destinoY)) > 30){
		if (actual.z < destinoY){
			actual.z = actual.z + (pasosY * velocidad * delta);
		}else{
			actual.z = actual.z - (pasosY * velocidad * delta);
		}
	}else{
		actual.z = destinoY;
	}

	var faltaX = Math.abs(Math.abs(actual.x) - Math.abs(destinoX));
	var faltaY = Math.abs(Math.abs(actual.z) - Math.abs(destinoY));
	
	//la mitad de la distancia de X capaz es poca, tendria que ir en relacion a la distancia original
	if ((distanciaX / 2.5) + (distanciaY / 2.5) >= faltaX + faltaY){
		actual.y = actual.y - (velocidad * delta * 0.5);
	}else{
		actual.y = actual.y + (velocidad * delta * 0.5);
	}
}

