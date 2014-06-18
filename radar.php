<?php
session_start();
include('./conectar.php');
include('./checkEnemigs.php');

if (!isset($_SESSION["player"])){
	exit();
}		

echo json_encode(checkEnemigs($con, 10000));
?>