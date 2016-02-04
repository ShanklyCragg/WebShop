<?php 
//Starts the session
session_save_path("/aber/shc27/tmp");
session_start();

//Turns off error messages to the masses
error_reporting(E_ERROR | E_PARSE);

//If someone is logged in, take them to the home page, so as not to allow 2 logins at once
if (isset($_SESSION['login'])) {
	header('Location: ./home.php');
}
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="Width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<title>Login</title>
	</head>
	<body>

		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Shankly's Super Shop!</a>
				</div>
				<div>
					<ul class="nav navbar-nav">
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<div class="form-group">
				<!--Get javascript file-->
				<script src="./validate.js"></script>
				<form name="login" action="phpLogin.php" method="GET" onsubmit="return validate()">
					<!--<label for="user">Name:</label>    This wouldn't validate so I use a worksround below-->
					<b>Name:</b><input type="text" class="form-control" name="user" placeholder="Username:" required>
					<br/>
					<input type="submit" name="login" value="Login">
				</form>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				This is not a real web shop; it
				is created as part of my university coursework. Please do not attempt to buy anything
				from this site, or enter any real card details.
			</div>
			<div class="container">
				<p>
				<a href="http://validator.w3.org/check?uri=referer"><img
					src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>

					<a href="http://jigsaw.w3.org/css-validator/check/referer">
					<img style="border:0;width:88px;height:31px"
	    			src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
	    			alt="Valid CSS!" /></a>
				</p>
			</div>
			<div class="container">
				<p>
					This submission is my own work, except where clearly indicated.
					I understand that there are severe penalties for plagiarism and other unfair practice,
					which can lead to loss of marks or even the withholding of a degree.
					I have read the sections on unfair practice in the Students’ Examinations Handbook
					and the relevant sections of the current Student Handbook of the Department of
					Computer Science.
					I understand and agree to abide by the University’s regulations governing these
					issues
				</p>
			</div>
		</footer>
	</body>
</html>
