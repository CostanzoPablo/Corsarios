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
}

$proximaCosto = 30 * $nivel;

echo '<div align="center" id="" onclick="javascript:mejorar();">Requiere Oro: ' . $proximaCosto . '</div>';
?>
