<?php
	$pageTitle = "Register";
	require_once("../partials/template.php");

	if(isset($_SESSION["user"])) {
		header("Location: ../../index.php");
	}
?>

<?php function get_page_content() { ?>

	<?php
		global $conn;
	?>

	<!-- container -->
	<div class="container  p-2">

		<!-- main row -->
		<div class="row">
		
			<!-- main col -->
			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">

				<h1 class="my-3 text-center">REGISTER</h1>

				<!-- form -->
				<form>
					
					<!-- row -->
					<div class="row">

						<!-- left side -->
						<div class="col-md-6">

							<div class="form-group">	
								<label for="firstname">First Name: </label>
								<input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter first name">
								<span class="validation text-danger"></span>
							</div>

							<div class="form-group">	
								<label for="lastname">Last Name: </label>
								<input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter last name">
								<span class="validation text-danger"></span>
							</div>

							<div class="form-group">	
								<label for="email">E-mail Address: </label>
								<input type="email" name="email" id="email" class="form-control" placeholder="Enter email address">
								<span class="validation text-danger"></span>
							</div>

							<div class="form-group">	
								<label for="address">Address: </label>
								<input type="address" name="address" id="address" class="form-control" placeholder="Enter home address">
								<span class="validation text-danger"></span>
							</div>

						</div> <!-- end left side -->
					
						<!-- right side -->
						<div class="col-md-6">

							<div class="form-group">	
								<label for="username">Username: </label>
								<input type="text" name="username" id="username" class="form-control" placeholder="Enter username (min. of 10 characters)">
								<span class="validation text-danger"></span>
							</div>

							<div class="form-group">	
								<label for="password">Password: </label>
								<input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
								<span class="validation text-danger"></span>
							</div>

							<div class="form-group">	
								<label for="confirmPassword">Confirm Password: </label>
								<input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm password">
								<span class="validation text-danger"></span>
							</div>

						</div> <!-- end right side -->

					</div> <!-- end row -->

				</form> <!-- end form -->

				<div class="text-center py-4 mb-5">
					<a href="login.php" class="btn btn-secondary">Login</a>
					<button type="button" id="registerBtn" class="btn btn-primary">Register</button>
				</div>

			</div> <!-- end main col -->

		</div> <!-- end main row -->

	</div> <!-- container -->

<?php } ?>