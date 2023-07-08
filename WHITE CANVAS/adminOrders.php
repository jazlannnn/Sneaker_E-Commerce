<?php 
	include "config.php";			
?>

<!DOCTYPE html>
<html>
	<head>
	<title>admin | whiteCanvas </title>  
		<link  rel="stylesheet" type="text/css" href="css/adminstyle.css?v=<?php echo time(); ?>">
		<meta charset = "UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!------ to access Jquery source------->
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>

	<!--------------- Javascript ---------------->
	
	<!------Jquery function to open popup------->
	<script type="text/javascript">
		function togglePopup1() {
			$(".PaymentOuterContainer").toggle();
		}
	
		function togglePopup2() {
			$(".PaymentOuterContainer").toggle();
		}
	</script>

	</head> 
	
	<body>
		<div id="mySidebar" class="sidebar">
	
			<div class="nav-column">
			  <div class="logo-image" style="display:flex;">
				  	<img src="img/logoIcon4.png" class="logo-image"/>
					<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
			  </div>
			  <a href="adminHome.php"><img class="img-icon" src="img/list.png" style="height:40px; width:40px;"><p>Dashboard</p></a>
			  <a href="adminSales.php"><img class="img-icon" src="img/sales.png"><p>Sales</p></a>
			  <a href="adminCust.php"><img class="img-icon" src="img/customer.png"><p>Customers</p></a>
			  <a href="adminOrders.php"><img class="img-icon" src="img/order2.png"><p>Orders</p></a>
			  <a href="adminInventory.php"><img class="img-icon" src="img/inventory.png"><p>Inventory</p></a>
			  <a href="adminAccount.php"><img class="img-icon" src="img/account.png"><p>My Account</p></a>
			  <a href="Logout.php"><img class="img-icon" src="img/logout.png"><p>Log out</p></a>
			</div>
		</div>
		
		<div id="main">
			<!------------------------Header--------------------------->
			<div class="admin-header">
			  <button class="openbtn" onclick="openNav()">☰</button> 
				<script>
					function openNav() {
					  //The getElementById() method returns the element that has the ID attribute 
					  document.getElementById("mySidebar").style.width = "260px";
					  document.getElementById("main").style.marginLeft = "260px";
					}

					function closeNav() {
					  document.getElementById("mySidebar").style.width = "0";
					  document.getElementById("main").style.marginLeft= "0";
					}
				</script>
				<div class="admin-name">
					<img src="img/adminIcon2.png" style="height:80px; width:85px;">
					<h3><?php echo $_SESSION['adminUsername'] ?></h3>
				</div>				
			</div>
			 
			 <br><br>  
			 <hr style="background:black">
		 
			<!------------------------content--------------------------->
			<div class="orders-container">
				<div class="orders-number">
					<h3><?php echo $_SESSION['TotalOrders'];?> Orders</h3>
					<img  class="orders-image" src="img/orders.png">					
				</div>
				
				<div class="orders-table">
					<div class="orders-col">
						<h2> Customer Orders </h2>
						<table class="styled-table table-fixed">
							<thead>
								<tr>
									<th>Payment ID.</th>
									<th style='padding-left:80px;'>Order ID</th>
									<!-- <th style='padding-left:80px;'>Date</th>	 -->							
									<th style='padding-left:130px;'>Sales</th>
									<th style='padding-left:130px;'>Customer</th>
									<th style='padding-left:105px;'>Payment</th>
								</tr>
							</thead>
							<tbody>
								<?php

								$sql="SELECT
										payment.Payment_ID,
										orders.orders_ID,
										payment.Payment_Proof,
										orders.orders_Date,
										orders.orders_TotalPrice,
										customer.Customer_Username
									FROM
										orders,
										customer,
										payment
									WHERE
										orders.Orders_CustomerFK = customer.Customer_ID 
									AND 
										orders.Orders_ID = payment.Payment_OrderFK";
				
								$result = mysqli_query($connect, $sql);
									
						
								if(mysqli_num_rows($result) > 0)
								{	
									
									while($row = mysqli_fetch_assoc($result))
									{
										echo "<tr class=\"active-row\" style='font-family:helvetica; font-size: 17px;'>";
												
											echo "<td style='width:140px; padding-left:50px;'>". $row["Payment_ID"] . "</td>";
											echo "<td style='width:120px; padding-left:60px;'>" . $row["orders_ID"]. "</td>";
											// echo "<td style='width:450px; padding-left:60px;'>" . $row["orders_Date"]."</td>";			
											echo "<td style=\"width: 200px; padding-left:110px;\"> RM" . $row["orders_TotalPrice"]. "</td>";
											echo "<td style=\"width: 200px; padding-left:100px;\">" . $row["Customer_Username"]."</td>";
											echo "<td style=\"width: 200px; padding-left:50px;\"><button onclick='togglePopup1()' class=\"styleBtn\">View</button></td>";
											//echo "<td style=\" padding-left:50px;\"><button class=\"styleBtn\">View</button></td>";											
											//popup payment view										
											echo "			
												<div class='PaymentOuterContainer' >
													<div class='payment-details'>

														<div class='title'>
															<h2 style='text-align:center;'>Payment Details </h2> 
															<hr style='background:black; width:400px;'>
														</div>							
															<div class='InnerContainer'>
																<ul style='list-style-type:none;'>
																	<li><b>Payment ID     : </b>" . $row["Payment_ID"] . "</li>
																	<li><b>Customer       : </b>" . $row["Customer_Username"] . "</li>
																	<li><b>Payment Date   : </b>" . $row["orders_Date"] . "</li>
																</ul>
																<img class='payment' src='". $row["Payment_Proof"] . "'
															</div>
															<div style='display: relative; margin-left: auto; margin-right: auto;'>
																<button onclick='togglePopup2()' class='popupBtn' style='margin-right: 90px;'> Close </button>
															</div>
													</div>
												</div>";	
											echo "</tr>";
										
									}
								}
								
								else
									echo "Query Failed";
							?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
			
			
			
			
		</div>
	</body>
	
	
	
</html>