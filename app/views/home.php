<?php
	$pageTitle = "Home";
	require_once("../partials/template.php");
?>

<?php function get_page_content() { ?>
<?php global $conn ?>

	<?php if(isset($_SESSION["status"]) && $_SESSION["status"] == "logout"): ?>
		<span id="logout-message"></span>
	<?php 
		unset($_SESSION["status"]);
		endif; 
	?>

	<div class="container">
		
		<div class="row">

			<div class="col-12">
				<div class="welcome-container p-3 mt-3">
				<div class="welcome-bg">
					<h1 class="text-dirty-white bg-orange p-1 d-inline">WHERE'S THE FOOD?</h1>
				</div>
			</div>
			</div>

		</div>

	</div> <!-- end container -->

<?php } ?>