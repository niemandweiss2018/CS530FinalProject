<?php
    include 'Functions.inc';
    include 'Declarations.inc';

    SetDateTimeZone();
    $SessionResult = session_start(); // start new session

    if( !$SessionResult ) {
        die( 'Session error!' ); // session error, cannot continue
    }

    $_SESSION['ErrorMsg'] = ERR_NONE;                                           // no error message
    $_SESSION['IsError'] = FALSE;                                               // error flag is disabled
    $_SESSION['UserID'] = 0;                                                    // no user now
    $_SESSION['SessionID'] = 0;                                                 // no session now

    header( 'Location: Login_hdlr.php' );
?>