<?php
function checkPlayerData($con)
{
    $enemig = null;

    $sql = mysqli_query(
        $con,
        "SELECT *, (SELECT count(id) FROM pesca WHERE player = players.id) as redesUsadas FROM players WHERE id = '$_SESSION[player]'"
    );
    while ($row = mysqli_fetch_array($sql)) {
        $enemig["nick"] = $row["nick"];
        $enemig["id"] = $row["id"];
        $enemig["direction"] = $row["direction"];
        $enemig["posX"] = $row["posX"];
        $enemig["posY"] = -4;
        $enemig["posZ"] = $row["posY"];
        $enemig["oro"] = $row["oro"];
        $enemig["redesTotal"] = $row["nivel"];
        $enemig["redesUsadas"] = $row["nivel"] - $row["redesUsadas"];
        $enemig["vidaTope"] = $row["nivel"] * 10;
        $enemig["vida"] = intval(($row["vida"] * 100) / ($row["nivel"] * 10));
    }

    return $enemig;
}
?>
