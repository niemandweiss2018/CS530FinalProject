<!--
    Author: Christian Wagner
    Date Created: 04/22/2021
    Date Modified: 04/22/2021
-->

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CS530 Login</title>
    </head>
    <body>
        <?php include './header.htm';?>
        <h1 id="mainHeader">Login</h1>
        <hr /><br />
        <p id="loginPara">Enter Login Credentials</p>
        <form method="post" action="Login_hdlr.php">
            Username: <input type="text" name="username" required/>
            Password: <input type="text" name="password" required/>
            <input type="submit" value="Login" />
        </form>
    </body>
</html>