<?php 

//Local Database 
$host = "localhost";
$username = "root";
$password = "";
$name = "homestay";

//Online Database
// $host = "db4free.net";
// $username = "b2ecomchuan";
// $password = "Chuan@1029";
// $name = "b2ecomchuan";

$cn = new mysqli($host, $username, $password, $name);