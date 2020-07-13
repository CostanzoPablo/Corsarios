<?php
function targetExiste($con, $unTarget)
{
    $sql = mysqli_query($con, "SELECT * FROM players WHERE id = '$unTarget'");
    while ($row = mysqli_fetch_array($sql)) {
        return true;
    }
    return false;
}

function estaEnRadio($con, $unTarget)
{
    $sql = mysqli_query($con, "SELECT * FROM players WHERE id = '$unTarget'");
    while ($row = mysqli_fetch_array($sql)) {
        $targetX = $row["posX"];
        $targetY = $row["posY"];
    }
    $sql = mysqli_query($con, "SELECT * FROM players WHERE id = '$_SESSION[player]");
    while ($row = mysqli_fetch_array($sql)) {
        $playerX = $row["posX"];
        $playerY = $row["posY"];
    }
    $diferenciaX = abs($targetX - $playerX);
    $diferenciaY = abs($targetY - $playerX);
    if ($diferenciaX + $diferenciaY > 1800) {
        return false;
    } else {
        return true;
    }
}

function playerIdentificado()
{
    return isset($_SESSION["player"]);
}
?>
