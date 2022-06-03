<?php include "header.php"; ?>
<?php
// Check for empty fields
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Create the email and send the message
$to = "zakariachajae@gmail.com"; // Add your email address in between the "" replacing yourname@yourdomain.com - This is where the form will send a message to.
$subject = "Website Contact Form:  $name";
$body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email\n\nPhone: $phone\n\nMessage:\n$message";
$header = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$header .= "Reply-To: $email";	

if(!mail($to, $subject, $body, $header))
  http_response_code(500);
?>
<body>
<header class="major">
		<h2><a href="#">send complaint</a><h2>
			<section>
			<form method="post" action="">
			<div class="fields">
			<div class="field">
				<label for="name">name</label>
				<input type="text" name="name" id="name" />
			</div>
            <div class="field">
				<label for="subject">subject</label>
				<input type="text" name="subject" id="subject" />
			</div>
			<div class="field">
				<label for="email"></label>
				<input type="text" name="email" id="email" />
				</div>
				<div class="field">
				
				</div>
			</div>
										
			<button style="text-align:center;"> <a href="map.php"> chercher trajet</a> </button>
			</form>
			</section>
</body>
<?php include "footer.php" ?>