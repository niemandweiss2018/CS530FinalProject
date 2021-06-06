<?php
    $SessionResult = session_start();
    include 'Functions.inc';
    include 'Declerations.inc';
    require 'SessionCheck.inc'; // check for valid session

    $host = "pluto.hood.edu";
    $dbname = "team7db";
    $user = "team7";
    $pass = "password";
    
    if( isset( $_POST['update'] ) ) {
        $climateZone = $_POST['climate_zone'];
        $landCarbonValue = $_POST['land_carbon_val'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'UPDATE Region SET land_carbon_val=:land_carbon_val WHERE climate_zone=:climate_zone;';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':climate_zone', $climateZone, PDO::PARAM_STR);
            $stmt->bindParam(':land_carbon_val', $landCarbonValue, PDO::PARAM_STR);
            // do insert
            $stmt->execute();
            $conn = null;
        } catch(PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    }

    if( isset( $_POST['insert'] ) ) {
        $climateZone = $_POST['climate_zone'];
        $landCarbonValue = $_POST['land_carbon_val'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'INSERT INTO Region(climate_zone, land_carbon_val) VALUES (:climate_zone, :land_carbon_val);';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':climate_zone', $climateZone, PDO::PARAM_STR);
            $stmt->bindParam(':land_carbon_val', $landCarbonValue, PDO::PARAM_STR);
            // do insert
            $stmt->execute();
            $conn = null;
        } catch(PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    }

    if( isset( $_POST['delete'] ) ) {
        $climateZone = $_POST['climate_zone'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'DELETE FROM Region WHERE climate_zone=:climate_zone;';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':climate_zone', $climateZone, PDO::PARAM_STR);
            // do insert
            $stmt->execute();
        } catch(PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    }

    try {
        // create the connection
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        // execute the query
        $stmt = $conn->query("SELECT * FROM Region");
        //returns each row in result as an array indexed by column name
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        die("Could not connect to the database $dbname :" . $e->getMessage());
    }

    $stringBuilder = '<table border=1><tr><th>Climate Zone</th><th>Land Carbon Value</th></tr>';

    while ($row = $stmt->fetch()) {
        $stringBuilder .= "<tr><td>";
        $stringBuilder .= $row['climate_zone'];
        $stringBuilder .= "</td><td>";
        $stringBuilder .= $row['land_carbon_val'];
        $stringBuilder .= "</td></tr>";
    }

    $stringBuilder .= "</table>";

    $_SESSION['RegionsData'] = $stringBuilder;
    $conn = null;

    header( 'Location: Regions.php' );
?>