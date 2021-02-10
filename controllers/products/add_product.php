<?php  
require_once '../connection.php';

//sanitize the inputs
$name = htmlspecialchars($_POST['homestay_name']);
$price = intval($_POST['price']);
$description = htmlspecialchars($_POST['description']);
$address = htmlspecialchars($_POST['address']);
$category_id = intval($_POST['category_id']);


//image 
$img_name = $_FILES['image']['name'];
$img_size = $_FILES['image']['size'];
$img_tmpname = $_FILES['image']['tmp_name'];
$img_path = "/assets/img/$img_name";
$img_type = pathinfo($img_name, PATHINFO_EXTENSION);

$img1_name = $_FILES['image1']['name'];
$img1_size = $_FILES['image1']['size'];
$img1_tmpname = $_FILES['image1']['tmp_name'];
$img1_path = "/assets/img/$img1_name";
$img1_type = pathinfo($img1_name, PATHINFO_EXTENSION);

$img2_name = $_FILES['image2']['name'];
$img2_size = $_FILES['image2']['size'];
$img2_tmpname = $_FILES['image2']['tmp_name'];
$img2_path = "/assets/img/$img2_name";
$img2_type = pathinfo($img2_name, PATHINFO_EXTENSION);

$is_img = false;
$has_details = false;

//To check wether the admin upload an image file
if($img_type == 'jpg' || $img_type == 'jpeg' || $img_type == 'png' || $img_type == "svg" || $img_type == "gif") {
	$is_img = true;
}else if($img1_type == 'jpg' || $img1_type == 'jpeg' || $img1_type == 'png' || $img1_type == "svg" || $img1_type == "gif") {
	$is_img = true;
}else if($img2_type == 'jpg' || $img2_type == 'jpeg' || $img2_type == 'png' || $img2_type == "svg" || $img2_type == "gif") {
	$is_img = true;
} else {
	echo "Please upload an image file";
}

//To check wether the admin fill out all fields.
foreach($_POST as $key => $value) {
	if(empty($value)) {
		die("Please fill out all fields");
	} else {
		$has_details = true;
	}
} 

//Store the product in the database.
if($has_details && $is_img && $img_size > 0) {
	move_uploaded_file($img_tmpname, $_SERVER["DOCUMENT_ROOT"].$img_path);
	move_uploaded_file($img1_tmpname, $_SERVER["DOCUMENT_ROOT"].$img1_path);
	move_uploaded_file($img2_tmpname, $_SERVER["DOCUMENT_ROOT"].$img2_path);
	$query = "INSERT INTO homestay (name, price, description, image, image1, image2, address, category_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

	$stmt = $cn->prepare($query);
	$stmt->bind_param("sssssssi", $name, $price, $description, $img_path, $img1_path, $img2_path, $address, $category_id);
	$stmt->execute();
	$stmt->close();
	$cn->close();

	header("Location: /");
}