<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'project_iwp');
 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if(!$conn){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
    echo("Connected successfully");

?>