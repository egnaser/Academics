<?php
//root is the username my is the password
/*
$connect=mysql_connect('sql211.byethost5.com','b5_17808933','morgan1');
if($connect===FALSE)
die("connection  failed");
$database=mysql_select_db("b5_17808933_test");

if($database===FALSE)
die('could not find database');
else
echo "successfully connected to database";
*/
?>


<?php
//root is the username mysql is the password
$connect=mysql_connect('localhost','root','mysql');
if($connect===FALSE)
	die("connection  failed");
$database=mysql_select_db("technophilia");
if($database===FALSE)
	die('could not find database');
?>
