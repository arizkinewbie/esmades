var map;

function initialize() {
    var mapOptions = {
        zoom: 5.2,
        center: new google.maps.LatLng(-2.0423904, 102.8983498),
        mapTypeControl: false,
    };

    map = new google.maps.Map(document.getElementById('map1'),
        mapOptions
    );
    

    var card = document.getElementById("pac-card");
    var input = document.getElementById("pac-input");
    const options = {
        fields: ["formatted_address", "geometry", "name"],
        strictBounds: false,
        componentRestrictions: {country: "id"},
        types: ["geocode"],
        draggable: false,
        disableDefaultUI: true,
    };

    // map.controls[google.maps.ControlPosition.TOP_LEFT].push(card);

    var autocomplete = new google.maps.places.Autocomplete(input, options);

    // Bind the map's bounds (viewport) property to the autocomplete object,
    // so that the autocomplete requests use the current map bounds for the
    // bounds option in the request.
    autocomplete.bindTo("bounds", map);

    const infowindow = new google.maps.InfoWindow();
    const infowindowContent = document.getElementById("infowindow-content");

    infowindow.setContent(infowindowContent);

    var marker = new google.maps.Marker({
        map,
        anchorPoint: new google.maps.Point(0, -29),
    });

    autocomplete.addListener("place_changed", () => {
        infowindow.close();
        marker.setVisible(false);

        const place = autocomplete.getPlace();

        if (!place.geometry || !place.geometry.location) {
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }

        map.setCenter(place.geometry.location);
        map.setZoom(17);

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        addMarker(new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng()), map);

        document.getElementById('latMap1').value = place.geometry.location.lat();
        document.getElementById('lngMap1').value = place.geometry.location.lng();

        infowindowContent.children["place-name"].textContent = place.name;
        infowindowContent.children["place-address"].textContent =
        place.formatted_address;
        infowindow.open(map, marker);
    });

    google.maps.event.addListener(map, 'click', function(event) {
        var latLngArray = [event.latLng.lat(), event.latLng.lng()];

        document.querySelector('.lat_lng').value = latLngArray;

        if (marker != null) {
            marker.setMap(null);
        }
        addMarker(new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()), map);
    });

    function addMarker(latLng, map) {
        if (marker != null) {
            marker.setMap(null);
        }

        marker = new google.maps.Marker({
            position: latLng,
            map: map
        });
    }
}

google.maps.event.addDomListener(window, 'load', initialize);