<?php
	$pageTitle = "Register";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>

	<?php
		global $conn;
	?>

	<?php if(!isset($_SESSION["user"])): ?>

	<!-- container -->
	<div class="container">

		<!-- main row -->
		<div class="row">
		
			<!-- main col -->
			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">

				<div class="bg-white px-3 py-2 rounded shadow my-5">

					<h1 class="my-3 text-center">REGISTER</h1>

					<!-- form -->
					<form>
						
						<!-- row -->
						<div class="row">

							<!-- left side -->
							<div class="col-lg-6">

								<div class="form-group">	
									<label for="firstname">First Name: </label>
									<input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First Name">
									<span class="validation text-danger"></span>
								</div>

								<div class="form-group">	
									<label for="lastname">Last Name: </label>
									<input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Last Name">
									<span class="validation text-danger"></span>
								</div>

								<div class="form-group">	
									<label for="email">E-mail Address: </label>
									<input type="email" name="email" id="email" class="form-control" placeholder="Enter E-mail Address">
									<span class="validation text-danger"></span>
								</div>

								<div class="form-group">	
									<label for="address">Address: </label>
									<input type="address" name="address" id="address" class="form-control" placeholder="Enter Home Address">
									<span class="validation text-danger"></span>
								</div>

							</div> <!-- end left side -->
						
							<!-- right side -->
							<div class="col-lg-6">

								<div class="form-group">	
									<label for="username">Username: </label>
									<input type="text" name="username" id="username" class="form-control" placeholder="Enter Username (min. of 10 characters)">
									<span class="validation text-danger"></span>
								</div>

								<div class="form-group">	
									<label for="password">Password: </label>
									<input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
									<span class="validation text-danger"></span>
								</div>

								<div class="form-group">	
									<label for="confirmPassword">Confirm Password: </label>
									<input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm Password">
									<span class="validation text-danger"></span>
								</div>

							</div> <!-- end right side -->

						</div> <!-- end row -->

					</form> <!-- end form -->

					<div class="py-3">
						<button type="button" id="registerBtn" class="btn btn-orange btn-block my-1">Register</button>
						<a href="login.php" class="btn btn-secondary btn-block my-1">Login</a>
					</div>

				</div>

			</div> <!-- end main col -->

		</div> <!-- end main row -->

	</div> <!-- container -->

	<?php else: 
		header("Location: ./error.php");
	endif;?>

<?php } ?>