<?php
session_start();
include './conectar.php';
include './checkRedes.php';

if (!isset($_SESSION["player"])) {
    exit();
}

echo json_encode(checkRedes($con));
?>
