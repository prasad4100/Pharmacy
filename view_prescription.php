<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['manager_id'];
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
<title><?php $user?> PHARMACY</title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="style/table.css" type="text/css" media="screen" /> 
<script src="js/function1.js" type="text/javascript"></script>
   <style>#left-column {height: 477px;}
 #main {height: 477px;}
</style>
</head>
<body>
<div id="content">
<div id="header">
<h1><a href="#"><img src="images/Avatar.png"></a>THE PHARMACY</h1></div>
<div id="left_column">
<div id="button">
		<ul>
			<li><a href="manager.php"><span>DASHBOARD</SPAN></a></li>
			<li><a href="view.php"><SPAN>VIEW<BR>USERS</SPAN></a></li>
			<li><a href="view_prescription.php"><SPAN>VIEW<BR>PRESCRIPTIONS</SPAN></a></li>
			<li><a href="stock.php"><SPAN>MANAGE<BR>STOCKS</a></li>
			<li><a href="logout.php"><SPAN>LOGOUT</SPAN></a></li>
		</ul>	
</div>
</div>
<div id="main">
<div id="tabbed_box" class="tabbed_box">  
    <h4>View Prescription</h4> 
<hr/>	
    <div class="tabbed_area">  
      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">Prescription </a></li>  
                          
        </ul>  
          
        <div id="content_1" class="content">  
		<?php echo $message1;
		/* 
		View
        Displays all data from 'Pharmacist' table
		*/
        // connect to the database
        include_once('connect_db.php');
       // get results from database
       $result = mysqli_query($con,"SELECT * FROM prescription")or die(mysql_error());
		// display data in table
        echo "<table border='1' cellpadding='5'>";
        echo "<tr> <th>Customer</th><th>Prescription N<sup>o</sup></th> <th>Invoice N<sup>o</sup></th><th>Date </th></tr>";
        // loop through results of database query, displaying them in the table
        while($row = mysqli_fetch_array( $result,MYSQLI_BOTH )) {
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['customer_name'] . '</td>';
                echo '<td>' . $row['prescription_id'] . '</td>';
				echo '<td>' . $row['invoice_id'] . '</td>';
				
				echo '<td>' . $row['date'] . '</td>';
				?>
				
				<?php
		 } 
        // close table>
        echo "</table>";
?> 
        </div>  

    </div>  
</div>
</div>
<div id="footer" align="Center">THE PHARMACY MANAGEMENT SYSTEM </div>
</div>
</body>
</html>