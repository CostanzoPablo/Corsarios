<?php
session_start();
include './conectar.php';
include './checkMensajes.php';

if (!isset($_SESSION["player"])) {
    exit();
}

mysqli_query($con, "UPDATE mensajes SET leido = '1' WHERE id = '$_GET[mensaje]' AND player = '$_SESSION[player]'");

$mensajes = checkMensajes($con);
echo json_encode($mensajes);
?>
