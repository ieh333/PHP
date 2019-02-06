<?php
// Скрипт за излизане на потребителя от системата.
session_start();
unset($_SESSION["username"]);
session_destroy();
header("Location: index.php");
exit();
?>