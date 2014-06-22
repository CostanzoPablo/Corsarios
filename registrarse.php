<?php
session_start();
include('./conectar.php');

	if (isset($_SESSION["player"])){
		die("logout"); 
	}		
	$nick = null;
	if (isset($_POST["registrarseNick"])){
		//Si no esta identificado y esta queriendo identificarse...
		if (strlen($_POST["registrarseClave"]) < 8){
			die("password");	
		}

		if (!filter_var($_POST["registrarseMail"], FILTER_VALIDATE_EMAIL) OR $_POST["registrarseMail"] == NULL) {
		    die("mail");
		}

		$sql=mysql_query("SELECT * FROM players WHERE nick = '$_POST[registrarseNick]'",$con);
		while($row = mysql_fetch_array($sql)){
			die('existeNick');
		}	

		$sql=mysql_query("SELECT * FROM players WHERE mail = '$_POST[registrarseMail]'",$con);
		while($row = mysql_fetch_array($sql)){
			die('existeMail');
		}
		$mail = $_POST["registrarseMail"];	
		$nick = $_POST["registrarseNick"];
		$pass = md5('fempire42014'.$_POST["registrarseClave"]);
	}

	if (isset($_GET["nick"])){
		//Si no esta identificado y esta queriendo identificarse...
		if (strlen($_GET["pass"]) < 8){
			die("password");	
		}

		if (isset($_SESSION["player"])){
			die("logout"); 
		}		

		if (!filter_var($_GET["mail"], FILTER_VALIDATE_EMAIL) OR $_GET["mail"] == NULL) {
		    die("mail");
		}

		$sql=mysql_query("SELECT * FROM players WHERE nick = '$_GET[nick]'",$con);
		while($row = mysql_fetch_array($sql)){
			die('existeNick');
		}	

		$sql=mysql_query("SELECT * FROM players WHERE mail = '$_GET[mail]'",$con);
		while($row = mysql_fetch_array($sql)){
			die('existeMail');
		}	
		$mail = $_GET["mail"];	
		$nick = $_GET["nick"];
		$pass = md5('fempire42014'.$_GET["pass"]);
	}

	if ($nick == NULL){
		die('Error interno del servidor');
	}
	//insert into.... etc
	$posX = rand(-10000, 10000);
	$posY = rand(-10000, 10000);
	$ahora = time();

	$sql=("INSERT INTO players (mail, nick, pass, posX, posY, undir, vida, direction, fog, uclick, ban, autentificado, ataque, oro, nivel) VALUES ('$mail', '$nick', '$pass', '$posX', '$posY', '0', '10', '3.15', '0', '$ahora', '0', '0', '0', '0', '1')");
	if (!mysql_query($sql,$con)){
		  die('error' . mysql_error());
	    }	
	
	$_SESSION["player"] = mysql_insert_id();

	//enviar mail con datos de login
	if (!isset($_SESSION["player"])){
		echo "error"; 
	}else{
	    echo 'ok';	
	}		
?>
