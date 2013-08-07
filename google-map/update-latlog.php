<?php
/**
 * Update database by position latitude and longitude
 */
set_time_limit(0);
include("connection.php");
include("functions.php");

$county = isset($_GET["county"]) ? $_GET["county"] : "3400";
$sql = "SELECT count(*) AS `total`
FROM `collision_point`
WHERE `Field2` = '{$county}'";
//IN (
// '3400',  '3401',  '3402',  '3403',  '3404',  '3408',  '3412',  '3422',  '3433',  '3450',  '3490',  '3496',  '3497'
//)";

$rows = mysql_query($sql);
$total = 0;
if ($row =  mysql_fetch_object($rows)) {
	$total = $row->total;
}
$start = 0;
$qr = 10;
$stages = ceil($total/$qr);

for($i = 0; $i < $stages; $i++) {
	$values = array();
	$key = 0;
	$start = $qr * $i;
	$sql = "SELECT `Field2`, `latitude`, `longitude`
	FROM `collision_point`
	WHERE `Field2` = '{$county}'
	LIMIT {$start}, {$qr}";
	$rows = mysql_query($sql);
	while ($row = mysql_fetch_object($rows)) {
		$values[$key++] = array(
			"case_id" => $row->Field2,
			"latitude" => $row->latitude,
			"longitude" => $row->longitude
		);
	}

	foreach ($values as $row) {
		$sql = sprintf("UPDATE `collision` SET `latitude` = %s, `longitude` = %s WHERE `case_id` = %s LIMIT 1", $row["latitude"], $row["longitude"], $row["case_id"]);

		$result = mysql_query($sql);
	}

}

echo "done!";