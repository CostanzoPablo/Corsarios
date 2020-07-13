<?php
//calcular viajes

$sql = mysqli_query($con, "SELECT * FROM viajes ORDER by ucheck ASC");
while ($row = mysqli_fetch_array($sql)) {
    $ahora = time();
    $delta = $ahora - $row["ucheck"];
    $velocidad = 4;

    $sky = date("H", time());
    $dia = date("N", time());
    if ($sky >= 0 and $sky <= 5 and $dia == 6 or $sky >= 20 and $sky <= 23 and $dia == 5) {
        $velocidad = $velocidad * 7;
    }

    $sql2 = mysqli_query($con, "SELECT * FROM players WHERE id = '$row[player]'");
    while ($row2 = mysqli_fetch_array($sql2)) {
        $core_playerX = $row2["posX"];
        $core_playerY = $row2["posY"];
    }

    $core_diferenciaX = abs($core_playerX - $row["posX"]);
    $core_diferenciaY = abs($core_playerY - $row["posY"]);

    if ($core_diferenciaX > $core_diferenciaY) {
        $pasosX = 1 * $delta * $velocidad;
        $pasosY = ($core_diferenciaY / $core_diferenciaX) * $delta * $velocidad;
    } else {
        $pasosX = ($core_diferenciaX / $core_diferenciaY) * $delta * $velocidad;
        $pasosY = 1 * $delta * $velocidad;
    }

    if ($core_diferenciaX > $pasosX) {
        if ($core_playerX > $row["posX"]) {
            $core_playerX -= $pasosX;
        } else {
            $core_playerX += $pasosX;
        }
    } else {
        $core_playerX = $row["posX"];
    }

    if ($core_diferenciaY > $pasosY) {
        if ($core_playerY > $row["posY"]) {
            $core_playerY -= $pasosY;
        } else {
            $core_playerY += $pasosY;
        }
    } else {
        $core_playerY = $row["posY"];
    }

    mysqli_query($con, "UPDATE players SET posX = '$core_playerX' WHERE id = '$row[player]'");
    mysqli_query($con, "UPDATE players SET posY = '$core_playerY' WHERE id = '$row[player]'");
    mysqli_query($con, "UPDATE viajes SET ucheck = '$ahora' WHERE player = '$row[player]'");

    if (abs(abs($core_playerX) - abs($row["posX"])) <= 2 and abs(abs($core_playerY) - abs($row["posY"])) <= 2) {
        $sql2 = "DELETE FROM viajes WHERE player = '$row[player]'";
        if (!mysqli_query($con, $sql2)) {
            die("error");
        }
    }
}
?>
