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
						<ul class="list-group">

							<a  href="../controllers/sort_category.php?category=0" class="<?php if(!isset($_SESSION["category"])) echo "option-selected" ?>">
									<li class="list-group-item btn-transparent border-none">
										All
									</li>
							</a>

							<?php
								$for_cat_query="SELECT * FROM categories";
								$cat_query=mysqli_query($conn, $for_cat_query);
							?>

							<?php foreach($cat_query as $cat) { ?>
								<a href="../controllers/sort_category.php?category=<?php echo $cat["id"] ?>" class="<?php if($_SESSION["category"] == $cat["id"]) echo "option-selected" ?>">
									<li class="list-group-item btn-transparent border-none">
										<?php echo $cat["name"] ?>
									</li>
								</a>
							<?php } ?>

						</ul> <!-- end category links -->

					</div> <!-- col -->


					<div class="col-12 col-md-6 col-lg-12">

						<h3 class="my-3 text-center">Sort</h3>

						<?php if(!isset($_SESSION["sort"]) || empty($_SESSION["sort"])) $_SESSION["sort"] = "name" ?>

						<!-- sort links -->
						<ul class="list-group">
							<a href="../controllers/sort.php?sort=name_asc" class="<?php if($_SESSION["sort"] == "name") echo "option-selected" ?>">
								<li class="list-group-item btn-transparent border-none">
									A to Z
								</li>
							</a>
							<a href="../controllers/sort.php?sort=name_des" class="<?php if($_SESSION["sort"] == "name DESC") echo "option-selected" ?>">
								<li class="list-group-item btn-transparent border-none">
									Z to A
								</li>
							</a>
							<a href="../controllers/sort.php?sort=price_asc" class="<?php if($_SESSION["sort"] == "price") echo "option-selected" ?>">
								<li class="list-group-item btn-transparent border-none">
									Price (Lowest to Highest)
								</li>
							</a>
							<a href="../controllers/sort.php?sort=price_des" class="<?php if($_SESSION["sort"] == "price DESC") echo "option-selected" ?>">
								<li class="list-group-item btn-transparent border-none">
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
					<div class="row mb-5">

						<!-- catalog heading -->
						<div class="col-12">
							<h1 class="my-3 text-center">CATALOG</h1>
						</div> <!-- end catalog heading -->

						<?php
							$where_query = "";
							if(isset($_SESSION["category"])) $where_query = "WHERE category_id='" . $_SESSION["category"] . "'";

							$order_by_query = "";
							if(isset($_SESSION["sort"])) $order_by_query = " ORDER BY " . $_SESSION["sort"];

							$result_per_page = 6;
							$result_offset = isset($_GET["page"]) ? " OFFSET ". ($_GET["page"] - 1) * $result_per_page : "";
							$for_pages_add_query = " LIMIT $result_per_page " . $result_offset;

							$query = "SELECT * FROM items " . $where_query . $order_by_query . $for_pages_add_query;

							$retrieve_items_query = mysqli_query($conn, $query);
						?>

						<!-- items generator -->
						<?php foreach($retrieve_items_query as $item) { ?>

							<!-- item col -->
							<div class="col-md-6 col-lg-4 mb-3">

								<!-- item card -->
								<div class="card h-100 shadow">

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
									<div class="p-2">
										<input type="number" class="form-control" value="1" min="0">
										<button type="button" class="btn btn-block btn-orange add-to-cart" data-id="<?php echo $item["id"] ?>">Add to cart</button>
										<input type="name" value="<?php echo $item['name'] ?>" disabled hidden>
									</div> <!-- end add to cart -->

								</div> <!-- end item card -->

							</div> <!-- end item col -->

						<?php } ?> <!-- items generator -->

							<div class="col-12">
									<ul class="pagination justify-content-center">

										<?php

											if(!isset($_GET["page"])) {
												$_GET["page"] = 1;
											}

											$page_sql = "SELECT * FROM items " . $where_query;
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

					</div> <!-- end items row -->

				</div> <!-- end items container -->

			</div> <!-- end items -->

		</div> <!-- end main row -->

	</div> <!-- end container -->

	<?php else: 
		header("Location: ./error.php");
	endif;?>

<?php } ?>