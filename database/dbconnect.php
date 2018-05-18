<?php

/**
 * DB Connection
 */

// connect to MySQL database
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = '';

$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS) or die('Cannot connect to MySQL database: ' . mysqli_error());

// select database
$select_db = mysqli_select_db($con, 'attractions');
