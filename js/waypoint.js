var waypoint=null;

function cargarWaypoint(dataWaypoint){
	if (dataWaypoint.x != null && dataWaypoint.y != null){
		if (waypoint != null){
			reubicarWaypoint(dataWaypoint.x, -25, dataWaypoint.y, 0);
		}else{
			jsonLoader.load("./models/flag.js", addWaypointToScene(dataWaypoint.x, -25, dataWaypoint.y, 0));
		}		
	}else{
		if (waypoint != null){
			eliminarWaypoint();
			waypoint = null;
		}
	}
}