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
  				<a href="#" class="opt"><img src="../images/contact-icon.png" class="side-icon">&nbsp;&nbsp;&nbsp;Contact</a>
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
								<th>EMAIL ADDRESS</th>
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
							<tr>
								<td>112946</td>
								<td>Mrs. Afolabi Sekinat</td>
								<td>08031456874</td>
								<td>1, Joseph Dosu Way, Badagry, Lagos</td>
								<td>afolabisekinat@gmail.com</td>
								<td>$100.00</td>
								<td>12:12:59 12/12/2016</td>
								<td>12:12:59 12/12/2016</td>
								<td>Active</td>
								<td><a href="#">Send Message</a></td>
								<td><a href="#">Send Email</a></td>
							</tr>
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