<?php 

    $dbhostname = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "authentication_system";
    
    $connection = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname);
    if (!$connection) {
        die("Database connection not established." . mysqli_connect_error());
    }
