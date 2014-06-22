<?php
session_start();
include('./conectar.php');
	//Si no esta identificado y esta queriendo identificarse...
	
	if (isset($_GET["nick"])){ 
		$nick = $_GET["nick"];
		$pass = md5('fempire42014'.$_GET["pass"]);
	}
	if (isset($_POST["nick"])){ 
		$nick = $_POST["nick"];
		$pass = md5('fempire42014'.$_POST["pass"]);
	}
	$sql=mysql_query("SELECT * FROM players WHERE nick = '$nick' AND pass = '$pass'",$con);
	while($row = mysql_fetch_array($sql)){
		$_SESSION["player"] = $row["id"];
		if ($row["ban"] <= time()){
			$_SESSION["player"] = $row["id"];
		}else{
			echo 'Cuenta suspendida hasta '.date("d/m/Y H:i", $row["ban"]);
		}
	}	
	if (!isset($_SESSION["player"])){
		echo "login"; 
	}else{
		echo 'ok';
	}		

?>
