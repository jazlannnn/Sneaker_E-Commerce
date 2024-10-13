<?php
    include "config.php";

    //process to calculate total product and total sales
    $sql = "SELECT order_details.*, product.*
            FROM order_details
            JOIN product ON order_details.OrderDetails_productFK = product.Product_ID";

    $stmt = oci_parse($dbconn, $sql);
    oci_execute($stmt);
        
    $totalQuantity = 0;
    $num = 0;

    if ($stmt) {
        while (($row = oci_fetch_assoc($stmt)) !== false) {
            $totalQuantity += $row['ORDERDETAILS_QUANTITY'];
            $_SESSION['TotalQuantity'] = $totalQuantity;
            $num++;
        }
    } else {
        echo "Query Failed";
    }

    //process to get the latest date
    $sql = "SELECT Orders_Date FROM orders";
    $stmt2 = oci_parse($dbconn, $sql);
    oci_execute($stmt2);

    if ($stmt2) {
        while (($row = oci_fetch_assoc($stmt2)) !== false) {
            $_SESSION['LatetsDate'] = $row["ORDERS_DATE"];
        }
    } else {
        echo "Query Failed";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>admin | whiteCanvas </title>  
        <link rel="stylesheet" type="text/css" href="css/adminstyle.css?v=<?php echo time(); ?>">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <script>
            $(document).ready(function() {
                $("#updating-button").click(function() {
                    var input = document.getElementById('searchProduct').value;
                    var shoesName = ["Nike Air Force 1", "Air hurricane", "Jordan Point", "Nike Pegasus", "Nike Zoom Fly", "Nike ZoomX", "Jordan Delta",
                        "Jordan Point ", "Jordan Gold", "Air Force 1 ", "Vintage X", "Nike RYZ", "Nike Air Zoom", "Nike Revolution ",
                        "Nike Air Tempo", "Air Jordan 11", "Jordan Delta", "Jordan M.A", "Testing Shoes"
                    ];

                    var shoesID = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19"];
                    var product;

                    if (input != 0 && input <= shoesID.length) {
                        for (var a = 0; a <= shoesID.length; a++) {
                            if (input == shoesID[a]) {
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
                })
            });
        </script>
    </head> 
    
    <body>
        <div id="mySidebar" class="sidebar">
            <div class="nav-column">
              <div class="logo-image" style="display:flex;">
                    <img src="img/kroneakers-logo.jpg" class="logo-image"/>
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
                      document.getElementById("mySidebar").style.width = "240px";
                      document.getElementById("main").style.marginLeft = "240px";
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
         
            <!------------------------content--------------------------->
            <div class="sales-container">
                <h2>Company Sales </h2>
                
                    <div class="profit-row">
                
                        <div class="profit-group">
                            <div class="total-profit">
                                <div class="profit-text">    
                                    <p><b>RM 15,000.00<br><span>Annual Target Profit</span></b></p>
                                </div>
                                <img class="icon-image" src="img/profit.png" style="margin: 10px 0 0 5px; height: 90px; width: 115px; ">
                            </div>
                        
                            <div class="progress-sales">
                                <h3>Lifestyle - 80% Sold</h3>
                                <div class="ProgressBar">
                                    <div class="LowerProgressBar" style="width:80%"></div>
                                </div>
                                <h3>Running - 70% Sold</h3>
                                <div class="ProgressBar">
                                    <div class="LowerProgressBar" style="width:60%"></div>
                                </div>
                                <h3>Casual - 64% Sold</h3>
                                <div class="ProgressBar">
                                    <div class="LowerProgressBar" style="width:50%"></div>
                                </div>
                                <h3>Jordan - 80% Sold</h3>
                                <div class="ProgressBar">
                                    <div class="LowerProgressBar" style="width:80%"></div>
                                </div>
                            </div>
                        </div>     

                <div class="item-group">
                        <div class="item-info" style="background-color:#afe1af;">
                            <div class="text">      
                                <p><b><?php echo $_SESSION['TotalQuantity']; ?> </b><br><span>Product Sold</span></p>
                            </div>
                            <img class="icon-image" src="img/shoes.png" style="height: 80px; width: 85px; padding-left:20px">
                        </div>
                        <div class="item-info" style="background-color:#ffb703;">
                            <div class="text">
                                <p><b><?php echo $_SESSION['TotalOrders']; ?> </b> <br><span>Total Order</span></p>
                            </div>
                            <img class="icon-image" src="img/order.png" style="height: 70px; width: 95px;">
                        </div> 
                        <div class="item-info" style="background-color:#ffbc98;">
                            <div class="text">      
                                <p><b>RM <?php echo $_SESSION['TotalSales']; ?> </b><br><span>Total Sales</span></p>
                            </div>
                            <img class="icon-image" src="img/sales.png" style="height: 70px; width: 75px; padding-left:20px">
                        </div>
                </div>
            </div>    
                <div class="sales-text">
                    <p><b>Last Sales Updated: <span style ='color:red;'><?php echo $_SESSION['LatetsDate']; ?></span></b></p>
                </div>
                 <!-- Table  -->
                <div class="salesList-row">
                    <div class="recentSales-col">
                        <h2> Recent Sales </h2>
                        <?php
                            //write sql command
                            $sql = "SELECT orders.Orders_ID, orders.Orders_Date, orders.Orders_TotalPrice, customer.Customer_Username
                                    FROM orders
                                    JOIN customer ON orders.Orders_CustomerFK = customer.Customer_ID
                                    JOIN payment ON orders.Orders_ID = payment.Payment_OrderFK
                                    ORDER BY orders.Orders_Date ASC";

                            //send sql commands to Oracle
                            $stmt3 = oci_parse($dbconn, $sql);
                            oci_execute($stmt3);

                            if ($stmt3) {
                                echo "<table class=\"styled-table table-fixed\">
                                    <thead>
                                        <tr>
                                            <th style='width: 100px;'>No.</th>
                                            <th style='padding-left: 60px;'>Date Sales</th>
                                            <th style='padding-left: 150px;'>Price</th>  
                                            <th style='padding-left: 70px;'>Customer</th>                               
                                        </tr>
                                    </thead>
                                    <tbody>";

                                //looping rows table
                                if (oci_fetch_all($stmt3, $result3) > 0) {
                                    $num = 1;
                                    for ($i = 0; $i < count($result3['ORDERS_ID']); $i++) {
                                        echo "<tr class=\"active-row\">";
                                        echo "<td style='padding-left: 45px; width: 150px;'>" . $num . ")</td>";
                                        echo "<td style='padding-left: 45px;'>" . $result3['ORDERS_DATE'][$i] . "</td>";
                                        echo "<td> RM " . $result3['ORDERS_TOTALPRICE'][$i] . "</td>";
                                        echo "<td style='width: 250px;'>" . $result3['CUSTOMER_USERNAME'][$i] . "</td>";
                                        //echo "<td style='padding-left: 35px;'><button class=\"viewBtn\">View Order</button></td>";
                                        echo "</tr>";
                                        $num++;
                                    }
                                }
                                echo "</tbody>
                                    </table>";
                            } else {
                                echo "Query Failed";
                            }
                        ?>
                    </div>
                </div>
            </div>            
        </div>
    </body>
</html>
