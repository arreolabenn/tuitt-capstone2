<?php
	$pageTitle = "Confirmation";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>

	<?php if(!isset($_SESSION["user"]) || isset($_SESSION["user"]) && $_SESSION["user"]["role_id"] == 2): ?>

	<?php
		if(!isset($_SESSION["user"])) {
			header("location: ./login.php");
		}
	?>

	<!-- container -->
	<div class="container">
		
		<!-- main row -->
		<div class="row">

			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
				<div class="bg-white px-3 py-2 rounded shadow my-5 text-center">
					
					<h2 class="my-3">CONFIRMATION</h2>
					<h2><small>reference number: 
						<?php 
							if(isset($_SESSION["new_txn_number"])) {
								echo $_SESSION["new_txn_number"];
								unset($_SESSION["new_txn_number"]);
							} else {
								echo "n/a";
							}
						?>
					</small></h2>
					<p>Thank you for ordering! We've sent an email detailing your order</p>

					<a class="btn btn-orange btn-block my-1" href="./catalog.php">Continue Shopping</a>
				</div>
			</div> 

		</div> <!-- end main row -->

	</div> <!-- end container -->

	<?php else: 
		header("Location: ./error.php");
	endif;?>

<?php } ?>