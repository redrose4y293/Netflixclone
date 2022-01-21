<?php

ob_start();
session_start();

date_default_timezone_set("Asia/Karachi");

try {
$con = new PDO("mysql:dbname=flex;host=localhost","root","");
$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
}
catch(PDOException $e) {
exit("Connection Failed " . $e->getMessage());
}
?>