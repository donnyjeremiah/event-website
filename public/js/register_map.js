/*
** Pull local Farers market data from the USDA API and display on
** Google Maps using GeoLocation or user input zip code. By Paul Dessert
** www.pauldessert.com | www.seedtip.com
*/

// Google Map
var map;
var marker;
var isMarkerSet = false;
var defaultZoom = 11

$(function() {
	$('#set').click(function() {
    if(isMarkerSet === false)
      addMarker();
	});

  $('#remove').click(function() {
    if(isMarkerSet === true)
      removeMarker();
	});

  $('#done').click(function() {
    if(isMarkerSet === true) {}
      //console.log('lat: ' + marker.getPosition().lat() + ' lng:' + marker.getPosition().lng());
      //var markerPos = {lat: marker.getPosition().lat(), lng: marker.getPosition().lng()};
	});

	$('#searchZip').click(function() {
		setZipLocation();
	});

});

function addMarker(place)
{
    //var img = 'public/css/images/blue_android.png';
    marker = new google.maps.Marker({
      position: map.getCenter(),
      map: map,
      //icon: img,
      title: 'Hello World!',
      draggable: true,
      animation: google.maps.Animation.DROP,
    });
    isMarkerSet = true;
}

function removeMarker() {
  marker.setMap(null);
  marker = null;
  isMarkerSet = false;
}

function initMap() {
	var mapOptions = {
		zoom: defaultZoom,
		center: new google.maps.LatLng(13.0659174,80.215524), //Chennai, Tamil Nadu, India
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


function setZipLocation() {
    var geo = new google.maps.Geocoder();
    var address = $('#zipText').val() + ', India'; // validate address
		console.log('zip: '+address);
    geo.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var lat = results[0].geometry.location.lat();
            var lng = results[0].geometry.location.lng();
						map.setCenter(new google.maps.LatLng(lat,lng));
						map.setZoom(14);
        } else {
            alert("Something went wrong :/")
        }
    });
};
