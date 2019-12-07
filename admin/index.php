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
		<script>window.onload = function(){
				openNav();
			}</script>
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
							<td class="box" style="background-color: rgba(204, 0, 204, 0.8);">
								<img src="../images/cutlery-icon.png" class="in-img"/>
								<span class="big-text">View Orders</span>
								<div style="width: 100%; height: 30px; background-color: rgba(255, 255, 255, 0.5); padding-bottom: 0;"></div>
								
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
<!--
				<div>
					<form method="get">
						<input type="text" name="search" placeholder="search" required="required" /><button type="button" name="btn-search" onclick="javascript:alert('Search');">Search</button>
					</form>
				</div>
-->
				<div id="table-id">
					<div class="tbl-header" style="padding-right: 17px;">
					<table border="0" cellspacing="0" cellpadding="0" id="table">
						<thead>
							<tr>
								<th>CUSTOMER ID</th>
								<th>CUSTOMER NAME</th>
								<th>ORDER NUMBER</th>
								<th>LOCATION</th>
								<th>ORDER</th>
								<th>ORDER AMOUNT</th>
								<th>DISCOUNT</th>
								<th>STATUS</th>
								<th></th>
							</tr>
						</thead>
						</table>
						</div>
					<div class="tbl-content">
					<table border="0" cellspacing="0" cellpadding="0" id="table">
						<tbody>
							<?php
								$query = "SELECT * FROM orders";
								$exec = mysqli_query($connection , $query);
							?>
							
								<?php
									while($output = mysqli_fetch_array($exec)){
										$customer_id = $output['customer_id'];
										$query2 = "SELECT * FROM customer WHERE customer_id = '$customer_id' ";
										$exec2 = mysqli_query($connection , $query2);
										$output2 = mysqli_fetch_array($exec2);
										echo "<tr>";
										echo "<td>" .$output['customer_id']."</td>";
										echo "<td>" .$output2['customer_name']."</td>";
										echo "<td>" .$output['order_id']."</td>";
										echo "<td>" .$output['customer_location']."</td>";
										echo "<td>" .$output['order_contents']."</td>";
										echo "<td>$" .$output['order_amount']."</td>";
										echo "<td>$" .$output['order_discount']."</td>";
										echo "<td>" .$output['order_status']."</td>";
										echo "<td><a href='#'>Cancel</a></td>";
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