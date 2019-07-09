{{-- <div class="row my-2" id="map">
	<div class="col-12">
		<div class="map bg-light p-5">
			<h2>Map Here</h2>
		</div>
	</div>
</div> --}}
 {{-- <div id="map"></div> --}}

<script type="application/javascript">
  var showMap = $('#show-map');

  function initMap() {
        var lat = {{ $singleLocation->latitude }};
        var lng = {{ $singleLocation->longitude }};
        var myLatLng = {lat, lng};

        var myOptions = {
          zoom: 15,
          center: myLatLng,
          mapTypeControl: false,
          streetViewControl: false,
          navigationControl: true,
          styles: [
          {
            "featureType": "poi.business",
            "elementType": "labels.text",
            "stylers": [
            {
              "visibility": "off"
            }
            ]
          }
          ],
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = new google.maps.Map(document.getElementById('map'), myOptions);

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });
      }

      $(document).ready(function(){
          $('#show-map').on('click',initMap)
      });

</script>

<!--Load the API from the specified URL
  * The async attribute allows the browser to render the page while the API loads
  * The key parameter will contain your own API key (which is not needed for this tutorial)
  * The callback parameter executes the initMap() function
-->
<script type="application/javascript" async defer
src="https://maps.googleapis.com/maps/api/js?key={{ $key }}">
</script>

{{-- <script type="application/javascript" src="{{ asset('js/SVGMarker.min.js') }}"></script> --}}

