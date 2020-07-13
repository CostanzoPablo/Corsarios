<?php
$con = mysqli_connect("localhost", "lanormal_user", "lanormal");
if (!$con) {
    echo 'Could not connect: ' . mysqli_error($con);
    die();
}
mysqli_select_db($con, 'corsarios');
require './hack.php';

include './core.php';
?>

