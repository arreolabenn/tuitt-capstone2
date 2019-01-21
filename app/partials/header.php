

<nav class="navbar navbar-expand-md navbar-light nav-custom">

	<span class="nav-brand">WHERE's THE FOOD?</span>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-links">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbar-links">
		<ul class="navbar-nav ml-auto">

			<li class="nav-item <?php if($pageTitle=="Home") echo "active"; ?>">
				<a class="nav-link" href="./home.php">Home</a>
			</li>

			<?php if(!isset($_SESSION["user"]) || (isset($_SESSION["user"]) && $_SESSION["user"]["role_id"] == 2)): ?>

			<li class="nav-item <?php if($pageTitle=="Catalog") echo "active"; ?>">
				<a class="nav-link" href="./catalog.php">Catalog</a>
			</li>

			<li class="nav-item <?php if($pageTitle=="Cart" || $pageTitle=="Checkout" || $pageTitle=="Confirmation") echo "active"; ?>">
				<a class="nav-link" href="./cart.php">Cart
					<span class="badge badge-danger text-light" id="cart-count">
						
						<?php 
							if(isset($_SESSION["cart"])) {
								if(array_sum($_SESSION["cart"]) > 999) {
									echo "999+";
								} else echo array_sum($_SESSION["cart"]);
							} else echo "0";
						?>

					</span>
				</a>
			</li>

			<?php elseif(isset($_SESSION["user"]) && $_SESSION["user"]["role_id"] == 1): ?>
				<li class="nav-item <?php if($pageTitle=="Items") echo "active"; ?>">
					<a class="nav-link" href="./items.php">Items</a>
				</li>

				<li class="nav-item <?php if($pageTitle=="Users") echo "active"; ?>">
					<a class="nav-link" href="./users.php">Users</a>
				</li>

				<li class="nav-item <?php if($pageTitle=="Orders") echo "active"; ?>">
					<a class="nav-link" href="./orders.php">Orders</a>
				</li>
			<?php endif; ?>

			<?php if(isset($_SESSION["user"])): ?>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle active" href="#" data-toggle="dropdown">Welcome, <?php echo $_SESSION["user"]["firstname"] ?>!</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="./profile.php">Profile</a>
						<a class="dropdown-item" href="../controllers/logout.php">Logout</a>
					</div>
				</li>
			<?php else: ?>

				<li class="nav-item <?php if($pageTitle=="Login" || $pageTitle=="Forgot Password") echo "active"; ?>">
					<a class="nav-link" href="./login.php">Login</a>
				</li>

				<li class="nav-item <?php if($pageTitle=="Register") echo "active"; ?>">
					<a class="nav-link" href="./register.php">Register</a>
				</li>

			<?php endif; ?>

		</ul>
	</div>
	
</nav>