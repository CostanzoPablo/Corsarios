<?php

function checkReubicar($con)
{
    $ahora = time() - 60;
    $sql = mysqli_query($con, "SELECT * FROM players WHERE undir < '$ahora' AND undir > '0'");
    while ($row = mysqli_fetch_array($sql)) {
        $nPosX = rand(-10000, 10000);
        $nPosY = rand(-10000, 10000);
        mysqli_query($con, "UPDATE players SET posX = '$nPosX' WHERE id = '$row[id]'");
        mysqli_query($con, "UPDATE players SET posY = '$nPosY' WHERE id = '$row[id]'");
        mysqli_query($con, "UPDATE players SET undir = '0' WHERE id = '$row[id]'");
        $vida = $row["nivel"] * 10;
        mysqli_query($con, "UPDATE players SET vida = '$vida' WHERE id = '$row[id]'");
    }
}
?>
