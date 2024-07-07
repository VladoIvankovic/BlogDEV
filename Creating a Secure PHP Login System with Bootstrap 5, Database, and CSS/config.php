<?php
$servername = "localhost";
$username = "root"; // DB username
$password = "root"; // DB password
$dbname = "secure_login";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
