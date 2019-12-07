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
						if(isset(($_REQUEST['btn-add'])) && (isset($_POST['coupon_code'])) ){	
							$coupon_code = $_POST['coupon_code'];
							$coupon_price = $_POST['nbm'];
							$query5 = "SELECT * FROM coupons WHERE coupon_code = '$coupon_code' ";
							$out = mysqli_fetch_array(mysqli_query($connection , $query5));
							
							if(mysqli_num_rows($out) > 0){
								echo '<script>alert("Coupon code already exists")</script>';
							}else{
							
								$query4 = "INSERT INTO coupons set coupon_code = '$coupon_code' , coupon_discount = '$coupon_price', coupon_status = 'ACTIVE' ";
								if(mysqli_query($connection , $query4)){
									header ("location: promotions.php" );	
									echo '<script>alert("Added Successfully")</script>';
								}else{
									echo '<script>alert("Unable Add coupon code")</script>';
								}
							}
						}
					?>
					<form method="post" enctype="multipart/form-data">
						<h1>Add Coupon</h1>
						<input type="text" name="coupon_code" id="coupon_code" placeholder="Coupon Code" required="required" class="add-panel"/>
						<button type="button" onclick="generate()">Generate Random Coupon Code</button>
						<input type="number" value="0" min="1" name='nbm'/>
						<input type="submit" name="btn-add" value="ADD" class="add-panel-button" />
					</form>
				</div>
				<div id="table-id">
					<div class="tbl-header" style="padding-right: 17px;">
					<table border="0" cellspacing="0" cellpadding="0" id="table">
						<thead>
							<tr>
								<th>COUPON ID</th>
								<th>COUPON CODE</th>
								<th>COUPON DISCOUNT</th>
								<th>COUPON STATUS</th>
								<th></th>
							</tr>
						</thead>
						</table>
						</div>
					<div class="tbl-content">
					<table border="0" cellspacing="0" cellpadding="0" id="table">
						<tbody>
							<?php
								$query = "SELECT * FROM coupons";
								$exec = mysqli_query($connection , $query);
							?>
							
								<?php
									while($output = mysqli_fetch_array($exec)){
										echo "<tr>";
										echo "<td>" .$output['coupon_id']. "</td>";
										echo "<td>" .$output['coupon_code']. "</td>";
										echo "<td>$" .$output['coupon_discount']. "</td>";
										echo "<td>" .$output['coupon_status']. "</td>";
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