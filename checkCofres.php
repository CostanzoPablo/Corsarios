<?php

function checkCofres($con, $limite)
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
        "SELECT *  FROM cofres WHERE posX >= '$minimoX' AND $posY >= '$minimoY' AND posX <= '$maximoX' AND posY <= '$maximoY'"
    );
    while ($row = mysqli_fetch_array($sql)) {
        $enemig = null;
        $enemig["id"] = $row["id"];
        $enemig["posX"] = $row["posX"] - $posX;
        $enemig["posY"] = $row["posY"] - $posY;
        //$enemig["oro"] = $row["oro"];

        $enemigos[] = $enemig;
    }

    return $enemigos;
}
?>
