<?php
/**
 * @package default
 * @author Rodia  <rodia.piedra@gmail.com>
 */

/**
 * This function is used in array_walk function and concat a semicolon for each item in
 * array
 *
 * @param array $item A item for array
 */
function parseString(&$item)
{
	$item = "'" . $item . "'";
}
/**
 * This function is used in array_walk function and cocat a ´ for each item in array
 */
function parseCols(&$item)
{
	$item = "`" . $item . "`";
}

function getPagination($page, $total, &$paginations, $rp = 300) {

	$output = "<ul id=\"pagination\">";
	$paginations = ceil($total / $rp);
	for ($i = 1; $i <= $paginations; $i++) {
		if ($i == $page) {
			$output .= "<li class=\"active\">{$i}</li>";
		} else {
			$output .= "<li><a href=\"#\" class=\"fire-page\">$i</a></li>";
		}
	}
	return $output . "</ul>";
}

function getTotal($select, $years, $area = "") {
	$sql = $area != "" ? sprintf($select, $area, $years) : sprintf($select, $years);
	return mysql_num_rows(mysql_query($sql));
}

function get_label_by_severity($code) {
	$codes = array(
		"PDO",
		"Fatal",
		"Injury (Severe)",
		"Injury (Other Visible)",
		"Injury (Complaint of Pain)"
	);

	return $codes[$code];
}