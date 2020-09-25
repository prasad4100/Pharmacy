<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['manager_id'];
$fname=$_SESSION['first_name'];
$lname=$_SESSION['last_nme'];
$sid=$_SESSION['staff_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $user;?>PHARMACY </title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="style/dashboard_styles.css"  media="screen" />
<script src="js/function.js" type="text/javascript"></script>
<style>
#left_column{
height: 470px;
}
</style>
</head>
<body>
<div id="content">
<div id="header">
<h1><a href="#"><img src="images/Avatar.png"></a>THE PHARMACY</h1></div>
<div id="left_column">
<div id="button">
<ul>
			<li><a href="manager.php"><SPAN>DASHBOARD</SPAN></a></li>
			<li><a href="view.php"><SPAN>VIEW<BR>USERS</SPAN></a></li>
			<li><a href="view_prescription.php"><SPAN>VIEW<BR>PRESCRIPTION</SPAN></a></li>
			<li><a href="stock.php"><SPAN>MANAGE<BR>STOCK</SPAN></a></li>
			<li><a href="logout.php"><SPAN>LOGOUT</SPAN></a></li>
		</ul>	
</div>
</div>
<div id="main">
<!-- Dashboard icons -->
            <div class="grid_7">
            	<a href="manager.php" class="dashboard-module">
                	<img src="images/manager_icon.png" width="100" height="100" alt="edit" />
                	<span>Dashboard</span>
                </a>
				<a href="view.php" class="dashboard-module">
                	<img src="images/patients_1.png"  width="100" height="100" alt="edit" />
                	<span>View Users</span>
                </a>
               	
				<a href="view_prescription.php" class="dashboard-module">
                	<img src="images/prescri.jpg" width="100" height="100" alt="edit" />
                	<span>View Prescription</span>
				</a>
				<a href="stock.php" class="dashboard-module">
                	<img src="images/stock_icon.jpg" width="100" height="100" alt="edit" />
                	<span>Manage Stock</span>
                </a>
        </div>
</div>
<div id="footer" align="Center"> THE PHARMACY MANAGEMENT SYSTEM</div>
</div>
</body>
</html>
