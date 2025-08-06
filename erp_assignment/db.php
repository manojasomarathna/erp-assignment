<?php
$servername = "localhost";
$username = "root";
$password = ""; // password eka default nathi nisa blank
$dbname = "assignment";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname,$port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
