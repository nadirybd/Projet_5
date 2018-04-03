$(document).ready(function(){
	$('#event_address').change(function(e){
		var position = $('#event_address').val();
		$.get('https://maps.googleapis.com/maps/api/geocode/json',{ address: position, key: 'AIzaSyCAEu3Juo2B5iorwZn9cRGk3qoWKriK488' }, function(response){

				var formattedAddress = response.results[0].formatted_address;
				var latitude = response.results[0].geometry.location.lat;
				var longitude = response.results[0].geometry.location.lng;
				map = initMap({lat: latitude, lng: longitude});
				
				marker({lat: latitude, lng: longitude}, map);
				marker({lat: latitude, lng: longitude}, map);
				
				$('input[name="event_address"]').val(formattedAddress);

			}, 'json');
	});

	$('#edit_event_address').change(function(e){
		var position = $('#edit_event_address').val();
		$.get('https://maps.googleapis.com/maps/api/geocode/json',{ address: position, key: 'AIzaSyCAEu3Juo2B5iorwZn9cRGk3qoWKriK488' }, function(response){

				var formattedAddress = response.results[0].formatted_address;
				var latitude = response.results[0].geometry.location.lat;
				var longitude = response.results[0].geometry.location.lng;
				map = initMap({lat: latitude, lng: longitude});
				
				marker({lat: latitude, lng: longitude}, map);
				marker({lat: latitude, lng: longitude}, map);
				
				$('input[name="edit_event_address"]').val(formattedAddress);
				
			}, 'json');
	});
});

function initMap(option) {
	this.option = option;
	that = this;
	var map;
	
	if(option == null){
		map = new google.maps.Map($('#map-coords').get(0), {
  			center: {lat: 48.856614, lng: 2.3522219},
 	 		zoom: 9
		});
	} else {
		map = new google.maps.Map($('#map-coords').get(0), {
  			center: that.option,
 	 		zoom: 9
		});
	}
	return map;
}

function marker(option, map) {
	this.option = option;
	this.map = map;
	that = this;
	map = new google.maps.Marker({
  		position: that.option,
  		map: that.map
	});
}
