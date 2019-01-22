<?php
	$pageTitle = "Items";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>
<?php global $conn; ?>

	<?php if(isset($_SESSION["user"]) && $_SESSION["user"]["role_id"] == 1): ?>

	<?php if(isset($_SESSION["added"]) && $_SESSION["added"] == "added new item"): ?>
		<span id="added-new-item"></span>
	<?php 
		unset($_SESSION["added"]);
		endif; 
	?>

	<?php if(isset($_SESSION["edited"]) && $_SESSION["edited"] == "edited item"): ?>
		<span id="edited-item"></span>
	<?php 
		unset($_SESSION["edited"]);
		endif; 
	?>

	<!-- container -->
	<div class="container">
		
		<div class="row">

			<div class="col-12">
				<h1 class="my-3 float-left">ITEMS</h1>
				<a href="./new_item.php" class="btn btn-orange float-right my-3">Add New Item</a>
			</div>

			<div class="row mb-3">

				<?php 

						$result_per_page = 6;
						$result_offset = isset($_GET["page"]) ? " OFFSET ". ($_GET["page"] - 1) * $result_per_page : "";
						$for_pages_add_query = " LIMIT $result_per_page " . $result_offset;

						$sql = "SELECT items.id AS 'id', items.name AS 'name', items.description AS 'description', items.price AS 'price', items.image_path AS 'image_path', categories.name AS 'category' 
						FROM items 
						JOIN categories ON (items.category_id=categories.id)
						ORDER BY items.name" . $for_pages_add_query;
						$items = mysqli_query($conn, $sql);

						foreach($items as $item) {
				?>
				<div class="col-md-6 col-lg-4 py-2">
					<div class="card h-100">
						<img src="<?php echo $item["image_path"] ?>" class="card-img-top">
						<div class="card-body">
							<h4 class="card-title"><?php echo $item["name"] ?></h4>
							<p class="card-text text-muted">"<?php echo $item["description"] ?>"</p>
							<p class="card-text text-muted"><small>Category: <?php echo $item["category"] ?></small></p>
							<p class="card-text">Price: <?php echo $item["price"] ?></p>

							<input type="hidden" value="<?php echo $item["id"] ?>">
						</div>
						<div class="card-footer text-center">
							<a href="edit_item.php?id=<?php echo $item["id"] ?>" class="btn btn-orange">Edit Item</a>
							<button data-id="<?php echo $item["id"] ?>" class="btn btn-danger delete-item-btn">Delete Item</button>
						</div>
					</div>
				</div>
				<?php } ?>

			</div>

			<div class="col-12">
				<ul class="pagination justify-content-center">

					<?php

						if(!isset($_GET["page"])) {
							$_GET["page"] = 1;
						}

						$page_sql = "SELECT * FROM items";
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

		</div>

	</div> <!-- end container -->

	<?php else: 
		header("Location: ./error.php");
	endif;?>

<?php } ?>