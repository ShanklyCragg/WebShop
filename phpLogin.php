<?php
//Starts the session
session_save_path("/aber/shc27/tmp");
session_start();

//Checks if a name has been entered before attempting to login
if (isset($_GET['login'])) {
	//If it has, then the user can login
	$_SESSION['login'] = true;
	//Stores the users name in the session
	$_SESSION['uName'] = $_GET['user'];
	//Send user to home page
	header('Location: home.php');
} else {
	//If no name was entered, send user back to login page
	header('Location: index.php');
}
?>