<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "mapa_db";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn){
    die("Database connection failed");
}

?>