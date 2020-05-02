<?php
include 'connection.php';
include 'Functions.php';
//erxetai apo forma bindPopUp
// $simulationTime=$_POST["Time"];

$varTime = date('H');
var_dump($varTime);
$simulationTimeForm=$_POST['time'];

//εαν  ο χρηστης δεν επιλεξει τοτε επιλεγει την τρεχουσα ωρα
if (is_null($simulationTimeForm)){
    $simulationTimeForm=$varTime;
}
// var_dump($simulationTimeForm);
$sql="SELECT population,polygon_id FROM Polygon";
$result=mysqli_query($conn,$sql);
//$population_data=array(); //create the array of population



if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        //ipologismos tis statheras zitisis
        $constantParkingsAvailable=parkings_available();
        $tempPercentage=$row[population];
        $tempPercentage=round(0.20*($tempPercentage));
        $tempTableCurve=[];
        $tempTableCurve=generate_random_demand_curve();
        $randomKampiliZitisi=$tempTableCurve[$simulationTimeForm];
        //echo json_encode($randomKampiliZitisi);


    //var_dump($row);
$sql2 = "UPDATE Polygon SET constantDemand='{$tempPercentage}',available_parkings=$constantParkingsAvailable,demandCurve=$randomKampiliZitisi  WHERE polygon_id='{$row[polygon_id]}';";
        $result2 = mysqli_query($conn, $sql2);
        $posostoKatileimenwn=(($constantParkingsAvailable-$tempPercentage)*$randomKampiliZitisi)/100;
        //ελευθερες θεσεις
        $freeSpots=($constantParkingsAvailable-$tempPercentage);
        $freeSpots=$freeSpots-($freeSpots*$randomKampiliZitisi);

        if ($constantParkingsAvailable>$tempPercentage) {
            $sql3 = "UPDATE Polygon Set finalDemand='{$posostoKatileimenwn}',freeSpots=$freeSpots  WHERE polygon_id='{$row[polygon_id]}';";
            $result3 = mysqli_query($conn, $sql3);
        }
        else{
            $sql3 = "UPDATE Polygon Set finalDemand=100,freeSpots=0  WHERE polygon_id='{$row[polygon_id]}';";
            $result3 = mysqli_query($conn, $sql3);

        }

        // if ($result2 === TRUE) {
        //     echo "New record created successfully";
        // } else {
        //     echo "Error: " . $result2 . "<br>" . $conn->error;
        // }
    }



} //if ending
else {
    echo "0 results";
}
//require_once('simulationWrite.php');




$conn->close();
?>


