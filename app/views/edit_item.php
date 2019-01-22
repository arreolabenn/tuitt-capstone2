<?php
	$pageTitle = "Edit Item";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>
<?php global $conn ?>

	<?php if(isset($_SESSION["user"]) && $_SESSION["user"]["role_id"] == 1): ?>

	<?php
		$item_id = $_GET["id"];
		$sql = "SELECT * FROM items WHERE id=$item_id";
		$result = mysqli_query($conn, $sql);
		$item = mysqli_fetch_assoc($result);
	?>

	<!-- container -->
	<div class="container">
		
		<!-- main row -->
		<div class="row">

			<div class="col-md-8 offset-md-2">

				<h1 class="my-3 text-center">EDIT ITEM</h1>

				<form action="../controllers/process_edit_item.php" method="POST" enctype="multipart/form-data">
					
					<div class="form-group">
						<label for="item_name">Name</label>
						<input id="item_name" name="item_name" class="form-control" type="text" value="<?php echo $item["name"] ?>" required>
					</div>

					<div class="form-group">
						<label for="item_price">Price</label>
						<input id="item_price" name="item_price" class="form-control" type="number" min="1" value="<?php echo $item["price"] ?>" required>
					</div>

					<div class="form-group">
						<label for="item_description">Description</label>
						<textarea id="item_description" name="item_description" class="form-control" rows="5"required><?php echo $item["description"] ?></textarea>
					</div>

					<div class="form-group">
						<label for="item_category">Category</label>
						<select name="item_category" id="item_category" class="form-control" required>
							<?php 
								$sql2 = "SELECT * FROM categories";
								$result2 = mysqli_query($conn, $sql2);

								foreach ($result2 as $category) {

									extract($category);
									$selected = $item["category_id"] == $id ? 'selected': "";
								 	
									echo "<option value='" . $id ."' " . $selected . ">" . $name . "</option>";

								 } 
							?>
						</select>
					</div>

					<div class="form-group">
						<label for="image">Image (not required)</label>
						<input type="file" id="image" class="form-control" name="image">
					</div>

					<input type="hidden" name="item_id" id="item_id" value="<?php echo $item["id"] ?>">
					<button type="submit" class="btn btn-orange btn-block mb-5">Update Changes</button>

				</form>
				
			</div>

		</div> <!-- end main row -->

	</div> <!-- end container -->

	<?php else: 
		header("Location: ./error.php");
	endif;?>

<?php } ?>