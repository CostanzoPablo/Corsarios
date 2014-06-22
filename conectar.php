<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  echo 'Could not connect: ' . mysql_error();
  die();
  }
mysql_select_db('corsarios', $con);
require('./hack.php');

include('./core.php');
?>

