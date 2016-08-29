/* Pull local Farers market data from the USDA API and display on
** Google Maps using GeoLocation or user input zip code. By Paul Dessert
** www.pauldessert.com | www.seedtip.com
*/

// Google Map
var map;

// markers for map
//var markers = [];
var userCords;
var defaultZoom = 11;

// info window
//var info = new google.maps.InfoWindow();

$(function() {

	$('#current').click(function() {
		setUserLocation();
	});

});

function initMap() {
	var mapOptions = {
		zoom: defaultZoom,
		center: new google.maps.LatLng(13.0659174,80.215524),
		panControl: false,
		panControlOptions: {
			position: google.maps.ControlPosition.BOTTOM_LEFT
		},
		zoomControl: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.LARGE,
			position: google.maps.ControlPosition.RIGHT_CENTER
		},
		scaleControl: false
	};

	//Fire up Google maps and place inside the map-canvas div
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}


function setUserLocation() {
	// https://developers.google.com/maps/articles/geolocation
	if (navigator.geolocation) {
		function error(err) {
			console.warn('ERROR(' + err.code + '): ' + err.message);
		}
		function success(pos){
			//userCords = pos.coords;
			map.setCenter(new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude));
			map.setZoom(defaultZoom); // ERROR
		}
		// Get the user's current position
		navigator.geolocation.getCurrentPosition(success, error);
		//console.log(pos.latitude + " " + pos.longitude);
	} else {
		alert('Oops, Geolocation is not supported in your browser :/');
	}
}


function setZipLocation() {
    var geocoder = new google.maps.Geocoder();
    var zip = S("#zipText").val() + ', India';
    geocoder.geocode({ 'address': zip }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            alert("Latitude: " + latitude + "\nLongitude: " + longitude);
        } else {
            alert("Request failed.")
        }
    });
};
