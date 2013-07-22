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
$settings_cachedir = 'cache/';
$settings_cachetime = 86400;
//Pagina php
$thispage = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$cachelink = $settings_cachedir.md5($thispage).'.html';
if (@file_exists($cachelink)) {
	$cachelink_time = @filemtime($cachelink);
	if ((time() - $settings_cachetime) < $cachelink_time) {
		@readfile($cachelink);
		die();
	} else {
		@unlink($cachelink);
	}
}
ob_start();
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
`insident`.`id`,
`insident`.`year`,
`insident`.`time`,
`insident`.`severity`,
`insident`.`highway`,
`insident`.`road`,
`insident`.`latitude`,
`insident`.`longitude`,
`insident`.`road_part`,
`insident`.`contribute_factor`,
`vehicle`.`id` AS `id_vehicle`,
`vehicle`.`description`,
`person`.`type`,
`person`.`injury`
FROM `insident`
INNER JOIN (`vehicle`, `person`)
ON (`insident`.`id` = `vehicle`.`insident_id`
	AND `vehicle`.`id` = `person`.`vehicle_id`)
WHERE `latitude` <> '0' AND `longitude` <> '0'"
. ($area != "" ? " AND `insident`.`area` = '%s'" : "")
. " AND `insident`.`year` IN (%s)"
. " AND `insident`.`severity` IN (%s)
ORDER BY `insident`.`id` ASC";

$sql = $area != "" ? sprintf("{$select}", $area, implode(",", $year), implode(",", $severity)) : sprintf("{$select}", implode(",", $year), implode(",", $severity));

$rows = mysql_query($sql);

$values = array();
$key = 0;
$id = 0;
$count = 0;
while ($item = mysql_fetch_object($rows)) {
	if($id != $item->id) {
		$values[$key++] = array(
			$item->id,
			$item->year,
			$item->time,
			$item->severity,
			$item->highway,
			$item->road,
			$item->latitude,
			$item->longitude,
			$item->road_part,
			$item->contribute_factor,
			$item->description,
			$item->type,
			$item->injury
		);
		$id = $item->id;
		$count++;
	} else {
		$values[$key-1][10] .= ";" . $item->description;
		$values[$key-1][11] .= ";" . $item->type;
		$values[$key-1][12] .= ";" . $item->injury;
	}
}

echo json_encode(array(
	"table" => array(
		"cols" => array("id", "year", "time", "severity", "highway", "road", "latitude", "longitude", "road_part", "contribute_factor", "description", "type", "injury"),
		"rows" => $values
	)
));

$fp = fopen($cachelink, 'w');@fwrite($fp, ob_get_contents());@fclose($fp);ob_end_flush();