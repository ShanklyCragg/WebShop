<?php
//Start the session
session_save_path("/aber/shc27/tmp");
session_start();
//Delete the session
session_destroy();

//Send the user back to the login page
header('Location: index.php');
?>