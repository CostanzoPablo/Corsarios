<?php
function checkPesca($con, $limite)
{
    $posX = null;
    $posY = null;
    $sql = mysqli_query($con, "SELECT * FROM players WHERE id= '$_SESSION[player]'");
    while ($row = mysqli_fetch_array($sql)) {
        $posX = $row["posX"];
        $posY = $row["posY"];
    }

    $minimoX = $posX - $limite;
    $minimoY = $posY - $limite;
    $maximoX = $posX + $limite;
    $maximoY = $posY + $limite;
    $ahora = time();
    $enemigos = null;

    $sql = mysqli_query(
        $con,
        "SELECT * FROM pesca WHERE posX >= '$minimoX' AND $posY >= '$minimoY' AND posX <= '$maximoX' AND posY <= '$maximoY'"
    );
    while ($row = mysqli_fetch_array($sql)) {
        $enemig = null;
        $enemig["id"] = $row["id"];
        $enemig["posX"] = $row["posX"] - $posX;
        $enemig["posY"] = $row["posY"] - $posY;
        $enemig["fecha"] = $row["fecha"];

        $enemigos[] = $enemig;
    }

    return $enemigos;
}

function checkAreaPesca($con, $limite)
{
    $posX = null;
    $posY = null;
    $sql = mysqli_query($con, "SELECT * FROM players WHERE id= '$_SESSION[player]'");
    while ($row = mysqli_fetch_array($sql)) {
        $posX = $row["posX"];
        $posY = $row["posY"];
    }

    $minimoX = $posX - $limite;
    $minimoY = $posY - $limite;
    $maximoX = $posX + $limite;
    $maximoY = $posY + $limite;

    $sql = mysqli_query(
        $con,
        "SELECT * FROM pesca WHERE player = '$_SESSION[player]' AND posX >= '$minimoX' AND $posY >= '$minimoY' AND posX <= '$maximoX' AND posY <= '$maximoY'"
    );
    while ($row = mysqli_fetch_array($sql)) {
        return true;
    }

    return false;
}

function checkJaulas($con)
{
    $total = 0;
    $sql = mysqli_query($con, "SELECT * FROM pesca WHERE player = '$_SESSION[player]'");
    while ($row = mysqli_fetch_array($sql)) {
        $total = $total + 1;
    }

    return $total;
}
?>
