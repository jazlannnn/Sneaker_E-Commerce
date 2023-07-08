<?php
	include "config.php";
	 
	require_once('Function.php');
	
	// Remove product card
	if(isset($_POST['remove'])){
		
		//print_r($_GET['id']);
		if($_GET['action']=='remove'){
			
			foreach($_SESSION['cart'] as $key => $value){
				
				if($value["product_id"]==$_GET['id']){
					$id = $_GET['id'];
					unset($_SESSION['cart'][$key]);
					echo"<script>alert('product removed')</script>";
					echo "<script>window.location = 'Cartpage.php'</script>";
				}
			}
		}	
	}
	
	// Update quantity 
	if(isset($_POST['updateQuantity'])){
		
		$newQuantity = $_POST['Inputquantity'];
		if ($newQuantity >= 1 && is_numeric($newQuantity))
		{
			//print_r($_GET['id']);
			foreach($_SESSION['cart'] as $keys => $values){

				if($values['product_id'] == $_GET['id'])
				{
					$_SESSION['cart'][$keys]['product_quantity'] = $newQuantity;
				//print_r($values['product_quantity']);
					echo"<script>alert('product quantity updated')</script>";
					echo "<script>window.location = 'Cartpage.php'</script>";
				}											
			}
		}
		else 
			echo"<script>alert('Please enter a valid quantity')</script>";
	}
	
	// Update size
	if(isset($_POST['updateSize'])){
		
		$newSize = $_POST['InputSize'];
		if ($newSize >= 2 && is_numeric($newSize))
		{
			//print_r($_GET['id']);
			foreach($_SESSION['cart'] as $keys => $values){

				if($values['product_id'] == $_GET['id'])
				{
					$_SESSION['cart'][$keys]['product_size'] = $newSize;
				//print_r($values['product_quantity']);
					echo"<script>alert('product size updated')</script>";
					echo "<script>window.location = 'Cartpage.php'</script>";
				}											
			}
		}
		else 
			echo"<script>alert('Please enter a valid size')</script>";
	}
	
	// checkout 
	if(isset($_POST["Checkout_Button"]))
	{	
		if(isset($_SESSION['user_id'])){
		//calculate total price
		$TotalPrice = 10;
		foreach($_SESSION['cart'] as $keys => $values){
			$TotalPrice = $TotalPrice + ($values['product_price'] * $values['product_quantity']); 
		}
		
		$userID = $_SESSION["user_id"]; // retrieve user id

		// select customer info
		$sql = "SELECT * FROM `customer`
		WHERE Customer_ID LIKE $userID"; 
					
		$result = mysqli_query($connect, $sql);
							 
		if(mysqli_num_rows($result) > 0)
		{	
			while($row = mysqli_fetch_assoc($result))
			{
				$customerid = $row['Customer_ID'];
				$username = $row['Customer_Username'];
				$address = $row['Customer_Address'];
				$PhoneNumber = $row['Customer_PhoneNumber'];					
			}
		}
		else 
			"query fail";
		
		// create order table for the customer
		$date=date("Y/m/d");
		$sql = "INSERT INTO `orders` (Orders_Date, Orders_TotalPrice, Orders_CustomerFK)
			VALUES ('$date','$TotalPrice', '$customerid')";
		
			$sendsql = mysqli_query($connect, $sql);
		
			if($sendsql)
			{	
				//echo "success!";
				$last_id = mysqli_insert_id($connect); // return last newly created ID
				$_SESSION["order"] = $last_id;
			}
			else 
				echo "failed!";	
			
		// create order_details table 	
		foreach($_SESSION['cart'] as $keys => $values){
			$TotalPricePerProduct = 0;
			$TotalPricePerProduct = $TotalPricePerProduct + ($values['product_price'] * $values['product_quantity']); 
			
			$sql = "INSERT INTO `order_details` (OrderDetails_Size,OrderDetails_Quantity, OrderDetails_SubTotal, OrderDetails_OrderFK, OrderDetails_ProductFK)
			VALUES ('$values[product_size]','$values[product_quantity]','$TotalPricePerProduct', '$last_id', '$values[product_id]')";
		
			$sendsql = mysqli_query($connect, $sql);
		
			if($sendsql)
			{	
				//echo "ok!";
				header("Location:BillingAddress.php"); // new directory
			}
			else 
				echo "failed!";
		}
		}
		else 
			echo"<script>alert('You must Login First')</script>";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>	White Canvas | Cart page</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=Ddevice-width, initial-scale=1.0">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
		<link rel="stylesheet" href="CSS/CartPage.css" type="text/css" />
		<link rel="stylesheet" href="CSS/GeneralStyling.css" type="text/css" />
		
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
		
	</head>
	
	<body>
	
		<!--------------------- Header (calling header function)-------------------->
		<div id="header"></div>
		<!--------------------- Header End -------------------->
		
		<!--------------------- Cart content -------------------->
		
		<div style="height: 2000px;display:flex; width:100%;">
			<div id="mySidebar" class="sidebar">
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
				<a href="AccountPage.php">Account</a>
				<a href="CartPage.php">My Cart</a>
				<a href="OrderHistory.php">My purchase</a>
				<a href="Logout.php">Logout</a>
			</div>

			<div class="main">
				
				<button class="openbtnX" onclick="openNav()">☰ Open Sidebar</button><br><br>
				
				<h1 style="text-align:center; font-size: 40px; ">My cart</h1>
				
				<div class="AboutUsNavigation">
					<div class="InnerAboutUsNavigation">
						<a href="#home" class="hover-underline-animation"><b>Step 1: Confirm cart item</b> </a>
						<i class="fa fa-chevron-right" aria-hidden="true"></i>
						<a href="#home" class="hover-underline-animation" style="color:grey">Step 2: Confirm Details</a>
						<i class="fa fa-chevron-right" aria-hidden="true" style="color:grey"></i>
						<a href="#home" class="hover-underline-animation" style="color:grey">Step 3: Payment</a>
					</div>
				</div><br><hr><br>
				
				<!--------------------- Cart items -------------------->
				<div style="display:flex; width:100%">
					<div style="width:70%; float:left;">
					
						<div style="width:100%;">
						
							<?php
								$Total = 0;
								$SubTotal  = 0;
								$Delivery = 0;
								$Item = 0;
								if(isset($_SESSION['cart'])){
							
									$product_id = array_column($_SESSION['cart'],'product_id');
									$sql = "SELECT * FROM `product`";
									$result = mysqli_query($connect, $sql);
								
									if(mysqli_num_rows($result) > 0)
									{	
										while($row = mysqli_fetch_assoc($result))
										{
											foreach($_SESSION['cart'] as $keys => $values){
														
												if($values['product_id'] == $row['Product_ID'])
												{	
													// output cart item selected
													cartElement($values['product_name'],$row['Product_Image'],$values['product_price'],$values['product_id'],$values['product_quantity'],$row['Product_Desc'],$row['Product_Gender'],$values['product_size']);
													$Total = $Total + ($values['product_price'] * $values['product_quantity']);	// total price all item
													$Item = $Item + $values['product_quantity']; // total quantity all item
												}
											}
										}
										
										$Delivery += 10.00;
										$SubTotal += $Total;
										$Total = $Total + $Delivery;
									}
								}
								else
								{
									echo"<h2 style='color:grey;'>No item</h2>";
								}
								
							?>	
						</div>
					</div>
				
					<!----------------- Cart price  ---------------------->
					<div style="width:30%; float:right">
						
						<div style="width:100%; border-style: solid; padding:10px; border-width: thin;">
						
							<h6 style="font-size:26px;">Price details</h6>
							<hr>
		
							<?php
								if(isset($_SESSION['cart']) && !empty($_SESSION['cart']))
								{
									if($_SESSION['cart'])
									echo"<h6>Total items : ($Item items) </h6>
									<hr>
									<h6>SubTotal : RM $SubTotal </h6>
									<h6>Delivery charges : RM $Delivery</h6>
									<hr>
									<h6>Total Price : $Total </h6>
									";
									
									
								}else
								{
									echo "<h6>Total items:(0 items)</h6>
									<hr>
									<h6>SubTotal : RM 0.0 </h6>
									<h6>Delivery charges : RM 0.0 <h6>
									<hr>
									<h6>Total Price : 0.0 </h6>
									";
								}
							?>
						</div>
						<form  action = "" method="post">
						<br>
							<div style="float:right">
								<button type="submit" class="button" name="Checkout_Button">Check out</button>
							</div>
						</form>	
					</div>
					<!----------------- Cart price  ---------------------->					
				</div>
				<!--------------------- Cart items  ends-------------------->
			</div>
		</div>
		<!--------------------- Cart content end -------------------->
		
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
			
			
			/*-------------------------- Search bar ------------------------------*/
			function openSearch() {
			document.getElementById("myOverlay").style.display = "block";
			}

			function closeSearch() {
			document.getElementById("myOverlay").style.display = "none";
			}
			/*-------------------------- Search bar end ------------------------------*/
			
			/*-------------------------- Calling header and footer fucntion ------------------------------*/
			$(function(){
				$("#header").load("Header.php"); 
				$("#footer").load("Footer.php");
			});
			/*-------------------------- header and footer fucntion end ------------------------------*/
			
			
		</script>
		
	</body>
</html>