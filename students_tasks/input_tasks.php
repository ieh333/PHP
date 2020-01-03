<?php
require 'db_connect.php';

$table = "tasks";
$uslovie = $_POST['uslovie'];


try {
    $sql = "INSERT INTO $table (Uslovie) VALUES ('$uslovie')";
    $conn->exec($sql);
    header("Location: http://localhost//students_tasks/tasks.php");
} catch (PDOException $e) {
    echo ($sql . "<br />" . $e->getMessage());
}

$conn = null;