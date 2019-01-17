<?php
	$pageTitle = "Users";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>
<?php global $conn ?>

	<?php if(isset($_SESSION["user"]) && $_SESSION["user"]["role_id"] == 1): ?>

	<!-- container -->
	<div class="container">
		
		<!-- main row -->
		<div class="row">

			<div class="col-12">
				<h1 class="text-center my-3">User Admin Page</h1>
			</div>

			<div class="col-12 offset-0 col-md-10 offset-md-1">
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th colspan="2">Username</th>
								<th>First name</th>
								<th>Last name</th>
								<th colspan="3">Email</th>
								<th>Role</th>
								<th colspan="2">Action</th>
							</tr>
						</thead>

						<tbody>
							<?php 
								$sql = "SELECT u.id AS id, u.username AS 'username', u.firstname AS 'firstname', u.lastname AS 'lastname', u.email AS 'email', r.name AS role FROM users u JOIN roles r ON u.role_id = r.id ORDER BY lastname";
								$user_details = mysqli_query($conn, $sql);

								foreach ($user_details as $user) {
									extract($user);
							?>

							<tr>
								<td colspan="2"><?php echo $username ?></td>	
								<td><?php echo $firstname ?></td>	
								<td><?php echo $lastname ?></td>	
								<td colspan="3"><?php echo $email ?></td>
								<?php $bold = $role == "admin" ? "font-weight-bold" : ""; ?>	
								<td class="<?php echo $bold ?>"><?php echo $role ?></td>	
								<td colspan="2">
									<?php if($role == "admin"){ ?>
										<?php $disabled = $_SESSION["user"]["id"] == $id ? "disabled" : ""; ?>
										<button type="button" data-id="<?php echo $id ?>" class="btn btn-danger btn-block grant_admin_btn" <?php echo $disabled ?>>Revoke Admin</button>
									<?php } else { ?>
										<button type="button" data-id="<?php echo $id ?>" class="btn btn-primary btn-block grant_admin_btn">Make Admin</button>
									<?php } ?>
								</td>		
							</tr>

							<?php } ?>
						</tbody>
						
					</table>	

				</div>
			</div>

		</div> <!-- end main row -->

	</div> <!-- end container -->

	<?php else: 
		header("Location: ./error.php");
	endif;?>

<?php } ?>