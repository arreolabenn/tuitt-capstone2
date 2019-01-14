
<nav class="navbar navbar-expand-md navbar-dark bg-dark">

	<a class="navbar-brand" href="">Where's The Food?</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-links">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbar-links">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item <?php if($pageTitle=="Home") echo "active"; ?>">
				<a class="nav-link" href="./home.php">Home</a>
			</li>

			<li class="nav-item <?php if($pageTitle=="Catalog") echo "active"; ?>">
				<a class="nav-link" href="./catalog.php">Catalog</a>
			</li>

			<li class="nav-item">
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

			<?php if(isset($_SESSION["user"])): ?>
				<li class="nav-item">
					<a class="nav-link" href="../controllers/logout.php">Logout</a>
				</li>

			<?php else: ?>

				<li class="nav-item <?php if($pageTitle=="Login") echo "active"; ?>">
					<a class="nav-link" href="./login.php">Login</a>
				</li>

				<li class="nav-item <?php if($pageTitle=="Register") echo "active"; ?>">
					<a class="nav-link" href="./register.php">Register</a>
				</li>

			<?php endif; ?>

		</ul>
	</div>
	
</nav>