<?php
/**
 * This script retrive the data in json encode.
 *
 * @package default
 * @author Rodia  <rodia.piedra@gmail.com>
 */
header("Content-type: application/json");

/**
 * Implement cache
 */
//$settings_cachedir = 'cache/';
//$settings_cachetime = 86400;
////Pagina php
//$thispage = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//$cachelink = $settings_cachedir.md5($thispage).'.html';
//if (@file_exists($cachelink)) {
//	$cachelink_time = @filemtime($cachelink);
//	if ((time() - $settings_cachetime) < $cachelink_time) {
//		@readfile($cachelink);
//		die();
//	} else {
//		@unlink($cachelink);
//	}
//}
//ob_start();
require("connection.php");
require("functions.php");

/**
 * Getting variable
 */

$area = isset($_GET["area"]) ? $_GET["area"] : "3404";
$year = isset($_GET["year"]) ? $_GET["year"] : date("Y");
$severity = isset($_GET["severity"]) ? $_GET["severity"] : "1";
$start = isset($_GET["start"]) ? $_GET["start"] : 0;
$qr = isset($_GET["qr"]) ? $_GET["qr"] : 10;

if (!is_array($severity)) {
	$severity = array($severity);
}
array_walk($severity, "parseString");

if (!is_array($year)) {
	$year = array($year);
}
$select = "SELECT
`case_id`,
`collision_year`,
`collision_date`,
`collision_time`,
`country_city_location`,
`special_condition`,
`primary_rd`,
`secondary_rd`,
`intersection`,
`weather_1`,
`collision_severity`,
`killed_victims`,
`injured_victims`,
`primary_collision_factor`,
`pcf_violation_category`,
`hit_and_run`,
`type_of_collision`,
`motor_vehicle_involved_with`,
`chp_road_type`,
`pedestrian_collision`,
`bicycle_collision`,
`motorcycle_collision`,
`truck_collision`,
`alcohol_involved`,
`collision_point`.`latitude` AS `latitude`,
`collision_point`.`longitude` AS `longitude`
FROM `collision`
INNER JOIN `collision_point` ON (`collision`.`case_id` = `collision_point`.`Field1`)
WHERE `country_city_location` IN ('3401', '3402', '3403', '3404', '3408', '3412', '3422', '3433', '3450', '3490', '3496', '3497')"
. ($area != "" ? " AND `country_city_location` = '%s'" : "")
. " AND `collision_year` IN (%s)"
. " AND `collision_severity` IN (%s)
ORDER BY `case_id` ASC";

$sql = $area != "" ? sprintf("{$select}", $area, implode(",", $year), implode(",", $severity)) : sprintf("{$select}", implode(",", $year), implode(",", $severity));

$rows = mysql_query($sql);

$values = array();
$key = 0;
while ($row = mysql_fetch_object($rows)) {
	$values[$key++] = array(
		"case_id" => $row->case_id,
		"collision_year" => $row->collision_year,
		"collision_date" => $row->collision_date,
		"collision_time" => $row->collision_time,
		"country_city_location" => $row->country_city_location,
		"special_condition" => $row->special_condition,
		"primary_rd" => $row->primary_rd,
		"secondary_rd" => $row->secondary_rd,
		"intersection" => $row->intersection,
		"weather_1" => $row->weather_1,
		"collision_severity" => $row->collision_severity,
		"killed_victims" => $row->killed_victims,
		"injured_victims" => $row->injured_victims,
		"primary_collision_factor" => $row->primary_collision_factor,
		"pcf_violation_category" => $row->pcf_violation_category,
		"hit_and_run" => $row->hit_and_run,
		"type_of_collision" => $row->type_of_collision,
		"motor_vehicle_involved_with" => $row->motor_vehicle_involved_with,
		"chp_road_type" => $row->chp_road_type,
		"pedestrian_collision" => $row->pedestrian_collision,
		"bicycle_collision" => $row->bicycle_collision,
		"motorcycle_collision" => $row->motorcycle_collision,
		"truck_collision" => $row->truck_collision,
		"alcohol_involved" => $row->alcohol_involved,
		"latitude" => $row->latitude,
		"longitude" => $row->longitude
	);
}

echo json_encode(array(
	"table" => array(
		"cols" => array(
			"case_id",
			"collision_year",
			"collision_date",
			"collision_time",
			"country_city_location",
			"special_condition",
			"primary_rd",
			"secondary_rd",
			"intersection",
			"weather_1",
			"collision_severity",
			"killed_victims",
			"injured_victims",
			"primary_collision_factor",
			"pcf_violation_category",
			"hit_and_run",
			"type_of_collision",
			"motor_vehicle_involved_with",
			"chp_road_type",
			"pedestrian_collision",
			"bicycle_collision",
			"motorcycle_collision",
			"truck_collision",
			"alcohol_involved",
			"latitude",
			"longitude"),
		"rows" => $values
	)
));

//$fp = fopen($cachelink, 'w');@fwrite($fp, ob_get_contents());@fclose($fp);ob_end_flush();