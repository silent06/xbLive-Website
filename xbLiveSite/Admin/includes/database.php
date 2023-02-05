<?php
$DB_HOST = "root.silent.hosted.nfoservers.com";
$DB_NAME = "silentwebhost_xbnetwork";
$DB_USER = "silentwebhost";
$DB_PASS = "";
// TURN OFF STRICT MYSQL MODE
$strict = "SET sql_mode = ''";
$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if(mysqli_connect_errno())
{
	die("Not Connection To MySQL Database " . mysqli_connect_error());
}
?>