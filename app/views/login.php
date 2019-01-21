<?php
	$pageTitle = "Login";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>

	<?php if(!isset($_SESSION["user"])): ?>

	<!-- container -->
	<div class="container">
		
		<!-- main row -->
		<div class="row">

			<!-- main col -->
			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">

				<div class="bg-white px-3 py-2 rounded shadow my-5">

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

					<div class="py-3">
						<button type="button" id="loginBtn" class="btn btn-orange btn-block my-1">Login</button>
						<a href="./forgot_password.php" class="btn btn-secondary btn-block my-1">Forgot Password</a>
						<a href="register.php" class="btn btn-secondary btn-block my-1">Register</a>
					</div>

				</div>

			</div> <!-- end main col -->

		</div> <!-- end main row -->

	</div> <!-- end container -->

	<?php else: 
		header("Location: ./error.php");
	endif;?>

<?php } ?>