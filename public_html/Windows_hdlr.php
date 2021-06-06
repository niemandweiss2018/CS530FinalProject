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
        $windowType = $_POST['Window_type'];
        $uFactor = $_POST['Ufactor'];
        $SHG = $_POST['SHG'];
        $VT = $_POST['VT'];
        $rValue = $_POST['Rvalue'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'UPDATE Windows SET Ufactor=:Ufactor,SHG=:SHG,VT=:VT,Rvalue=:Rvalue WHERE Window_type=:Window_type;';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':Window_type', $windowType, PDO::PARAM_STR);
            $stmt->bindParam(':Ufactor', $uFactor, PDO::PARAM_STR);
            $stmt->bindParam(':SHG', $SHG, PDO::PARAM_STR);
            $stmt->bindParam(':VT', $VT, PDO::PARAM_STR);
            $stmt->bindParam(':Rvalue', $rValue, PDO::PARAM_STR);
            // do insert
            $stmt->execute();
            $conn = null;
        } catch(PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    }

    if( isset( $_POST['insert'] ) ) {
        $windowType = $_POST['Window_type'];
        $uFactor = $_POST['Ufactor'];
        $SHG = $_POST['SHG'];
        $VT = $_POST['VT'];
        $rValue = $_POST['Rvalue'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'INSERT INTO Windows(Window_type, Ufactor, SHG, VT, Rvalue) VALUES (:Window_type, :Ufactor, :SHG, :VT, :Rvalue);';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':Window_type', $windowType, PDO::PARAM_STR);
            $stmt->bindParam(':Ufactor', $uFactor, PDO::PARAM_STR);
            $stmt->bindParam(':SHG', $SHG, PDO::PARAM_STR);
            $stmt->bindParam(':VT', $VT, PDO::PARAM_STR);
            $stmt->bindParam(':Rvalue', $rValue, PDO::PARAM_STR);
            // do insert
            $stmt->execute();
            $conn = null;
        } catch(PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    }

    if( isset( $_POST['delete'] ) ) {
        $windowType = $_POST['Window_type'];
        try {
            // create the connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // build query
            $sql = 'DELETE FROM Windows WHERE Window_type=:Window_type;';
            $stmt = $conn->prepare($sql);
            // do bindings
            $stmt->bindParam(':Window_type', $windowType, PDO::PARAM_STR);
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
        $stmt = $conn->query("SELECT * FROM Windows");
        //returns each row in result as an array indexed by column name
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        die("Could not connect to the database $dbname :" . $e->getMessage());
    }

    $stringBuilder = '<table border=1><tr><th>Window Type</th><th>U-Factor</th><th>SHG</th><th>VT</th><th>R-Value</th></tr>';

    while ($row = $stmt->fetch()) {
        $stringBuilder .= "<tr><td>";
        $stringBuilder .= $row['Window_type'];
        $stringBuilder .= "</td><td>";
        $stringBuilder .= $row['Ufactor'];
        $stringBuilder .= "</td><td>";
        $stringBuilder .= $row['SHG'];
        $stringBuilder .= "</td><td>";
        $stringBuilder .= $row['VT'];
        $stringBuilder .= "</td><td>";
        $stringBuilder .= $row['Rvalue'];
        $stringBuilder .= "</td></tr>";
    }

    $stringBuilder .= "</table>";

    $_SESSION['WindowData'] = $stringBuilder;
    $conn = null;

    header( 'Location: Windows.php' );
?>