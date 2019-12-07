<?php
require "../core/connector.php";
session_start();
if(!isset($_SESSION['username'])){
	echo '<script>alert("You must be logged in to place an order. Redirecting you to login page...")</script>';
	echo '<script>window.location="index.php"</script>';
}
if(!isset($_SESSION['cart']) || ($_SESSION['cart'] < 1)){
	echo '<script>alert("Please Add an item to cart first.")</script>';
	echo '<script>window.location="index.php"</script>';
}
?>

<?php
	if(isset($_SESSION['username']) && isset($_SESSION['cart']) && ($_SESSION['cart'] > 0)){
		$user =  $_SESSION['username'];
		$foods = array();
		$foods = $_SESSION['cart_id'];
		for($i=0; $i <= (count($foods) - 1); $i++){
			$dish_id = $foods[$i];
			
			$query1 = "SELECT * FROM dishes WHERE dish_id = '$dish_id' ";
			$query2 = "SELECT * FROM customer WHERE customer_email = '$user' ";
			$run1 = mysqli_query($connection , $query1);
			$run2 = mysqli_query($connection , $query2);
			$output1 = mysqli_fetch_array($run1);
			$output2 = mysqli_fetch_array($run2);
			
			$customer_id = $output2['customer_id'];
			$customer_location = $output2['customer_location'];
			$order_contents = $output1['dish_name'];
			$order_amount = $output1['dish_price'];
			$order_discount = '0';
			$order_status = 'PENDING';
			
			$query3 = "INSERT INTO orders SET customer_id = '$customer_id' , order_contents = '$order_contents' , order_amount = '$order_amount' ,  customer_location = '$customer_location' , order_discount = '$order_discount' , order_status = '$order_status' ";
			
			if(!mysqli_query($connection , $query3)){
				echo '<script>alert("An error Occurred!!")</script>';
				echo '<script>window.location = "index.php"; </script>';
			}else{
				unset($_SESSION['cart_id']);
				unset($_SESSION['cart']);
			}
		}
		
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>WELCOME</title>
        <link rel="stylesheet" type="text/css" href="../style/style.css" />
    </head>
    <body>
        <div id="header">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Order History</a></li>
                <li style="float: right;"><a href="#"><img src="../images/logout-icon.png" class="side-icon">&nbsp;&nbsp;Logout</a></li>
                <li style="float: right;"><a href="#"><img src="../images/account-icon.png" class="side-icon">&nbsp;&nbsp;Account</a></li>
                <li style="float: right;"><a href="#"><img src="../images/shopping-cart-icon.png" class="side-icon">&nbsp;&nbsp;Cart (<span>0</span>)</a></li>

            </ul>
        </div>
        <div id="wrapper">
            <div id="by-location">
            </div>
            <div id="advert">
                <section id="adv">			
                    <a href="#"><img src="../images/apple-store.png" class="adv"/></a>
                    <a href="#"><img src="../images/google-play.svg.png" class="adv" /></a>
                </section>
            </div>
			<div>
				<div class="food">
					<div><img src="../images/shopping_bag.png" width="200px" height="200px"/></div>
					<h1>THANK YOU FOR YOUR ORDER!!!</h1>
					<h3>YOUR FOOD WILL BE DELIVERED SHORTLY.</h3><br /><br />
					<p>*Please dont forget to subscribe to our newsletter to recieve daily updates about promotions and offers</p>
				</div>
			</div>
            </div>
        <div class="footer">
            <div id="subscribe">
                <form>
                    <h2 style="color: crimson">Subscribe to our newsletter!</h2>
                    <input type="email" required="required" class="subscribe-text" placeholder="Enter your e-mail"/>
                    <button type="button" class="subscribe-btn">SUBSCRIBE</button>
                </form>
            </div>
            <hr width="95%" />
            <div id="icons">
                <a href="#"><img src="../images/twitter.png" class="social"/></a>
                <a href="#"><img src="../images/instagram.png" class="social"/></a>
                <a href="#"><img src="../images/facebook.png" class="social" /></a>
                <a href="#"><img src="../images/gplus.png" class="social" /></a>
                <a href="#"><img src="../images/pinterest.png" class="social" /></a>
                <h5 style="color:#333333;">&nbsp;&copy;2016 Copyrights. All rights reserved</h5>
				<a href="#" class="help">Contact Us</a> | <a href="#" class="help">Privacy Policy</a> | <a href="#" class="help">Terms and Conditions</a> | <a href="#" class="help">FAQ</a>
            </div>
        </div>
    </body>
</html> 