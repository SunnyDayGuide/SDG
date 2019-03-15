{{-- <div class="row my-2" id="map">
	<div class="col-12">
		<div class="map bg-light p-5">
			<h2>Map Here</h2>
		</div>
	</div>
</div> --}}
<div id="map"></div>

<script>
// Initialize and add the map
function initMap() {
  // The location of Uluru
  var uluru = {lat: -25.344, lng: 131.036};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 4, center: uluru});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: uluru, map: map});
}
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAu9KFGLVdO8770mb5EjYFqbPB0nx6rEaA&callback=initMap">
    </script>

{{-- <script 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAu9KFGLVdO8770mb5EjYFqbPB0nx6rEaA&callback=initMap">
</script>

<script src="{{ asset('js/SVGMarker.min.js') }}"></script> --}}