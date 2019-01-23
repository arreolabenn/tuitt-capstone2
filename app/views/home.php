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
				<div class="shipping-text mt-3"></div>
				<div class="welcome-container p-3 mb-5">
					<div class="welcome-bg">
						<h1 class="text-dirty-white bg-orange p-1 d-inline">WHERE'S THE FOOD?</h1>
					</div>
				</div>
			</div>

			<div class="col-12">
				<h2 class="text-center mb-3">CUSTOMER FAVORITES</h2>

				<div class="row">

					<?php
						$sql = "SELECT * FROM items ORDER BY price LIMIT 4";
						$query = mysqli_query($conn, $sql);

						foreach($query as $item){
							extract($item);
					?>

					<div class="col-6 col-md-3">
						<div class="card h-100 card-adjust">
							<img src="<?php echo $image_path ?>" class="card-img-top">
							<div class="card-body">
								<h4 class="text-center card-title"><small><?php echo $name ?></small></h4>
							</div>
						</div>
					</div>

					<?php } ?>

				</div>

			</div>

			<div class="col-md-4">
				<h2 class="mb-3">ABOUT</h2>
				<p class="text-justify mb-5"><strong>Where's The Food?</strong> is a Manila-based company that delivers home cooked filipino food to their customer's doorsteps. It was founded by Alyssa Marie Cape who wanted to make home cooked meals available to busy employees.</p>
			</div>

			<div class="col-md-4">
				<h2 class="mb-3">MISSION</h2>
				<p class="text-justify mb-5">Where's The Food? has a mission to sell delicious and remarkable Filipino food. That the food we sell meets the highest standards of quality, freshness and seasonality.</p>
			</div>

			<div class="col-md-4">
				<h2 class="mb-3">VISION</h2>
				<p class="text-justify mb-5">To maintain a profitable operation that will continue our tradition of quality Filipino dining, at a reasonable cost, in a comfortable atmosphere, with exceptional service. </p>
			</div>

			<div class="col-12">
				<h2 class="text-center mb-3">DINE WITH US</h2>
				<div style="width: 100%" class="mb-5"><iframe width="100%" height="250" src="https://maps.google.com/maps?width=100%&amp;height=250&amp;hl=en&amp;coord=14.574387199999999, 121.00157439999998&amp;q=2437%20Taal%20St.%20Malate%20Manila+(Where's%20The%20Food%3F)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>
			</div>

		</div>

	</div> <!-- end container -->

<?php } ?>