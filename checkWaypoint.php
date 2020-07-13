<?php
function checkWaypoint($con)
{
    $sql = mysqli_query($con, "SELECT * FROM players WHERE id= '$_SESSION[player]'");
    while ($row = mysqli_fetch_array($sql)) {
        $posX = $row["posX"];
        $posY = $row["posY"];
    }

    $posicion = null;
    $sql = mysqli_query($con, "SELECT * FROM viajes WHERE player = '$_SESSION[player]'");
    while ($row = mysqli_fetch_array($sql)) {
        $posicion["x"] = $row["posX"] - $posX;
        $posicion["y"] = $row["posY"] - $posY;
        return $posicion;
    }
    return false;
}
?>
