<?php
    $SessionResult = session_start();
    include 'Functions.inc';
    include 'Declarations.inc';
    require 'SessionCheck.inc'; // check for valid session
                        
    header( 'Location: Dash.php' );
?>