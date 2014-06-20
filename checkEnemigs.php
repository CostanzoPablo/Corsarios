<?php

function checkEnemigs($con, $limite){	
	$posX = null;
	$posY = null;
	$sql=mysql_query("SELECT * FROM players WHERE id= '$_SESSION[player]'",$con);
	while($row = mysql_fetch_array($sql)){
		$posX = $row["posX"];
		$posY = $row["posY"];
	}	

	$minimoX = $posX - $limite;
	$minimoY = $posY - $limite;
	$maximoX = $posX + $limite;
	$maximoY = $posY + $limite;
	$ahora = time();
	$enemigos = null;


	$sql=mysql_query("SELECT *, (SELECT posX FROM viajes WHERE player = players.id) as viajeX, (SELECT posY FROM viajes WHERE player = players.id) as viajeY FROM players WHERE id = '$_SESSION[player]'",$con);
	while($row = mysql_fetch_array($sql)){
		$enemig = null;
		$enemig["nick"] = $row["nick"];
		$enemig["id"] = $row["id"];
		$enemig["direction"] = $row["direction"];
		$enemig["posX"] = $row["posX"] - $posX;
		$enemig["posY"] = -6;
		$enemig["posZ"] = $row["posY"] - $posY;
		$enemig["grados"] = 0;
		$enemig["vida"] = intval(($row["vida"] * 100) / ($row["nivel"] * 10));
		$nivel = $row["nivel"];
		if ($nivel <= 10){
			$enemig["modelo"] = 'Balsa';
		}
		if ($nivel >= 11 AND $nivel <= 20){
			$enemig["modelo"] = 'Canoa';
		}
		if ($nivel >= 21 AND $nivel <= 30){
			$enemig["modelo"] = 'Vikingo';
		}
		if ($nivel >= 31 AND $nivel <= 40){
			$enemig["modelo"] = 'Galeon';
		}
		if ($nivel >= 41){
			$enemig["modelo"] = 'Fragata';
		}
		

		
		$enemig["viajeX"] = $row["viajeX"] - $posX;
		$enemig["viajeY"] = $row["viajeY"] - $posY;
		if ($row["viajeX"] == null){
			$enemig["viajeX"] = null;
		}
		if ($row["viajeY"] == null){
			$enemig["viajeY"] = null;
		}









 		$undir = ((time() - $row["undir"]) * 60) / 60;
		if ($row["undir"] == 0){
			$undir = 0;
		}
		$enemig["undirY"] = $undir;

		$undir = ((time() - $row["undir"]) * 3.15) / 60;
		if ($row["undir"] == 0){
			$undir = 0;
		}
		$enemig["undirX"] = $undir;
		
		$enemigos[] = $enemig;
	}	


	$sql=mysql_query("SELECT *, (SELECT posX FROM viajes WHERE player = players.id) as viajeX, (SELECT posY FROM viajes WHERE player = players.id) as viajeY FROM players WHERE posX >= '$minimoX' AND $posY >= '$minimoY' AND posX <= '$maximoX' AND posY <= '$maximoY' AND ban <= '$ahora' AND fog = '0' AND NOT(id = '$_SESSION[player]')",$con);
	while($row = mysql_fetch_array($sql)){
		$enemig = null;
		$enemig["nick"] = $row["nick"];
		$enemig["id"] = $row["id"];
		$enemig["direction"] = $row["direction"];
		$enemig["posX"] = $row["posX"] - $posX;
		$enemig["posY"] = -6;
		$enemig["posZ"] = $row["posY"] - $posY;
	
		$enemig["vida"] = intval(($row["vida"] * 100)  / ($row["nivel"] * 10));
		$nivel = $row["nivel"];
		if ($nivel <= 10){
			$enemig["modelo"] = 'Balsa';
		}
		if ($nivel >= 11 AND $nivel <= 20){
			$enemig["modelo"] = 'Canoa';
		}
		if ($nivel >= 21 AND $nivel <= 30){
			$enemig["modelo"] = 'Vikingo';
		}
		if ($nivel >= 31 AND $nivel <= 40){
			$enemig["modelo"] = 'Galeon';
		}
		if ($nivel >= 41){
			$enemig["modelo"] = 'Fragata';
		}

	    $enemig["distancia"] =  round((abs($row["posX"] - $posX) + abs($row["posY"] - $posY)) / 1000,2);
		$enemig["viajeX"] = $row["viajeX"] - $posX;
		$enemig["viajeY"] = $row["viajeY"] - $posY;
		if ($row["viajeX"] == null){
			$enemig["viajeX"] = null;
		}
		if ($row["viajeY"] == null){
			$enemig["viajeY"] = null;
		}
 $enemig["posXreal"] = $row["posX"];
 $enemig["posYreal"] = $row["posY"];
 		$undir = ((time() - $row["undir"]) * 60) / 60;
		if ($row["undir"] == 0){
			$undir = 0;
		}
		$enemig["undirY"] = $undir;

		$undir = ((time() - $row["undir"]) * 3.15) / 60;
		if ($row["undir"] == 0){
			$undir = 0;
		}
		$enemig["undirX"] = $undir;


$grados = 0;
if ($row["posX"] - $posX - 100 >= 0 AND $row["posY"] - $posY >= 0){
	$cara = 90*0;
	$grados = $cara + (90 - rad2deg(abs(atan(abs(($row["posY"] - $posY) / abs($row["posX"] - $posX) + 0.0001)))));	
}
if ($row["posX"] - $posX >= 0 AND $row["posY"] - $posY <= 0){
	$cara = 90*1;
	$grados = $cara + (rad2deg(abs(atan(abs(($row["posY"] - $posY) / abs($row["posX"] - $posX) + 0.0001)))));	
}
if ($row["posX"] - $posX <= 0 AND $row["posY"] - $posY <= 0){
	$cara = 90*2;
	$grados = $cara + (90 - rad2deg(abs(atan(abs(($row["posY"] - $posY) / abs($row["posX"] - $posX) + 0.0001)))));	
}
if ($row["posX"] - $posX <= 0 AND $row["posY"] - $posY >= 0){
	$cara = 90*3;
	$grados = $cara + (rad2deg(abs(atan(abs(($row["posY"] - $posY) / abs($row["posX"] - $posX) + 0.0001)))));	
}

$direccion = (($grados * 1.575) / 90);

		$enemig["grados"] = $grados;
		$enemigos[] = $enemig;
	}	

	return $enemigos;
}
?>