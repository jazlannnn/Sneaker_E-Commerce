<?php
	include "config.php";
	
	// upload payment
	if(isset($_POST['submit'])){
		$file = $_FILES['file'];
		
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
					If(isset($_SESSION['order']))
					{
						$OrderID = $_SESSION['order']; // get order ID
							
						$fileNameNew = uniqid('', true).".".$fileActualExt;
						$fileDestination = 'Uploads/'.$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);
						//header("Location: index.php?uploadsuccess");
					
						$sql = "INSERT INTO `payment` (Payment_Proof, Payment_OrderFK)
								VALUES ('$fileDestination','$OrderID')";
		
						$sendsql = mysqli_query($connect, $sql);
		
						if($sendsql)
						{	
							echo"<script>alert('Payment successfull')</script>";
							echo "<script>window.location = 'PaymentPage.php'</script>";
							echo "alert('Payment Successful');";
							header("Location: SuccessfulPayment.php?uploadsuccess"); // redirect once confrim
						}
						else 
							echo "failed!";
					}
				} else{
					echo"<script>alert('Your file is too big!')</script>";
				}
			}else{
				echo "There was an error uploading your filer!";
			} 
				
		} else {
			echo"<script>alert('Please upload your payment proof')</script>";
		}
		
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>	White Canvas | Payment page</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=Ddevice-width, initial-scale=1.0">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
		<link rel="stylesheet" href="CSS/PaymentPage.css" type="text/css" />
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
				
				<button class="openbtnX" onclick="openNav()">☰ Open Sidebar</button>  
				
				<h1 style="text-align:center; font-size: 40px; ">Payment</h1>
				
				<div class="AboutUsNavigation">
					<div class="InnerAboutUsNavigation">
						<a href="CartPage.php" class="hover-underline-animation"style="color:grey">Step 1: Confirm cart item </a>
						<i class="fa fa-chevron-right" aria-hidden="true" style="color:grey"></i>
						<a href="BillingAddress.php" class="hover-underline-animation" style="color:grey">Step 2: Confirm Details</a>
						<i class="fa fa-chevron-right" aria-hidden="true"></i>
						<a href="PaymentPage.php" class="hover-underline-animation" ><b>Step 3: Payment</b></a>
					</div>
				</div><br><hr><br>
		
				
				<div class="InnerContainer">
				
					<div class = "RegisterDiv"> 
						<h2 style="">Proof of Payment</h2>
						<hr style="height:4px; color:grey; background-color:grey; width:100%">
						<div style="width:80%;">
						
						<h4 style="font-family:arial;">Transfer To :</h4>
						<h4 style="font-family:arial;"> WHITE CANVAS 11112342355 CIMB BANK</h4>
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
								$result = mysqli_query($connect, $sql);
		
								if($result)
								{
									if(mysqli_num_rows($result) > 0)
									{	
										while($row = mysqli_fetch_assoc($result)){
												
										echo"<ol class='listStyle'>
												<li><b>Username     :</b> $row[Customer_Username] </li>
												<li><b>Email        :</b> $row[Customer_Email] </li> 
												<li><b>Phone num   :</b> $row[Customer_PhoneNumber] </li> 
												<li><b>Address      :</b> $row[Customer_Address] </li>
												<li><b>Date ordered :</b> $row[Orders_Date] </li>													
												<li><b>Total charge :</b> RM $row[Orders_TotalPrice]</li>
											</ol>
											<hr>
											
											<p> Upload your payment here</p>
											<p style='color:red'> File type: Pdf, png and jpg only*</p>
													";		
										}
									}
								}
								else
								{ 
									echo "query failed!";
								}
							?>
							
							<form action="PaymentPage.php" method="post" enctype="multipart/form-data">
								<input type="file" name="file" style="font-size:18px;"><br><br>
								<button type="submit" name="submit" class="CAncelbutton"> Confirm Payment </button>
							</form>
							
						</div><br>
					</div>
					
					
					<img src="Images/Image for users/Payment.jpg" style="width:90%; "/>
					
						
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