<style>
#chartdiv {
    width: 100%;
    height: 400px;
    text-align: center;
}
</style>

<div class="marker-position">Click/hover on polygon</div>
<div id="map"></div>

<div class="accordion custom-accordionwithicon accordion-success" id="accordionWithicon" style="pointer-events: auto;
    max-height: calc(100vh - 17em);
    background: #fffdba;
    width: 20rem;
    right: 1rem;
    position: absolute;
    top: 6rem;
    z-index:2">
    <div class="accordion-item material-shadow">
        <h2 class="accordion-header" id="accordionwithiconExample1">
            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                data-bs-target="#accor_iconExamplecollapse1" aria-expanded="true"
                aria-controls="accor_iconExamplecollapse1">
                <i class="ri-global-line me-2"></i> Layer Peta
            </button>
        </h2>
        <div id="accor_iconExamplecollapse1" class="accordion-collapse collapse show"
            aria-labelledby="accordionwithiconExample1" data-bs-parent="#accordionWithicon">
            <div class="accordion-body">
                <!-- Custom Radio Color -->
                <div class="form-check form-radio-primary mb-3">
                    <input class="form-check-input" type="radio" name="layerPeta" value="OSM" checked>
                    <label class="form-check-label"> OSM </label>
                </div>
                <div class="form-check form-radio-primary mb-3">
                    <input class="form-check-input" type="radio" name="layerPeta" value="RBI">
                    <label class="form-check-label"> RBI </label>
                </div>
                <div class="form-check form-radio-primary mb-3">
                    <input class="form-check-input" type="radio" name="layerPeta" value="ROAD">
                    <label class="form-check-label"> ROAD </label>
                </div>
                <div class="form-check form-radio-primary mb-3">
                    <input class="form-check-input" type="radio" name="layerPeta" value="Areial">
                    <label class="form-check-label"> Areial </label>
                </div>
                <div class="form-check form-radio-primary mb-3">
                    <input class="form-check-input" type="radio" name="layerPeta" value="Areial Label">
                    <label class="form-check-label"> Areial Label </label>
                </div>
            </div>
        </div>
    </div>
    <div class="accordion-item material-shadow">
        <h2 class="accordion-header" id="accordionwithiconExample2">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#accor_iconExamplecollapse2" aria-expanded="false"
                aria-controls="accor_iconExamplecollapse2">
                <i class="ri-user-location-line me-2"></i> Aset Desa
            </button>
        </h2>
        <div id="accor_iconExamplecollapse2" class="accordion-collapse collapse"
            aria-labelledby="accordionwithiconExample2" data-bs-parent="#accordionWithicon">
            <div class="accordion-body">
                <!-- Custom Checkboxes Color -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="jenis_aset_id" checked>
                    <label class="form-check-label">
                        Tanah
                    </label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="jenis_aset_id">
                    <label class="form-check-label">
                        Kantor Desa
                    </label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="jenis_aset_id">
                    <label class="form-check-label">
                        Kantor KUD
                    </label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="jenis_aset_id">
                    <label class="form-check-label">
                        Kantor Kebudayaan
                    </label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="jenis_aset_id">
                    <label class="form-check-label">
                        Kantor Seni
                    </label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="jenis_aset_id">
                    <label class="form-check-label">
                        Gedung Olahraga
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
// config map
let config = {
    minZoom: 2,
    maxZoom: 18,
};

const zoom = 8;
const lat = -7.0677757;
const lng = 107.9426998;

// calling map
const map = L.map("map", config).setView([lat, lng], zoom);


L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
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

function onEachFeature(feature, layer) {
    var popupContent = "<p>DaTerra Web</p>";
    if (feature.properties && feature.properties.popupContent) {
        popupContent += feature.properties.popupContent;
    }
    layer.bindPopup(popupContent);
}



var polygonsWithCenters = L.layerGroup();
var greenIcon = L.icon({
    iconUrl: '<?= base_url('dist/assets/pin/assets.png') ?>',
    iconSize: [28, 28],
});

// adding geojson by fetch
// of course you can use jquery, axios etc.
fetch("<?= base_url('dist/assets/static/Jabar_By_Kab.geojson') ?>")
    .then(function(response) {
        return response.json();
    })
    .then(function(data) {
        let layer = new L.GeoJSON(data, {

            style: function(feature) {
                return {
                    fillColor: "#0ab39c",
                    fillOpacity: .3,
                    color: "#7c4baf",
                    dashArray: [5],
                    width: 2,
                };
            },

            // A Function that will be called once for each
            // created Feature, after it has been created and styled
            onEachFeature: function(feature, layer) {

                if (feature.geometry.type === "MultiPolygon") {
                    var center = layer.getBounds().getCenter();
                    var marker = L.marker(center, {
                        icon: greenIcon
                    });
                    var polygonAndItsCenter = L.layerGroup([layer, marker]);
                    polygonAndItsCenter.addTo(polygonsWithCenters);

                    var customOptions = {
                        closeButton: true,
                        autoClose: true,
                        autoPanPadding: [0, 0],
                        className: 'card'
                    }



                    var info = `
                    <div class="card-header">
                        <a href="#close" class="btn-close float-end fs-11 leaflet-popup-close-button" aria-label="Close"></a>
                        <h6 class="card-title mb-0">` + feature.properties.KABKOT + `</h6>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-muted mb-0">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae aliquam facilis nostrum possimus mollitia officiis quod voluptatibus culpa necessitatibus iure. Tempore nostrum quibusdam quod pariatur porro exercitationem dicta odit voluptatem!</p>
                    </div>
                    <div class="card-footer">
                        <a href="javascript:void(0);" class="link-success float-end">Detail <i class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i></a>
                    </div>`;

                    layer.bindPopup(info, customOptions);
                }

                layer.on("mouseover", function(e) {
                    // bindPopup
                    getVoivodeshipName(feature, layer);
                    // show voivodeship
                    addTextToDiv(feature.properties.nazwa);
                    // this.openPopup();
                    // style
                    this.setStyle({
                        fillColor: "#3388ff",
                        weight: 2,
                        color: "#3388ff",
                        fillOpacity: 0.7,
                    });
                });
                layer.on("mouseout", function() {
                    // this.closePopup();
                    // style
                    this.setStyle({
                        fillColor: "#0ab39c",
                        weight: 2,
                        color: "#7c4baf",
                        fillOpacity: 0.2,
                    });
                });
                layer.on("click", function() {
                    // adding the province name to the visible div
                    addTextToDiv(feature.properties.nazwa);
                    this.openPopup();
                });
            },
        }).addTo(map);

        polygonsWithCenters.addTo(map);
    });
</script>

<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Responsive.js"></script>


<script>
am5.ready(function() {






    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root2 = am5.Root.new("chartdiv2");


    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root2.setThemes([
        am5themes_Animated.new(root2)
    ]);

        // Create chart
    // https://www.amcharts.com/docs/v5/charts/xy-chart/
    var chart2 = root2.container.children.push(am5xy.XYChart.new(root2, {
        panX: true,
        panY: true,
        wheelX: "panX",
        wheelY: "zoomX",
        pinchZoomX: true,
        paddingLeft: 0,
        paddingRight: 1
    }));

    // Add cursor
    // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
    var cursor2 = chart2.set("cursor", am5xy.XYCursor.new(root2, {}));
    cursor2.lineY.set("visible", false);

    // Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xRenderer = am5xy.AxisRendererX.new(root2, { 
  minGridDistance: 30, 
  minorGridEnabled: true
});

xRenderer.labels.template.setAll({
  rotation: -90,
  centerY: am5.p50,
  centerX: am5.p100,
  paddingRight: 15
});

xRenderer.grid.template.setAll({
  location: 1
})

var xAxis = chart2.xAxes.push(am5xy.CategoryAxis.new(root2, {
  maxDeviation: 0.3,
  categoryField: "country",
  renderer: xRenderer,
  tooltip: am5.Tooltip.new(root2, {})
}));

var yRenderer = am5xy.AxisRendererY.new(root2, {
  strokeOpacity: 0.1
})

var yAxis = chart2.yAxes.push(am5xy.ValueAxis.new(root2, {
  maxDeviation: 0.3,
  renderer: yRenderer
}));

// Create series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series2 = chart2.series.push(am5xy.ColumnSeries.new(root2, {
  name: "Series 1",
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "value",
  sequencedInterpolation: true,
  categoryXField: "country",
  tooltip: am5.Tooltip.new(root2, {
    labelText: "{valueY}"
  })
}));

series2.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
series2.columns.template.adapters.add("fill", function (fill, target) {
  return chart2.get("colors").getIndex(series2.columns.indexOf(target));
});

series2.columns.template.adapters.add("stroke", function (stroke, target) {
  return chart.get("colors").getIndex(series2.columns.indexOf(target));
});


// Set data
var data2 = [{
  country: "USA",
  value: 2025
}, {
  country: "China",
  value: 1882
}, {
  country: "Japan",
  value: 1809
}, {
  country: "Germany",
  value: 1322
}, {
  country: "UK",
  value: 1122
}, {
  country: "France",
  value: 1114
}, {
  country: "India",
  value: 984
}, {
  country: "Spain",
  value: 711
}, {
  country: "Netherlands",
  value: 665
}, {
  country: "South Korea",
  value: 443
}, {
  country: "Canada",
  value: 441
}];

// xAxis.data2.setAll(data2);
// series2.data2.setAll(data2);


// // // Make stuff animate on load
// // // https://www.amcharts.com/docs/v5/concepts/animations/
// series2.appear(1000);
// chart2.appear(1000, 100);
    
    
    
    
    
    
    
    

    

    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root = am5.Root.new("chartdiv");


    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([
        am5themes_Animated.new(root)
    ]);


    // Create chart
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
    var chart = root.container.children.push(am5percent.PieChart.new(root, {
        layout: root.verticalLayout,
        innerRadius: am5.percent(50)
    }));


    // Create series
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
    var series = chart.series.push(am5percent.PieSeries.new(root, {
        valueField: "value",
        categoryField: "category",
        alignLabels: false
    }));

    series.labels.template.setAll({
        textType: "circular",
        centerX: 0,
        centerY: 0
    });


    // Set data
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
    series.data.setAll([{
            value: 495,
            category: "Laki-laki"
        },
        {
            value: 754,
            category: "Perempuan"
        },
    ]);


    // Create legend
    // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
    var legend = chart.children.push(am5.Legend.new(root, {
        centerX: am5.percent(50),
        x: am5.percent(50),
        marginTop: 15,
        marginBottom: 15,
    }));

    legend.data.setAll(series.dataItems);


    // Play initial series animation
    // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
    series.appear(1000, 100);


}); // end am5.ready()
</script>