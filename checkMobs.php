<?php

function checkMobs($con, $limite){	
	$posX = null;
	$posY = null;
	$sql=mysql_query("SELECT * FROM players WHERE id = '$_SESSION[player]'",$con);
	while($row = mysql_fetch_array($sql)){
		$posX = $row["posX"];
		$posY = $row["posY"];
		$vida = $row["vida"];
	}	

	if (rand(1, 99) == 99){
		$nPosX = rand(-1000, 1000) + $posX;
		$nPosY = rand(-1000, 1000) + $posY;
		$nVida =  intval(rand($vida / 2, $vida + ($vida / 4)));
		$nModel = 'Tortuga';
		$nDirection = 0;
		$nOro = ceil($nVida / 10) + 1;
		$sql=("INSERT INTO mobs (vida, posX, posY, model, direction, oro, vidaTotal) VALUES ('$nVida', '$nPosX', '$nPosY', '$nModel', '$nDirection', '$nOro', '$nVida')");
		if (!mysql_query($sql,$con)){
			die('error');
		}			
	}

	$minimoX = $posX - $limite;
	$minimoY = $posY - $limite;
	$maximoX = $posX + $limite;	
	$maximoY = $posY + $limite;
	$ahora = time();
	$enemigos = null;

	$sql=mysql_query("SELECT *  FROM mobs WHERE posX >= '$minimoX' AND $posY >= '$minimoY' AND posX <= '$maximoX' AND posY <= '$maximoY'",$con);
	while($row = mysql_fetch_array($sql)){
		$enemig = null;
		$enemig["id"] = $row["id"];
		$enemig["posX"] = $row["posX"] - $posX;
		$enemig["posY"] = $row["posY"] - $posY;
		$enemig["vida"] = intval(($row["vida"] * 100) / $row["vidaTotal"]);
		$enemig["model"] = $row["model"];
		$enemig["direction"] = $row["direction"];
		$enemigos[] = $enemig;
	}	

	return $enemigos;
}
?>