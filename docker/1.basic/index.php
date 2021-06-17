<?php

// Create connection
$conn = new mysqli('mysql', 'root', 'secret', 'example');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo 'Succesful connection!';