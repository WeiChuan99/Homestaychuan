<?php  
require_once '../connection.php';
$id = intval($_GET['id']);

$query = "DELETE FROM homestay WHERE house_id = $id";
$cn->query($query);
header("Location: /");