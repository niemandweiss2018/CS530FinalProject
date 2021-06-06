<?php
    $SessionResult = session_start();
    include 'Functions.inc';
    require 'SessionCheck.inc';
?>

<html>
    <head>
        <title>Dashboard</title>
    </head>
    <body>
        <h1 style='text-align:center;'>User Dashboard</h1>
        <br />
        <p><a href="Logout_hdlr.php">Logout</a></p>
        <p>Current user: <?php echo $_SESSION['Firstname'] . ' ' . $_SESSION['Lastname'];?></p>
        <br />
        <ul>
            <li><a href="Windows_hdlr.php">Windows Settings</a></li>
            <li><a href="Insulation_hdlr.php">Insulation Settings</a></li>
            <li><a href="HVAC_hdlr.php">HVAC Settings</a></li>
            <li><a href="Materials_hdlr.php">Materials Setting</a></li>
            <li><a href="Regions_hdlr.php">Regional Settings</a></li>
            <li><a href="Roof_hdlr.php">Roof Settings</a></li>
        </ul>
    </body>
</html>