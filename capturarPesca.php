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
    $oro = $row["oro"];
}

if ($undir > 0) {
    die('Te estas undiendo...');
}

$existe = false;
$sql = mysqli_query($con, "SELECT * FROM pesca WHERE id = '$_GET[pesca]'");
while ($row = mysqli_fetch_array($sql)) {
    $existe = true;
    $delta = time() - $row["fecha"];
    $playerRed = $row["player"];
    $oroPesca = rand(intval((((time() - $row["fecha"]) / 60) * 20) / 100), intval((time() - $row["fecha"]) / 60));
    $pescaPosX = $row["posX"];
    $pescaPosY = $row["posY"];
}

if ($existe == false) {
    die('existe');
}

if ($playerRed != $_SESSION["player"]) {
    //le robaron la red al $playerRed...
    $mensaje = 'Te robaron la red ' . $pescaPosX . ':' . $pescaPosY;
    $sql = "INSERT INTO mensajes (player, titulo, mensaje, fecha, leido) VALUES ('$playerRed', 'Pesca robada', '$mensaje', '$ahora', '0')";
    if (!mysqli_query($con, $sql)) {
        die('error');
    }
}

if (abs(abs($posX) - abs($pescaPosX)) < 300 and abs(abs($posY) - abs($pescaPosY)) < 300) {
    $ahora = time();
    $oro += $oroPesca;
    mysqli_query($con, "UPDATE players SET oro = '$oro' WHERE id = '$_SESSION[player]'");
    $mensaje = 'Oro segun la venta de la pesca: ' . $oroPesca . '<br>Ahora tenes: ' . $oro;
    $sql = "INSERT INTO mensajes (player, titulo, mensaje, fecha, leido) VALUES ('$_SESSION[player]', 'Pesca capturada', '$mensaje', '$ahora', '0')";
    if (!mysqli_query($con, $sql)) {
        die('error');
    }
} else {
    die(
        'lejos Ya que Tu pos X: ' .
            $posX .
            ' - Red X: ' .
            $pescaPosX .
            ' es > 300 o.... Tu pos Y: ' .
            $posY .
            ' - Red Y: ' .
            $pescaPosY .
            ' es > 300'
    );
}

$sql = "DELETE FROM pesca WHERE id = '$_GET[pesca]'";
if (!mysqli_query($con, $sql)) {
    die("error");
}

echo 'ok';
?>
