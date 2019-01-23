<?php
	session_start();	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, shrink-to-fit=no">
	<meta http-equiv="X_UA-Compatible" content="IE-Edge">

	<title><?php echo $pageTitle ?></title>

	<!-- FAV ICON -->
	<link rel="icon" type="image/png" href="../assets/images/essentials/fav.png">

	<!-- FONT -->
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">

	<!-- FONTAWESOME -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	<!-- ANIMATE CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<!-- EXTERNAL CSS -->
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	
	<!-- JQUERY -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- POPPER -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

	<!-- BOOTSTRAP JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

	<!-- SWEETALERT -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@8.0.1/dist/sweetalert2.all.min.js"></script>

</head>
<body class="<?php 
				if($pageTitle == "Login"): 
					echo "login-bg";
				elseif($pageTitle == "Forgot Password"): 
					echo "fp-bg";
				elseif($pageTitle == "Register"): 
					echo "register-bg";
				elseif($pageTitle == "Confirmation" || $pageTitle == "Error"):
					echo "confirmation-bg";
				endif; 
			?>">
	
	<?php
		require_once("header.php");

		require_once("../controllers/connect.php");
		
		get_page_content();
		mysqli_close($conn);

		require_once("footer.php");
	?>

</body>
</html>