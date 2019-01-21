<?php
	$pageTitle = "Forgot Password";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>

	<?php if(!isset($_SESSION["user"])): ?>

	<!-- container -->
	<div class="container">
		
		<!-- main row -->
		<div class="row">

			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">

				<div class="bg-white px-3 py-2 rounded shadow my-5">

					<h1 class="my-3 text-center">FORGOT PASSWORD</h1>

					<form>
						<div class="form-group">
							<label for="fp_username">Username:</label>
							<input type="name" name="fp_username" id="fp_username" class="form-control" placeholder="Enter Username">
						</div>

						<div class="form-group">
							<label for="fp_firstname">First Name:</label>
							<input type="name" name="fp_firstname" id="fp_firstname" class="form-control" placeholder="Enter First Name">
						</div>

						<div class="form-group">
							<label for="fp_lastname">Last Name:</label>
							<input type="name" name="fp_lastname" id="fp_lastname" class="form-control" placeholder="Enter Last Name">
						</div>

						<div class="py-3">
							<button type="button" id="fp_btn" class="btn btn-orange btn-block my-1">Reset Password</button>
							<a href="./login.php" class="btn btn-secondary btn-block my-1">Login</a>
						</div>
					</form>

				</div>

			</div>

		</div> <!-- end main row -->

	</div> <!-- end container -->

	<?php else: 
		header("Location: ./error.php");
	endif;?>

<?php } ?>