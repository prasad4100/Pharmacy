<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['pharmacist_id'];
$fname=$_SESSION['first_name'];
$lname=$_SESSION['last_name'];
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
<title><?php echo $user;?>PHARMACY</title>
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
			<li><a href="pharmacist.php"><SPAN>DASHBAORD</SPAN></a></li>
			<li><a href="prescription.php"><SPAN>PRESCRIPTION</SPAN></a></li>
			<li><a href="stock_pharmacist.php"><SPAN>STOCK</SPAN></a></li>
			<li><a href="logout.php"><SPAN>LOGOUT</SPAN></a></li>
		</ul>	
</div>
</div>
<div id="main">
<!-- Dashboard icons -->
            <div class="grid_7">
            	<a href="pharmacist.php" class="dashboard-module">
                	<img src="images/pharmacist_icon.jpg" width="100" height="100" alt="edit" />
                	<span>Dashboard</span>
                </a>
                             
                <a href="prescription.php" class="dashboard-module">
                	<img src="images/prescri.jpg"  width="100" height="100" alt="edit" />
                	<span>Prescription</span>
                </a>
	            <a href="stock_pharmacist.php" class="dashboard-module">
                	<img src="images/stock_icon.jpg" width="100" height="100" alt="edit" />
                	<span>Stock</span>
                </a>
              </div>
</div>
<div id="footer" align="Center">THE PHARMACY MANAGEMENT SYSTEM</div>
</div>
</body>
</html>
