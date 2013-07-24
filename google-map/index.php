<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<title></title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="robots" content="" />
		<style type="text/css">
			/* http://meyerweb.com/eric/tools/css/reset/
			   v2.0 | 20110126
			   License: none (public domain)
			*/

			html, body, div, span, applet, object, iframe,
			h1, h2, h3, h4, h5, h6, p, blockquote, pre,
			a, abbr, acronym, address, big, cite, code,
			del, dfn, em, img, ins, kbd, q, s, samp,
			small, strike, strong, sub, sup, tt, var,
			b, u, i, center,
			dl, dt, dd, ol, ul, li,
			fieldset, form, label, legend,
			table, caption, tbody, tfoot, thead, tr, th, td,
			article, aside, canvas, details, embed,
			figure, figcaption, footer, header, hgroup,
			menu, nav, output, ruby, section, summary,
			time, mark, audio, video {
				margin: 0;
				padding: 0;
				border: 0;
				font-size: 100%;
				font: inherit;
				vertical-align: baseline;
			}
			/* HTML5 display-role reset for older browsers */
			article, aside, details, figcaption, figure,
			footer, header, hgroup, menu, nav, section {
				display: block;
			}
			body {
				line-height: 1;
			}
			ol, ul {
				list-style: none;
			}
			blockquote, q {
				quotes: none;
			}
			blockquote:before, blockquote:after,
			q:before, q:after {
				content: '';
				content: none;
			}
			table {
				border-collapse: collapse;
				border-spacing: 0;
			}
		</style>

		<link href="css/main.css" rel="stylesheet" />

		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/clusterer.js"></script>
		<script type="text/javascript" src="js/main.js"></script>

	</head>
	<body>
		<div id="container">

			<div id="main" class="inlineclass margin">

				<div id="map"></div>

				<div class="sidebar">
					<div id="navigation">
						<span class="block header">
							Black spots
						</span>

						<div class="link">
							<span class="block"><a href="#">Chambers County</a></span>
						</div>

						<div class="link even">
							<span class="block"><a href="#">Liberty County</a></span>
						</div>

						<div class="link">
							<span class="block"><a href="#">Fort Bend County</a></span>
						</div>

						<div class="link even">
							<span class="block"><a href="#">Montgomery County</a></span>
						</div>

						<div class="link">
							<span class="block"><a href="#">Harris County</a></span>
						</div>

						<div class="link even active">
							<span class="block"><a href="#">See All 5 Counties</a></span>
						</div>
					</div>

					<div class="information">
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
							<td style="padding: 5px 0;"><div class="checkbox unknown inlineclass rightspace" checkType="unknown"></div>Unknown</td>
							<td><div class="checkbox possible-injury inlineclass rightspace" checkType="possible injury"></div>Possible injury</td>
							<td><div class="checkbox not-injured inlineclass rightspace" checkType="not injured"></div>Not injured</td>
							<td><div class="checkbox non-incapacitating inlineclass rightspace" checkType="non-incapacitating"></div>Non incapacitating</td>
							<td><div class="checkbox incapacitating-injury inlineclass rightspace" checkType="incapacitating injury"></div>Incapacitating injury</td>
							<td><div class="checkbox fatal checked inlineclass rightspace" checkType="fatal"></div>Fatal</td>
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
							<td><label><input type="checkbox" class="pre-defined" name="year[]" value="2011" checked="checked">2011</label></td>
							<!--<td><label><input type="checkbox" class="pre-defined" name="year[]" value="2012" checked="checked">2012</label></td>-->
							<td><input type="button" class="choose-year" name="year[]" value="Load"></td>
						</tr>
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
<?php
$clientid = (isset($_GET["clientid"]) || !empty($_GET["clientid"])) ? $_GET["clientid"] : "stewartg";
?>
<script type="text/javascript">//<![CDATA[
var _gaq = _gaq || [];
_gaq.push(['_setAccount','UA-19671490-1']);
_gaq.push(['_trackPageview']);
_gaq.push(['_setCustomVar',1,'ClientID','<?php echo $clientid; ?>',1]);
_gaq.push(['_trackEvent','Error','404','',0,true]);
(function () {
	var ga = document.createElement('script');
	ga.type = 'text/javascript';
	ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(ga, s);
})();
//]]></script>
	</body>
</html>