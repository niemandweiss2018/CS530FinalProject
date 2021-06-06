<?php
    include 'Declerations.inc';
    
    function SetDateTimeZone() {
        date_default_timezone_set("America/New_York"); // Set default timezone
    }

    function GetUserInfoFromLogIn( $Username, $Password ) {
        $DBUsername = 'team7';
        $DBPassword = 'password';
        $DBHost = 'pluto.hood.edu';
        $DatabaseName = 'team7db';
        $mysqli = new mysqli();
        $mysqli->connect($DBHost, $DBUsername, $DBPassword, $DatabaseName);
        $query = 'SELECT * FROM Userinfo WHERE username = "' . $Username . '" AND password = "' . $Password . '";';
        $result = $mysqli->query($query, MYSQLI_STORE_RESULT);
        if(!$result) {
            echo("Error description: " . $mysqli -> error);
        }
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $mysqli->close();
        if(mysqli_num_rows($result) > 0) {
            UpdateLastLogin( $row['userID'] );
            return $row;
        } else { return 0; }
    }

    function UpdateLastLogIn( $UserID ) {
        $DBUsername = 'team7';
        $DBPassword = 'password';
        $DBHost = 'pluto.hood.edu';
        $DatabaseName = 'team7db';
        $mysqli = new mysqli();
        $mysqli->connect($DBHost, $DBUsername, $DBPassword, $DatabaseName);
        $query = 'UPDATE Userinfo SET last_login=DEFAULT WHERE userID=' . $UserID;
        $result = $mysqli->query($query, MYSQLI_STORE_RESULT);

        // TODO: check for errors

        $mysqli->close();
    }

    function ClearActiveSession( $UserID ) {
        $DBUsername = 'team7';
        $DBPassword = 'password';
        $DBHost = 'pluto.hood.edu';
        $DatabaseName = 'team7db';
        $mysqli = new mysqli();
        $mysqli->connect($DBHost, $DBUsername, $DBPassword, $DatabaseName);
        $query = 'DELETE FROM activesessions WHERE userID=' . $UserID;
        $result = $mysqli->query($query, MYSQLI_STORE_RESULT);

        // TODO: check for errors

        $mysqli->close();
    }

    function CreateActiveSession( $UserID, $Time ) {
        $DBUsername = 'team7';
        $DBPassword = 'password';
        $DBHost = 'pluto.hood.edu';
        $DatabaseName = 'team7db';
        $mysqli = new mysqli();
        $mysqli->connect($DBHost, $DBUsername, $DBPassword, $DatabaseName);
        $query = 'INSERT INTO activesessions (userID, last_active) VALUES (' . $UserID . ', ' . $Time . ')';
        $result = $mysqli->query($query, MYSQLI_STORE_RESULT);
        if(!$result) {
            die("Error description: " . $mysqli -> error);
        }

        // TODO: check for errors

        $query = 'SELECT * FROM activesessions WHERE userID = "' . $UserID . '" AND last_active = "' . $Time . '"';
        $result = $mysqli->query($query, MYSQLI_STORE_RESULT);
        if(!$result) {
            die("Error description: " . $mysqli -> error);
        }
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $mysqli->close();
        if(mysqli_num_rows($result) > 0) {
            return $row['sessionID'];
        } else { return 0; }
    }

    function CloseActiveSession( $SessionID ) {
        $DBUsername = 'team7';
        $DBPassword = 'password';
        $DBHost = 'pluto.hood.edu';
        $DatabaseName = 'team7db';
        $mysqli = new mysqli();
        $mysqli->connect($DBHost, $DBUsername, $DBPassword, $DatabaseName);
        $query = 'DELETE FROM activesessions WHERE sessionID=' . $SessionID;
        $result = $mysqli->query($query, MYSQLI_STORE_RESULT);

        // TODO: Check for errors

        $mysqli->close();
        return 1;
    }

    function CheckActiveSessionStatus( $SessionID, $NewTime ) {
        $DBUsername = 'team7';
        $DBPassword = 'password';
        $DBHost = 'pluto.hood.edu';
        $DatabaseName = 'team7db';
        $mysqli = new mysqli();
        $mysqli->connect($DBHost, $DBUsername, $DBPassword, $DatabaseName);
        $query = 'SELECT * FROM activesessions WHERE sessionID=' . $SessionID;
        $result = $mysqli->query($query, MYSQLI_STORE_RESULT);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $mysqli->close();
        $Test = $NewTime - $row['last_active'];
        if($Test < TIMEOUT) {
            UpdateActiveSessionStatus( $SessionID, $NewTime );
            return 1;
        } else { return 0; }
    }

    function UpdateActiveSessionStatus( $SessionID, $NewTime ) {
        $DBUsername = 'team7';
        $DBPassword = 'password';
        $DBHost = 'pluto.hood.edu';
        $DatabaseName = 'team7db';
        $mysqli = new mysqli();
        $mysqli->connect($DBHost, $DBUsername, $DBPassword, $DatabaseName);
        $query = 'UPDATE activesessions SET last_active=' . $NewTime . ' WHERE sessionID=' . $SessionID;
        $result = $mysqli->query($query, MYSQLI_STORE_RESULT);

        // TODO: Check for errors

        $mysqli->close();
    }
?>