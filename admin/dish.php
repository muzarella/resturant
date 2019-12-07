<?php
	session_start();
	require '../core/connector.php' ;
	if(!isset($_SESSION['administrator'])){
		header("location: panel.php");
	}
if(isset($_GET['action'])){
if ($_GET['action'] == "logout"){
	unset($_SESSION['administrator']);
	header("location: panel.php");
}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>WELCOME</title>
		<link rel="stylesheet" type="text/css" href="../style/main.css" />
		<script type="text/javascript" src="../script/script.js"></script>
	</head>
	<body>
		<div id="main">
			<div id="mySidenav" class="sidenav">
  				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  				<a href="#" class="opt"><img src="../images/about-icon.png" class="side-icon">&nbsp;&nbsp;&nbsp; About</a>
  				<a href="services.php" class="opt"><img src="../images/services-icon.png" class="side-icon">&nbsp;&nbsp;&nbsp; Services</a>
				<a href="dish.php" class="opt"><img src="../images/services-icon.png" class="side-icon">&nbsp;&nbsp;&nbsp; Manage Dishes</a>
  				<a href="restaurant.php" class="opt"><img src="../images/shop-icon.png" class="side-icon">&nbsp;&nbsp;&nbsp; Manage Restauants</a>
  				<a href="clients.php" class="opt"><img src="../images/client-icon.png" class="side-icon">&nbsp;&nbsp;&nbsp; Clients</a>
  				<a href="contact.php" class="opt"><img src="../images/contact-icon.png" class="side-icon">&nbsp;&nbsp;&nbsp;Contact</a>
			</div>
			<div id="header">
			<ul>
  				<li><a class="active" href="javascript:void(0)" onclick="openNav()"><img src="../images/hambuger.png" height="20px" width="20px"/></a></li>
  				<li><a href="index.php">Dashboard</a></li>
  				<li style="float: right;"><a href="?action=logout">Logout</a></li>
 
			</ul>
			</div>
			<!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
			<div id="wrapper">
				<div>
				<table cellspacing="40px">
					<tbody>
						<tr>
							<td class="box" style="background-color: rgba(204, 0, 204, 0.8);"><a href="index.php">
								<img src="../images/cutlery-icon.png" class="in-img"/>
								<span class="big-text">View Orders</span>
								<div style="width: 100%; height: 30px; background-color: rgba(255, 255, 255, 0.5); padding-bottom: 0;"></div>
								</a>
							</td>
							<td class="box" style="background-color: rgba(0, 51, 204, 0.8);"><a href="promotions.php">
								<img src="../images/gift-box-icon.png" class="in-img"/>
								<span class="big-text">Promotions</span>
								<div style="width: 100%; height: 30px; background-color: rgba(255, 255, 255, 0.5); padding-bottom: 0;"></div>
								</a>
							</td>
							<td class="box" style="background-color: rgba(0, 153, 0, 0.8);">
								<img src="../images/report-icon.png" class="in-img"/>
								<span class="big-text">Reports</span>
								<div style="width: 100%; height: 30px; background-color: rgba(255, 255, 255, 0.5); padding-bottom: 0;"></div>
							</td>
							<td class="box" style="background-color: rgba(255, 153, 51, 0.9);">
								<img src="../images/dollar-icon.png" class="in-img"/>
								<span class="big-text">Revenue</span>
								<div style="width: 100%; height: 30px; background-color: rgba(255, 255, 255, 0.5); bottom: 0;"></div>
							</td>
						</tr>
					</tbody>
				</table>
				</div>
				<div id="add-form">
					<?php 
						if(isset(($_REQUEST['btn-add'])) && (isset($_POST['dish_name'])) ){	
							$dish_cuisine = $_POST['dish_cuisine'];
							$dish_price = $_POST['nbm'];
							$dish_name = $_POST['dish_name'];
							$res_name = $_POST['rest_name'];
							$query5 = "SELECT * FROM restaurants WHERE restaurant_name = '$res_name' ";
							$out = mysqli_fetch_array(mysqli_query($connection , $query5));
							$rests_id = $out['restaurant_id'];
							
							$query4 = "INSERT INTO dishes set dish_cuisine = '$dish_cuisine' , dish_price = '$dish_price' , dish_name = '$dish_name' ,restaurant_id = '$rests_id' ";
							if(mysqli_query($connection , $query4)){
								header ("location: dish.php" );	
								echo '<script>alert("Added Successfully")</script>';
							}else{
								echo '<script>alert("Unable to Dish")</script>';
							}
						}
					?>
					<form method="post" enctype="multipart/form-data">
						<h1>Add New Dish</h1>
						<input type="text" name="dish_name" placeholder="Dish name" required="required" class="add-panel"/>
						<select name="rest_name" class="add-panel">
							<?php
								$query3 = "SELECT * FROM restaurants";
								$exec3 = mysqli_query($connection , $query3);
								while($output3 = mysqli_fetch_array($exec3)){
									echo "<option>" .$output3['restaurant_name'] . "</option>";
								}
							?>
						</select>
						<select name="dish_cuisine" class="add-panel">
							<option>African</option>
							<option>American</option>
							<option>Asian</option>
							<option>Fruits</option>
							<option>Bakery and Cakes</option>
							<option>Breakfast</option>
							<option>Italian</option>
							<option>International</option>
							<option>Japanese</option>
							<option>Lebanese</option>
							<option>Mediterranean</option>
							<option>Chinese</option>
							<option>Mexican</option>
							<option>Middle Eastern</option>
							<option>Nigerian</option>
							<option>European</option>
							<option>Noodles</option>
							<option>Pasta</option>
							<option>Russian</option>
							<option>French</option>
							<option>Pizza</option>
							<option>Salads</option>
							<option>Sandwiches</option>
							<option>Greek</option>
							<option>Seafood</option>
							<option>Shawarma</option>
							<option>Thai</option>
							<option>Healthy Foods</option>
							<option>Vegetarian</option>
							<option>Vietnamese</option>
							<option>Western</option>
							<option>Home-made foods</option>
							<option>British</option>
							<option>Burger</option>
							<option>Business Deals</option>
							<option>Indian</option>
						</select><br /><br />
						<input type="number" value="0" min="1" name='nbm'/>
						<input type="submit" name="btn-add" value="ADD" class="add-panel-button" />
					</form>
				</div>
				<div id="table-id">
					<div class="tbl-header" style="padding-right: 17px;">
					<table border="0" cellspacing="0" cellpadding="0" id="table">
						<thead>
							<tr>
								<th>RESTAURANT ID</th>
								<th>RESTAURANT NAME</th>
								<th>DISH ID</th>
								<th>DISH NAME</th>
								<th>DISH CUISINE</th>
								<th>PRICE</th>
								<th></th>
							</tr>
						</thead>
						</table>
						</div>
					<div class="tbl-content">
					<table border="0" cellspacing="0" cellpadding="0" id="table">
						<tbody>
							<?php
								$query = "SELECT * FROM dishes";
								$exec = mysqli_query($connection , $query);
							?>
							
								<?php
									while($output = mysqli_fetch_array($exec)){
										$restaurant_id = $output['restaurant_id'];
										$query2 = "SELECT * FROM restaurants WHERE restaurant_id = '$restaurant_id' ";
										
										$exec2 = mysqli_query($connection , $query2);
										
										$output2 = mysqli_fetch_array($exec2);
										$restaurant_name = $output2['restaurant_name'];
										
										echo "<tr>";
										echo "<td>" .$output['restaurant_id']. "</td>";
										echo "<td>" .$restaurant_name. "</td>";
										echo "<td>" .$output['dish_id']. "</td>";
										echo "<td>" .$output['dish_name']. "</td>";
										echo "<td>" .$output['dish_cuisine']. "</td>";
										echo "<td>$" .$output['dish_price']. "</td>";
										echo "<td><a href='#'>Delete</a></td>";
										echo "</tr>";
										
									}
								?>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
		<div id="footer">
		</div>
	</body>
</html> 