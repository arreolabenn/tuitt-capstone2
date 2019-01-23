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
				<div class="bg-white px-3 py-2 rounded shadow my-5">
					<h1 class="my-3 text-center">You don't have access to view this page</h1>
					<div class="text-center py-3">
						<a href="./home.php" class="btn btn-orange my-1">Return Home</a>
					</div>
				</div>
			</div>

		</div> <!-- end main row -->

	</div> <!-- end container -->

<?php } ?>