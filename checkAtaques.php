<?php

function garbageAtaques($con)
{
    $ahora = time();
    $sql = mysqli_query(
        $con,
        "SELECT *, (SELECT oro FROM players WHERE id = A.enemig) as oroEnemigo, (SELECT vida FROM players WHERE id = A.enemig) as vidaEnemigo FROM ataques as A WHERE fecha < '$ahora' AND atack = 'player'"
    );
    while ($row = mysqli_fetch_array($sql)) {
        if ($row["danio"] > 0) {
            //sacarle vida al enemig
            $vidaEnemigo = $row["vidaEnemigo"] - $row["danio"];

            if ($vidaEnemigo <= 0) {
                $oroEnemigo = $row["oroEnemigo"];
                if ($row["oroEnemigo"] > 0) {
                    $cofre = floor($oroEnemigo / 2);
                    $oroEnemigo = $oroEnemigo - $cofre;
                } else {
                    $cofre = 0;
                }

                if ($oroEnemigo < 0) {
                    $oroEnemigo = 0;
                }
                $sql2 = "INSERT INTO cofres (oro, posX, posY) VALUES ('$cofre', '$row[posX]', '$row[posY]')";
                if (!mysqli_query($con, $sql2)) {
                    die('error');
                }

                mysqli_query($con, "UPDATE players SET oro = '$oroEnemigo' WHERE id = '$row[enemig]'");

                $undir = time();
                mysqli_query($con, "UPDATE players SET undir = '$undir' WHERE id = '$row[enemig]'");
            } else {
                mysqli_query($con, "UPDATE players SET vida = '$vidaEnemigo' WHERE id = '$row[enemig]'");
            }
        }
        //borrar el ataque
        $sql2 = "DELETE FROM ataques WHERE id = '$row[id]'";
        if (!mysqli_query($con, $sql2)) {
            die("error");
        }
    }
}

function checkAtaques($con, $limite)
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
        "SELECT * FROM ataques WHERE posX >= '$minimoX' AND $posY >= '$minimoY' AND posX <= '$maximoX' AND posY <= '$maximoY'"
    );
    while ($row = mysqli_fetch_array($sql)) {
        $enemig = null;
        $enemig["id"] = $row["id"];
        $enemig["posX"] = $row["posX"] - $posX;
        $enemig["posY"] = $row["posY"] - $posY;
        $enemig["fecha"] = $row["fecha"];
        $enemig["origenX"] = $row["origenX"] - $posX;
        $enemig["origenY"] = $row["origenY"] - $posY;
        $enemig["direccion"] = $row["direccion"];
        $enemig["arma"] = $row["arma"];
        $enemigos[] = $enemig;
    }

    return $enemigos;
}

function garbageMobAtaques($con)
{
    $ahora = time();
    $sql = mysqli_query(
        $con,
        "SELECT *, (SELECT oro FROM mobs WHERE id = A.enemig) as oroEnemigo, (SELECT vida FROM mobs WHERE id = A.enemig) as vidaEnemigo FROM ataques as A WHERE fecha < '$ahora' AND atack = 'mob'"
    );
    while ($row = mysqli_fetch_array($sql)) {
        if ($row["danio"] > 0) {
            //sacarle vida al enemigo
            $vidaEnemigo = $row["vidaEnemigo"] - $row["danio"];

            if ($vidaEnemigo <= 0) {
                $sql2 = "INSERT INTO cofres (oro, posX, posY) VALUES ('$row[oroEnemigo]', '$row[posX]', '$row[posY]')";
                if (!mysqli_query($con, $sql2)) {
                    die('error');
                }

                $sql2 = "DELETE FROM mobs WHERE id = '$row[enemig]'";
                if (!mysqli_query($con, $sql2)) {
                    die("error");
                }
            } else {
                mysqli_query($con, "UPDATE mobs SET vida = '$vidaEnemigo' WHERE id = '$row[enemig]'");
            }
        }
        //borrar el ataque
        $sql2 = "DELETE FROM ataques WHERE id = '$row[id]'";
        if (!mysqli_query($con, $sql2)) {
            die("error");
        }
    }
}

?>
