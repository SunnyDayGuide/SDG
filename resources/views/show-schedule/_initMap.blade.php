<script type="application/javascript">

  var showMap = $('#show-map');
  var placeholder = $('.placeholder');

  function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
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
      mapTypeId: 'roadmap'
  };

    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    map.setTilt(50);

    // Multiple markers location, latitude, and longitude
    var markers = [
    ['{{ $show->theater->name }}', {{ $show->theater->latitude }}, {{ $show->theater->longitude }}],
    ];

    // Info window content
    var infoWindowContent = [
    ['<div id="content" class="info-window">'+
        '<h5 class="text-advertiser font-weight-bold">{{ $show->theater->name }}</h5>'+
        '<p>{{ $show->theater->full_address }}</p>' +
        '<a href="{{ $show->theater->directions }}" class="btn btn-sm btn-primary">'+
        'Get Directions</a>'+
        '</div>'],
    ];

    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
    
}

  // Toggle placeholder & button off and map div on
  $("#show-map").click(function() {
    $(".map-container").toggle();
    $("#map").toggle();
});

  // NOW initialize the Map
  $(document).ready(function() {
    $('#show-map').on('click',initMap)
});

</script>

<!--Load the API from the specified URL
  * The async attribute allows the browser to render the page while the API loads
  * The key parameter will contain your own API key (which is not needed for this tutorial)
  * The callback parameter executes the initMap() function
-->
@php
$key = env('GOOGLE_MAP_API_KEY');
@endphp

<script type="application/javascript" async defer
src="https://maps.googleapis.com/maps/api/js?key={{ $key }}">
</script>
