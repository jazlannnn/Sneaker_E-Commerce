<!DOCTYPE html>
<html lang="en">
	<head>
		<title> White Canvas | About </title>
		
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=Ddevice-width, initial-scale=1.0">

		<link rel="stylesheet" href="CSS/AboutUsPage.css" type="text/css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
	</head>
	
	<body>
	
		<!--------------------- Header (calling header function)-------------------->
		<div id="header"></div>
		<!--------------------- Header End -------------------->
		
		<!--------------------- Page Image banner -------------------->
		<div><img src="Images/Image for users/AboutUsBanner.png" style="width: 100%" /></div>
		
		<!--------------------- About us navigation -------------------->
		<div class="AboutUsNavigation">
			<!-- Centered link -->
			<div class="InnerAboutUsNavigation">
				<a href="AboutUsPage.php" class="hover-underline-animation">About us</a>
				<a href="DevPage.php" class="hover-underline-animation">Dev. team</a>
				<a href="FAQ.php" class="hover-underline-animation">FAQ</a>
				<a href="StoreLocation.php" class="hover-underline-animation">Location</a>
				<a href="ContactPage.php"class="hover-underline-animation">Contact</a>
			</div>
		</div>

		<!--------------------- About us navigation End -------------------->
		
		<!--------------------- Our story -------------------->
		<h1 style="text-align: center; color:grey">OUR STORY </h1>	
		<hr style="height:8px; background-color:gray; width:20%"><br>
		
		<div class="OuterContainer">
			
			<div class="InnerContainer">
				
				<div style="width:35%;"><br><br>
					<img src="Images/Image for users/AboutUsImage.jpg"  class="ImageOurStory" style="width:80%" />
				</div>	
				
				<div style="width:65%; float:right"><br><br>
					<p style="font-size: 26px; text-align: justify; font-family: arial; color:grey"> Our business sells various types of branded shoes such as Nike, Adidas, etc. 
					this can be categorizes into various categories such as Lifestyle, Running shoes, formal and Jordans.</p>
					<ul style="list-style-type: circle;color:grey">
						<h3>Mission:</h3><br>
						<li>To become a Leading Shoe E-Commerce company in Malaysia offering a wide variety of 
						attractive shoe designs, affordable and high-quality shoes and Provide Satisfactory Services to Customers</li><br>
						<h3>Vision:</h3><br>
						<li>To bring satisfactory result to our loyal customer base and can further develop our business in Malaysia 
						and able to meet the needs of all our customers.</li>
					</ul>
				</div>	
		
			</div>
			
			
		
		</div>
		
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