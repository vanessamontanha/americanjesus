var geocoder;
var map;

(function ($) {
	
	// load the Google API Script
	loadGoogleScript();
	
	// An Address has been added and user has moved focus away
	if($('#RestaurantAddress').length) {
		$('#RestaurantAddress').blur(function(){
			// get value of address
			var address = $(this).val();

			// load the address and pass to Google Geocoder
			if(address != '') {
				geocoder.geocode( { 'address': address}, function(results, status) {
					// success
					if (status == google.maps.GeocoderStatus.OK) {

						// set form lat/lng values
						$('#RestaurantLat').val(results[0].geometry.location.lat());
						$('#RestaurantLng').val(results[0].geometry.location.lng());

						// set center of Map
						map.setCenter(results[0].geometry.location);
						map.setZoom(14);

						// add Marker
						var marker = new google.maps.Marker({
							map: map,
							position: results[0].geometry.location
						});

					// something went wrong
					} else {
						alert("Geocode was not successful for the following reason: " + status);
					}
				});
			}
		});
	}
	
})(jQuery);

/**
 * Load Google Maps API
 */
function loadGoogleScript() {
	// only load script if the map canvas id is present
	if($('#map_canvas').length) {
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyDIj6sbOMlCWwPc7tKcaTIYjTa50eco47k&sensor=false&callback=initialize";
		document.body.appendChild(script);
	}
}

/**
 * Initialise & display the Map
 */
function initialize() {
	// setup Map options
	var myOptions = {
		zoom: 8,
		center: new google.maps.LatLng(default_latitude, default_longitude),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	
	// load the GeoCoder
	geocoder = new google.maps.Geocoder();
	
	// load the Map
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	// edit page is being displayed so show marker for Restaurant
	if($('#RestaurantAdminEditForm').length) {
		// get form lat/lng values
		var lat = $('#RestaurantLat').val();
		var lng = $('#RestaurantLng').val();
		var latlng = new google.maps.LatLng(lat, lng);
		
		// set center of Map
		map.setCenter(latlng);
		map.setZoom(14);
		
		// add Marker
		var marker = new google.maps.Marker({
			map: map,
			position: latlng
		});
	}
}