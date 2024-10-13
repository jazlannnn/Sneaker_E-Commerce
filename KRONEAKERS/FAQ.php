<!DOCTYPE html>
<html lang="en">
	<head>
		<title> White Canvas | FAQ </title>
		
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=Ddevice-width, initial-scale=1.0">

		<link rel="stylesheet" href="CSS/FAQ.css" type="text/css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
		<link rel="stylesheet" href="CSS/FAQ.css" type="text/css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
		
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
		<h1 style="text-align: center; color:grey">FREQUENTLY ASK QUESTION</h1>	
		<hr style="height:8px; background-color:gray; width:20%"><br>
		
		<div class="OuterContainer">
		      
			
			
			<div class="InnerContainer">
				
				<div class="box" style="font-size:18px; color:grey">
			<p class="heading">FAQs</p>

			<div class="faqs">
			<details>
			<summary style="font-size:26px; color:black"> How do I return a defective or faulty product?</summary>
			<p class"text">We stand behind all of our shoes and gear. If your item is potentially defective or flawed, 
			and it's been less than 30 days since your purchase, simply return the item. If it's been more than 30 days since your purchase,
			please call us to return the item.</p>
			</details><hr><br>
			
			<details>
			<summary style="font-size:26px; color:black"> How do I return a White Canvas store purchase?</summary>
			<p class"text">Purchases made at a White Canvas retail store must be returned to the store. Please note that our store 
			returns policies may differ from our online returns policies. Make sure that you ask the store if you have questions about their policies.</p>
			</details><hr><br>
			
			<details>
			<summary style="font-size:26px; color:black"> Can I exchange an order?</summary>
			<p class"text">The best way to exchange an order is to simply place a new order for the item you want and return the item you already have.</p>
			</details><hr><br>
			
			</div>
			
			
			</div>
		
		</div>
		
		<!--------------- Footer ---------------->
		<div id="footer"></div>
		<!--------------- End of footer---------------->
		
		<script>
		/*-------------------------- Calling header and footer fucntion ------------------------------*/
			$(function(){
				$("#header").load("Header.php"); 
				$("#footer").load("Footer.php");
			});
		/*-------------------------- header and footer fucntion end ------------------------------*/
		</script>
		
	</body>
</html>