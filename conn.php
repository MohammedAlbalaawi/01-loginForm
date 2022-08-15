<?php

$conn = mysqli_connect(
    "localhost:4306",
    "root",
    "",
    "digital_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
