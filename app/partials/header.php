
<nav class="navbar navbar-expand-md navbar-dark bg-dark">

	<a class="navbar-brand" href="">Where's The Food?</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-links">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbar-links">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item <?php if($pageTitle=="Home") echo "active"; ?>">
				<a class="nav-link" href="../views/home.php">Home</a>
			</li>

			<li class="nav-item <?php if($pageTitle=="Catalog") echo "active"; ?>">
				<a class="nav-link" href="../views/catalog.php">Catalog</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="#">Cart
					<span class="badge badge-danger text-light" id="cart-count">0</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="#">Login</a>
			</li>

			<li class="nav-item <?php if($pageTitle=="Register") echo "active"; ?>">
				<a class="nav-link" href="../views/register.php">Register</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="#">Home</a>
			</li>
		</ul>
	</div>
	
</nav>