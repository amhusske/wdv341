<?php
//PHP PDO Connection
// This file is used to connect a database.
//Include this file in your application as needed.
// Needs to be ignored when using git

$serverName = 'localhost';    //typically the default name
$userName = 'root';           //username of database
$password = '';               // password of your database
$databaseName = 'recipe';           // name of database you will be accessing

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    echo "<document style='background-color:red;' >";
    }

?>