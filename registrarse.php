<?php
session_start();
include('./conectar.php');

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


	//insert into.... etc
	$posX = rand(-10000, 10000);
	$posY = rand(-10000, 10000);
	$ahora = time();
	$pass = md5('fempire42014'.$_GET["pass"]);
    $sql=("INSERT INTO players (mail, nick, pass, posX, posY, undir, vida, direction, fog, uclick, ban, autentificado, ataque, oro, nivel) VALUES ('$_GET[mail]', '$_GET[nick]', '$pass', '$posX', '$posY', '0', '10', '3.15', '0', '$ahora', '0', '0', '0', '0', '1')");
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