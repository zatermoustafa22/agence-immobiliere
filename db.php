<?php
$whitelist = ['localhost', '127.0.0.1'];

if (in_array($_SERVER['SERVER_NAME'] ?? '', $whitelist)) {
    // Local (XAMPP/WAMP)
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "immob";
} else {
    // InfinityFree
    $servername = "sql208.infinityfree.com";
    $username   = "if0_43526299";
    $password   = "k0c0t0biKQONAcP";
    $dbname     = "if0_43526299_immob";
}

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed.");
}

$conn->set_charset("utf8mb4");