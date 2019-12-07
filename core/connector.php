<?php

$host = "localhost";
$usr = "root";
$pass = "";
$db = "restaurant";

$connection  = mysqli_connect($host , $usr , $pass);
if($connection){
	$ch_db = mysqli_select_db($connection , $db);
	if(!$ch_db){
		//echo "Unable to connect to " . $db . " -- " . mysqli_error($connection);
		header("location: http://localhost/reserve.resturant.com/core/404.html");
	}
}else{
	//echo  "Unable to connect to ". $host . " using username: ". $usr . " and pass: " . $pass . " -- ". mysqli_error($connection);
	header("location: http://localhost/reserve.resturant.com/core/404.html");
}
?>