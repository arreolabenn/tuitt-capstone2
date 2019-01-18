<?php

	session_start();

	require_once("connect.php");

	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	//Load Composer's autoloader
	require '../../vendor/autoload.php';

	//Paypal Classes
	// required paypal classes
	use PayPal\Rest\ApiContext;
	use PayPal\Auth\OAuthTokenCredential;
	use PayPal\Api\Payer;
	use PayPal\Api\Item;
	use PayPal\Api\ItemList;
	use PayPal\Api\Details;
	use PayPal\Api\Amount;
	use PayPal\Api\Transaction;
	use PayPal\Api\RedirectUrls;
	use PayPal\Api\Payment;
	require("paypal/start.php");

	function generate_new_transaction_number() {
		$ref_number = "";
		$source = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F');

		for($i=0; $i<16; $i++){
			//generates a random number
			$index = rand(0, count($source)-1);

			//append random character
			$ref_number .= $source[$index];
		}

		$today = getdate();
		return $ref_number.'-'.$today[0]; //seconds since unix epoch

	}

	$user_id = $_SESSION["user"]["id"];
	$purchase_date = date("Y-m-d G:i:s"); //G is for 12 hour format, i (minutes with leading zeroes), s (seconds with leading zeroes)
	$status_id = 1;
	$payment_mode_id = $_POST["payment_mode"];
	$address = $_POST["addressLine1"];


	//!!!PAYMENT MODE FOR COD!!!
	if($payment_mode_id == 1) {
		$transaction_number = generate_new_transaction_number();
		$_SESSION["new_txn_number"] = $transaction_number;

		//create a new order
		$sql = "INSERT INTO orders(user_id, transaction_code, purchase_date, status_id, payment_mode_id) VALUES ('$user_id', '$transaction_number', '$purchase_date', '$status_id', '$payment_mode_id')";
		$result = mysqli_query($conn, $sql);

		//get the latest order ID to associate items for orders_items table
		$new_order_id = mysqli_insert_id($conn);

		if($result) {
			foreach($_SESSION['cart'] as $item_id => $qty) {
				//get the price of current item
				$sql = "SELECT price FROM items WHERE id='$item_id'";
				$result = mysqli_query($conn, $sql);

				//fetch data from the query
				$item = mysqli_fetch_assoc($result);

				//create a new order item
				$sql = "INSERT INTO order_items(order_id, item_id, quantity, price) VALUES ('$new_order_id', '$item_id', '$qty', '".$item["price"]."')";

				//execute the order query
				$result = mysqli_query($conn, $sql);
			}
		}

		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

		$message = "";
		$message .= "<h3>Reference Number: " . $transaction_number . "</h3>";
		$message .= "
		<table style='border: 1px solid grey; border-collapse: collapse'>
			<thead>
				<th colspan='2' style='border: 1px solid grey; height: 50px; padding: 5px'>Item Name</th>
				<th style='border: 1px solid grey; height: 50px; padding: 5px'>Item Price</th>
				<th style='border: 1px solid grey; height: 50px; padding: 5px'>Item Quantity</th>
				<th style='border: 1px solid grey; height: 50px; padding: 5px'>Item Subtotal</th>
			</thead>
			<tbody>";
				foreach($_SESSION["cart"] as $id => $qty) {
				$sql2 = "SELECT * FROM items WHERE id=$id";
				$result = mysqli_query($conn, $sql2);
				$item = mysqli_fetch_assoc($result);
		$message .= '
				<tr>
					<td colspan="2" style="border: 1px solid grey; height: 50px; padding: 5px"">'. $item["name"]. '</td>
					<td style="border: 1px solid grey; height: 50px; padding: 5px"">' . $item["price"] . '</td>
					<td style="border: 1px solid grey; height: 50px; padding: 5px">' . $qty . '</td>
					<td style="border: 1px solid grey; height: 50px; padding: 5px">' . number_format($item["price"] * $qty, 2, ".", "") . '</td>';
		$message .= "
				</tr>";
				}
		$message .= "
			</tbody>
		</table>";

		$message .= "Shipping address: $address";
		$message .= "<p><small>This is an automatically generated email – please do not reply to it.</small></p>";


		$staff_email = "wheresthefoodphilippines@gmail.com";
		$staff_name = "Where's The Food?";
		$customer_email = $_SESSION["user"]["email"];
		$customer_name = $_SESSION["user"]["firstname"] . " " . $_SESSION["user"]["lastname"];
		$email_subject = "Where's The Food? | Order Details";
		$email_body = $message;

		try {
		    //Server settings
		    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = $staff_email;                 // SMTP username
		    $mail->Password = '09252012';                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom($staff_email, $staff_name);
		    $mail->addAddress($customer_email, $customer_name);     // Add a recipient

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $email_subject;
		    $mail->Body    = $email_body;
		    $mail->AltBody = $email_body;

		    $_SESSION["cart"] = [];
		    header("location: ../views/confirmation.php");

		    $mail->send();
		    echo 'Message has been sent';
		} catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}

		mysqli_close($conn);

	}

	//!!!PAYMENT MODE FOR PAYPAL!!!
	else {

		$_SESSION['address'] = $_POST['addressLine1'];
	    $payer = new Payer();
	    $payer->setPaymentMethod('paypal');

	    $total = 0;
	    $items = [];
	    foreach($_SESSION['cart'] as $id => $quantity){
	        $sql = "SELECT * FROM items WHERE id =$id";
	        $result = mysqli_query($conn, $sql);
	        $item = mysqli_fetch_assoc($result);
	        extract($item);
	        $total += $price*$quantity;
	        $indiv_item = new Item();
	        $indiv_item->setName($name)
	                ->setCurrency('PHP')
	                ->setQuantity($quantity)
	                ->setPrice($price);
	        $items[] = $indiv_item;        
	    }

	    $item_list = new ItemList();
	    $item_list->setItems($items);

	    $amount = new Amount();
	    $amount->setCurrency("PHP")
	        ->setTotal($total);

	    $transaction = new Transaction();
	    $transaction ->setAmount($amount)
	                ->setItemList($item_list)
	                ->setDescription('Payment for Qstore Purchase')
	                ->setInvoiceNumber(uniqid("Qstore_"));

	    $redirectUrls = new RedirectUrls();
	    $redirectUrls
	        ->setReturnUrl('https://tuitt-wtf.herokuapp.com/app/controllers/pay.php?success=true')
	        ->setCancelUrl('https://tuitt-wtf.herokuapp.com/app/controllers/pay.php?success=false');

	    $payment = new Payment();
	    $payment->setIntent('sale')
	        ->setPayer($payer)
	        ->setRedirectUrls($redirectUrls)
	        ->setTransactions([$transaction]);

	    try{
	        $payment->create($paypal);
	    } catch(Exception $e){
	        die($e->getData());
	    }

	    $approvalUrl = $payment->getApprovalLink();
	    header('location: '.$approvalUrl);    


	}

	


?>