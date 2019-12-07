<?php session_start(); ?>
<?php require '../core/connector.php'; ?>
<?php require '../core/function.php'; 
if(isset($_GET['action'])){
if ($_GET['action'] == "logout"){
	unset($_SESSION['username']);
	header("location: index.php");
}
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
                <section id="sub-by-location">
                    <h1 style="color: white; font-family: Century Gothic;">SEARCH FOR RESTURANTS IN YOUR AREA</h1>
                    <select class="location" onchange="validate()" id="location">
                        <option>Abia</option>
                        <option>Abuja</option>
                        <option>Adamawa</option>
                        <option>Akwa</option>
                        <option>Ibom</option>
                        <option>Anambra</option>
                        <option>Bauchi</option>
                        <option>Bayelsa</option>
                        <option>Benue</option>
                        <option>Borno</option>
                        <option>Cross</option>
                        <option>River</option>
                        <option>Delta</option>
                        <option>Ebonyi</option>
                        <option>Edo</option>
                        <option>Ekiti</option>
                        <option>Enugu</option>
                        <option>Gombe</option>
                        <option>Imo</option>
                        <option>Jigawa</option>
                        <option>Kaduna</option>
                        <option>Kano</option>
                        <option>Katsina</option>
                        <option>Kebbi</option>
                        <option>Kogi</option>
                        <option>Kwara</option>
                        <option>Lagos</option>
                        <option>Nasarawa</option>
                        <option>Niger</option>
                        <option>Ogun</option>
                        <option>Ondo</option>
                        <option>Osun</option>
                        <option>Oyo</option>
                        <option>Plateau</option>
                        <option>Rivers</option>
                        <option>Sokoto</option>
                        <option>Taraba</option>
                        <option>Yobe</option>
                        <option>Zamfara</option>
                    </select>
                    <select class="location" id="area" name="location">
                        <option class="areas" >Please Select</option>
                    </select>
					<script>
						function call(){
							var x = $("#area option:selected").val();
							var link;
							if(x == "Please Select" || x == "Location Unavailable"){
								link = '';
							}else{
								link = 'category.php?location=' + x;
							}
							return link;
						}
					</script>
                    <button type="button" onclick="window.location=call()" class="search-btn">SEARCH</button>
                </section>
            </div>
            <div id="advert">
                <section id="adv">			
                    <a href="#"><img src="../images/apple-store.png" class="adv"/></a>
                    <a href="#"><img src="../images/google-play.svg.png" class="adv" /></a>
                </section>
            </div>
            <div id="by-resturant">
				<h1 style="color: crimson; font-family: Century Gothic; text-align: center; padding-bottom: 50px;">SEARCH FOR YOUR FAVOURITE RESTAURANTS</h1>
                <table width="100%">
					<tr>
					<?php
					$out_query = "SELECT * FROM restaurants";
//					$def = "../";
					$run_out_query = mysqli_query($connection , $out_query);
					$counter = 0;
					
					while($output = mysqli_fetch_array($run_out_query)){
					
						
						$row =  $counter / 6;
						
						$img = $output['restaurant_logo'];
						$link = "category.php?restaurant=".$output['restaurant_name']; 
						if(is_int($row)){
							echo "</tr> \n";
							echo "<tr> \n";
						}
						
						echo "<td><a href='$link'><img src='$img' class='resturant' /></a></td> \n";
						$counter++;
					}
						echo "</tr>";
					?>
					
<!--
                    <tr>
                        <td><a href="#"><img src="../images/resturants/kfc.png" class="resturant"/></a></td>
                        <td><a href="#"><img src="../images/resturants/chikenRepublic.png" class="resturant"/></a></td>
                        <td><a href="#"><img src="../images/resturants/Dominos.png" class="resturant"/></a></td>
                        <td><a href="#"><img src="../images/resturants/tanterlizers.png" class="resturant"/></a></td>
                        <td><a href="#"><img src="../images/resturants/Mcdonalds.svg.png" class="resturant"/></a></td>
                        <td><a href="#"><img src="../images/resturants/mrbiggs.png" class="resturant"/></a></td>
                    </tr>
                    <tr>
                        <td><a href="#"><img src="../images/resturants/labule.jpg" class="resturant"/></a></td>
                        <td><a href="#"><img src="../images/resturants/thplace.png" class="resturant"/></a></td>
                        <td><a href="#"><img src="../images/resturants/shawarma.jpg" class="resturant"/></a></td>
                        <td><a href="#"><img src="../images/resturants/jevinik.jpg" class="resturant"/></a></td>
                        <td><a href="#"><img src="../images/resturants/chicken-capitol.png" class="resturant"/></a></td>
                        <td><a href="#"><img src="../images/resturants/Pizzarama.png" class="resturant"/></a></td>
                    </tr>
                    <tr>
                        <td><a href="#"><img src="../images/resturants/barcelos.jpg" class="resturant"/></a></td>
                        <td><a href="#"><img src="../images/resturants/kfc.png" class="resturant"/></a></td>
                        <td><a href="#"><img src="../images/resturants/kfc.png" class="resturant"/></a></td>
                        <td><a href="#"><img src="../images/resturants/kfc.png" class="resturant"/></a></td>
                        <td><a href="#"><img src="../images/resturants/kfc.png" class="resturant"/></a></td>
                        <td><a href="#"><img src="../images/resturants/kfc.png" class="resturant"/></a></td>
                    </tr>
-->
                </table>
            </div>
            <div id="by-dish">
				<h1 style="color: white; font-family: Century Gothic; text-align: center;padding-bottom: 50px;">SEARCH BY POPULAR CUISINES</h1>
                <table id="table-by-dish">
                    <tr>
                        <td><a href="category.php?cuisine=African" class="dish">African</a></td>
                        <td><a href="category.php?cuisine=American" class="dish">American</a></td>
                        <td><a href="category.php?cuisine=Asian" class="dish">Asian</a></td>
                        <td><a href="category.php?cuisine=Fruits" class="dish">Fruits</a></td>
                    </tr>
                    <tr>
                        <td><a href="category.php?cuisine=Cakes" class="dish">Bakery and Cakes</a></td>
                        <td><a href="category.php?cuisine=Breakfast" class="dish">Breakfast</a></td>
                        <td><a href="category.php?cuisine=Italian" class="dish">Italian</a></td>
                        <td><a href="category.php?cuisine=International" class="dish">International</a></td>
                    </tr>
                    <tr>
                        <td><a href="category.php?cuisine=Japanese" class="dish">Japanese</a></td>
                        <td><a href="category.php?cuisine=Lebanese" class="dish">Lebanese</a></td>
                        <td><a href="category.php?cuisine=Mediterranean" class="dish">Mediterranean</a></td>
                        <td><a href="category.php?cuisine=Chinese" class="dish">Chinese</a></td>
                    </tr>
                    <tr>
                        <td><a href="category.php?cuisine=Mexican" class="dish">Mexican</a></td>
                        <td><a href="category.php?cuisine=Middle Eastern" class="dish">Middle Eastern</a></td>
                        <td><a href="category.php?cuisine=Nigerian" class="dish">Nigerian</a></td>
                        <td><a href="category.php?cuisine=European" class="dish">European</a></td>
                    </tr>
                    <tr>
                        <td><a href="category.php?cuisine=Noodles" class="dish">Noodles</a></td>
                        <td><a href="category.php?cuisine=Pasta" class="dish">Pasta</a></td>
                        <td><a href="category.php?cuisine=Russian" class="dish">Russian</a></td>
                        <td><a href="category.php?cuisine=French" class="dish">French</a></td>
                    </tr>
                    <tr>
                        <td><a href="category.php?cuisine=Pizza" class="dish">Pizza</a></td>
                        <td><a href="category.php?cuisine=Salads" class="dish">Salads</a></td>
                        <td><a href="category.php?cuisine=Sandwiches" class="dish">Sandwiches</a></td>
                        <td><a href="category.php?cuisine=Greek" class="dish">Greek</a></td>
                    </tr>
                    <tr>
                        <td><a href="category.php?cuisine=Seafood" class="dish">Seafood</a></td>
                        <td><a href="category.php?cuisine=Shawarma" class="dish">Shawarma</a></td>
                        <td><a href="category.php?cuisine=Thai" class="dish">Thai</a></td>
                        <td><a href="category.php?cuisine=Healthy Foods" class="dish">Healthy Foods</a></td>
                    </tr>
                    <tr>
                        <td><a href="category.php?cuisine=Vegetarian" class="dish">Vegetarian</a></td>
                        <td><a href="category.php?cuisine=Vietnamese" class="dish">Vietnamese</a></td>
                        <td><a href="category.php?cuisine=Western" class="dish">Western</a></td>
                        <td><a href="category.php?cuisine=Home-made" class="dish">Home-made foods</a></td>
                    </tr>	
                    <tr>
                        <td><a href="category.php?cuisine=British" class="dish">British</a></td>
                        <td><a href="category.php?cuisine=Burger" class="dish">Burger</a></td>
                        <td><a href="category.php?cuisine=Business Deals" class="dish">Business Deals</a></td>
                        <td><a href="category.php?cuisine=Indian" class="dish">Indian</a></td>
                    </tr>	
                </table>
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