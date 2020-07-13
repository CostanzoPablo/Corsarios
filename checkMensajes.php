<?php
function checkMensajes($con)
{
    $mensajes = [];
    $sql = mysqli_query($con, "SELECT * FROM mensajes WHERE player = '$_SESSION[player]'");
    while ($row = mysqli_fetch_array($sql)) {
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
