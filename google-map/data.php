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

$area = isset($_GET["area"]) ? $_GET["area"] : "";
$year = isset($_GET["year"]) ? $_GET["year"] : date("Y");
$severity = isset($_GET["severity"]) ? $_GET["severity"] : "FATAL";

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
`jurisdiction`,
`day_of_week`,
`population`,
`country_city_location`,
`special_condition`,
`beat_type`,
`chp_beat_type`,
`primary_rd`,
`secondary_rd`,
`distance`,
`intersection`,
`direction`,
`weather_1`,
`weather_2`,
`state_highway_indicator`,
`collision_severity`,
`killed_victims`,
`injured_victims`,
`primary_collision_factor`,
`pcf_violation_code`,
`pcf_violation_category`,
`hit_and_run`,
`type_of_collision`,
`motor_vehicle_involved_with`,
`chp_road_type`,
`pedestrian_collision`,
`bicycle_collision`,
`motorcycle_collision`,
`truck_collision`,
`alcohol_involved`
FROM `collision`
WHERE 1"
. ($area != "" ? " AND `jurisdiction` = '%s'" : "")
. " AND `collision_year` IN (%s)"
. " AND `collision_severity` IN (%s)
ORDER BY `case_id` ASC";

$sql = $area != "" ? sprintf("{$select}", $area, implode(",", $year), implode(",", $severity)) : sprintf("{$select}", implode(",", $year), implode(",", $severity));

$rows = mysql_query($sql);

$values = array();
$key = 0;
while ($item = mysql_fetch_object($rows)) {
	$values[$key++] = array(
		"collision_year" => $item->collision_year,
		"collision_date" => $item->collision_date,
		"collision_time" => $item->collision_time,
		"jurisdiction" => $item->jurisdiction,
		"day_of_week" => $item->day_of_week,
		"population" => $item->population,
		"country_city_location" => $item->country_city_location,
		"special_condition" => $item->special_condition,
		"beat_type" => $item->beat_type,
		"chp_beat_type" => $item->chp_beat_type,
		"primary_rd" => $item->primary_rd,
		"secondary_rd" => $item->secondary_rd,
		"distance" => $item->distance,
		"intersection" => $item->intersection,
		"direction" => $item->direction,
		"weather_1" => $item->weather_1,
		"weather_2" => $item->weather_2,
		"state_highway_indicator" => $item->state_highway_indicator,
		"collision_severity" => $item->collision_severity,
		"killed_victims" => $item->killed_victims,
		"injured_victims" => $item->injured_victims,
		"primary_collision_factor" => $item->primary_collision_factor,
		"pcf_violation_code" => $item->pcf_violation_code,
		"pcf_violation_category" => $item->pcf_violation_category,
		"hit_and_run" => $item->hit_and_run,
		"type_of_collision" => $item->type_of_collision,
		"motor_vehicle_involved_with" => $item->motor_vehicle_involved_with,
		"chp_road_type" => $item->chp_road_type,
		"pedestrian_collision" => $item->pedestrian_collision,
		"bicycle_collision" => $item->bicycle_collision,
		"motorcycle_collision" => $item->motorcycle_collision,
		"truck_collision" => $item->truck_collision,
		"alcohol_involved" => $item->alcohol_involved
	);
}

echo json_encode(array(
	"table" => array(
		"cols" => array("case_id",
			"collision_year",
			"collision_date",
			"collision_time",
			"jurisdiction",
			"day_of_week",
			"population",
			"country_city_location",
			"special_condition",
			"beat_type",
			"chp_beat_type",
			"primary_rd",
			"secondary_rd",
			"distance",
			"intersection",
			"direction",
			"weather_1",
			"weather_2",
			"state_highway_indicator",
			"collision_severity",
			"killed_victims",
			"injured_victims",
			"primary_collision_factor",
			"pcf_violation_code",
			"pcf_violation_category",
			"hit_and_run",
			"type_of_collision",
			"motor_vehicle_involved_with",
			"chp_road_type",
			"pedestrian_collision",
			"bicycle_collision",
			"motorcycle_collision",
			"truck_collision",
			"alcohol_involved"),
		"rows" => $values
	)
));

//$fp = fopen($cachelink, 'w');@fwrite($fp, ob_get_contents());@fclose($fp);ob_end_flush();