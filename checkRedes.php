<?php

function checkRedes($con)
{
    $posX = null;
    $posY = null;
    $sql = mysqli_query($con, "SELECT * FROM players WHERE id= '$_SESSION[player]'");
    while ($row = mysqli_fetch_array($sql)) {
        $posX = $row["posX"];
        $posY = $row["posY"];
    }

    $enemigos = null;

    $sql = mysqli_query($con, "SELECT * FROM pesca WHERE player = '$_SESSION[player]'");
    while ($row = mysqli_fetch_array($sql)) {
        $enemig = null;

        $enemig["posX"] = $row["posX"] - $posX;
        $enemig["posZ"] = $row["posY"] - $posY;

        $enemig["posXreal"] = $row["posX"];
        $enemig["posYreal"] = $row["posY"];

        $enemig["distancia"] = round((abs($row["posX"] - $posX) + abs($row["posY"] - $posY)) / 1000, 2);
        if ($row["posX"] - $posX != 0) {
            if ($row["posX"] - $posX >= 0 and $row["posY"] - $posY >= 0) {
                $cara = 90 * 0;
                $grados = $cara + (90 - rad2deg(abs(atan(abs(($row["posY"] - $posY) / abs($row["posX"] - $posX))))));
            }
            if ($row["posX"] - $posX >= 0 and $row["posY"] - $posY <= 0) {
                $cara = 90 * 1;
                $grados = $cara + rad2deg(abs(atan(abs(($row["posY"] - $posY) / abs($row["posX"] - $posX)))));
            }
            if ($row["posX"] - $posX <= 0 and $row["posY"] - $posY <= 0) {
                $cara = 90 * 2;
                $grados = $cara + (90 - rad2deg(abs(atan(abs(($row["posY"] - $posY) / abs($row["posX"] - $posX))))));
            }
            if ($row["posX"] - $posX <= 0 and $row["posY"] - $posY >= 0) {
                $cara = 90 * 3;
                $grados = $cara + rad2deg(abs(atan(abs(($row["posY"] - $posY) / abs($row["posX"] - $posX)))));
            }
        } else {
            $cara = 90 * 3;
            $grados = $cara + rad2deg(abs(atan(abs(($row["posY"] - $posY) / 0.1))));
        }
        $direccion = ($grados * 1.575) / 90;

        $enemig["grados"] = $grados;
        $enemigos[] = $enemig;
    }

    return $enemigos;
}
?>
