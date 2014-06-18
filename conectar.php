<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  echo 'Could not connect: ' . mysql_error();
  die();
  }
mysql_select_db('fempire4', $con);
require('./hack.php');

include('./core.php');
?>

