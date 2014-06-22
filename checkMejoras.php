<?php
session_start();
include('./conectar.php');


if (!isset($_SESSION["player"])){
	exit();
}		



$sql=mysql_query("SELECT * FROM players WHERE id = '$_SESSION[player]'",$con);
while($row = mysql_fetch_array($sql)){
	$oro = $row["oro"];
	$nivel = $row["nivel"];
}

$proximaCosto = 30 * $nivel;

echo '<div align="center" id="" onclick="javascript:mejorar();">Requiere Oro: '.$proximaCosto.'</div>';		
?>