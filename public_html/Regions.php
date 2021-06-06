<?php
    $SessionResult = session_start();
    include 'Functions.inc';
    require 'SessionCheck.inc';
?>

<html>
    <head>
        <title>Regional Settings</title>
    </head>
    <body>
        <h1 style='text-align:center;'>Regional Settings</h1>
        <br />
        <p><a href="Logout_hdlr.php">Logout</a></p>
        <p><a href="Dash_hdlr.php">Dashboard</a></p>
        <p>Current user: <?php echo $_SESSION['Firstname'] . ' ' . $_SESSION['Lastname'];?></p>
        <br />
        <br />
        <p>Regions:</p>
        <?php if( isset ( $_SESSION['RegionsData'] ) ) { echo $_SESSION['RegionsData']; } ?>
        <br />
        <p><strong>Update:</strong></p>
        <form action="Regions_hdlr.php" method="POST">
            Climate Zone: <input name="climate_zone" type="text" required/>
            <br />
            Land Carbon Value: <input name="land_carbon_val" type="text" required/>
            <br />
            <input name="update" type="submit" value="Update" />
            <br />
        </form>
        <br />
        <p><strong>Insert:</strong></p>
        <form action="Regions_hdlr.php" method="POST">
            Climate Zone: <input name="climate_zone" type="text" required />
            <br />
            Land Carbon Value: <input name="land_carbon_val" type="text" required />
            <br />
            <input name="insert" type="submit" value="Update" />
            <br />
        </form>
        <br />
        <p><strong>Delete:</strong></p>
        <form action="Regions_hdlr.php" method="POST">
            Climate Zone: <input name="climate_zone" type="text" required/>
            <br />
            <input name="delete" type="submit" value="Update" />
            <br />
        </form>
    </body>
</html>