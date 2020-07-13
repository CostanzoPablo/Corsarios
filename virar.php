<?php
session_start();
include './conectar.php';

if (!isset($_SESSION["player"])) {
    exit();
}

$sql = "DELETE FROM viajes WHERE player = '$_SESSION[player]'";
if (!mysqli_query($con, $sql)) {
    die("error");
}

$virar = $_GET["virar"];
if ($virar < 1) {
    $virar = 0;
}
if ($virar > 359) {
    $virar = 360;
}

$direccion = ($virar * 1.575) / 90;

mysqli_query($con, "UPDATE players SET direction = '$direccion' WHERE id = '$_SESSION[player]'");

?>
