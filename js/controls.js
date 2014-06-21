var mouseDown = false;
var mouseX=0;
var mouseY=0;

//document.addEventListener('mousemove', onDocumentMouseMove, false);
document.addEventListener( 'mousedown', onDocumentMouseDown, true );
document.addEventListener( 'mouseup', onDocumentMouseUp, true );
//document.addEventListener('keydown', onDocumentKeyDown, false);
//document.addEventListener('keyup', onDocumentKeyUp, false);*/


/*function onDocumentKeyDown(event) {
	if(event.keyCode == 39){
	    moveCamera = 'right';
	}
	if(event.keyCode == 37){
	    moveCamera = 'left';
	}
	/*if(event.keyCode == 38){
	    moveCamera = 'up';
	}
	if(event.keyCode == 40){
	    moveCamera = 'down';
	}    */    
//}
var mouseClick = true;
function enableMouseClick(){
		 mouseClick = true;
}

function disableMouseClick(){
		 mouseClick = false;
}

function onDocumentMouseUp(event) {
	mouseDown = false;
	if (!$("#dialog").dialog('isOpen')){
		if (event.clientX == mouseX && event.clientY == mouseY){
		    if (mouseClick){
    			if (!searchObjectClicked(event)){//add Glow
    					searchWaterClicked(event);
    			}
			}
		}
	}
	enableDisableControls();
}

function enableDisableControls(){
	if ($("#dialog").dialog('isOpen')){
		controls.enabled = false;
	}else{
		controls.enabled = true;
	}
}

function onDocumentMouseDown(event) {
	mouseDown = true;	
	mouseX = event.clientX;
	mouseY = event.clientY;
	enableDisableControls();
}


function searchWaterClicked(event){
		event.preventDefault();

		var vector = new THREE.Vector3( ( event.clientX / window.innerWidth ) * 2 - 1, - ( event.clientY / window.innerHeight ) * 2 + 1, 1 );
		projector.unprojectVector( vector, camera );

		var raycaster = new THREE.Raycaster( camera.position, vector.sub( camera.position ).normalize() );

		var intersects = raycaster.intersectObjects( scene.children, true );

		if ( intersects.length > 0 ) {
			viajar(intersects[0].point.x, intersects[0].point.z);
			return true;
		}else{
			return false;
		}
}

function viajar(posX, posY){
	$("#dialog").dialog("close");
	$.ajax({
		url: './viajar.php?posX=' + posX + '&posY=' + posY,
		context: document.body
		}).done(function( data ) {
			if(cleanString(data) == 'error'){
				alert('El servidor reporto error');
				return false;
			}else{
				var dataParsed = JSON.parse(cleanString(data));
				cargarWaypoint(dataParsed);
			}
		});	
}