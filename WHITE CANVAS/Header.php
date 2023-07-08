<!DOCTYPE html>
<html lang="en">
	<head>
		<title> White Canvas | Homepage </title>
		
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=Ddevice-width, initial-scale=1.0">
		
		<link rel="stylesheet" href="CSS/HeaderFooter.css" type="text/css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
	</head>
	
	<body>
	
		<!--------------------- Navigation -------------------->
		<div>
			<header>
				<!-- company logo -->
				<img src="Images/Image for users/WHITE CANVAS - LOGO.png" style="width:13%;" />
				
				<!-- Navigation -->
				<div>
					<nav class="navbar">
				
						<a class="dropbtn" href="index.php">Home</a>
				
						<div class="dropdown">
							<button class="dropbtn">About</button>
							<div class="dropdown-content">
								<a href="AboutUsPage.php">About us</a>
								<a href="DevPage.php">Dev. team</a>	
								<a href="FAQ.php">FAQ</a>
								<a href="StoreLocation.php">Store location</a>
								<a href="ContactPage.php">Contact </a>
							</div>
						</div>
				
						<div class="dropdown">
							<button class="dropbtn">Men's</button>
							<div class="dropdown-content">
								<a href="MensCatalog - Lifestyle.php">Lifestyle</a>
								<a href="MensCatalog - Running.php">Running</a>
								<a href="MensCatalog - Jordan.php">Jordan</a>
							</div>
						</div>
				
						<div class="dropdown">
							<button class="dropbtn">Women's</button>
							<div class="dropdown-content">
								<a href="WomensCatalog - Lifestyle.php">Lifestyle</a>
								<a href="WomensCatalog - Running.php">Running</a>
								<a href="WomensCatalog - Jordan.php">Jordan</a>
							</div>
						</div>
				
						<div class="dropdown">
							<button class="dropbtn">Login</button>
							<div class="dropdown-content">
								<a href="LoginPage.php">Login</a>
								<a href="RegisterPage.php">Register</a>	
							</div>
						</div>
					</nav>
				</div>
				
				<!-- user icon -->
				<div class="icon-bar">
					<a class="actives" href="AccountPage.php"><i class="fa fa-user"></i></a>
					<!-- <a href="#"><i class="fa fa-search" class="openBtn" onclick="openSearch()"></i></a>-->
					<a href="CartPage.php"><i class="fa fa-shopping-cart"> </i></a>
					<a href="Logout.php"><i class="fa fa-sign-out"></i></a>
				</div>
				
			</header>
		</div>
		
		<!-- Search bar -->
		<div id="myOverlay" class="overlay">
			<span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
			<div class="overlay-content">
				<form action="/action_page.php">
					<input type="text" placeholder="Search.." name="search">
					<button type="submit"><i class="fa fa-search"></i></button>
				</form>
			</div>
		</div>
		<!--------------------- Navigation End -------------------->
		
		<!--------------- Javascript---------------->
		
		<script>
		/*-------------------------- Search bar ------------------------------*/
		function openSearch(){
			document.getElementById("myOverlay").style.display = "block";
		}

		function closeSearch(){
			document.getElementById("myOverlay").style.display = "none";
		}
		/*-------------------------- Search bar end ------------------------------*/
		
		//id="active" 
		
		</script>
		
	</body>
</html>