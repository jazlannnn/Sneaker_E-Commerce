<?php
	include "config.php";
	
?>


<!DOCTYPE html>
<html>
	<head>
		<title>	White Canvas | Order History page</title>
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
				
				<h1 style="text-align:center; font-size: 40px; ">Order History</h1>
		
				<div class="InnerContainer">
					<h2 style="">My Order History</h2>
					<hr style="height:2px; color:gray; background-color:grey; width:100%"><br> 
					<?php
					
					if(isset($_SESSION['user_id'])){
						// display user info 
						$userID = $_SESSION["user_id"];
						$sql = "SELECT
									*
								FROM
									orders
								WHERE
									Orders_CustomerFK LIKE '$userID'"; 
												
						$result = mysqli_query($connect, $sql);
										
						if($result)
						{
							echo "<table class='OrderTable'> 
								<tr>
									<th> <font face='Arial'>No.</font> </th>
									<th> <font face='Arial'>Order ID</font> </th> 
									<th> <font face='Arial'>Order date</font> </th> 
									<th> <font face='Arial'>Total expense</font> </th> 
									<th> <font face='Arial'>Details</font> </th> 
									</tr>";
											
							if(mysqli_num_rows($result) > 0)
							{	
								$num = 1;
								while($row = mysqli_fetch_assoc($result))
								{
									echo 
									"<tr> 
										<td>$num</td> 
										<td>$row[Orders_ID]</td> 
										<td>$row[Orders_Date]</td> 
										<td>$row[Orders_TotalPrice]</td> 
										<td ><a href='ViewDetails.php?id=$row[Orders_ID]'> View</a></td> 
									</tr>
									";
									$num += 1;
								}
							}
							echo "</table>";
						}
						else{ 
							"query failed!";
						}
					}
					else{
						echo"
							<div style='text-align:center'>
								<h3 style='color:grey;'>You must login first, click the link below to login</h3>
								<a style='text-decoration:none' href='LoginPage.php'> - Login here -</a>
							</div>
								";
					}
					?>
				</div>
			</div>
		</div>
		<!--------------------- Cart table content end -------------------->
		
		<!--------------- Footer ---------------->
		<div id="footer"></div>
		<!--------------- End of footer---------------->
		
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