<?php
function checkWaypoint($con){
	$sql=mysql_query("SELECT * FROM players WHERE id= '$_SESSION[player]'",$con);
	while($row = mysql_fetch_array($sql)){
		$posX = $row["posX"];
		$posY = $row["posY"];
	}	

	$posicion = null;	
	$sql=mysql_query("SELECT * FROM viajes WHERE player = '$_SESSION[player]'",$con);
	while($row = mysql_fetch_array($sql)){
		$posicion["x"] = $row["posX"] - $posX;
		$posicion["y"] = $row["posY"] - $posY;
		return $posicion;
	}	
	return false;
}
?>