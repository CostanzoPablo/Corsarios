<?php
function checkMensajes($con){
	$mensajes = array();
	$sql=mysql_query("SELECT * FROM mensajes WHERE player = '$_SESSION[player]'",$con);
	while($row = mysql_fetch_array($sql)){
		$mensaje = null;
		$mensaje['id'] = $row["id"];
		$mensaje['titulo'] = $row["titulo"];
		$mensaje['mensaje'] = $row["mensaje"];
		$mensaje['fecha'] = date("d/m/Y H:i", $row["fecha"]);
		$mensaje['leido'] = $row["leido"];
		$mensajes[] = $mensaje;
	}	
	return $mensajes;
}
?>