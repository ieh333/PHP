<?php
$server = "localhost";
$username = "ivailo333";
$password = "Alisia333";
$dbname = "courseworks";
$dsn = "mysql:host=$server;dbname=$dbname;charset=utf8";

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo ("Connection failed: " . $e->getMessage());
}
