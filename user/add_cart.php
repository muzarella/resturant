<?php
	session_start();
	$id= $_GET['id'];
	if (!isset($_SESSION['cart_id'])) {
    	$_SESSION['cart_id'] = array();
	}
	array_push($_SESSION['cart_id'],$id);
	$_SESSION['cart'] = count($_SESSION['cart_id']);
	header('location: cart.php');
?>