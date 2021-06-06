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
        $insulationType = $_POST['insulation_type'];
        $rValue = $_POST['Rvalue'];
        $organicComposition = $_POST['organic_composition'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'UPDATE Insulation SET Rvalue=:Rvalue,organic_composition=:organic_composition WHERE insulation_type=:insulation_type;';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':insulation_type', $insulationType, PDO::PARAM_STR);
            $stmt->bindParam(':Rvalue', $rValue, PDO::PARAM_STR);
            $stmt->bindParam(':organic_composition', $organicComposition, PDO::PARAM_STR);
            // do insert
            $stmt->execute();
            $conn = null;
        } catch(PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    }

    if( isset( $_POST['insert'] ) ) {
        $insulationType = $_POST['insulation_type'];
        $rValue = $_POST['Rvalue'];
        $organicComposition = $_POST['organic_composition'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'INSERT INTO Insulation(insulation_type, Rvalue, organic_composition) VALUES (:insulation_type, :Rvalue, :organic_composition);';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':insulation_type', $insulationType, PDO::PARAM_STR);
            $stmt->bindParam(':Rvalue', $rValue, PDO::PARAM_STR);
            $stmt->bindParam(':organic_composition', $organicComposition, PDO::PARAM_STR);
            // do insert
            $stmt->execute();
            $conn = null;
        } catch(PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    }

    if( isset( $_POST['delete'] ) ) {
        $insulationType = $_POST['insulation_type'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'DELETE FROM Insulation WHERE insulation_type=:insulation_type;';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':insulation_type', $insulationType, PDO::PARAM_STR);
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
        $stmt = $conn->query("SELECT * FROM Insulation");
        //returns each row in result as an array indexed by column name
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        die("Could not connect to the database $dbname :" . $e->getMessage());
    }

    $stringBuilder = '<table border=1><tr><th>Insulation Type</th><th>R-Value</th><th>Organic Composition</th></tr>';

    while ($row = $stmt->fetch()) {
        $stringBuilder .= "<tr><td>";
        $stringBuilder .= $row['insulation_type'];
        $stringBuilder .= "</td><td>";
        $stringBuilder .= $row['Rvalue'];
        $stringBuilder .= "</td><td>";
        $stringBuilder .= $row['organic_composition'];
        $stringBuilder .= "</td></tr>";
    }

    $stringBuilder .= "</table>";

    $_SESSION['InsulationData'] = $stringBuilder;
    $conn = null;

    header( 'Location: Insulation.php' );
?>