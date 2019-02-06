<?php
$host = 'localhost'; 
$user = 'sbm'; 
$pass = 'sbm'; 
$database = 'leasing'; 

$res = false;  
$res = mysql_connect($host, $user, $pass);
$res = mysql_select_db($database);
mysql_query("SET NAMES UTF8");
mysql_set_charset('utf8'); 
//mysql_set_charset('cp1251'); 

if (!$res) die('Проблем с MySQL: ' . mysql_error()); 
?>