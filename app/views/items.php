<?php
	$pageTitle = "Items";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>
<?php global $conn; ?>

	<?php if(isset($_SESSION["user"]) && $_SESSION["user"]["role_id"] == 1): ?>

	<!-- container -->
	<div class="container">
		
		<div class="row">

			<div class="col-12">
				<h1 class="my-3 float-left">ITEMS</h1>
				<a href="./new_item.php" class="btn btn-primary float-right my-3">Add New Item</a>
			</div>

			<?php 
					$sql = "SELECT items.id AS 'id', items.name AS 'name', items.description AS 'description', items.price AS 'price', items.image_path AS 'image_path', categories.name AS 'category' 
					FROM items 
					JOIN categories ON (items.category_id=categories.id)
					ORDER BY items.name";
					$items = mysqli_query($conn, $sql);

					foreach($items as $item) {
			?>
			<div class="col-md-3 py-1">
				<div class="card h-100">
					<img src="<?php echo $item["image_path"] ?>" class="card-img-top">
					<div class="card-body">
						<h4 class="card-title"><?php echo $item["name"] ?></h4>
						<p class="card-text text-muted">"<?php echo $item["description"] ?>"</p>
						<p class="card-text text-muted"><small>Category: <?php echo $item["category"] ?></small></p>
						<p class="card-text">Price: <?php echo $item["price"] ?></p>

						<input type="hidden" value="<?php echo $item["id"] ?>">
					</div>
					<div class="card-footer">
						<a href="edit_item.php?id=<?php echo $item["id"] ?>" class="btn btn-primary">Edit Item</a>
						<button data-id="<?php echo $item["id"] ?>" class="btn btn-danger delete-item-btn">Delete Item</button>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>

	</div> <!-- end container -->

	<?php else: 
		header("Location: ./error.php");
	endif;?>

<?php } ?>