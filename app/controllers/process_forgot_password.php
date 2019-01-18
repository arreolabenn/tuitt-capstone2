<?php 

	session_start();
	require_once("connect.php");

	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	//Load Composer's autoloader
	require '../../vendor/autoload.php';

	function verify() {

		global $conn;
		$username = $_POST["fp_username"];
		$firstname = $_POST["fp_firstname"];
		$lastname = $_POST["fp_lastname"];

		$sql_check = "SELECT username, firstname, lastname FROM users WHERE username='$username' && firstname='$firstname' && lastname='$lastname'";
		$query_check = mysqli_query($conn, $sql_check);
		$assoc_check = mysqli_fetch_assoc($query_check);

		$my_check = $assoc_check > 0 ? 1 : 0;
		return $my_check;
	}

	if(verify()) {

		$username = $_POST["fp_username"];

		$sql = "SELECT id, firstname, lastname, email, password FROM users WHERE username='$username'";
		$query = mysqli_query($conn, $sql);
		$assoc = mysqli_fetch_assoc($query);
		extract($assoc);

		function password_generator(){

			$new_password = "";
			$source = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F');

			for($i=0; $i<10; $i++){
				//generates a random number
				$index = rand(0, count($source)-1);

				//append random character
				$new_password .= $source[$index];
			}

			return $new_password;
		}

		$new_password = password_generator();
		$new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);

		$sql2 = "UPDATE users SET password='$new_password_hash' WHERE id='$id'";
		mysqli_query($conn, $sql2);

		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

		$message = "<p>Here's your new password: " . $new_password . "</p>" . 
				   "<small>After logging in, please change your password</small>";

		$staff_email = "wheresthefoodphilippines@gmail.com";
		$staff_name = "Where's The Food?";
		$customer_email = $email;
		$customer_name = $firstname . " " . $lastname;
		$email_subject = "Where's The Food? | Password Reset";
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

		    $mail->send();
		    echo 'Message has been sent';
		} catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}

	} else {
		echo "failed";
	}