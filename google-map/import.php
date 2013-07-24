<?php
include("connection.php");
include("functions.php");

$table = isset($_GET["t"]) ? $_GET["t"] : "";

$struct = array(
	"insident" => array("id", "year", "time", "severity", "highway", "road", "latitude", "longitude", "road_part", "area", "contribute_factor"),
	"vehicle" => array("id", "insident_id", "description"),
	"person" => array("id", "vehicle_id", "type", "injury"),
	"pedestrian" => array("id", "insident_id", "type", "injury")
);

$file = fopen("table-{$table}.csv", "r") or exit("Unable to open file!");

$key = -1;

$cols = $struct["{$table}"];
$length = count($cols);
array_walk($cols, "parseCols");
$patten = "INSERT INTO {$table} (%s) VALUES %s";
$rows = "";
while (!feof($file))
{
	$line = explode(";", fgets($file));
	if (++$key == 0) continue;
	if (count($line) < $length-1) continue;

	$values = array();
	foreach ($line as $index => $item) {
		if ($index > $length-1) {
			$values[$length-1] .= ";" . trim(str_replace("\"", "", $item));
		} else {
			$values[] = trim(str_replace("\"", "", $item));
		}
	}
	array_walk($values, "parseString");
	$rows .= "(" . implode(",", $values) . "),";
	if ($key%1000 == 0) {
		$rows = substr($rows, 0, -1);
		$sql = sprintf($patten, implode(",", $cols), $rows);
		//echo "\n";
		mysql_query($sql);
		$rows = "";
	}
}
fclose($file);
if ($rows != "") {
	$rows = substr($rows, 0, -1);
	$sql = sprintf($patten, implode(",", $cols), $rows);
	//echo "\n";
	mysql_query($sql);
}

/* update for filed */
mysql_query("UPDATE `insident` SET `latitude` = replace(`latitude`, ',', '.'), `longitude` = replace(`longitude`, ',', '.')");
echo "Rows insert";