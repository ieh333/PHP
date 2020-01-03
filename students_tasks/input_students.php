<?php
require 'db_connect.php';

$table = "students";
$fac_number = $_POST['fac_number'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$id_task = $fac_number % 20; //Finding id_task, by finding the remainder of fac_number of 20.

try {
    $sql = "INSERT INTO $table (Id_task, FN, First_name, Last_name, Email) VALUES ('$id_task','$fac_number','$firstname','$lastname','$email')";
    $conn->exec($sql);
    header("Location: http://localhost//students_tasks/students.php");
} catch (PDOException $e) {
    echo ($sql . "<br />" . $e->getMessage());
}

$conn = null;
