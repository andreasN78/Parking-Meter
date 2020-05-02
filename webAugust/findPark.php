 <?php

include 'connection.php';
include 'PolyCenter.php';
include 'Functions.php';


 $thePolygonId=$_POST['id_P'];

 //ID POLYGON!!
 //var_dump($thePolygonId);

 // RADIUS!!
 $aRadius=$_POST['Radius'];


//var_dump($aRadius);

//$thePolygonId=75648;
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Για το πολυγωνο που ψαχνω παιρνει τα στοιχεια του
$sql="SELECT population,polygon_id,centroid_lat,centroid_lng FROM Polygon WHERE polygon_id='$thePolygonId' LIMIT 1";
$result=mysqli_query($conn,$sql);
$idData=mysqli_fetch_all($result)[0];

$centreLat=($idData[2]);
$centreLng=$idData[3];

//var_dump($centreLat);
//var_dump($idData[3]);
 //$conn->close();
    //var_dump($idData);
$servername = "localhost";
$usernameDb = "root2";
$passwordDb = "1234";
$db = 'parking2';


//τα στοιχεια του πολυγωνου τα δινω σε μια συναρτηση
 //η οποια επιστρεφει τα γειτονικα του πολυγωνα με όλα τους τα στοιχεια
$dataPdo=connect_db_PDO($servername,$db,$usernameDb,$passwordDb);
$result2=find_polygons_in_radius($dataPdo,$centreLat,$centreLng,$aRadius);
$dataPdo=null;
//ειναι ενα array απο arrays meta apotelesmata apo ta poligwna pou epistrefei i sinartisi
//var_dump($result2);
 $arrlength = sizeof($result2);


// στο query μου  επιλεγω ολα τα id πολυγωνων
     //$sql1 = "SELECT  polygon_id FROM Polygon";
     $sqlUpdate=mysqli_query($conn, "UPDATE Polygon SET polygonFound=NULL WHERE polygonFound IS NOT NULL");
     $resultPolygonId = mysqli_query($conn, $sql1);
//καταλληλες ενεργειες για να χρωματισουμε τα πολυγωνα που επιστρεφει
 //χρησιμοποιουμε χρωματισμο για αναπαρασταση
 foreach($result2 as $p){
     if($p['finalDemand']>=85) {
         mysqli_query($conn, "UPDATE Polygon SET polygonFound=1 WHERE polygon_id={$p['polygon_id']}");
     }
     if(($p['finalDemand']>=60)&&($p['finalDemand']<=84)) {
         mysqli_query($conn, "UPDATE Polygon SET polygonFound=2 WHERE polygon_id={$p['polygon_id']}");
     }
     if($p['finalDemand']<=59) {
         mysqli_query($conn, "UPDATE Polygon SET polygonFound=3 WHERE polygon_id={$p['polygon_id']}");
     }

}

//γραφω στο αρχειο json
 require_once('findParkWrite.php');




 mysqli_close($conn);

//κανω redirect
 echo "<script>window.location = 'guest2.php'</script>";


?>





