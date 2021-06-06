<?php
    $SessionResult = session_start();
    include 'Functions.inc';
    require 'SessionCheck.inc';
?>

<html>
    <head>
        <title>Windows Settings</title>
    </head>
    <body>
        <h1 style='text-align:center;'>Windows Settings</h1>
        <br />
        <p><a href="Logout_hdlr.php">Logout</a></p>
        <p><a href="Dash_hdlr.php">Dashboard</a></p>
        <p>Current user: <?php echo $_SESSION['Firstname'] . ' ' . $_SESSION['Lastname'];?></p>
        <br />
        <br />
        <p>Regions:</p>
        <?php if( isset ( $_SESSION['WindowData'] ) ) { echo $_SESSION['WindowData']; } ?>
        <br />
        <p><strong>Update:</strong></p>
        <form action="Windows_hdlr.php" method="POST">
            Window Type: <input name="Window_type" type="text" required/>
            <br />
            U-Factor: <input name="Ufactor" type="text" required/>
            <br />
            SHG: <input name="SHG" type="text" required/>
            <br />
            VT: <input name="VT" type="text" required/>
            <br />
            R-Value: <input name="Rvalue" type="text" required/>
            <br />
            <input name="update" type="submit" value="Update" />
            <br />
        </form>
        <br />
        <p><strong>Insert:</strong></p>
        <form action="Windows_hdlr.php" method="POST">
            Window Type: <input name="Window_type" type="text" required/>
            <br />
            U-Factor: <input name="Ufactor" type="text" required/>
            <br />
            SHG: <input name="SHG" type="text" required/>
            <br />
            VT: <input name="VT" type="text" required/>
            <br />
            R-Value: <input name="Rvalue" type="text" required/>
            <br />
            <input name="insert" type="submit" value="Update" />
            <br />
        </form>
        <br />
        <p><strong>Delete:</strong></p>
        <form action="Windows_hdlr.php" method="POST">
            Window Type: <input name="Window_type" type="text" required/>
            <br />
            <input name="delete" type="submit" value="Update" />
            <br />
        </form>
    </body>
</html>