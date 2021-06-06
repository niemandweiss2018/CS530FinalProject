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
        $materialType = $_POST['Material_type'];
        $rValue = $_POST['Rvalue'];
        $organicComposition = $_POST['organic_composition'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'UPDATE Materials SET Rvalue=:Rvalue,organic_composition=:organic_composition WHERE Material_type=:Material_type;';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':Material_type', $materialType, PDO::PARAM_STR);
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
        $materialType = $_POST['Material_type'];
        $rValue = $_POST['Rvalue'];
        $organicComposition = $_POST['organic_composition'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'INSERT INTO Materials(Material_type, Rvalue, organic_composition) VALUES (:Material_type, :Rvalue, :organic_composition);';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':Material_type', $materialType, PDO::PARAM_STR);
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
        $materialType = $_POST['Material_type'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'DELETE FROM Materials WHERE Material_type=:Material_type;';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':Material_type', $materialType, PDO::PARAM_STR);
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
        $stmt = $conn->query("SELECT * FROM Materials");
        //returns each row in result as an array indexed by column name
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        die("Could not connect to the database $dbname :" . $e->getMessage());
    }

    $stringBuilder = '<table border=1><tr><th>Material Type</th><th>R-Value</th><th>Organic Composition</th></tr>';

    while ($row = $stmt->fetch()) {
        $stringBuilder .= "<tr><td>";
        $stringBuilder .= $row['Material_type'];
        $stringBuilder .= "</td><td>";
        $stringBuilder .= $row['Rvalue'];
        $stringBuilder .= "</td><td>";
        $stringBuilder .= $row['organic_composition'];
        $stringBuilder .= "</td></tr>";
    }

    $stringBuilder .= "</table>";

    $_SESSION['MaterialsData'] = $stringBuilder;
    $conn = null;

    header( 'Location: Materials.php' );
?>