<?php
	$pageTitle = "New Item";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>
<?php global $conn ?>

	<?php if(isset($_SESSION["user"]) && $_SESSION["user"]["role_id"] == 1): ?>

	<!-- container -->
	<div class="container p-2">
		
		<!-- main row -->
		<div class="row">

			<div class="col-md-8 offset-sm-2">

				<h1 class="my-3 text-center">NEW ITEM</h1>

				<form action="../controllers/process_new_item.php" method="POST" enctype="multipart/form-data">
					
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" name="name" id="name" required>
					</div>

					<div class="form-group">
						<label for="price">Price</label>
						<input type="number" class="form-control" name="price" id="price" min="1" required>
					</div>

					<div class="form-group">
						<label for="description">Description</label>
						<textarea type="number" class="form-control" name="description" id="description" rows="5" required></textarea>
					</div>

					<div class="form-group">
						<label for="category_id">Category</label>
						<select class="form-control" name="category_id" id="category_id">
							<?php

								$sql="SELECT * FROM categories";
								$categories = mysqli_query($conn, $sql);
								foreach($categories as $category){

									extract($category);
									echo "<option value='$id'>$name</option>";

								}

							?>
						</select>
					</div>

					<div class="form-group">
						<label for="image">Image</label>
						<input type="file" id="image" class="form-control" name="image" required>
					</div>

					<button type="submit" class="btn btn-block btn-orange mb-5">Add New Item</button>

				</form>

			</div>

		</div> <!-- end main row -->

	</div> <!-- end container -->

	<?php else: 
		header("Location: ./error.php");
	endif;?>

<?php } ?>