<?php
    include "config.php";

    if(isset($_POST["Update_Button"]))
    {
        if(isset($_SESSION['user_id'])){
            $username = $_POST["Username"];
            $password = $_POST["Password"]; 
            $Email = $_POST["Email"];
            $PhoneNumber = $_POST["PhoneNumber"];
            $Address = $_POST["Address"];
        
            $sql = "UPDATE customer 
                    SET Customer_Username = '$username', Customer_Password = '$password', Customer_Email = '$Email',
                        Customer_PhoneNumber = '$PhoneNumber', Customer_Address = '$Address'
                    WHERE Customer_ID = :userID";
                
            $stmt = oci_parse($dbconn, $sql);
            oci_bind_by_name($stmt, ":userID", $_SESSION['user_id']);
            
            $result = oci_execute($stmt);
            
            if($result)
            {    
                echo "<script>alert('Update complete')</script>";
            }
            else 
                echo "<script>alert('Update failed')</script>";
        }
        else 
            echo"<script>alert('You must Login First')</script>";
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>White Canvas | My Account</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=Ddevice-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="CSS/AccountPage.css" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
        
    </head>
    
    <body>
        <!--------------------- Header (calling header function)-------------------->
        <div id="header"></div>
        <!--------------------- Header End -------------------->
        
        <!---------------------  content -------------------->
        
        <div style="height:800px; display:flex; width:100%">
            <div id="mySidebar" class="sidebar">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <a href="AccountPage.php">Account</a>
                <a href="CartPage.php">My Cart</a>
                <a href="OrderHistory.php">My purchase</a>
                <a href="Logout.php">Logout</a>
            </div>

            <div class="main">
                
                <button class="openbtnX" onclick="openNav()">☰ Open Sidebar</button>  
                
                <h1 style="text-align:center; font-size: 40px; ">My Account</h1>
                <hr>

                <div class="InnerContainer">
    
                    <div style="width:30%; background-color:#DBE2EF; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> 
                        <img src="Images/Image for users/AccountDetail.png" style="border-radius:100%; width:100%; height:auto;" alt="User Picture">
                    </div>
                    
                    <br>
    
                    <?php
                    if(isset($_SESSION['user_id']))
                    {
                        $sql = "SELECT * FROM customer WHERE Customer_ID = :userID";
                        
                        $stmt = oci_parse($dbconn, $sql);
                        oci_bind_by_name($stmt, ":userID", $_SESSION['user_id']);
                        oci_execute($stmt);
    
                        while($row = oci_fetch_assoc($stmt))
                        {
                            echo '<ol>';
                            echo '<li> <strong>Username:</strong> '.$row['CUSTOMER_USERNAME'].'</li>';
                            echo '<li> <strong>Password:</strong> '.$row['CUSTOMER_PASSWORD'].'</li>';
                            echo '<li> <strong>Email:</strong> '.$row['CUSTOMER_EMAIL'].'</li>';
                            echo '<li> <strong>Phone Number:</strong> '.$row['CUSTOMER_PHONENUMBER'].'</li>';
                            echo '<li> <strong>Address:</strong> '.$row['CUSTOMER_ADDRESS'].'</li>';
                            echo '</ol>';
                        }
                    }
                    ?>
    
                    <button class="button" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Update account</button>
                    
                    <div id="id01" class="modal">
                        <form class="modal-content animate" action="AccountPage.php" method="post">
                            <div class="imgcontainer">
                                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                            </div>
                        
                            <div class="container">
                                <label for="Username"><b>Username</b></label>
                                <input type="text" placeholder="Enter Username" name="Username" required>
                        
                                <label for="Password"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="Password" required>
                        
                                <label for="Email"><b>Email</b></label>
                                <input type="text" placeholder="Enter Email" name="Email" required>
                                
                                <label for="PhoneNumber"><b>Phone Number</b></label>
                                <input type="text" placeholder="Enter Phone Number" name="PhoneNumber" required>
                                
                                <label for="Address"><b>Address</b></label>
                                <input type="text" placeholder="Enter Address" name="Address" required>
                                    
                                <button type="submit" class="updatebtn" name="Update_Button">Update</button>
                                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
    
            </div>
        </div>
        
        
        <!--------------------- footer (calling footer function) -------------------->
        <div id="footer"></div>
        <!--------------------- footer End -------------------->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="JS/AccountPage.js"></script>
        
    </body>
</html>
