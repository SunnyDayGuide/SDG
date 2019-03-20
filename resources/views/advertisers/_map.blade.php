{{-- <div class="row my-2" id="map">
	<div class="col-12">
		<div class="map bg-light p-5">
			<h2>Map Here</h2>
		</div>
	</div>
</div> --}}

{{-- <div id="mapContainer">
  <div id="map"></div>
</div>
<a href="">Expand Map</a> --}}

<div class="wrap-collapsible">
  <input id="collapsible" class="toggle" type="checkbox">
  <label for="collapsible" class="lbl-toggle">Expand Map</label>
  <div class="collapsible-content">
    <div id="map"></div>
  </div>
</div>


<script type="application/javascript">

  function initMap() {
    // get locations from db
    var locations = [
    @foreach($locations as $location)
    ['{{ $advertiser->name }}', {{ $location->latitude }}, {{ $location->longitude }}, {{ $loop->index }}],
    @endforeach
    ];

    // set map options
    var myOptions = {
      zoom: 15,
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

    // draw map
    var map = new google.maps.Map(document.getElementById('map'), myOptions);

    var infowindow = new google.maps.InfoWindow();

    // set empty bound
    var bounds = new google.maps.LatLngBounds();

    // set markers
    for (var i = 0; i < locations.length; i++) {
      var location = locations[i];

      var marker = new google.maps.Marker({
        position: {lat: location[1], lng: location[2]},
        map: map,
        title: location[0],
        zIndex: location[3]
      });

      // extend bounds to marker edge
      bounds.extend(marker.position);

      // info window
      google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent(location[0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }

    // fit map to combo of all marker bounds
    map.fitBounds(bounds);

    var listener = google.maps.event.addListener(map, "idle", function () {
        google.maps.event.removeListener(listener);
    });

  }
</script>

<!--Load the API from the specified URL
  * The async attribute allows the browser to render the page while the API loads
  * The key parameter will contain your own API key (which is not needed for this tutorial)
  * The callback parameter executes the initMap() function
-->
<script type="application/javascript" async defer
src="https://maps.googleapis.com/maps/api/js?key={{ $key }}&callback=initMap">
</script>

{{-- <script type="application/javascript" src="{{ asset('js/SVGMarker.min.js') }}"></script> --}}

