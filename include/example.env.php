<?php

///////////////////////////////////////////////////////////////////////////////
// Database Setup
///////////////////////////////////////////////////////////////////////////////
$servername = "your.database.host";
$username = "databaseusername";
$password = "usernamepassword";
$dbname = "databasename";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 

