<?php  
$title = "My Transactions";
require_once 'partials/layout.php';
// if(!isset($_SESSION["user_details"]) && !$_SESSION["user_details"]["isAdmin"]) {
// 	header("Location: /");
// }

function get_content() {
	require_once '../controllers/connection.php';
	$user_id = $_SESSION["user_details"]["user_id"];
	$query = "SELECT * FROM rental WHERE user_id = ?";
	$stmt = $cn->prepare($query);
	$stmt->bind_param("i", $user_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$rentals = $result->fetch_all(MYSQLI_ASSOC);
?>

<div class="container">
	<div class="row">
		<h2 class="mt-5">My Transactions</h2>
		<div class="col-md-8 mx-auto">
			<div class="text-white d-flex pt-5 justify-content-between">
				<div class="p-4 bg-info">Pending</div>
				<div class="p-4 bg-success">Completed</div>
				<div class="p-4 bg-danger">Cancelled</div>
			</div>
			<div class="accordion py-5">
				<?php foreach($rentals as $rental): ?>
				<div class="accordion-item">
					<h2 class="accordion-header">
						<button class="accordion-button text-white" data-status-id="<?php echo $rental['status_id'] ?>" data-bs-toggle="collapse" data-bs-target="#rental-<?php echo $rental['rental_id'] ?>">
							<?php echo $rental["transaction_code"] ?>
						</button>
					</h2>
					<div id="rental-<?php echo $rental['rental_id'] ?>" class="accordion-collapse collapse show">
						<div class="accordion-body">
							<p>Purchase Date: <?php echo $rental['purchase_date'] ?></p>
							<small>Mode of Payment: 
								<strong>
									<?php $rental['payment_id'] == 1 ? print("COD") : print("Paypal") ?>
								</strong>
							</small>

							<table class="table">
								<thead>
									<tr>
										<th>Name</th>
										<th>Price</th>
										<th>Days</th>
										<th>Subtotal(include service charge)</th>
									</tr>
								</thead>
								<tbody>
									<?php  
									$op_query = "SELECT * FROM rental_homestay op JOIN homestay p ON(op.house_id = p.house_id) WHERE op.rental_id =".$rental['rental_id'];
									$ops = $cn->query($op_query);
									foreach($ops as $op):
										$subtotal = $op['price'] * $op['quantity']
									?>

									<tr>
										<td><?php echo $op['name'] ?></td>
										<td><?php echo $op['price'] ?></td>
										<td><?php echo $op['quantity'] ?></td>
										<td>RM<?php echo number_format($subtotal, 2) ?></td>
									</tr>

									<?php endforeach; ?>
								</tbody>
							</table>
							<div class="d-flex justify-content-between">
								<?php if ($rental['status_id'] == 1): ?>
									<a href="/controllers/orders/cancel_order.php?rental_id=<?php echo $rental['rental_id']?>" class="btn btn-danger">Cancel Order</a>
								<?php endif ?>
								<h2>Total: RM<strong><?php echo $rental['total'] ?></strong></h2>
							</div>


						</div>
					</div>
				</div>					
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	let accordionBtns = document.querySelectorAll(".accordion-button");	
	accordionBtns.forEach(btn => {
		let status_id = btn.getAttribute('data-status-id')
		if(status_id == 1) {
			btn.classList.add("bg-info")
		} else if(status_id == 2) {
			btn.classList.add("bg-danger")
		} else {
			btn.classList.add("bg-success")
		}
	})
</script>

<?php  
}
?>