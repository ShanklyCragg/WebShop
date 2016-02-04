<?php 
//Start the session
session_save_path("/aber/shc27/tmp");
session_start();

//If a radio button has not been selected, don't do
if($_POST['Radio1'] != NULL) 
{

//Pass in the thing from home "sortVal" and store it in session "SortVar"
$_SESSION['sortVar'] = $_POST['Radio1'];

//Amount user entered
$_SESSION['money'] = $_POST['amount'];
}

//Send back to home page
header('Location: home.php');
?>
