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

		swal.fire({
			text: "Are you sure you want to register with these details?",
			confirmButtonColor: "#FF673B",
			showCancelButton: true
		}).then( function(result){
			if(result.value == true){
				createUser();
			}
		})

		function createUser() {

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
							swal.fire({
								text: "User Created Successfully",
								confirmButtonColor: "#FF673B"
							}).then(function(result){
								window.location.replace("../../index.php");
							})
						}
					} //end #regiterBtn success

				}); //end #regiterBtn ajax
			
			} // end #regiterBtn if(validate_registration_form)

		}

	}); //end #registerBtn click

	//LOGIN and SESSION
	function loginNow(){
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
					swal.fire({
						text: "Please provide correct credentials",
						confirmButtonColor: "#FF673B"
					});
				} else {
					swal.fire({
						text: "Login Success",
						confirmButtonColor: "#FF673B"
					}).then( function(result){
						window.location.replace("../views/home.php");
					});	
				}
			}
		}); //end #loginBtn ajax
	}

	$("#username").on("keydown", function(e){
		if(e.which == 13 || e.keyCode == 13) {
			loginNow();
		}
	});

	$("#password").on("keydown", function(e){
		if(e.which == 13 || e.keyCode == 13) {
			loginNow();
		}
	});

	$("#loginBtn").click( function(e){

		loginNow();

	}); //end #loginBtn click

	//prep for add to cart
	$(document).on('click', '.add-to-cart', function(e){

		//to prevent default behavior and to override it with our own
		e.preventDefault();
		//prevent parent elements to be triggered
		e.stopPropagation();

		let item_id = $(e.target).attr("data-id");
		let item_name = $(e.target).next().val();
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
				if(data > 999) {
					$("#cart-count").html("999+");
				} else $("#cart-count").html(data);

				let swal_title = item_quantity + " " + item_name + "(s) added to cart";
				let swal_title2 = item_name + " completely removed from cart";

				if(item_quantity > 0) {
					swal.fire({
						title: swal_title,
						toast: true,
						timer: 2500,
						position: "top-end",
						confirmButtonColor: "#FF673B",
						customClass: "rounded-0"
					});
				} else {
					swal.fire({
						title: swal_title2,
						toast: true,
						timer: 2500,
						position: "top-end",
						confirmButtonColor: "#FF673B",
						customClass: "rounded-0"
					});
				}
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
				if(data > 999) {
					$("#cart-count").html("999+");
				} else $("#cart-count").html(data);
			}
		}); //end edit cart field ajax

	}); //end edit cart field

	//delete cart button
	$(document).on('click', '.itemRemove', function(e){

		let confirmation = swal.fire({
			text: "Are you sure you want to delete this item?",
			confirmButtonText: "Yes",
			confirmButtonColor: "#FF673B",
			showCancelButton: true,
			cancelButtonText: "No"
		}).then( function(result){

			if(result.value) {
				proceedDeletion();
			}

		});

		function proceedDeletion() {
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
				success: function(data) {
					if(data > 999) {
						$("#cart-count").html("999+");
					} else $("#cart-count").html(data);

					$(e.target).parents("tr").remove();

					getTotal();
					swal.fire({
						text: "Item deleted",
						confirmButtonColor: "#FF673B"
					}).then(function(result){
						window.location.replace("../views/cart.php");
					});
					
				}
			}); //end delete cart ajax
		}

	}); //end delete cart button

	//proceed with checkout btn
	$("#placeorderBtn").on("click", function(e){

		swal.fire({
			text: "Finalize order?",
			confirmButtonColor: "#FF673B",
			showCancelButton: true
		}).then( function(result){

			if(result.value == true){
				$("#placeorderForm").submit();
			}

		});

	}); //end proceed with checkout btn

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

		if(errors > 0) {
			return false;
		} else {
			return true;
		}
	}

	//submit profile form updates
	$(document).on( "click", "#update_info", function(e){

		if(validate_user_update()) {

			e.preventDefault();
			e.stopPropagation();

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

					$("#password").val("");

					if(data=="success") {
						swal.fire({
							text: "User Details Updated",
							confirmButtonColor: "#FF673B"
						})
					} else {
						swal.fire({
							text: "Invalid Password",
							confirmButtonColor: "#FF673B"
						})
					}

				}
			}); //end submit profile ajax

		} else {
			swal.fire({
				text: "All fields must be valid before continuing",
				confirmButtonColor: "#FF673B"
			})
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

					$("#change_cur_password").val("");
					$("#change_new_password").val("");
					$("#change_confirm_new_password").val("");

					if(data=="success"){
						swal.fire({
							text: "Password Changed Successfully",
							confirmButtonColor: "#FF673B"
						})
					} else {
						swal.fire({
							text: "Current Password Invalid",
							confirmButtonColor: "#FF673B"
						})
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

		swal.fire({
			text: "Are you sure you want to delete this item?",
			confirmButtonColor: "#FF673B",
			showCancelButton: true
		}).then( function(result){
			if(result.value == true) {

				swal.fire({
					text: "Item Deleted",
					confirmButtonColor: "#FF673B"
				}).then( function(){
					window.location.replace("../controllers/process_delete_item.php?id=" + id);
				})
			}
		})

	}); //end confirmation delete item

	//revoke/make admin
	$(document).on("click", ".grant_admin_btn", function() {

		function revoke_grant(id) {

			swal.fire({
				text: "Are you sure?",
				confirmButtonColor: "#FF673B",
				showCancelButton: true
			}).then( function(result){

				if(result.value==true){
					
					$.ajax({
						method: "POST",
						url: "../controllers/grant_admin.php",
						data: {
							id: id
						},
						beforeSend: function (){
							
						},
						success: function(data) {
							swal.fire({
								text: data,
								confirmButtonColor: "#FF673B",
							}).then( function(){
								window.location.replace("../views/users.php");
							});
							
						}
					}) // ajax revoke/make admin

				} //end if result

			}); // end swal.fire

		}

		const id = $(this).attr("data-id");
		revoke_grant(id);

	}); //end revoke/make admin

	//forgot password
	$("#fp_btn").click( function(){

		swal.fire({
			text: "Reset Password?",
			confirmButtonColor: "#FF673B",
			showCancelButton: true
		}).then( function(result){
			if(result.value == true) {
				reset_password();
			}
		})

		function reset_password() {
			const username = $("#fp_username").val();
			const firstname = $("#fp_firstname").val();
			const lastname = $("#fp_lastname").val();

			$.ajax({
				url: "../controllers/process_forgot_password.php",
				method: "POST",
				data: {
					fp_username: username,
					fp_firstname: firstname,
					fp_lastname: lastname
				},
				success: function(data) {
					if(data == "failed") {
						swal.fire({
							text: "Password Reset Failed",
							confirmButtonColor: "#FF673B"
						})
					} else {
						swal.fire({
							text: "Please check your e-mail for password",
							confirmButtonColor: "#FF673B"
						}).then( function(result){
							window.location.replace("../views/login.php")
						})
					}
				}
			}) //end ajax forgot password

		}

	}); //end forgot password

	//order complete
	$(document).on("click", ".order_complete_btn", function(e){

		e.preventDefault();
		e.stopPropagation();

		const id = $(this).attr("data-id");

		function order_complete(id) {

			swal.fire({
				text: "Change Status to Completed?",
				confirmButtonColor: "#FF673B",
				showCancelButton: true
			}).then( function(result) {
				if(result.value == true) {
					$.ajax({
						url: "../controllers/order_complete.php",
						method: "POST",
						data: {
							id: id
						},
						success: function() {
							swal.fire({
								text: "Order Status Changed to Completed"
							}).then( function(){
								window.location.replace("../views/orders.php");
							});
						}
					});//end ajax order complete
				}
			});

		}

		order_complete(id);

	}); //end order complete

	//order complete
	$(document).on("click", ".order_cancel_btn", function(e){

			e.preventDefault();
			e.stopPropagation();

			const id = $(this).attr("data-id");

			function order_cancel(id) {

				swal.fire({
					text: "Change Status to Canceled?",
					confirmButtonColor: "#FF673B",
					showCancelButton: true
				}).then( function(result) {
					if(result.value == true) {
						$.ajax({
							url: "../controllers/order_cancel.php",
							method: "POST",
							data: {
								id: id
							},
							success: function() {
								swal.fire({
									text: "Order Status Changed to Canceled"
								}).then( function(){
									window.location.replace("../views/orders.php");
								});
							}
						}); //end ajax order cancel
					}
				});

			}

			order_cancel(id);

	}); //end order complete

	//logout message
	$("#logout-message").ready( function(){

		const lg = $("#logout-message").html();

		if(lg == ""){
			swal.fire({
				text: "Logged-out successfully",
				confirmButtonColor: "#FF673B"
			});
		}
	}) //end logout message

	//added new item message
	$("#added-new-item").ready( function(){

		const ani = $("#added-new-item").html();

		if(ani == ""){
			swal.fire({
				text: "Added New Item",
				confirmButtonColor: "#FF673B"
			});
		}
	}) //end added new item message

	//edited message
	$("#edited-item").ready( function(){

		const ei = $("#edited-item").html();

		if(ei == ""){
			swal.fire({
				text: "Edited Item",
				confirmButtonColor: "#FF673B"
			});
		}
	}) //end edited item message

}); //end document ready