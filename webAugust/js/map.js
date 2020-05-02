// ====== Initialize Map ======
var map = L.map('map',{drawControl: true}).setView([40.6401, 22.9444], 13);

// load a tile layer
L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    maxZoom: 18,
}).addTo(map);

//scale
L.control.scale().addTo(map);

//load polygons and colour them gray
var tempMap=$.getJSON('MAPdata.json', function (data) {
    // Define the geojson layer and add it to the map
    L.geoJson(data, {
        style: function () {
            var fillColor = "#636363";
            return { color: "#636363", weight: 1, fillColor: fillColor, fillOpacity: .9 };
        },
        
    }).addTo(map);
});











