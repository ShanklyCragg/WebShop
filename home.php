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
		<title>Home</title>
	</head>
	<body>
		<!--Create the navigation bar-->
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!--Set the flavour text to the title of my shop-->
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Shankly's Super Shop!</a>
				</div>
				<div>
					<!--An unordered list of pages-->
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="about.php">About</a></li>
						<li><a href="basket.php">Basket</a></li>
						<li><a href="checkout.php">Checkout</a></li>
						<li><a href="phpLogout.php">Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
<!---->
		<div class="row">
			<div class="col-md-2">
				<!--Create a panel to desplay logged in username-->
				<div class="panel panel-default">
					<!--Want to put it in the body of the panel-->
					<div class="panel-body">
						Welcome to my store:
						<?php
							//Get the name from the session and concatenate an exclamation mark
							//Not necessary to use concatenation but I have
							echo $_SESSION['uName'] . "!"; 
						?>
					</div>
				</div>
			</div>
            <div class="container">
                <div class="col-md-6">
					<!--Panel to do sorting of table-->
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group">
								<!--Use post to send information to php file-->
								<form name="sortVal" action="phpRadio.php" method="post">
									<input type="number" name="amount" placeholder="20">
									<div class="radio-inline">
										<label><input type="radio" name="Radio1" value="less">Less than</label>
									</div>
									<div class="radio-inline">
										<label><input type="radio" name="Radio1" value="more">More than</label>
									</div>
									<input type="submit" class="like" value="Sort">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>		
		<div class="row">
			<div class="col-md-8">
				<table class="table">
					<!--Prints out the headings for the catalogue-->
					<caption>See our wide selection of video games!</caption>
					<thead>
						<tr>
							<th>Title</th>
							<th>Platform</th>
							<th>Publisher</th>
							<th>Genre</th>
                            <th>PEGI</th>
							<th>Description</th>
							<th>Price</th>
							<th>Add</th>
						</tr>
					</thead>
					<tbody>
						<!--Depending on the value selected in the sort panel, do different SQL query on the catalogue-->
						<?php
							if ($_SESSION['sortVar'] == "less") {
								$res=pg_query ($conn, "SELECT ref, title, platform, publisher, genre, PEGI, description, price 
											FROM videogames 
											WHERE price <= " . $_SESSION['money'] . "
											ORDER BY price DESC");
							}
							else if ($_SESSION['sortVar'] == "more") {
								$res=pg_query ($conn, "SELECT ref, title, platform, publisher, genre, PEGI, description, price 
											FROM videogames 
											WHERE price >= " . $_SESSION['money'] . "
											ORDER BY price ASC");
							}
							else {
								$res=pg_query ($conn, "SELECT ref, title, platform, publisher, genre, PEGI, description, price 
											FROM videogames");							
							}
							while ($array=pg_fetch_row($res)) {
								
								//Every row a form, hidden field with ID, submit from = form, submit hidden field
						        echo "<tr>";
								
								//Start from 1 to avoid printing out the ref number (Which is at position 0)
						        for ($j = 1; $j < pg_num_fields($res); $j++) {
						            echo "<td>" . $array[$j] . "</td>";
						        }
								
								//This form holds the ref number of the product being added and if pressed will
								echo '<form name="AddItem" action="phpAddToCart.php" method="GET">';
									//It's the name you pass to the php page
									echo '<input type="hidden" name="iden" id="hiddenField" value="' . $array[0] . '">';
									echo "<td>" . '<input type="submit" class ="like" value="Add">' . '<input type="number" name="quantity" placeholder="" min="1" max="10" value="1">' . "</td>";
								echo '</form>';
								echo "</tr>";
						    }
						?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
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
							
							//For every item in my cart which has the ref and quantity
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
										echo '<input type="hidden" name="pageFrom" id="hiddenField" value="home">';						        
										echo "<td>" . '<input type="submit" class="like" value="Remove">' . "</td>";
									echo '</form>';
								echo "</tr>";	
								}
							}
						?>
					</tbody>
				</table>
				<?php
					echo "Your total cost is £" . $totalcost;
				?>
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
