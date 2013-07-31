<html>
<head>
<title>Get latitude logitude</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
	var geocoder;
	function codeAddress(id, address) {
		geocoder.geocode({'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var latitude = results[0].geometry.location.lat();
				var longitude = results[0].geometry.location.lng();

				var tmpQuery = encodeURI('http://' + location.host + '/proyect-google-map/google-map/save-latlog.php');

				/*
				 * AJAX Request - Thes request is GET by cache method
				 */
				$.ajax({
					url: 		tmpQuery,
					dataType: 	'json',
					cache: 		true,
					data:		{id: id, latitude: latitude, longitude: longitude},
					type:		"post",
					success: 	function(data) {
									console.log("Save " + data.result);
								}
				});
			} else {
				console.log("Geocode was not successful for the following reason: " + status);
			}
		});
	}

	function startup() {
		geocoder = new google.maps.Geocoder();
		var tmpQuery = encodeURI('http://' + location.host + '/proyect-google-map/google-map/latlon.php');

		/*
		 * AJAX Request - Thes request is GET by cache method
		 */
		$.ajax({
			url: 		tmpQuery,
			dataType: 	'json',
			cache: 		true,
			data:		{},
			type:		"GET",
			success: 	function(data) {
							load(data.table.rows);
						}
		});
	}

	function load(data) {
		for (var a = 0; a < data.length; a++) {
			codeAddress(data[a].code_id, data[a].primary_rd + "," + data[a].secondary_rd);
		}
	}

	startup();
</script>
</head>
<body>
	<p>loading...</p>
</body>
</html>