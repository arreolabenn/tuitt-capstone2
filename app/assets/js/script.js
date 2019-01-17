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
		}); //end #loginBtn ajax

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
		if(isNaN(item_quantity) || item_quantity <= 0) {
			item_quantity = 0;
			$(e.target).prev().val(item_quantity);
		}
		console.log(item_quantity);

		$.ajax({
			url: "../controllers/update_cart.php",
			method: "POST",
			data: {
				item_id: item_id,
				item_quantity: item_quantity,
				update_from_cart_page: 0
			},
			success: function(data) {
				$("#cart-count").removeClass("animated bounce fast").delay(100).queue(function(next){
					$("#cart-count").addClass("animated bounce fast").dequeue();
				});
				
				if(data > 999) {
					$("#cart-count").html("999+");
				} else $("#cart-count").html(data);
			}
		}); // end prep for add to cart ajax

	}); // end prep for add to cart

	//getTotal function
	function getTotal() {
		let total = 0;
		$(".itemSubtotal").each( function(){
			total += parseFloat($(this).html());
		});
		$("#totalPrice").html(total.toFixed(2));
	} //end getTotal function

	//edit cart field
	$(".itemQuantity>input").on("input", function(e){

		let item_id = $(e.target).attr("data-id");
		let quantity = parseInt($(e.target).val());
		if(isNaN(quantity) || quantity <= 0) {
			quantity = 1;
			$(e.target).val(quantity);
		}
		let price = parseFloat($(e.target).parents("tr").find('.itemPrice').html());
		let subTotal = quantity * price;
		$(e.target).parents('tr').find('.itemSubtotal').html(subTotal.toFixed(2));

		getTotal();
		
		$.ajax({
			url: "../controllers/update_cart.php",
			method: "POST",
			data: {
				item_id: item_id,
				item_quantity: quantity,
				update_from_cart_page: 1
			},
			success: (data) => {
				$("#cart-count").removeClass("animated bounce fast").delay(100).queue(function(next){
					$("#cart-count").addClass("animated bounce fast").dequeue();
				});

				if(data > 999) {
					$("#cart-count").html("999+");
				} else $("#cart-count").html(data);
			}
		}); //end edit cart field ajax

	}); //end edit cart field

	//delete cart button
	$(document).on('click', '.itemRemove', function(e){

		e.preventDefault();
		e.stopPropagation();

		let item_id = $(e.target).attr("data-id");

		$.ajax({
			url: "../controllers/update_cart.php",
			method: "POST",
			data: {
				item_id: item_id,
				item_quantity: 0
			},
			beforeSend: function() {
				return confirm("Are you sure you want to delete?");
			},
			success: function(data) {
				$("#cart-count").removeClass("animated bounce fast").delay(100).queue(function(next){
					$("#cart-count").addClass("animated bounce fast").dequeue();
				});

				if(data > 999) {
					$("#cart-count").html("999+");
				} else $("#cart-count").html(data);

				$(e.target).parents("tr").remove();

				getTotal();

				window.location.replace("../views/cart.php");
			}
		}); //end delete cart ajax

	}); //end delete cart button

	function validate_user_update() {

		let errors = 0;
		const firstname = $("#firstname").val();
		const lastname = $("#lastname").val();
		const email = $("#email").val();
		const address = $("#address").val();
		const password = $("#password").val();

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

		//password should be atleast 8 characters
		if(password.length < 8) {
			$("#password").next().html("Password is required to make changes");
			errors++;
		} else {
			$("#password").next().html("");
		}

		console.log(errors);

		if(errors > 0) {
			return false;
		} else {
			return true;
		}
	}

	//submit profile form updates
	$(document).on( "click", "#update_info", function(e){

		e.preventDefault();
		e.stopPropagation();

		if(validate_user_update()) {

			const id = $("#user_id").val();
			const firstname = $("#firstname").val();
			const lastname = $("#lastname").val();
			const email = $("#email").val();
			const address = $("#address").val();
			const password = $("#password").val();

			$.ajax({
				method: "POST",
				url: "../controllers/update_profile.php",
				data: {
					user_id: id,
					firstname: firstname,
					lastname: lastname,
					email: email,
					address: address,
					password: password
				},
				success: function(data) {

					if(data=="success") {
						alert("changed user information");
					} else {
						alert("invalid password");
					}

				}
			}); //end submit profile ajax

		} //end validate_user_update()

	}); //end submit profile form updates

	function validate_password_update() {

		let errors = 0;
		const password = $("#change_cur_password").val();
		const new_password = $("#change_new_password").val();
		const confirm_new_password = $("#change_confirm_new_password").val();

		//password should be atleast 8 characters
		if(password.length < 8) {
			$("#change_cur_password").next().html("Enter a valid password");
			errors++;
		} else {
			$("#change_cur_password").next().html("");
		}

		//password != new password
		if(password == new_password || new_password.length < 8) {
			$("#change_new_password").next().html("Must be valid and not the same as old one");
			errors++;
		} else {
			$("#change_new_password").next().html("");
		}

		//retype new password
		if(new_password != confirm_new_password) {
			$("#change_confirm_new_password").next().html("Please retype new password");
			errors++;
		} else {
			$("#change_confirm_new_password").next().html("");
		}

		if(errors > 0) {
			return false;
		} else {
			return true;
		}

	}

	//submit password change
	$(document).on("click", "#update_password", function(e){

		if(validate_password_update()){
			e.preventDefault();
			e.stopPropagation();

			const id = $("#password_user_id").val();
			const password = $("#change_cur_password").val();
			const new_password = $("#change_new_password").val();
			
			$.ajax({
				method: "POST",
				url: "../controllers/update_password.php",
				data: {
					password_user_id: id,
					change_cur_password: password,
					change_new_password: new_password
				},
				success: function(data) {
					if(data=="success"){
						alert("password changed successfully");
						$("#change_cur_password").val("");
						$("#change_new_password").val("");
						$("#change_confirm_new_password").val("");
					} else {
						alert("password change failed");
					}
				}
			}); //end ajax password change

		}//end validate_password_update()

	}) //end submit password change

	//confirmation delete item
	$(document).on("click", ".delete-item-btn", function(e){

		e.preventDefault();
		e.stopPropagation();

		const id = $(this).attr("data-id");
		console.log(id);

		if(confirm("Are you sure you want to delete this item?")){
			window.location.replace("../controllers/process_delete_item.php?id=" + id);
		}

	}); //end confirmation delete item

}); //end document ready