<?php
        $conn = new mysqli("localhost", "root", "josh@123", "sample");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>