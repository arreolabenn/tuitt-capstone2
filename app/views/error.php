<?php
	$pageTitle = "Error";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>

	<!-- container -->
	<div class="container">
		
		<!-- main row -->
		<div class="row">

			<div class="col-12">
				<div class="text-center">
					<h1 class="my-3">You don't have access to view this page</h1>
					<a href="./home.php" class="btn btn-primary">Return Home</a>
				</div>
			</div>

		</div> <!-- end main row -->

	</div> <!-- end container -->

<?php } ?>