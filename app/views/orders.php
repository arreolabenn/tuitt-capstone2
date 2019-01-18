<?php
	$pageTitle = "Orders";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>
<?php global $conn; ?>

	<?php if(isset($_SESSION["user"]) && $_SESSION["user"]["role_id"] == 1): ?>

	<!-- container -->
	<div class="container">
		
		<!-- main row -->
		<div class="row">

			<div class="col-12">
				<h1 class="my-3 text-center">ORDERS</h1>
			</div>

			<div class="col-12">
				
				<div class="table-responsive">
					
					<table class="table table-striped table-bordered">
							
						<thead>
							<tr class="text-center">
								<th>ID</th>
								<th>Username</th>
								<th>Transaction Code</th>
								<th>Purchase Date</th>
								<th>Status</th>
								<th colspan="2">Actions</th>
							</tr>
						</thead>

						<tbody>

							<?php

								$result_per_page = 5;
								$result_offset = isset($_GET["page"]) ? " OFFSET ". ($_GET["page"] - 1) * $result_per_page : "";
								$for_pages_add_query = " LIMIT $result_per_page " . $result_offset;

								$order_query = "SELECT u.username AS username, o.id AS id, o.transaction_code AS transaction_code, o.status_id AS status_id, s.name AS status, o.purchase_date AS purchase_date FROM orders o JOIN statuses s ON o.status_id=s.id JOIN users u ON o.user_id=u.id ORDER BY status_id, purchase_date DESC" . $for_pages_add_query;
								$orders = mysqli_query($conn, $order_query);
								$orders_fetch = mysqli_fetch_assoc($orders);

								foreach($orders as $order) {
									extract($order);
							?>

								<tr>
									<td><?php echo $id ?></td>
									<td><?php echo $username ?></td>
									<td><?php echo $transaction_code ?></td>
									<td><?php echo $purchase_date ?></td>
									<td class="text-center"><?php echo $status ?></td>
									<td class="text-center" colspan="2">
										<?php if($status_id == 1): ?>
											<button data-id="<?php echo $id ?>" class="btn btn-success order_complete_btn">Complete Order</button>
											<button data-id="<?php echo $id ?>" class="btn btn-danger order_cancel_btn">Cancel Order</button>
										<?php endif; ?>
									</td>
								</tr>

						<?php } ?>
						</tbody>
					</table>

					<div class="mb-5">
						<ul class="pagination">

							<?php
								$page_sql = "SELECT * FROM orders";
								$page_query = mysqli_query($conn, $page_sql);
								$page_rows = mysqli_num_rows($page_query);
								$ceil = ceil(($page_rows/$result_per_page));

								for($i = 1; $i <= $ceil; $i++) {

									if(isset($_GET["page"])) {
										$active = $_GET["page"] == $i ? "active" : "";
										echo '<li class="page-item '.$active.'">
										<a class="page-link" href="?page='.$i.'">'.$i.'</a>
									 	</li>';
									} else {
										echo '<li class="page-item">
										<a class="page-link" href="?page='.$i.'">'.$i.'</a>
									 	</li>';
									}

								}

							 ?>
						</ul>
					</div> <!-- end pagination -->

				</div>

			</div>

		</div> <!-- end main row -->

	</div> <!-- end container -->

	<?php else: 
		header("Location: ./error.php");
	endif;?>

<?php } ?>