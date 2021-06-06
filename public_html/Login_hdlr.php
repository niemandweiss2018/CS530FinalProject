<?php
    $SessionResult = session_start();
    include 'Functions.inc';
    include 'Declerations.inc';

    if( isset( $_POST['LogIn'] ) ) {
        $Username = trim( $_POST['Username'] ); // trim off spaces
        $Password = trim( $_POST['Password'] ); // trim off spaces
        $Username = strtolower( $Username ); // username is not case-sensitive

        if( !ctype_alnum( $Username ) || !ctype_alnum( $Password ) ) {
            // invalid login creds
            $_SESSION['ErrorMsg'] = ERR_INVALID_LOGIN_CHARS;
            $_SESSION['IsError'] = TRUE;
            header( 'Location: Login.php' );
        } else {
            $info = GetUserInfoFromLogIn($Username, $Password);
            // setup session vars for current user
            $_SESSION['UserID'] = $info['userID'];

            if( $_SESSION['UserID'] > 0 ) {
                // user is good
                $_SESSION['ErrorMsg'] = ERR_NONE;
                $_SESSION['IsError'] = FALSE;
                $_SESSION['Username'] = $info['username'];
                $_SESSION['Firstname'] = $info['f_name'];
                $_SESSION['Lastname'] = $info['l_name'];

                // create session record
                $CurrentTime = time();
                ClearActiveSession( $_SESSION['UserID'] ); // check and make sure user does not have active session, if so, clear it
                $_SESSION['SessionID'] = CreateActiveSession( $_SESSION['UserID'], $CurrentTime ); // add user to activesessions table
                if($_SESSION['SessionID'] > 0) {
                    header( 'Location: Dash_hdlr.php' ); // forward to dashboard
                } else {
                    // session could not be created
                    $_SESSION['ErrorMsg'] = ERR_SESSION_NOT_CREATED;
                    $_SESSION['IsError'] = TRUE;
                    header( 'Location: Login.php' );
                }
            } else {
                // invalid login creds
                $_SESSION['ErrorMsg'] = ERR_INVALID_LOGIN_INFO;
                $_SESSION['IsError'] = TRUE;
                header( 'Location: Login.php' );
            }
        }
    } else {
        header( 'Location: Login.php' );
    }
?>