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
        $HVACID = $_POST['HVACID'];
        $energySource = $_POST['energy_source'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'UPDATE HVAC SET energy_source=:energy_source WHERE HVACID=:HVACID;';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':HVACID', $HVACID, PDO::PARAM_STR);
            $stmt->bindParam(':energy_source', $energySource, PDO::PARAM_STR);
            // do insert
            $stmt->execute();
            $conn = null;
        } catch(PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    }

    if( isset( $_POST['insert'] ) ) {
        $HVACID = $_POST['HVACID'];
        $energySource = $_POST['energy_source'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'INSERT INTO HVAC(HVACID, energy_source) VALUES (:HVACID, :energy_source);';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':HVACID', $HVACID, PDO::PARAM_STR);
            $stmt->bindParam(':energy_source', $energySource, PDO::PARAM_STR);
            // do insert
            $stmt->execute();
            $conn = null;
        } catch(PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    }

    if( isset( $_POST['delete'] ) ) {
        $HVACID = $_POST['HVACID'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'DELETE FROM HVAC WHERE HVACID=:HVACID;';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':HVACID', $HVACID, PDO::PARAM_STR);
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
        $stmt = $conn->query("SELECT * FROM HVAC");
        //returns each row in result as an array indexed by column name
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        die("Could not connect to the database $dbname :" . $e->getMessage());
    }

    $stringBuilder = '<table border=1><tr><th>HVACID</th><th>Energy Source</th></tr>';

    while ($row = $stmt->fetch()) {
        $stringBuilder .= "<tr><td>";
        $stringBuilder .= $row['HVACID'];
        $stringBuilder .= "</td><td>";
        $stringBuilder .= $row['energy_source'];
        $stringBuilder .= "</td></tr>";
    }

    $stringBuilder .= "</table>";

    $_SESSION['HVACData'] = $stringBuilder;
    $conn = null;

    header( 'Location: HVAC.php' );
?>