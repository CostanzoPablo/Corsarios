<?php
//calcular viajes

$sql=mysql_query("SELECT * FROM viajes ORDER by ucheck ASC",$con);
while($row = mysql_fetch_array($sql)){
	$ahora = time();
	$delta = ($ahora - $row["ucheck"]);
	$velocidad = 4;

	$sql2=mysql_query("SELECT * FROM players WHERE id = '$row[player]'",$con);
	while($row2 = mysql_fetch_array($sql2)){
		$core_playerX = $row2["posX"];
		$core_playerY = $row2["posY"];	
	}
	
	$core_diferenciaX = abs($core_playerX - $row["posX"]);
	$core_diferenciaY = abs($core_playerY - $row["posY"]);

	if ($core_diferenciaX > $core_diferenciaY){
		$pasosX = 1 * $delta * $velocidad;
		$pasosY = ($core_diferenciaY / $core_diferenciaX) * $delta * $velocidad;
	}else{
		$pasosX = ($core_diferenciaX / $core_diferenciaY) * $delta * $velocidad;
		$pasosY = 1 * $delta * $velocidad;
	}

	if ($core_diferenciaX > $pasosX){
		if ($core_playerX > $row["posX"]){
			$core_playerX -= $pasosX;
		}else{
			$core_playerX += $pasosX;	
		}
	}else{
		$core_playerX = $row["posX"];
	}

	if ($core_diferenciaY > $pasosY){
		if ($core_playerY > $row["posY"]){
			$core_playerY -= $pasosY;
		}else{
			$core_playerY += $pasosY;	
		}
	}else{
		$core_playerY = $row["posY"];
	}

	mysql_query("UPDATE players SET posX = '$core_playerX' WHERE id = '$row[player]'");
	mysql_query("UPDATE players SET posY = '$core_playerY' WHERE id = '$row[player]'");
	mysql_query("UPDATE viajes SET ucheck = '$ahora' WHERE player = '$row[player]'");

	if (abs(abs($core_playerX) - abs($row["posX"])) <= 2 AND abs(abs($core_playerY) - abs($row["posY"])) <= 2){
		$sql2=("DELETE FROM viajes WHERE player = '$row[player]'");
		if (!mysql_query($sql2,$con)){
			die("error");
		}    		
	}

}
?>