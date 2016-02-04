<?php 
//Starts the session
session_save_path("/aber/shc27/tmp");
session_start();

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
		<title>About</title>
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
						<li class="active"><a href="#">About</a></li>
						<li><a href="basket.php">Basket</a></li>
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
						Here is my about:
						<?php
							//Get the name from the session and concatenate an exclamation mark
							//Not necessary to use concatenation but I have
							echo $_SESSION['uName'] . "!"; 
						?>
					</div>
				</div>
			</div>
		</div>
        <div class="container">
            <div class="col-md-12">
				<!--Panel to do sorting of table-->
				<div class="panel panel-default">
					<div class="panel-body">
						<h1>
							Write-up
						</h1>
						<h2>
							Credits and Accreditation
						</h2>
							<p>
							First of all, I wish to mention the names of 2 peers who offered me valuable assistance in creating aspects of my website.
							Firstly I would like to thank Richard-Price-Jones (rij12) for guiding me through the use of bootstrap early on in the
							development phase. With his help I was able to get a front-end looking and working in the way I wanted in only hours of
							work instead of the days it may have taken otherwise.
							</p>
							<p>
							Secondly I would like to credit Oliver Earl (ole4) for his continued support and guidance on good standards within the web
							and PHP, and assistance with the use of javascript. Bugs and messy code would have been a lot more prevelent if not for his
							helping hand.
							</p>
							<p>
							I also with to credit the bootstrap framework which I used to style my website with
						<h2>
						Thoughts and feelings
						</h2>
							<p>
							I will talk about the assignment following the order of the spec, starting with sessions and finishing with validation
							</p>
							<p>
							1)	I found the use of sessions to be easy to adapt to when thinking of them as essentially global variables, this class 
							with values that was available anywhere in my website by simply starting it. Maintaining the session throughout until the 
							user selected logout was surely the easiest part of this assignments, as the commands are simple and do not interact dynamically 
							with any code. I feel confidant using session going into the future thanks to seeing how useful they can be with so little effort.
							</p>
							<p>
							2)	Using pg_connect to connect to the database, and pg_query to give it postgres commands, I was able to successfully list all 
							the products into a table. With the use of some radio buttons and a number input field, the user is able to specify an amount of 
							money, and list all the products greater than or equal to, or less than or equal to the amount specified. I include the amount 
							specified, as it made sense to me that when I user has for example £20 to spend, they would enter “Less than: £20”. So including 
							products that cost £20 seemed like the sensible thing to do.
							</p>
							<p>
							3)	From the table of products, the user is able to select a quantity of the item they wish to purchase, the minimum value being 
							1, and the maximum value being 10. I think seem like a fair range, perhaps even a little lenient at the top end side for a video 
							game shop. If this were a soda shop for example, the max would be set a lot higher, as bulk purchases are more common in that area
							of retail. The user can remove items from their basket either on the dynamically updated basket section on the home page, or they 
							can access the “basket” page and remove items there.  Removing is done simply by clicking the “remove” button, which removes the 
							product wholly, even if there was a quantity of 6 and they wanted 5, pressing the remove button would remove all 6. To improve this 
							in future I would allow the user to manually enter the amount they wanted to remove. A glaring fault in this section is that when a
							product is added, if the user tries to add it again, the 1st quantity is overwritten by the 2nd quantity entered. I would fix this
							by doing a javascript check through the basket array to see if the “ref” already existed, and if so to then just add the quantities.
							</p>
							<p>
							4)	The validation is done via a pattern=”xxx” attribute in the input fields, as I was having problems getting a javascript page to
							work (It seemingly wasn’t getting called at all, and I am still unsure as to why when it was functionally identical to my login 
							validate.js except for taking in 2 values instead of 1. I imagine it was some silly typo or misspelling or capitalisation), so 
							changed what I originally wanted to do to a less well done (But functional) implementation. I would prefer to do these checks 
							via javascript if I was to improve this section. The validation does work, although strange email addresses are accepted by the 
							default HTML5 email tag. I have included the provided statement in all of my pages, and display it at the top and bottom of my 
							checkout page.
							</p>
							<p>
							5)	I tried to mention along the way about what problems I faced and how I would fix them, I will mention here things which have
							not come up yet. The use of PDO interested me when our guest lecturer gave a presentation on the use of it, it seems like a very
							clean way of storing information regarding a shopping basket, since an item is essentially an object with a reference number and
							a quantity, but I already felt lacking in confidence when it came to web development coming in, so stuck to what I already knew or
							at least had some experience in prior to get a functioning website. If I had finished with a large amount of time left, I would have
							loved to have tried implementing PDO into my website.
							</p>
							<p>
							6)	Thanks to bootstrap making my website look professional was a far easier task than it had been in the past when having to write
							our own style sheets. While bland (at least in my implementation of it) it serves its purpose and gets the information across is a
							way that isn’t distracting to the way the website functions. I did not use any images other than those provided for the validation 
							links, so have not had to worry about copyright.
							</p>
							<p>
							7)	My HTML validates just fine, and passes on all of my pages, 
							<a href="http://stackoverflow.com/questions/21166019/w3c-validator-css3-and-bootstrap"> but the bootstrap framework does not validate
							by CSS3 standards according to StackOverflow</a>, and I couldn’t find much further information on the topic. It appears to be because CSS3
							does not look out for the latest features which bootstrap includes.
							</p>
					</div>
				</div>
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
