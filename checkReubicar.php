<?php

function checkReubicar($con){
	$ahora = time() - 60;
	$sql=mysql_query("SELECT * FROM players WHERE undir < '$ahora' AND undir > '0'",$con);
	while($row = mysql_fetch_array($sql)){
		$nPosX = rand(-10000, 10000);
		$nPosY = rand(-10000, 10000);
		mysql_query("UPDATE players SET posX = '$nPosX' WHERE id = '$row[id]'");
		mysql_query("UPDATE players SET posY = '$nPosY' WHERE id = '$row[id]'");
		mysql_query("UPDATE players SET undir = '0' WHERE id = '$row[id]'");
		$vida = $row["nivel"] * 10;
		mysql_query("UPDATE players SET vida = '$vida' WHERE id = '$row[id]'");
	}
}
?>