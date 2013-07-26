//IE7 does not have indexOf so we have to create it
if(!Array.indexOf){

    Array.prototype.indexOf = function(obj){
    	//Loop through the array
        for(var a = 0; a < this.length; a++){
        	//If we find what we want
            if(this[a]==obj){
            	//Return it's location
                return a;
            }
        }
        //If not, return a -1
        return -1;
    }
}
var tool = {};
tool.getYear = function(years) {
	if (years < 1900) {
		years = years + 1900;
	}
	return years;
}
tool.getPositions = function(choose) {
	return {lat: 36.771892, lon: -119.4053};
}
/**
 * @param address Address by search
 * @param data Data of dababase
 * @param map
 * @param markers
 * @param clusterMarkers
 */
tool.getPositionsBy = function(address, data, map, markers, clusterMarkers, markerShadow, markerClick) {
	address = address + ",california,estados unidos";
//	console.log(address);
	geocoder = new google.maps.Geocoder();
	geocoder.geocode({'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			var latitude = results[0].geometry.location.lat();
			var longitude = results[0].geometry.location.lng();

			var tmpMarker = new google.maps.Marker({
				map: map,
				position: new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude)),
				markerID: markers.length,
				accidentSeverity: data.collision_severity.toLowerCase(),
				hiddenME: false,
				hiddenCLUSTER: false,
				icon: 'images/'+data.collision_severity + '.png',
				shadow: markerShadow,
				markerCode: data.case_id,
				markerName: data.primary_rd,
				markerDate: data.collision_date,
				markerRoad: data.country_city_location,
				markerTime: data.collision_time,
				markerFactor: data.primary_collision_factor,
				markerVehicle: data.chp_road_type,
				markerPerson: data.killed_victims + data.injured_victims,
				markerInjury: data.injured_victims,
				markerLat: latitude,
				markerLon: longitude
			});
			google.maps.event.addListener(tmpMarker, 'click', markerClick);
			markers.push(tmpMarker);
			clusterMarkers.addMarker(tmpMarker);
		}
	});
//	console.log(position["latitude"]);
//	console.log(position["longitude"]);
}

var now = new Date;
var area = "";
var years = "";
var severity = ['1'];
var zoom = 8;

var loadData = [[false, 'unknown'], [false, 'possible injury'], [false, 'not injured'], [false, 'non-incapacitating'], [false, 'incapacitating injury'], [false, 'fatal']];

$(document).ready(function() {
	var map;
	var clusterMarkers;
	var markers = [];
	var tmpSelectedMarker;
	var clusterGroup;

	var markerShadow = new google.maps.MarkerImage("images/shadow.png", new google.maps.Size(60.0, 46.0), new google.maps.Point(0, 0), new google.maps.Point(20.0, 44.0));
	var mapStyle = [{featureType:"administrative", stylers:[{gamma:0.66}, {saturation:-45}]}, {featureType:"landscape", stylers:[{saturation:-45}, {gamma:0.66}]}, {featureType:"poi", stylers:[{saturation:-45}, {gamma:0.66}]}, {featureType:"transit", stylers:[{saturation:-45}, {gamma:0.66}]}, {featureType:"water", stylers:[{saturation:-44}, {gamma:0.66}]}, {featureType:"road", elementType:"geometry", stylers:[{saturation:-44}, {gamma:0.67}]}];

	years = $(".pre-defined").val();

	/**
	 * This function load the data and define the point in the map
	 *
	 * @param choose Indicate the string of area for load the data.
	 */
	function startup(choose) {
		$('#loading').show();
		preloading();
		var tmpQuery = encodeURI('http://' + location.host + '/proyect-google-map/google-map/data.php');

		var positions = tool.getPositions(choose);

		/*
		 * AJAX Request - Thes request is GET by cache method
		 */
		$.ajax({
			url: 		tmpQuery,
			dataType: 	'json',
			cache: 		true,
			data:		{area: area, year: years, severity: severity},
			type:		"GET",
			success: 	function(data) {
							load(data.table.rows, positions.lat, positions.lon);
						}
		});
	}

	/**
	 * This fucntion load the data of variable data.
	 *
	 * @param data Data of result of consult
	 * @param lat Define latitude position in the map
	 * @param lon Define longitude position in the map
	 */
	function load(data, lat, lon) {
		var myLatlng = new google.maps.LatLng(lat, lon);
		var myOptions = {
			zoom: zoom,
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			styles:mapStyle
		}

		map = new google.maps.Map(document.getElementById("map"), myOptions);

		clusterMarkers = new MarkerClusterer(map, [], {maxZoom:21, gridSize:100, averageCenter:true});

		google.maps.event.addListener(map, 'zoom_changed', function(){
			if(map.getZoom() > 14) {
				clusterMarkers.setGridSize(15);
			} else {
				clusterMarkers.setGridSize(100);
			}
		});

		for (var a = 0; a < data.length; a++) {
			var pos = tool.getPositionsBy(data[a].primary_rd + "," + data[a].secondary_rd, data[a], map, markers, clusterMarkers, markerShadow, markerClick);
//			if (pos.length == 0) continue;

		}

		$('#loading').hide();
	}

	/**
	 *
	 */
	ClusterIcon.prototype.triggerClusterClick = function() {
		if (map.getZoom() > 14) {
			clusterGroup = this.cluster_.markers_;
			clusterClick(clusterGroup);
		} else {
			this.map_.fitBounds(this.cluster_.getBounds());
		}
	};

	/**
	 *
	 */
	function markerClick() {
		clusterGroup = "";
		loadAccidentInfo(this);
	}

	/**
	 * This function check all checkbox for severity info.
	 */
	function checkAll() {
		$('div.checkbox').addClass('checked');
	}

	function is_load(choose) {
		var output = false;
		$.each(loadData, function(key, value) {
			if (value[1] == choose) {
				output = value[0];
			}
		});
		return output;
	}
	/**
	 *
	 */
	function set_load(choose, load) {
		$.each(loadData, function(key, value) {
			if (value[1] == choose) {
				loadData[key][0] = load;
			}
		});
	}
	/**
	 *
	 */
	function get_checked() {
		severity = [];
		var key = 0;
		$.each($("div.checkbox"), function() {
			if ($(this).hasClass('checked')) {
				severity[key++] = $(this).attr('checkType');
			}
		});
		// startup(area);
	}

	/**
	 * This function manage the action for all checkbox for severity info.
	 */
	$('div.checkbox').click(function(){

		if($(this).hasClass('checked')) {
			$(this).removeClass('checked');
			hideMarkers($(this).attr('checkType'));
		} else {
			$(this).addClass('checked');
			showMarkers($(this).attr('checkType'));
		}

		return false;
	});

	$('div.clusterinfo').live('click', function() {
		loadAccidentInfo(markers[$(this).attr('markerID')]);
	});

	$('div#navigation div.link').click(function(){
		gotoLocation($(this).index());

		$.each($('div#navigation div.link'), function() {
			$(this).removeClass("active");
		});
		$(this).addClass("active");
	});

	/**
	 * This function load the year with button load in the map.
	 */
	$(".choose-year").click(function() {
		verifyCheckBox();
		get_checked();
		startup(area);
	});

	$("input[type=checkbox]").change(function() {
		// verifyCheckBox();

		if (area == "") {
			$.each($("input[type=checkbox]"), function() {
				$(this).attr('checked', false);
			});
			$(this).attr("checked", true);
		}
	});
	/**
	 * This function charge the map with point for selected
	 */
	function verifyCheckBox() {
		years = [];
		var key = 0;
		$.each($("input[type=checkbox]"), function() {
			if ($(this).is(':checked')) {
				years[key++] = $(this).val();
			}
		});
		// startup(area);
	}

	/*
	 * Reset a check for year in the map. mantain a pre-defined check.
	 */
	function resetCheck() {
		$.each($("input[type=checkbox]"), function() {
			$(this).attr('checked', false);
		});
		$(".pre-defined").attr("checked", true);
	}
	/**
	 * The system reset a check selected in list checkbox for years
	 */
	function checkYear(year, value) {
		$("input[value=" + year + "]").attr("checked", value);
	}

	/**
	 * Reset a severity check in the map, mantain a last check for
	 */
	function resetSeverity() {
		$.each($("div.checkbox"), function() {
			$(this).removeClass('checked');
		});

		$("div.checkbox[checkType=fatal]").addClass('checked');

		severity = ['fatal'];
	}
	/**
	 * hide markes in the map when user choose a severity checkbox
	 *
	 * @param hideType An severity label
	 */
	function hideMarkers(hideType) {
		for (var a = 0; a < markers.length; a++) {
			if (markers[a].accidentSeverity == hideType) {
				if (markers[a].hiddenCLUSTER == false) {
					markers[a].setMap(null);
				}
				markers[a].hiddenME = true;
			}
		}
		for (var a = 0; a < clusterMarkers.clusters_.length; a++) {
			clusterMarkers.clusters_[a].updateIcon();
		}
	}
	/**
	 * show marker in the map, when user select an check for severity
	 *
	 * @param hideType An severity label
	 */
	function showMarkers(hideType) {
		for (var a = 0; a < markers.length; a++) {
			if (markers[a].accidentSeverity == hideType) {
				if (markers[a].hiddenCLUSTER == false) {
					markers[a].setMap(map);
				}
				markers[a].hiddenME = false;
			}
		}
		for (var a = 0; a < clusterMarkers.clusters_.length; a++) {
			clusterMarkers.clusters_[a].updateIcon();
		}
	}

	/**
	 * This function load the info for marker data.
	 *
	 * @param marker
	 */
	function loadAccidentInfo(marker) {
		if (clusterGroup != "") {
			$('#informationheader').html("<span class='floatright ajust-size'><a href='#' id='btnBack'>Back</a></span>Accident information");
		} else {
			$('#informationheader').html("Accident information");
		}

		var accidentInfo = '<table width="100%" class="topspace">'+
			'<tbody>'+
				'<tr>'+
					'<td class="alignright bold">Severity:</td>'+
					'<td class="'+marker.markerCode+'" title="'+marker.markerLat + ' ' + marker.markerLon+'">'+capitaliseFirstLetter(marker.accidentSeverity)+'</td>'+
				'</tr>'+
				'<tr class="even">'+
					'<td width="25%" class="alignright bold">Location:</td>'+
					'<td>'+marker.markerName+'</td>'+
				'</tr>'+
				'<tr>'+
					'<td class="alignright bold">When:</td><td>'+marker.markerDate+' at '+marker.markerTime+'</td>'+
				'</tr>'+
				'<tr class="even">'+
					'<td class="alignright bold">Road Part:</td><td>'+marker.markerRoad+'</td>'+
				'</tr>'+
				'<tr>'+
					'<td class="alignright bold">Vehicle:</td><td>'+marker.markerVehicle.split(';').join('<br/>')+'</td>'+
				'</tr>'+
				'<tr class="even">'+
					'<td colspan="2">'+marker.markerFactor.split(';').join('<br/>')+'</td>'+
				'</tr>'+
			'</tbody>'+
		'</table>';

		$('#info').html(accidentInfo);

		tmpSelectedMarker = marker;
		showStreetview();
	}

	/**
	 * Define current map for pane. when the user click in the link the couties.
	 *
	 * @param index Number of link for show map.
	 */
	function gotoLocation(index) {
		var positions = {};
		switch (index) {
			case 1:
				area = "Chambers County";
				years = $(".pre-defined").val();
				zoom = 11;
				positions = tool.getPositions(area);
				map.setCenter(new google.maps.LatLng(positions.lat, positions.lon)); // 29.83983428, -94.70638058 //29.82333582 -94.87875233
				map.setZoom(11);
				resetSeverity();
				resetCheck();
				startup(area);
				break;
			case 2:
				area = "Liberty County";
				years = $(".pre-defined").val();
				zoom = 11;
				positions = tool.getPositions(area);
				map.setCenter(new google.maps.LatLng(positions.lat, positions.lon)); // 30.19604123, -94.94775117 //30.02071675 -94.53394066
				map.setZoom(zoom);
				resetSeverity();
				resetCheck();
				startup(area);
				break;
			case 3:
				area = "Fort Bend County";
				years = $(".pre-defined").val();
				zoom = 10;
				positions = tool.getPositions(area);
				map.setCenter(new google.maps.LatLng(positions.lat, positions.lon)); // 30.19604123, -94.94775117 //30.02071675 -94.53394066
				map.setZoom(zoom);
				resetSeverity();
				resetCheck();
				startup(area);
				break;
			case 4:
				area = "Montgomery County";
				years = $(".pre-defined").val();
				zoom = 10;
				positions = tool.getPositions(area);
				map.setCenter(new google.maps.LatLng(positions.lat, positions.lon)); // 30.19604123, -94.94775117)); //30.02071675 -94.53394066
				map.setZoom(zoom);
				resetSeverity();
				resetCheck();
				startup(area);
				break;
			case 5:
				area = "Harris County";
				years = $(".pre-defined").val();
				//years = 2010;
				checkYear(years, true);
				zoom = 10;
				positions = tool.getPositions(area);
				map.setCenter(new google.maps.LatLng(positions.lat, positions.lon)); // 30.19604123, -94.94775117)); //30.02071675 -94.53394066
				map.setZoom(zoom);
				resetSeverity();
				resetCheck();
				startup(area);
				break;
			case 6:
//				area = "Chambers County";
				area = "";
				years = $(".pre-defined").val();
				zoom = 8;
				positions = tool.getPositions("");
				map.setCenter(new google.maps.LatLng(29.758344, -95.35241)); // 29.83983428, -94.70638058 //29.82333582 -94.87875233
				map.setZoom(zoom);
				resetSeverity();
				resetCheck();
				startup(area);
				break;
			default:
				alert('It appears there was an error. Please try again or refresh the page.');
				break;
		}
		console.log(zoom);
		console.log(years);
		console.log(area);
	}

	function capitaliseFirstLetter(string) {
		return string.charAt(0).toUpperCase() + string.slice(1);
	}

	function preloading() {
		$('#loading').css({
			'width':$('#container').width(),
			'height':$('#container').height()
		}).find('img').css({
			'position':'absolute',
			'top':($('#container').height()/2)-30,
			'left':($('#container').width()/2)-30
		});
	}

	function showStreetview() {
		var tmpStreetViewerOpt = {
			position: tmpSelectedMarker.position,
			linksControl: false,
			panControl: false,
			zoomControl: false,
			addressControl: false
		};
		var tmpStreetViewer = new google.maps.StreetViewPanorama(document.getElementById('customStreetView'), tmpStreetViewerOpt);
		map.setStreetView(tmpStreetViewer);
	}

	function clusterClick(markers) {
		var outputString = "";

		for(var a = 0; a < markers.length; a++) {
			if(markers[a].hiddenME == false) {
				outputString += '<div class="clusterinfo '+markers[a].markerCode+'" markerID="'+markers[a].markerID+'">' + capitaliseFirstLetter(markers[a].accidentSeverity) + ' accident' + "</div>";
			}
		}

		$('#informationheader').html("Blackspot information");
		$('#info').html(outputString);
	}

	$('#btnBack').live('click',function(){
		clusterClick(clusterGroup);
	});

	preloading();
	startup(area);
});
