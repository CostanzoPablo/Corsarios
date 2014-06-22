var uCheckLogin = new Date().getTime();

function cronChecks(){
	if (uCheckLogin + 2000 <= new Date().getTime()){
		$.ajax({
			url: './checks.php',
			context: document.body
			}).done(function( data ) {
				var dataParsed = JSON.parse(cleanString(data));
				if (checkLogin(dataParsed.login)){
					cargarWaypoint(dataParsed.waypoint);
					cargarPlayerData(dataParsed.player, dataParsed.waypoint, dataParsed.mensajes);
					checkEnemigs(dataParsed.enemigs);
					cargarAtaques(dataParsed.ataques);
					cargarCofres(dataParsed.cofres);
					cargarPesca(dataParsed.pesca);
					cargarMobs(dataParsed.mobs);
					changeSky(dataParsed.sky);
					checkRadarEnemigs(dataParsed.radar, dataParsed.player.direction);
				}
		});	

		uCheckLogin = new Date().getTime();
	}
}