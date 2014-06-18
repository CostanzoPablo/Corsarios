<?php
session_start();
include('./conectar.php');

if (!isset($_SESSION["player"])){
	exit();
}		

$sql=mysql_query("SELECT * FROM players WHERE id = '$_SESSION[player]'",$con);
while($row = mysql_fetch_array($sql)){
	$posX = $row["posX"];
	$posY = $row["posY"];	
	$undir = $row["undir"];
	$oro = $row["oro"];
}

if ($undir > 0){
	die('Te estas undiendo...');
}

$existe = false;
$sql=mysql_query("SELECT * FROM pesca WHERE id = '$_GET[pesca]'",$con);
while($row = mysql_fetch_array($sql)){
	$existe = true;
	$delta = time() - $row["fecha"];
	$playerRed = $row["player"];
	$oroPesca = rand(intval(((time() - $row["fecha"]) / 60) * 20 / 100), intval((time() - $row["fecha"]) / 60));
	$pescaPosX = $row["posX"];	
	$pescaPosY = $row["posY"];
}

if ($existe == false){
	die('existe');
}

if ($playerRed != $_SESSION["player"]){//le robaron la red al $playerRed...
	$mensaje = 'Te robaron la red '.$pescaPosX.':'.$pescaPosY;
	$sql=("INSERT INTO mensajes (player, titulo, mensaje, fecha, leido) VALUES ('$playerRed', 'Pesca robada', '$mensaje', '$ahora', '0')");
	if (!mysql_query($sql,$con)){
		die('error');
	}	
}

if (abs($posX - $pescaPosX) < 70 AND abs($posY - $pescaPosY) < 70){
	$ahora = time();
	$oro += $oroPesca;
	mysql_query("UPDATE players SET oro = '$oro' WHERE id = '$_SESSION[player]'");
	$mensaje = 'Oro segun la venta de la pesca: '.$oroPesca.'<br>Ahora tenes: '.$oro;
	$sql=("INSERT INTO mensajes (player, titulo, mensaje, fecha, leido) VALUES ('$_SESSION[player]', 'Pesca capturada', '$mensaje', '$ahora', '0')");
	if (!mysql_query($sql,$con)){
		die('error');
	}	
}else{
	die('lejos');
}

$sql=("DELETE FROM pesca WHERE id = '$_GET[pesca]'");
if (!mysql_query($sql,$con)){
	die("error");
}    


echo 'ok';
?>