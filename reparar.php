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
	$vida = $row["vida"];
}

if ($oro < $nivel){
    echo 'oro';
}else{
	$nuevoOro = $oro - $nivel;
	mysql_query("UPDATE players SET oro = '$nuevoOro' WHERE id = '$_SESSION[player]'");
	$vida = 10 * $nivel;
	mysql_query("UPDATE players SET vida = '$vida' WHERE id = '$_SESSION[player]'");
	echo 'ok';
}
?>