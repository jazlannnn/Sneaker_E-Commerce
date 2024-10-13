<?php
	// Include the Oracle database connection configuration file
	include "config.php";
	
	if(isset($_POST["Register_Button"]))
	{
		$username = $_POST["Username"];
		$password = $_POST["Password"]; 
		$Email = $_POST["Email"];
		$PhoneNumber = $_POST["PhoneNumber"];
		$Address = $_POST["Address"];
		
		$sql = "SELECT 
					Customer_Username
				FROM customer
				WHERE Customer_Username = '$username'";
		
		$sendsql = oci_parse($dbconn, $sql);
		oci_execute($sendsql);
		
		if($sendsql)
		{
			if(oci_fetch($sendsql))
			{	
				echo "<script>alert('Username already exists')</script>";						
			}
			else{
				
				$sql = "INSERT INTO customer (Customer_Username, Customer_Password, Customer_Email, Customer_PhoneNumber, Customer_Address)
					VALUES ('$username','$password','$Email','$PhoneNumber','$Address')";
					
				$sendsql = oci_parse($dbconn, $sql);
				oci_execute($sendsql);
		
				if($sendsql)
				{	
					echo "<script> 
							alert('Registration complete');
							window.location.href='LoginPage.php';
						</script>"; 
				}
				else 
					echo "<script>alert('Registration failed')</script>";	
			}
		}
		else{
			echo "Query failed";
		}
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>	White Canvas | Register page</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=Ddevice-width, initial-scale=1.0">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
		<link rel="stylesheet" href="CSS/RegisterPage.css" type="text/css" />
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
	</head>
	
	<body>
		<!--------------------- Header (calling header function)-------------------->
		<div id="header"></div>
		<!--------------------- Header End -------------------->
		
		<!--------------------- Register content -------------------->
		
		<div class="Container">
			<div class="InnerContainer">
				
				<div style="width:70%; background-color:#DBE2EF; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> 
					<img src="Images/Image for users/newregister.png" style="width:100%; "/>
				</div>
				
				<div class = "RegisterDiv"> 
					<div style="margin-left: auto; margin-right: auto; text-align:center;"><br>
						<h2 style="text-align:center">Register here</h2>
						
						<!--------------------- Register form -------------------->
						<form action="RegisterPage.php" method="post">
								
							<div style="display:block; margin-bottom: 10px;">
								<input class="input-field1" type="text" placeholder="Username" name="Username" required>
									
								<input class="input-field1" type="password" placeholder="Password" name="Password" required>
								
								<input class="input-field1" type="text" placeholder="Email" name="Email" required>
									
								<input class="input-field1" type="text" placeholder="Phone Number" name="PhoneNumber" required>
								
								<input class="input-field1" type="text" placeholder="Address" name="Address" required>
							</div>
						
							<button type="submit" class="btn" name="Register_Button">Register</button>	
							
						</form>
					</div>
					<br>
					
					<div><p>Already have an account?&#160 <a style="text-decoration:none" href="LoginPage.php">Login here</a> </p></div>
				</div>
			</div>
		</div>
		<!--------------------- Register content -------------------->
		
		<!--------------- Footer ---------------->
		<div id="footer"></div>
		<!--------------- End of footer---------------->
		
		<script>
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
