<?php
	session_start();
	if(isset($_SESSION["user"])) {
		header("location: ../../index.php");
	}

	$pageTitle = "Login";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>

	<!-- container -->
	<div class="container p-2">
		
		<!-- main row -->
		<div class="row">

			<!-- main col -->
			<div class="col-lg-10 offset-md-1 col-lg-8 offset-lg-2">

				<h1 class="my-3 text-center">LOGIN</h1>

				<form>
					
					<div class="form-group">
						<label for="username">Username: </label>
						<input id="username" class="form-control" type="text" name="username" placeholder="Enter Username">
						<span class="validation text-danger"></span>
					</div>

					<div class="form-group">
						<label for="password">Password: </label>
						<input id="password" class="form-control" type="password" name="password" placeholder="Enter Password">
						<span class="validation text-danger"></span>
					</div>

				</form>

				<div class="text-center py-4 mb-5">
					<a href="register.php" class="btn btn-secondary">Register</a>
					<button type="button" id="loginBtn" class="btn btn-primary">Login</button>
				</div>

			</div> <!-- end main col -->

		</div> <!-- end main row -->

	</div> <!-- end container -->

<?php } ?>