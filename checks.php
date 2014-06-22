<?php
session_start();
include('./conectar.php');
include('./checkLogin.php');
include('./checkPlayer.php');
include('./checkEnemigs.php');
include('./checkWaypoint.php');
include('./checkMensajes.php');
include('./checkAtaques.php');
include('./checkReubicar.php');
include('./checkCofres.php');
include('./checkPesca.php');
include('./checkMobs.php');

$retorno = null;

$retorno['login'] = checkLogin();

if ($retorno['login'] == 'ok'){
	$ahora = time();
	mysql_query("UPDATE players SET uclick = '$ahora' WHERE id = '$_SESSION[player]'");
	garbageAtaques($con);
	garbageMobAtaques($con);
	$retorno['cofres'] = checkCofres($con, 1800);
	$retorno['enemigs'] = checkEnemigs($con, 1800);
	$retorno['waypoint'] = checkWaypoint($con);
	$retorno['player'] = checkPlayerData($con);
	$retorno['mensajes'] = checkMensajes($con);
	$retorno['ataques'] = checkAtaques($con, 1800*2);
	$retorno['pesca'] = checkPesca($con, 1800);
	$retorno['mobs'] = checkMobs($con, 1800);
	$retorno['radar'] = checkEnemigs($con, 10000);
	$sky = date("H", time());
	$dia = date("N", time());
	if (($sky >= 0 AND $sky <= 5) OR ($sky >= 20 AND $sky <= 23)){
		$retorno['sky'] = 'night';		
	}
	if ($sky >= 6 AND $sky <= 10){
		$retorno['sky'] = 'morning';	
	}	
	if ($sky >= 11 AND $sky <= 16){
		$retorno['sky'] = 'day';	
	}	
	if ($sky >= 17 AND $sky <= 19){
		$retorno['sky'] = 'afternoon';	
	}	
	if (($sky >= 0 AND $sky <= 5 AND $dia == 6) OR ($sky >= 20 AND $sky <= 23 AND $dia == 5)){
		$retorno['sky'] = 'x7';	
	}	
}

checkReubicar($con);

echo json_encode($retorno);

?>