<?php

function checkMobs($con, $limite)
{
    $posX = null;
    $posY = null;
    $sql = mysqli_query($con, "SELECT * FROM players WHERE id = '$_SESSION[player]'");
    while ($row = mysqli_fetch_array($sql)) {
        $posX = $row["posX"];
        $posY = $row["posY"];
        $vida = $row["vida"];
    }

    $minimoX = $posX - $limite;
    $minimoY = $posY - $limite;
    $maximoX = $posX + $limite;
    $maximoY = $posY + $limite;
    $ahora = time();
    $enemigos = null;

    $sql = mysqli_query(
        $con,
        "SELECT *  FROM mobs WHERE posX >= '$minimoX' AND $posY >= '$minimoY' AND posX <= '$maximoX' AND posY <= '$maximoY'"
    );
    while ($row = mysqli_fetch_array($sql)) {
        $enemig = null;
        $enemig["id"] = $row["id"];
        $enemig["posX"] = $row["posX"] - $posX;
        $enemig["posY"] = $row["posY"] - $posY;
        if ($row["vidaTotal"] > 0) {
            $enemig["vida"] = intval(($row["vida"] * 100) / $row["vidaTotal"]);
        } else {
            $enemig["vida"] = 0;
        }
        $enemig["model"] = $row["model"];
        $enemig["direction"] = $row["direction"];
        $enemigos[] = $enemig;
    }
    if ($enemigos != null && count($enemigos) < 20) {
        if (rand(1, 1000) >= 950) {
            $nPosX = rand(-1000, 1000) + $posX;
            $nPosY = rand(-1000, 1000) + $posY;
            $nVida = intval(rand($vida / 2, $vida + $vida / 4));
            $nModel = 'Tortuga';
            $nDirection = 0;
            $nOro = ceil($nVida / 5) + 1;
            $sql = "INSERT INTO mobs (vida, posX, posY, model, direction, oro, vidaTotal) VALUES ('$nVida', '$nPosX', '$nPosY', '$nModel', '$nDirection', '$nOro', '$nVida')";
            if (!mysqli_query($sql, $con)) {
                die('error');
            }
        }
    }
    return $enemigos;
}
?>
