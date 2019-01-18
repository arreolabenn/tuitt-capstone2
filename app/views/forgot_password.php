<?php
	$pageTitle = "Home";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>

	<!-- container -->
	<div class="container">
		
		<!-- main row -->
		<div class="row">

			<div class="offset-0 col-md-10 offset-md-1">

				<h1 class="my-3 text-center">FORGOT PASSWORD</h1>

				<form method="POST">
					<div class="form-group">
						<label for="fp_username">Enter your username</label>
						<input type="name" name="fp_username" id="fp_username" class="form-control">
					</div>

					<div class="form-group">
						<label for="fp_firstname">Enter your first name</label>
						<input type="name" name="fp_firstname" id="fp_firstname" class="form-control">
					</div>

					<div class="form-group">
						<label for="fp_lastname">Enter your last name</label>
						<input type="name" name="fp_lastname" id="fp_lastname" class="form-control">
					</div>

					<button type="button" id="fp_btn" class="btn btn-primary btn-block">Reset Password</button>
				</form>
			</div>

		</div> <!-- end main row -->

	</div> <!-- end container -->

<?php } ?>