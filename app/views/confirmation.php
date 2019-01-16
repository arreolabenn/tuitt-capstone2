<?php
	session_start();
	$pageTitle = "Home";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>

	<!-- container -->
	<div class="container-fluid">
		
		<!-- main row -->
		<div class="row">

			<div class="col-12">
				<div class="text-center">
					<h1 class="my-3">CONFIRMATION</h1>
					<h2 class="my-3">reference number: 
						<?php 
							if(isset($_SESSION["new_txn_number"])) {
								echo $_SESSION["new_txn_number"];
								unset($_SESSION["new_txn_number"]);
							} else {
								echo "n/a";
							}
						?>
					</h2>
					<p>Thank you for ordering! We've sent an email detailing your order</p>

					<a class="btn btn-primary" href="./catalog.php">Continue Shopping</a>
				</div>
			</div> 

		</div> <!-- end main row -->

	</div> <!-- end container -->

<?php } ?>