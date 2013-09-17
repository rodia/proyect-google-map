<?php
/**
 * This template for show map
 */
include_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<title></title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="robots" content="" />
		<style type="text/css">

		</style>

		<link href="css/main.css" rel="stylesheet" />
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/clusterer.js"></script>
		<script type="text/javascript" src="js/main.js"></script>

	</head>
	<body>
		<div id="container">
			<div class="content">
				<p style="text-align: justify; margin: 0;"><img src="http://www.injury-attorneys.com/templates/demas/images/profile.png" alt="" width="620px" height="26px"></p>
				<p>As <a href="http://www.injury-attorneys.com/" target="_parent">Sacramento personal injury attorneys</a>, we see our fair share of car accident cases each year. As a service to our clients and potential clients, we have included the map below to help our visitors keep track of motor vehicle accidents in Sacramento and its surrounding counties. The map shows all accidents in the area that involved a car, truck, motorcycle, or bicycle that were reported to the California Department of Transportation from 2007 to 2012.</p>
<p>The accident map allows people to pinpoint the most dangerous places around Sacramento where accidents occur, otherwise known as “black spots”. By using this map, Sacramento residents can avoid accident “black spots” to travel safer to their destination.</p>
			</div>
			<div id="map-content">
				<div id="main" class="inlineclass margin">

					<div id="map"></div>

					<div class="sidebar">
						<div id="navigation">
							<span class="block header">
								Black spots
							</span>

							<div class="link even">
								<span class="block"><a href="#">FOLSOM</a></span>
							</div>

							<div class="link">
								<span class="block"><a href="#">GALT</a></span>
							</div>

							<div class="link even">
								<span class="block"><a href="#">ISLETON</a></span>
							</div>

							<div class="link">
								<span class="block"><a href="#">SACRAMENTO</a></span>
							</div>

							<div class="link even">
								<span class="block"><a href="#">CSU SACRAMENTO</a></span>
							</div>

							<div class="link">
								<span class="block"><a href="#">AMERICAN RIVPK DIST</a></span>
							</div>

							<div class="link even">
								<span class="block"><a href="#">GOLDRUSH PARK DIST</a></span>
							</div>

							<div class="link">
								<span class="block"><a href="#">TWIN CITIES PK DIST</a></span>
							</div>

							<div class="link even">
								<span class="block"><a href="#">ELK GROVE</a></span>
							</div>

							<div class="link">
								<span class="block"><a href="#">RANCHO CORDOVA</a></span>
							</div>

							<div class="link even">
								<span class="block"><a href="#">CITRUS HEIGHTS</a></span>
							</div>

							<div class="link">
								<span class="block"><a href="#">UCD MEDICAL CENTER</a></span>
							</div>

							<div class="link even active">
								<span class="block"><a href="#">See All Counties</a></span>
							</div>
						</div>

						<div class="information" style="display: none;">
							<a class="close-icon"><img src="images/close.png" width="18" height="18"></a>
							<span id="informationheader" class="block header">
								Information
							</span>
							<div id="info" class="info">
								<div class="Intro">Select a marker to show accident information.</div>
							</div>
						</div>
					</div>

					<div id="checkboxes">
						<table width="100%">
							<tr class="header">
								<td colspan="6" style="padding: 5px 0;">Severity:</td>
							</tr>
							<tr>
								<td style="padding: 5px 0;"><div class="checkbox unknown inlineclass rightspace" checkType="0"></div><?php echo get_label_by_severity(0); ?></td>
								<td><div class="checkbox not-injured inlineclass rightspace" checkType="4"></div><?php echo get_label_by_severity(4); ?></td>
								<td><div class="checkbox non-incapacitating inlineclass rightspace" checkType="3"></div><?php echo get_label_by_severity(3); ?></td>
								<td><div class="checkbox incapacitating-injury inlineclass rightspace" checkType="2"></div><?php echo get_label_by_severity(2); ?></td>
								<td><div class="checkbox fatal checked inlineclass rightspace" checkType="1"></div><?php echo get_label_by_severity(1); ?></td>
							</tr>
						</table>

						<table width="100%">
							<tr class="header">
								<td colspan="6" style="padding: 5px 0;">Choose one or more options for the years</td>
							</tr>
							<tr>
								<td><label><input type="checkbox" name="year[]" value="2007">2007</label></td>
								<td><label><input type="checkbox" name="year[]" value="2008">2008</label></td>
								<td><label><input type="checkbox" name="year[]" value="2009">2009</label></td>
								<td><label><input type="checkbox" name="year[]" value="2010">2010</label></td>
								<td><label><input type="checkbox" name="year[]" value="2011">2011</label></td>
								<td><label><input type="checkbox" class="pre-defined" name="year[]" value="2012" checked="checked">2012</label></td>
								<!--<td><label><input type="checkbox" class="pre-defined" name="year[]" value="2012" checked="checked">2012</label></td>-->
								<td><input type="button" class="choose-year" name="year[]" value="Load"></td>
							</tr>
	<!--						<tr>
								<td colspan="7"><input type="button" value="Next"></td>
							</tr>-->
						</table>
					</div>

				</div>
				<div class="clear"></div>
				<div class="information">
					<div class="info">
						<div id="customStreetView"></div>
					</div>
				</div>
				<div id="loading">
					<img src="images/loading.gif" height="30"/>
				</div>
			</div>
			<div class="clear"></div>
			<div class="content">
				<p>Please Note: The data provided for the calendar year of 2012 is partial; we will be uploading the new data as it is made available by the California Department of Transportation.</p>
<h3>Did You Know?</h3>
<ul>
<li>California had 416,490 traffic collisions in 2010 alone</li>
<li>On average, a person was injured in a traffic collision every 2 minutes and 17 seconds</li>
<li>On average, a traffic collision was reported every 1 minute 16 seconds</li>
<li>Speed was the primary cause of a crash in 30 percent of collisions involving injuries and fatalities</li>
<li>California did not have one day in 2010 without a traffic fatality</li>
<li>The number of uninsured drivers increased by 8.3 percent from 2001 to 2010.</li>
</ul>
<h3>How to Use this Map</h3>
<ul>
<li><strong>Step 1</strong> – Use the slider controls on the left side of this map to adjust the zoom. In order to move the map around, you can either click on it and drag it around, or use the arrows above the slider that controls the zoom.</li>
<li><strong>Step 2</strong> - In order to display county-specific data, click the name of the county for which you wish to view data on the right of the map.</li>
<li><strong>Step 3</strong> - Limit your search by year by clicking the box next to the year you wish to view.</li>
<li><strong>Step 4</strong> - You can also control the types of accidents displayed by using the “accident severity” list at the bottom.</li>
<li><strong>Step 5</strong> – Street level view can be activated by dragging the person shaped figure onto the map. This will display an image of the street level view of that area. You can use the compass direction control to change direction and zoom in and out.</li>
</ul>
			</div>
		</div>
	</body>
</html>