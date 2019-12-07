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
  				<a href="#" class="opt"><img src="../images/client-icon.png" class="side-icon">&nbsp;&nbsp;&nbsp; Clients</a>
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
<!--
				<div>
					<form method="get">
						<input type="text" name="search" placeholder="search" required="required" /><button type="button" name="btn-search" onclick="javascript:alert('Search');">Search</button>
					</form>
				</div>
-->
				<div id="table-id">
					<div class="tbl-header" style="padding-right: 17px; margin-top: 30px;">
					<table border="0" cellspacing="0" cellpadding="0" id="table">
						<thead>
							<tr>
								<th>CUSTOMER ID</th>
								<th>CUSTOMER NAME</th>
								<th>MOBILE NUMBER</th>
								<th>LOCATION</th>
								<th>NUMBERS OF ORDERS</th>
								<th>TOTAL AMOUNT BOUGHT</th>
								<th>REGISTRATION DATE</th>
								<th>LAST LOGIN</th>
								<th>ACCOUNT STATUS</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						</table>
						</div>
					<div class="tbl-content">
					<table border="0" cellspacing="0" cellpadding="0" id="table">
						<tbody>
							<?php
								$query = "SELECT * FROM customer";
								$exec = mysqli_query($connection , $query);
							?>
							
								<?php
									while($output = mysqli_fetch_array($exec)){
										$customer_id = $output['customer_id'];
										$query2 = "SELECT * FROM orders WHERE customer_id = '$customer_id' ";
										
										$exec2 = mysqli_query($connection , $query2);
										$num_of_orders = 0; $total_amount_bought = 0;
										
										while($output2 = mysqli_fetch_array($exec2)){
											$total_amount_bought += $output2['order_amount'];
											$num_of_orders++;
										}
										echo "<tr>";
										echo "<td>" .$output['customer_id']."</td>";
										echo "<td>" .$output['customer_name']."</td>";
										echo "<td>" .$output['customer_mobile']."</td>";
										echo "<td>" .$output['customer_location']."</td>";
										echo "<td>" .$num_of_orders."</td>";
										echo "<td>$" .$total_amount_bought."</td>";
										echo "<td>" .$output['registration_date']."</td>";
										echo "<td>" .$output['last_login']."</td>";
										echo "<td>" .$output['account_status']."</td>";
										echo "<td><a href=''>Block</a></td>";
										echo "<td><a href=''>Delete</a></td>";
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