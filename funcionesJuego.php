<?php
function targetExiste($con, $unTarget){
	$sql=mysql_query("SELECT * FROM players WHERE id = '$unTarget'",$con);
	while($row = mysql_fetch_array($sql)){
		return true;
	}
	return false;
}

function estaEnRadio($con, $unTarget){
	$sql=mysql_query("SELECT * FROM players WHERE id = '$unTarget'",$con);
	while($row = mysql_fetch_array($sql)){
		$targetX = $row["posX"];
		$targetY = $row["posY"];
	}
	$sql=mysql_query("SELECT * FROM players WHERE id = '$_SESSION[player]",$con);
	while($row = mysql_fetch_array($sql)){
		$playerX = $row["posX"];
		$playerY = $row["posY"];
	}
	$diferenciaX = abs($targetX - $playerX);
	$diferenciaY = abs($targetY - $playerX);
	if (($diferenciaX + $diferenciaY) > 1800){
		return false;
	}else{
		return true;
	}
}

function playerIdentificado(){
	return isset($_SESSION["player"]);
}
?>