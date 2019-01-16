<?php
	session_start();
	if(!isset($_SESSION["user"])) {
		header("location: ../../index.php");
	}

	$pageTitle = "Profile";
	require_once("../partials/template.php");
?>

<?php function get_page_content(){
	global $conn;
?>

<?php $user = $_SESSION['user']; ?>
	<div class="container p-2">
		<div class="row">
			<div class="col-lg-3">
				<div class="list-group" id="list-tab" role="tablist">
					<a class="list-group-item" href="#profile" data-toggle="list" role="tab">
						User Information
					</a>
					<a class="list-group-item" href="#history" data-toggle="list" role="tab">
						Order History
					</a>
				</div>
			</div>
			<div class="col-lg-9">
				<div class="tab-content">
					<div class="tab-pane" id="profile" role="tabpanel">
						<h3>User Information</h3>
						<form id="update_user_details">
							<div class="container">
								<input type="text" class="form-control" name="user_id" id="user_id" value="<?php echo $user['id'] ?>" hidden>

								<label for="username">Username:</label>
								<input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username'] ?>" disabled>
								<span class="validation text-danger"></span><br>

								<label for="firstname">First Name</label>
								<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname'] ?>">
								<span class="validation text-danger"></span><br>

								<label for="lastname">Last Name</label>
								<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname'] ?>">
								<span class="validation text-danger"></span><br>

								<label for="email">E-mail Address</label>
								<input type="text" class="form-control" id="email" name="email" value="<?php echo $user['email'] ?>">
								<span class="validation text-danger"></span><br>

								<label for="address">Address</label>
								<input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address'] ?>">
								<span class="validation text-danger"></span><br>

								<label for="password">Password (required to make changes)</label>
								<input type="password" class="form-control" id="password" name="password">

								<br>
								<button type="button" class="btn btn-primary mb-5" id="update_info">Update Info</button>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="history" role="tabpanel">
						<div class="row">
							<div class="col-md-6">
								<h3>Order History</h3>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr class="text-center">
										<th>Transaction Number</th>
										<th>Purchase Date</th>
										<th>Status</th>
										<th>Payment Mode</th>
									</tr>
								</thead>
								<tbody>
									<?php

									//retrieve trasaction code
									//retrieve purchase date
									//retrive payment mode
									$sql = "SELECT o.transaction_code, o.purchase_date, s.name AS status, p.name AS payment_mode 
											FROM orders o 
											JOIN statuses s ON (o.status_id=s.id)
											JOIN payment_modes p ON (o.payment_mode_id=p.id)
											WHERE user_id = " . $user["id"] . " ORDER BY o.purchase_date DESC";

									$transactions = mysqli_query($conn, $sql);
									foreach($transactions as $transaction) { ?>
                                          	<tr>
                                          		<td><?php echo $transaction["transaction_code"] ?></td>
                                          		<td><?php echo $transaction["purchase_date"] ?></td>
                                          		<td><?php echo $transaction["status"] ?></td>
                                          		<td><?php echo $transaction["payment_mode"] ?></td>
                                          	</tr>
                                        <?php  }  ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
