<?php
/**
 * Update database by position latitude and longitude
 */
set_time_limit(0);
include("connection.php");
include("functions.php");

$latidude = isset($_POST["latitude"]) ? $_POST["latitude"] : 0;
$longitude = isset($_POST["longitude"]) ? $_POST["longitude"] : 0;
$case_id = isset($_POST["id"]) ? $_POST["id"] : 0;

$sql = sprintf("UPDATE `collision_point` SET `latitude` = '%s', `longitude` = '%s' WHERE `Field1` = %s", $latidude, $longitude, $case_id);

$result = mysql_query($sql);

echo json_encode(array("result" => $result, "latitude" => $latidude, "longitude" => $longitude, "status" => "OK"));