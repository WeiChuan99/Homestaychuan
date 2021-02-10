<?php  
session_start();
require_once '../connection.php';
date_default_timezone_set("Asia/Kuala_Lumpur");

if(isset($_SESSION['cart'])) {
	$user_id = $_SESSION['user_details']['user_id'];
	$total = 0;
	$transaction_code = "TSC-".date('His')."-".mt_rand();
	$status_id = 1;
	$payment_id = intval($_GET['pid']);

	$rental_query = "INSERT INTO rental (user_id, status_id,transaction_code, payment_id, total) VALUES (?, ?, ?, ?, ?)";
	$rental_stmt = $cn->prepare($rental_query);
	$rental_stmt->bind_param('iiiss', $user_id, $status_id, $payment_id, $transaction_code, $total);
	$rental_stmt->execute();

	$rental_id = $rental_stmt->insert_id; //this will return you the id of your last query

	foreach($_SESSION['cart'] as $id => $quantity) {
		$homestay_query = "SELECT * FROM homestay WHERE house_id = ?";
		$homestay_stmt = $cn->prepare($homestay_query);
		$homestay_stmt->bind_param("i", $id);
		$homestay_stmt->execute();
		$homestay_result = $homestay_stmt->get_result();
		$homestay = $homestay_result->fetch_assoc();

		$total += ($homestay['price'] * $quantity);

		$rental_homestay_query = "INSERT INTO rental_homestay(house_id, rental_id, quantity) VALUES(?, ?, ?)";
		
		$rental_homestay_stmt = $cn->prepare($rental_homestay_query);
		$rental_homestay_stmt->bind_param('iii', $id, $rental_id, $quantity);
		$rental_homestay_stmt->execute();
	}

	$update_rental = "UPDATE rental SET total = ? WHERE rental_id = ?";
	$update_rental_stmt = $cn->prepare($update_rental);
	$update_rental_stmt->bind_param("si", $total, $rental_id);
	$update_rental_stmt->execute();

	$cn->close();
	$rental_stmt->close();
	$update_rental_stmt->close();
	unset($_SESSION['cart']);
	header("Location: /");
}