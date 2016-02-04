<?php 
//Start the session
session_save_path("/aber/shc27/tmp");
session_start();

//If there is no cart, create it
if (empty($_SESSION['cart'])) {
	$_SESSION['cart'] = array();
}

//Store reference number of product
$idenL = $_GET['iden'];

//Stores number of product to be bought
$quant = $_GET['quantity'];

//Put into the array (or stack...) the id of the product with the quantity associated with it
$_SESSION['cart'][$idenL] = $quant;

//Send back to home page
header('Location: home.php');
?>
