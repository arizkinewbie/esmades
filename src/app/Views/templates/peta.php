<script>
    /* eslint-disable no-undef */
/**
 * geoJSON extended action
 */

// config map
let config = {
  minZoom: 2,
  maxZoom: 18,
};
// magnification with which the map will start
const zoom = 13;
// co-ordinates
const lat = -6.886177;
const lng = 107.559358;

// calling map
const map = L.map("map", config).setView([lat, lng], zoom);

// Used to load and display tile layers on the map
// Most tile servers require attribution, which you can set under `Layer`
L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);

// adding the province name to the visible div
function addTextToDiv(text) {
  const markerPlace = document.querySelector(".marker-position");
  markerPlace.textContent = text;
}

// showing the name of the province
function getVoivodeshipName(feature, layer) {
  if (feature.properties && feature.properties.nazwa) {
    layer.bindPopup(feature.properties.nazwa);
  }
}

// adding geojson by fetch
// of course you can use jquery, axios etc.
fetch("<?= base_url('templates/01/assets/static/cimahi.geojson') ?>")
  .then(function (response) {
    return response.json();
  })
  .then(function (data) {
    let layer = new L.GeoJSON(data, {
      // A Function that will be called once for each
      // created Feature, after it has been created and styled
      style: function(feature) {
        return {
            fillColor: "red",
            color: "black",
            dashArray: [5],
            width: 2,
            // fillColor: feature.properties['fill'],
            // fillOpacity: feature.properties['fill-opacity'],
            // color: feature.properties['stroke'],
            // width: feature.properties['stroke-width'],
            // opacity: feature.properties['opacity']
        };
    },
      onEachFeature: function (feature, layer) {
        
        layer.on("click", function () {
          // adding the province name to the visible div
        //   addTextToDiv(feature.properties.nazwa);
          console.log(feature.properties.data.nama)
        });

        // layer.on("mouseover", function (e) {
        //   // bindPopup
        //   getVoivodeshipName(feature, layer);
        //   // show voivodeship
        //   addTextToDiv(feature.properties.nazwa);
        //   this.openPopup();
        //   // style
        //   this.setStyle({
        //     fillColor: "#eb4034",
        //     weight: 2,
        //     color: "#eb4034",
        //     fillOpacity: 0.7,
        //   });
        // });
        // layer.on("mouseout", function () {
        //   this.closePopup();
        //   // style
        //   this.setStyle({
        //     fillColor: "#3388ff",
        //     weight: 2,
        //     color: "#3388ff",
        //     fillOpacity: 0.2,
        //   });
        // });
        // layer.on("click", function () {
        //   // adding the province name to the visible div
          
        //   addTextToDiv(feature.properties.data.nama);
        // });
      },
    }).addTo(map);
  });
</script>