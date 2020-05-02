<?php

function login($username, $password, $conn)
{
    $sql = "SELECT * FROM `Administrator` WHERE AdminUserName='" . mysqli_real_escape_string($conn, $username) . "'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $row = $result->fetch_assoc();
       // echo "id: " . $row["id"] . " - Name: " . $row["AdminUserName"] . "<br> " . $row["AdminPassword"] . "<br>";

        if (password_verify($password, $row["AdminPassword"])) {
            return "Success";
        } else {
            return 'Invalid password.';

        }
    } else {
        return 'Invalid username.';
    }
}




//ipologismos tixaias kampilis zitisis

function generate_random_demand_curve()
{
    $demand_curve = [];
    for ($i = 0; $i < 24; ++$i) {
        $demand_curve[$i] = mt_rand(0, 100) / 100;
    }
    return $demand_curve;
}
//υπολογισμος θεσεων σταθμευσης για το καθε τετραγωνο

function parkings_available()
{
    $parkingsCalculation = mt_rand(100, 500) ;

    return $parkingsCalculation;
}


function connect_db_PDO($host, $db, $user, $pass, $charset='utf8mb4') {
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    return new PDO($dsn,$user,$pass,$options);
}

function find_polygons_in_radius(PDO $pdo, $lat, $lng, $radius)
{
    $stm = $pdo->prepare('SELECT *, '
        . '( 6371 * acos( cos( radians(?) ) * cos( radians( Polygon.centroid_lat ) ) '
        . '* cos( radians(Polygon.centroid_lng) - radians(?)) '
        . '+ sin(radians(?)) * sin( radians(Polygon.centroid_lat)))) '
        . 'AS distance '
        . 'FROM Polygon '
        . 'HAVING distance < ? '
        . 'ORDER BY distance;');
    $stm->execute([
        $lat,
        $lng,
        $lat,
        $radius / 1000,
    ]);

    $polygons = $stm->fetchAll();
    return $polygons;
}


