<?php
    $SessionResult = session_start();

    include 'Functions.inc';
    include 'Declarations.inc';

    // delete user's session information from activesessions
    if( !CloseActiveSession( $_SESSION['SessionID'] ) ) {
        // TODO: Make better error message
        die( 'Could not log you out. Please try again later' );
    }

    // unset all session variables and destroy
    session_unset();
    session_destroy();

    if( isset( $_GET['timeout'] ) ) {
        // user logged out due to session timeout
        header( 'Location: Logout.php?timeout' );
        exit();
    } else {
        // user chose to log out
        header( 'Location: Logout.php ');
        exit();
}
?>