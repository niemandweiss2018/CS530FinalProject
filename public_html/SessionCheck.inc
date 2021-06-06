<?php
    $NewTime = time();
    if( !CheckActiveSessionStatus( $_SESSION['SessionID'], $NewTime ) ) {
        header( 'Location: Logout_hdlr.php?timeout' );
        exit();
    }
?>