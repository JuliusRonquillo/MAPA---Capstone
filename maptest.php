<link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps.css'>
<script onload="mapContent();" src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps-web.min.js" defer></script>

<style>
#map {
	height: 500px;
	width: 100%;
}

@media only screen and (max-width: 767px) {
	#map {
		height: 300px;
	}
}

#marker {
  background-image: url('/wp-content/uploads/2021/04/copywriter-logo-dark.svg');
  background-size: cover;
  width: 30px;
  height: 30px;
}

</style>

<div id='map'></div>
<script>
	function mapContent(){
		var api_key = 'H92PtTd3hxV15Gp57sWxWJUgtnGeTwzG';
		var latAndLong = {lat: 13.78423, lng: 121.07436}; 
		var zoomLevel = 14;
		var yourAddress = 'bsu';

		var map = tt.map({
		    container: 'map',
		    key: api_key,
		    center: latAndLong,
		    zoom: zoomLevel
		});

		var marker = new tt.Marker().setLngLat(latAndLong).addTo(map);
	 	
	 	// FOR CUSTOM MARKER
		//var customMarker = document.createElement('div');
		//customMarker.id = 'marker';
		//var marker = new tt.Marker({element: customMarker}).setLngLat(latAndLong).addTo(map);

		var popupOffsets = {
		  top: [0, 0],
		  bottom: [0, -70],
		  'bottom-right': [0, -70],
		  'bottom-left': [0, -70],
		  left: [25, -35],
		  right: [-25, -35]
		}

		var popup = new tt.Popup({offset: popupOffsets}).setHTML(yourAddress);
	    marker.setPopup(popup).togglePopup();

    }

</script>