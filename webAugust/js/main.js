var geojson;
var lastClickedPolygonID;
var lati;
var longi;
var marker;




// AJax-ing Functions

function deleteRecords() {
    if (confirm("Είστε σίγουρος για την διαγραφή?"))
        $.ajax({
            type: "GET",
            url: "deleteDb.php?delete=1",
            data: {},
            success: alert('Τα στοιχεία διαγράφτηκαν με επιτυχία!'),
        });
}

function getDefaultKML() {
    $.ajax({
        type: "GET",
        url: "kmlparser.php",
        data: {},
        success: alert('Επιτυχής Ανάλυση του KML!'),
    });

}

function simulationStart() {
    $("#simulate").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: "simulation.php",
            data: form.serialize(),
            success: alert('Η εξομοίωση ξεκίνησε επιτυχώς! Τα αποτελέσματα θα εμφανιστούν στο χάρτη!'),
        })
    });

}





// Polygon Colouring Default
function style(Feature) {
    return {
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7,
        fillColor: getColor(Feature.properties.finalDemand)
    };
}

//Xrwmatismos Polygwnwn Me bash to finalDemand
function getColor(d) {
    return d <= 59 ? '#31a354' :
        d >= 60 & d <= 84 ? '#FED976' :
            d >= 85 ? '#E31A1C' :
                'rgba(56,48,31,0.47)';
}

//highlighted visually hovering mouse
function highlightFeature(e) {
    var layer = e.target;
    layer.setStyle({
        weight: 5,
        color: '#666',
        dashArray: '',
        fillOpacity: 0.7
    });
    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
        layer.bringToFront();
    }
    info.update(layer.feature.properties);
}

//reset highlight
function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
}

map.on('popupopen', function (e) {
    $('#form-polygon-id').val(lastClickedPolygonID);
});

//zoom Sto Polygono
function zoomToFeature(e) {
    lastClickedPolygonID = e.target.feature.properties.polygon_id;

    map.fitBounds(e.target.getBounds());
}



function putMarker(e) {
    lastClickedPolygonID = e.target.feature.properties.polygon_id;

    lati = e.target.feature.properties.centroid_lat;
    longi = e.target.feature.properties.centroid_lng;

    var newMarker = new L.marker(e.latlng).addTo(geojson);

}



function onEachFeature(feature, layer) {
    layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: zoomToFeature,
        dblclick: putMarker
    });
}


//Infographic Kathe Polygonou
var info = L.control();

info.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info');
    this.update();
    return this._div;
};

info.update = function (props) {
    this._div.innerHTML = '<h4>Χάρτης Θεσσαλονίκης</h4>' + (props ?
        '<b>' + props.polygon_id + '</b><br />' + props.population + ' people / mi<sup>2</sup>' + '</b><br />' + 'Διαθέσιμες Θέσεις:' + props.freeSpots
        : 'Επέλεξε ενα πολύγωνο');
};

info.addTo(map);

//Admin
var htmlform = `
    <h2>Φόρμα Εισαγωγής δεδομένων</h2>
<form  action="/loadParkingData.php" method="post">
    Εισαγωγή θέσεων στάθμευσης:<br>
<input type="text" name="Parkings" value="">
    <br>
    Καμπύλες Ζήτησης:<br>
<input type="text" name="Graphs" value="">
    <br><br>
    <input type="Submit" value="Submit">
    <input id="form-polygon-id" type="hidden" name="PolygonID">
    <input type="reset">
    </form>
 
`;

// <h2>Αναζήτηση προτάσεων περιοχής στάθμευσης</h2>
//guest
var htmlformGuest = `
   
    <h2>Ψάξε για διαθέσιμη στάθμευση</h2>
    <form id="parkform" action="/findPark.php" method="post" >
       
        Γράψε το id του πολυγώνου:<br>
    <input type="number" name="id_P" value="">
        <br>
        Μέγιστη Περίμετρος:<br>
        
    <input type="number" name="Radius" min="50" max="500" value="" placeholder="100">
        <br><b>
        <input type="Submit" value="Submit">
        <input id="form-polygon-id" type="hidden" name="PolygonID">
        <input type="reset">
        </form>
`;





function showPolygons() {
    $.ajax({
        dataType: "json",
        url: "jasonDatabase.php",

        success: function (data) {
            geojson = L.geoJson(data, {
                style: style,
                onEachFeature: onEachFeature

            });
            geojson.addTo(map)
            geojson.bindPopup(htmlform);
        }
    });
}

function showPolygonsGuest() {
    $.ajax({
        dataType: "json",
        url: "jasonDatabase.php",

        success: function (data) {
            geojson = L.geoJson(data, {
                style: style,
                onEachFeature: onEachFeature

            });
            geojson.addTo(map)
            geojson.bindPopup(htmlformGuest);



        }
    });
}

function showPolygonsFound() {
    $.ajax({
        dataType: "json",
        url: "jasonDatabase.php",

        success: function (data) {
            geojson = L.geoJson(data, {
                style: stylePolygonFound,
                onEachFeature: onEachFeature

            });
            geojson.addTo(map)
            //geojson.bindPopup(htmlformGuest);



        }
    });
}

function stylePolygonFound(Feature) {
    return {
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7,
        fillColor: getColorPolygonFound(Feature.properties.polygonFound)
    };
}

function getColorPolygonFound(d) {
    return d == 3 ? '#31a354' :
        d ==2 ? '#FED976' :
            d ==1 ? '#E31A1C' :

                'rgba(0,0,0,0.89)';
}