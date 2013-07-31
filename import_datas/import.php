<?php
set_time_limit(0);
include("connection.php");
include("functions.php");

$table = isset($_GET["t"]) ? $_GET["t"] : "";
$struct = array(
	"victim" => array( 'case_id', 'party_number', 'victim_role', 'victim_sex', 'victim_age', 'victim_degree_of_injured',  'victim_seating_position', 'victim_safety_equipament_1', 'victim_safety_equipament_2', 'victim_ejected'
),
	"party" => array( 'case_id','party_number','party_type','at_fault','party_sex','party_age','party_sobriety','party_drug_phisical','direction_of_travel', 'party_safety_equipament_1','party_safety_equipament_2','financial_responsibility','special_information_1','special_information_2','special_information_3','oaf_voiolation_code','oaf_violation_category','oaf_vioaltion_section','oaf_violation_suffix','other_associated_factor_1','other_associated_factor_2','party_number_killed','party_number_injured','movement_preceding_collision','vehicle_year','vehicle_make','statewide_vehicle_type','chp_vehicle_type_towing','chp_vehicle_type_towed','party_race'
),
	"collision" => array( 'case_id','collision_year','process_date','jurisdiction','collision_date','collision_time','officer_id','reporting_district','day_of_week','chp_shift','population','country_city_location','special_condition' ,'beat_type','chp_beat_type','city_division_lapd','chp_beat_class','beat_number','primary_rd','secondary_rd' ,'distance','direction','intersection','weather_1','weather_2','state_highway_indicator','caltrans_county','caltrans_district','state_route','route_suffix' ,'postmile_prefix','posmile','location_type','ramp_intersection','side_of_higway','tow_away','collision_severity','killed_victims','injured_victims','party_county','primary_collision_factor','pcf_violation_code','pcf_violation_category','pcf_violation','pcf_violation_subsection','hit_and_run','type_of_collision','motor_vehicle_involved_with','ped_action','road_surface','road_condition_1','road_condition_2','lighting','control_device','chp_road_type','pedestrian_collision','bicycle_collision','motorcycle_collision','truck_collision','not_private_property','alcohol_involved','statewide_vehicle_type_at_fault','chp_vehicle_type_at_fault','severe_injury_count','other_visible_injured_count','complaint_of_pain_injury_count','pedestrian_killed_count','pedestrian_injured_count','bicyclist_killed_count','bicyclist_injured_count','motorcyclist_killed_count','motorcyclist_injured_count','primary_ramp','secondary_ramp','latitude','longitude'
)
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
		mysql_query($sql);
		$rows = "";
	}
}
fclose($file);
if ($rows != "") {
	$rows = substr($rows, 0, -1);
	$sql = sprintf($patten, implode(",", $cols), $rows);
	mysql_query($sql);
}
header ("Location: ".$_SERVER['HTTP_REFERER']);
