<?php
/**
 * Check data form database
 */
set_time_limit(0);
include("connection.php");
include("functions.php");

$sql = "SELECT COUNT(`case_id`) AS `sub_total`, `collision_year`
FROM `collision`
INNER JOIN `collision_point` ON (`collision`.`case_id` = `collision_point`.`Field1`)
GROUP BY `collision_year`";

$rows = mysql_query($sql);
while ($row =  mysql_fetch_object($rows)) {
	echo $row->collision_year . ": " . $row->sub_total . "<br>";
}