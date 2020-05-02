<?php

include 'connection.php';
include 'PolyCenter.php';


// enable error reporting - helpful when working on this script
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo 'Begin Script <br/><hr/>';


$polygonDataArray = array();

//echo $_FILES["upFile"]["name"];

// CHECK IF UPLOADED FILE IS KML

if (isset($_FILES["upFile"])) {
    $kml = simplexml_load_file($_FILES["upFile"]['tmp_name']);
} else {
    $kml = simplexml_load_file('data.kml');
}
//print_r($kml->Document); // debug the whole document data

$populations = array();
$i = 0;
/* You MUST update this selector to math your KML document tree */
// FOR EVERY POLYGON
foreach ($kml->Document->Folder->Placemark as $pm) {
    $description = $pm->description;
    $description = html_entity_decode($description); //decode the html

    $dom = new domDocument('1.0', 'utf-8');
    $dom->loadHTML($description); //load the html inside <description>
    $span = $dom->getElementsByTagName('span'); //get the list of span elements
    $spanPopulation = $span->item(count($span) - 1); //get the last span
    $spanPopulation->nodeValue;

    array_push($populations, $spanPopulation->nodeValue);
    $sql2 = "INSERT INTO Polygon(population)VALUES ('" . $populations[$i] . "')";
    $result2 = mysqli_query($conn, $sql2);
    $polygonID = mysqli_insert_id($conn);
    $pm = $pm->MultiGeometry;


    if (isset($pm->Polygon)) {
        // Process polygon datas

        // Get coordinates for 'outerBoundaryIs', other possible data not considered is 'innerBoundaryIs'
        $coordinates = $pm->Polygon->outerBoundaryIs->LinearRing->coordinates;
        $cordsData = trim(((string) $coordinates));


        // check if coordinate data is available
        if (isset($cordsData) && !empty($cordsData)) {

            $explodedData = explode(" ", $cordsData);
            $explodedData = array_map('trim', $explodedData);

            // next for each of the points build the polygon data
            // FOR EVERY COORDINATE SET
            $ring = array();
            foreach ($explodedData as $index => $coordinateString) {
                $coordinateSet = array_map('trim', explode(',', $coordinateString));
                if (count($coordinateSet) >= 3) {
                    // lon,lat[,alt] | Index 0 = lon, index 1 = lat, index 2 = alt [optional]
                    $sql = "INSERT INTO Coordinates(

,Latitude,Altitude) VALUES ('" . $coordinateSet[0] . "','" . $coordinateSet[1] . "','" . $coordinateSet[2] . "')";
                    $result = mysqli_query($conn, $sql);
                } else if (count($coordinateSet) >= 2) {
                    array_push($ring, $coordinateSet);
                    //                    $sql = "INSERT INTO Coordinate(coordinate_id, polygon, Latitude, Longitude) VALUES ("null, '". "'," . ""'" . $coordinateSet[0] . "','" . $coordinateSet[1] . "')";
                    $sql = "INSERT INTO Coordinate(coordinate_id, polygon, Latitude, Longitude) VALUES (null, '$polygonID', '$coordinateSet[0]', $coordinateSet[1])";
                    $result = mysqli_query($conn, $sql);
                    echo mysqli_error($conn);
                } else {
                    echo '<br/>Unhandled case for data set : ' . print_r($coordinateSet, true);
                }
            }
        }
    } //else {
    //     echo '<br/>Not a polygon - skipping';
    // }

    $centroid = getCentroidOfPolygon($ring);
    $sql = "UPDATE Polygon SET centroid_lat='$centroid[0]', centroid_lng='$centroid[1]' WHERE polygon_id='$polygonID';";
    $result = mysqli_query($conn, $sql);
    $i++;
}

?>

<script type="text/javascript">
    window.location.href = "adminlogin.php";
</script>