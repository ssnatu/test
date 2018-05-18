<?php

/**
 * Logout page
 */

session_start();
 
$_SESSION = [];
$_SESSION['loggedin'] = false;
$_SESSION['username'] = false;

session_unset();
session_destroy();
 
header("location: index.php");
exit;