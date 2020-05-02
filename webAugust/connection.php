<?php

$servername = "localhost";
$usernameDb = "root2";
$passwordDb = "1234";
$db = 'parking2';

// Create connection
$conn = new mysqli($servername, $usernameDb, $passwordDb, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//SELECT polygon_id, population, Latitude, Longitude  FROM Polygon INNER JOIN Coordinate ON Polygon.polygon_id = Coordinate.polygon Limit 50;
