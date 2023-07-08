<?php
    // import database
    include "config.php";
    // import function
    require_once('Function.php');

    // add item to cart
    if (isset($_POST['Add'])) {

        // if session already has been created
        if (isset($_SESSION['user_id'])) {
            if (isset($_SESSION['cart'])) {
                // output item already in cart
                $item_array_id = array_column($_SESSION['cart'], 'product_id');

                // product already selected
                if (in_array($_POST['product_id'], $item_array_id)) {
                    echo "<script>alert('Item is already added to cart')</script>";
                    echo "<script>window.location = 'MensCatalog - Lifestyle.php'</script>";
                } else {
                    // put item in cart (into session array)
                    $count = count($_SESSION['cart']);
                    $item_array = array(
                        'product_id' => $_POST['product_id'],
                        'product_name' => $_POST['product_name'],
                        'product_price' => $_POST['product_price'],
                        'product_quantity' => $_POST['product_quantity'],
                        'product_size' => $_POST['product_size']
                    );

                    $_SESSION['cart'][$count] = $item_array;
                    echo "<script>alert('Item successfully added to cart')</script>";
                    // print_r($_SESSION['cart']);
                }
            } else {
                // create session if it's the first time adding to cart
                $item_array = array(
                    'product_id' => $_POST['product_id'],
                    'product_name' => $_POST['product_name'],
                    'product_price' => $_POST['product_price'],
                    'product_quantity' => $_POST['product_quantity'],
                    'product_size' => $_POST['product_size']
                );

                $_SESSION['cart'][0] = $item_array;
                echo "<script>alert('Item successfully added to cart :)')</script>";
            }
        } else {
            echo "<script>alert('You must Login First')</script>";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>White Canvas | Women's catalog - Lifestyle</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=Ddevice-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="CSS/GenderCatalog.css" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
    <!-- ------------------- Header (calling header function) ------------------->
    <div id="header"></div>
    <!-- ------------------- Header End ------------------->
    
    
    <!-- ------------------- Page banner ------------------->
    <div><img src="Images/Image for users/FemaleCatalogBanner.png" style="width: 100%" /></div><br><br>
    
    <!-- ------------------- Content ------------------->
    <div style="height: 900px;display:flex; width:100%">
        <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <a style="color:white" href="WomensCatalog - Lifestyle.php">Lifestyle</a>
            <a href="WomensCatalog - Running.php">Running</a>
            <a href="WomensCatalog - Jordan.php">Jordan</a>
        </div>

        <div id="main">
            <button class="openbtnX" onclick="openNav()">☰ Open Sidebar</button>  <br><br>
            
            <div class="InnerContainer">
                <h1 style="text-align:center;">Women's lifestyle</h1>    
                <hr style="height:3px; background-color:gray; width:92%;"><br>
                
                <!-- ------------------- display product ------------------->
                <div style=" display:flex;">
                    <?php
                       $sql = "SELECT * FROM product
                       WHERE Product_Gender = 'Women'
                       AND Product_Category = 'Lifestyle'";

                       $stmt = oci_parse($dbconn, $sql);
                       oci_execute($stmt);

                       while ($row = oci_fetch_assoc($stmt)) {
                           component($row['PRODUCT_NAME'], $row['PRODUCT_PRICE'], $row['PRODUCT_IMAGE'], $row['PRODUCT_ID'], $row['PRODUCT_DESC']);
                       }
                    ?>
                </div>
                <!-- ------------------- display product end ------------------->
            </div>        
        </div>
    </div>
    <!-- ------------------- Content end ------------------->

    <!-- --------------- Footer ---------------->
    <div id="footer"></div>
    <!-- --------------- End of footer---------------->

    <script>
        /*-------------------------- sidebar ------------------------------*/
        function openNav() {
            document.getElementById("mySidebar").style.width = "20%";
            document.getElementById("main").style.marginLeft = "50px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft= "0";
        }
        /*-------------------------- sidebar end ------------------------------*/
        
        /*-------------------------- Search bar ------------------------------*/
        function openSearch() {
            document.getElementById("myOverlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("myOverlay").style.display = "none";
        }
        /*-------------------------- Search bar end ------------------------------*/
        
        /*-------------------------- Calling header and footer function ------------------------------*/
        $(function(){
            $("#header").load("Header.php"); 
            $("#footer").load("Footer.php");
        });
        /*-------------------------- header and footer function end ------------------------------*/
        
    </script>
</body>
</html>