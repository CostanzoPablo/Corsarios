var virarPedido = false; //hicieron click en izquierda o derecha
var virarUpdater = true; //activa la posibilidad de que se actualize la direccion correcta que lleva
var virar = 0;//la direccion a donde va...

function limitarVirar(unAngulo){
	if (unAngulo < 1){ 
		unAngulo = 360;
	}else{
		if (unAngulo > 359){
			unAngulo = 0;
		}
	}
	return unAngulo;
}

function virarIzquierda(){
	virar = limitarVirar(virar - 1);
	virarPedido = true;
	$("#menu_virargrados").html(virar + "&deg;");
}
function virarDerecha(){
	virar = limitarVirar(virar + 1);
	virarPedido = true;
	$("#menu_virargrados").html(virar + "&deg;");
}
function updateVirar(){
	if (virarPedido == true && virarUpdater == true){
		virarUpdater = false;
		virarPedido = false;
		$.ajax({
			url: './virar.php?virar=' + virar,
			context: document.body
			}).always(function() {
				virarUpdater = true;
			});			
	}
}