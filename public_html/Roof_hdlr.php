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
        $roofType = $_POST['roof_type'];
        $rValue = $_POST['Rvalue'];
        $absorptionValue = $_POST['absorption_value'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'UPDATE Roof SET Rvalue=:Rvalue,absorption_value=:absorption_value WHERE roof_type=:roof_type;';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':roof_type', $roofType, PDO::PARAM_STR);
            $stmt->bindParam(':Rvalue', $rValue, PDO::PARAM_STR);
            $stmt->bindParam(':absorption_value', $absorptionValue, PDO::PARAM_STR);
            // do insert
            $stmt->execute();
            $conn = null;
        } catch(PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    }

    if( isset( $_POST['insert'] ) ) {
        $roofType = $_POST['roof_type'];
        $rValue = $_POST['Rvalue'];
        $absorptionValue = $_POST['absorption_value'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'INSERT INTO Roof(roof_type, Rvalue, absorption_value) VALUES (:roof_type, :Rvalue, :absorption_value);';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':roof_type', $roofType, PDO::PARAM_STR);
            $stmt->bindParam(':Rvalue', $rValue, PDO::PARAM_STR);
            $stmt->bindParam(':absorption_value', $absorptionValue, PDO::PARAM_STR);
            // do insert
            $stmt->execute();
            $conn = null;
        } catch(PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    }

    if( isset( $_POST['delete'] ) ) {
        $roofType = $_POST['roof_type'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'DELETE FROM Roof WHERE roof_type=:roof_type;';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':roof_type', $roofType, PDO::PARAM_STR);
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
        $stmt = $conn->query("SELECT * FROM Roof");
        //returns each row in result as an array indexed by column name
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        die("Could not connect to the database $dbname :" . $e->getMessage());
    }

    $stringBuilder = '<table border=1><tr><th>Roof Type</th><th>R-Value</th><th>Absorption Value</th></tr>';

    while ($row = $stmt->fetch()) {
        $stringBuilder .= "<tr><td>";
        $stringBuilder .= $row['roof_type'];
        $stringBuilder .= "</td><td>";
        $stringBuilder .= $row['Rvalue'];
        $stringBuilder .= "</td><td>";
        $stringBuilder .= $row['absorption_value'];
        $stringBuilder .= "</td></tr>";
    }

    $stringBuilder .= "</table>";

    $_SESSION['RoofData'] = $stringBuilder;
    $conn = null;

    header( 'Location: Roof.php' );
?>