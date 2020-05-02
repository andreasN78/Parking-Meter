<?php

    if(isset($_GET['delete'])){

    include 'connection.php';
    
    $sql1 = "DELETE FROM Coordinate;";
    $sql2 = "DELETE FROM Polygon;";


    $result = mysqli_query($conn,$sql1);
    $result = mysqli_query($conn,$sql2);


    $conn->close();
}
?>

