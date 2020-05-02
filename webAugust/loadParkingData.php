<?php
include 'connection.php';
//απο την σελίδα του διαχειριστη
//τα δεδομενα απο την φορμα ερχονατι εδώ οπου και εισαγονται στην βαση
$parkNumber=$_POST["Parkings"];
$demandGraphs=$_POST["Graphs"];
$id=$_POST['PolygonID'];
//echo "You wanted to update Polygon with ID=$id, with parkingNumber=$parkNumber";
//die;
$sqlParkNumber = "UPDATE  Polygon SET available_parkings=$parkNumber WHERE polygon_id=$id";
$sqlDemand = "UPDATE  Polygon SET demandCurve=$demandGraphs WHERE polygon_id=$id";

if ($conn->query($sqlParkNumber) === TRUE) {

    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

if ($conn->query($sqlDemand) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
echo "<script>window.location = 'adminlogin.php'</script>";
?>


