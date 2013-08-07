<?php
/**
 * This script create the struct of database
 */
include("connection.php");
include("functions.php");
$path_file = isset($_GET["file"]) ? $_GET["file"] : "struct.sql";
$struct = file_get_contents($path_file, TRUE);

$result = mysql_query($struct);

if ($result) {
	echo "The sql file is execute and create the table";
} else {
	echo "Not was possible execute the query";
}