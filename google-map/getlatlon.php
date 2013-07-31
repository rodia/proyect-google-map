<?php
/**
 * This script load all coordenate into database.
 */
set_time_limit(0);
include("connection.php");
include("functions.php");

$sql = "SELECT `case_id`, `primary_rd`, `secondary_rd` FROM `collision` WHERE `latitude` = '' AND `longitude` = '' LIMIT 1";

$rows = mysql_query($sql);

while ($row = mysql_fetch_object($rows)) {
	$address = "{$row->primary_rd}, {$row->secondary_rd}, California";
	// http://maps.google.com/maps/geo?q=27703&output=json&key=AIzaSyBVr3n3IVZzakGvtIWeRaJEXsC63JHZ0w8
	// http://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&sensor=true_or_false
	$result = json_decode(file_get_contents(sprintf('http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false&key=AIzaSyAqK3X4kzm4mcWoqK8sEp4MpqhlVE1S8g8', urlencode($address))));
	var_dump($result);// $result->Status->code;
	if ($result->Status->code == 200)
	{
		$lat = $result->Placemark[0]->Point->coordinates[0];
		$long = $result->Placemark[0]->Point->coordinates[1];

		echo "{$lat}, {$long}";
	} else {
		echo "no,";
	}
}
