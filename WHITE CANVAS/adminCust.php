<?php 
    include "config.php";	
    //query
    $sql = "SELECT * FROM customer";
    //check connection
    $stmt = oci_parse($dbconn, $sql);
    oci_execute($stmt);
    
    //process data to get total customer
    $totalCustomer = 0;
    while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
        $totalCustomer++;
        $_SESSION['TotalUser'] = $totalCustomer;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>admin | whiteCanvas </title>  
        <link rel="stylesheet" type="text/css" href="css/adminstyle.css?v=<?php echo time(); ?>">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!------ to access Jquery source------->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>

        <!--------------- Javascript ---------------->
        <!------Jquery function to open popup------->
        <script type="text/javascript">
            function togglePopup2() {
                $(".OuterContainer").hide();
                    
            }

            $(document).ready(function(){
                $(".addBtn").click(function(){
                    $(".addProductContainer").toggle();
                });
            })
            
        </script>

    </head> 
    
    <body>
        <div id="mySidebar" class="sidebar">
    
            <div class="nav-column">
              <div class="logo-image" style="display:flex;">
                    <img src="img/logoIcon4.png" class="logo-image"/>
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
              </div>
              <a href="adminHome.php"><img class="img-icon" src="img/list.png" style="height:40px; width:40px;"><p>Dashboard</p></a>
              <a href="adminSales.php"><img class="img-icon" src="img/sales.png"><p>Sales</p></a>
              <a href="adminCust.php"><img class="img-icon" src="img/customer.png"><p>Customers</p></a>
              <a href="adminOrders.php"><img class="img-icon" src="img/order2.png"><p>Orders</p></a>
              <a href="adminInventory.php"><img class="img-icon" src="img/inventory.png"><p>Inventory</p></a>
              <a href="adminAccount.php"><img class="img-icon" src="img/account.png"><p>My Account</p></a>
              <a href="Logout.php"><img class="img-icon" src="img/logout.png"><p>Log out</p></a>
            </div>
        </div>
        
        <div id="main">
            <!------------------------Header--------------------------->
            <div class="admin-header">
              <button class="openbtn" onclick="openNav()">☰</button> 
                <script>
                    function openNav() {
                      //The getElementById() method returns the element that has the ID attribute 
                      document.getElementById("mySidebar").style.width = "220px";
                      document.getElementById("main").style.marginLeft = "220px";
                    }

                    function closeNav() {
                      document.getElementById("mySidebar").style.width = "0";
                      document.getElementById("main").style.marginLeft= "0";
                    }
                </script>
                <div class="admin-name">
                    <img src="img/adminIcon2.png" style="height:80px; width:85px;">
                    <h3><?php echo $_SESSION['adminUsername'] ?></h3>
                </div>                
            </div>
             
             <br><br>  
             <hr style="background:black">
         
            <!------------------------content--------------------------->
            <div class="cust-container">
                <div class="cust-number">
                    <h3><?php echo $_SESSION['TotalUser'] ?> Users</h3>
                    <img class="cust-image" src="img/user.png" >                    
                </div>
                <!-- <div class="search" style="width:100%; display:flex;">
                    <div class="search-text"><b> Search Users: </b></div>
                    <input type="text" name="search" placeholder="Search User..">
                </div> -->
                
                <div class="cust-table">
                    <div class="cust-col">
                        <h2> Customer Details </h2>
                        <?php
                            
                            //write sql command
                            $sql = "SELECT * FROM customer";
                        
                            //send sql commands to Oracle
                            $stmt = oci_parse($dbconn, $sql);
                            oci_execute($stmt);

                            if ($stmt) {
                                echo "<table class=\"styled-table table-fixed\">
                                    <thead>
                                        <tr>
                                            <th style=\"padding-left:45px;\">User</th>
                                            <th style=\"padding-left:55px;\">ID</th>
                                            <th style=\"padding-left:135px;\">Address</th>                                
                                            <th style=\"padding-left:150px;\">Phone Num.</th>
                                            <th style=\"padding-left:100px;\">Email</th>
                                            <th style=\"padding-left:210px;\">Delete</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>";
                                    
                                    //looping rows table
                                    while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {    
                                        echo "<tr class=\"active-row\">";
                                            
                                            echo "<td><div data-tooltip=". $row['CUSTOMER_USERNAME'].">
                                                        <img class=\"user-img\" src=\"img/customer.png\">
                                                    </div>
                                                    </td>";
                                            echo "<td style=\"padding-left:10px; width:200px;\">" . $row["CUSTOMER_ID"]."</td>";
                                            echo "<td style=\"width:450px;\">" . $row["CUSTOMER_ADDRESS"]."</td>";
                                            echo "<td>" . $row["CUSTOMER_PHONENUMBER"]. "</td>";
                                            echo "<td>" . $row["CUSTOMER_EMAIL"]."</td>";   
                                            echo "<td><div class='wrap'><a onClick=\"javascript: return confirm('Are you sure you want to delete this customer?');\" href='deleteCustomer.php?id=".$row['CUSTOMER_ID']."'><button class=\"styleBtn\">Delete</button></a></div></td>";
                                            echo "</tr>";
                                
                                    }
                                    echo "</tbody>";
                                echo"</table>";
                            } else {
                                echo "Query Failed";
                            }
                        ?>
                    </div>
                </div>
            </div>

            <!--------------- popup details---------------->
            <div class="CustomerOuterContainer" >
                <div class="customer-details">
                    <!--------------- title ---------------->
                    <div class="title">
                        <h2 style="text-align:center;">Customer Details </h2> 
                        <hr style="background:black; width:400px;">
                    </div>

                    <!--------------- content ---------------->
					
					<form action="" method="POST">					
						<div class="InnerContainer">
							<div class="group" style="display:flex">
								<div class="input-quantity" style="margin-left:5px;">
									<Label style="font-size:18px; padding: 5px 0px;"><b>Customer ID</b></label>
									<input type="text" class="type-2" id="" name="productName" style="width:170px;">
								</div>

								<div class="input-quantity" style="margin-left:5px;">
									<Label style="font-size:18px; padding: 5px 0px;"><b>Username</b></label>
									<input type="text" class="type-2" id="" name="productName" style="width:200px;">
								</div>
							</div>
							<div class="group" style="display:flex">
								<div class="input-quantity" style="margin-left:5px;">
									<Label style="font-size:18px; padding: 5px 0px;"><b>Phone Number</b></label>
									<input type="text" class="type-2" id="" name="productName" style="width:170px;">
								</div>

								<div class="input-quantity" style="margin-left:5px;">
									<Label style="font-size:18px; padding: 5px 0px;"><b>Email</b></label>
									<input type="text" class="type-2" id="" name="productName" style="width:200px;">
								</div>
							</div>

							<div class="input-quantity" style="margin-left:5px;">
								<Label style="font-size:18px; padding: 5px 0px;"><b>Address</b></label><br>
								<textarea rows="5" cols="30" class="type-2" name="address">
		
								</textarea>
							</div>

						</div>
					<!--------------- close button ---------------->
						<div style="display: relative; margin-left: auto; margin-right: auto;">
							<button name = "popupBtn" class="updateBtn" style="margin-left:160px;"> Submit </button>
							<button onclick="togglePopup2()" class="popupBtn" style="margin-left:30px;"> Close </button>
						</div>
					</form>
				</div>
			</div>		

		</div>		
	</div>
</body>	
</html>

