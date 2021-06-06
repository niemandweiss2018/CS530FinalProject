<?php
if( isset( $_GET['timeout'] ) ) {
    // session timed out
    $InitString = 'You have been logged out due to inactivity. Any changes that were not saved have been discarded.';
} else {
    // user ended session
    $InitString = 'You have been logged out.';
}
?>
<html>
    <head>
        <title>Logged Out</title>
    </head>
    <body>
        <p><?=$InitString?></p>
        <br />
        <a href='CS530_Entry.php'>Click here</a> to log back in.
    </body>
</html>