<?php
session_start();
include('./conectar.php');

if (!isset($_SESSION["player"])){
	exit();
}		

if ($_SESSION["player"] == $_GET["target"]){
	die('Imposible atacarte');
}

$sql=mysql_query("SELECT * FROM players WHERE id = '$_SESSION[player]'",$con);
while($row = mysql_fetch_array($sql)){
	$direccion = $row["direction"];
	$nivel = $row["nivel"];
	$posX = $row["posX"];
	$posY = $row["posY"];	
	$undir = $row["undir"];

	if ($row["ataque"] > time()){
		echo 'alistando';
		exit();
	}
}

if ($undir > 0){
	die('pu');
}

$sql=mysql_query("SELECT * FROM players WHERE id = '$_GET[target]'",$con);
while($row = mysql_fetch_array($sql)){
	$destinoX = $row["posX"];
	$destinoY = $row["posY"];	
	$undir = $row["undir"];
}

if ($undir > 0){
	die('eu');
}

$ahora = time() + 6;
/*if ($_GET["lado"] == 'estribor'){
	mysql_query("UPDATE players SET estribor = '$ahora' WHERE id = '$_SESSION[player]'");
	$direccion -= 1.575;
}else{
	mysql_query("UPDATE players SET babor = '$ahora' WHERE id = '$_SESSION[player]'");	
	$direccion += 1.575;
}*/

mysql_query("UPDATE players SET ataque = '$ahora' WHERE id = '$_SESSION[player]'");	



if ($destinoX-$posX >= 0 AND $destinoY-$posY >= 0){
	$cara = 90*0;
	$grados = $cara + (90 - rad2deg(abs(atan(abs(($destinoY-$posY) / abs($destinoX-$posX))))));	
}
if ($destinoX-$posX >= 0 AND $destinoY-$posY <= 0){
	$cara = 90*1;
	$grados = $cara + (rad2deg(abs(atan(abs(($destinoY-$posY) / abs($destinoX-$posX))))));	
}
if ($destinoX-$posX <= 0 AND $destinoY-$posY <= 0){
	$cara = 90*2;
	$grados = $cara + (90 - rad2deg(abs(atan(abs(($destinoY-$posY) / abs($destinoX-$posX))))));	
}
if ($destinoX-$posX <= 0 AND $destinoY-$posY >= 0){
	$cara = 90*3;
	$grados = $cara + (rad2deg(abs(atan(abs(($destinoY-$posY) / abs($destinoX-$posX))))));	
}

$direccion = (($grados * 1.575) / 90);


/*$grados = ($direccion * 90) / 1.575;

while($grados > 360){
	$grados = $grados - 360;
}

while ($grados < 0){
	$grados = $grados + 360;
}

if ($grados > 360){
	$grados = $grados - 360;
}

$caras = 0;
while($grados > 90){
	$grados -= 90;
	$caras ++;
}

$radianes = deg2rad($grados);

if ($caras == 0){
	$radianes = deg2rad($grados);
	$creceEjeX = sin($radianes);
	$creceEjeY = cos($radianes); 
}

if ($caras == 1){
	$creceEjeY = -1 * sin($radianes);
	$creceEjeX = cos($radianes); 
}

if ($caras == 2){
	$creceEjeX = -1 * sin($radianes);
	$creceEjeY = -1 * cos($radianes); 
}

if ($caras == 3){
	$creceEjeY = sin($radianes);
	$creceEjeX = -1 * cos($radianes); 
}

if ($modelo == "Balsa"){
	$fuerzaMaxX = (($_GET["angulo"] * 50) / 22);
	$fuerzaMaxY = (($_GET["angulo"] * 50) / 22);
}
if ($modelo == "Canoa"){
	$fuerzaMaxX = (($_GET["angulo"] * 600) / 22);
	$fuerzaMaxY = (($_GET["angulo"] * 600) / 22);
}




$cosenoXdistanciaMax = ($creceEjeX * $fuerzaMaxX) + $posX;
$senoXdistanciaMax = ($creceEjeY * $fuerzaMaxY) + $posY;

$errorDisparo = abs($destinoX - $cosenoXdistanciaMax) + abs($destinoY - $senoXdistanciaMax);

if ($errorDisparo < (5 + $disparos) * $disparos){	
	$danio = (100 - $errorDisparo) * $disparos;	
}else{
	$danio = 0;
}

$ahora = time() + 5;
//$distancia = abs(abs($destinoX) - abs($posX)) + abs(abs($destinoY) - abs($posY));
$caduca = $ahora + (($errorDisparo * 8) / 1030);*/

$caduca = time() + 6;

$danio = $nivel * 1;

	$sky = date("H", time());
	$dia = date("N", time());
	if (($sky >= 0 AND $sky <= 5 AND $dia == 6) OR ($sky >= 20 AND $sky <= 23 AND $dia == 5)){
		$danio = $danio * 7;
	}	

if ($nivel <= 10){
	$arma = 'Lanza';
}
if ($nivel >= 11 AND $nivel <= 20){
	$arma = 'Flecha';
}
if ($nivel >= 21 AND $nivel <= 30){
	$arma = 'FlechaFuego';
}
if ($nivel >= 31 AND $nivel <= 40){
	$arma = 'Canion';
}
if ($nivel >= 41 AND $nivel <= 50){
	$arma = 'CanionFuego';
}

$sql=("INSERT INTO ataques (player, enemig, origenX, origenY, posX, posY, fecha, direccion, danio, arma, atack) VALUES ('$_SESSION[player]', '$_GET[target]', '$posX', '$posY', '$destinoX', '$destinoY', '$caduca', '$direccion', '$danio', '$arma', 'player')");
if (!mysql_query($sql,$con)){
	die('error');
}	

echo 'ok';
?>