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

								$result_per_page = 10;
								$result_offset = isset($_GET["page"]) ? " OFFSET ". ($_GET["page"] - 1) * $result_per_page : "";
								$for_pages_add_query = " LIMIT $result_per_page " . $result_offset;

								$sql = "SELECT u.id AS id, u.username AS 'username', u.firstname AS 'firstname', u.lastname AS 'lastname', u.email AS 'email', r.name AS role FROM users u JOIN roles r ON u.role_id = r.id ORDER BY lastname" . $for_pages_add_query;
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
										<button type="button" data-id="<?php echo $id ?>" class="btn btn-orange btn-block grant_admin_btn">Make Admin</button>
									<?php } ?>
								</td>		
							</tr>

							<?php } ?>
						</tbody>
						
					</table>	

				</div>
			</div>

			<div class="col-12">
									<ul class="pagination justify-content-center">

										<?php

											if(!isset($_GET["page"])) {
												$_GET["page"] = 1;
											}

											$page_sql = "SELECT * FROM users";
											$page_query = mysqli_query($conn, $page_sql);
											$page_rows = mysqli_num_rows($page_query);
											$ceil = ceil(($page_rows/$result_per_page));

										?>

										<li class="page-item">
										 	<?php $prevPage= $_GET["page"] - 1 ?>
										 	<?php if($prevPage > 0): ?>
										 		<a href="?page=<?php echo $prevPage ?>" class="page-link"><</a>
										 	<?php endif; ?>
										 </li>

										<?php
											for($i = 1; $i <= $ceil; $i++) {

												if(isset($_GET["page"])) {
													$active = $_GET["page"] == $i ? "active" : "";
													echo '<li class="page-item '.$active.'">
													<a class="page-link" href="?page='.$i.'">'.$i.'</a>
												 	</li>';
												} else {
													echo '<li class="page-item">
													<a class="page-link" href="?page='.$i.'">'.$i.'</a>
												 	</li>';
												}

											}

										 ?>
										 <li class="page-item">
										 	<?php $nextPage= $_GET["page"] + 1 ?>
										 	<?php if($nextPage < $ceil + 1): ?>
										 		<a href="?page=<?php echo $nextPage ?>" class="page-link">></a>
										 	<?php endif; ?>
										 </li>
									</ul>
							</div> <!-- end pagination -->

		</div> <!-- end main row -->

	</div> <!-- end container -->

	<?php else: 
		header("Location: ./error.php");
	endif;?>

<?php } ?>