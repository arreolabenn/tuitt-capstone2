<?php
	$pageTitle = "Catalog";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>

	<?php 
		global $conn;
	?>

	<?php if(!isset($_SESSION["user"]) || isset($_SESSION["user"]) && $_SESSION["user"]["role_id"] == 2): ?>

	<!-- container -->
	<div class="container p-2">

		<!-- main row -->
		<div class="row">

			<!-- categories -->
			<div class="col-lg-2">


				<div class="row">

					<div class="col-12 col-md-6 col-lg-12">

						<h3 class="my-3 text-center">Categories</h3>

						<!-- category links -->
						<ul class="list-group border">

							<a href="?">
									<li class="list-group-item text-light bg-dark mb-1">
										All
									</li>
							</a>

							<?php
								$for_cat_query="SELECT * FROM categories";
								$cat_query=mysqli_query($conn, $for_cat_query);
							?>

							<?php foreach($cat_query as $cat) { ?>
								<a href="?category=<?php echo $cat["id"] ?>">
									<li class="list-group-item text-light bg-dark mb-1">
										<?php echo $cat["name"] ?>
									</li>
								</a>
							<?php } ?>

						</ul> <!-- end category links -->

					</div> <!-- col -->


					<div class="col-12 col-md-6 col-lg-12">

						<h3 class="my-3 text-center">Sort</h3>

						<!-- sort links -->
						<ul class="list-group border">
							<a href="../controllers/sort.php?sort=name_asc">
								<li class="list-group-item text-light bg-dark mb-1">
									A to Z
								</li>
							</a>
							<a href="../controllers/sort.php?sort=name_des">
								<li class="list-group-item text-light bg-dark mb-1">
									Z to A
								</li>
							</a>
							<a href="../controllers/sort.php?sort=price_asc">
								<li class="list-group-item text-light bg-dark mb-1">
									Price (Lowest to Highest)
								</li>
							</a>
							<a href="../controllers/sort.php?sort=price_des">
								<li class="list-group-item text-light bg-dark mb-1">
									Price (Highest to Lowest)
								</li>
							</a>
						</ul> <!-- end sort links -->

					</div> <!-- end col -->

				</div> <!-- end row -->
				
			</div> <!-- end categories -->

			<!-- items -->
			<div class="col-lg-10">

				<!-- items container -->
				<div class="container">

					<!-- items row -->
					<div class="row">

						<!-- catalog heading -->
						<div class="col-12">
							<h1 class="my-3 text-center">CATALOG</h1>
						</div> <!-- end catalog heading -->

						<?php
							$where_query = "";
							if(isset($_GET["category"])) $where_query = "WHERE category_id='" . $_GET["category"] . "'";

							$order_by_query = "";
							if(isset($_SESSION["sort"])) $order_by_query = " ORDER BY " . $_SESSION["sort"];

							$query = "SELECT * FROM items " . $where_query . $order_by_query;

							$retrieve_items_query = mysqli_query($conn, $query);
						?>

						<!-- items generator -->
						<?php foreach($retrieve_items_query as $item) { ?>

							<!-- item col -->
							<div class="col-md-6 col-lg-4 py-1">

								<!-- item card -->
								<div class="card h-100">

									<img class="card-img-top" src="<?php echo $item["image_path"]; ?>">
									<div class="card-body">
										<h4 class="card-title">
											<?php echo $item["name"]; ?>
										</h4>
										<p class="card-text">
											<small class="text-muted">"<?php echo $item["description"] ?>"</small>
											<br>
											<?php echo $item["price"] ?>
										</p>


									</div> <!-- carb body -->

									<!-- add to cart -->
									<div class="card-footer">
										<input type="number" class="form-control" value="1" min="0">
										<button type="button" class="btn btn-block btn-outline-dark add-to-cart" data-id="<?php echo $item["id"] ?>">Add to cart</button>
									</div> <!-- end add to cart -->

								</div> <!-- end item card -->

							</div> <!-- end item col -->

						<?php } ?> <!-- items generator -->

					</div> <!-- end items row -->

				</div> <!-- end items container -->

			</div> <!-- end items -->

		</div> <!-- end main row -->

	</div> <!-- end container -->

	<?php else: 
		header("Location: ./error.php");
	endif;?>

<?php } ?>