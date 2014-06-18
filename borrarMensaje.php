<?php
session_start();
include('./conectar.php');
include('./checkMensajes.php');

if (!isset($_SESSION["player"])){
	exit();
}		

$sql=("DELETE FROM mensajes WHERE id = '$_GET[mensaje]' AND player = '$_SESSION[player]'");
if (!mysql_query($sql,$con)){
	die("error");
}    

$mensajes = checkMensajes($con);
echo json_encode($mensajes);
?>