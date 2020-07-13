<?php
session_start();
include './conectar.php';

if (!isset($_SESSION["player"])) {
    exit();
}

if ($_SESSION["player"] == $_GET["target"]) {
    die('Imposible atacarte');
}

$sql = mysqli_query($con, "SELECT * FROM players WHERE id = '$_SESSION[player]'");
while ($row = mysqli_fetch_array($sql)) {
    $direccion = $row["direction"];
    $nivel = $row["nivel"];
    $posX = $row["posX"];
    $posY = $row["posY"];
    $undir = $row["undir"];

    if ($row["ataque"] > time()) {
        echo 'alistando';
        exit();
    }
}

if ($undir > 0) {
    die('pu');
}

$destinoX = null;
$destinoY = null;

$sql = mysqli_query($con, "SELECT * FROM mobs WHERE id = '$_GET[target]'");
while ($row = mysqli_fetch_array($sql)) {
    $destinoX = $row["posX"];
    $destinoY = $row["posY"];
}

if ($destinoX == null or $destinoY == null) {
    die('eu');
}

$ahora = time() + 6;

mysqli_query($con, "UPDATE players SET ataque = '$ahora' WHERE id = '$_SESSION[player]'");

if ($destinoX - $posX >= 0 and $destinoY - $posY >= 0) {
    $cara = 90 * 0;
    $grados = $cara + (90 - rad2deg(abs(atan(abs(($destinoY - $posY) / (abs($destinoX - $posX) + 0.00001))))));
}
if ($destinoX - $posX >= 0 and $destinoY - $posY <= 0) {
    $cara = 90 * 1;
    $grados = $cara + rad2deg(abs(atan(abs(($destinoY - $posY) / (abs($destinoX - $posX) + 0.00001)))));
}
if ($destinoX - $posX <= 0 and $destinoY - $posY <= 0) {
    $cara = 90 * 2;
    $grados = $cara + (90 - rad2deg(abs(atan(abs(($destinoY - $posY) / (abs($destinoX - $posX) + 0.00001))))));
}
if ($destinoX - $posX <= 0 and $destinoY - $posY >= 0) {
    $cara = 90 * 3;
    $grados = $cara + rad2deg(abs(atan(abs(($destinoY - $posY) / (abs($destinoX - $posX) + 0.00001)))));
}

$direccion = ($grados * 1.575) / 90;

$caduca = time() + 6;

$danio = $nivel * 1;
$danioMob = $danio / 5;

$sky = date("H", time());
$dia = date("N", time());
if ($sky >= 0 and $sky <= 5 and $dia == 6 or $sky >= 20 and $sky <= 23 and $dia == 5) {
    $danio = $danio * 7;
}

if ($nivel <= 10) {
    $arma = 'Lanza';
}
if ($nivel >= 11 and $nivel <= 20) {
    $arma = 'Flecha';
}
if ($nivel >= 21 and $nivel <= 30) {
    $arma = 'FlechaFuego';
}
if ($nivel >= 31 and $nivel <= 40) {
    $arma = 'Canion';
}
if ($nivel >= 41) {
    $arma = 'CanionFuego';
}

$sql = "INSERT INTO ataques (player, enemig, origenX, origenY, posX, posY, fecha, direccion, danio, arma, atack) VALUES ('$_SESSION[player]', '$_GET[target]', '$posX', '$posY', '$destinoX', '$destinoY', '$caduca', '$direccion', '$danio', '$arma', 'mob')";
if (!mysqli_query($con, $sql)) {
    die('error');
}

$sql = "INSERT INTO ataques (player, enemig, origenX, origenY, posX, posY, fecha, direccion, danio, arma, atack) VALUES ('$_GET[target]', '$_SESSION[player]', '$destinoX', '$destinoY', '$posX', '$posY', '$caduca', '$direccion', '$danioMob', '$arma', 'player')";
if (!mysqli_query($con, $sql)) {
    die('error');
}

echo 'ok';
