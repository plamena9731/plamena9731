<?php
session_start([
    'cookie_httponly' => true
]);
require_once '../../config/db.php';
require_once '../../config/settings.php';
require_once '../../functions.php';

if (isset($_POST['submit'])) {
	$email = '';
	if (isset($_POST['email'])) {
		$email = trim($_POST['email']);
	}
	
	$password = '';
	if (isset($_POST['password'])) {
		$password = trim($_POST['password']);
	}

	$errors = [];
	$user = [];

	if (!mb_strlen($email)) {
		$errors['email'] = 'Въвете мейл адрес';
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Невалиден мейл адрес';
	} else {
		$sql = "SELECT
			`id`,
			`country_id`,
			`type`,
			`first_name`,
			`last_name`,
			`email`,
			`username`,
			`age`,
			`password`,
			`created_at`,
			`updated_at`
		FROM `".TABLE_USERS."`
		WHERE `email` = '".mysqli_real_escape_string($conn, $email)."'
		";

		if ($result = mysqli_query($conn, $sql)) {
			$user = mysqli_fetch_assoc($result);
		}
	}

	if (!mb_strlen($password)) {
		$errors['password'] = 'Въведете парола';
	} else if (mb_strlen($password) < 8) {
		$errors['password'] = 'Паролата трябва да е повече от 8 символа';
	}

	if (empty($user)) {
		$errors['user'] = ' потребителя не съществува';
	}

	if (!count($errors)) {
		if (password_verify($password, $user['password'])) {
			$_SESSION['user'] = [
				'id' => $user['id'],
				'username' => $user['username'],
				'first_name' => $user['first_name'],
				'last_name' => $user['last_name']
			];
			redirect ('profile');
		} else {
			echo "паролите не съвпадат";
		}
	}
}








?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Pooled Admin Panel Category Flat Bootstrap Responsive Web Template | Sign In :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="css/jquery-ui.css"> 
<!-- jQuery -->
<script src="js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
</head> 
<body>
	<div class="main-wthree">
	<div class="container">
	<div class="sin-w3-agile">
		<h2>Sign In</h2>
		<form action="#" method="post" enctype = "multipart/form-data">
			<div class="username">
				<span class="username">Username:</span>
				<input type="text" name="name" class="name" placeholder="" required="">
				<div class="clearfix"></div>
			</div>
			<div class="password-agileits">
				<span class="username">Password:</span>
				<input type="password" name="password" class="password" placeholder="" required="">
				<div class="clearfix"></div>
			</div>
			<div class="rem-for-agile">
				<input type="checkbox" name="remember" class="remember">Remember me<br>
				<a href="#">Forgot Password</a><br>
			</div>
			<div class="login-w3">
					<input type="submit" class="login" value="Sign In">
			</div>
			<div class="clearfix"></div>
		</form>
				<div class="back">
					<a href="index.html">Back to home</a>
				</div>
				<div class="footer">
					<p>&copy; 2016 Pooled . All Rights Reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
				</div>
	</div>
	</div>
	</div>
</body>
</html>