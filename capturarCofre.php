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
    die('Te estas hundiendo...');
}

$existe = false;
$sql = mysqli_query($con, "SELECT * FROM cofres WHERE id = '$_GET[cofre]'");
while ($row = mysqli_fetch_array($sql)) {
    $existe = true;
    $oroCofre = $row["oro"];
    $cofrePosX = $row["posX"];
    $cofrePosY = $row["posY"];
}

if ($existe == false) {
    die('existe');
}

if (abs(abs($posX) - abs($cofrePosX)) < 300 and abs(abs($posY) - abs($cofrePosY)) < 300) {
    $ahora = time();
    $oro += $oroCofre;
    mysqli_query($con, "UPDATE players SET oro = '$oro' WHERE id = '$_SESSION[player]'");
    $mensaje = 'Oro del cofre: ' . $oroCofre . '<br>Ahora tenes: ' . $oro;
    $sql = "INSERT INTO mensajes (player, titulo, mensaje, fecha, leido) VALUES ('$_SESSION[player]', 'Cofre capturado', '$mensaje', '$ahora', '0')";
    if (!mysqli_query($con, $sql)) {
        die('error');
    }
} else {
    die('lejos');
}

//mysqli_query($con,  "UPDATE players SET direction = '$direccion' WHERE id = '$_SESSION[player]'");

$sql = "DELETE FROM cofres WHERE id = '$_GET[cofre]'";
if (!mysqli_query($con, $sql)) {
    die("error");
}

echo 'ok';
?>
