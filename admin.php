<?php
session_start();
include_once("connect_db.php");
if(isset($_SESSION["username"])){
$id=$_SESSION["admin_id"];
$user=$_SESSION["username"];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $user;?> THE PHARMACY</title>
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
<h1><a href="#"><img src="images/Avatar.png"></a> THE PHARMACY</h1></div>
<div id="left_column">
<div id="button">
<ul>
			<li><a href="admin.php"><span>DASHBOARD</span></a></li>
			<li><a href="admin_pharmacist.php"><span>PHARMACIST</span></a></li>
			<li><a href="admin_manager.php"><span>MANAGER</span></a></li>
			<li><a href="admin_cashier.php"><span>CASHIER</span></a></li>
			<li><a href="logout.php"><span>LOGOUT</span></a></li>
		</ul>	
</div>
		</div>
<div id="main">
    
 <!-- Dashboard icons -->
            <div class="grid_7">
            	<a href="admin.php" class="dashboard-module">
                	<img src="images/admin_icon.jpg" width="75" height="75" alt="edit" />
                	<span>Dashboard</span>
                </a>
                <a href="admin_pharmacist.php" class="dashboard-module">
                	<img src="images/pharmacist_icon.jpg"  width="75" height="75" alt="edit" />
                	<span>Pharmacist</span>
                </a>
                
                <a href="admin_manager.php" class="dashboard-module">
                	<img src="images/manager_icon.png"  width="75" height="75" alt="edit" />
                	<span>Manager</span>
                </a>
                  
                <a href="admin_cashier.php" class="dashboard-module">
                	<img src="images/cashier_icon.jpg" width="75" height="75" alt="edit" />
                	<span>Cashier</span>
                </a>				  
			</div>
</div>
<div id="footer" align="Center"> PHARMACY MANAGEMENT SYSTEM</div>
</div>
</body>
</html>
