<?php  
require_once '../connection.php';

$id = intval($_POST['house_id']);
$name = htmlspecialchars($_POST['homestay_name']);
$price = floatval($_POST['price']);
$description = htmlspecialchars($_POST['description']);
$address = htmlspecialchars($_POST['address']);
$cat_id = intval($_POST['category_id']);

// var_dump($_POST);
// die();

//If the admin wants to update the image.
if ($_FILES['image']['name'] != "") {
	$img_name = $_FILES['image']['name'];
	$img_path = "/assets/img/$img_name";
	move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER["DOCUMENT_ROOT"].$img_path);

	$query = "UPDATE homestay SET name = ?, price = ?, description = ?, image = ?, category_id = ?, address = ? WHERE house_id = ?";
	$stmt = $cn->prepare($query);
	$stmt->bind_param('ssssisi', $name, $price, $description, $img_path, $cat_id, $address, $id);
	$stmt->execute();
	$stmt->close();
	$cn->close();
} else { //admin only wants to update the details
	$query = "UPDATE homestay SET name = ?, price = ?, description = ?, category_id = ?, address = ? WHERE house_id = ?";
	$stmt = $cn->prepare($query);
	$stmt->bind_param('sssisi', $name, $price, $description, $cat_id, $address, $id);
	$stmt->execute();
	$stmt->close();
	$cn->close();
}

header("Location: " . $_SERVER['HTTP_REFERER']);