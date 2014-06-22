var blackList = [];
function checkEnemigs(dataEnemigs){
	blackList.length = 0;
	for(var enemig in dataEnemigs){	
		if (buscarBarcoNombre(dataEnemigs[enemig].nick)){
			reubicarBarco(dataEnemigs[enemig].nick, dataEnemigs[enemig].posX, dataEnemigs[enemig].posY, dataEnemigs[enemig].posZ, dataEnemigs[enemig].direction, dataEnemigs[enemig].vida, dataEnemigs[enemig].viajeX, dataEnemigs[enemig].viajeY);
		}else{
			jsonLoader.load( "./models/" + dataEnemigs[enemig].modelo + ".js", addBarcoToScene(dataEnemigs[enemig].posX, dataEnemigs[enemig].posY, dataEnemigs[enemig].posZ, dataEnemigs[enemig].direction, dataEnemigs[enemig].id, dataEnemigs[enemig].nick, dataEnemigs[enemig].vida, "./models/" + dataEnemigs[enemig].modelo + ".png") );
		}
		if (dataEnemigs[enemig].undirX > 0){
			undir(dataEnemigs[enemig].nick, dataEnemigs[enemig].undirX, dataEnemigs[enemig].undirY);
		}
		blackList.push(dataEnemigs[enemig].nick);
	}
	cleanOldEnemigs(blackList);
}

function updateVida(){
	if (targetId){
		if (buscarBarcoIdxId(targetId)){
			$("#enemigoVida").width( parseInt(( buscarBarcoVidaxId(buscarBarcoIdxId(targetId)) * 400) / 100) + 'px' );
			$("#enemigoVidaNumero").html('&nbsp;' + buscarBarcoVidaxId(buscarBarcoIdxId(targetId)) + '%');
			$("#dialog").dialog('option', 'title', 'Objetivo: ' + buscarBarcoNombrexId(buscarBarcoIdxId(targetId)) + ' Vida: ' + buscarBarcoVidaxId(buscarBarcoIdxId(targetId)) + '%');
		}
		if (buscarMobIdxId(targetId)){
			$("#enemigoVida").width( parseInt(( buscarMobVidaxId(buscarMobIdxId(targetId)) * 400) / 100) + 'px' );
			$("#enemigoVidaNumero").html('&nbsp;' + buscarMobVidaxId(buscarMobIdxId(targetId)) + '%');
			$("#dialog").dialog('option', 'title', 'Objetivo: Mob Vida: ' + buscarMobVidaxId(buscarMobIdxId(targetId)) + '%');
		}
	}	
}