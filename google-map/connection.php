<?php
$con = mysql_connect("localhost", "root", "");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("db_crash", $con);