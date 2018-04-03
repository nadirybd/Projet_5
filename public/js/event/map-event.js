$(document).ready(function(){	
	var url = 'indexAjax.php?req=events';

	$.get(url, {event: true}, function(data){
		dataJson = JSON.parse(data);
		dataJson.forEach(function(info){
			var position = info.address
			$.get('https://maps.googleapis.com/maps/api/geocode/json', {address: position, key: 'AIzaSyCAEu3Juo2B5iorwZn9cRGk3qoWKriK488'}, function(response){
				response.results.forEach(function(res){
					var latitude = res.geometry.location.lat;
					var longitude = res.geometry.location.lng;
					var marker = new google.maps.Marker({
						position: {lat: latitude, lng: longitude},
						map: map,
						title: info.title,
						info: info.info,
						event_date: info.event_dateFr,
						address: info.address,
						icon: 'public/images/icons/maps.png'
					});

					marker.addListener('click', function(){
						$('.info-event h3').html(marker.title);
						$('.description-event').html(marker.info);
						$('.address').html(marker.address);
						$('.info-event p').html(marker.event_date);
					});
				});			
			});

		});
	});
});

var map; 

function initMap(){
	var optionMap = {
		center: {lat: 48.856614, lng: 2.3522219},
		zoom: 5
	};

	map = new google.maps.Map($('#event-map').get(0), optionMap);
}