<?php
	include "config.php";
	
	
	if(isset($_POST["Cancel_Order"]))
	{
		
		$sql = "DELETE
	
				FROM 
					orders
				WHERE
					orders.Orders_ID LIKE $_SESSION[order]";	
					
		$sendsql = oci_parse($dbconn, $sql);
		
		if($sendsql)
		{
			echo 
			"<script> 
				alert('Cancel successful'); 
				window.location.href='index.php';
			</script>"; 
		}
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>	White Canvas | Billing Address page</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=Ddevice-width, initial-scale=1.0">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
		<link rel="stylesheet" href="CSS/BillingAddress.css" type="text/css" />
		<link rel="stylesheet" href="CSS/GeneralStyling.css" type="text/css" />
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
	</head>

	<body>
		<!--------------------- Header (calling header function)-------------------->
		<div id="header"></div>
		<!--------------------- Header End -------------------->
		
		<!--------------------- Cart table content -------------------->
		
		<div style="height:1000px; display:flex; width:100%; ">
			<div id="mySidebar" class="sidebar">
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
				<a href="AccountPage.php">Account</a>
				<a href="CartPage.php">My Cart</a>
				<a href="OrderHistory.php">My purchase</a>
				<a href="Logout.php">Logout</a>
			</div>

			<div class="main">
				
				<button class="openbtn" onclick="openNav()">☰ Open Sidebar</button>  
				
				<h1 style="text-align:center; font-size: 40px; ">Billing address</h1>
				
				<div class="AboutUsNavigation">
					<div class="InnerAboutUsNavigation">
						<a href="#" class="hover-underline-animation"style="color:grey">Step 1: Confirm cart item</a>
						<i class="fa fa-chevron-right" aria-hidden="true"></i>
						<a href="BillingAddress.php" class="hover-underline-animation"><b>Step 2: Confirm Details</b> </a>
						<i class="fa fa-chevron-right" aria-hidden="true"></i>
						<a href="#" class="hover-underline-animation" style="color:grey">Step 3: Payment</a>
					</div>
				</div><br><hr><br>
		
				
					<div class="InnerContainer">
				
						<div class = "RegisterDiv"> 
							<br><br>
							<h2 style="text-align:center">Information for delivery</h2>
							<hr style="height:8px; color:gray; background-color:grey; width:20%"><br> 
							<div style="width:80%;margin-left: auto; margin-right: auto;">
								
								<?php
										// display user info 
										$sql = "SELECT
													Customer_Username,
													Customer_Email,
													Customer_PhoneNumber,
													Customer_Address,
													Orders_TotalPrice,
													Orders_Date
												FROM
													orders
													INNER JOIN customer ON customer.Customer_ID = orders.Orders_CustomerFK
												WHERE
													Customer_ID LIKE '$_SESSION[user_id]'
												AND 
													orders.Orders_ID LIKE '$_SESSION[order]'"; 
										
										// display user order
										$sql2 = "SELECT
													Product_Name,
													OrderDetails_Size,
													OrderDetails_Quantity,
													Product_Price,
													OrderDetails_SubTotal
												FROM
													order_details
													INNER JOIN orders ON orders.Orders_ID = order_details.OrderDetails_OrderFK
													INNER JOIN product ON product.Product_ID = order_details.OrderDetails_ProductFK
													INNER JOIN customer ON customer.Customer_ID = orders.Orders_CustomerFK
												WHERE
													orders.Orders_ID LIKE '$_SESSION[order]'";
												
										$result = oci_parse($dbconn, $sql);
										$result2 = oci_parse($dbconn, $sql2);

										oci_execute($result);
										if($result)
										{
											if($result > 0)
											{	
												while(($row = oci_fetch_array($result))){
												
												echo"<ol class='listStyle'>
													<li><b>Username     :</b> $row[Customer_Username] </li>
													<li><b>Email        :</b> $row[Customer_Email] </li> 
													<li><b>Phone num.   :</b> $row[Customer_PhoneNumber] </li> 
													<li><b>Address      :</b> $row[Customer_Address] </li>
													<li><b>Date ordered :</b> $row[Orders_Date] </li>			
													<li><b>Delivery charge :</b> RM 10.00</li>
													<li><b>Total charge :</b> RM $row[Orders_TotalPrice]</li>
													</ol>
													<hr><br>
													";		
												}
											}
										}
										else{ 
											"query failed!";
										}
										
										oci_execute($result2);
										if($result2)
										{
											echo "<table id='customers'> 
												<tr> 
													<th> <font face='Arial'>Shoe Name</font> </th> 
													<th> <font face='Arial'>Shoe Size</font> </th> 
													<th> <font face='Arial'>Quantity</font> </th> 
													<th> <font face='Arial'>price</font> </th> 
													<th> <font face='Arial'>Subtotal</font> </th> 
												</tr>";
											
											if($result2 > 0)
											{	
												
													
												while(($row = oci_fetch_array($result2)))
												{
													echo 
													"<tr> 
														<td>$row[Product_Name]</td> 
														<td>$row[OrderDetails_Size]</td> 
														<td>$row[OrderDetails_Quantity]</td>
														<td>RM $row[Product_Price]</td> 				  
														<td>RM $row[OrderDetails_SubTotal]</td>
													</tr>
													";
												}
											}
												echo "</table>";
										}
										else{ 
											"query failed!";
											
											echo"";
										}
								?>	
							</div><br>
						</div>
						
						<div style="width:30%; background-color:#DBE2EF; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> 
							<img src="Images/Image for users/DeliveryCheckout.png" style="width:100%; "/>
						</div>
						
						
					</div><br>
					<!-- checkout button-->
				
					<div style="width:30%; margin-left: auto; margin-right: auto; ">
						
						<form action="PaymentPage.php" method="post">
							<button type="submit" class="button" name="Checkout_Button" style="float:right">Pay Now</button>
						</form>
					
						<form action="" method="post">
							<button type="submit" class="CAncelbutton" name="Cancel_Order" style="float:left">Cancel order</button>
						</form>
					</div>
					
				
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