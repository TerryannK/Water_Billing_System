<?php
//connect to db

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ninja_pizza');
//connect
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_NAME);
//check connection
if (!$link) {
	die("ERROR: could not connect."  . mysqli_connect_error());



}



?>