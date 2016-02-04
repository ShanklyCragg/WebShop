<?php 
//Start the session
session_save_path("/aber/shc27/tmp");
session_start();

require('phpDatabaseConnection.php');

//Get the page that called this function
$pageFrom = $_GET['pageFrom'];

//Gets the ID of the product
$idenR = $_GET['iden'];

//Unset is the how you delete an item from an array
unset($_SESSION['cart'][$idenR]);

//Send back to home page
header('Location: ' . $pageFrom . '.php');
?>