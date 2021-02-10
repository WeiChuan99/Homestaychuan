<?php  
require_once '../connection.php';
$rental_id = $_GET['rental_id'];
$cancel_id = 2;

$query = "UPDATE rental SET status_id = ? WHERE rental_id = ?";
$stmt = $cn->prepare($query);
$stmt->bind_param("ii", $cancel_id, $rental_id);
$stmt->execute();

$cn->close();
$stmt->close();
header("Location: ". $_SERVER["HTTP_REFERER"]);