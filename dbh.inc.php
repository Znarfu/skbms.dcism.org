<?php

// $serverName = "localhost";
// $databaseUsername = "s22102131_skbms";
// $databasePassword = "001236987455";
// $databaseName = "s22102131_skbms";

$serverName = "localhost";
$databaseUsername = "root";
$databasePassword = "";
$databaseName = "sk_barangay_system";

$connection = mysqli_connect($serverName, $databaseUsername, $databasePassword, $databaseName);

if (!$connection){
    echo "Error: Database connection Failed";
    exit("Connection failed: ".mysqli_connect_error());
}