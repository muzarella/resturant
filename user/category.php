<?php
require "../core/connector.php";
session_start();
if(isset($_GET['cuisine'])){
	$cuisine = $_GET['cuisine'];
}elseif(isset($_GET['location'])){
	$location = $_GET['location'];
}elseif(isset($_GET['restaurant'])){
	$restaurant = $_GET['restaurant'];
}else{
	header("location: index.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>WELCOME</title>
		<link rel="stylesheet" type="text/css" href="../portal.css" />
        <link rel="stylesheet" type="text/css" href="../style/style.css" />
		<script type="text/javascript" src="../script/script.js"></script>
		<script src="../jquery.min.js">
		</script>
		<script>
			$(document).ready(function(){
				$("#showbtn , #ashowbtn").click(function(){
					
					if( ($("#containerlogin").css('display')) != 'none') {
					$("#containerlogin").slideUp("slow");
				};
					
				$("#container").slideDown("slow");
				});
				
				$("#closebtn").click(function(){
					$("#container").slideUp("slow");
				});
			});
			$(document).ready(function(){
				$("#showloginbtn , #ashowloginbtn").click(function(){
					
				if( ($("#container").css('display')) != 'none') {
					$("#container").slideUp("slow");
				};
					
				$("#containerlogin").slideDown("slow");
				});
				
				$("#closeloginbtn").click(function(){
					$("#containerlogin").slideUp("slow");
				});
			});
		</script>
    </head>
    <body oncontextmenu="return false">
        <div id="header">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Order History</a></li>
				<?php
					if(!isset($_SESSION['username'])){
					echo '<li style="float: right;"><a href="#" id="showloginbtn"><img src="../images/logout-icon.png" class="side-icon">&nbsp;&nbsp;Login</a></li>';
					echo '<li style="float: right;"><a href="#" id="showbtn"><img src="../images/account-icon.png" class="side-icon">&nbsp;&nbsp;Sign Up</a></li>';
					}else{
					echo '<li style="float: right;"><a href="index.php?action=logout"><img src="../images/logout-icon.png" class="side-icon">&nbsp;&nbsp;Logout</a></li>';
					echo '<li style="float: right;"><a href="#"><img src="../images/account-icon.png" class="side-icon">&nbsp;&nbsp;Account</a></li>';
					}
				?>
				<?php 
						if(isset($_SESSION['cart'])){
							$cart =  $_SESSION['cart'];
						}else{
							$cart  = '0';
						}
					?>
                <li style="float: right;"><a href="cart.php"><img src="../images/shopping-cart-icon.png" class="side-icon">&nbsp;&nbsp;Cart (<span><?php echo $cart ?></span>)</a></li>

            </ul>
			<div class="container" id="container">
			<button type="button" class="btn-x" id="closebtn">X</button>
				<div>
					<h1 class="header-text">Sign up</h1>
					<div>
						<form method="post">
							<?php
								if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['area']) && isset($_POST['mobile']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['c-pass'])){
									
									$email = $_POST['email']; $pass = $_POST['pass'];
									$name = $_POST['fname'] . " " .$_POST['lname'];
									$mobile = $_POST['area']."".$_POST['mobile'];
									
									if(!CheckUsr($email)){
										 saveData($pass);
										if(regUsr($name , $email , $mobile)){
											$_SESSION['username'] = $email;
											header("location: index.php");
										}else{
											echo "<script>alert('An Error Has Occured')</script>";
										}
									}else{
										echo "<script>alert('Username already Exists')</script>";
									}
								}
							?>
								<div>
									<span>
										<input required="required" placeholder="First name" type="text" name="fname" class="short-text"/>
									</span>
									<span>
										<input required="required" placeholder="Last name" type="text" name="lname" class="short-text"/>
									</span>
								</div>
								<div>
									<span>
										<input required="required" value="234" type="text" class="area-code" name="area"/>
									</span>
									<span>
										<input required="required" placeholder="Mobile" type="text" class="mobile" name="mobile"/>
									</span>
								</div>
							<div>
								<input required="required" placeholder="Email" type="email" class="long-text" name="email" />
							</div>
							<div>
								<div>
									<input required="required" placeholder="Password" autocomplete="off" type="password" class="long-text" name="pass" />
								</div>
								<div>
									<input required="required" placeholder="Repeat password" autocomplete="off" type="password" class="long-text" name="c-pass"/>
								</div>
								</div>
							<div>
								<button type="submit" class="btn-login" name="sign-up">Sign up</button>
							</div>
						</form>
					</div>
					<hr width="80%" />
					<p class="norm-text">
						<span>Already Registered?</span><br />
						<a href="#" id="ashowloginbtn">Log in</a>
					</p>
				</div>
			</div>
			<div class="container" id="containerlogin">
				<button type="button" class="btn-x" id="closeloginbtn">X</button>
				<h1 class="header-text">Log in</h1>
				<form method="post">
							<?php
								if(isset($_POST['uemail']) && isset($_POST['upass'])){
									
									$uemail = $_POST['uemail'];
									$upass = $_POST['upass'];
									saveData($upass);
									if(logUsr($uemail)){
										$_SESSION['username'] = $uemail;
										header("location: index.php");
									}else{
										echo '<script>alert("Invalid Username and/or Password")</script>';
									}
								}
							?>
							<div>
								<input required="required" placeholder="Email" type="email" class="long-text" name="uemail" />
							</div>
							<div>
								<div>
									<input required="required" placeholder="Password" autocomplete="off" type="password" class="long-text" name="upass" />
								</div>
								</div>
							<div>
								<button type="submit" class="btn-login" name="log-in">Log in</button>
							</div>
						</form>
				<hr width="80%" />
					<p class="norm-text">
						<span>Are You New Customer?</span><br />
						<a href="#" id="ashowbtn">Create an Account</a>
					</p>
			</div>
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
				<div>
					<?php
						if(isset($cuisine)){
							$query = "SELECT * FROM dishes WHERE dish_cuisine = '$cuisine' ";
						}elseif(isset($location)){
							$query = "SELECT * FROM restaurants WHERE restaurant_area = '$location' ";
						}elseif(isset($restaurant)){
							$query = "SELECT * FROM restaurants WHERE restaurant_name = '$restaurant' ";
						}
					
						$run = mysqli_query($connection , $query);
					?>
					<table width="80%" class="food">
						<tbody>
							<?php
							if(isset($cuisine)){
								while($outputs =  mysqli_fetch_array($run)){
									$rest_id = $outputs['restaurant_id'];
									$query2 = "SELECT * FROM restaurants WHERE restaurant_id = '$rest_id' ";
									$cuis = $outputs['dish_cuisine'];
									$nme = $outputs['dish_name'];
									$prc = $outputs['dish_price'];
									$did = $outputs['dish_id'];
									$lnk = "window.location='add_cart.php?id=$did'";
									$run2 = mysqli_query($connection , $query2);
									$outputss = mysqli_fetch_array($run2);
									$rest_icon = $outputss['restaurant_logo'];

									echo "<tr> \n";
									echo "<td width='10%'> \n";
									echo "<span class='restaurant-image'><img src='$rest_icon'></span> \n";
									echo "<td> \n";
									echo "<span class='dish-name'>".$nme."</span><br /> \n";
									echo "<span class='tag'>Cuisine: </span>".$cuis."<br /> \n";
									echo "<span class='tag'>Price: </span>$".$prc." \n";
									echo "</td> \n";
									echo "<td class='price'><button type='button' class='order-btn' onclick=$lnk>Add to cart</button></td> \n";
									echo "</tr> \n";
								}
							}elseif(isset($location) || isset($restaurant)){
								while($outputs = mysqli_fetch_array($run)){
									$rest_id = $outputs['restaurant_id'];
									$rest_icon = $outputs['restaurant_logo'];
									$query2 = "SELECT * FROM dishes WHERE restaurant_id = '$rest_id' ";
									$run2 = mysqli_query($connection , $query2);
									while($outputss = mysqli_fetch_array($run2)){
										$cuis = $outputss['dish_cuisine'];
										$nme = $outputss['dish_name'];
										$prc = $outputss['dish_price'];
										$did = $outputss['dish_id'];
										$lnk = "window.location='add_cart.php?id=$did'";

										echo "<tr> \n";
										echo "<td width='10%'> \n";
										echo "<span class='restaurant-image'><img src='$rest_icon'></span> \n";
										echo "<td> \n";
										echo "<span class='dish-name'>".$nme."</span><br /> \n";
										echo "<span class='tag'>Cuisine: </span>".$cuis."<br /> \n";
										echo "<span class='tag'>Price: </span>$".$prc." \n";
										echo "</td> \n";
										echo "<td class='price'><button type='button' class='order-btn' onclick=$lnk>Add to cart</button></td> \n";
										echo "</tr> \n";
									}
								}
							}
							?>
<!--
							<tr>
								<td width="10%">
									<span class="restaurant-image"><img src="../images/resturants/kfc.png"></span>
								</td>
								<td>
									<span class="dish-name">Fried Chicken</span><br />
									<span class="tag">Cuisine: </span>Sauce<br />
									<span class="tag">Price: </span>$100
								</td>
								<td class="price"><button type="button" class="order-btn" onclick="window.location='add_cart.php?id=2'">Add to cart</button></td>
							</tr>
-->
						</tbody>
					</table>
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