<?php 
//This imports the connection to thedatabase, and also
//starts the session, so no need to start the session here
require('phpDatabaseConnection.php');

//Turns off error messages to the masses
error_reporting(E_ERROR | E_PARSE);

//If someone is logged in, take them to the home page, so as not to allow 2 logins at once
if (!isset($_SESSION['login'])) {
    header('Location: index.php');
	
}
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="Width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<title>Basket</title>
	</head>
	<body>

		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Shankly's Super Shop!</a>
				</div>
				<div>
					<ul class="nav navbar-nav">
						<li><a href="index.php">Home</a></li>
						<li><a href="#">About</a></li>
						<li class="active"><a href="">Basket</a></li>
						<li><a href="checkout.php">Checkout</a></li>
						<li><a href="phpLogout.php">Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="row">
			<div class="col-md-2">
				<!--Create a panel to desplay logged in username-->
				<div class="panel panel-default">
					<!--Want to put it in the body of the panel-->
					<div class="panel-body">
						This is your basket:
						<?php
							//Get the name from the session and concatenate an exclamation mark
							//Not necessary to use concatenation but I have
							echo $_SESSION['uName'] . "!"; 
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
			</div>
			<div class="col-md-6">
				<table class="table">
					<caption>This is what you've currently bought!</caption>
					<thead>
						<tr>
							<th>Title</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Remove</th>
						</tr>
					</thead>   
					<tbody>
					
						<?php
							//For testing my array contents
							//print_r($_SESSION);
							
							//
							foreach($_SESSION['cart'] AS $idenL => $quant) {
								$res=pg_query ($conn, 	"SELECT ref, title, price
														FROM videogames 
														WHERE ref =  '$idenL' ");
								while ($array=pg_fetch_row($res)){						
									$totalcost = $totalcost + $array[2] * $_SESSION['cart'][$idenL];
									
								echo "<tr>";
									echo "<td>" . $array[1] . "</td>";
									echo "<td>" . $array[2] . "</td>";					
									echo "<td>" . $_SESSION['cart'][$idenL] . "</td>";									
									echo '<form name = "RemoveItem" action="phpRemoveFromCart.php" method="GET">';
										echo '<input type="hidden" name="iden" id="hiddenField" value="' . $array[0] . '">';						        
										echo '<input type="hidden" name="pageFrom" id="hiddenField" value="basket">';						        
										echo "<td>" . '<input type="submit" class="like" value="Remove">' . "</td>";
									echo '</form>';
								echo "</tr>";	
								}
							}
						?>
					</tbody>
				</table>
				<!--Print out the total cost-->
				<?php
					echo "Your total cost is £" . $totalcost;
				?>
			</div>
		</div>
		<footer class="footer">
		<div class="container">
			</br>
			</br>
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
