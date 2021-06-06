<?php
    if( $_SESSION['IsError'] ) {
        echo '<label>' . $_SESSION['ErrorMsg'] . '</label><br/>';
    }
?>