<?php
	// include "config.php";
	
	// if(isset($_POST["Submit_Button"]))
	// {
	// 	$username = $_POST["Username"];
	// 	$password = $_POST["Password"]; 
	// 	$user = $_POST["User"];
		
	// 	if( $user == "Customer")
	// 	{ 
	// 		$sql = "SELECT * 
	// 				FROM customer
	// 				WHERE Customer_Username = '$username' 
	// 				AND Customer_Password = '$password'";
				
	// 		$sendsql = mysqli_query($dbconn, $sql);
		
	// 		if($sendsql)
	// 		{
	// 			if(mysqli_num_rows($sendsql) > 0)
	// 			{	
	// 				while($row = mysqli_fetch_assoc($sendsql))
	// 				{
	// 					$_SESSION['user_id'] = $row['Customer_ID'];			
	// 				}
	// 				echo "<script> 
				
	// 						alert('You have successfully login, Welcome $username !!!');
	// 						window.location.href='index.php';
	// 					</script>"; 
	// 				exit();
	// 			}
	// 			else 
	// 			{
	// 				echo "<script>alert('You enter the wrong password')</script>";
	// 				echo "<script>window.location = 'LoginPage.php'</script>";
	// 			}
	// 		}
	// 		else
	// 		{
	// 			"query fail";
	// 		}				
				
	// 	}
	// 	else
	// 	    if ( $user == "Admin")
	// 		{
	// 			$sql = "SELECT * 
	// 			FROM admin
	// 			WHERE Admin_Username = '$username' 
	// 			AND password = '$password'";
				
	// 			$sendsql = mysqli_query($connect, $sql);
		
	// 			if($sendsql)
	// 			{
	// 				if(mysqli_num_rows($sendsql) > 0)
	// 				{	
	// 					while($row = mysqli_fetch_assoc($sendsql))
	// 					{
	// 						$_SESSION['adminUsername'] = $row['Admin_Username'];
	// 						$_SESSION['adminID'] = $row['Admin_ID'];		
	// 					}
	// 					header("Location:adminHome.php"); 
	// 					exit();
	// 				}
	// 			}
	// 			else
	// 			{
	// 				echo "<script>alert('You enter the wrong password')</script>";
	// 				echo "<script>window.location = 'LoginPage.php'</script>";
	// 			}
	// 		}
	// 		else 
	// 		{
	// 			echo "<script>alert('Please select user type')</script>";
	// 			echo "<script>window.location = 'LoginPage.php'</script>";
	// 		}
	// }


	include "config.php";
	
	if(isset($_POST["Submit_Button"]))
	{
		$username = $_POST["Username"];
		$password = $_POST["Password"]; 
		$user = $_POST["User"];
		
		if($user == "Customer")
		{ 
			$sql = "SELECT * 
					FROM customer
					WHERE Customer_Username = :username
					AND Customer_Password = :password";
				
			$sendsql = oci_parse($dbconn, $sql);
			oci_bind_by_name($sendsql, ":username", $username);
			oci_bind_by_name($sendsql, ":password", $password);
			
			if(oci_execute($sendsql))
			{
				if(oci_fetch($sendsql))
				{	
					$_SESSION['user_id'] = oci_result($sendsql, 'CUSTOMER_ID');			
					
					echo "<script> 
							alert('You have successfully logged in, Welcome $username!');
							window.location.href='index.php';
						</script>"; 
					exit();
				}
				else 
				{
					echo "<script>alert('You entered the wrong password')</script>";
					echo "<script>window.location = 'LoginPage.php'</script>";
				}
			}
			else
			{
				echo "Query failed: " . oci_error($dbconn);
			}	
		}
		else if ($user == "Admin")
		{
			$sql = "SELECT * 
					FROM admin
					WHERE Admin_Username = :username
					AND password = :password";
				
			$sendsql = oci_parse($dbconn, $sql);
			oci_bind_by_name($sendsql, ":username", $username);
			oci_bind_by_name($sendsql, ":password", $password);
			
			if(oci_execute($sendsql))
			{
				if(oci_fetch($sendsql))
				{	
					$_SESSION['adminUsername'] = oci_result($sendsql, 'ADMIN_USERNAME');
					$_SESSION['adminID'] = oci_result($sendsql, 'ADMIN_ID');
					
					header("Location: adminHome.php"); 
					exit();
				}
				else 
				{
					echo "<script>alert('You entered the wrong password')</script>";
					echo "<script>window.location = 'LoginPage.php'</script>";
				}
			}
			else
			{
				echo "Query failed: " . oci_error($dbconn);
			}
		}
		else 
		{
			echo "<script>alert('Please select user type')</script>";
			echo "<script>window.location = 'LoginPage.php'</script>";
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>White Canvas | Login page</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
		<link rel="stylesheet" href="CSS/LoginPage.css" type="text/css" />
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	</head>
	
	<body>
	<?php
function console_log($username, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($username, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}?>

		<!-- Header (calling header function) -->
		<div id="header"></div>
		<!-- Header End -->

		<!-- Content -->
		<div style="background-color:#F9F7F7"><br><br><br></div>
		<div class="Container">
			<div class="InnerContainer">
				<div class="loginimage">
					<img src="Images/Image for users/loginImage.png" style="width:100%"/>
				</div>
				
				<div class="loginDiv"> 
					<div style="width:90%;margin-left: auto; margin-right: auto; text-align:center"><br>
						<img src="Images/Image for users/WHITE CANVAS - LOGO.png" style="width:45%;"/>
						
						<!-- FORM -->
						<form action="" method="post">
							<h2 style="text-align:center; color:#3F72AF; font-family:arial"> Login </h2>
		
							<div class="radioBtn">
								<input type="radio" name="User" value="Customer"> Customer
								<input type="radio" name="User" value="Admin"> Administrator
							</div><br>
						
							<div class="input-container">
								<i class="fa fa-user icon"></i>
								<input class="input-field" type="text" placeholder="Username" name="Username">
							</div>

							<div class="input-container">
								<i class="fa fa-key icon"></i>
								<input class="input-field" type="password" placeholder="Password" name="Password">
							</div>

							<button type="submit" class="btn" name="Submit_Button">Login</button>
						</form>
					</div><br>
					
					<div>
						<p>Don't have an account?&#160 <a style="text-decoration:none" href="RegisterPage.php">Register here</a> </p>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer -->
		<div id="footer"></div>
		<!-- End of footer -->
		
		<script>
			/* Search bar */
			function openSearch() {
				document.getElementById("myOverlay").style.display = "block";
			}

			function closeSearch() {
				document.getElementById("myOverlay").style.display = "none";
			}
			
			/* Calling header and footer function */
			$(function(){
				$("#header").load("Header.php"); 
				$("#footer").load("Footer.php");
			});
		</script>
	</body>
</html>
