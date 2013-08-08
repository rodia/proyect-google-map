<?php
/**
 * Check data form database
 */
set_time_limit(0);
include("connection.php");
include("functions.php");

$year = isset($_GET["year"]) ? $_GET["year"] : "2009";
$sql = sprintf("DELETE FROM collision WHERE `collision_year` = %s", $year);

if (mysql_query($sql)) {
	echo "done";
} else {
	echo "eror";
}