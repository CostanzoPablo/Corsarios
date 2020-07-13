<?php
session_start();
include './conectar.php';
include './checkPesca.php';

if (!isset($_SESSION["player"])) {
    exit();
}

$sql = mysqli_query($con, "SELECT * FROM players WHERE id = '$_SESSION[player]'");
while ($row = mysqli_fetch_array($sql)) {
    $direccion = $row["direction"];
    $posX = $row["posX"];
    $posY = $row["posY"];
    $limiteJaulas = $row["nivel"];
}

if (checkAreaPesca($con, 1800 / 4)) {
    die('area');
}

if (checkJaulas($con) >= $limiteJaulas) {
    die('maximo');
}

$ahora = time();

$sql = "INSERT INTO pesca (player, fecha, posX, posY) VALUES ('$_SESSION[player]', '$ahora', '$posX', '$posY')";
if (!mysqli_query($sql, $con)) {
    die('error');
}

echo 'ok';
?>
