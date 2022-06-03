<?php include "header.php"; ?>

<header class="major">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css" type="text/css">
    <style>
      .map {
        height: 640px;
        width: 100%;
      }
    </style>
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js"></script>
    <title>map</title>
  </head>
  <body>

    <h2>la map </h2>
    <section>
    <div id="map" class="map"></div>
    <div id="info" style="display: none;"></div>
    <label for="track">
      track position
      <input id="track" type="checkbox" checked>
    </label>
    <p>
      position accuracy : <code id="accuracy"></code>&nbsp;&nbsp;
      altitude : <code id="altitude"></code>&nbsp;&nbsp;
      altitude accuracy : <code id="altitudeAccuracy"></code>&nbsp;&nbsp;
      heading : <code id="heading"></code>&nbsp;&nbsp;
      speed : <code id="speed"></code>
    </p>
    <script type="module" type="text/javascript">
var Feature=ol.Feature;
var Map  = ol.Map;
var Geolocation=ol.Geolocation;       
var View = ol.View;
var Point=ol.geom.Point; 
var {Circle,Fill,Stroke,Style}=ol.style;
var CircleStyle=Circle;
var MousePosition = ol.control.MousePosition;    
var TileLayer= ol.layer.Tile; 
var OSM = ol.source.OSM;
var {createStringXY}=ol.coordinate;
var defaults =ol.control;
var {defaultControls} = defaults;
var Draw = ol.interaction.Draw;
var VectorSource=ol.source.Vector;
var VectorLayer = ol.layer.Vector;

var view = new View({
  center: [-6.12,34.01],
  zoom: 5,
});

var map = new Map({
  layers: [
    new TileLayer({
      source: new OSM(),
    }) ],
  target: 'map',
  view: view,
});

var geolocation = new Geolocation({
  // enableHighAccuracy must be set to true to have the heading value.
  trackingOptions: {
    enableHighAccuracy: true,
  },
  projection: view.getProjection(),
});

function el(id) {
  return document.getElementById(id);
}

el('track').addEventListener('change', function () {
  geolocation.setTracking(this.checked);
});

// update the HTML page when the position changes.
geolocation.on('change', function () {
  el('accuracy').innerText = geolocation.getAccuracy() + ' [m]';
  el('altitude').innerText = geolocation.getAltitude() + ' [m]';
  el('altitudeAccuracy').innerText = geolocation.getAltitudeAccuracy() + ' [m]';
  el('heading').innerText = geolocation.getHeading() + ' [rad]';
  el('speed').innerText = geolocation.getSpeed() + ' [m/s]';
});

// handle geolocation error.
geolocation.on('error', function (error) {
  var info = document.getElementById('info');
  info.innerHTML = error.message;
  info.style.display = '';
});

var accuracyFeature = new Feature();
geolocation.on('change:accuracyGeometry', function () {
  accuracyFeature.setGeometry(geolocation.getAccuracyGeometry());
});

var positionFeature = new Feature();
positionFeature.setStyle(
  new Style({
    image: new CircleStyle({
      radius: 6,
      fill: new Fill({
        color: '#3399CC',
      }),
      stroke: new Stroke({
        color: '#fff',
        width: 2,
      }),
    }),
  })
);

geolocation.on('change:position', function () {
  var coordinates = geolocation.getPosition();
  positionFeature.setGeometry(coordinates ? new Point(coordinates) : null);
});

new VectorLayer({
  map: map,
  source: new VectorSource({
    features: [accuracyFeature, positionFeature],
  }),
});

    </script>
  
  <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js"></script>
  <?php include "footer.php"; ?>
      </section>
      
  </body>
  
</html>


