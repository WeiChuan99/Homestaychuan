<?php  
require_once '../connection.php';
$order_id = $_GET['rental_id'];
$complete_id = 3;

$query = "UPDATE rental SET status_id = ? WHERE rental_id = ?";
$stmt = $cn->prepare($query);
$stmt->bind_param("ii", $complete_id, $rental_id);
$stmt->execute();

$cn->close();
$stmt->close();
header("Location: ". $_SERVER["HTTP_REFERER"]);