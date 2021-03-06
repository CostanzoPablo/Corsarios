<?php
session_start();
include './conectar.php';

if (!isset($_SESSION["player"])) {
    exit();
}

$sql = mysqli_query($con, "SELECT * FROM players WHERE id = '$_SESSION[player]'");
while ($row = mysqli_fetch_array($sql)) {
    $posX = $row["posX"];
    $posY = $row["posY"];
    $undir = $row["undir"];
}

if ($undir > 0) {
    die('Te estas undiendo...');
}

if ($_GET["posX"] <= -1800) {
    $destinoX = $posX - 1800;
}
if ($_GET["posX"] >= 1800) {
    $destinoX = $posX + 1800;
}
if ($_GET["posY"] <= -1800) {
    $destinoY = $posY - 1800;
}
if ($_GET["posY"] >= 1800) {
    $destinoY = $posY + 1800;
}

$destinoX = $_GET["posX"] + $posX;
$destinoY = $_GET["posY"] + $posY;

$sql = "DELETE FROM viajes WHERE player = '$_SESSION[player]'";
if (!mysqli_query($con, $sql)) {
    die("error");
}

if ($_GET["posX"] >= 0 and $_GET["posY"] >= 0) {
    $cara = 90 * 0;
    $grados = $cara + (90 - rad2deg(abs(atan(abs($_GET["posY"] / $_GET["posX"])))));
}
if ($_GET["posX"] >= 0 and $_GET["posY"] <= 0) {
    $cara = 90 * 1;
    $grados = $cara + rad2deg(abs(atan(abs($_GET["posY"] / $_GET["posX"]))));
}
if ($_GET["posX"] <= 0 and $_GET["posY"] <= 0) {
    $cara = 90 * 2;
    $grados = $cara + (90 - rad2deg(abs(atan(abs($_GET["posY"] / $_GET["posX"])))));
}
if ($_GET["posX"] <= 0 and $_GET["posY"] >= 0) {
    $cara = 90 * 3;
    $grados = $cara + rad2deg(abs(atan(abs($_GET["posY"] / $_GET["posX"]))));
}

$direccion = ($grados * 1.575) / 90;

mysqli_query($con, "UPDATE players SET direction = '$direccion' WHERE id = '$_SESSION[player]'");

$ahora = time();
$sql = "INSERT INTO viajes (player, posX, posY, ucheck) VALUES ('$_SESSION[player]', '$destinoX', '$destinoY', '$ahora')";
if (!mysqli_query($con, $sql)) {
    die('error');
}

$posicion["x"] = $_GET["posX"];
$posicion["y"] = $_GET["posY"];

echo json_encode($posicion);
?>
