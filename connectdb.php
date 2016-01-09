<?php

//Offline

  $servername = "localhost"; //This is the local host information
  $username = "root";
  $password = NULL;
 

//Online
  /*
$servername = "cssgate.insttech.washington.edu"; //hostname here
$username = "stewak5";  //User name here
$password = "password here";   //Password here
*/

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully<br />";
// Connect to database


$sql = "USE `CareerSiteDB`";
//$sql = "USE stewak5"; //
if ($conn->query($sql) === TRUE) {
    //echo "Database connection successful<br />";
} else {
    echo "Error connecting to database: " . $conn->error . "<br />";
}
?>