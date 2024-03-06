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

        var latLngArray = [place.geometry.location.lat(), place.geometry.location.lng()];
        document.querySelector('.lat_lng').value = latLngArray;
        addMarker(new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng()), map);

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








    const map3 = new google.maps.Map(document.getElementById("polygonmap"), {
        zoom: 5.2,
        center: {
            lat: -2.0423904,
            lng: 102.8983498
        },
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var card3 = document.getElementById("pac-card3");
    var input3 = document.getElementById("pac-input3");
    const options3 = {
        fields: ["formatted_address", "geometry", "name"],
        strictBounds: false,
        componentRestrictions: {country: "id"},
        types: ["geocode"],
        draggable: false,
        disableDefaultUI: true,
    };

    var autocomplete3 = new google.maps.places.Autocomplete(input3, options3);
    autocomplete3.bindTo("bounds", map3);

    const infowindow3 = new google.maps.InfoWindow();
    const infowindowContent3 = document.getElementById("infowindow-content");

    infowindow3.setContent(infowindowContent3);

    autocomplete3.addListener("place_changed", () => {
        infowindow3.close();

        const place3 = autocomplete3.getPlace();

        if (!place3.geometry || !place3.geometry.location) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert("No details available for input: '" + place3.name + "'");
            return;
        }

        // If the place has a geometry, then present it on a map.
        // if (place3.geometry.viewport) {
        //     map3.fitBounds(place3.geometry.viewport);
        // } else {
        // }
        map3.setCenter(place3.geometry.location);
        map3.setZoom(17);

        // marker2.setPosition(place3.geometry.location);
        // marker2.setVisible(true);

        // addMarker2(new google.maps.LatLng(place3.geometry.location.lat(), place3.geometry.location.lng()), map3);


        // document.getElementById('latMap2').value = place3.geometry.location.lat();
        // document.getElementById('lngMap2').value = place3.geometry.location.lng();

        

        infowindowContent3.children["place-name"].textContent = place3.name;
        infowindowContent3.children["place-address"].textContent = place3.formatted_address;
    });


    var drawingManager = new google.maps.drawing.DrawingManager({
        drawingMode: google.maps.drawing.OverlayType.POLYGON,
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [
                google.maps.drawing.OverlayType.POLYGON,
            ]
        },
        markerOptions: {
            icon: 'images/car-icon.png'
        },
        circleOptions: {
            fillColor: '#ffff00',
            fillOpacity: 1,
            strokeWeight: 5,
            clickable: false,
            editable: true,
            zIndex: 1
        },
        polygonOptions: {
            fillColor: '#BCDCF9',
            fillOpacity: 0.5,
            strokeWeight: 2,
            strokeColor: '#57ACF9',
            clickable: false,
            editable: false,
            zIndex: 1
        }
    });

    drawingManager.setMap(map3);

    google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
        var string = [];
        arrLatLng = [];
        for (var i = 0; i < polygon.getPath().getLength(); i++) {
            latLng = {
                lat: polygon.getPath().getAt(i).lat(),
                lng: polygon.getPath().getAt(i).lng()
            };
            arrLatLng.push(latLng);
        }
        polygonString.push(string);
        polygonArray.push(polygon);
        document.getElementById('polygon_array').value = JSON.stringify(arrLatLng);
    });
}

google.maps.event.addDomListener(window, 'load', initialize);