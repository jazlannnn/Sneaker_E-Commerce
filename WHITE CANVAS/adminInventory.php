<?php
    include "config.php";

    // upload product image
    if(isset($_POST['addProductBtn'])){
        //getting data
        $file = $_FILES['file'];
        $productID = $_POST['productID'];
        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $productDesc = $_POST['productDesc'];
        $productQuantity = $_POST['productQuan'];
        $productGender = $_POST['productGen'];
        $productCategory = $_POST['productCateg'];

        // getting file info
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
        
        $filesExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($filesExt));
        
        // pick what types of files are allowed
        $allowed = array('jpg', 'pdf', 'png');
        
        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 1000000)
                {    
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = 'Uploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    
                    $sql = "INSERT INTO product (Product_ID, Product_Name, Product_Price, Product_Desc, Product_Quantity, Product_Gender, Product_Category, Product_Image) 
                            VALUES (:productID, :productName, :productPrice, :productDesc, :productQuantity, :productGender, :productCategory, :fileDestination)";

                    $stmt = oci_parse($dbconn, $sql);

                    oci_bind_by_name($stmt, ':productID', $productID);
                    oci_bind_by_name($stmt, ':productName', $productName);
                    oci_bind_by_name($stmt, ':productPrice', $productPrice);
                    oci_bind_by_name($stmt, ':productDesc', $productDesc);
                    oci_bind_by_name($stmt, ':productQuantity', $productQuantity);
                    oci_bind_by_name($stmt, ':productGender', $productGender);
                    oci_bind_by_name($stmt, ':productCategory', $productCategory);
                    oci_bind_by_name($stmt, ':fileDestination', $fileDestination);

                    $result = oci_execute($stmt, OCI_DEFAULT);
                    if ($result) {
                        oci_commit($dbconn);
                        echo "<script>alert('Add new product successfully');</script>";
                    } else {
                        oci_rollback($dbconn);
                        $error = oci_error($stmt);
                        echo "Failed: " . $error['message'];
                    }
                } else {
                    echo "<script>alert('Your file is too big!');</script>";
                }
            } else {
                echo "There was an error uploading your file!";
            }   
        } else {
            echo "You cannot upload this type of file!";
        }   
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>admin | whiteCanvas </title>  
        <link rel="stylesheet" type="text/css" href="css/adminstyle.css?v=<?php echo time(); ?>">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Include jQuery library -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        
        <!-- jQuery function to open popup -->
        <script>
            function togglePopup2() {
                $(".OuterContainer").hide();
            }

            $(document).ready(function(){
                $("#addBtn").click(function(){
                    $(".addProductContainer").toggle();
                });
            });
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
            <!-- Header -->
            <div class="admin-header">
                <button class="openbtn" onclick="openNav()">☰</button> 
                <script>
                    function openNav() {
                        document.getElementById("mySidebar").style.width = "260px";
                        document.getElementById("main").style.marginLeft = "260px";
                    }

                    function closeNav() {
                        document.getElementById("mySidebar").style.width = "0";
                        document.getElementById("main").style.marginLeft = "0";
                    }
                </script>
                <div class="admin-name">
                    <img src="img/adminIcon2.png" style="height:80px; width:85px;">
                    <h3><?php echo $_SESSION['adminUsername'] ?></h3>
                </div>                
            </div>
             
            <br><br>  
            <hr style="background:black">
         
            <!-- Content -->
            <div class="inventory-container">
                <div class="inventory-number">
                    <h3>Current Inventory</h3>
                    <img class="inventory-image" src="img/inventory.png">                    
                </div>
                <div class="search" style="width:100%;">
                    <div class="search-text" style="width:100%;  display:flex;"><b> Update Product: </b>
                            <input type="number" id="searchProduct" name="searchID" placeholder="Search product ID.." value=""> 
                            <button id="updating-button" class="addBtn" style="width: 100px; height:40px; margin-left:15px; border-radius: 25px; background: rgb(221, 157, 19);">Search</button>
                    </div>
                    <!-- <form action="PaymentPage.php" method="post" enctype="multipart/form-data">

                    </form> -->
                </div>

                <script>
                    $(document).ready(function(){
                        $("#updating-button").click(function(){
                            var input = document.getElementById('searchProduct').value;
                            var shoesName = ["Nike Air Force 1", "Air hurricane", "Jordan Point", "Nike Pegasus", "Nike Zoom Fly", "Nike ZoomX", "Jordan Delta", 
                                             "Jordan Point ", "Jordan Gold", "Air Force 1 ", "Vintage X", "Nike RYZ", "Nike Air Zoom", "Nike Revolution ", 
                                             "Nike Air Tempo","Air Jordan 11", "Jordan Delta", "Jordan M.A", "Testing Shoes"];

                            var shoesID = ["1", "2", "3", "4", "5", "6" , "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19"];
                            var product;

                            if(input != 0 && input <= shoesID.length) {                                 
                                for(var a=0; a<=shoesID.length; a++) {                                     
                                    if(input == shoesID[a]) {
                                        product = shoesName[a];
                                        document.getElementById('type-2').value = product;
                                        $(".OuterContainer").toggle();
                                        $(".inv-table").hide();                        
                                    }
                                }
                            } else {
                                input = "";
                                alert("Product not available or does not exist!");
                            }

                            <?php $productID = "<script> document.write(input); </script>"; ?>
                        });
                    });
                </script>

                <!-- Popup details for updating product -->
                <div class="OuterContainer">
                    <div class="updating-details">
                        <!-- Title -->
                        <div class="title">
                            <h2 style="text-align:center;">Update Product </h2> 
                            <hr style="background:black; width:400px;">
                        </div>

                        <!-- Content -->
                        <form action="" method="POST">                    
                            <div class="InnerContainer">
                                <div class="input-quantity" style="margin-left:5px;">
                                    <label style="font-size:22px; padding: 5px 0px;"><b>Product Name</b></label>
                                    <input type="text" class="type-2" id="type-2" name="productName">
                                </div>

                                <div class="input-quantity">
                                    <label style="font-size:22px; padding: 5px 8px;"><b>Update Options</b></label>
                                    <div class="select">
                                         <select name="selectOption" id="select">
                                            <option value="Add">Add quantity</option>
                                            <option value="Delete">Delete quantity</option>
                                        </select> 
                                    </div>                                
                                </div>

                                <div class="input-quantity" style="margin-left:5px;">
                                    <label style="font-size:22px; padding: 5px 0px;"><b>Quantity</b></label>
                                    <input type="text" name="quantity" class="type-2" placeholder="Enter Quantity">
                                </div>
                                
                                <span class="focus"></span>
                            </div>
                            <!-- Close button -->
                            <div style="display: relative; margin-left: auto; margin-right: auto;">
                                <button name="updateBtn" class="popupBtn" style="margin-left:160px;"> Submit </button>
                                <button onclick="togglePopup2()" class="popupBtn" style="margin-left:30px;"> Close </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End of Popup details for updating product -->

                <!-- PHP process to calculate quantity and insert into database -->
                <?php
                    $sql = "SELECT * FROM product";

                    $stmt = oci_parse($dbconn, $sql);
                    oci_execute($stmt);

                    if(isset($_POST['updateBtn'])) {
                        $quantity = $_POST['quantity'];
                        $update = $_POST['selectOption'];
                        $_SESSION['updated'] = $update;
                        $productName = $_POST['productName'];

                        while($row = oci_fetch_assoc($stmt)) {
                            if($productName == $row['PRODUCT_NAME']) {
                                $updatedProductID = $row['PRODUCT_ID'];
                                $date = date("y/m/d");
                                $adminID = $_SESSION['adminID'];

                                if($update == 'Add') {
                                    $_SESSION["addQuantity"] = $quantity;
                                    $newQuantity = $row['PRODUCT_QUANTITY'] + $quantity;
                                } else {
                                    $_SESSION["deleteQuantity"] = $quantity;
                                    $newQuantity = $row['PRODUCT_QUANTITY'] - $quantity;
                                }

                                // Update the quantity in the PRODUCT table
                                $sql = "UPDATE product SET PRODUCT_QUANTITY = :newQuantity WHERE PRODUCT_NAME = :productName";
                                $stmt = oci_parse($dbconn, $sql);
                                oci_bind_by_name($stmt, ':newQuantity', $newQuantity);
                                oci_bind_by_name($stmt, ':productName', $productName);
                                oci_execute($stmt, OCI_DEFAULT);

                                if ($result) {
                                    oci_commit($dbconn);
                                    echo "<script>alert('Product quantity has been updated!');</script>";
                                } else {
                                    oci_rollback($dbconn);
                                    $error = oci_error($stmt);
                                   echo "Failed: " . $error['message'];
                                }
                            }
                        }
                    }
                ?>

                <!-- Inventory Table -->
                <div class="inv-table">
                    <table>
                        <thead>
                            <tr>
                                <th style="text-align:center;">Product ID</th>
                                <th style="text-align:center;">Product Name</th>
                                <th style="text-align:center;">Product Price (RM)</th>
                                <th style="text-align:center;">Product Description</th>
                                <th style="text-align:center;">Product Quantity</th>
                                <th style="text-align:center;">Product Gender</th>
                                <th style="text-align:center;">Product Category</th>
                                <th style="text-align:center;">Product Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = oci_fetch_assoc($stmt)){
                                    echo "<tr>";
                                    echo "<td style='text-align:center;'>" . $row['PRODUCT_ID'] . "</td>";
                                    echo "<td style='text-align:center;'>" . $row['PRODUCT_NAME'] . "</td>";
                                    echo "<td style='text-align:center;'>" . $row['PRODUCT_PRICE'] . "</td>";
                                    echo "<td style='text-align:center;'>" . $row['PRODUCT_DESC'] . "</td>";
                                    echo "<td style='text-align:center;'>" . $row['PRODUCT_QUANTITY'] . "</td>";
                                    echo "<td style='text-align:center;'>" . $row['PRODUCT_GENDER'] . "</td>";
                                    echo "<td style='text-align:center;'>" . $row['PRODUCT_CATEGORY'] . "</td>";
                                    echo "<td style='text-align:center;'>" . $row['PRODUCT_IMAGE'] . "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>            
            </div>          
        </div>
    </body>
</html>
