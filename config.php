<?php
$servername = "localhost";
$username = "root"; // change if necessary
$password = ""; // change if necessary
$dbname = "chat_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>