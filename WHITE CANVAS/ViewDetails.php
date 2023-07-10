<?php
	require_once('Function.php');
	
	// get id selected
	if(isset($_GET['id']))
	{
		$SelectID = $_GET['id'];
		$result = GetOrderDetails($SelectID); // call function to get order details
	}else{
		echo"<h1> Fails </h1>";
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>	White Canvas |  View Details page</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=Ddevice-width, initial-scale=1.0">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
		<link rel="stylesheet" href="CSS/OrderHistory.css" type="text/css" />
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
	</head>
	<style>

	</style>
	<body>
		<!--------------------- Header (calling header function)-------------------->
		<div id="header"></div>
		<!--------------------- Header End -------------------->
		
		<!--------------------- Cart table content -------------------->
		
		<div style="height:900px; display:flex; width:100%; ">
			<div id="mySidebar" class="sidebar">
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
				<a href="AccountPage.php">Account</a>
				<a href="CartPage.php">My Cart</a>
				<a href="OrderHistory.php">My purchase</a>
				<a href="Logout.php">Logout</a>
			</div>

			<div class="main">
				
				<button class="openbtnX" onclick="openNav()">☰ Open Sidebar</button>  
				
				<h1 style="text-align:center; font-size: 40px; ">Order Details</h1>
		
				
					<h2 style="">My Order Details</h2>
					<hr style="height:2px; color:gray; background-color:grey; width:100%"><br> 
					<?php
								
						echo "<table class='OrderTable'> 
								<tr>
									<th> <font face='Arial'>Image</font> </th>
									<th> <font face='Arial'>Shoe Name</font> </th>
									<th> <font face='Arial'>Shoe Size(UK)</font> </th>									
									<th> <font face='Arial'>Quantity</font> </th> 
									<th> <font face='Arial'>Price(RM)</font> </th> 
									<th> <font face='Arial'>Subtotal(RM)</font> </th>
									</tr>";	
									
						while ($row = oci_fetch_assoc($result)){
						
							echo 
								"<tr> 
									<td style='width:20%'><img src='{$row['PRODUCT_IMAGE']}' style='width:65%; '></td> 
									<td>{$row['PRODUCT_NAME']}</td>
									<td>{$row['ORDERDETAILS_SIZE']}</td> 
									<td>{$row['ORDERDETAILS_QUANTITY']}</td> 
									<td>RM {$row['PRODUCT_PRICE']}</td>
									<td>RM {$row['ORDERDETAILS_SUBTOTAL']}</td>
								</tr>";
								$date = $row['ORDERS_DATE'];
								$TotalPrice = $row['ORDERS_TOTALPRICE'];
						}
						
						echo "
								<h3 style='font-family:arial'>Date Purchase : $date</h3>
								<h3 style='font-family:arial'>Total Expense   : RM $TotalPrice</h3>";
					?>
			
			</div>
		</div>
		<!--------------------- Cart table content end -------------------->
		

		
		<script>
			/*-------------------------- Sidebar ------------------------------*/
			function openNav() {
				document.getElementById("mySidebar").style.width = "20%";
				document.getElementById("main").style.marginLeft = "50px";
			}

			function closeNav() {
				document.getElementById("mySidebar").style.width = "0";
				document.getElementById("main").style.marginLeft= "0";
			}
			/*-------------------------- Sidebar ends ------------------------------*/
			
			/*-------------------------- Calling header and footer fucntion ------------------------------*/
			$(function(){
				$("#header").load("Header.php"); 
				$("#footer").load("Footer.php");
			});
			/*-------------------------- header and footer fucntion end ------------------------------*/
		</script>
		
	</body>
</html>
