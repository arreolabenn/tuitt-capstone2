<?php
	session_start();
	$pageTitle = "Cart";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { 

	global $conn;

	?>

	<div class="container p-2">

		<div class="row">

			<div class="col-12">

				<h1 class="my-3 text-center">CART</h1>

				<table class="table table-striped table-bordered">

					<thead>
						<tr class="text-center">
							<th>Item Name</th>
							<th>Item Price</th>
							<th>Item Quantity</th>
							<th>Item Subtotal</th>
							<th>Actions</th>
						</tr>
					</thead>

					<?php 
						global $cartTotal;
						if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) != 0):
					?>

					<?php foreach($_SESSION["cart"] as $id => $qty){

						$sql = "SELECT * FROM items WHERE id='$id'";
						$result = mysqli_query($conn, $sql);
						$item = mysqli_fetch_assoc($result);					
					?>
						<tr>
							<td class="itemName"><?php echo $item['name'] ?></td>
							<td class="itemPrice"><?php echo $item['price'] ?></td>
							<td class="itemQuantity">
								<input type="number" value="<?php echo $qty ?>" class="form-control" data-id="<?php echo $id ?>" min="1">
							</td>
							<td class="itemSubtotal text-right">
								<?php 
									$subTotal = number_format(($item["price"] * $_SESSION["cart"][$id]), 2, ".", "");
									echo $subTotal;
								?>
							</td>
							<td class="itemAction text-center">
								<button class="btn btn-danger itemRemove" data-id="<?php echo $id ?>">Remove from cart</button>
							</td>
						</tr>

						<?php 
							$cartTotal += $subTotal;
						?>

					<?php } ?>

					<?php else: ?>

						<tr class="text-center">
							<td colspan="5">No items in the cart</td>
						</tr>

					<?php endif; ?>

					<tfoot>
						<tr>
							<td class="text-right font-weight-bold" colspan="3">Total</td>
							<td class="text-right font-weight-bold" id="totalPrice"><?php echo number_format($cartTotal, 2, ".", "") ?></td>
							<?php if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) != 0): ?>
							<td class="text-center">
								<a href="./checkout.php" class="btn btn-primary">Proceed to checkout</a>
							</td>
							<?php endif; ?>
						</tr>
					</tfoot>

				</table>

			</div> <!-- end col -->

		</div>	<!-- end row -->

	</div> <!-- end container -->

<?php } ?>