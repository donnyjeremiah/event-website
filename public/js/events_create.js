/*
** @author Donovan Jeremiah
** Google Maps API, JQuery UI datepicker and jquery.timepicker
*/

// Google Map
var map;
var marker;
var isMarkerSet = false;
var defaultZoom = 11;
var zipZoom = 14;

$(function() {

  setLocalJS();

  authenticate();

	$('#markerSet').click(function() {
    if(isMarkerSet === false)
      addMarker();
    else
      marker.setPosition(map.getCenter());
	});

  $('#markerUnset').click(function() {
    if(isMarkerSet === true)
      removeMarker();
	});

  $('#setLocation').click(function() {
    if(isMarkerSet === true) {}
      $('#latitude').val(marker.getPosition().lat());
      $('#longitude').val(marker.getPosition().lng());
	});

	$('#zipSearch').click(function() {
		setZipLocation();
	});

});

function addMarker(place) {
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

/*
* Google Maps using GeoLocation or user input zip code. By Paul Dessert
* www.pauldessert.com | www.seedtip.com
*/
function setZipLocation() {
    var geo = new google.maps.Geocoder();
    var address = $('#zipText').val() + ', India';
    geo.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var lat = results[0].geometry.location.lat();
            var lng = results[0].geometry.location.lng();
						map.setCenter(new google.maps.LatLng(lat,lng));
						map.setZoom(zipZoom);
        } else {
            alert("Something went wrong :/");
        }
    });
}

/*
* Form
*/
function setLocalJS() {
$('#markerSet').click(function (e) { e.preventDefault(); });
$('#markerUnset').click(function (e) { e.preventDefault(); });

$('#time').timepicker();

$('#showTo').hide();
$('#date_start').datepicker({
  showOtherMonths: true,
  selectOtherMonths: true,
  changeMonth: true,
  changeYear: true,
  minDate: 0,
  maxDate: '+1Y',
  dateFormat: 'dd/mm/yy',
  onClose: function(selectedDate) {
    $('#date_end').datepicker('option','minDate',selectedDate);
  }
});

$('#date_end').datepicker({
  showOtherMonths: true,
  selectOtherMonths: true,
  changeMonth: true,
  changeYear: true,
  minDate: 0,
  maxDate: '+1Y',
  dateFormat: 'dd/mm/yy',
  onClose: function(selectedDate) {
    $('#date_start').datepicker('option','maxDate',selectedDate);
  }
});

$('#days').on('change', function() {
  if(this.value == '1+') {
    $('#showTo').show();
    $('#date_start').attr('placeholder','FROM');
    $('#date_end').attr('placeholder','T0');
  } else {
    $('#showTo').hide();
    $('#date_start').attr('placeholder','DD/MM/YYYY');
  }
});

}

//$('.countries').val('India');
//$('.countries').change();
//$('.countries').trigger("change");
/*
$('.countries option').map(function () {
    if ($(this).val() == 'India') return this;
}).attr('selected', 'selected');
*/
//$('.countries').change();

/*
* Validation
*/
function authenticate() {
  var req = { required: 'true' };
  console.log('Inside authenticate');
  $('#create_form').parsley();
  $('#name').parsley({ required: 'true', pattern: '[a-zA-Z0-9\'\-,.&:/!@ ]+', maxlength: 255 });
  $('#type').parsley(req);
  $('#poster').parsley(req);
  $('#description').parsley({ required: 'true', maxlength: 800 });
  $('#days').parsley(req);
  $('#date_start').parsley({ required: 'true', maxlength: 10, pattern: '[0-9]{2}\/[0-9]{2}\/[0-9]{4}' });
  $('#date_end').parsley({ maxlength: 10, pattern: '[0-9]{2}\/[0-9]{2}\/[0-9]{4}' });
  $('#time').parsley({ required: 'true', maxlength: 10, pattern: '[0-9][0-9]?:[0-9]{2}[ap]m' });
  $('#line_1').parsley({ required: 'true', maxlength: 50 });
  $('#line_2').parsley({ required: 'true', maxlength: 50 });
  $('#landmark').parsley({ maxlength: 50 });
  $('#countryId').parsley(req);
  $('#stateId').parsley(req);
  $('#cityId').parsley(req);
  $('#zip').parsley({ required: 'true', type: 'digits', length: [6, 6] });
  $('#latitude').parsley(req);
  $('#longitude').parsley(req);
}
