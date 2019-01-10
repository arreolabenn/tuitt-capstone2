<?php
	$pageTitle = "Catalog";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>

	<?php 
		global $conn;
	?>

	<!-- main row -->
	<div class="row no-gutters">

		<!-- categories -->
		<div class="col-10 offset-1 col-md-2 offset-md-1">

			<h3 class="my-3 text-center">Categories</h3>

			<!-- category links -->
			<ul class="list-group">

				<li class="list-group-item  p-0">
					<a class="btn btn-dark btn-block" href="?">All</a>
				</li>

				<?php
					$for_cat_query="SELECT * FROM categories";
					$cat_query=mysqli_query($conn, $for_cat_query);
				?>

				<?php foreach($cat_query as $cat) { ?>
					<li class="list-group-item  p-0">
						<a class="btn btn-dark btn-block" href="?category=<?php echo $cat["id"] ?>"><?php echo $cat["name"] ?></a>
					</li>
				<?php } ?>

			</ul> <!-- end category links -->

			<h3 class="my-3 text-center">Sort</h3>

			<!-- sort links -->
			<ul class="list-group">
				<li class="list-group-item p-0">
					<a class="btn btn-dark btn-block" href="../controllers/sort.php?sort=name_asc">A to Z</a>
				</li>
				<li class="list-group-item p-0">
					<a class="btn btn-dark btn-block" href="../controllers/sort.php?sort=name_des">Z to A</a>
				</li>
				<li class="list-group-item p-0">
					<a class="btn btn-dark btn-block" href="../controllers/sort.php?sort=price_asc">Price (Lowest to Highest)</a>
				</li>
				<li class="list-group-item p-0">
					<a class="btn btn-dark btn-block" href="../controllers/sort.php?sort=price_des">Price (Highest to Lowest)</a>
				</li>
			</ul> <!-- end sort links -->
			
		</div> <!-- end categories -->

		<!-- items -->
		<div class="col-10 offset-1 col-md-8 offset-md-0">

			<!-- items row -->
			<div class="row no-gutters">

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
					<div class="col-md-6 col-lg-4">
						
						<!-- item div -->
						<div class="p-2">

							<!-- item card -->
							<div class="card h-100">

								<img class="card-img-top" src="<?php echo $item["image_path"]; ?>">

								<div class="card-body">
									<h4 class="card-title"><?php echo $item["name"]; ?></h4>
									<p class="card-text">
										<small class="text-muted">"<?php echo $item["description"] ?>"</small>
										<br>
										<?php echo $item["price"] ?>
									</p>

								</div>

							</div> <!-- end item card -->

						</div> <!-- end item div -->

					</div> <!-- end item col -->

				<?php } ?> <!-- items generator -->

			</div> <!-- end items row -->

		</div> <!-- end items -->

	</div> <!-- end main row -->

<?php } ?>