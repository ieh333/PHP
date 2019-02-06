<?php
// Скрипт за връзка с MySQL базата данни - renti.
$host="localhost";
$user="renti";
$password=urlencode("renti");
$db="renti";
$connect=new mysqli($host, $user, $password, $db);
if ($connect->connect_error) {
    die("Connection error: " .$connect->connect_error);
}
else {
    return 0;
}
?>