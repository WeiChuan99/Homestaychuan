<?php  
$title = "All Transactions";
require_once 'partials/layout.php';
if(!isset($_SESSION["user_details"]) && !$_SESSION["user_details"]["isAdmin"]) {
	header("Location: /");
}

function get_content() {
	require_once '../controllers/connection.php';
	$query = "SELECT * FROM rental";
	$stmt = $cn->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	$rentals = $result->fetch_all(MYSQLI_ASSOC);
?>

<div class="container">
	<div class="row">
		<h2 class="mt-5">All Transactions</h2>
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
							<table class="table">
								<thead>
									<tr>
										<th>User</th>
										<th>Payment</th>
										<th>Total</th>
										<th>Purchased Date</th>
										<?php if($rental["status_id"] == 1): ?>
										<th>Actions</th>
										<?php endif; ?>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $rental["user_id"] ?></td>
										<td><?php echo $rental["payment_id"] ?></td>
										<td><?php echo $rental["total"] ?></td>
										<td><?php echo $rental["purchase_date"] ?></td>
										<?php if($rental["status_id"] == 1): ?>
										<td>
											<a href="/controllers/orders/complete_order.php?rental_id=<?php echo $rental['rental_id']?>" class="btn btn-success">Complete</a>
											<a href="/controllers/orders/cancel_order.php?rental_id=<?php echo $rental['rental_id']?>" class="btn btn-danger">Cancel</a>
										</td>
										<?php endif; ?>
									</tr>
								</tbody>
							</table>
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