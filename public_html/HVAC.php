<?php
    $SessionResult = session_start();
    include 'Functions.inc';
    require 'SessionCheck.inc';
?>

<html>
    <head>
        <title>HVAC Settings</title>
    </head>
    <body>
        <h1 style='text-align:center;'>HVAC Settings</h1>
        <br />
        <p><a href="Logout_hdlr.php">Logout</a></p>
        <p><a href="Dash_hdlr.php">Dashboard</a></p>
        <p>Current user: <?php echo $_SESSION['Firstname'] . ' ' . $_SESSION['Lastname'];?></p>
        <br />
        <br />
        <p>Regions:</p>
        <?php if( isset ( $_SESSION['HVACData'] ) ) { echo $_SESSION['HVACData']; } ?>
        <br />
        <p><strong>Update:</strong></p>
        <form action="HVAC_hdlr.php" method="POST">
            HVACID: <input name="HVACID" type="text" required/>
            <br />
            Energy Source: <input name="energy_source" type="text" required/>
            <br />
            <input name="update" type="submit" value="Update" />
            <br />
        </form>
        <br />
        <p><strong>Insert:</strong></p>
        <form action="HVAC_hdlr.php" method="POST">
            HVACID: <input name="HVACID" type="text" required/>
            <br />
            Energy Source: <input name="energy_source" type="text" required/>
            <br />
            <input name="insert" type="submit" value="Update" />
            <br />
        </form>
        <br />
        <p><strong>Delete:</strong></p>
        <form action="HVAC_hdlr.php" method="POST">
            Energy Source: <input name="energy_source" type="text" required/>
            <br />
            <input name="delete" type="submit" value="Update" />
            <br />
        </form>
    </body>
</html>