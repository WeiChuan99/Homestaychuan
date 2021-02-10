<?php  

$title = "Homestay Details";

function get_content() { 
	require_once '../controllers/connection.php';
	$id = $_GET['id'];
	$query = "SELECT * FROM homestay WHERE house_id = ?";
	$stmt = $cn->prepare($query);
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	$homestay = $result->fetch_assoc();
	//if you're fetching a single item fetch_assoc
	//if you're fetching multiple rows fetch_all(MYSQLI_ASSOC)

	$query = "SELECT * FROM homestay";
	$stmt = $cn->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	$categories = $result->fetch_all(MYSQLI_ASSOC);
?>

<div class="container">
	<div class="row">
		<div class="col-md-4 py-5 mx-auto">
			<div class="card">
				<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
						  <ol class="carousel-indicators">
						    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
						    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
						    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
						  </ol>
						  <div class="carousel-inner">
						    <div class="carousel-item active">
						      <img src="<?php echo $homestay['image'] ?>" class="card-img-top">
						    </div>
						    <div class="carousel-item">
						      <img src="<?php echo $homestay['image1'] ?>" class="card-img-top">
						    </div>
						    <div class="carousel-item">
						      <img src="<?php echo $homestay['image2'] ?>" class="card-img-top">
						    </div>
						  </div>
						  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
						    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
						    <span class="visually-hidden">Previous</span>
						  </a>
						  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
						    <span class="carousel-control-next-icon" aria-hidden="true"></span>
						    <span class="visually-hidden">Next</span>
						  </a>
				</div>
				<div class="card-body">
					<a href="/views/product_details.php?id=<?php echo $homestay['house_id']?>"><h5 class="card-title"><?php echo $homestay["name"] ?></h5></a>
					<p class="card-text"><?php echo $homestay['description'] ?></p>
					<strong><?php echo $homestay['price'] ?></strong>
				</div>
				<?php if(isset($_SESSION["user_details"]) && !$_SESSION["user_details"]["isAdmin"]): ?>
				<div class="card-footer">
					<div class="input-group">
						<input type="number" name="quantity" class="form-control" min="1">
						<button class="btn btn-outline-success add-to-cart" data-id="<?php echo $homestay['house_id'] ?>">Add to Cart</button>
					</div>
				</div>
				<?php endif; ?>

				<?php if(isset($_SESSION["user_details"]) && $_SESSION["user_details"]["isAdmin"]): ?>
				<div class="card-footer">
					<button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>

					<div class="modal fade" id="editModal">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Edit Item</h5>
								</div>
								<div class="modal-body">
									<form method="POST" action="/controllers/products/update_product.php" enctype="multipart/form-data">
										<input type="hidden" name="house_id" value="<?php echo $homestay['house_id'] ?>">
										<div class="mb-3">
											<label>Name</label>
											<input type="text" name="homestay_name" class="form-control" value="<?php echo $homestay['name'] ?>">
										</div>
										<div class="mb-3">
											<label>Price</label>
											<input type="number" name="price" class="form-control" value="<?php echo $homestay['price'] ?>">
										</div>
										<div class="mb-3">
											<label>Image</label>
											<input type="file" name="image" class="form-control" value="<?php echo $homestay['image'] ?>">
										</div>
										<div class="mb-3">
											<label>Image</label>
											<input type="file" name="image1" class="form-control" value="<?php echo $homestay['image'] ?>">
										</div>
										<div class="mb-3">
											<label>Image</label>
											<input type="file" name="image2" class="form-control" value="<?php echo $homestay['image'] ?>">
										</div>
										<div class="mb-3">
											<label>Category</label>
											<select name="category_id" class="form-select">
												<?php foreach($categories as $category): ?>
													<?php if($category['category_id'] == $homestay['category_id']): ?>
														<option selected value="<?php echo $category['category_id'] ?>">
															<?php echo $category['name'] ?>
														</option>
													<?php else: ?>
														<option value="<?php echo $category['category_id'] ?>">
															<?php echo $category["name"]; ?>
														</option>
													<?php endif; ?>
												<?php endforeach; ?>
											</select>
										</div>
										<div class='mb-3'>
											<label>Address</label>
											<textarea class="form-control" name="address" rows="3"><?php echo $homestay['address'] ?></textarea>
										</div>
										<div class='mb-3'>
											<label>Description</label>
											<textarea class="form-control" name="description" rows="5"><?php echo $homestay['description'] ?></textarea>
										</div>
										<button class="btn btn-success">Update</button>
									</form>
								</div>
								<div class="modal-footer">
									<button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								</div>
							</div>
						</div>
					</div>

					<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>

					<div class="modal fade" id="deleteModal">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Are you sure you want to delete <?php echo $homestay['name'] ?> ?</h5>
								</div>
								<div class="modal-footer">
									<button data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
									<a class="btn btn-danger" href="/controllers/products/delete_product.php?id=<?php echo $homestay['house_id'] ?>">Confirm</a>
								</div>
							</div>
						</div>
					</div>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>

<?php  
	}
	require_once 'partials/layout.php';
?>