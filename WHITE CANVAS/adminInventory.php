
<?php
							
	include "config.php";
	// upload product image
	if(isset($_POST['addProductBtn'])){
		//getting data
		$file = $_FILES['file'];
		$productID = $_POST['productID'];
		$productName = $_POST['productName'];
		$productPrice = $_POST['productPrice'];
		$productDesc = $_POST['productDesc'];
		$productQuantity = $_POST['productQuan'];
		$productGender = $_POST['productGen'];
		$productCategory = $_POST['productCateg'];

		// getting file info
		$fileName = $_FILES['file']['name'];
		$fileTmpName = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileError = $_FILES['file']['error'];
		$fileType = $_FILES['file']['type'];
		
		$filesExt = explode('.',$fileName);
		$fileActualExt = strtolower(end($filesExt));
		
		// pick wht type of file allowed
		$allowed = array('jpg','pdf', 'png');
		
		if(in_array($fileActualExt, $allowed)){
			if($fileError === 0){
				if($fileSize < 1000000)
				{	
								
						$fileNameNew = uniqid('', true).".".$fileActualExt;
						$fileDestination = 'Uploads/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						//header("Location: index.php?uploadsuccess");
					
						$sql = "INSERT INTO `product`(`Product_ID`, `Product_Name`, `Product_Price`, `Product_Desc`, `Product_Quantity`, `Product_Gender`, `Product_Category`, `Product_Image`) 
						VALUES ('$productID','$productName','$productPrice','$productDesc', '$productQuantity','$productGender', '$productCategory','$fileDestination')";	

						$sendsql = mysqli_query($connect, $sql);
		
						if($sendsql)
						{	
							echo"<script>alert('Add new product successfull')</script>";
						}
						else 
							echo "failed!";
					
				} else{
					echo"<script>alert('Your file is too big!')</script>";
				}
			}else{
				echo "There was an error uploading your file!";
			} 
				
		} else {
			echo "You cannot upload this type of file!";
		}
		
	}
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
	
		
		<!------Jquery function to open popup------->
		<script>
			function togglePopup2() {
				$(".OuterContainer").hide();
					
			}

			$(document).ready(function(){
				$("#addBtn").click(function(){
					$(".addProductContainer").toggle();
				});
			})

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
			<div class="inventory-container">
				<div class="inventory-number">
					<h3>Current Inventory</h3>
					<img  class="inventory-image" src="img/inventory.png">					
				</div>
				<div class="search" style="width:100%;">
					<div class="search-text" style="width:100%;  display:flex;"><b> Update Product: </b>
							<input  type="number" id="searchProduct" name="searchID" placeholder=" Search product ID.." value=""> 
							<button id="updating-button" class="addBtn" style="width: 100px; height:40px; margin-left:15px; border-radius: 25px; background: rgb(221, 157, 19);">Search</button>
					</div>
					<!-- <form action="PaymentPage.php" method="post" enctype="multipart/form-data">

					</form> -->
				</div>

				<script>
						$(document).ready(function(){
							$("#updating-button").click(function(){

								var input = document.getElementById('searchProduct').value;
								var shoesName = ["Nike Air Force 1", "Air hurricane", "Jordan Point", "Nike Pegasus", "Nike Zoom Fly", "Nike ZoomX", "Jordan Delta", 
												 "Jordan Point ", "Jordan Gold", "Air Force 1 ", "Vintage X", "Nike RYZ", "Nike Air Zoom", "Nike Revolution ", 
												 "Nike Air Tempo","Air Jordan 11", "Jordan Delta", "Jordan M.A", "Testing Shoes"];

								var shoesID = ["1", "2", "3", "4", "5", "6" , "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19"];
								var product;

				
								if(input != 0 && input <=shoesID.length)
								{								
									for(var a=0; a<=shoesID.length; a++)
									{									
										if(input == shoesID[a])
										{
											product = shoesName[a];
											document.getElementById('type-2').value = product;
											$(".OuterContainer").toggle();
											$(".inv-table").hide();						
										}
									}
								}
								else
									{
										input = "";
										alert("Product not available or not exist!");
									}

									<?php $productID = "<script> document.write(input); </script>"; ?>
							})
						});
				</script>

				<!--------------- popup details for updating product---------------->
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
									<input type="text" class="type-2" id="type-2" name="productName">
								</div>

								<div class="input-quantity">
										<label style="font-size:22px; padding: 5px 8px;"><b>Update Options</b></label>
										<div class="select">
											 <select name="selectOption" id="select">
												<option value="Add">Add quantity</option>
												<option value="Delete">Delete quantity</option>
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
								<button name = "updateBtn" class="popupBtn" style="margin-left:160px;"> Submit </button>
								<button onclick="togglePopup2()" class="popupBtn" style="margin-left:30px;"> Close </button>
							</div>
						</form>
					</div>
				</div>
				<!------------------------------------------------------------------>

										
				<!--------------- php process to calculate quantity and insert into database ---------------->			
				<?php
					$sql="SELECT *  FROM product";

					$result = mysqli_query($connect, $sql);
					
						if(isset($_POST['updateBtn']))
						{
							$quantity = $_POST['quantity'];
							$update = $_POST['selectOption'];
							$_SESSION['updated'] = $update;
							$productName = $_POST['productName'];

							 if(mysqli_num_rows($result) > 0)
							 {	
							 	foreach ($result as $row)
								{
							 		if($productName == $row['Product_Name'])
									{
										//data to insert into manage_inventory table
										$updatedProductID= $row['Product_ID'];
										$date = date("y/m/d"); 
										$adminID = $_SESSION['adminID'];
										
							 			if($update == 'Add')
										{ 	 										
											//catch quantity value for update
											$_SESSION["addQuantity"] = $quantity;

											//calculate quantity
											$newQuantity = $row['Product_Quantity'] + $quantity;

											//insert new quantity into PRODUCT database
							 				$sql= " UPDATE product SET Product_Quantity = '$newQuantity' WHERE Product_Name = '$productName' ";
							 				$sendSql = mysqli_query($connect, $sql);

											if($sendSql)
											{
												echo "<script>alert('New product quantity have been added!');</script>";
											}
										
							 			}

							 			else
							 			{ 	 
											//catch quantity value for update
											 $_SESSION["deleteQuantity"] = $quantity;
 
											 //calculate quantity
											 $newQuantity = $row['Product_Quantity'] - $quantity;

											//insert new quantity into PRODUCT database
							 				$sql= " UPDATE product SET Product_Quantity = $newQuantity WHERE Product_Name = '$productName' ";
							 				$sendSql = mysqli_query($connect, $sql);
											 if($sendSql)
											 {
												echo "<script>alert('Current product quantity have been deleted!');</script>";
											 }
							 			}
							 		}
							 	}
							
								//insert data into MANAGE_INVENTORY database
								$sql2 = " INSERT INTO manageinventory(ManageInventory_ProductFK, ManageInventory_AdminFK, ManageInventory_Date) 
								VALUES ('$updatedProductID','$adminID','$date')";

								$sendSql2 = mysqli_query($connect, $sql2);			
	
							}		
						 	else 
						 		"query fail";
						 }
					
				?> 
				<!--------------------table------------------------->
				<div class="inv-table">
					<div class="inv-col">
					<div class="group">
						<div class="titleTable"><h2> Product Details </h2></div>
							<div class="btnContainer">
								<button name="searchBtn" id="addBtn" class="addBtn">Add New Product</button>
							</div>
					</div>
						<table class="styled-table table-fixed">
							<thead>
								<tr style='font-family:helvetica; font-size: 18px;'>
									<th>ID</th>
									<th style="padding-left:70px;">Name</th>
									<th style="padding-left:80px;">Price</th>	
									<th style="padding-left:80px;">Desc</th>								
									<th style="padding-left:90px;">Category</th>
									<th style="padding-left:40px;">Quantity</th>
									<th style="padding-left:80px;">Image</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$sql="SELECT * FROM product";
				
								$result2 = mysqli_query($connect, $sql);
								
						
								if(mysqli_num_rows($result2) > 0)
								{	
									
									while($row = mysqli_fetch_assoc($result2))
									{
										echo "<tr class=\"active-row\" style='font-family:helvetica; font-size: 17px;'>";
												
											echo "<td style=\"width:120px;\">". $row["Product_ID"] . "</td>";
											echo "<td style=\"width:370px;\">" . $row["Product_Name"]."</td>";
											echo "<td style=\"width:250px;\"> RM " . $row["Product_Price"]."</td>";					
											echo "<td style=\" padding-left:60px;\">" . $row["Product_Desc"]. "</td>";
											echo "<td style=\" padding-left:45px;\">" . $row["Product_Category"]."<br>(" .$row['Product_Gender']. ")</td>";
											echo "<td style=\"width:100px; padding-left:30px;\">" . $row["Product_Quantity"]."</td>";
											echo "<td ><img src='$row[Product_Image]' style='width:120px; height:130px; margin-left:40px;'></td>";
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
				<hr style="position:sticky; margin-top:60px; margin-right:120px; background:black;">				
				<!------------------------Admin Table--------------------------->				
				<div class="admin-table">
					<div class="admin-col">
						<h2> Updated History </h2>
					<?php
						
						//write sql command
						$sql="SELECT
								manageinventory.*,
								admin.Admin_Username
							FROM
								manageinventory,
								admin
							WHERE
								admin.Admin_ID = manageinventory.ManageInventory_AdminFK";
					
						//send sql commands to mysql
						$sendsql= mysqli_query($connect, $sql);
						
						if($sendsql)
						{
							echo "<table class=\"styled-table table-fixed\">
								<thead>
									<tr>
										<th style=\"padding-left:45px;\">Date Updated</th>
										<th style=\"padding-left:55px;\">Admin ID</th>	
										<th style=\"padding-left:55px;\">Admin Username</th>							
										<th style=\"padding-left:60px;\">Product ID</th>
										<th style=\"padding-left:70px;\">Date Updated</th>
									</tr>
								</thead>
							
								<tbody>";
								
								//looping rows table
								foreach($sendsql as $row)
								{	
									echo "<tr class=\"active-row\">";
										
										echo "<td style=\"width:200px; padding-left:50px;\">". $row['ManageInventory_Date'] . "</td>";
										echo "<td style=\"padding-left:70px; width:100px;\">" . $row["ManageInventory_AdminFK"] ."</td>";
										echo "<td style=\"padding-left:90px; width:200px;\">" . $row["Admin_Username"]."</td>";
										echo "<td style=\"width:200px; padding-left:100px;\">" . $row["ManageInventory_ProductFK"]."</td>";
										echo "<td style=\"width:200px; padding-left:60px;\">" . $row["ManageInventory_Date"]."</td>";
									echo "</tr>";
								
								}
								echo "</tbody>";
							echo"</table>";
						}
						else
							echo "Query Failed";
					?>
				</div>

				<!--------------- popup details for add new product---------------->
			
					<div class="addProductContainer" >
						<div class="addProduct-details">
							<!--------------- title ---------------->
							<div class="title">
								<h2 style="text-align:center;">Add New Product </h2> 
								<hr style="background:black; width:400px;">
							</div>

							<!--------------- content ---------------->
							
							<form action="" method="POST" enctype="multipart/form-data">					
							<div class="InnerContainer">
								<div class="group" style="display:flex">
									<div class="input-quantity" style="margin-left:5px;">
										<Label style="font-size:18px; padding: 5px 0px;"><b>Product ID</b></label>
										<input type="text" class="type-2" id="" name="productID" style="width:170px;">
									</div>

									<div class="input-quantity" style="margin-left:5px;">
										<Label style="font-size:18px; padding: 5px 0px;"><b>Name</b></label>
										<input type="text" class="type-2" id="" name="productName" style="width:200px;">
									</div>
								</div>
								<div class="group" style="display:flex">
									<div class="input-quantity" style="margin-left:5px;">
										<Label style="font-size:18px; padding: 5px 0px;"><b>Price</b></label>
										<input type="text" class="type-2" id="" name="productPrice" style="width:170px;">
									</div>

									<div class="input-quantity" style="margin-left:5px;">
										<Label style="font-size:18px; padding: 5px 0px;"><b>Quantity</b></label>
										<input type="text" class="type-2" id="" name="productQuan" style="width:200px;">
									</div>
								</div>
								<div class="group" style="display:flex">
									<div class="input-quantity" style="margin-left:5px;">
										<Label style="font-size:18px; padding: 5px 0px;"><b>Gender</b></label>
										<input type="text" class="type-2" id="" name="productGen" style="width:170px;">
									</div>

									<div class="input-quantity" style="margin-left:5px;">
										<Label style="font-size:18px; padding: 5px 0px;"><b>Category</b></label>
										<input type="text" class="type-2" id="" name="productCateg" style="width:200px;">
									</div>
								</div>

								<div class="input-quantity" style="margin-left:80px;">
									<Label style="font-size:18px;"><b>Description</b></label><br>
									<textarea rows="5" cols="30" class="type-2" name="productDesc" style="margin-top:10px;">

									</textarea>
								</div>
							
								<div class="addImage" style="margin-left:100px; margin-top:15px;">
									<Label style="font-size:18px;"><b>Add Image: </b></label>
									<input type="file" name="file" style="padding-left:20px;"><br><br>
								</div>

							</div>
							<!--------------- close button ---------------->
								<div style="display: relative; margin-left: auto; margin-right: auto;">
									<button name = "addProductBtn" class="popupBtn" style="margin-left:160px;"> Submit </button>
									<button onclick="togglePopup2()" class="popupBtn" style="margin-left:30px;"> Close </button>
								</div>
							</form>
						</div>
					</div>			
				
						
		</div>
	</div>
	
			
			
			
			
		
	</body>
	
	
	
</html>