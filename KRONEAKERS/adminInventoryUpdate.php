
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
		
	</head> 
	
	<body>
		<div id="mySidebar" class="sidebar">
	
			<div class="nav-column">
			  <div class="logo-image">
					<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
			  </div>
			  <a href="adminHome.php"><img class="img-icon" src="img/list.png" style="height:40px; width:40px;"><p>Dashboard</p></a>
			  <a href="adminSales.php"><img class="img-icon" src="img/sales.png"><p>Sales</p></a>
			  <a href="adminCust.php"><img class="img-icon" src="img/customer.png"><p>Customers</p></a>
			  <a href="adminOrders.php"><img class="img-icon" src="img/order2.png"><p>Orders</p></a>
			  <a href="adminInventory.php"><img class="img-icon" src="img/inventory.png"><p>Inventory</p></a>
			  <a href="adminAccount.php"><img class="img-icon" src="img/account.png"><p>My Account</p></a>
			  <a href="#"><img class="img-icon" src="img/logout.png"><p>Log out</p></a>
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
			<div class="inventory-container">
				<div class="inventory-number">
					<h3>Current Inventory</h3>
					<img  class="inventory-image" src="img/inventory.png">					
				</div>
				<div class="search" style="width:100%; display:flex;">
					<div class="search-text" style="width:100%;"><b> Search Product: </b>
						<form id="form1" action = "" method="POST">
							<input  type="text" id="searchProduct" name="searchID" placeholder=" Enter product ID.." value=""> 
							<!-- <button onclick="togglePopup1()" class="updating-button">Search</button> -->
							<button name="searchBtn" class="updating-button">Search</button>
						</form>
					</div>
				</div>

				<!--------------- popup details---------------->
				<div class="OuterContainer" >
					<div class="updating-details">
						<!--------------- title ---------------->
						<div class="title">
							<h2 style="text-align:center;">Update Product </h2> 
							<hr style="background:black; width:400px;">
						</div>

						<!--------------- content ---------------->
						
						<form action="" method="POST">					
							<div class="InnerContainer">
								<div class="input-quantity" style="margin-left:5px;">
									<label style="font-size:22px; padding: 5px 0px;"><b>Product Name</b></label>
									<input type="text" class="type-2" id="type-2" name="productName"  disabled>
								</div>

								<div class="input-quantity">
										<label style="font-size:22px; padding: 5px 8px;"><b>Update Options</b></label>
										<div class="select">
											 <select name="selectOption" id="select">
												<option value="add">Add quantity</option>
												<option value="delete">Delete quantity</option>
											</select> 
										</div>								
								</div>

								<div class="input-quantity" style="margin-left:5px;">
									<label style="font-size:22px; padding: 5px 0px;"><b>Quantity</b></label>
									<input type="text" name="quantity" class="type-2" placeholder="Enter Quantity">
								</div>
								
								<span class="focus"></span>
							</div>
						<!--------------- close button ---------------->
							<div style="display: relative; margin-left: auto; margin-right: auto;">
								<button onclick="togglePopup1()" name = "updateBtn" class="updateBtn" style="margin-left:160px;"> Submit </button>
								<button onclick="togglePopup2()" class="updateBtn" style="margin-left:30px;"> Close </button>
							</div>
						</form>
					</div>
				</div>
					
				<script>
						document.getElementById('type-2').value = global();		
				</script>
				<!--------------- php process to calculate quantity and insert into database ---------------->			
				<?php
					$sql="SELECT *  FROM product";
					$result = mysqli_query($connect, $sql);
				
						if(isset($_POST['updateBtn']))
						{
							$quantity = $_POST['quantity'];
							$update = $_POST['selectOption'];
							//$productID = $_SESSION["productID"];

							echo $quantity . "====" . $update . "====" .  $productID;
							 if(mysqli_num_rows($result) > 0)
							 {	
							 	while($row = mysqli_fetch_assoc($result))
								{
							 		if($productID == $row['Product_ID'])
									{
							 			if($update == 'add')
										{ 	 
							 				$newQuantity = $row['Product_Quantity'] + $quantity;
							 				$sql= " UPDATE product SET Product_Quantity =  $newQuantity WHERE Product_ID = '$productID' ";
							 				$sendSql = mysqli_query($connect, $sql);
										
							 			}

							 			else
							 			{ 	 
							 				$newQuantity = $row['Product_Quantity'] - $quantity;
							 				$sql= " UPDATE product SET Product_Quantity =  $newQuantity WHERE Product_ID = '$productID' ";
							 				$sendSql = mysqli_query($connect, $sql);
										
							 			}
							 		}						
							 	}
							}		
						 	else 
						 		"query fail";
						 }
					
				?> 

				
			</div>
		</div>
	</body>
</html>