<?php
/**
 * Get all dir of database
 */
set_time_limit(0);
include("connection.php");
include("functions.php");

$start = isset($_GET["start"]) ? $_GET["start"] : 0;
$rp = isset($_GET["rp"]) ? $_GET["rp"] : 100;

$sql = "SELECT `case_id`, `primary_rd`, `secondary_rd` FROM `collision` WHERE `latitude` = '' AND `longitude` = '' LIMIT {$start}, {$rp}";

$rows = mysql_query($sql);
$values = array();
$key = 0;
while ($row = mysql_fetch_object($rows)) {
	$values[$key++] = array(
		"case_id" => $row->case_id,
		"primary_rd" => $row->primary_rd,
		"secondary_rd" => $row->secondary_rd
	);
}
echo json_encode(array(
	"table" => array(
		"cols" => array("case_id", "primary_rd", "secondary_rd"),
		"rows" => $values
	)
));