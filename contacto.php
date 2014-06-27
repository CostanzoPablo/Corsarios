<?php
session_start();
include('./conectar.php');

	//Si no esta identificado y esta queriendo identificarse...
	if (!($_POST["contactoSeccion"] == "comentario" OR $_POST["contactoSeccion"] == "sugerencia" OR $_POST["contactoSeccion"] == "bug")){
		die("Error interno del servidor");	
	}

	if (!filter_var($_POST["contactoMail"], FILTER_VALIDATE_EMAIL) OR $_POST["contactoMail"] == NULL) {
	    die("El mail ingresado no es correcto");
	}

	if ($_POST["contactoMensaje"] == NULL){
		die('Error interno del servidor');
	}

	$ahora = time();

	$sql=("INSERT INTO contacto (mail, seccion, mensaje, fecha, estado, comentario) VALUES ('$_POST[contactoMail]', '$_POST[contactoSeccion]', '$_POST[contactoMensaje]', '$ahora', '0', ' ')");
	if (!mysql_query($sql,$con)){
		  die('error' . mysql_error());
	    }	
	
    echo 'ok';	
?>
