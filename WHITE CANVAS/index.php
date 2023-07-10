<?php
	include "config.php";
	require_once('Function.php');
	function console_log($name, $with_script_tags = true) {
		$js_code = 'console.log(' . json_encode($name, JSON_HEX_TAG) . 
	');';
		if ($with_script_tags) {
			$js_code = '<script>' . $js_code . '</script>';
		}
		echo $js_code;
	}
	
	if(isset($_SESSION['user_id']))
		console_log("kenaaa"); 
	else
		console_log("tak kena"); 
		
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<title> White Canvas | Main screen </title>
		
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=Ddevice-width, initial-scale=1.0">
		
		<link rel="stylesheet" href="CSS/index.css" type="text/css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
	</head>
	
	<body onload="currentSlide(1)">
	
	
		<!--------------------- Header (calling header function)-------------------->
		<div id="header"></div>
		<!--------------------- Header End -------------------->
		
		<!--------------------- Welcome -------------------->
		<div style="text-align:center"><img style="width:100%" src="Images/Image for users/KRONEAKERS HEADER.jpg"/></div><br><br>
			
		<!--------------------- Slideshow container ---------------------->
		<div style="width: 100%; background-color: white; height:80%">
			<div class="ImageSlider">
				<figure>
					<img src="Images/Image for users/Header_1.png"/>
					<img src="Images/Image for users/Header_2.png"/>
					<img src="Images/Image for users/Header_5.png"/>
					
				</figure>
			</div>
		</div>
		<br><br>
		
		<div style="text-align: center;"> 
			<hr style="height:2px;border-width:0;color:gray;background-color:gray; width:80%"> 
		</div><br>
		<!--------------------- Slideshow container End---------------------->
		
		<!--------------------- Popular item --------------------------->
		<h1 style="text-align: center;">POPULAR </h1>	
		<hr style="height:8px; color:gray; background-color:gray; width:20%"> 
		
		<div class="PopularContainer">
			<div class="PopularInnerContainer">
			
				<div class="card">
					<img src="Images/Image for users/nike zoom fly.jpg" alt="Denim Jeans" style="width:100%">
					<h1>Nike Zoom Fly 4</h1>
					<p class="price">RM 140.00</p>
					<p>Top selling running shoe, top choice by popular athletes</p>
					<p><button>Add to Cart</button></p>
				</div>
			
				<div class="card">
					<img src="Images/Image for users/Jordan Delta 2.jpg" alt="Denim Jeans" style="width:100%">
					<h1>Jordan Air Max</h1>
					<p class="price">RM 250.00</p>
					<p>Highy quality Jordans, selling fast right now in the market</p>
					<p><button>Add to Cart</button></p>
				</div>
			
				<div class="card">
					<img src="Images/Image for users/Jordan air NFH.jpg" alt="Denim Jeans" style="width:100%">
					<h1>Addidas 119</h1>
					<p class="price">RM 130.00</p>
					<p>Top grade material, with minimalist design and affordable price</p>
					<p><button>Add to Cart</button></p>
				</div>
			</div>
		</div><br>
		
		<div style="text-align: center;"> 
			<hr style="height:2px;border-width:0;color:gray;background-color:gray; width:80%"> 
		</div><br><br>
		<!--------------------- Popular item End --------------------------->
		
		<!--------------- Video End ---------------->
		<div>
			<video style="width:80%; display: block; margin-left: auto; margin-right: auto;" controls >
				<source src= "Video/Advetisement_Video.mp4" type="video/mp4">
			</video>
		</div><br><br>
		<div style="text-align: center;"> 
			<hr style="height:2px;border-width:0;color:gray;background-color:gray; width:80%"> 
		</div><br><br>
		<!--------------- Video End ---------------->
		
		<!--------------- Mens ---------------->
		<div class="Container">
			<div class="InnerContainer">
			
				<div class="genderExplaination">
					<img src="Images/Image for users/MensShopNow.png" style="width:80%">
					<br><br>
					<form action="MensCatalog - Lifestyle.php" method="post">
						<button class="button">Shop Now</button>
					</form>
				</div>
				<img src="Images/Image for users/male pictures.png"/>
			</div>
		</div><br><br>
		
		<div style="text-align: center;"> 
			<hr style="height:2px;border-width:0;color:gray;background-color:gray; width:80%"> 
		</div><br><br>
		
		<!--------------- Womans ---------------->
		<div class="Container">
			<div class="InnerContainer">
				<img src="Images/Image for users/female pictures.png"/>
				<div class="genderExplaination">
					<img src="Images/Image for users/WomenShopNow.png" style="width:80%">
					<br><br>
					<form action="WomensCatalog - Lifestyle.php" method="post">
						<button class="button">Shop Now</button>
					</form>
				</div>
			</div>
		</div>
		
		<br><br>
		<div style="text-align: center;"> 
			<hr style="height:2px;border-width:0;color:gray;background-color:gray; width:80%"> 
		</div>
		<br>
		
		<!--------------- Reviews ---------------->

		<h1 style="text-align: center;">REVIEWS </h1>	
		<hr style="height:8px; background-color:gray; width:20%"><br><br>
		
		<div class="slideshow-container">

			<div class="mySlides">
				<div style="text-align:center"><img style="width:15%" src="Images/reviewers/1.png"/></div><br>
				<q>This shoe store is lit. They have the most fire shoes for every vibe, and the staff is super chill and helpful. I always cop something fresh here, and the prices are legit too.</q>
				<p class="author">Tiara</p>
			</div>

			<div class="mySlides">
				<div style="text-align:center"><img style="width:15%" src="Images/reviewers/2.png"/></div><br>
				<q>Love the variety offered here, plan on investing to bring this company to Mars.</q>
				<p class="author">Joe Flizow</p>
			</div>

			<div class="mySlides">
				<div style="text-align:center"><img style="width:15%" src="Images/reviewers/3.png"/></div><br>
				<q>Worth every penny, with authentic sneakers and affordable.</q>
				<p class="author">Mk </p>
			</div>
			
			<a class="prev" onclick="plusSlides(-1)">❮</a>
			<a class="next" onclick="plusSlides(1)">❯</a>
		</div>

		<div class="dot-container">
			<span class="dot" onclick="currentSlide(1)"></span> 
			<span class="dot" onclick="currentSlide(2)"></span> 
			<span class="dot" onclick="currentSlide(3)"></span> 
		</div>
		<br><br><br>
		<!--------------- Reviews End ---------------->	

		<!--------------- Footer ---------------->
		<div id="footer"></div>
		<!--------------- End of footer---------------->
		
		<!--------------- Javascript---------------->
		<script>
		/*-------------------------- Moving slide ------------------------------*/ 
		
		var slideIndex = 1;
		showSlides(slideIndex);

		function plusSlides(n) {
			showSlides(slideIndex += n);
		}

		function currentSlide(n) {
			showSlides(slideIndex = n);
		}

		function showSlides(n) {
			var i;
			var slides = document.getElementsByClassName("mySlides");
			var dots = document.getElementsByClassName("dot");
			
			if (n > slides.length) {slideIndex = 1}    
			if (n < 1) {slideIndex = slides.length}
			
			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";  
			}
  
			for (i = 0; i < dots.length; i++) {
				dots[i].className = dots[i].className.replace(" active", "");
			}
			slides[slideIndex-1].style.display = "block";  
			dots[slideIndex-1].className += " active";
		}
		/*-------------------------- Moving slide end ------------------------------*/
		
		/*-------------------------- Calling header and footer fucntion ------------------------------*/
		$(function(){
		$("#header").load("Header.php"); 
		$("#footer").load("Footer.php");
		});
		/*-------------------------- header and footer fucntion end ------------------------------*/
		
	</script>
		
	</body>
</html>