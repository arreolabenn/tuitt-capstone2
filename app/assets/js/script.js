$(document).ready( function() {

	function validate_registration_form() {
		
		let errors = 0;
		let username = $("#username").val();
		let password = $("#password").val();
		let confirmPassword = $("#confirmPassword").val();
		let firstname = $("#firstname").val();
		let lastname = $("#lastname").val();
		let email = $("#email").val();
		let address = $("#address").val();

		//username should be more than or equal to 10 characters
		if(username.length < 10) {
			$("#username").next().html("Username should be atleast 10 characters");
			errors++;
		} else {
			$("#username").next().html("");
		}

		//password should be atleast 8 characters
		if(password.length < 8) {
			$("#password").next().html("Please provide a stronger password");
			errors++;
		} else {
			$("#password").next().html("");
		}

		//confirm password
		if(password !== confirmPassword) {
			$("#confirmPassword").next().html("Passwords should match");
			errors++;
		} else {
			$("#confirmPassword").next().html("");
		}

		//email should include the @ symbol
		if(!email.includes("@")) {
			$("#email").next().html("Please provide a valid email");
			errors++;
		} else {
			$("#email").next().html("");
		}

		//address
		if(address == "") {
			$("#address").next().html("Please provide a valid address");
			errors++;
		} else {
			$("#address").next().html("");
		}

		//firstname
		if(firstname == "") {
			$("#firstname").next().html("Please provide a first name");
			errors++;
		} else {
			$("#firstname").next().html("");
		}

		//lastname
		if(lastname == "") {
			$("#lastname").next().html("Please provide a last name");
			errors++;
		} else {
			$("#lastname").next().html("");
		}

		if(errors > 0) {
			return false;
		} else {
			return true;
		}

	} //end validate_registration_form()

	$("#registerBtn").click( (e) => {

		if(validate_registration_form()) {
			
			let username = $("#username").val();
			let password = $("#password").val();
			let confirmPassword = $("#confirmPassword").val();
			let firstname = $("#firstname").val();
			let lastname = $("#lastname").val();
			let email = $("#email").val();
			let address = $("#address").val();

			$.ajax({
				url: "../controllers/create_user.php",
				method: "POST",
				data: {
					username: username,
					password: password,
					firstname: firstname,
					lastname: lastname,
					email: email,
					address: address
				},
				success: (data) => {

					if(data == "user_exists") {
						$("#username").next().html("Username already exists");
					} else {

					alert("user created successfully");
					window.location.replace("../../index.php");

					}
				} //end #regiterBtn success

			}); //end #regiterBtn ajax
		
		} // end #regiterBtn if(validate_registration_form)

	}); //end #registerBtn click

	//LOGIN and SESSION
	$("#loginBtn").click( function(e){

		let username = $("#username").val();
		let password = $("#password").val();

		$.ajax({
			url: "../controllers/authenticate.php",
			method: "POST",
			data: {
				username: username,
				password: password
			},
			success: function(data) {
				if(data == "login_failed") {
					$("#username").next().html("Please provide correct credentials");
				} else {
					window.location.replace("../views/home.php");
				}
			}
		});

	}); //end #loginBtn click

	//prep for add to cart
	$(document).on('click', '.add-to-cart', function(e){

		//to prevent default behavior and to override it with our own
		e.preventDefault();
		//prevent parent elements to be triggered
		e.stopPropagation();

		let item_id = $(e.target).attr("data-id");
		console.log(item_id);
		let item_quantity = parseInt($(e.target).prev().val());
		console.log(item_quantity);

		$.ajax({
			url: "../controllers/update_cart.php",
			method: "POST",
			data: {
				item_id: item_id,
				item_quantity: item_quantity
			},
			success: function(data) {
				$("#cart-count").html(data);
			}
		});

	});

}); //end document ready