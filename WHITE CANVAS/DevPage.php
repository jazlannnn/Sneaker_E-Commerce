<!DOCTYPE html>
<html lang="en">
	<head>
		<title> White Canvas | Developer team </title>
		
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=Ddevice-width, initial-scale=1.0">

		<link rel="stylesheet" href="CSS/DevPage.css" type="text/css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
		
		<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {background-color: #f2f2f2;}
</style>
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
		<h1 style="text-align: center; color:grey">DEVELOPERS</h1>	
		<hr style="height:5px; background-color:gray; width:20%"><br>
		
		<div class="InnerContainer">
			<table>
  <tr>
  <th>Images</th>
  <th>Name</th>
  <th>Position</th>
  <th>Contact Number</th>
  <th>Email</th>
  </tr>
  <tr>
  <td><img src="Images/Developers/dev1.jpg" style="width: 30%" /></td>
  <td>AZLIE JOHARI</td>
  <td>Project Manager</td>
  <td>018-6689368</td>
  <td>johariazlie@gmail.com</td>
  </tr>
  <tr>
  <td><img src="Images/Developers/dev2.png" style="width: 30%" /></td>
  <td>MUHD. DZIKRULLAH BIN KALANA</td>
  <td>Database Designer</td>
  <td>012-3013035</td>
  <td>muhddzikrullah199@gmail.com</td>
  </tr>
  <tr>
  <td><img src="Images/Developers/dev4.png" style="width: 30%" /></td>
  <td>MUHAMMAD FIRDAUS BIN ROSLI</td>
  <td>Programmer</td>
  <td>019-9422124</td>
  <td>mfirdausrosli13@gmail.com</td>
  </tr>
  <tr>
  <td><img src="Images/Developers/dev3.png" style="width: 30%" /></td>
  <td>MUHAMMAD AIMAN BIN KAMARUDIN</td>
  <td>Programmer</td>
  <td>016-6714542</td>
  <td>aimansmkam@gmail.com</td>
  </tr>
</table>
		</div>
	<br><br>	
		
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