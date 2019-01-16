<?php
	session_start();
	if(!isset($_SESSION["user"])) {
		header("location: ./login.php");
	}

	$pageTitle = "Checkout";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { 
		global $conn;
	?>

	<div class="container p-2">

		<div class="row">
			
			<div class="col-12">
				
				<h1 class="my-3 text-center">Hello, welcome to your checkout page</h1>

				<form method="POST" action="../controllers/placeorder.php">
					
					<div class="container">

						<div class="row">

							<div class="col-8">

								<h4>Shipping Address</h4>
								<div class="form-group">
									<input type="text" id="addressLine1" name="addressLine1" class="form-control" value="<?php echo $_SESSION['user']['address'] ?>">
								</div>
								
							</div> <!-- end col -->


						</div> <!-- inner row 1 -->

						<div class="row">

								<div class="col-12">
									<h4>Order Summary</h4>
								</div>

								<div class="col-6">
									<p>Total</p>
								</div>

								<div class="col-6" id="totalPrice">
								
									<p>
										<?php
											$cartTotal = 0;

											foreach($_SESSION["cart"] as $id => $qty) {
												$sql = "SELECT * FROM items WHERE id=$id";
												$result = mysqli_query($conn, $sql);
												$item = mysqli_fetch_assoc($result);

												$subTotal = $_SESSION["cart"][$id] * $item["price"];
												$cartTotal += $subTotal;
											}

											echo number_format($cartTotal, 2, ".", "");
										?>
									</p>

								</div>

						</div> <!-- end inner row 2 -->

						<hr>
						<button type="submit" class="btn btn-primary btn-block">Place Order Now</button>

						<div class="row cart-items my-3">

							<div class="table-responsive">

								<table class="table table-striped table-bordered" id="card-items">
									<thead class="text-center">
										<th colspan=2>Item Name</th>
										<th>Item Price</th>
										<th>Item Quantity</th>
										<th>Item Subtotal</th>
									</thead>
								

									<tbody>
									<?php  
										foreach($_SESSION["cart"] as $id => $qty) {

										$sql2 = "SELECT * FROM items WHERE id=$id";
										$result = mysqli_query($conn, $sql2);
										$item = mysqli_fetch_assoc($result);
									?>
										<tr>
											<td colspan="2"><?php echo $item["name"] ?></td>
											<td><?php echo $item["price"] ?></td>
											<td><?php echo $qty ?></td>
											<td><?php echo number_format($item["price"] * $qty, 2, ".", "") ?></td>
										</tr>
									<?php } ?>
									</tbody>

								</table> <!-- end table -->

							</div> <!-- end table responsive -->
							
						</div> <!-- end inner row 3 -->

					</div> <!-- inner container -->

				</form> <!-- end form -->

			</div> <!-- end col -->

		</div> <!-- end row -->
		
	</div> <!-- end container -->
	
<?php } ?>