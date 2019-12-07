<?php
session_start();
require "../core/connector.php";
require "../core/function.php";
if(isset($_GET['index'])){
	$index = $_GET['index'];
	unset($_SESSION['cart_id'][$index]);
	$_SESSION['cart'] = count($_SESSION['cart_id']);
	header('location: cart.php');
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
    <body>
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
					<table width="75%" class="food">
						<tbody>
							<?php
								$Total = 0;
								if(!isset($_SESSION['cart'])){

								}else{
									$num = $_SESSION['cart'];
									for($i = 0; $i <= $num - 1; $i++){
										$id = $_SESSION['cart_id'][$i];
										$query = "SELECT * FROM dishes WHERE dish_id = '$id' ";
										$sql = mysqli_query($connection , $query);
										while($out = mysqli_fetch_array($sql)){
											$nme = $out['dish_name'];
											$prc = $out['dish_price'];
											$cui = $out['dish_cuisine'];
											$Total += $out['dish_price'];
											$link = "window.location='cart.php?index=$i'";
											echo '<tr><td width="90%">';
											echo '<span class="dish-name">'.$nme.'</span><br />';
											echo '<span class="tag">Price: </span>$'.$prc;
											echo '&nbsp;&nbsp;&nbsp;<span class="tag">Cuisine: </span>'.$cui;
											echo '</td>';
											echo '<td><button type="button" onclick="'.$link.'">Remove from cart</button></td>';
											echo '</tr>';
											echo '<tr><td><hr/></td><td></td></tr>';
										}
									}
								}
							?>
						</tbody>
					</table>
					<span class="food">Total: $<?php echo $Total; ?></span><button type="button" onclick="window.location='checkout.php'">Check Out</button><br />
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