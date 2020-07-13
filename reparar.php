<?php
session_start();
include './conectar.php';

if (!isset($_SESSION["player"])) {
    exit();
}

$sql = mysqli_query($con, "SELECT * FROM players WHERE id = '$_SESSION[player]'");
while ($row = mysqli_fetch_array($sql)) {
    $oro = $row["oro"];
    $nivel = $row["nivel"];
    $vida = $row["vida"];
}

if ($oro < $nivel) {
    echo 'oro';
} else {
    $nuevoOro = $oro - $nivel;
    mysqli_query($con, "UPDATE players SET oro = '$nuevoOro' WHERE id = '$_SESSION[player]'");
    $vida = 10 * $nivel;
    mysqli_query($con, "UPDATE players SET vida = '$vida' WHERE id = '$_SESSION[player]'");
    echo 'ok';
}
?>
