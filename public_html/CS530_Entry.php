<?php

/*
    Programmer: Christian Wagner
    Date Created: 04/22/2021
    Date Modified: 04/22/2021
*/

// This is the main entry point into the website

// go to main login handler if no POST vars are found, else forward to main handler
if(!isset($_SESSION)) {header('location:Login_hdlr.php');}
else if(isset($_POST)) {/* Deal with vars */ header('location:Main_hdlr.php');}
else {header('location:Main_hdlr.php');}

?>