<?php

$connect_string   = 'localhost';
$connect_username = 'root';
$connect_password = '';
$connect_db       = 'calendardoc';
$link             = mysql_connect($connect_string, $connect_username, $connect_password) or die(mysql_error());
$connect          = mysql_select_db($connect_db, $link) or die(mysql_error());
?>
