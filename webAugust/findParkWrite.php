<?php
include 'connection.php';
//PDO is a extension which  defines a lightweight, consistent interface for accessing databases in PHP.
$polygons=$conn->query('select * from Polygon');

$json_data=array(); //create the array
while ($polyg = $polygons->fetch_assoc()) {
    $json_array['type'] = "Feature";

    $json_array['properties'] = array();
    $json_array['properties']['population'] = $polyg['population'];
    $json_array['properties']['centroid_lat']=$polyg['centroid_lat'];
    $json_array['properties']['centroid_lng']=$polyg['centroid_lng'];
    $json_array['properties']['polygon_id']=$polyg['polygon_id'];
    //$json_array['properties']['finalDemand']=$polyg['finalDemand'];
    //$json_array['properties']['demandCurve']=$polyg['demandCurve'];
    $json_array['properties']['polygonFound']=$polyg['polygonFound'];


    $polygon_id = $polyg['polygon_id'];
    $coordinates = $conn->query("SELECT * FROM Coordinate WHERE polygon=$polygon_id");

    $json_array['geometry'] = array();
    $json_array['geometry']["type"] = "Polygon";
    $json_array['geometry']['coordinates'] = array();
    $json_array['geometry']['coordinates'][] = array();
    while ($coo = $coordinates->fetch_assoc()) {
        $a = array();
        $a[] = $coo['Latitude'];
        $a[] = $coo['Longitude'];
        array_push($json_array['geometry']['coordinates'][0], $a);
//        $json_array['coordinates'] = $coo['Latitude'];
//        $json_array['coordinates']['longitude'] = $coo['Longitude'];
    }


//here pushing the values in to an array
    array_push($json_data,$json_array);

}

//built in PHP function to encode the data in to JSON format
//echo json_encode($json_data);
$fp = fopen('MAPdata.json', 'w');
fwrite($fp, json_encode($json_data));
fclose($fp);
echo json_encode($json_data);



