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
							header("Location: Print.php?uploadsuccess"); // redirect once confrim
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
			echo "You cannot upload this type of file!";
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
				
				<div class="InnerContainer">
				
					<div style="text-align:center"> 
					
						<img src="Images/Image for users/Thankyou.jpg" style="width:45%;"/>
						
						<form action="Print.php" method="post" target="_blank">
							<button type="submit" name="submit" class="button"> Print receipt</button>
						</form>
						
					</div>
					
					
					
						
				</div>
			</div>
		<!--------------------- Cart table content end -------------------->
<div id="loader" class="center"></div>
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
		
		<script>
		
		
		document.onreadystatechange = function() {
			if (document.readyState !== "complete") {
				document.querySelector(
				"body").style.visibility = "hidden";
				document.querySelector(
				"#loader").style.visibility = "visible";
			} else {
				setTimeout(
  function() 
  {
    	document.querySelector(
				"#loader").style.display = "none";
				document.querySelector(
				"body").style.visibility = "visible";
  }, 2000);
			
			}
			
		};
	</script>
	</body>
</html>