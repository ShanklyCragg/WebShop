<?php
//Starts the session
session_save_path("/aber/shc27/tmp");
session_start();

//Connects to the database
$conn = pg_connect("host=db.dcs.aber.ac.uk port=5432
dbname=teaching user=csguest password=r3p41r3d");
?>