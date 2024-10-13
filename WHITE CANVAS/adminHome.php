<?php 
    include "config.php";	
    //query
    $sql="SELECT * FROM customer";
    //check connection
    $stmt = oci_parse($dbconn, $sql);
    oci_execute($stmt);
    
    //process data to get total customer
    $totalCustomer=0;
    while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
        $totalCustomer++;
        $_SESSION['TotalUser'] = $totalCustomer;
    }
    
    //query
    $sql="SELECT * FROM orders";
    //check connection
    $stmt = oci_parse($dbconn, $sql);
    oci_execute($stmt);
    
    //process data to get total orders and total sales
    $totalSales=0;
    $numOrder=0;
    while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
        $totalSales += $row['ORDERS_TOTALPRICE'];
        $numOrder++;

        $_SESSION['TotalSales'] = $totalSales;
        $_SESSION['TotalOrders'] = $numOrder;
    }
    function console_log($username, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($username, JSON_HEX_TAG) . 
    ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }
    console_log($_SESSION['adminID']);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>admin | whiteCanvas </title>  
        <link rel="stylesheet" type="text/css" href="css/adminstyle.css?v=<?php echo time(); ?>">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
                        document.getElementById("mySidebar").style.width = "260px";
                        document.getElementById("main").style.marginLeft = "260px";
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
            <div class="dashboard-container">
                <div class="dashboard-row">
                    <div class="info-col" style="background-color:#fcde67;">
                        <div class="text">     
                            <p><b><?php echo $_SESSION['TotalUser']; ?></b><br><span> Users</span></p>
                        </div>
                        <img class="icon-image" src="img/user.png" style="height: 70px; width: 90px; padding-left:40px;">
                    </div>
                    
                    <div class="info-col" style="background-color:#6db784;">
                        <div class="text">
                            <p><b><?php echo $_SESSION['TotalOrders']; ?></b> <br><span>Orders</span></p>
                        </div>
                        <img class="icon-image" src="img/order.png" style="height: 80px; width: 120px; padding-left:20px;">
                    </div>
                    
                    <div class="info-col-2" style="background-color:#ffbc98;">
                        <div class="text">   
                            <p><b><?php echo $_SESSION['TotalSales']; ?></b> <br><span>Total Sales</span></p>
                        </div>
                        <img class='icon-image' src='img/sales.png' style='height: 70px; width: 75px; padding-left:20px'>
                    </div>                                              
                </div>    

                <div class="graphContainer">
                    <table id="q-graph" >
                        <caption style="font-size: 17px">Product Sold Statistics</caption>
                        <thead>
                            <tr>
                                <th></th>
                                <th class="male" style="font-size:13px;">Male</th>
                                <th class="female" style="font-size:13px;">Female</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="qtr" id="q1">
                                <th scope="row">Lifestyle</th>
                                <td class="male bar" style="height:230px"><p></p></td>
                                <td class="female bar" style="height:150px"><p></p></td>
                            </tr>
                            <tr class="qtr" id="q2">
                                <th scope="row">Jordon</th>
                                <td class="male bar" style="height:188px"><p></p></td>
                                <td class="female bar" style="height:100px"><p></p></td>
                            </tr>
                            <tr class="qtr" id="q3">
                                <th scope="row">Running</th>
                                <td class="male bar" style="height:210px"><p></p></td>
                                <td class="female bar" style="height:180px"><p></p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>    
            </div>
        </div>
    </body>
</html>
