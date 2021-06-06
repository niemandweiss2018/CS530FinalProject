<?php 
    session_start();
    include 'Declerations.inc';
?>
<DOCTYPE html>
<html>
    <head>
        <title>Log In</title>
    </head>
    <body>
        <h1 style="text-align: center;">Log In</h1>
        <br />
        <br />
        <form action="Login_hdlr.php" method="POST">
            <?php include 'ErrorSpace.inc'; ?>
            Username: <input type='text' name='Username' />
            <br />
            Password: <input type='password' name='Password' />
            <br/>
            <input type='submit' name='LogIn' value='LogIn' />
        </form>
    </body>
</html>