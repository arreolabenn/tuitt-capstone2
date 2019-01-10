<?php
	$pageTitle = "Register";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>

	<!-- main row -->
	<div class="row no-gutters">
	
		<!-- main col -->
		<div class="col-10 offset-1 col-md-8 offset-md-2">

			<h1 class="my-3 text-center">REGISTER</h1>

			<!-- form -->
			<form class="mb-5">
				
				<!-- row -->
				<div class="row no-gutters">

					<!-- first half -->
					<div class="col-md-6">

						<div class="form-group  p-2">	
							<label>First Name: </label>
							<input type="text" name="firstName" id="firstName" class="form-control" placeholder="Enter first name">
						</div>

						<div class="form-group  p-2">	
							<label>Last Name: </label>
							<input type="text" name="lastName" id="lastName" class="form-control" placeholder="Enter last name">
						</div>

						<div class="form-group  p-2">	
							<label>E-mail Address: </label>
							<input type="email" name="email" id="email" class="form-control" placeholder="Enter email address">
						</div>

						<div class="form-group  p-2">	
							<label>Address: </label>
							<input type="address" name="address" id="address" class="form-control" placeholder="Enter home address">
						</div>

					</div> <!-- end first half -->
				
					<!-- second half -->
					<div class="col-md-6">

						<div class="form-group p-2">	
							<label>Username: </label>
							<input type="text" name="username" id="username" class="form-control" placeholder="Enter username">
						</div>

						<div class="form-group  p-2">	
							<label>Password: </label>
							<input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
						</div>

						<div class="form-group  p-2">	
							<label>Confirm Password: </label>
							<input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm password">
						</div>

					</div> <!-- end second half -->

					<button type="button" id="registerBtn" class="btn btn-primary w-25 ml-auto mt-3">Register</button>

				</div> <!-- end row -->

			</form> <!-- end form -->

		</div> <!-- end main col -->

	</div> <!-- end main row -->

<?php } ?>