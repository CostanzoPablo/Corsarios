var coolDownAtaque = 10000;

function coolDowns(delta){
	if (coolDownAtaque < 10000){
		coolDownAtaque = coolDownAtaque + delta;
		if (coolDownAtaque > 10000){
			coolDownAtaque = 10000;
			$("#coolDownAtaque").css("background-color",'#00EE00' );					
		}
		$("#coolDownAtaque").width( parseInt(coolDownAtaque / 100) + 'px' );
	}
}

function logout(){
	location.href="./logout.php";
}

function capturarCofre(unCofre){
	openObject('loading');
	$.ajax({
		url: './capturarCofre.php?cofre=' + cofresId[unCofre],
		context: document.body
		}).done(function( data ) {
			closeObject('loading');
			if (cleanString(data) == "lejos"){
				alert('No estas lo suficientemente cerca para agarrar el cofre');
				return false;
			}			
			if (cleanString(data) == "existe"){
				alert('Otro jugador agarro el cofre antes que vos');
				return false;
			}						
			if (cleanString(data) != 'ok'){
				alert('Estado inesperado. Respuesta del servidor: ' + data);
				return false;
			}else{
				//cofre capturado
				$("#dialog").dialog('close');
			}
		});
}


function capturarPesca(unaPesca){
	openObject('loading');
	$.ajax({
		url: './capturarPesca.php?pesca=' + pescasId[unaPesca],
		context: document.body
		}).done(function( data ) {
			closeObject('loading');
			if (cleanString(data) == "lejos"){
				alert('No estas lo suficientemente cerca para capturar la red');
				return false;
			}			
			if (cleanString(data) == "existe"){
				alert('Otro jugador capturo la red antes que vos');
				return false;
			}						
			if (cleanString(data) != 'ok'){
				alert('Estado inesperado. Respuesta del servidor: ' + data);
				return false;
			}else{
				//cofre capturado
				$("#dialog").dialog('close');
			}
		});
}

function pescar(){
	openObject('loading');
	$.ajax({
		url: './pescar.php',
		context: document.body
		}).done(function( data ) {
			closeObject('loading');
			if (cleanString(data) == "maximo"){
				alert('Ya no dispones de mas redes para poder arrojar al agua');
				return false;
			}			
			if (cleanString(data) == "area"){
				alert('Ya hay una red en un area cercana');
				return false;
			}						
			if (cleanString(data) != 'ok'){
				alert('Estado inesperado. Respuesta del servidor: ' + data);
				return false;
			}else{
				//cofre capturado
				$("#dialog").dialog('close');
			}
		});
}


function atacarEnemigo(unTargetId, unTargetName, enemigoVida){
	$("#dialog").dialog('option', 'title', 'Atacar a ' + unTargetName + ' Vida: ' + enemigoVida + '%');
	$("#dialog").html('<div id="enemigoVida">&nbsp;</div><div id="enemigoVidaNumero">&nbsp;</div><br><br><div class="nowrapL" onclick="javascript:atacarConfirmado(\'' + unTargetId + '\');"><img width="296" height="96" src="./images/logo_atacar.png"></img></div><div id="coolDownAtaque">&nbsp;</div><br><br>');	
}

function atacarMob(unTargetId, enemigoVida){
	$("#dialog").dialog('option', 'title', 'Atacar Mob, Vida: ' + enemigoVida + '%');
	$("#dialog").html('<div id="enemigoVida">&nbsp;</div><div id="enemigoVidaNumero">&nbsp;</div><br><br><div class="nowrapL" onclick="javascript:atacarMobConfirmado(\'' + unTargetId + '\');"><img width="296" height="96" src="./images/logo_atacar.png"></img></div><div id="coolDownAtaque">&nbsp;</div><br><br>');	
}

function atacarMobConfirmado(unTargetId){
	openObject('loading');
	$.ajax({
		url: './atacarMob.php?target=' + unTargetId,
		context: document.body
		}).done(function( data ) {
			closeObject('loading');
			if (cleanString(data) == "login"){				
				alert('Error. Se perdio la sesion. Identificarse nuevamente');
				loginMenu();
				return false;
			}
			if (cleanString(data) == "error"){
				alert('El servidor detecto un error y aborto la peticion');
				return false;
			}
			if (cleanString(data) == "alistando"){
				alert('Alistando armas !');
				return false;
			}			
			if (cleanString(data) == "pu"){
				alert('Te estas undiendo...');
				return false;
			}						
			if (cleanString(data) == "eu"){
				alert('El enemigo se esta undiendo...');
				return false;
			}									
			if (cleanString(data) != 'ok'){
				alert('Estado inesperado. Respuesta del servidor: ' + data);
				return false;
			}else{
				coolDownAtaque = 0;	
				$("#coolDownAtaque").width( '0px' );
				$("#coolDownAtaque").css("background-color",'#EE0000' );
			}
		});
}

function atacarConfirmado(unTargetId){
	openObject('loading');
	$.ajax({
		url: './atacar.php?target=' + unTargetId,
		context: document.body
		}).done(function( data ) {
			closeObject('loading');
			if (cleanString(data) == "login"){				
				alert('Error. Se perdio la sesion. Identificarse nuevamente');
				loginMenu();
				return false;
			}
			if (cleanString(data) == "error"){
				alert('El servidor detecto un error y aborto la peticion');
				return false;
			}
			if (cleanString(data) == "alistando"){
				alert('Alistando armas !');
				return false;
			}			
			if (cleanString(data) == "pu"){
				alert('Te estas undiendo...');
				return false;
			}						
			if (cleanString(data) == "eu"){
				alert('El enemigo se esta undiendo...');
				return false;
			}									
			if (cleanString(data) != 'ok'){
				alert('Estado inesperado. Respuesta del servidor: ' + data);
				return false;
			}else{
				coolDownAtaque = 0;	
				$("#coolDownAtaque").width( '0px' );
				$("#coolDownAtaque").css("background-color",'#EE0000' );
			}
		});
}