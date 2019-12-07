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
<?php
if(isset($_GET['delete'])){
	$res = $_GET['delete'];
	$del_query =  "DELETE FROM restaurants WHERE restaurant_id = '$res' ";
	mysqli_query($connection , $del_query);
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
						if(isset(($_REQUEST['btn-add'])) && (isset($_POST['rest_name'])) ){	
							if(empty($_FILES['file_image']['name'])){
								echo '<script>alert("Please select at least one image to continue")</script>';
							}else{
			
							$check = (getimagesize($_FILES['file_image']['tmp_name']));
							if(!$check){
								echo '<script>alert("File is not an image")</script>';
							}else{
	
								$image = $_FILES['file_image']['name'];
								$saveto = "../images/resturants/".$image;
								$pfn1 = move_uploaded_file($_FILES['file_image']['tmp_name'], $saveto) ;
								

								$restaurant_name =  $_POST['rest_name']; $restaurant_state = $_POST['rest_state'];
								$restaurant_area = $_POST['rest_area'];
								$add_query = "INSERT INTO restaurants set restaurant_name = '$restaurant_name' , restaurant_state ='$restaurant_state' , restaurant_area ='$restaurant_area' , restaurant_logo = '$saveto' ";
								$run_query = mysqli_query($connection , $add_query);
								if($run_query){
									
									header ("location: restaurant.php" );	
									echo '<script>alert("Added Successfully")</script>';
								}else{
									echo '<script>alert("Unable to Add Restaurant")</script>';
									}
							}
							}
						}
					?>
					<form method="post" enctype="multipart/form-data">
						<h1>Add New Restaurant</h1>
						<input type="text" name="rest_name" placeholder="Resturant name" required="required" class="add-panel"/>
						<select class="add-panel" onchange="validate()" id="location" name="rest_state">
							<option>Lagos</option>
							<option>Abuja</option>
						</select>
						<select class="add-panel" id="area" name="rest_area">
                        <option class="areas" >Please Select</option>
                    	</select><br /><br />
						<input type="file" name="file_image" class="add-panel-file" />
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
								<th>RESTAURANT LOCATION</th>
								<th>RESTAURANT LOGO</th>
								<th>IMAGE LOCATION</th>
								<th></th>
							</tr>
						</thead>
						</table>
						</div>
					<div class="tbl-content">
					<table border="0" cellspacing="0" cellpadding="0" id="table">
						<tbody>
							<?php
								$query = "SELECT * FROM restaurants";
								$exec = mysqli_query($connection , $query);
							?>
							
								<?php
									while($output = mysqli_fetch_array($exec)){
										$del_id = $output['restaurant_id'];
										echo "<tr>";
										echo "<td>" .$output['restaurant_id']. "</td>";
										echo "<td>" .$output['restaurant_name']. "</td>";
										echo "<td>" .$output['restaurant_state']. ", ".$output['restaurant_area'].  "</td>";
										echo "<td><img src='" .$output['restaurant_logo']. "' width='50px' height='50px'/></td>";
										echo "<td>" .$output['restaurant_logo']. "</td>";
										echo "<td><a href='restaurant.php?delete=$del_id'>Delete</a></td>";
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
		<script type="text/javascript" src="script/script.js"></script>
		<script>window.onload=validate()</script>
	</body>
</html> 