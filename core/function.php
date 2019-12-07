<?php

function checkUsr($email){
	include 'connector.php';
	$sql = "SELECT * FROM customer WHERE customer_email = '".$email."' ";
	$run = mysqli_query($connection , $sql);
	if(mysqli_num_rows($run) > 0){
		return true;
	}else{
		return false;
	}
}

function saveData($pass){
	$GLOBALS['passwrd'] = md5($pass);
}


function regUsr($name, $email, $mobile){
	include 'connector.php';
	$password = $GLOBALS['passwrd'];
	$sql = "INSERT INTO customer SET customer_email = '$email', password='$password'  , customer_name = '$name' , customer_mobile = '$mobile' , account_status = 'Active' ";
	$run = mysqli_query($connection , $sql);
	if($run){
		return true;
	}else{
		return false;
	}
}

function logUsr($email){
	include 'connector.php';
	$password = $GLOBALS['passwrd'];
	$sql = "SELECT * FROM customer WHERE customer_email = '".$email."' AND password = '".$password."' ";
	$run = mysqli_query($connection , $sql);
	if(mysqli_num_rows($run) > 0){
		return true;
	}else{
		return false;
	}
	
}
?>