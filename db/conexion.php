<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "market";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$con = mysql_connect($servername,$username,$password) or die('error al conectar');
mysql_select_db($dbname,$con);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
 }
  
 ?>